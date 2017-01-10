<?php
/*
Plugin Name:		Kanban: Multiple Boards
Plugin URI:			http://kanbanwp.com/addons/multiple-boards
Description:		Run multiple boards on the same site. Each team can have their own board to manage different projects.
Tested up to:		4.7.0
Version:			1.0.10
Release Date:		December 7, 2016
Author:				Gelform Inc
Author URI:			http://gelwp.com
License:			GPL2
Text Domain:		kanban-multiple-boards
Domain Path: 		/languages/
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



class Kanban_Multiple_Boards {
	static $slug = '';
	static $friendlyname = '';
	static $plugin_basename = '';
	static $plugin_data;

	static $license;
	static $updates;

	static $options = array();


	protected static $table_name = 'boards';



	static function init() {
		self::$slug            = basename( __FILE__, '.php' );
		self::$plugin_basename = plugin_basename( __FILE__ );
		self::$friendlyname    = trim( str_replace( array( 'Kanban', '_' ), ' ', __CLASS__ ) );



		register_activation_hook( __FILE__, array( __CLASS__, 'check_for_core' ) );
		register_activation_hook( __FILE__, array( __CLASS__, 'on_activation' ) );
		add_action( 'wpmu_new_blog', array( __CLASS__, 'on_new_blog' ), 10, 6 );

		add_action( 'admin_init', array( __CLASS__, 'check_for_core' ) );

		// just in case
		if ( ! self::_is_parent_loaded() ) {
			return;
		}



		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		self::$plugin_data = get_plugin_data( __FILE__ );



		self::$license = new Kanban_Addon_License( __CLASS__ );

		self::$updates = new Kanban_Addon_Updates( __CLASS__ );



		add_filter(
			'kanban_option_get_defaults_return',
			array( __CLASS__, 'add_options_defaults' )
		);

		add_filter(
			'kanban_template_chooser_slugs',
			array( __CLASS__, 'add_css_js' )
		);

		add_filter(
			'kanban_settings_h1_after',
			array( __CLASS__, 'add_settings_title' )
		);

		add_filter(
			'kanban_page_modal_keyboard_shortcuts_after',
			array( __CLASS__, 'add_keyboard_shortcuts' )
		);

		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );

		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_js' ) );

		add_action( 'admin_init', array( __CLASS__, 'duplicate_board' ) );

		// add add-on settings to settings page
		// add_filter(
		// 	'kanban_settings_tabs_content',
		// 	array(__CLASS__, 'add_settings_tab_content')
		// );


		add_filter(
			'kanban_page_header_after',
			array( __CLASS__, 'add_board_tabs' )
		);


		add_filter(
			'kanban_page_boards_after',
			array( __CLASS__, 'add_modal_boards' )
		);


		add_filter(
			'kanban_page_footer_menu_before',
			array( __CLASS__, 'add_menu_before' )
		);

		add_filter(
			'kanban_page_footer_menu_dropup',
			array( __CLASS__, 'add_menu_dropup' )
		);

		// add_filter(
		// 	'kanban_card_id_dropdown',
		// 	array(__CLASS__, 'add_colors_to_card_dropdown')
		// );

		// add_filter(
		// 	'kanban_card_append',
		// 	array(__CLASS__, 'add_flag_to_card')
		// );

		// add_filter(
		// 	'kanban_task_get_all_return',
		// 	array(__CLASS__, 'add_to_tasks')
		// );

		// add_filter(
		// 	'kanban_board_filter_html',
		// 	array(__CLASS__, 'add_to_filter')
		// );

		// add_filter(
		// 	'kanban_board_query_vars',
		// 	array(__CLASS__, 'add_filter_to_board_settings')
		// );

		// add_action( 'wp_ajax_save_task_colors', array(__CLASS__, 'ajax_save') );

		add_filter(
			'kanban_task_move_modal_header',
			array( __CLASS__, 'add_boards_to_move_task_modal' ),
			10,
			2
		);

		add_filter(
			'kanban_task_move_modal_footer',
			array( __CLASS__, 'add_board_statuses_to_move_task_modal' ),
			10,
			2
		);

		add_action( 'init', array( __CLASS__, 'save_boards' ) );
	}



	// static function add_filter_to_board_settings ($settings)
	// {
	// 	$settings->filters['colors'] = (object) array();

	// 	return $settings;
	// }


	// static function add_to_filter ($html)
	// {
	// 	$colors = Kanban_Option::get_option('task_colors');
	// 	$colors = Kanban_Utils::build_array_with_id_keys($colors);

	// 	$html_output = Kanban_Template::render_template(
	// 		sprintf('%s/templates/t-filter.php', plugin_dir_path(__FILE__)),
	// 		array(
	// 			'colors' => $colors
	// 		)
	// 	);

	// 	return $html . $html_output;
	// }



	static function add_board_tabs( $val ) {
		global $wp_query;

		$html_output = Kanban_Template::render_template(
			sprintf( '%s/templates/board-tabs.php', plugin_dir_path( __FILE__ ) ),
			array(
				'boards'        => $wp_query->query_vars[ 'kanban' ]->boards,
				'current_board' => $wp_query->query_vars[ 'kanban' ]->boards[ $wp_query->query_vars[ 'kanban' ]->current_board_id ]
			)
		);

		return $val . $html_output;
	}



	static function add_modal_boards( $val ) {
		global $wp_query;


		$html_output = Kanban_Template::render_template(
			sprintf( '%s/templates/modal-boards.php', plugin_dir_path( __FILE__ ) ),
			array(
				'boards'        => $wp_query->query_vars[ 'kanban' ]->boards,
				'current_board' => $wp_query->query_vars[ 'kanban' ]->boards[ $wp_query->query_vars[ 'kanban' ]->current_board_id ]
			)
		);

		return $val . $html_output;
	}



	/**
	 * Adds select to top of modal for switching boards.
	 *
	 * @param $val Previous html.
	 * @param $board_id Current board id.
	 *
	 * @return string Html to be added.
	 */
	static function add_boards_to_move_task_modal( $val, $board_id ) {

		$boards = Kanban_Board::get_all();

		$html_output = Kanban_Template::render_template(
			sprintf( '%s/templates/board-modal-move-task-header.php', plugin_dir_path( __FILE__ ) ),
			array(
				'board_id' => $board_id,
				'boards' => $boards
			)
		);

		return $val . $html_output;
	}



	/**
	 * Adds statuses from additional boards.
	 *
	 * @param $val Previous html.
	 * @param $board_id Current board id.
	 *
	 * @return string Html to be added.
	 */
	static function add_board_statuses_to_move_task_modal( $val, $board_id ) {

		$boards = Kanban_Board::get_all();

		// Don't need to add current board again.
		unset($boards[$board_id]);

		foreach ($boards as &$board) {
			$board->statuses = Kanban_Status::get_all($board->id);
		}

		$html_output = Kanban_Template::render_template(
			sprintf( '%s/templates/board-modal-move-task-footer.php', plugin_dir_path( __FILE__ ) ),
			array(
				'board_id' => $board_id,
				'boards' => $boards
			)
		);

		return $val . $html_output;
	}



	static function add_menu_before( $val ) {
		$html_output = Kanban_Template::render_template(
			sprintf( '%s/templates/board-footer-menu-before.php', plugin_dir_path( __FILE__ ) )
		);

		return $val . $html_output;
	}



	static function add_menu_dropup( $val ) {
		$html_output = Kanban_Template::render_template(
			sprintf( '%s/templates/board-footer-menu-dropup.php', plugin_dir_path( __FILE__ ) )
		);

		return $val . $html_output;
	}


	static function add_css_js( $slugs ) {
		$script = sprintf(
			'%scss/board.css',
			plugin_dir_url( __FILE__ )
		);

		$slugs[ 'board' ][ 'style' ][ 'multiple-boards' ] = $script;


		$script = sprintf(
			'%sjs/min/board-min.js',
			plugin_dir_url( __FILE__ )
		);

		$new_scripts = array();
		foreach ( $slugs[ 'board' ][ 'script' ] as $key => $value ) {
			// rebuild array
			$new_scripts[ $key ] = $value;

			// add task colors
			if ( $key == 't' ) {
				$new_scripts[ 'multiple-boards' ] = $script;
			}
		}

		$slugs[ 'board' ][ 'script' ] = $new_scripts;


		return $slugs;
	}


	static function add_keyboard_shortcuts( $val ) {
		$html_output = Kanban_Template::render_template(
			sprintf( '%s/templates/board-modal-keyboard-shortcuts.php', plugin_dir_path( __FILE__ ) )
		);

		return $val . $html_output;

	}



	static function admin_menu() {

		add_submenu_page(
			'kanban',
			'Boards',
			'Boards',
			'manage_options',
			'kanban_boards',
			array( __CLASS__, 'boards_page' )
		);
	}



	static function boards_page() {
		$boards = Kanban_Board::get_all();

		$html_output = Kanban_Template::render_template(
			sprintf( '%s/templates/admin-page-boards.php', plugin_dir_path( __FILE__ ) ),
			array(
				'boards'          => $boards,
				'current_board'   => Kanban_Board::get_current_by( 'GET' ),
				'plugin_dir_path' => plugin_dir_path( __FILE__ )
			)
		);

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-sortable' );

		wp_enqueue_script(
			't',
			sprintf( '%s/js/min/t-min.js', Kanban::get_instance()->settings->uri ),
			array()
		);


		wp_enqueue_script(
			'kanban-settings',
			sprintf( '%s/js/admin-settings.js', Kanban::get_instance()->settings->uri ),
			array( 'wp-color-picker' ),
			false,
			true
		);


//		wp_enqueue_script(
//			'kanban-settings',
//			sprintf( '%s/js/min/admin-settings-min.js', Kanban::get_instance()->settings->uri ),
//			array( 'wp-color-picker' ),
//			false,
//			true
//		);


		echo $html_output;
	}


	static function enqueue_js( $hook ) {
		if ( ! is_admin() || ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] != 'kanban_settings' ) ) {
			return;
		}

		wp_enqueue_script(
			'kanban-settings-boards',
			sprintf( '%s/js/min/admin-settings-min.js', plugin_dir_url( __FILE__ ) ),
			array()
		);
	}


	static function save_boards() {
		if ( ! isset( $_POST[ Kanban_Utils::get_nonce() ] ) || ! wp_verify_nonce( $_POST[ Kanban_Utils::get_nonce() ], 'kanban-boards' ) || ! is_user_logged_in() ) {
			return;
		}



		$boards    = Kanban_Board::get_all();
		$board_ids = array_keys( $boards );



		// any boards to delete?
		if ( isset( $_POST[ 'boards' ][ 'saved' ] ) ) {
			$deleted_boards = array_diff( $board_ids, array_keys( $_POST[ 'boards' ][ 'saved' ] ) );

			if ( ! empty( $deleted_boards ) ) {
				foreach ( $deleted_boards as $key => $id ) {
					Kanban_Board::delete( array( 'id' => $id ) );
				}
			}
		}


		// add new boards first
		if ( isset( $_POST[ 'boards' ][ 'new' ] ) ) {

			foreach ( $_POST[ 'boards' ][ 'new' ] as $board ) {
				// don't save if there's no title
				if ( empty( $board[ 'title' ] ) ) {
					continue;
				}


				$board[ 'created_dt_gmt' ]  = date( 'Y-m-d H:i:s' );
				$board[ 'modified_dt_gmt' ] = date( 'Y-m-d H:i:s' );
				$board[ 'user_id_author' ]  = get_current_user_id();

				// save it
				$success = Kanban_Board::replace( $board );

				if ( $success ) {
					$board_id = Kanban_Board::insert_id();

					// add it to all the boards to save
					$_POST[ 'boards' ][ 'saved' ][ $board_id ] = $board;

					// add current user
					Kanban_Option::update_option( 'allowed_users', array( get_current_user_id() ), $board_id );
				}
			}
		}


		// now save all boards with positions
		if ( isset( $_POST[ 'boards' ][ 'saved' ] ) ) {
			foreach ( $_POST[ 'boards' ][ 'saved' ] as $board_id => $board ) {
				$board[ 'id' ]              = $board_id;
				$board[ 'modified_dt_gmt' ] = date( 'Y-m-d H:i:s' );

				Kanban_Board::replace( $board );
			}
		}


		$url = add_query_arg(
			array(
				'message' => urlencode( __( 'Boards saved', 'kanban' ) )
			),
			$_POST[ '_wp_http_referer' ]
		);

		wp_redirect( $url );
		exit;

	}


	static function duplicate_board() {
		if ( ! is_admin() ) {
			return;
		}

		if ( ! isset( $_GET[ 'board_id' ] ) || ! isset( $_GET[ 'kanban-action' ] ) || ! wp_verify_nonce( $_GET[ 'kanban-action' ], 'kanban_boards_copy' ) ) {
			return;
		}



		$board_id_old = intval( sanitize_text_field( $_GET[ 'board_id' ] ) );


		global $wpdb;



		$table_name_boards = Kanban_Board::table_name();

		// Get board record.
		$board_record = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name_boards WHERE id = %d;",
				$board_id_old
			),
			ARRAY_A
		);



		// Update board record.
		unset( $board_record[ 'id' ] );

		$board_record[ 'title' ]           = sprintf( '%s COPY', $board_record[ 'title' ] );
		$board_record[ 'created_dt_gmt' ]  = Kanban_Utils::mysql_now_gmt();
		$board_record[ 'modified_dt_gmt' ] = Kanban_Utils::mysql_now_gmt();



		// Add new board.
		$wpdb->insert( $table_name_boards, $board_record );

		$board_id_new = $wpdb->insert_id;



		// copy statuses
		$table_name_status = Kanban_Status::table_name();

		$wpdb->query(
			$wpdb->prepare(
				"
				INSERT INTO $table_name_status
				( 
					board_id
					, title
					, color_hex
					, wip_task_limit
					, position
				)
				SELECT 
					%d -- new value
					, title
					, color_hex
					, wip_task_limit
					, position
				FROM $table_name_status 
				WHERE board_id = %d
				;",
				$board_id_new,
				$board_id_old
			)
		);



		// copy estimates
		$table_name_estimate = Kanban_Estimate::table_name();

		$wpdb->query(
			$wpdb->prepare(
				"
				INSERT INTO $table_name_estimate
				( 
					board_id
					, title
					, hours
					, position
				)
				SELECT 
					%d -- new value
					, title
					, hours
					, position
				FROM $table_name_estimate 
				WHERE board_id = %d
				;",
				$board_id_new,
				$board_id_old
			)
		);



		// copy projects
		$table_name_project = Kanban_Project::table_name();

		$wpdb->query(
			$wpdb->prepare(
				"
				INSERT INTO $table_name_project
				( 
					board_id
					, title
					, description
					, user_id_author
					, created_dt_gmt
					, modified_dt_gmt
					, modified_user_id
					, is_active
				)
				SELECT 
					%d -- new value
					, title
					, description
					, user_id_author
					, created_dt_gmt
					, modified_dt_gmt
					, modified_user_id
					, is_active
				FROM $table_name_project 
				WHERE board_id = %d
				;",
				$board_id_new,
				$board_id_old
			)
		);



		// copy settings
		$table_name_option = Kanban_Option::table_name();

		$wpdb->query(
			$wpdb->prepare(
				"
				INSERT INTO $table_name_option
				( 
					board_id
					, name
					, value
				)
				SELECT 
					%d -- new value
					, name
					, value
				FROM $table_name_option 
				WHERE board_id = %d
				;",
				$board_id_new,
				$board_id_old
			)
		);



		// copy tasks?


		// hook to copy fields



		wp_redirect(
			add_query_arg(
				array(
					'page' => 'kanban_boards'
				),
				admin_url( 'admin.php' )
			)
		);
	}


	static function add_settings_title( $val ) {
		$boards = Kanban_Board::get_all();

		$html_output = Kanban_Template::render_template(
			sprintf( '%s/templates/admin-title.php', plugin_dir_path( __FILE__ ) ),
			array(
				'boards'        => $boards,
				'current_board' => Kanban_Board::get_current()
			)
		);

		return $val . $html_output;
	}



	/**
	 * On activation, run the single activation across all blogs.
	 * @link http://shibashake.com/wordpress-theme/write-a-plugin-for-wordpress-multi-site
	 *
	 * @param bool $network_wide If plugin is being used across the multisite.
	 */
	public static function on_activation( $networkwide ) {
		global $wpdb;

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			// Check if it is a network activation - if so, run the activation function for each blog id.
			if ( $networkwide ) {

				$old_blog = $wpdb->blogid;

				// Get all blog ids.
				$blogids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

				foreach ( $blogids as $blog_id ) {
					switch_to_blog( $blog_id );

					// Activate based on switched-to blog.
					self::single_activation();
				}

				// Switch back to previous.
				switch_to_blog( $old_blog );

			} else {
				self::single_activation();
			}
		} else {
			self::single_activation();
		}

	}



	/**
	 * Functions to do on single blog activation, like update db.
	 */
	static function single_activation() {
	}



	/**
	 * Functions to do on single blog activation, like remove db option.
	 */
	static function on_deactivation() {
	}



	static function on_new_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
		global $wpdb;

		$old_blog = $wpdb->blogid;
		switch_to_blog( $blog_id );
		self::single_activation();
		switch_to_blog( $old_blog );
	}



	static function add_options_defaults( $defaults ) {
		return array_merge( $defaults, self::$options );
	}



	public static function check_for_core() {
		if ( self::_is_parent_loaded() ) {
			return true;
		}

		deactivate_plugins( plugin_basename( __FILE__ ) );
		add_action( 'admin_notices', array( __CLASS__, 'admin_deactivate_notice' ) );
	}



	static function admin_deactivate_notice() {
		if ( ! is_admin() ) {
			return;
		}
		?>
		<div class="error below-h2">
			<p>
				<?php
				echo sprintf(
					__( 'Whoops! This plugin %s requires the <a href="https://wordpress.org/plugins/kanban/" target="_blank">Kanban for WordPress</a> plugin.
	            		Please make sure it\'s installed and activated.'
					),
					self::$friendlyname
				);
				?>
			</p>
		</div>
		<?php
	}



	static function _is_parent_loaded() {
		return class_exists( 'Kanban' );
	}



	static function _is_parent_activated() {

		if ( is_multisite() ) {
			$active_plugins_basenames = get_site_option( 'active_sitewide_plugins' );

			if ( ! empty( $active_plugins_basenames ) ) {
				$active_plugins_basenames = array_keys( $active_plugins_basenames );
			}
		} else {
			$active_plugins_basenames = get_option( 'active_plugins' );
		}

		foreach ( $active_plugins_basenames as $plugin_basename ) {
			if ( false !== strpos( $plugin_basename, '/kanban.php' ) ) {
				return true;
			}
		}

		return false;
	}



}



function kanban_multiple_boards_addon() {
	Kanban_Multiple_Boards::init();
}



if ( Kanban_Multiple_Boards::_is_parent_loaded() ) {
	// If parent plugin already included, init add-on.
	kanban_multiple_boards_addon();
} else if ( Kanban_Multiple_Boards::_is_parent_activated() ) {
	// Init add-on only after the parent plugins is loaded.
	add_action( 'kanban_loaded', 'kanban_multiple_boards_addon' );
} else {
	// Even though the parent plugin is not activated, execute add-on for activation / uninstall hooks.
	kanban_multiple_boards_addon();
}
