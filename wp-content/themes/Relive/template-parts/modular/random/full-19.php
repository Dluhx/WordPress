<?php $color_1 = $id['color_random_1']; $color_2 = $id['color_random_2']; ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-mosaic mnmd-mosaic--has-shadow mnmd-mosaic--gutter-10 has-overlap-background mnmd-block--contiguous">
	<div class="overlap-background background-img gradient-4" style=" background: <?php echo $color_1;?>; background: -webkit-linear-gradient(180deg, <?php echo $color_2;?> 0, <?php echo $color_1;?> 100%); background: linear-gradient(180deg, <?php echo $color_2;?> 0, <?php echo $color_1;?> 100%); ">
	</div>
	<div class="container container--wide">
		<div class="row row--space-between">
			<?php
				query_posts('posts_per_page=3&ignore_sticky_posts=1&orderby=rand');
				$i = 1;
				while (have_posts()) : the_post();
			?>
			<div class="mosaic-item col-xs-12 col-md-6 <?php if ( 1 === $i ) : ?><?php else : ?>col-md-3<?php endif; ?>">
				<article class="post--overlay post--overlay-bottom post--overlay-md post--overlay-floorfade">
				<div class="background-img " style="background-image:url(<?php if ( 1 === $i ) : ?><?php echo post_thumbnail(600, 450); ?><?php else : ?><?php echo post_thumbnail(400, 400); ?><?php endif; ?>)">
				</div>
				<div class="post__text inverse-text">
					<div class="post__text-wrap">
						<div class="post__text-inner inverse-text">
							<h3 class="post__title typescale-3">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post__meta post__meta--flex post__meta--border-top">
								<div class="post__meta-left">
									<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
								</div>
								<div class="post__meta-right">
									<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
								</div>
							</div>
						</div>
					</div>
				</div>
				<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
				<?php xintheme_category_colors();?>
			</div>
			<?php $i++; endwhile; wp_reset_query();?>
		</div>
	</div>
</div>