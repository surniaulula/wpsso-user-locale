<?php
/*
 * Plugin Name: WPSSO User Locale (WPSSO UL)
 * Text Domain: wpsso-user-locale
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/wpsso-user-locale/
 * Assets URI: https://jsmoriss.github.io/wpsso-user-locale/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: WPSSO extension to add a user locale / language selector in the WordPress admin back-end and front-end toolbar menus.
 * Requires At Least: 3.8
 * Tested Up To: 4.7.2
 * Version: 1.1.0-1
 *
 * Version Components: {major}.{minor}.{bugfix}-{stage}{level}
 *
 *	{major}		Major code changes / re-writes or significant feature changes.
 *	{minor}		New features / options were added or improved.
 *	{bugfix}	Bugfixes or minor improvements.
 *	{stage}{level}	dev < a (alpha) < b (beta) < rc (release candidate) < # (production).
 *
 * See PHP's version_compare() documentation at http://php.net/manual/en/function.version-compare.php.
 * 
 * This script is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This script is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more details at
 * http://www.gnu.org/licenses/.
 * 
 * Copyright 2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoUl' ) ) {

	class WpssoUl {

		public $p;		// Wpsso
		public $reg;		// WpssoUlRegister
		public $filters;	// WpssoUlFilters
		public $locale;		// WpssoUlLocale

		private static $instance;
		private static $have_req_min = true;	// have at least minimum wpsso version
		private static $wp_min_version = 4.7;

		public function __construct() {

			require_once ( dirname( __FILE__ ).'/lib/config.php' );
			WpssoUlConfig::set_constants( __FILE__ );
			WpssoUlConfig::require_libs( __FILE__ );	// includes the register.php class library
			$this->reg = new WpssoUlRegister();		// activate, deactivate, uninstall hooks

			if ( is_admin() ) {
				add_action( 'admin_init', array( __CLASS__, 'required_check' ) );
				add_action( 'admin_init', array( __CLASS__, 'check_wp_version' ) );
			}

			add_action( 'wpsso_init_debug', array( __CLASS__, 'load_textdomain' ) );
			add_filter( 'wpsso_get_config', array( &$this, 'wpsso_get_config' ), 10, 2 );
			add_action( 'wpsso_init_options', array( &$this, 'wpsso_init_options' ), 10 );
			add_action( 'wpsso_init_objects', array( &$this, 'wpsso_init_objects' ), 10 );
			add_action( 'wpsso_init_plugin', array( &$this, 'wpsso_init_plugin' ), 10 );
		}

		public static function &get_instance() {
			if ( ! isset( self::$instance ) )
				self::$instance = new self;
			return self::$instance;
		}

		public static function load_textdomain() {
			load_plugin_textdomain( 'wpsso-user-locale', false, 'wpsso-user-locale/languages/' );
		}

		public static function required_check() {
			if ( ! class_exists( 'Wpsso' ) )
				add_action( 'all_admin_notices', array( __CLASS__, 'required_notice' ) );
		}

		// also called from the activate_plugin method with $deactivate = true
		public static function required_notice( $deactivate = false ) {
			self::load_textdomain();
			$info = WpssoUlConfig::$cf['plugin']['wpssoul'];
			$die_msg = __( '%1$s is an extension for the %2$s plugin &mdash; please install and activate the %3$s plugin before activating %4$s.',
				'wpsso-user-locale' );
			$err_msg = __( 'The %1$s extension requires the %2$s plugin &mdash; please install and activate the %3$s plugin.',
				'wpsso-user-locale' );

			if ( $deactivate === true ) {
				require_once( ABSPATH.'wp-admin/includes/plugin.php' );
				deactivate_plugins( $info['base'] );
				wp_die( '<p>'.sprintf( $die_msg, $info['name'], $info['req']['name'], $info['req']['short'], $info['short'] ).'</p>' );
			} else echo '<div class="notice notice-error error"><p>'.
				sprintf( $err_msg, $info['name'], $info['req']['name'], $info['req']['short'] ).'</p></div>';
		}

		public static function check_wp_version() {
			global $wp_version;
			if ( version_compare( $wp_version, self::$wp_min_version, '<' ) ) {
				$plugin = plugin_basename( __FILE__ );
				if ( is_plugin_active( $plugin ) ) {
					require_once( ABSPATH.'wp-admin/includes/plugin.php' );	// just in case
					$plugin_data = get_plugin_data( __FILE__, false );	// $markup = false
					deactivate_plugins( $plugin );
					wp_die( 
						sprintf( __( '%1$s requires WordPress version %2$s or higher and has been deactivated.',
							'wpsso-user-locale' ), $plugin_data['Name'], self::$wp_min_version ).'<br/><br/>'.
						sprintf( __( 'Please upgrade WordPress before trying to reactivate the %1$s plugin.',
							'wpsso-user-locale' ), $plugin_data['Name'] )
					);
				}
			}
		}

		public function wpsso_get_config( $cf, $plugin_version = 0 ) {
			$info = WpssoUlConfig::$cf['plugin']['wpssoul'];

			if ( version_compare( $plugin_version, $info['req']['min_version'], '<' ) ) {
				self::$have_req_min = false;
				return $cf;
			}

			return SucomUtil::array_merge_recursive_distinct( $cf, WpssoUlConfig::$cf );
		}

		public function wpsso_init_options() {
			if ( method_exists( 'Wpsso', 'get_instance' ) )
				$this->p =& Wpsso::get_instance();
			else $this->p =& $GLOBALS['wpsso'];

			if ( $this->p->debug->enabled )
				$this->p->debug->mark();

			if ( self::$have_req_min === false )
				return;		// stop here

			$this->p->is_avail['ul'] = true;

			if ( is_admin() )
				$this->p->is_avail['admin']['ul-general'] = true;
		}

		public function wpsso_init_objects() {
			if ( $this->p->debug->enabled )
				$this->p->debug->mark();

			if ( self::$have_req_min === false )
				return;		// stop here

			$this->filters = new WpssoUlFilters( $this->p );
			$this->locale = new WpssoUlLocale( $this->p );
		}

		public function wpsso_init_plugin() {
			if ( $this->p->debug->enabled )
				$this->p->debug->mark();

			if ( self::$have_req_min === false )
				return $this->min_version_notice();
		}

		private function min_version_notice() {
			$info = WpssoUlConfig::$cf['plugin']['wpssoul'];
			$wpsso_version = $this->p->cf['plugin']['wpsso']['version'];

			if ( $this->p->debug->enabled ) {
				$this->p->debug->log( $info['name'].' requires '.$info['req']['short'].' v'.
					$info['req']['min_version'].' or newer ('.$wpsso_version.' installed)' );
			}

			if ( is_admin() ) {
				$this->p->notice->err( sprintf( __( 'The %1$s extension v%2$s requires %3$s v%4$s or newer (v%5$s currently installed).',
					'wpsso-user-locale' ), $info['name'], $info['version'], $info['req']['short'],
						$info['req']['min_version'], $wpsso_version ) );
			}
		}
	}

	WpssoUl::get_instance();
}

?>
