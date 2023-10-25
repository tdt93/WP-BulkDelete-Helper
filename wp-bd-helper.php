<?php
/**

 * @package Bulk Delete helper

 */
 
/*

Plugin Name: Bulk Delete helper
Plugin URI: https://github.com/tdt93/WP-BulkDelete-Helper
Description: Custom website helper
Version: 1.0.0
Author: Thang Trinh Duy
Author URI:  https://www.fiverr.com/duythangtrinh
License: GPLv2 or later
Text Domain: wp-bd-helper

*/

if (!defined('ABSPATH')) {
    exit;
}

register_activation_hook(__FILE__, 'bd_plugin_install');
register_deactivation_hook(__FILE__, 'bd_plugin_uninstall');


function bd_plugin_install()
{
}

function bd_plugin_uninstall()
{
}

function delete_posts_without_users() {
    global $wpdb; // WordPress database access object

    // SQL query to delete posts where author_id does not exist in wp_users table
    $query = "DELETE FROM {$wpdb->prefix}wp_forum_posts 
              WHERE author_id NOT IN (SELECT ID FROM {$wpdb->prefix}wp_users)";

    // Run the query
    $wpdb->query($query);
}

// Hook the function to an action, for example, 'admin_init'
add_action('delete', 'delete_posts_without_users');