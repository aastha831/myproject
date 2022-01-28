<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       hetal.rathod@bytestechnolab.in
 * @since      1.0.0
 *
 * @package    Load_more
 * @subpackage Load_more/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Load_more
 * @subpackage Load_more/public
 * @author     hetal rathod <hetal.rathod@bytestechnolab.in>
 */
class Load_more_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/load_more-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'style-css', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/load_more-public.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( 'custom-js',plugin_dir_url( __FILE__ ) . 'js/custom.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( 'custom-js', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}


function category_filter_blog(){
  $cat_id =$_POST['category'];
 

  $post_id = get_option('post_id');
  $select_option=get_option('layout_name');
 
  $term = get_term( $cat_id );
  $offset = (isset($_POST['offset'])) ? $_POST['offset'] : 4;
  $pageNumber = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0 ;
   //$offset = $_POST['offset'];
   
 $args = array(
   	'post_type' => $post_id,
   	'order'          => 'ASC',
   	'posts_per_page'  => $offset,
    'paged'           => $pageNumber,
   	 /*'tax_query' => 
   	 	 array('taxonomy' => $term->taxonomy,
   	 	  'field'    => $term->term_id, 
   	 	  'terms'    =>  $cat_id,
   	 	   ), 
   	 	 
   	);*/
    'meta_query' => array(
            array(
                'key'     => 'category',
                'value'   => 'true',
                'compare' => '=',
            )
        )
);
echo "<pre>";
 print_r($args);
 echo "</pre>";

      /*if(!empty($cat_id)) {
        $args ['tax_query'] =  array(
          array(
              'taxonomy' => $term->taxonomy,
              'field'    => $term->term_id, 
   	 	      'terms'    => $cat_id,
                 ));
      }*/
	
	$the_query = new WP_Query($args);
 	if ($the_query->have_posts()) : 
     while ( $the_query->have_posts() ) : $the_query->the_post();

   		 //include('template-parts/displaytemplate.php');
      ?>
			<div class="post-box filter-item  <?php echo $select_option;?><?php echo get_option('btn_id');?>" data-filter="<?php echo $term->slug; ?>">
			     	<h2><?php the_title();?></h2>
	                <p><?php the_content(); ?></p>
	       </div> 

		
           <?php 
            endwhile;   
        endif;
    wp_reset_postdata();
  die();
}

}

