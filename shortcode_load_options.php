<?php

Class ShortcodeLoad_Options {

	function __construct() {
		add_action( 'admin_menu', array($this, 'shortcode_load_add_admin_menu') );
		add_action( 'admin_init', array($this, 'shortcode_load_settings_init') );
	}

	function shortcode_load_add_admin_menu(  ) { 

		add_options_page( 'Shortcode Load', 'Shortcode Load', 'manage_options', 'shortcode_load', array($this, 'shortcode_load_options_page') );

	}

	function shortcode_load_settings_init(  ) {

		if ( ! current_user_can('update_plugins') )
			return;

		/* Default settings section */

		add_settings_section( 
			'shortcode_load_default',
			'Default Settings',
			array($this, 'shortcode_load_default_options_callback'),
			'shortcode_load_default_options'
		);
		add_settings_field(
			'shortcode_load_default_text',
			'Default Settings Field',
			array($this, 'shortcode_load_default_text_callback'),
			'shortcode_load_default_options',
			'shortcode_load_default'
		);

		register_setting('shortcode_load_default_options', 'shortcode_load_default_options');

		/* New script section */

		add_settings_section( 
			'shortcode_load_new_script',
			'New Script Settings',
			array($this, 'shortcode_load_new_script_options_callback'),
			'shortcode_load_new_script_options'
		);
		add_settings_field(
			'shortcode_load_default_text',
			'Script Content Field',
			array($this, 'shortcode_load_new_script_textarea_callback'),
			'shortcode_load_new_script_options',
			'shortcode_load_new_script'
		);

		register_setting('shortcode_load_new_script_options', 'shortcode_load_new_script_options');

		/* New style section */

		add_settings_section( 
			'shortcode_load_new_style',
			'New Style Settings',
			array($this, 'shortcode_load_new_style_options_callback'),
			'shortcode_load_new_style_options'
		);
		add_settings_field(
			'shortcode_load_default_text',
			'Style Content Field',
			array($this, 'shortcode_load_new_style_textarea_callback'),
			'shortcode_load_new_script_options',
			'shortcode_load_new_script'
		);

		register_setting('shortcode_load_new_style_options', 'shortcode_load_new_style_options');

	}

	/* Default tab callbacks */
	function shortcode_load_default_options_callback() {
		echo '<p>Default Options:</p>'; 
	}	

	function shortcode_load_default_text_callback() {
		echo '<p>This is some default text</p>'; 
	}

	/* New script tab callbacks */

	function shortcode_load_new_script_options_callback() {
		echo '<p>New script callback</p>';
	}

	function shortcode_load_new_script_textarea_callback() {
		echo '<p>New script textarea callback</p>';
	}

	/* New style tab callbacks */

	function shortcode_load_new_style_options_callback() {
		echo '<p>New style callback</p>';
	}

	function shortcode_load_new_style_textarea_callback() {
		echo '<p>New style textarea callback</p>';
	}

	function shortcode_load_options_page(  ) { 
		if( isset( $_GET[ 'tab' ] ) ) {  
			$active_tab = $_GET[ 'tab' ];  
		} else {
			$active_tab = 'tab_one';
		}

		?>
		<div class="wrap">
			<h2 class="nav-tab-wrapper">
				<a href="?page=<?php echo self::slug; ?>&amp;tab=tab_one" class="nav-tab">Default Options</a>
				<a href="?page=<?php echo self::slug; ?>&amp;tab=tab_two" class="nav-tab">New Script</a>
				<a href="?page=<?php echo self::slug; ?>&amp;tab=tab_three" class="nav-tab">New Style</a>
			</h2>

			<form action='options.php' method='post'>
				
				<h2>Shortcode Load</h2>
				
				<?php

				if($active_tab == 'tab_one') {
					settings_fields( 'shortcode_load_default_options' );
					do_settings_sections( 'shortcode_load_default_options' );
				} elseif($active_tab == 'tab_two') {
					settings_fields( 'shortcode_load_new_script_options' );
					do_settings_sections( 'shortcode_load_new_script_options' );
				} elseif($active_tab == 'tab_three') {
					settings_fields( 'shortcode_load_new_style_options' );
					do_settings_sections( 'shortcode_load_new_style_options' );
				}
				submit_button();
				?>
				
			</form>
		</div><!-- ./wrap -->
		<?php

	}
}

?>