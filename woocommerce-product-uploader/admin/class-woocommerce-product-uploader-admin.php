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
        wp_enqueue_script('wpu-bootstrap', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/bootstrap.min.js', array('jquery'), $this->version, false );
        wp_enqueue_script($this->WoocommerceProductUploader.'-upload', WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . 'admin/js/jquery.fileupload.min.js', array('jquery'), $this->version, false );


        $langs = array(
            'invalid_file_error'  => __('Invalid File, Accepts JPG, PNG, GIF or SVG.','wpu_admin'),
            'error_try_again'  => __('Error Occured, Please try Again.','wpu_admin'),
        );


        // Plugin Validation
    }
    


    /**
     * [admin_dashboard Plugin Dashboard]
     * @return [type] [description]
     */
    public function admin_dashboard()
    {

        global $wpdb;
        include WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_PATH.'admin/partials/dashboard.php';
    }
}