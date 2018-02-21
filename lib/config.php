<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2018 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoUlConfig' ) ) {

	class WpssoUlConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssoul' => array(			// Plugin acronym.
					'version' => '1.2.0-b.1',		// Plugin version.
					'opt_version' => '6',		// Increment when changing default option values.
					'short' => 'WPSSO UL',		// Short plugin name.
					'name' => 'WPSSO User Locale Selector',
					'desc' => 'WPSSO Core extension to add a user locale / language / region selector in the WordPress admin back-end and front-end toolbar menus.',
					'slug' => 'wpsso-user-locale',
					'base' => 'wpsso-user-locale/wpsso-user-locale.php',
					'update_auth' => '',
					'text_domain' => 'wpsso-user-locale',
					'domain_path' => '/languages',
					'req' => array(
						'short' => 'WPSSO Core',
						'name' => 'WPSSO Core',
						'min_version' => '3.54.0-b.1',
					),
					'img' => array(
						'icons' => array(
							'low' => 'images/icon-128x128.png',
							'high' => 'images/icon-256x256.png',
						),
					),
					'lib' => array(
						'submenu' => array(	// Note that submenu elements must have unique keys.
							'ul-general' => 'User Locale',
						),
						'gpl' => array(
						),
						'pro' => array(
						),
					),
				),
			),
		);

		public static function get_version( $add_slug = false ) {
			$ext = 'wpssoul';
			$info =& self::$cf['plugin'][$ext];
			return $add_slug ? $info['slug'].'-'.$info['version'] : $info['version'];
		}

		public static function set_constants( $plugin_filepath ) { 
			if ( defined( 'WPSSOUL_VERSION' ) ) {			// execute and define constants only once
				return;
			}
			define( 'WPSSOUL_VERSION', self::$cf['plugin']['wpssoul']['version'] );						
			define( 'WPSSOUL_FILEPATH', $plugin_filepath );						
			define( 'WPSSOUL_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_filepath ) ) ) );
			define( 'WPSSOUL_PLUGINSLUG', self::$cf['plugin']['wpssoul']['slug'] );		// wpsso-user-locale
			define( 'WPSSOUL_PLUGINBASE', self::$cf['plugin']['wpssoul']['base'] );		// wpsso-user-locale/wpsso-user-locale.php
			define( 'WPSSOUL_URLPATH', trailingslashit( plugins_url( '', $plugin_filepath ) ) );
		}

		public static function require_libs( $plugin_filepath ) {

			require_once WPSSOUL_PLUGINDIR.'lib/register.php';
			require_once WPSSOUL_PLUGINDIR.'lib/filters.php';
			require_once WPSSOUL_PLUGINDIR.'lib/locale.php';

			add_filter( 'wpssoul_load_lib', array( 'WpssoUlConfig', 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $ret = false, $filespec = '', $classname = '' ) {
			if ( false === $ret && ! empty( $filespec ) ) {
				$filepath = WPSSOUL_PLUGINDIR.'lib/'.$filespec.'.php';
				if ( file_exists( $filepath ) ) {
					require_once $filepath;
					if ( empty( $classname ) ) {
						return SucomUtil::sanitize_classname( 'wpssoul'.$filespec, false );	// $underscore = false
					} else {
						return $classname;
					}
				}
			}
			return $ret;
		}
	}
}

