<?php while ( have_posts() ) : the_post(); ?>
	<div class="section-blog__wrapper-post section-grid__item">
		<?php get_template_part( 'template-parts/blog/post/post' ); ?>
	</div>
<?php endwhile; ?>
