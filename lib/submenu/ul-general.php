<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
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

			$metabox_id      = 'user_locale';
			$metabox_title   = _x( 'User Locale Settings', 'metabox title', 'wpsso-user-locale' );
			$metabox_screen  = $this->pagehook;
			$metabox_context = 'normal';
			$metabox_prio    = 'default';
			$callback_args   = array(	// Second argument passed to the callback function / method.
			);

			add_meta_box( $this->pagehook . '_' . $metabox_id, $metabox_title,
				array( $this, 'show_metabox_user_locale' ), $metabox_screen,
					$metabox_context, $metabox_prio, $callback_args );
		}

		public function show_metabox_user_locale() {
			$metabox_id = 'ul';
			$tab_key = 'general';
			$this->p->util->do_metabox_table( apply_filters( $this->p->lca.'_'.$metabox_id.'_'.$tab_key.'_rows', 
				$this->get_table_rows( $metabox_id, $tab_key ), $this->form, false ), 'metabox-'.$metabox_id.'-'.$tab_key );
		}

		protected function get_table_rows( $metabox_id, $tab_key ) {

			$table_rows = array();

			switch ( $metabox_id.'-'.$tab_key ) {

				case 'ul-general':

					$table_rows['ul_menu_icon'] = $this->form->get_th_html( _x( 'Toolbar Menu Icon',
						'option label', 'wpsso-user-locale' ), null, 'ul_menu_icon' ).
					'<td>'.$this->form->get_select( 'ul_menu_icon', 
						SucomUtil::get_dashicons( true, true ),	// sort by name and add 'none'
							'', '', true ).'</td>';

					$table_rows[ 'ul_menu_title' ] = $this->form->get_th_html( _x( 'Toolbar Menu Title',
						'option label', 'wpsso-user-locale' ), null, 'ul_menu_title', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'ul_menu_title', $this->p->options ) ).'</td>';

					$table_rows['ul_front_end'] = $this->form->get_th_html( _x( 'Add User Locale on Front-End',
						'option label', 'wpsso-user-locale' ), '', 'ul_front_end' ).
					'<td>'.$this->form->get_checkbox( 'ul_front_end' ).'</td>';

					break;
			}

			return $table_rows;
		}
	}
}
