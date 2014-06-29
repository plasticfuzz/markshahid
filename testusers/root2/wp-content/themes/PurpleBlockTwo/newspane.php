

          <h2>Recent news:</h2>

	<?php	query_posts('showposts=4&category_name=News');	?>






<?php if (have_posts()) : ?>
<ol class="news_list">
<?php while (have_posts()) : the_post(); ?>
	<li>
<p class="news_head"><cite><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> <span class="timestamp" ><?php the_time('j F Y'); ?></span></a></cite></p>

<div class="news_body">

   <?php the_content(''); ?>

</div></li>
<?php endwhile; ?>

</ol>
<h5>No Posts Found</h5>
<?php endif; ?>