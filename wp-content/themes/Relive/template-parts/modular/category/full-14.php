<?php
$modular_title = $id['modular_title_full'];
if($categories = $id['modular_cat_full']);
foreach ($categories as $cat=>$catid ){
?>
<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-featured-block-g<?php if( $full_background_white ){?> relive_v3_bottom_0<?php }?>">
	<div class="container">
		<?php if( $full_background_white ){?>
		<div class="relive_v3">
		<?php }?>
		<?php if( $modular_title ){?>
		<div class="block-heading block-heading--line">
			<h4 class="block-heading__title"><?php echo $modular_title; ?></h4>
		</div>
		<?php } ?>
		<div class="row row--space-between">
			<?php
				query_posts( 'cat='.$catid.'&posts_per_page=5,&ignore_sticky_posts=1' );
				$i = 1;
				while( have_posts() ): the_post();
			?>
			<?php if ( 1 === $i ) : ?>
			<div class="col-xs-12">
				<article class="post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-md">
				<div class="background-img " style="background-image:url(<?php echo post_thumbnail(1200, 600); ?>)">
				</div>
				<div class="post__text inverse-text">
					<div class="post__text-wrap">
						<div class="post__text-inner text-center max-width-md">
							<?php xintheme_category_colorss();?>
							<h3 class="post__title typescale-5">
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
					</div>
				</div>
				<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
				</article>
			</div>
		</div>
		<div class="row row--space-between">
			<?php else : ?>
			<div class="col-sm-6 col-md-3 mb-200">
				<article class="xin_hover post post--vertical post--vertical-cat-overlap text-center">
				<div class="post__thumb min-height-160">
					<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
						<img width="400" height="200" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>"/>
					</a>
					<?php xintheme_category_colorsss();?>
				</div>
				<div class="post__text ">
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
			<?php $i++; endwhile; wp_reset_query();?>
		</div>
	<?php if( $full_background_white ){?>
	</div>
	<?php }?>
	</div>
</div>
<?php } ?>