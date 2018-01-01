<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2018 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoUlSubmenuUlGeneral' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoUlSubmenuUlGeneral extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {
			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$this->menu_id = $id;
			$this->menu_name = $name;
			$this->menu_lib = $lib;
			$this->menu_ext = $ext;	// lowercase acronyn for plugin or extension
		}

		// called by the extended WpssoAdmin class
		protected function add_meta_boxes() {
			add_meta_box( $this->pagehook.'_user_locale', 
				_x( 'User Locale Settings', 'metabox title', 'wpsso-user-locale' ),
				array( &$this, 'show_metabox_user_locale' ), $this->pagehook, 'normal' );
		}

		public function show_metabox_user_locale() {
			$metabox_id = 'ul';
			$key = 'general';
			$this->p->util->do_table_rows( apply_filters( $this->p->cf['lca'].'_'.$metabox_id.'_'.$key.'_rows', 
				$this->get_table_rows( $metabox_id, $key ), $this->form, false ), 'metabox-'.$metabox_id.'-'.$key );
		}

		protected function get_table_rows( $metabox_id, $key ) {
			$table_rows = array();
			switch ( $metabox_id.'-'.$key ) {
				case 'ul-general':

					$table_rows['ul_menu_icon'] = $this->form->get_th_html( _x( 'Toolbar Menu Icon',
						'option label', 'wpsso-user-locale' ), null, 'ul_menu_icon' ).
					'<td>'.$this->form->get_select( 'ul_menu_icon', 
						SucomUtil::get_dashicons( true, true ),	// sort by name and add 'none'
							'', '', true ).'</td>';

					$table_rows['ul_menu_title'] = $this->form->get_th_html( _x( 'Toolbar Menu Title',
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

