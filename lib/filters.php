<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2017-2021 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoUlFilters' ) ) {

	class WpssoUlFilters {

		private $p;	// Wpsso class object.
		private $a;     // WpssoUl class object.
		private $msgs;	// WpssoUlFiltersMessages class object.

		/**
		 * Instantiated by WpssoUl->init_objects().
		 */
		public function __construct( &$plugin, &$addon ) {

			static $do_once = null;

			if ( true === $do_once ) {

				return;	// Stop here.
			}

			$do_once = true;

			$this->p =& $plugin;
			$this->a =& $addon;

			$this->p->util->add_plugin_filters( $this, array( 
				'option_type' => 2,
			) );

			if ( is_admin() ) {

				require_once WPSSOUL_PLUGINDIR . 'lib/filters-messages.php';

				$this->msgs = new WpssoUlFiltersMessages( $plugin, $addon );
			}
		}

		/**
		 * Return the sanitation type for a given option key.
		 */
		public function filter_option_type( $type, $base_key ) {

			if ( ! empty( $type ) ) {	// Return early if we already have a type.

				return $type;

			} elseif ( 0 !== strpos( $base_key, 'ul_' ) ) {	// Nothing to do.

				return $type;
			}

			switch ( $base_key ) {

				case 'ul_menu_title':

					return 'not_blank';
			}

			return $type;
		}
	}
}
