<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       hetal.rathod@bytestechnolab.in
 * @since      1.0.0
 *
 * @package    Load_more
 * @subpackage Load_more/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Load_more
 * @subpackage Load_more/includes
 * @author     hetal rathod <hetal.rathod@bytestechnolab.in>
 */
class Load_more {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Load_more_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'LOAD_MORE_VERSION' ) ) {
			$this->version = LOAD_MORE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'load_more';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Load_more_Loader. Orchestrates the hooks of the plugin.
	 * - Load_more_i18n. Defines internationalization functionality.
	 * - Load_more_Admin. Defines all hooks for the admin area.
	 * - Load_more_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-load_more-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-load_more-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-load_more-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-load_more-public.php';

		$this->loader = new Load_more_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Load_more_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Load_more_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Load_more_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'style-css' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Load_more_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'custom-js');

		$this->loader->add_action('wp_ajax_nopriv_category_filter_blog', $plugin_public, 'category_filter_blog');
       $this->loader->add_action('wp_ajax_category_filter_blog', $plugin_public, 'category_filter_blog');



	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Load_more_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}



function loadmore_display(){?>
<style type="text/css">
	*{
		text-transform: <?php echo get_option('post_transform');?>
	}
</style>
<section>
 	<div class="container" style="background-color:<?php echo get_option('color_id');?>">
    	<div class="row">
     		<div class="post-detail"> 
        		<div class="filter-list">
			          <ul class="filter-tab">
			              <li class="active"><a href="javascript:void(0);" data-id="all" >All Categories</a> </li>
			           <?php
			           $post_id=get_option('post_id');
			           $select_option=get_option('layout_name');
			           
			           $terms =get_object_taxonomies($post_id);         
			           
			           $term_arg = get_terms( array(
			                'taxonomy' =>  $terms,
			                'hide_empty' => false,
			            ) );
			          
			             foreach($term_arg as $term) { ?>

			                <li><a href="javascript:void(0);" data-id="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
			               <?php   } ?>  
			                   
			          </ul>
        		</div>
       
          		<div class="recent-wrapper">
            			<div class="post-listing filter-listing">
                     
	                       <?php
	                       $paged = 1;
	                       $post_per_page = 4;
	                        $the_query = new WP_Query(array(
	                            'post_type'      => $post_id,
	                            'posts_per_page' => 4,
	                            'order'          => 'ASC',
	                            'paged'          => $paged,
	                        ));     
	                        $total_args = array(
	                          /*  'suppress_filters' => true,*/
	                            'post_type'      => $post_id,
	                            'posts_per_page' => -1,   
	                            'order'          => 'ASC',
	                        );
	                           $loadedArticle = $paged * $post_per_page;
		                        $totalArticle = count(get_posts($total_args));
		                        $allloaded = false;
		                        if($totalArticle <= $post_per_page ){
		                            $allloaded = true;
		                        }
			                                          
	                        while ( $the_query->have_posts() ) : 
	                        $the_query->the_post();?>
	                           <div class="post-box filter-item <?php echo $select_option;?>" data-filter="<?php echo $term->slug; ?>">
	                        
	                            <h2><?php  the_title();?></h2>
	                            <p><?php the_content(); ?></p>
	                          </div> 
	                       <?php   endwhile;  ?>           
	                      
	                  	</div>
                </div>
       
		       	 <?php if(!$allloaded): ?>
				    <div class="more-videos text-center">
				      <button id="load_more" class="theme-button" data-num=1><?php echo get_option('btn_name');?></button>  
				    </div>    
				  <?php endif; ?>
 			 </div> 
 		</div>
 	</div>
</section>

<?php
}
add_shortcode( 'custom_category_filter', 'loadmore_display' );