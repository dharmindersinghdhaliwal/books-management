<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BKMT
 * @subpackage BKMT/admin
 * @author     Dharminder Singh <dhaliwal.dharminder@yahoo.com>
 */
class BKMT_Admin {

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
	 * @param      string    $BKMT       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $BKMT, $version ) {

		$this->BKMT = $BKMT;
		$this->version = $version;
	}
	
	public function enqueue_styles() {

		wp_enqueue_style( $this->BKMT, plugin_dir_url( __FILE__ ) . 'css/bkmt-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		
		wp_enqueue_script( $this->BKMT, plugin_dir_url( __FILE__ ) . 'js/bkmt-admin.js', array( 'jquery' ), $this->version, false );

	}

}