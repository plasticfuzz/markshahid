        	   
                       <!-- <div class="greytopbar smalltoppad"><h2>Coming Soon:</h2></div>-->
                <div class="topmargin">
               		 <h2>Recent projects:</h2>
                    	<div id="myController" class="pause">
							<?php	query_posts('showposts=3&category_name=Slider');	?>
                           <!-- <?php if (have_posts()) : while (have_posts()) : the_post(); ?>-->
                               <div class="jFlowControl"><a title="<?php the_title() ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                </div>
                            <?php endwhile; endif; ?>
						</div>
                    
        
                		<div id="mySlides" class="pause">
							<?php	query_posts('showposts=3&category_name=Slider');	?>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div>
                        

              			<div class="boxgrid caption">                
                            <a title="<?php the_title() ?>" href="<?php the_permalink() ?>"><?php if(function_exists('wct_display_thumb')){ wct_display_thumb(); } ?></a>
                                <a title="<?php the_title() ?>" href="<?php the_permalink() ?>">
                                    <span class="cover boxcaption">              
                                 
                                        <span class="slidertitle"><?php the_title() ?></span>
                                        <span class="sliderexcerpt"><?php the_excerpt_rss() ?></span>
                            
                                    </span>
                                </a>
               			 </div>
                
				</div>
                    	<?php endwhile; endif; ?>
              </div>
</div>