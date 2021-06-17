<?php
/**
 * Template part for displaying posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package assentpress 
 */
$assentpress_list_view_content_ordering = get_theme_mod( 'consultstreet_list_view_content_ordering', array( 'meta-one', 'title', 'meta-two' ));
?>
<article class="post media" <?php post_class(); ?>>		
		   <?php 
			if(has_post_thumbnail()){
			echo '<figure class="post-thumbnail"><a href="'.esc_url(get_the_permalink()).'">';
			the_post_thumbnail( '', array( 'class'=>'img-fluid' ) );
			echo '</a></figure>';
			} ?>		
		    <div class="media-body post-content">
			<?php foreach ( $assentpress_list_view_content_ordering as $assentpress_list_view_content_order ) : ?>	
			    <?php if ( 'meta-one' === $assentpress_list_view_content_order ) : ?>	
				<div class="entry-meta">
					<?php if(is_sticky()) : ?>
						<span class="sticky-post"><?php esc_html_e('Featured', 'assentpress'); ?></span>
						<?php endif; ?>
				    <?php
					if(!empty(get_the_category_list(  ))) {
					echo '<span class="cat-links">' . get_the_category_list( esc_html( '  ' ) ) . '</span>';
					} ?>
				</div>	
				<?php elseif ( 'title' === $assentpress_list_view_content_order ) : ?>
				<header class="entry-header">
					<?php 
					the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h4>' );
					?>
				</header>
				<?php elseif ( 'meta-two' === $assentpress_list_view_content_order ) : ?>
				<div class="entry-meta">
					<span class="author">
						<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' )) );?>"><span class="grey"><?php echo esc_html__('by ','assentpress');?></span><?php echo esc_html(get_the_author());?></a>	
					</span>
					<span class="posted-on">
					<a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><time>
					<?php echo esc_html(get_the_date('M j, Y')); ?></time></a>
					</span>
				</div>
			 <?php  endif; endforeach; ?>	
				<div class="entry-content">
					<?php the_content( __('Read More','assentpress') ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'assentpress' ), 'after'  => '</div>', ) ); ?>
		 		</div>
		    </div>	
</article>
<!-- #post-<?php the_ID(); ?> -->