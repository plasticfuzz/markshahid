 <h2>Recent Projects:</h2>
   
    <div id="slider">
    	
        <ul id="sliderContent">
        <?php	query_posts('showposts=3&category_name=Slider');	?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <li class="sliderImage">
               <a title="<?php the_title() ?>" href="<?php the_permalink() ?>" border="0"><?php if(function_exists('wct_display_thumb')){ wct_display_thumb(); } ?> </a>
                <span class="bottom"><strong><?php the_title() ?></strong><br /><?php the_excerpt_rss() ?></span>
                 <?php endwhile; endif; ?>
            </li>
            
            <div class="clear sliderImage"></div>
        </ul>
    
	</div>