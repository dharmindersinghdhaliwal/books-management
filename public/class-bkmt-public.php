<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BKMT
 * @subpackage BKMT/public
 * @author     Dharminder Singh <dhaliwal.dharminder@yahoo.com>
 */
class BKMT_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $BKMT    The ID of this plugin.
	 */
	private $BKMT;

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
	 * @param      string    $BKMT       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $BKMT, $version ) {

		$this->BKMT = $BKMT;
		$this->version = $version;
		$this->shortcodes();
	}

	private function shortcodes(){

		add_shortcode('bkmt_all_books',array($this,'bkmt_all_books'));
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->BKMT, plugin_dir_url( __FILE__ ) . 'css/bkmt-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		wp_enqueue_script( $this->BKMT, plugin_dir_url( __FILE__ ) . 'js/bkmt-public.js', array( 'jquery' ), $this->version, false );
	}

	function get_all_books (){

		$args = array('post_type'=> 'bkmt','post_status' => 'publish');

		$books = get_posts( $args );

		$html = '';
		$html.= '<div class="bkmt-main">';

		$html.= '<ul class="books-listing">';

		if(!empty($books)){

			foreach($books as $book){

				$title 			=	get_the_title($book->ID) ? get_the_title($book->ID): 'Book name not found';
				$img			=	get_the_post_thumbnail($book->ID);				
				$author 		=	get_post_meta($book->ID,'bkmt_author',true) ? get_post_meta($book->ID,'bkmt_author',true) : 'Unknown author';

				$publish_year	=	get_post_meta($book->ID,'bkmt_publish_year',true) ? get_post_meta($book->ID,'bkmt_publish_year',true) : '';

				$langs = get_the_terms($book->ID,'bkmt_language');
				$cats = get_the_terms($book->ID,'books_cat');

				$html.= '<li item="bktm_'.$book->ID.'" class="bkmt-li">';

					$html.= '<h4 class="book-title">'.$title.'</h4>';

					$html.= '<span class="book-img">';
					if(!empty($img)){

						$html.= $img;
					}else{

						$html.= '<img src="http://leeford.in/wp-content/uploads/2017/09/image-not-found.jpg">';
					}
					$html.='</span>';
					
					$html.= '<ul class="book-detail">';
					$html.= '<li title="Book Writer"><span class="book-author">'.__($author,'bkmt').'</span></li>';
					$html.= '<li title="Publish Year"><span class="publish-year">('.date('Y', strtotime($publish_year)).')</span></li>';
					$html.= '<li title="Book Language"><span class="book-lang">'.__($langs[0]->name,'bkmt').'</span></li>';
					$html.= '<li title="Book Type"><span class="book-type">'.__($cats[0]->name,'bkmt').'</span></li>';
					$html.= '</ul>';

					$html.= '<a href="'.get_post_meta($book->ID,'bkmt_publish_year',true).'" target="_blank" class="bkmt-download">'.__('Read Book','bkmt').'</a>';

				$html.= '</li>';

			}
		}

		$html.= '</ul>';
		$html.= '</div>';

		return $html;
	}

	public function bkmt_all_books(){

		return $this->get_all_books();
	}

}