<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://woocommerce-product-uploader.com
 * @since      1.0.0
 *
 * @package    WoocommerceProductUploader
 * @subpackage WoocommerceProductUploader/includes
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
 * @package    WoocommerceProductUploader
 * @subpackage WoocommerceProductUploader/includes
 * @author     Michael Harootoonyan <michaelharootoonyan@gmail.com>
 */
class WoocommerceProductUploader
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      WoocommerceProductUploaderLoader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;
    
    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $WoocommerceProductUploader    The string used to uniquely identify this plugin.
     */
    protected $WoocommerceProductUploader;
    
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
    public function __construct()
    {

        $this->WoocommerceProductUploader = 'woocommerce-product-uploader';
        $this->version = WOOCOMMERCE_PRODUCT_UPLOADER_CVERSION;

        $this->loadDependencies();
        
        $this->plugin_admin = new WoocommerceProductUploaderAdmin($this->getWoocommerceProductUploader(), $this->getVersion());
        
        if (is_admin()) {
            $this->defineAdminHooks();
        }
    }
    
    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - WoocommerceProductUploaderLoader. Orchestrates the hooks of the plugin.
     * - WoocommerceProductUploaderAdmin. Defines all hooks for the admin area.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function loadDependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_PATH . 'includes/class-woocommerce-product-uploader-loader.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_PATH . 'admin/class-woocommerce-product-uploader-admin.php';

        $this->loader = new WoocommerceProductUploaderLoader();
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function defineAdminHooks()
    {
        //add menu if u r an admin
        add_action('admin_menu', array($this,'add_admin_menu'));

        $this->loader->add_action('admin_enqueue_scripts', $this->plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $this->plugin_admin, 'enqueue_scripts');

        add_action('wp_ajax_wpu_add_new_requirements', array($this->plugin_admin, 'wpu_add_new_requirements'));
        add_action('wp_ajax_wpu_get_requirements', array($this->plugin_admin, 'wpu_get_requirements'));
        add_action('wp_ajax_wpu_upload_zip_file', array($this->plugin_admin, 'wpu_upload_zip_file'));
    }
    
    /*All Admin Callback hooks*/
    public function add_admin_menu()
    {
        $wpuAdmin = 'wpu_admin';
        $wpuPlugin = 'wpu-plugin';
        $deletePosts = 'delete_posts';
        if (current_user_can($deletePosts)) {
            $svg = 'dashicons-location';
            add_Menu_page(
                'Woocommerce Product Uploader',
                __('Woo Product Uploader', $wpuAdmin),
                $deletePosts,
                $wpuPlugin,
                array($this->plugin_admin,'admin_plugin_settings'),
                $svg
            );
            add_submenu_page(
                $wpuPlugin,
                __('Dashboard', $wpuAdmin),
                __('Dashboard', $wpuAdmin),
                $deletePosts,
                'wpu-dashboard',
                array($this->plugin_admin,'admin_dashboard')
            );
            remove_submenu_page($wpuPlugin, $wpuPlugin);
            remove_submenu_page($wpuPlugin, "wpu-plugin-edit");
        }
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function getWoocommerceProductUploader()
    {
        return $this->WoocommerceProductUploader;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    WoocommerceProductUploaderLoader    Orchestrates the hooks of the plugin.
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function getVersion()
    {
        return $this->version;
    }
}
