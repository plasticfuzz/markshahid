
        </div>

        
        <div class="center"></div>

                  
        <div class="half black">
     
      
        <?php include (TEMPLATEPATH . '/scrollpanetwo.php'); ?>
       <div class="topmargin"><?php include (TEMPLATEPATH . '/newspane.php'); ?></div>
        <?php 	/* Widgetized sidebar, if you have the plugin installed. */
		
                            if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
                            
                                   
                            
                            
            <ul>
            
          
            
            <div class="post">
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
           
		</div>
         
         
            
            
            <?php endif; ?>
           
        </div>
 
        <div class="clear" style="padding: 50px;" ></div>

 