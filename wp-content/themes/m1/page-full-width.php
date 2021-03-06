<?php
/**
 * Full width page template (no sidebar).
 *
 * Template Name: Full Width
 *
 * @package m1 Theme
 */

get_header(); ?>

	<header class="entry-header">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header>

	<div id="primary" class="content-area full-width">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
