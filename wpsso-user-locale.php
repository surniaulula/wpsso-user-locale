<?php
/*
 * Plugin Name: WPSSO User Locale Selector
 * Plugin Slug: wpsso-user-locale
 * Text Domain: wpsso-user-locale
 * Domain Path: /languages
 * Plugin URI: https://wpsso.com/extend/plugins/wpsso-user-locale/
 * Assets URI: https://jsmoriss.github.io/wpsso-user-locale/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: WPSSO extension to add a user locale / language / region selector in the WordPress admin back-end and front-end toolbar menus.
 * Requires At Least: 3.7
 * Tested Up To: 4.8.1
 * Requires PHP: 5.3
 * Version: 1.1.7
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *	{major}		Major structural code changes / re-writes or incompatible API changes.
 *	{minor}		New functionality was added or improved in a backwards-compatible manner.
 *	{bugfix}	Backwards-compatible bug fixes or small improvements.
 *	{stage}.{level}	Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoUl' ) ) {

	class WpssoUl {

		public $p;		// Wpsso
		public $reg;		// WpssoUlRegister
		public $filters;	// WpssoUlFilters
		public $locale;		// WpssoUlLocale

		private static $instance;
		private static $have_min = true;	// have minimum wpsso version

		public function __construct() {

			require_once ( dirname( __FILE__ ).'/lib/config.php' );
			WpssoUlConfig::set_constants( __FILE__ );
			WpssoUlConfig::require_libs( __FILE__ );	// includes the register.php class library
			$this->reg = new WpssoUlRegister();		// activate, deactivate, uninstall hooks

			if ( is_admin() ) {
				add_action( 'admin_init', array( __CLASS__, 'required_check' ) );
				add_action( 'admin_init', array( __CLASS__, 'check_wp_version' ) );	// requires wp v4.7+
			}

			add_action( 'wpsso_init_textdomain', array( __CLASS__, 'wpsso_init_textdomain' ) );
			add_filter( 'wpsso_get_config', array( &$this, 'wpsso_get_config' ), 10, 2 );
			add_action( 'wpsso_init_options', array( &$this, 'wpsso_init_options' ), 10 );
			add_action( 'wpsso_init_objects', array( &$this, 'wpsso_init_objects' ), 10 );
			add_action( 'wpsso_init_plugin', array( &$this, 'wpsso_init_plugin' ), 10 );
		}

		public static function &get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public static function required_check() {
			if ( ! class_exists( 'Wpsso' ) ) {
				add_action( 'all_admin_notices', array( __CLASS__, 'required_notice' ) );
			}
		}

		// also called from the activate_plugin method with $deactivate = true
		public static function required_notice( $deactivate = false ) {
			self::wpsso_init_textdomain();
			$info = WpssoUlConfig::$cf['plugin']['wpssoul'];
			$die_msg = __( '%1$s is an extension for the %2$s plugin &mdash; please install and activate the %3$s plugin before activating %4$s.', 'wpsso-user-locale' );
			$err_msg = __( 'The %1$s extension requires the %2$s plugin &mdash; install and activate the %3$s plugin or <a href="%4$s">deactivate the %5$s extension</a>.', 'wpsso-user-locale' );
			if ( $deactivate === true ) {
				if ( ! function_exists( 'deactivate_plugins' ) ) {
					require_once trailingslashit( ABSPATH ).'wp-admin/includes/plugin.php';
				}
				deactivate_plugins( $info['base'], true );	// $silent = true
				wp_die( '<p>'.sprintf( $die_msg, $info['name'], $info['req']['name'], $info['req']['short'], $info['short'] ).'</p>' );
			} else {
				$deactivate_url = wp_nonce_url( 'plugins.php?action=deactivate&amp;'.
					'plugin='.$info['base'].'&amp;plugin_status=active&amp;paged=1&amp;s=',
						'deactivate-plugin_'.$info['base'] );
				echo '<div class="notice notice-error error"><p>'.
					sprintf( $err_msg, $info['name'], $info['req']['name'],
						$info['req']['short'], $deactivate_url, $info['short'] ).'</p></div>';
			}
		}

		public static function check_wp_version() {
			global $wp_version;
			$wp_min_version = 4.7;

			if ( version_compare( $wp_version, $wp_min_version, '<' ) ) {
				$plugin = plugin_basename( __FILE__ );
				if ( is_plugin_active( $plugin ) ) {
					self::wpsso_init_textdomain();
					if ( ! function_exists( 'deactivate_plugins' ) ) {
						require_once trailingslashit( ABSPATH ).'wp-admin/includes/plugin.php';
					}
					$plugin_data = get_plugin_data( __FILE__, false );	// $markup = false
					deactivate_plugins( $plugin, true );	// $silent = true
					wp_die( 
						'<p>'.sprintf( __( '%1$s requires %2$s version %3$s or higher and has been deactivated.',
							'wpsso-user-locale' ), $plugin_data['Name'], 'WordPress', $wp_min_version ).'</p>'.
						'<p>'.sprintf( __( 'Please upgrade %1$s before trying to re-activate the %2$s plugin.',
							'wpsso-user-locale' ), 'WordPress', $plugin_data['Name'] ).'</p>'
					);
				}
			}
		}

		public static function wpsso_init_textdomain() {
			load_plugin_textdomain( 'wpsso-user-locale', false, 'wpsso-user-locale/languages/' );
		}

		public function wpsso_get_config( $cf, $plugin_version = 0 ) {
			$info = WpssoUlConfig::$cf['plugin']['wpssoul'];

			if ( version_compare( $plugin_version, $info['req']['min_version'], '<' ) ) {
				self::$have_min = false;
				return $cf;
			}

			return SucomUtil::array_merge_recursive_distinct( $cf, WpssoUlConfig::$cf );
		}

		public function wpsso_init_options() {
			if ( method_exists( 'Wpsso', 'get_instance' ) ) {
				$this->p =& Wpsso::get_instance();
			} else {
				$this->p =& $GLOBALS['wpsso'];
			}

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( self::$have_min ) {
				$this->p->avail['p_ext']['ul'] = true;
			} else {
				$this->p->avail['p_ext']['ul'] = false;	// just in case
			}
		}

		public function wpsso_init_objects() {
			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( self::$have_min ) {
				$this->filters = new WpssoUlFilters( $this->p );
				$this->locale = new WpssoUlLocale( $this->p );
			}
		}

		public function wpsso_init_plugin() {
			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( ! self::$have_min ) {
				return $this->min_version_notice();	// stop here
			}
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
