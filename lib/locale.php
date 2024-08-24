<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2017-2024 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoUlLocale' ) ) {

	class WpssoUlLocale {

		private $p;	// Wpsso class object.
		private $a;	// WpssoUl class object.

		/*
		 * Instantiated by WpssoUl->init_objects().
		 */
		public function __construct( &$plugin, &$addon ) {

			$this->p =& $plugin;
			$this->a =& $addon;

			$user_id       = get_current_user_id();
			$is_admin      = is_admin();
			$show_on_front = empty( $this->p->options[ 'ul_front_end' ] ) ? false : true;
			$show_on_front = (bool) apply_filters( 'wpsso_user_locale_show_on_front', $show_on_front );

			if ( $user_id ) {

				if ( ! $is_admin && $show_on_front ) {	// Apply user locale value to front-end.

					$locale      = get_locale();
					$user_locale = get_metadata( 'user', $user_id, 'locale', $single = true );

					if ( $locale !== $user_locale ) {

						$is_switched = switch_to_locale( $user_locale );	// Switches to locale if the WP language is installed.

						if ( $this->p->debug->enabled ) {

							$this->p->debug->log( 'switch to locale ' . ( $is_switched ? 'successful' : 'failed' ) );
						}
					}
				}

				if ( $is_admin || $show_on_front ) {

					add_action( 'admin_bar_menu', array( $this, 'add_admin_bar_menu' ), WPSSO_TB_LOCALE_MENU_ORDER, 1 );

					if ( isset( $_GET[ 'update-user-locale' ] ) ) {	// New user locale value selected.

						/*
						 * This hook is fired once WordPress, plugins, and the theme are fully loaded and instantiated.
						 */
						add_action( 'wp_loaded', array( $this, 'update_user_locale' ), -1000 );
					}
				}
			}
		}

		public function update_user_locale() {

			if ( ! isset( $_GET[ 'update-user-locale' ] ) ) {	// Just in case.

				return;
			}

			$user_locale  = sanitize_text_field( $_GET[ 'update-user-locale' ] );
			$redirect_url = remove_query_arg( 'update-user-locale' );

			if ( $user_id = get_current_user_id() ) {

				if ( 'site-default' === $user_locale ) {

					delete_metadata( 'user', $user_id, 'locale' );

				} else update_metadata( 'user', $user_id, 'locale', $user_locale );
			}

			if ( 'site-default' === $user_locale ) {

				$user_locale = SucomUtilWP::get_locale( 'default' );
			}

			/*
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

					$redirect_url = $pll_urls[ $user_locale ];

				} elseif ( isset( $pll_urls[ $pll_def_locale ] ) ) {

					$redirect_url = $pll_urls[ $pll_def_locale ];
				}
			}

			$this->p->notice->clear();	// Clear any old locale notices.

			wp_redirect( apply_filters( 'wpsso_user_locale_redirect_url', $redirect_url, $user_locale ) );

			exit;
		}

		public function add_admin_bar_menu( $wp_admin_bar ) {

			if ( ! $user_id = get_current_user_id() ) {	// Just in case.

				return;
			}

			$user_locale  = get_metadata( 'user', $user_id, 'locale', $single = true );
			$locale_names = array( 'site-default' => _x( 'Default', 'toolbar menu item', 'wpsso-user-locale' ) );
			$locale_names = array_merge( $locale_names, SucomUtilWP::get_available_locale_names() );

			if ( empty( $user_locale ) ) {

				$user_locale = 'site-default';
			}

			/*
			 * Menu icon and title.
			 */
			$native_name    = empty( $locale_names[ $user_locale ] ) ? $user_locale : $locale_names[ $user_locale ];
			$menu_icon_num  = empty( $this->p->options[ 'ul_menu_icon' ] ) ? null : $this->p->options[ 'ul_menu_icon' ];
			$menu_icon_num  = apply_filters( 'wpsso_user_locale_menu_dashicon', $menu_icon_num, $user_locale );
			$menu_icon_html = '';

			if ( $menu_icon_name = SucomUtil::get_dashicons( $menu_icon_num ) ) {	// Just in case.

				$menu_icon_html = '<span class="ab-icon dashicons-' . $menu_icon_name . '"></span>';
			}

			$menu_title_html = SucomUtilOptions::get_key_value( 'ul_menu_title', $this->p->options );	// Returns a localized option value or null.
			$menu_title_html = apply_filters( 'wpsso_user_locale_menu_title', $menu_title_html, $user_locale );
			$menu_title_html = sprintf( $menu_title_html, $native_name );

			$wp_admin_bar->add_node( array(
				'id'     => 'wpsso-user-locale',
				'title'  => $menu_icon_html . $menu_title_html,
				'parent' => false,
				'href'   => false,
				'group'  => false,
				'meta'   => array(),
			) );

			/*
			 * Menu drop-down items.
			 */
			$menu_items = array();

			foreach ( $locale_names as $locale => $native_name ) {

				$meta = array();

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

			$menu_items = apply_filters( 'wpsso_user_locale_menu_items', $menu_items, $user_locale );

			foreach ( $menu_items as $menu_item ) {

				$wp_admin_bar->add_node( $menu_item );
			}
		}
	}
}
