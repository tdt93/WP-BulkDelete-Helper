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

    // Run the query to delete posts and topics where author_id does not exist in wp_users table
    $wpdb->query("DELETE FROM wp_forum_posts WHERE author_id NOT IN (SELECT ID FROM wp_users)");   
    $wpdb->query("DELETE FROM wp_forum_topics WHERE author_id NOT IN (SELECT ID FROM wp_users)");         

}

// Hook the function to an action
add_action('delete_user', 'delete_posts_without_users');
add_action('delete_users_by_role', 'delete_posts_without_users', 999, 1);
add_action('admin_footer', 'delete_posts_without_users');
