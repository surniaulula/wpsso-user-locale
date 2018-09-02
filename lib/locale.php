<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2017-2018 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoUlLocale' ) ) {

	class WpssoUlLocale {

		protected $p;

		public function __construct( &$plugin ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$is_admin = is_admin();
			$on_front = empty( $this->p->options['ul_front_end'] ) ? false : true;
			$on_front = apply_filters( 'wpsso_user_locale_front_end', $on_front );

			if ( ! $is_admin && $on_front ) {	// Apply user locale value to front-end.
				add_filter( 'locale', array( __CLASS__, 'get_user_locale' ) );
			}

			if ( $is_admin || $on_front ) {

				add_action( 'admin_bar_menu', array( __CLASS__, 'add_locale_toolbar' ), WPSSO_TB_LOCALE_MENU_ORDER );

				if ( isset( $_GET['update-user-locale'] ) ) {	// New user locale value selected.
					add_action( 'wp_loaded', array( __CLASS__, 'update_user_locale' ), -1000 );
				}
			}
		}

		public static function get_user_locale( $locale ) {
			if ( $user_id = get_current_user_id() )	{
				if ( $user_locale = get_user_meta( $user_id, 'locale', true ) ) {
					return $user_locale;
				}
			}
			return $locale;
		}

		public static function update_user_locale() {

			if ( isset( $_GET['update-user-locale'] ) ) {
				$user_locale = sanitize_text_field( $_GET['update-user-locale'] );
			} else {
				return;
			}

			$url = remove_query_arg( 'update-user-locale' );

			if ( $user_id = get_current_user_id() ) {
				if ( $user_locale === 'site-default' ) {
					delete_user_meta( $user_id, 'locale' );
				} else {
					update_user_meta( $user_id, 'locale', $user_locale );
				}
			}

			if ( $user_locale === 'site-default' ) {
				$user_locale = SucomUtil::get_locale( 'default' );
			}

			/**
			 * Use Polylang URLs
			 */
			if ( ! is_admin() && function_exists( 'pll_the_languages' ) ) {

				$pll_languages = pll_the_languages( array( 'echo' => 0, 'raw' => 1 ) );
				$pll_def_locale = pll_default_language( 'locale' );
				$pll_urls = array();	// associative array of locales and their url

				foreach ( $pll_languages as $pll_lang ) {
					if ( ! empty( $pll_lang['locale'] ) && ! empty( $pll_lang['url'] ) ) {
						$pll_locale = str_replace( '-', '_', $pll_lang['locale'] );	// wp compatibility
						$pll_urls[$pll_locale] = $pll_lang['url'];
					}
				}

				if ( isset( $pll_urls[$user_locale] ) ) {
					$url = $pll_urls[$user_locale];
				} elseif ( isset( $pll_urls[$pll_def_locale] ) ) {
					$url = $pll_urls[$pll_def_locale];
				}
			}

			$wpsso = Wpsso::get_instance();
			$wpsso->notice->trunc();	// clear all notification messages

			wp_redirect( apply_filters( 'wpsso_user_locale_redirect_url', $url, $user_locale ) );

			exit;
		}

		public static function add_locale_toolbar( $wp_admin_bar ) {

			if ( ! $user_id = get_current_user_id() ) {
				return;
			}

			require_once trailingslashit( ABSPATH ).'wp-admin/includes/translation-install.php';

			$wpsso = Wpsso::get_instance();
			$translations = wp_get_available_translations();	// since wp 4.0
			$languages = array_merge( array( 'site-default' ), get_available_languages() );	// since wp 3.0
			$user_locale = get_user_meta( $user_id, 'locale', true );

			if ( empty( $user_locale ) ) {
				$user_locale = 'site-default';
			}

			$menu_locale = $user_locale === 'site-default' ? 
				_x( 'default', 'toolbar menu title', 'wpsso-user-locale' ) : $user_locale;

			/**
			 * Menu Icon and Title
			 */
			$dashicon = empty( $wpsso->options['ul_menu_icon'] ) ? null : $wpsso->options['ul_menu_icon'];
			$dashicon = apply_filters( 'wpsso_user_locale_menu_dashicon',  $dashicon, $menu_locale );

			if ( ! empty( $dashicon ) && $dashicon !== 'none' ) {

				$dashicons = SucomUtil::get_dashicons();	// Get the raw / unsorted dashicons array.

				if ( isset( $dashicons[$dashicon] ) ) {		// Just in case.
					$menu_icon = '<span class="ab-icon dashicons-'.$dashicons[$dashicon].'"></span>';
				} else {
					$menu_icon = '';
				}
			} else {
				$menu_icon = '';
			}

			$menu_title = SucomUtil::get_key_value( 'ul_menu_title', $wpsso->options );
			$menu_title = apply_filters( 'wpsso_user_locale_menu_title', $menu_title, $menu_locale );
			$menu_title = sprintf( $menu_title, $menu_locale );

			$wp_admin_bar->add_node( array(	// Since wp 3.1
				'id' => 'wpsso-user-locale',
				'title' => $menu_icon . $menu_title,
				'parent' => false,
				'href' => false,
				'group' => false,
				'meta' => array(),
			) );

			/**
			 * Menu Drop-down Items
			 */
			$menu_items = array();

			foreach ( $languages as $locale ) {

				$meta = array();

				if ( isset( $translations[$locale]['native_name'] ) ) {
					$native_name = $translations[$locale]['native_name'];
				} elseif ( $locale === 'en_US' ) {
					$native_name = 'English (United States)';
				} elseif ( $locale === 'site-default' ) {
					$native_name = _x( 'Default Locale', 'toolbar menu item', 'wpsso-user-locale' );
				} else {
					$native_name = $locale;
				}

				if ( $locale === $user_locale ) {
					$native_name = '<strong>'.$native_name.'</strong>';
					$meta['class'] = 'current_locale';
				}

				$menu_items[] = array(
					'id' => 'wpsso-user-locale-'.$locale,
					'title' => $native_name,
					'parent' => 'wpsso-user-locale',
					'href' => add_query_arg( 'update-user-locale', rawurlencode( $locale ) ),
					'group' => false,
					'meta' => $meta,
				);
			}

			$menu_items = apply_filters( 'wpsso_user_locale_menu_items', $menu_items, $menu_locale );

			foreach ( $menu_items as $menu_item ) {
				$wp_admin_bar->add_node( $menu_item );
			}
		}
	}
}
