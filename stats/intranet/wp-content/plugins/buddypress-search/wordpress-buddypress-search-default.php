<?php
/*
Plugin Name: BuddyPress Search Default
Plugin URI: https://gist.github.com/5805248
Description: Default search select is posts. Search on home URL for custom posts URL.
Author: Josef Jezek
Author URI: http://about.me/josefjezek
Version: 0.2
*/
 
// Default search select is posts.
add_filter( 'bp_search_form_type_select_options', 'jj_search_default', 10, 1);
 
function jj_search_default($options) {
$newoptions = array();
$newoptions['posts'] = $options['posts'];
foreach( (array) $options as $option_value => $option_title ) {
if ( $option_value != 'posts' ) {
$newoptions[$option_value] = $option_title;
}
}
return $newoptions;
}
 
// Search on home URL for custom posts URL.
add_filter( 'bp_core_search_site', 'jj_search_on_home_url', 10, 1);
 
function jj_search_on_home_url($url) {
$search_which = !empty( $_POST['search-which'] ) ? $_POST['search-which'] : '';
 
if ( $search_which == 'posts' ) {
$search_terms = stripslashes( $_POST['search-terms'] );
$query_string = '/?s=';
 
return home_url( $query_string . urlencode( $search_terms ) );
}
 
return $url;
}
?>
