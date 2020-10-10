<?php

/**
 * Fired during plugin activation
 *
 * @link       http://agilelogix.com
 * @since      1.0.0
 *
 * @package    WoocommerceProductUploader
 * @subpackage WoocommerceProductUploader/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.1.6
 * @package    WoocommerceProductUploader
 * @subpackage WoocommerceProductUploader/includes
 * @author     Michael Harootoonyan <michaelharootoonyan@gmail.com>
 */
class WoocommerceProductUploaderActivator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.1.6
     */
    public static function activate()
    {
        WoocommerceProductUploaderActivator::addTables();
    }

    public static function addTables()
    {
        $path = ABSPATH . "wp-content\debug.log";
        $myfile = fopen($path, "a") or die("Unable to open file!");  // append mode rather than write mode 'w'

        $txt = "\n\nThe following Function Fired: \n";
        fwrite($myfile, $txt);

        $txt = "addTables\n\n";
        fwrite($myfile, $txt);

        $txt = "passing the following parameters:\n";
        fwrite($myfile, $txt);

        $txt = "Plugin Directory Url        = " . WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . "\n"
        . "Plugin Directory Path       = " . WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_PATH . "\n"
        . "Plugin Prefix in DB         = " . WOOCOMMERCE_PRODUCT_UPLOADER_PREFIX . "\n"
        . "Plugin Base Directory Path  = " . WOOCOMMERCE_PRODUCT_UPLOADER_PLUGIN_BASE . "\n"
        . "Plugin Current Version      = " . WOOCOMMERCE_PRODUCT_UPLOADER_CVERSION . "\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}
