<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-featured-block-f has-background lightgray-bg mnmd-block--contiguous">
	<div class="container">
		<?php
		$modular_title = $id['modular_title_full'];
		if( $modular_title ){?>
		<div class="block-heading block-heading--line">
			<h4 class="block-heading__title"><?php echo $modular_title; ?></h4>
		</div>
		<?php } ?>
		<div class="row row--space-between">
			<?php
				$sticky = get_option('sticky_posts');  
				rsort( $sticky );  
				query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts'=>1, 'posts_per_page'=>5) );
				if (have_posts()) :  
				$i = 1;
				while (have_posts()) : the_post();
			?>
			<?php if ( 1 === $i ) : ?>
			<div class="col-xs-12 col-sm-6">
				<article class="xin_hover post post--vertical ">
				<div class="post__thumb min-height-345">
					<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
						<img width="600" height="338" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(600, 338); ?>"  alt="<?php the_title(); ?>"/>
					</a>
				</div>
				<div class="post__text ">
					<?php xintheme_category_color();?>
					<h3 class="post__title typescale-5">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
				<div class="post__excerpt ">
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<div class="post__meta">
					<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
					<?php if( xintheme('xintheme_post_meta_views') ){?>
					<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
					<?php }?>
					<?php if( xintheme('xintheme_post_meta_comment') ){?>
					<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
					<?php }?>
				</div>
				</div>
				</article>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="row row--space-between">
					<?php else : ?>
					<div class="col-sm-6">
						<article class="xin_hover post post--vertical ">
						<div class="post__thumb min-height-180">
							<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
								<img width="400" height="225" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 225); ?>" alt="<?php the_title(); ?>"/>
							</a>
						</div>
						<div class="post__text ">
							<?php xintheme_category_colors();?>
							<h3 class="post__title typescale-1">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post__meta">
								<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
								<?php if( xintheme('xintheme_post_meta_views') ){?>
								<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
								<?php }?>
								<?php if( xintheme('xintheme_post_meta_comment') ){?>
								<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
								<?php }?>
							</div>
						</div>
						</article>
					</div>
					<?php endif; ?>
					<?php $i++; endwhile; endif; wp_reset_query();?>
				</div>
			</div>
		</div>
	</div>
</div>