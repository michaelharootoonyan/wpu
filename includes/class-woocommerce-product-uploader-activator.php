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
        global $wpdb;
		$charset_collate = 'utf8';
		$prefix 	 	 = $wpdb->prefix."wpu_";

		

		/*Plugin Meta*/
		$createPluginMetaTableQuery = "CREATE TABLE IF NOT EXISTS `wp_wpu_pluginmeta` (
                                      `meta_key` longtext NOT NULL,
                                      `meta_value` longtext NOT NULL
                                      ) DEFAULT CHARSET=utf8;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($createPluginMetaTableQuery);
    }
}
