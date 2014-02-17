<?php
/*
Plugin Name: Rocket Dashboard
Plugin URI: http://storefrontthemes.com/plugins/rocket-dashboard
Description: A fresh take on the WordPress Admin Dashboard. Rocket Dashboard delivers a more influential working environment for WordPress through the use of color. Black on white is reserved for the main content window. The left nav is dark and all the icons have been replaced with scalable vector art through a custom icon font. The WP-Admin bar has also been given a facelift, as it's now bigger, brighter and much more fun. Just upload the plugin and activate. No additional settings required!
Author: Matt Jones of Storefront Themes
Author URI: http://storefrontthemes.com
Version: 1.0.3
*/

function my_admin_head() {
        echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('wp-admin.css', __FILE__). '">';
}

add_action('admin_head', 'my_admin_head');

require_once('wp-updates-plugin.php');
new WPUpdatesPluginUpdater( 'http://wp-updates.com/api/1/plugin', 102, plugin_basename(__FILE__) );