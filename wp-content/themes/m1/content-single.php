<?php
/**
 * @package m1 Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-meta">
			<?php m1_posted_on(); ?>
		</div><!-- .entry-meta -->

	<div class="entry-content">
		<?php if (has_post_thumbnail())
			the_post_thumbnail(); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'm1' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'm1' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'm1' ) );

			if ( ! m1_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'Categoria: %1$s Tags: %2$s', 'm1' );
				} else {
					$meta_text = __( '', 'm1' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'Categoria: %1$s Tags: %2$s', 'm1' );
				} else {
					$meta_text = __( 'Categoria: %1$s', 'm1' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php edit_post_link( __( 'Edit', 'm1' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
