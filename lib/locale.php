<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2017-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoUlLocale' ) ) {

	class WpssoUlLocale {

		private $p;	// Wpsso class object.
		private $a;     // WpssoUl class object.

		/**
		 * Instantiated by WpssoUl->init_objects().
		 */
		public function __construct( &$plugin, &$addon ) {

			$this->p =& $plugin;
			$this->a =& $addon;

			$is_admin      = is_admin();
			$user_id       = get_current_user_id();
			$show_on_front = empty( $this->p->options[ 'ul_front_end' ] ) ? false : true;
			$show_on_front = (bool) apply_filters( 'wpsso_user_locale_show_on_front', $show_on_front );

			if ( $user_id ) {

				if ( ! $is_admin && $show_on_front ) {	// Apply user locale value to front-end.

					$locale      = get_locale();
					$user_locale = get_user_meta( $user_id, 'locale', $single = true );

					if ( $locale !== $user_locale ) {

						switch_to_locale( $user_locale );
					}
				}

				if ( $is_admin || $show_on_front ) {

					add_action( 'admin_bar_menu', array( $this, 'add_locale_toolbar' ), WPSSO_TB_LOCALE_MENU_ORDER, 1 );

					if ( isset( $_GET[ 'update-user-locale' ] ) ) {	// New user locale value selected.

						add_action( 'wp_loaded', array( $this, 'update_user_locale' ), -1000 );
					}
				}
			}
		}

		public function update_user_locale() {

			if ( ! isset( $_GET[ 'update-user-locale' ] ) ) {	// Just in case.

				return;
			}

			$user_locale = sanitize_text_field( $_GET[ 'update-user-locale' ] );

			$url = remove_query_arg( 'update-user-locale' );

			if ( $user_id = get_current_user_id() ) {

				if ( 'site-default' === $user_locale ) {

					delete_user_meta( $user_id, 'locale' );

				} else {

					update_user_meta( $user_id, 'locale', $user_locale );
				}
			}

			if ( 'site-default' === $user_locale ) {

				$user_locale = SucomUtil::get_locale( 'default' );
			}

			/**
			 * Use Polylang URLs
			 */
			if ( ! is_admin() && function_exists( 'pll_the_languages' ) ) {

				$pll_languages  = pll_the_languages( array( 'echo' => 0, 'raw' => 1 ) );
				$pll_def_locale = pll_default_language( 'locale' );
				$pll_urls       = array();	// Associative array of locales and their url.

				foreach ( $pll_languages as $pll_lang ) {

					if ( ! empty( $pll_lang[ 'locale' ] ) && ! empty( $pll_lang[ 'url' ] ) ) {

						$pll_locale = str_replace( '-', '_', $pll_lang[ 'locale' ] );	// WP compatibility.

						$pll_urls[ $pll_locale ] = $pll_lang[ 'url' ];
					}
				}

				if ( isset( $pll_urls[ $user_locale ] ) ) {

					$url = $pll_urls[ $user_locale ];

				} elseif ( isset( $pll_urls[ $pll_def_locale ] ) ) {

					$url = $pll_urls[ $pll_def_locale ];
				}
			}

			$this->p->notice->clear();	// Clear any old locale notices.

			wp_redirect( apply_filters( 'wpsso_user_locale_redirect_url', $url, $user_locale ) );

			exit;
		}

		public function add_locale_toolbar( $wp_admin_bar ) {

			if ( ! $user_id = get_current_user_id() ) {	// Just in case.

				return;
			}

			require_once trailingslashit( ABSPATH ) . 'wp-admin/includes/translation-install.php';

			$translations = wp_get_available_translations();	// Since WP v4.0.
			$languages    = array_merge( array( 'site-default' ), get_available_languages() );	// Since WP v3.0.
			$user_locale  = get_user_meta( $user_id, 'locale', $single = true );

			if ( empty( $user_locale ) ) {

				$user_locale = 'site-default';
			}

			$menu_locale = 'site-default' === $user_locale ? _x( 'Default', 'toolbar menu title', 'wpsso-user-locale' ) : $user_locale;

			/**
			 * Menu Icon and Title
			 */
			$dashicon = empty( $this->p->options[ 'ul_menu_icon' ] ) ? null : $this->p->options[ 'ul_menu_icon' ];

			$dashicon = apply_filters( 'wpsso_user_locale_menu_dashicon',  $dashicon, $menu_locale );

			if ( ! empty( $dashicon ) && $dashicon !== 'none' ) {

				$dashicons = SucomUtil::get_dashicons();	// Get the raw / unsorted dashicons array.

				if ( isset( $dashicons[ $dashicon ] ) ) {	// Just in case.

					$menu_icon = '<span class="ab-icon dashicons-' . $dashicons[ $dashicon ] . '"></span>';

				} else {

					$menu_icon = '';
				}

			} else {

				$menu_icon = '';
			}

			$menu_title = SucomUtil::get_key_value( 'ul_menu_title', $this->p->options );

			if ( empty( $menu_title ) ) {	// Just in case.

				$menu_title = '%s';
			}

			$menu_title = apply_filters( 'wpsso_user_locale_menu_title', $menu_title, $menu_locale );

			$menu_title = sprintf( $menu_title, $menu_locale );

			$wp_admin_bar->add_node( array(
				'id'     => 'wpsso-user-locale',
				'title'  => $menu_icon . $menu_title,
				'parent' => false,
				'href'   => false,
				'group'  => false,
				'meta'   => array(),
			) );

			/**
			 * Menu Drop-down Items
			 */
			$menu_items = array();

			foreach ( $languages as $locale ) {

				$meta = array();

				if ( isset( $translations[ $locale ][ 'native_name' ] ) ) {

					$native_name = $translations[ $locale ][ 'native_name' ];

				} elseif ( 'en_US' === $locale ) {

					$native_name = 'English (United States)';

				} elseif ( 'site-default' === $locale ) {

					$native_name = _x( 'Default Locale', 'toolbar menu item', 'wpsso-user-locale' );

				} else {

					$native_name = $locale;
				}

				if ( $locale === $user_locale ) {

					$native_name = '<strong>' . $native_name . '</strong>';

					$meta[ 'class' ] = 'current_locale';
				}

				$menu_items[] = array(
					'id'     => 'wpsso-user-locale-' . $locale,
					'title'  => $native_name,
					'parent' => 'wpsso-user-locale',
					'href'   => add_query_arg( 'update-user-locale', rawurlencode( $locale ) ),
					'group'  => false,
					'meta'   => $meta,
				);
			}

			$menu_items = apply_filters( 'wpsso_user_locale_menu_items', $menu_items, $menu_locale );

			foreach ( $menu_items as $menu_item ) {

				$wp_admin_bar->add_node( $menu_item );
			}
		}
	}
}
