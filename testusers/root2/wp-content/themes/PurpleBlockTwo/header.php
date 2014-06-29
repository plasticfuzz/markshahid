<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>


<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



<?php wp_head(); ?>






<script language="javascript"  type="text/javascript" src="<?php bloginfo('template_url') ?>/js/s3Slider.js"></script>


<script type="text/javascript"> 






jQuery(document).ready(function(){
	
	//hide message_body after the first one
	jQuery(".message_body").hide();
	
	//hide message li after the 5th
	jQuery(".message_list li:gt(9)").hide();
 
	
	//toggle message_body
	jQuery(".message_head").click(function(){
		jQuery(this).next(".message_body").slideToggle(250)
		jQuery(this).toggleClass("active");
		return false;
	});
 
	//collapse all messages
	jQuery(".collpase_all_message").click(function(){
		jQuery(".message_body").slideUp(200)
		return false;
	});
 
	//show all messages
	jQuery(".show_all_message").click(function(){
		jQuery(this).hide()
		jQuery(".show_recent_only").show()
		jQuery(".message_list li:gt(9)").slideDown()
		return false;
	});
 
	//show recent messages only
	jQuery(".show_recent_only").click(function(){
		jQuery(this).hide()
		jQuery(".show_all_message").show()
		jQuery(".message_list li:gt(9)").slideUp()
		return false;
	});
 
});



jQuery(document).ready(function(){
	
	//hide message_body after the first one
	jQuery(".news_body").hide();
	
	//hide message li after the 5th
	jQuery(".news_list li:gt(9)").hide();
 
	
	//toggle message_body
	jQuery(".news_head").click(function(){
		jQuery(this).blur().next(".news_body").slideToggle(250)
		jQuery(this).blur().toggleClass("active");
		return false;
	});
 
	//collapse all messages
	jQuery(".collpase_all__news_message").click(function(){
		jQuery(".news_body").slideUp(200)
		return false;
	});
 


 
});



    jQuery(document).ready(function() {
        jQuery('#slider').s3Slider({
            timeOut: 4000
        });
    });


</script>

</head>
<body>

	<div id="container">
    
    	<div id="top">
        
        
                <div class="half">
                    <h1 id="header"><a href="<?php bloginfo('url'); ?>"><img src="http://www.markshahid.co.uk/testusers/root2/wp-content/themes/PurpleBlockTwo/gallery/logo.png" alt="Root" border="0" /></a></h1>
                  
                </div>
            
    
              
           		<div class="center"></div>
            
          
                      <div class="clear"></div>
                
                 <ul id="dropmenu"> <?php wp_list_pages('sort_column=menu_order&title_li='); ?> </ul>
                
                
                </div>
            
    	<div class="half">
