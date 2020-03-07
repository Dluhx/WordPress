<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-featured-block-a has-background mnmd-block--contiguous">
	<?php query_posts('posts_per_page=1&ignore_sticky_posts=1&meta_key=views&orderby=meta_value_num&order=DESC'); ?>
	<?php while (have_posts()) : the_post(); ?>
	<div class="background-img">
		<div class="background-img background-img--darkened blurred hidden-xs" style="background-image:url(<?php echo post_thumbnail(2000, 1125); ?>)">
		</div>
	</div>
	<div class="container">
		<div class="main-post-wrap">
			<div class="background-img background-img--darkened visible-xs" style="background-image:url(<?php echo post_thumbnail(800, 600); ?>)">
			</div>
			<article class="main-post post">
			<div class="post__text inverse-text max-width-sm">
				<?php xintheme_category_colorss();?>
				<h3 class="post__title typescale-6">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="post__meta">
					<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
					<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
					<?php if( xintheme('xintheme_post_meta_views') ){?>
					<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
					<?php } ?>
					<?php if( xintheme('xintheme_post_meta_comment') ){?>
					<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
					<?php } ?>
				</div>
				<div class="post__excerpt">
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
			</div>
			</article>
		</div>
	</div>
	<?php endwhile; wp_reset_query();?>
	<div class="container">
		<div class="sub-posts-wrap">
			<div class="sub-posts hidden-xs">
				<div class="row row--space-between">
					<?php query_posts('posts_per_page=4&ignore_sticky_posts=1&meta_key=views&orderby=meta_value_num&order=DESC&offset=1'); ?>
					<?php while (have_posts()) : the_post(); ?>
					<div class="col-xs-6 col-md-3">
						<article class="xin_hover post post--vertical post--vertical-cat-overlap text-center">
						<div class="post__thumb min-height-160">
							<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
								<img width="400" height="200" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>"/>
							</a>
							<?php xintheme_category_colorsss();?>
						</div>
						<div class="post__text inverse-text">
							<h3 class="post__title typescale-1">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post__meta">
								<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
								<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
								<?php if( xintheme('xintheme_post_meta_views') ){?>
								<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
								<?php } ?>
							</div>
						</div>
						</article>
					</div>
					<?php endwhile; wp_reset_query();?>
				</div>
			</div>
			<div class="sub-posts inverse-text visible-xs">
				<ul class="list-unstyled list-space-sm list-seperated">
					<?php query_posts('posts_per_page=4&ignore_sticky_posts=1&meta_key=views&orderby=meta_value_num&order=DESC&offset=1'); ?>
					<?php while (have_posts()) : the_post(); ?>
					<article class="post post--horizontal post--horizontal-middle post--horizontal-xxs">
					<div class="post__thumb min-height-70">
						<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
							<img width="400" height="400" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 400); ?>" alt="<?php the_title(); ?>"/>
						</a>
					</div>
					<div class="post__text inverse-text">
						<h3 class="post__title typescale-0">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="post__meta">
							<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
							<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
							<?php if( xintheme('xintheme_post_meta_views') ){?>
							<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
							<?php } ?>
						</div>
					</div>
					</article>
					<?php endwhile; wp_reset_query();?>
				</ul>
			</div>
		</div>
	</div>
</div>