<?php
/**
 * Create Setting Pages
 *
 * @package    BKMT
 * @subpackage BKMT/admin
 * @author     Dharminder Singh <dhaliwal.dharminder@yahoo.com>
 */ 
class BKMT_settings {

    public static function init() {
       $class = __CLASS__;
       new $class;
   }

   public function __construct(){
       add_action( 'admin_menu', array($this,'add_menus') );
       add_action( 'admin_post_save_csv_data', array($this,'save_csv_data_content'));
   }

   /* Add menus to dashabord
	*
	* @since  1.0.0
	* @author     Dharminder Singh <dhaliwal.dharminder@yahoo.com>
	*/
	public function add_menus() {

		$page_title  = esc_html__( 'Import Books', 'bkmt' );
		$capability  = 'manage_options';
		$parent_slug = 'bkmt-settings';
		$function    = array( $this, 'bkmt_setting_page_template' );
		$menu_title  = esc_html__( 'Import Books', 'bkmt' );
		$icon_url    = 'dashicons-id';
        add_menu_page($page_title,$menu_title,$capability,$parent_slug,$function,$icon_url);
    }

    /**
	*Books Settings  page Template
	*
	* @package  BKMT
	* @since  1.0.0
	* @author  Dharminder Singh <dhaliwal.dharminder@yahoo.com>
	*/
	public function bkmt_setting_page_template(){

		include BKMT_PLUGIN_DIR_PATH . 'admin/partials/bkmt-settings.php';
    }
    
    /**
     * Save the content of group follow policy
    */    
    function save_csv_data_content(){
     
        if((isset($_POST['action']))&&($_POST['action']=='save_csv_data')){

            $filename = $_FILES["file"]["tmp_name"];

            if($_FILES["file"]["size"] > 0){

                $file       = fopen($filename, "r");

                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
                  
                    $book_name    = isset($getData[0])  ?   $getData[0] : '';
                    $img          = isset($getData[1])  ?   $getData[1] : '';
                    $desc         = isset($getData[2])  ?   $getData[2] : '';
                    
                    $author       = isset($getData[3])  ?   $getData[3] : '';
                    $publish_year = isset($getData[4])  ?   $getData[4] : '';
                    $download_url = isset($getData[5])  ?   $getData[5] : '';
                    $book_cat     = isset($getData[6])  ?   $getData[6] : '';
                    $language     = isset($getData[7])  ?   $getData[7] : '';

                    $catID        = $this->insert_custom_taxonomy_term($book_cat,'books_cat');
                    $languageID   = $this->insert_custom_taxonomy_term($language,'bkmt_language');

                    if(!post_exists( trim($book_name))){

                        if( trim($book_name) == 'Book Name')
                            continue;

                        $my_post = array(
                            'post_type'     =>  'bkmt',
                            'post_title'    => trim($book_name),
                            'post_content'  => $desc,
                            'post_status'   => 'publish',
                        );
                        
                        // Insert the post into the database.
                        $post_id = wp_insert_post( $my_post );

                        if($post_id){

                            //set book category
                            if(!empty($catID)){

                                wp_set_post_terms( $post_id, array($catID),'books_cat' );
                            }

                            //set book language
                            if(!empty($languageID)){

                                wp_set_post_terms( $post_id, array($languageID),'bkmt_language');
                            }
                            
                            $this->add_post_image($img,$post_id );
                            update_post_meta($post_id, 'bkmt_author', $author);
                            update_post_meta($post_id, 'bkmt_download_url', $download_url);
                            update_post_meta($post_id, 'bkmt_publish_year', $publish_year);
                        }
                    }
                    
                } #end while
      
                fclose($file);

            }
            return wp_redirect(admin_url('edit.php?post_type=bkmt'));            
        }

    }

    function add_post_image ($imageurl,$parent_post_id ){

        if(empty($imageurl)||empty($parent_post_id))
            return false;

        include_once( ABSPATH . 'wp-admin/includes/image.php' );

        $imagetype  = end(explode('/', getimagesize($imageurl)['mime']));
        $uniq_name  = date('dmY').''.(int) microtime(true); 
        $filename   = $uniq_name.'.'.$imagetype;

        // Get the path to the upload directory.
        $wp_upload_dir  = wp_upload_dir();

        $uploadfile = $wp_upload_dir['path'].'/'.$filename;

        //$contents   = file_get_contents($imageurl); 
        $contents = $this->curl_get_contents($imageurl);

        $savefile   = fopen($uploadfile, 'w');
        fwrite($savefile, $contents);
        fclose($savefile);
       
         // Check the type of file. We'll use this as the 'post_mime_type'.
        $filetype = wp_check_filetype( basename( $filename ), null );

        // Prepare an array of post data for the attachment.
        $attachment = array(
            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
            'post_mime_type' => $filetype['type'],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        // Insert the attachment.
        $attach_id      =   wp_insert_attachment( $attachment, $uploadfile ,$parent_post_id);
        $imagenew       =   get_post( $attach_id );
        $fullsizepath   =   get_attached_file( $imagenew->ID );
        $attach_data    =   wp_generate_attachment_metadata( $attach_id, $fullsizepath );

        wp_update_attachment_metadata( $attach_id, $attach_data );      
       
       set_post_thumbnail( $parent_post_id, $attach_id );
       
    }
    
    /**
     * insert custom taxonomy term 
     * @param $term_name
     * @param $taxonomy
     */
    function insert_custom_taxonomy_term($term_name,$taxonomy){
        
        $catID = '';

        //check if book category not exist
        $catID = term_exists( $term_name, $taxonomy );
        $catID = $catID['term_id'];

        if ( $catID == 0 && $catID == null ) {

            $catID = wp_insert_term( $term_name, $taxonomy );
            $catID = $catID['term_id'];
        }
        return $catID;
    }
    function curl_get_contents($url){
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($ch);       
        curl_close($ch);
        return $data;
    }

}
add_action('init',array('BKMT_settings','init'));