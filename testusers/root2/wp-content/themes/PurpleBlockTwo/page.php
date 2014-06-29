<?php get_header(); ?>

		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
 			<div class="post">
                <h2><?php the_title(); ?></h2>
                <?php the_content(''); ?>
            </div>
		<?php endwhile; ?>
			<p id="end" class="italics">
 				<?php next_posts_link('Older') ?>
 				<?php previous_posts_link('Newer') ?>
 			</p>

	<?php else : ?>

		<div class="post">
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		</div>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
