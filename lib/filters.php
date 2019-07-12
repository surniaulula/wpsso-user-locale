<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2017-2019 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoUlFilters' ) ) {

	class WpssoUlFilters {

		private $p;

		public function __construct( &$plugin ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( is_admin() ) {
				$this->p->util->add_plugin_filters( $this, array( 
					'option_type'      => 2,	// define the value type for each option
					'messages_tooltip' => 2,	// tooltip messages filter
				) );
			}
		}

		public function filter_option_type( $type, $base_key ) {

			if ( ! empty( $type ) ) {
				return $type;
			} elseif ( strpos( $base_key, 'ul_' ) !== 0 ) {
				return $type;
			}

			switch ( $base_key ) {

				case 'ul_menu_title':

					return 'not_blank';

					break;
			}

			return $type;
		}

		public function filter_messages_tooltip( $text, $msg_key ) {

			if ( strpos( $msg_key, 'tooltip-ul_' ) !== 0 ) {
				return $text;
			}

			switch ( $msg_key ) {

				case 'tooltip-ul_menu_icon':	// Toolbar Menu Icon

					$text = __( 'An icon to prefix the title string used in the WordPress toolbar menu (uses the "translation" icon by default). Select "[None]" to disable the toolbar menu icon.', 'wpsso-user-locale' );

					break;

				case 'tooltip-ul_menu_title':	// Toolbar Menu Title

					$text = __( 'The title string used in the WordPress toolbar menu. The "%s" parameter is replaced by the current user locale value (example: "User Locale (%s)").', 'wpsso-user-locale' );

					break;

				case 'tooltip-ul_front_end':	// Add User Locale on Front-End

					$text = __( 'Add the user locale selector to the front-end toolbar menu, and define current WordPress locale as the user locale value.', 'wpsso-user-locale' );

					break;
			}

			return $text;
		}
	}
}
