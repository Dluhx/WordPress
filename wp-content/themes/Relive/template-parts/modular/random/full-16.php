<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth has-background">
<style>.site-content {padding-top: 0 !important;}</style>
	<div class="background-img gradient-4" style=" background: #12162d; background: -webkit-linear-gradient(180deg, #12162d 0, #12162d 100%); background: linear-gradient(180deg, #12162d 0, #12162d 100%); ">
		<div class="background-svg-pattern">
		</div>
	</div>
	<div class="container">
		<?php
		$modular_title = $id['modular_title_full'];
		if( $modular_title ){?>
		<div class="block-heading block-heading--line block-heading--inverse">
			<h4 class="block-heading__title"><?php echo $modular_title; ?></h4>
		</div>
		<?php } ?>
		<div class="row row--space-between">
			<?php
				query_posts('posts_per_page=4&ignore_sticky_posts=1&orderby=rand');
				$i = 1;
				while (have_posts()) : the_post();
			?>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<article class="post post--card post--card-sm text-center post--vertical-cat-overlap">
				<div class="post__thumb">
					<a href="<?php the_permalink(); ?>">
						<div class="background-img" style="background-image:url(<?php echo post_thumbnail(400, 225); ?>)"></div>
					</a>
					<?php xintheme_category_colorsss();?>
				</div>
				<div class="post__text ">
					<h3 class="post__title typescale-1">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
				<!--div class="post__excerpt post__excerpt--lg hidden-xs">
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div-->
				</div>
				<div class="post__footer text-center">
					<div class="post__meta">
						<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
						<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
						<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
					</div>
				</div>
				</article>
			</div>
			<?php endwhile; wp_reset_query();?>
		</div>
	</div>
</div>