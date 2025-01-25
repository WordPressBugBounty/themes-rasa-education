<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rasa Education
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-item">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                <a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
            </div><!-- .featured-image -->
		<?php } ?>

		<div class="entry-container">
			<div class="entry-meta">
                <?php rasa_education_posted_on(); ?>
            </div><!-- .entry-meta -->
	            
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->

			<?php $rasa_education_readmore_text = rasa_education_get_option( 'readmore_text' );?>
            <?php if (!empty($rasa_education_readmore_text) ) :?>
                <div class="read-more">
                    <a href="<?php the_permalink();?>"><?php echo esc_html($rasa_education_readmore_text);?><i class="fa fa-long-arrow-alt-right"></i></a>
                </div><!-- .read-more -->
            <?php endif; ?>
		</div><!-- .entry-container -->
	</div><!-- .post-item -->
</article><!-- #post-## -->
