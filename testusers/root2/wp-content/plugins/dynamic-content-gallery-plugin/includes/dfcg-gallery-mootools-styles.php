<?php
/**
* Front-end - CSS for Mootools
*
* @copyright Copyright 2008-2010  Ade WALKER  (email : info@studiograsshopper.ch)
* @package dynamic_content_gallery
* @version 3.2.2
*
* @info Load user defined styles into the header.
* @info This should ensure XHTML validation.
*
* @since 3.2
*/
?>

<?
/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit( __('Sorry, you are not allowed to access this file directly.', DFCG_DOMAIN) );
}
?>


<style type="text/css">
.imageElement {
visibility: hidden;
}
#myGallery, #myGallerySet, #flickrGallery
{
	width: <?php echo $dfcg_options['gallery-width']; ?>px;
	height: <?php echo $dfcg_options['gallery-height']; ?>px;
	border: <?php echo $dfcg_options['gallery-border-thick']; ?>px solid <?php echo $dfcg_options['gallery-border-colour']; ?>;
	background: #000 url('<?php echo WP_PLUGIN_URL; ?>/dynamic-content-gallery-plugin/css/img/loading-bar-black.gif') no-repeat center;
}
.jdGallery .slideInfoZone
{
	height: <?php echo $dfcg_options['slide-height']; ?>px;
}
.jdGallery .slideInfoZone h2
{
	font-size: <?php echo $dfcg_options['slide-h2-size']; ?>px !important;
	margin: <?php echo $dfcg_options['slide-h2-margtb']; ?>px <?php echo $dfcg_options['slide-h2-marglr']; ?>px !important;
	padding: <?php echo $dfcg_options['slide-h2-padtb']; ?>px <?php echo $dfcg_options['slide-h2-padlr']; ?>px !important; 
	color: <?php echo $dfcg_options['slide-h2-colour']; ?> !important;
	}

.jdGallery .slideInfoZone p
{
	padding: <?php echo $dfcg_options['slide-p-padtb']; ?>px <?php echo $dfcg_options['slide-p-padlr']; ?>px !important;
	font-size: <?php echo $dfcg_options['slide-p-size']; ?>px !important;
	margin: <?php echo $dfcg_options['slide-p-margtb']; ?>px <?php echo $dfcg_options['slide-p-marglr']; ?>px !important;
	color: <?php echo $dfcg_options['slide-p-colour']; ?> !important;
}

.jdGallery .slideInfoZone p a, .jdGallery .slideInfoZone p a:link, .jdGallery .slideInfoZone p a:visited 
{
	color: <?php echo $dfcg_options['slide-p-a-color']; ?> !important;
	font-weight:<?php echo $dfcg_options['slide-p-a-weight']; ?> !important;
}

.jdGallery .slideInfoZone p a:hover
{
	color: <?php echo $dfcg_options['slide-p-ahover-color']; ?> !important;
	font-weight:<?php echo $dfcg_options['slide-p-ahover-weight']; ?> !important;
}

</style>