<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoUlLocale' ) ) {

	class WpssoUlLocale {

		protected $p;

		public function __construct( &$plugin ) {
			$this->p =& $plugin;
			if ( $this->p->debug->enabled )
				$this->p->debug->mark();

			$is_admin = is_admin();
			$on_front = apply_filters( 'wpsso_user_locale_front_end',
				( empty( $this->p->options['ul_front_end'] ) ? false : true ) );

			if ( ! $is_admin && $on_front )	// apply user locale value to front-end
				add_filter( 'locale', array( __CLASS__, 'get_user_locale' ) );

			if ( $is_admin || $on_front ) {
				add_action( 'wp_before_admin_bar_render', array( __CLASS__, 'add_locale_toolbar' ) );

				if ( isset( $_GET['update-user-locale'] ) )	// new user locale value selected
					add_action( 'wp_loaded', array( __CLASS__, 'update_user_locale' ), -1000 );
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
			} else return;

			$url = remove_query_arg( 'update-user-locale' );

			if ( $user_id = get_current_user_id() ) {
				if ( $user_locale === 'site-default' )
					delete_user_meta( $user_id, 'locale' );
				else update_user_meta( $user_id, 'locale', $user_locale );
			}

			if ( $user_locale === 'site-default' )
				$user_locale = SucomUtil::get_locale( 'default' );

			/*
			 * Prefer Polylang URLs
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

				if ( isset( $pll_urls[$user_locale] ) )
					$url = $pll_urls[$user_locale];
				elseif ( isset( $pll_urls[$pll_def_locale] ) )
					$url = $pll_urls[$pll_def_locale];
			}

			wp_redirect( apply_filters( 'wpsso_user_locale_redirect_url', $url, $user_locale ) );

			exit;
		}

		public static function add_locale_toolbar() {
			if ( ! $user_id = get_current_user_id() )
				return;

			global $wp_admin_bar;
			require_once( ABSPATH.'wp-admin/includes/translation-install.php' );
			$wpsso = Wpsso::get_instance();
			$translations = wp_get_available_translations();	// since wp 4.0
			$languages = array_merge( array( 'site-default' ), get_available_languages() );	// since wp 3.0
			$user_locale = get_user_meta( $user_id, 'locale', true );

			if ( empty( $user_locale ) )
				$user_locale = 'site-default';

			$menu_locale = $user_locale === 'site-default' ? 
				__( 'default', 'wpsso-user-locale' ) : $user_locale;

			$menu_title = SucomUtil::get_locale_opt( 'ul_menu_title', $wpsso->options );
			$menu_title = apply_filters( 'wpsso_user_locale_menu_title', $menu_title, $menu_locale );
			$menu_title = sprintf( $menu_title, $menu_locale );

			$wp_admin_bar->add_node( array(	// since wp 3.1
				'id' => 'wpsso-user-locale',
				'title' => $menu_title,
				'parent' => false,
				'href' => false,
				'group' => false,
				'meta' => false,
			) );

			foreach ( $languages as $locale ) {
				$meta = array();
				if ( isset( $translations[$locale]['native_name'] ) ) {
					$native_name = $translations[$locale]['native_name'];
				} elseif ( $locale === 'en_US' ) {
					$native_name = 'English (United States)';
				} elseif ( $locale === 'site-default' ) {
					$native_name = __( 'Default Locale', 'wpsso-user-locale' );
				} else {
					$native_name = $locale;
				}
				if ( $locale === $user_locale ) {
					$native_name = '<strong>'.$native_name.'</strong>';
					$meta['class'] = 'current_locale';
				}
				$wp_admin_bar->add_node( array(	// since wp 3.1
					'id' => 'wpsso-user-locale-'.$locale,
					'title' => $native_name,
					'parent' => 'wpsso-user-locale',
					'href' => add_query_arg( 'update-user-locale', rawurlencode( $locale ) ),
					'group' => false,
					'meta' => $meta,
				) );
			}
		}
	}
}

?>
