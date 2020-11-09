<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://WoocommerceProductUploader.com
 * @since      1.0.0
 *
 * @package    WoocommerceProductUploader
 * @subpackage WoocommerceProductUploader/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WoocommerceProductUploader
 * @subpackage WoocommerceProductUploader/admin
 * @author     Michael Harootoonyan <michaelharootoonyan@gmail.com>
 */
class WoocommerceProductUploaderAdmin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $WoocommerceProductUploader    The ID of this plugin.
     */
    private $WoocommerceProductUploader;

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
     * @param      string    $WoocommerceProductUploader       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($WoocommerceProductUploader, $version)
    {

        $this->WoocommerceProductUploader = $WoocommerceProductUploader;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WoocommerceProductUploaderLoader as all of the hooks are defined
         * in that particular class.
         *
         * The WoocommerceProductUploaderLoader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->WoocommerceProductUploader, WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/css/bootstrap.min.css', array(), $this->version, 'all');//$this->version
        wp_enqueue_style('wpu_admin', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/css/style.css', array(), $this->version, 'all');
        wp_enqueue_style('wpu_admin', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/css/jquery-ui.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WoocommerceProductUploaderLoader as all of the hooks are defined
         * in that particular class.
         *
         * The WoocommerceProductUploaderLoader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script( $this->WoocommerceProductUploader.'-lib', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/libs.js', array('jquery'), $this->version, false );
        wp_enqueue_script('wpu-bootstrap', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/bootstrap.min.js', array('jquery'), $this->version, false );
        wp_enqueue_script( $this->WoocommerceProductUploader.'-jquery-1.12.4', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/jquery-1.12.4.js', array('jquery'), $this->version, false );
        wp_enqueue_script($this->WoocommerceProductUploader.'-jquery-knob', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/jquery.knob.js', array('jquery'), $this->version, false );

        // This is for things like animate() function etc...
        wp_enqueue_script( $this->WoocommerceProductUploader.'-jquery-ui', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/jquery-ui.js', array('jquery'), $this->version, false );
        // jQuery File Upload Dependencies
        wp_enqueue_script($this->WoocommerceProductUploader.'-jquery-ui-widget', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/jquery.ui.widget.js', array('jquery'), $this->version, false );
        wp_enqueue_script($this->WoocommerceProductUploader.'-jquery-iframe-transport', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/jquery.iframe-transport.js', array('jquery'), $this->version, false );
        wp_enqueue_script($this->WoocommerceProductUploader.'-jquery-fileupload', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/jquery.fileupload.js', array('jquery'), $this->version, false );

        wp_enqueue_script( $this->WoocommerceProductUploader.'-jscript', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/jscript.js', array('jquery'), $this->version, false );


        $langs = array(
            'invalid_file_error'  => __('Invalid File, Accepts ZIP.','wpu_admin'),
            'error_try_again'  => __('Error Occured, Please try Again.','wpu_admin'),
        );


        // Plugin Validation
        wp_localize_script( $this->WoocommerceProductUploader.'-jscript', 'WPU_REMOTE', array('LANG' => $langs, 'URL' => WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH, 'ADMIN_URL' => admin_url( 'admin-ajax.php' ), '1.1', true));
    }
    


    /**
     * [admin_dashboard Plugin Dashboard]
     * @return [type] [description]
     */
    public function admin_dashboard()
    {

        global $wpdb;

        $pluginMetaTableName = WOOCOMMERCE_PRODUCT_UPLOADER_PREFIX . "pluginmeta";

        $sql = "SELECT meta_value FROM " . $pluginMetaTableName . " WHERE meta_key='options' LIMIT 1";
        $wpdb->query($sql);
        $options = json_decode(stripslashes($wpdb->get_results($sql)[0]->meta_value));

        include WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_PATH.'admin/partials/dashboard.php';
    }

    public function wpu_get_requirements()
    {
        
        global $wpdb;

		$response  = new \stdclass();
        $response->success = true;

        $pluginMetaTableName = WOOCOMMERCE_PRODUCT_UPLOADER_PREFIX . "pluginmeta";

        $sql = "SELECT meta_value FROM " . $pluginMetaTableName . " WHERE meta_key='options' LIMIT 1";
        $wpdb->query($sql);

        $optionsJsonString = stripslashes($wpdb->get_results($sql)[0]->meta_value);

        $response->options = $optionsJsonString;
        echo json_encode($response);
        die;
    }

    
	/**
	 * [add_new_requirements POST METHODS for adding new product requirements]
	 */
    public function wpu_add_new_requirements()
    {

		global $wpdb;

		$response  = new \stdclass();
        $response->success = false;
        
        $pluginMetaTableName = WOOCOMMERCE_PRODUCT_UPLOADER_PREFIX . "pluginmeta";

        $sql = "DELETE FROM " . $pluginMetaTableName ." WHERE meta_key = 'options' LIMIT 1";
		$wpdb->query($sql);
		
		//insert into stores table
        if ($wpdb->insert(
            $pluginMetaTableName,
            array('meta_key' => $_REQUEST['meta_key'], 'meta_value' => $_REQUEST['meta_value']),
            array('%s','%s')
        )) {
            $response->success = true;
            $response->msg = __('Product requirements added successfully!', 'wpu_admin');
        } else {
            $wpdb->show_errors = true;

            $response->error = __('Error occurred while saving product requirements', 'wpu_admin');
            $response->msg   = $wpdb->print_error();
        }
        
        echo json_encode($response);
        die;
    }

    private function logThis($data, $path)
    {
        $myfile = fopen($path . "log.txt", "a") or die("Unable to open file!");  // append mode rather than write mode 'w'
        fwrite($myfile, print_r($data));
        fclose($myfile);
    }

    public function wpu_upload_zip_file()
    {
        // A list of permitted file extensions
        $allowed = array('zip');
        $path = str_replace('/', '', ABSPATH) . "\wp-content\plugins\woocommerce-product-uploader\admin\uploads\\";

        if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {
            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($extension), $allowed)) {
                echo "not in array";
                echo '{"status":"error"}';
                die;
            }

            $filename = $path . $_FILES['upl']['name'];

            if (move_uploaded_file($_FILES['upl']['tmp_name'], $filename)) {
                $zip = new ZipArchive;
                $extracted = $zip->open($filename);
                if ($extracted) {
                    // Extract file
                    $zip->extractTo($path);
                    $zip->close();
                    echo 'Unzipped!';
                } else {
                    echo 'failed to unzip!';
                }
                echo '{"status":"success"}';
                die;
            }
        }

        echo '{"status":"error"}';
        die;
    }
}
