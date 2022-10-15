<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2022 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoUlSubmenuUlGeneral' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoUlSubmenuUlGeneral extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$this->menu_id   = $id;
			$this->menu_name = $name;
			$this->menu_lib  = $lib;
			$this->menu_ext  = $ext;
		}

		/**
		 * Called by the extended WpssoAdmin class.
		 */
		protected function add_meta_boxes() {

			$metabox_id      = 'ul';
			$metabox_title   = _x( 'User Locale Settings', 'metabox title', 'wpsso-user-locale' );
			$metabox_screen  = $this->pagehook;
			$metabox_context = 'normal';
			$metabox_prio    = 'default';
			$callback_args   = array(	// Second argument passed to the callback function / method.
			);

			add_meta_box( $this->pagehook . '_' . $metabox_id, $metabox_title,
				array( $this, 'show_metabox_' . $metabox_id ), $metabox_screen,
					$metabox_context, $metabox_prio, $callback_args );
		}

		public function show_metabox_ul() {

			$metabox_id = 'ul';

			$tab_key = 'general';

			$filter_name = SucomUtil::sanitize_hookname( 'wpsso_' . $metabox_id . '_' . $tab_key . '_rows' );

			$table_rows = $this->get_table_rows( $metabox_id, $tab_key );

			$table_rows = apply_filters( $filter_name, $table_rows, $this->form, $network = false );

			$this->p->util->metabox->do_table( $table_rows, 'metabox-' . $metabox_id . '-' . $tab_key );
		}

		protected function get_table_rows( $metabox_id, $tab_key ) {

			$table_rows = array();

			switch ( $metabox_id . '-' . $tab_key ) {

				case 'ul-general':

					$dashicons = SucomUtil::get_dashicons( $icon_number = true, $add_none = true );

					$table_rows[ 'ul_menu_icon' ] = '' .
						$this->form->get_th_html( _x( 'Toolbar Menu Icon', 'option label', 'wpsso-user-locale' ),
							$css_class = '', $css_id = 'ul_menu_icon' ) .
						'<td>' . $this->form->get_select( 'ul_menu_icon', $dashicons,
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
