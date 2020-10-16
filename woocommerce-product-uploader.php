<?php

/**
 *
 * @link              https://woocommerce-product-uploader.com
 * @since             1.0.0
 * @package           WoocommerceProductUploader
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Product Uploader
 * Plugin URI:        https://wesbite.com
 * Description:       Woocommerce Product Uploader is a WordPress Custom Plugin that makes your client work for you.  It enforces best practices and an organized method of gathering clients data per product.
 *
 * Version:           1.0.0
 * Author:            Michael Harootoonyan
 * Author URI:        https://www.linkedin.com/in/michael-harootoonyan-876379172/
 * License:           Copyright 2020
 * License URI:
 * Text Domain:       woocommerce_product_uploader
 */


// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
global $wpdb;
global $wp_version;
define('WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH', plugin_dir_url(__FILE__));
define('WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WOOCOMMERCE_PRODUCT_UPLOADER_PREFIX', $wpdb->prefix . "wpu_");
define('WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_BASE', dirname(plugin_basename(__FILE__)));
define('WOOCOMMERCE_PRODUCT_UPLOADER_CVERSION', "1.0.0");

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-abec-my-custom-plugin-activator.php
 */
function activate_woocommerce_product_uploader()
{
    require_once WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_PATH . 'includes/class-woocommerce-product-uploader-activator.php';
    
    WoocommerceProductUploaderActivator::activate();
}

register_activation_hook(__FILE__, 'activate_woocommerce_product_uploader');


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_PATH . 'includes/class-woocommerce-product-uploader.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function runWoocommerceProductUploader()
{
    $plugin = new WoocommerceProductUploader();
    $plugin->run();
}

runWoocommerceProductUploader();
