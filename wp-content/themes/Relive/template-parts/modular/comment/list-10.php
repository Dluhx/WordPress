<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_list_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block<?php if( $full_background_white ){?> relive_v3<?php }?>">
	<?php
	$modular_title = $id['modular_title_list'];
	if( $modular_title ){?>
	<div class="block-heading block-heading--line">
		<h4 class="block-heading__title"><?php echo $modular_title; ?></h4>
	</div>
	<?php } ?>
	<div class="posts-listing">
		<div class="row row--space-between posts-list">
			<?php
				query_posts('posts_per_page=6&ignore_sticky_posts=1&orderby=comment_count');
				while (have_posts()) : the_post();
			?>
			<div class="col-xs-12 col-sm-6 col-md-4 mb-w50">
				<article class="xin_hover post post--vertical ">
				<div class="post__thumb min-height-150">
					<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
						<img <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>" width="400" height="200">
					</a>
				</div>
				<div class="post__text ">
					<h3 class="xin_hide post__title typescale-1">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="post__meta">
						<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
						<?php if( xintheme('xintheme_post_meta_comment') ){?>
						<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
						<?php }?>
						<?php if( xintheme('xintheme_post_meta_views') ){?>
						<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
						<?php }?>
					</div>
				</div>
				<?php xintheme_category_colors();?>
				</article>
			</div>
			<?php endwhile; wp_reset_query();?>
		</div>
	</div>
</div>