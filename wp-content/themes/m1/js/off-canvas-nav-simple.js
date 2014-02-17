/*!
 *
 *  Show/hide off canvas navigation
 *
 */

jQuery(document).ready(function($) {

	$("header .nav-btn").click(function(){
		$("html").removeClass("closeNav").addClass("js-nav");
	});
	
	$("#nav-close-btn").click(function(){
		$("html").addClass("closeNav");
	});
	
});