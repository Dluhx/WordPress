<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-featured-with-list mnmd-featured-with-list--horizontal-list mnmd-block--contiguous">
	<div class="mnmd-featured-with-list__wrapper mnmd-block__inner js-overlay-bg">
		<?php  
			$sticky = get_option('sticky_posts');  
			rsort( $sticky );  
			query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts'=>1, 'posts_per_page'=>1) );
			if (have_posts()) :  
			while (have_posts()) : the_post();  
		?>
		<div class="main-background background-img hidden-xs hidden-sm" style="background-image:url(<?php echo post_thumbnail(2000, 1125); ?>)">
		</div>
		<div class="mnmd-featured-with-list__inner">
			<article class="main-post post">
			<div class="main-post__inner">
				<div class="background-img background-img--darkened hidden-md hidden-lg" style="background-image:url(<?php echo post_thumbnail(600, 450); ?>)">
				</div>
				<div class="post__text inverse-text text-center max-width-md">
					<?php xintheme_category_colorss();?>
					<h3 class="post__title typescale-6">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="post__excerpt post__excerpt--lg hidden-xs">
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>
					</div>
					<div class="post__meta">
						<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
						<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
						<?php if( xintheme('xintheme_post_meta_comment') ){?>
						<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
						<?php }?>
						<?php if( xintheme('xintheme_post_meta_views') ){?>
						<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
						<?php }?>
					</div>
				</div>
			</div>
			</article>
			<div class="sub-posts js-overlay-bg-sub-area">
				<div class="js-overlay-bg-sub sub-background background-img blurred hidden-xs hidden-sm" style="background-image:url(<?php echo post_thumbnail(2000, 1125); ?>)">
				</div>
				<?php endwhile; endif; wp_reset_query();?>
				<div class="sub-posts__inner">
					<ul class="posts-list list-space-md list-seperated list-unstyled">
						<?php  
							$sticky = get_option('sticky_posts');  
							rsort( $sticky );  
							query_posts( array( 'post__in' => $sticky, 'posts_per_page'=>3, 'ignore_sticky_posts'=>1, 'offset'=>1) );
							if (have_posts()) :  
							while (have_posts()) : the_post();  
						?>
						<li>
							<article class="post post--horizontal post--horizontal-middle post--horizontal-xs">
							<div class="post__thumb post__thumb--circle min-height-100">
								<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
									<img width="180" height="180" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(180, 180); ?>" alt="<?php the_title(); ?>"/>
								</a>
							</div>
							<div class="post__text inverse-text">
								<?php xintheme_category_colorss();?>
								<h3 class="post__title typescale-1">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
							</div>
							</article>
						</li>
						<?php endwhile; endif; wp_reset_query();?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>