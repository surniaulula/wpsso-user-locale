<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2017-2024 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoUlFilters' ) ) {

	class WpssoUlFilters {

		private $p;	// Wpsso class object.
		private $a;	// WpssoUl class object.
		private $msgs;	// WpssoUlFiltersMessages class object.
		private $opts;	// WpssoUlFiltersOptions class object.

		/*
		 * Instantiated by WpssoUl->init_objects().
		 */
		public function __construct( &$plugin, &$addon ) {

			static $do_once = null;

			if ( $do_once ) return;	// Stop here.

			$do_once = true;

			$this->p =& $plugin;
			$this->a =& $addon;

			require_once WPSSOUL_PLUGINDIR . 'lib/filters-options.php';

			$this->opts = new WpssoUlFiltersOptions( $plugin, $addon );

			if ( is_admin() ) {

				require_once WPSSOUL_PLUGINDIR . 'lib/filters-messages.php';

				$this->msgs = new WpssoUlFiltersMessages( $plugin, $addon );
			}
		}
	}
}
