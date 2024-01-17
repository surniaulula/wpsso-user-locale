<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2017-2024 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoUlSubmenuUserLocale' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoUlSubmenuUserLocale extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$this->menu_id   = $id;
			$this->menu_name = $name;
			$this->menu_lib  = $lib;
			$this->menu_ext  = $ext;

			$this->menu_metaboxes = array(
				'settings' => _x( 'User Locale Settings', 'metabox title', 'wpsso-user-locale' ),
			);
		}

		protected function get_table_rows( $page_id, $metabox_id, $tab_key = '', $args = array() ) {

			$table_rows = array();
			$match_rows = trim( $page_id . '-' . $metabox_id . '-' . $tab_key, '-' );

			switch ( $match_rows ) {

				case 'user-locale-settings':

					$table_rows[ 'ul_menu_icon' ] = '' .
						$this->form->get_th_html( _x( 'Toolbar Menu Icon', 'option label', 'wpsso-user-locale' ),
							$css_class = '', $css_id = 'ul_menu_icon' ) .
						'<td>' . $this->form->get_select( 'ul_menu_icon', SucomUtil::get_dashicons(),
							$css_class = '', $css_id = '', $is_assoc = true ) . '</td>';

					$table_rows[ 'ul_menu_title' ] = '' .
						$this->form->get_th_html_locale( _x( 'Toolbar Menu Title', 'option label', 'wpsso-user-locale' ),
							$css_class = '', $css_id = 'ul_menu_title' ) .
						'<td>' . $this->form->get_input_locale( 'ul_menu_title' ) . '</td>';

					$table_rows[ 'ul_front_end' ] = '' .
						$this->form->get_th_html( _x( 'User Locale on Front-End', 'option label', 'wpsso-user-locale' ),
							$css_class = '', $css_id = 'ul_front_end' ) .
						'<td>' . $this->form->get_checkbox( 'ul_front_end' ) . '</td>';

					break;
			}

			return $table_rows;
		}
	}
}
