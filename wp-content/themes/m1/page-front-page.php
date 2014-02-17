<?php
/**
 * Front Page template
 *
 * Template Name: Front Page
 *
 * @package m1 Theme
 */

get_header(); ?>

			<?php if ( get_theme_mod( 'm1_banner_checkbox' ) ) : ?>
			<section class="m1-home-banner" style="background-image: url(<?php echo get_theme_mod( 'm1_banner' ); ?>);">
				<div class="m1-home-banner-text">
					<?php if ( get_theme_mod( 'm1_banner_text' ) ) : echo get_theme_mod( 'm1_banner_text' ); else: ?>
					<h2>Welcome to my site!</h2>
					<p>Check out my services, or contact me to get in touch.</p>
					<p><a href="<?php get_site_url(); ?>" class="button">Click Here</a></p>
					<?php endif; ?>
				</div>
			</section>
			<?php endif; ?>

	<div id="primary" class="content-area">
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

<?php get_sidebar(); ?>
<?php get_footer(); ?>