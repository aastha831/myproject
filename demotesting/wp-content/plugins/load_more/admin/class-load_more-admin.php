<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       hetal.rathod@bytestechnolab.in
 * @since      1.0.0
 *
 * @package    Load_more
 * @subpackage Load_more/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Load_more
 * @subpackage Load_more/admin
 * @author     hetal rathod <hetal.rathod@bytestechnolab.in>
 */
class Load_more_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('admin_menu', array( $this, 'addPluginAdminMenu' ), 9);  
		add_action('admin_init', array( $this, 'demo_settings_page'));
		add_action('admin_init', array( $this, 'layout_setting_page'));  

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Load_more_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Load_more_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/load_more-admin.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'main-css', plugin_dir_url( __FILE__ ) . 'css/main.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Load_more_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Load_more_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/load_more-admin.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( 'main-js',plugin_dir_url( __FILE__ ) . 'js/main.js', array( 'jquery' ), $this->version, false );

	}

	public function addPluginAdminMenu() {
		add_menu_page(  $this->plugin_name, 'LoadMore Filter', 'administrator', $this->plugin_name, array( $this, 'displayPluginAdminDashboard' ), 'dashicons-chart-area', 26 );
		//add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		add_submenu_page( $this->plugin_name, 'Shortcodes', 'Shortcodes', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayPluginAdminSettings' ));

		add_submenu_page( $this->plugin_name, 'Layoutsetting', 'Layoutsetting', 'administrator', $this->plugin_name.'settings', array( $this, 'displayPluginLayoutDashboard' ));
	}


	public function displayPluginAdminDashboard() {?>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("check");
 
               do_settings_sections("Load_more");
                 
               submit_button();
            ?>
         </form>
 <?php  
  }

    public function displayPluginLayoutDashboard() {?>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("layout");
 
               do_settings_sections("Layoutsetting");
                 
               submit_button();
            ?>
         </form>
 <?php  
  }


    public function displayPluginAdminSettings() {?>
		 <form method="post" action="options.php">
            <?php
               settings_fields("sub");
 
               do_settings_sections("Shortcodes");
                
            ?>
         </form>
	<?php}


function test()	{
	add_settings_section('sub','Shortcodes','display_head','Shortcodes');

    add_settings_field("category", "Shortcodes", array($this,'display_shortcode'), 'Shortcodes', "sub");  
    register_setting("sub", "category");
    
}
function display_head()
 {

 	echo "Shortcodes";

 }


function display_shortcode()
{
   ?>
   		<label for="Category" name="category" >Category <b><p>[custom_category_filter]</p></b></label>
   		 
     	<?php
 }
function demo_settings_page()
{
	add_settings_section('check','Section',null,'Load_more');
	add_settings_field("post_id", "Post Type",array($this,'demo_checkbox_display'), 'Load_more', "check");  
	add_settings_field("btn_id", "Advance Class",array($this,'advance_class_add'), 'Load_more', "check"); 
   
    add_settings_field("btn_name", "Load More Button Name",array($this,'loadmore_button_advance'), 'Load_more', "check"); 
    
   
     register_setting("check", "post_id");
     register_setting("check", "btn_id");    
     register_setting("check", "btn_name");
    
}


function layout_setting_page()
 {
 	add_settings_section('layout','Section',null,'Layoutsetting');

 	add_settings_field("layout", "Layout of Template",array($this,'display_layout'),'Layoutsetting', "layout");

 	add_settings_field("color_id", "Background Color",array($this,'Background_color'), 'Layoutsetting', "layout"); 

 	add_settings_field("post_transform", "Text Transfrom",array($this,'fontfamilylayout'), 'Layoutsetting', "layout");

 	register_setting("layout", "layout_name");
 	register_setting("layout", "color_id");
 	register_setting("layout", "post_transform");
 }

 
function demo_checkbox_display()
{
   ?>
  <select name="post_id" id="post_id">
  	<?php
			global $post;
		   $args = array(
			'public'   => true,
			);
		    $cpost_types = get_post_types($args);
			$taxonomies=get_object_taxonomies($cpost_types);
			
			foreach ($cpost_types as $post_type ){?>
		     <option value="<?php echo $post_type;?>"<?php selected(get_option('post_id'),$post_type);?>><?php echo $post_type; ?></option>
		  <?php  }?>
 </select>

 <?php
 }
 function advance_class_add()
	{?>
		 <input type="text" name="btn_id" id="btn_id" value="<?php echo get_option('btn_id'); ?>">

	<?php
	}

	function loadmore_button_advance()
	{?>
 	   <input type="text" name="btn_name" id="btn_name" value="<?php echo get_option('btn_name'); ?>">
	<?php
  }

  function display_layout(){?>
    		
        <select class="layout" id="layout_name" name="layout_name">
            <option value="two-column"<?php selected(get_option('layout_name'),'two-column'); ?>>2column</option>
            <option value="three-column"<?php selected(get_option('layout_name'),'three-column'); ?>>3column</option>
            <option value="four-column"<?php selected(get_option('layout_name'),'four-column'); ?>>4column </option>
        </select>
   <?php
	}
	function Background_color()
	{?>
		 <input type="color" name="color_id" id="color_id" value="<?php echo get_option('color_id'); ?>">

	<?php
	}
	function fontfamilylayout(){?>
    <select class="form-control caf_import" data-import="caf_post_title_transform" id="post_transform" name="post_transform">
		<option value="uppercase" <?php selected(get_option('post_transform'),'uppercase'); ?>>Uppercase</option>
		<option value="capitalize" <?php selected(get_option('post_transform'),'capitalize'); ?> selected="">Capitalize</option>
		<option value="lowercase" <?php selected(get_option('post_transform'),'lowercase'); ?>>Lowercase</option>
    </select>
	<?php }
}

 
