<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package m1 Theme
 */
?>
                <?php dynamic_sidebar('noticias'); ?> 
	</div><!-- #main -->
        

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
		<section class="footer-widget-area">
			<?php dynamic_sidebar( 'footer-widget-area' ); ?>
		</section>
		<?php endif; ?>
		
		<?php if (get_theme_mod( 'm1_footer_credits' )) : ?>
		<div class="site-info">
			<?php echo get_theme_mod( 'm1_footer_credits' ); ?>
		</div><!-- .site-info -->
		<?php else: ?>
		<div class="site-info">
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'm1' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'm1' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'm1' ), 'm1 Theme', '<a href="http://m1themes.com" title="m1 Themes" rel="designer">m1 Themes</a>' ); ?>
		</div><!-- .site-info -->
		<?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>