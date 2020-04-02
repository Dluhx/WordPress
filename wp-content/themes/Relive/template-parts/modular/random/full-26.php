<?php $color_1 = $id['color_random_1']; $color_2 = $id['color_random_2']; ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-block--contiguous mnmd-carousel mnmd-carousel-overlap has-overlap-background">
	<div class="overlap-background background-img gradient-5-alt" style=" background: <?php echo $color_1;?>; background: -webkit-linear-gradient(160deg, <?php echo $color_2;?> 0, <?php echo $color_1;?> 100%); background: linear-gradient(160deg, <?php echo $color_1;?> 0, <?php echo $color_2;?> 100%); ">
	</div>
	<div class="container title-container hidden-xs">
	</div>
	<div class="mnmd-carousel__inner js-mnmd-carousel-overlap">
		<?php
		query_posts('posts_per_page=6&ignore_sticky_posts=1&orderby=rand');
		while (have_posts()) : the_post();
		?>
		<div class="slide-content">
			<article class="post--overlay post--overlay-bottom post--overlay-floorfade">
			<div class="background-img " style="background-image:url(<?php echo post_thumbnail(970, 480); ?>)">
			</div>
			<div class="post__text inverse-text">
				<div class="post__text-wrap">
					<div class="post__text-inner text-center max-width-sm">
						<?php xintheme_category_colorss();?>
						<h3 class="post__title typescale-5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="post__meta">
							<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
							<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
							<?php if( xintheme('xintheme_post_meta_views') ){?>
							<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
							<?php }?>
						</div>
						
					</div>
				</div>
			</div>
			<!--a href="<?php the_permalink(); ?>" class="link-overlay"></a-->
			</article>
		</div>
		<?php endwhile; wp_reset_query();?>
	</div>
</div>