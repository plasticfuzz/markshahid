<?php
/**
* Functions for loading Javascript in Settings Page
*
* @copyright Copyright 2008-2010  Ade WALKER  (email : info@studiograsshopper.ch)
* @package dynamic_content_gallery
* @version 3.2.2
*
* @info Admin Settings page Javascript
* @info Since 3.2 Admin CSS is now handled through separate stylesheet hooked to admin_print_styles
*
* @since 3.0
*/

/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit( __('Sorry, you are not allowed to access this file directly.', DFCG_DOMAIN) );
}


/**
* Function for loading JS for Settings Page
*
* Code idea from Nathan Rice, Theme Options plugin.
* Since 3.2, this only includes JS. CSS now in external stylesheet.
*
* @since 3.2
*/
function dfcg_options_js() {
echo <<<JS

<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".fade").fadeIn(1000).fadeTo(3000, 1).fadeOut(1000);
});
</script>

JS;
}
