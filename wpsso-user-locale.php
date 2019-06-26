<?php
/**
 * Plugin Name: WPSSO User Locale Selector
 * Plugin Slug: wpsso-user-locale
 * Text Domain: wpsso-user-locale
 * Domain Path: /languages
 * Plugin URI: https://wpsso.com/extend/plugins/wpsso-user-locale/
 * Assets URI: https://jsmoriss.github.io/wpsso-user-locale/assets/
 * Author: JS Morisset
 * Author URI: https://wpsso.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: WPSSO Core add-on provides a convenient locale / language / region selector in the WordPress admin toolbar.
 * Requires At Least: 4.7
 * Tested Up To: 5.2.2
 * Version: 2.0.0
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2017-2019 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoUl' ) ) {

	class WpssoUl {

		/**
		 * Wpsso plugin class object variable.
		 */
		public $p;		// Wpsso

		/**
		 * Library class object variables.
		 */
		public $filters;	// WpssoUlFilters
		public $locale;		// WpssoUlLocale
		public $reg;		// WpssoUlRegister

		/**
		 * Reference Variables (config, options, modules, etc.).
		 */
		private $have_req_min = true;	// Have minimum wpsso version.

		private static $instance;
		private static $wp_min_version = '4.7';

		public function __construct() {

			require_once ( dirname( __FILE__ ) . '/lib/config.php' );

			WpssoUlConfig::set_constants( __FILE__ );
			WpssoUlConfig::require_libs( __FILE__ );	// Includes the register.php class library.

			$this->reg = new WpssoUlRegister();		// Activate, deactivate, uninstall hooks.

			if ( is_admin() ) {
				add_action( 'admin_init', array( __CLASS__, 'required_check' ) );
				add_action( 'admin_init', array( __CLASS__, 'check_wp_version' ) );	// Requires wp v4.7 or better.
			}

			add_filter( 'wpsso_get_config', array( $this, 'wpsso_get_config' ), 10, 2 );	// Checks core version and merges config array.
			add_filter( 'wpsso_get_avail', array( $this, 'wpsso_get_avail' ), 10, 1 );

			add_action( 'wpsso_init_textdomain', array( __CLASS__, 'wpsso_init_textdomain' ) );
			add_action( 'wpsso_init_options', array( $this, 'wpsso_init_options' ), 10 );	// Sets the $this->p reference variable.
			add_action( 'wpsso_init_objects', array( $this, 'wpsso_init_objects' ), 10 );
			add_action( 'wpsso_init_plugin', array( $this, 'wpsso_init_plugin' ), 10 );
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

		/**
		 * Also called from the activate_plugin method with $deactivate = true.
		 */
		public static function required_notice( $deactivate = false ) {

			self::wpsso_init_textdomain();

			$info = WpssoUlConfig::$cf[ 'plugin' ][ 'wpssoul' ];

			$die_msg = __( '%1$s is an add-on for the %2$s plugin &mdash; please install and activate the %3$s plugin before activating %4$s.', 'wpsso-user-locale' );

			$error_msg = __( 'The %1$s add-on requires the %2$s plugin &mdash; install and activate the %3$s plugin or <a href="%4$s">deactivate the %5$s add-on</a>.', 'wpsso-user-locale' );

			if ( true === $deactivate ) {

				if ( ! function_exists( 'deactivate_plugins' ) ) {
					require_once trailingslashit( ABSPATH ) . 'wp-admin/includes/plugin.php';
				}

				deactivate_plugins( $info[ 'base' ], true );	// $silent is true

				wp_die( '<p>' . sprintf( $die_msg, $info[ 'name' ], $info[ 'req' ][ 'name' ], $info[ 'req' ][ 'short' ], $info[ 'short' ] ) . '</p>' );

			} else {

				$deactivate_url = html_entity_decode( wp_nonce_url( add_query_arg( array(
					'action'        => 'deactivate',
					'plugin'        => $info[ 'base' ],
					'plugin_status' => 'all',
					'paged'         => 1,
					's'             => '',
				), admin_url( 'plugins.php' ) ), 'deactivate-plugin_' . $info[ 'base' ] ) );

				echo '<div class="notice notice-error error"><p>';
				echo sprintf( $error_msg, $info[ 'name' ], $info[ 'req' ][ 'name' ], $info[ 'req' ][ 'short' ], $deactivate_url, $info[ 'short' ] );
				echo '</p></div>';
			}
		}

		public static function check_wp_version() {

			global $wp_version;

			if ( version_compare( $wp_version, self::$wp_min_version, '<' ) ) {

				$plugin = plugin_basename( __FILE__ );

				if ( is_plugin_active( $plugin ) ) {

					self::wpsso_init_textdomain();

					if ( ! function_exists( 'deactivate_plugins' ) ) {
						require_once trailingslashit( ABSPATH ) . 'wp-admin/includes/plugin.php';
					}

					$plugin_data = get_plugin_data( __FILE__, false );	// $markup is false

					deactivate_plugins( $plugin, true );	// $silent is true

					wp_die( 
						'<p>' . sprintf( __( '%1$s requires %2$s version %3$s or higher and has been deactivated.',
							'wpsso-user-locale' ), $plugin_data['Name'], 'WordPress', self::$wp_min_version ) . '</p>' . 
						'<p>' . sprintf( __( 'Please upgrade %1$s before trying to re-activate the %2$s plugin.',
							'wpsso-user-locale' ), 'WordPress', $plugin_data['Name'] ) . '</p>'
					);
				}
			}
		}

		public static function wpsso_init_textdomain() {
			load_plugin_textdomain( 'wpsso-user-locale', false, 'wpsso-user-locale/languages/' );
		}

		/**
		 * Checks the core plugin version and merges the extension / add-on config array.
		 */
		public function wpsso_get_config( $cf, $plugin_version = 0 ) {

			$info = WpssoUlConfig::$cf[ 'plugin' ][ 'wpssoul' ];

			if ( version_compare( $plugin_version, $info[ 'req' ][ 'min_version' ], '<' ) ) {
				$this->have_req_min = false;
				return $cf;
			}

			return SucomUtil::array_merge_recursive_distinct( $cf, WpssoUlConfig::$cf );
		}

		public function wpsso_get_avail( $avail ) {

			if ( ! $this->have_req_min ) {
				$avail['p_ext']['ul'] = false;	// Signal that this extension / add-on is not available.
				return $avail;
			}

			$avail['p_ext']['ul'] = true;		// Signal that this extension / add-on is available.

			return $avail;
		}

		/**
		 * Sets the $this->p reference variable for the core plugin instance.
		 */
		public function wpsso_init_options() {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}
		}

		public function wpsso_init_objects() {

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( ! $this->have_req_min ) {
				return;	// stop here
			}

			$this->filters = new WpssoUlFilters( $this->p );
			$this->locale  = new WpssoUlLocale( $this->p );
		}

		public function wpsso_init_plugin() {

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( ! $this->have_req_min ) {
				$this->min_version_notice();
				return;	// stop here
			}
		}

		private function min_version_notice() {

			$info = WpssoUlConfig::$cf[ 'plugin' ][ 'wpssoul' ];

			$error_msg = sprintf( __( 'The %1$s version %2$s add-on requires %3$s version %4$s or newer (version %5$s is currently installed).',
				'wpsso-user-locale' ), $info[ 'name' ], $info[ 'version' ], $info[ 'req' ][ 'short' ], $info[ 'req' ][ 'min_version' ],
					$this->p->cf[ 'plugin' ][ 'wpsso' ][ 'version' ] );

			if ( is_admin() ) {

				$this->p->notice->err( $error_msg );

				if ( method_exists( $this->p->admin, 'get_check_for_updates_link' ) ) {
					$this->p->notice->inf( $this->p->admin->get_check_for_updates_link() );
				}
			}
		}
	}

	WpssoUl::get_instance();
}
