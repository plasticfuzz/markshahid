<?php
/*
Plugin Name: Jquery Accordion
Plugin URI: http://www.jeffikus.com/downloads/wordpress-jquery-accordion-plugin/
Description: A jquery accordion of the latest posts in a specific category
Version: 0.1
Author: Jeffikus
Author URI: http://jeffikus.com
*/

/*  Copyright 2009  Jeffikus  (email : pearce DOT jp [at] gmail DOT com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists("JqueryAccordion")) {
	class JqueryAccordion {
/*
* Constructor
*/
    function JqueryAccordion() { 
		
    }

/*
* Function to load the required jquery libraries
* jquery
* UI
* accordion
*/ 
    function load_jquery() {
    //Load required jquery libraries and stylesheets and perform accordion functionality
    $siteURL = get_bloginfo( 'url' );
    echo '<link type="text/css" href="'.$siteURL.'/wp-content/plugins/jquery-accordion/jquery/themes/base/ui.all.css" rel="stylesheet" />
          <script type="text/javascript" src="'.$siteURL.'/wp-content/plugins/jquery-accordion/jquery/jquery-1.3.2.js"></script>
          <script type="text/javascript" src="'.$siteURL.'/wp-content/plugins/jquery-accordion/jquery/ui/ui.core.js"></script>
          <script type="text/javascript" src="'.$siteURL.'/wp-content/plugins/jquery-accordion/jquery/ui/ui.accordion.js"></script>
          <script type="text/javascript">
          $(document).ready(function(){
            $("#accordion").accordion({active: false, alwaysOpen: false, autoheight: false});
          });
          </script>
          ';            
    }

/*
* Function to load the accordion when called using the shortcode:
* [jqueryaccordion posts="3" category="Featured"]
*/ 
    function jqueryaccordion_func($atts) {
    	//set defaults
    	extract(shortcode_atts(array(
    		'posts' => '3',
    		'category' => 'Featured',
    		), $atts));
    	//set query arguments
      $argsAccordion=array(
                    'posts_per_page'=>$atts['posts'], 
    		            'category_name'=>$atts['category']
                    );
    	//query the posts
    	$postResults = new WP_Query($argsAccordion);
      //BEGIN - results layout
      $result = '<div id="accordion">';
    	//loop through the posts	
      while($postResults->have_posts()) : $postResults->the_post();
    	  
      	$result .= '<h3><a href="#">';
        $result .= get_the_title($postResults->ID);
        $result .= '</a></h3>';
      	$result .= '<div><p>';
      	$result .= get_the_excerpt();
        $result .= '</p></div>';  
            
    	endwhile;
    
      $result .= '</div>';
      //END - results layout
      
      //return results
    	return $result;
    
    }
    
    
		
		
	}
} //End Class JqueryAccordion

if (class_exists("JqueryAccordion")) {
	   $jqueryAccordion = new JqueryAccordion();
    }
    
    //Actions and Filters
    if (isset($jqueryAccordion)) {
	  //Actions
	     //hookup the function to load jquery in the header
       add_action('wp_head', array(&$jqueryAccordion, 'load_jquery'), 1);
       //assign function to a shortcode
	     add_shortcode('jqueryaccordion', array(&$jqueryAccordion, 'jqueryaccordion_func'));
	  //Filters
    }

?>
