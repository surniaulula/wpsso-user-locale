<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoUlConfig' ) ) {

	class WpssoUlConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssoul' => array(
					'version' => '1.0.0-1',		// plugin version
					'opt_version' => '3',		// increment when changing default options
					'short' => 'WPSSO UL',		// short plugin name
					'name' => 'WPSSO Select User Locale (WPSSO UL)',
					'desc' => 'WPSSO extension to add a user locale / language selector in the WordPress admin back-end and front-end toolbar menus.',
					'slug' => 'wpsso-user-locale',
					'base' => 'wpsso-user-locale/wpsso-user-locale.php',
					'update_auth' => '',
					'text_domain' => 'wpsso-user-locale',
					'domain_path' => '/languages',
					'req' => array(
						'short' => 'WPSSO',
						'name' => 'WordPress Social Sharing Optimization (WPSSO)',
						'min_version' => '3.38.2-1',
					),
					'img' => array(
						'icon_small' => 'images/icon-128x128.png',
						'icon_medium' => 'images/icon-256x256.png',
					),
					'url' => array(
						// wordpress
						'download' => 'https://wordpress.org/plugins/wpsso-user-locale/',
						'forum' => 'https://wordpress.org/support/plugin/wpsso-user-locale',
						'review' => 'https://wordpress.org/support/view/plugin-reviews/wpsso-user-locale?filter=5&rate=5#postform',
						// github
						'readme_txt' => 'https://raw.githubusercontent.com/SurniaUlula/wpsso-user-locale/master/readme.txt',
						// wpsso
						'latest' => 'https://wpsso.com/extend/plugins/wpsso-user-locale/latest/',
						'update' => 'https://wpsso.com/extend/plugins/wpsso-user-locale/update/',
						'changelog' => 'https://wpsso.com/extend/plugins/wpsso-user-locale/changelog/',
						'codex' => 'https://wpsso.com/codex/plugins/wpsso-user-locale/',
						'faq' => '',
						'notes' => '',
					),
					'lib' => array(
						// submenu items must have unique keys
						'submenu' => array (
							'ul-general' => 'User Locale',	// general settings
						),
						'gpl' => array(
						),
						'pro' => array(
						),
					),
				),
			),
		);

		public static function get_version() { 
			return self::$cf['plugin']['wpssoul']['version'];
		}

		public static function set_constants( $plugin_filepath ) { 
			define( 'WPSSOUL_FILEPATH', $plugin_filepath );						
			define( 'WPSSOUL_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_filepath ) ) ) );
			define( 'WPSSOUL_PLUGINSLUG', self::$cf['plugin']['wpssoul']['slug'] );		// wpsso-user-locale
			define( 'WPSSOUL_PLUGINBASE', self::$cf['plugin']['wpssoul']['base'] );		// wpsso-user-locale/wpsso-user-locale.php
			define( 'WPSSOUL_URLPATH', trailingslashit( plugins_url( '', $plugin_filepath ) ) );
		}

		public static function require_libs( $plugin_filepath ) {

			require_once( WPSSOUL_PLUGINDIR.'lib/register.php' );
			require_once( WPSSOUL_PLUGINDIR.'lib/filters.php' );
			require_once( WPSSOUL_PLUGINDIR.'lib/locale.php' );

			add_filter( 'wpssoul_load_lib', array( 'WpssoUlConfig', 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $ret = false, $filespec = '', $classname = '' ) {
			if ( $ret === false && ! empty( $filespec ) ) {
				$filepath = WPSSOUL_PLUGINDIR.'lib/'.$filespec.'.php';
				if ( file_exists( $filepath ) ) {
					require_once( $filepath );
					if ( empty( $classname ) )
						return SucomUtil::sanitize_classname( 'wpssoul'.$filespec, false );	// $underscore = false
					else return $classname;
				}
			}
			return $ret;
		}
	}
}

?>
