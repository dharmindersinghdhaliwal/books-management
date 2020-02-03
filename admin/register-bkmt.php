<?php
// Register Custom Post Type
function register_bkmt_post_type() {

	$labels = array(
		'name'                  => _x( 'Books', 'Post Type General Name', 'bkmt' ),
		'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'bkmt' ),
		'menu_name'             => __( 'Books', 'bkmt' ),
		'name_admin_bar'        => __( 'Post Type', 'bkmt' ),
		'archives'              => __( 'Book Archives', 'bkmt' ),
		'attributes'            => __( 'Book Attributes', 'bkmt' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bkmt' ),
		'all_items'             => __( 'All Books', 'bkmt' ),
		'add_new_item'          => __( 'Add New Book', 'bkmt' ),
		'add_new'               => __( 'Add New Book', 'bkmt' ),
		'new_item'              => __( 'New Book', 'bkmt' ),
		'edit_item'             => __( 'Edit Book', 'bkmt' ),
		'update_item'           => __( 'Update Book', 'bkmt' ),
		'view_item'             => __( 'View Book', 'bkmt' ),
		'view_items'            => __( 'View Books', 'bkmt' ),
		'search_items'          => __( 'Search Book', 'bkmt' ),
		'not_found'             => __( 'Not found', 'bkmt' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bkmt' ),
		'featured_image'        => __( 'Book Image', 'bkmt' ),
		'set_featured_image'    => __( 'Set book image', 'bkmt' ),
		'remove_featured_image' => __( 'Remove book image', 'bkmt' ),
		'use_featured_image'    => __( 'Use as book image', 'bkmt' ),
		'insert_into_item'      => __( 'Insert into book', 'bkmt' ),
		'uploaded_to_this_item' => __( 'Uploaded to this book', 'bkmt' ),
		'items_list'            => __( 'Books list', 'bkmt' ),
		'items_list_navigation' => __( 'Books list navigation', 'bkmt' ),
		'filter_items_list'     => __( 'Filter books list', 'bkmt' ),
	);
	$args = array(
		'label'                 => __( 'Book', 'bkmt' ),
		'description'           => __( 'Post Type Description', 'bkmt' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments' ),
		'taxonomies'            => array( 'bkmt_language', 'post_tag' ,'books_cat'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'bkmt', $args );

}
add_action( 'init', 'register_bkmt_post_type', 0 );

// Register Custom Taxonomy
function register_language_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Languages', 'Taxonomy General Name', 'bkmt' ),
		'singular_name'              => _x( 'Language', 'Taxonomy Singular Name', 'bkmt' ),
		'menu_name'                  => __( 'Language', 'bkmt' ),
		'all_items'                  => __( 'All Languages', 'bkmt' ),
		'parent_item'                => __( 'Parent Item', 'bkmt' ),
		'parent_item_colon'          => __( 'Parent Item:', 'bkmt' ),
		'new_item_name'              => __( 'New Language Name', 'bkmt' ),
		'add_new_item'               => __( 'Add New Language', 'bkmt' ),
		'edit_item'                  => __( 'Edit Item', 'bkmt' ),
		'update_item'                => __( 'Update Item', 'bkmt' ),
		'view_item'                  => __( 'View Item', 'bkmt' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'bkmt' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'bkmt' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'bkmt' ),
		'popular_items'              => __( 'Popular Items', 'bkmt' ),
		'search_items'               => __( 'Search Items', 'bkmt' ),
		'not_found'                  => __( 'Not Found', 'bkmt' ),
		'no_terms'                   => __( 'No items', 'bkmt' ),
		'items_list'                 => __( 'Items list', 'bkmt' ),
		'items_list_navigation'      => __( 'Items list navigation', 'bkmt' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'bkmt_language', array( 'bkmt' ), $args );

}
add_action( 'init', 'register_language_taxonomy', 0 );

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Book Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Book Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Book Category', 'text_domain' ),
		'all_items'                  => __( 'All categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item category', 'text_domain' ),
		'add_new_item'               => __( 'Add New category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'books_cat', array( 'bkmt' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );

/**
* Add custom metabox for Books
*
* @since 1.27
* @author Dharminder Singh <dhaliwal.dharminder@yahoo.com>
**/
if ( !function_exists( 'add_bkmt_metaboxes' ) ):

    function add_bkmt_metaboxes(){
       $cmb_demo = new_cmb2_box( array(
           'id'            =>'bkmt_metabox',
           'title'         => esc_html__( 'Book Related Extra Detail', 'bkmt' ),
           'object_types'  => array( 'bkmt' ),
           'priority'   	=> 'low'
       ));
       $cmb_demo->add_field( array(
           'name'       => esc_html__('Book Author', 'bkmt' ),
           'desc'       => esc_html__( 'Please add book author name here', 'bkmt' ),
           'id'         => 'bkmt_author',
           'type'       => 'text',
           'attributes'  => array(
            	'placeholder' => 'Author Name',
  	          'required'    => 'required',
        	),
	   ));
	   
       $cmb_demo->add_field( array(
        'name'       => esc_html__('Book Download URL', 'bkmt' ),
        'desc'       => esc_html__( 'Please add book download url here', 'bkmt' ),
        'id'         => 'bkmt_download_url',
        'type'       => 'text',
        'attributes'  => array(
         	'placeholder' => 'Book download url',            
         	'required'    => 'required',
		 ),
		));
	 	$cmb_demo->add_field( array(
			'name'       => esc_html__('Book Publish Year', 'bkmt' ),
			'desc'       => esc_html__( '', 'bkmt' ),
			'id'         => 'bkmt_publish_year',
			'type'       => 'text_date',
			'attributes'  => array(
				'placeholder' => 'Publish year',            
				'required'    => 'required',
			)        
		));
       
   }

   add_action( 'cmb2_admin_init','add_bkmt_metaboxes');

endif;
