<?php get_header();
	while( have_posts() ): the_post(); $p_id = get_the_ID();?>
	<div class="site-content">
	<?php if( xintheme('xintheme_post_indent') ) : ?>
	<style>.single-body p {text-indent: 2em;}</style>
	<?php endif; ?>
		<div class="mnmd-block mnmd-block--fullwidth">
			<div class="container">
				<div class="row">
					<div class="mnmd-main-col ">
						<article class="mnmd-block post">
						<div class="single-content">
							<header class="single-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							</header>
							<div class="single-body entry-content typography-copy">
							<?php the_content();?>
							</div>
							<?php endwhile; wp_reset_query(); ?>
							</footer>
						</div>
						</article>
						<?php comments_template();?>
					</div>
					<?php get_sidebar();?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>