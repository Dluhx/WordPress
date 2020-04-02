<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth<?php if( $full_background_white ){?> relive_v3_bottom_0<?php }?>">
	<div class="container">
		<?php if( $full_background_white ){?>
		<div class="relive_v3">
		<?php }?>
		<div class="row row--space-between">
			<?php
			if($categories= $id['modular_cat_full']);
			foreach ($categories as $cat=>$catid ){
			?>
			<div class="col-xs-12 col-md-4">
				<div class="block-heading block-heading--line">
					<h4 class="block-heading__title"><?php $cat = get_category($catid);echo $cat->name; ?></h4>
				</div>
				<?php
					query_posts( 'cat='.$catid.'&posts_per_page=5,&ignore_sticky_posts=1' );
					$i = 1;
					while( have_posts() ): the_post();
				?>
				<?php if ( 1 === $i ) : ?>
				<article class="post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-xs">
				<div class="background-img " style="background-image:url(<?php echo post_thumbnail(600, 338); ?>)">
				</div>
				<div class="post__text inverse-text">
					<div class="post__text-wrap">
						<div class="post__text-inner ">
							<h3 class="post__title typescale-2">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post__meta ">
								<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
								<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
							</div>
						</div>
					</div>
				</div>
				<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
				<?php xintheme_category_colors();?>
				</article>
				<div class="spacer-xs">
				</div>
				<ul class="list-space-xs list-square-bullet-exclude-first list-seperated list-unstyled">
					<?php elseif ( 2 === $i ) : ?>
					<li><article class="post post--horizontal post--horizontal-xs">
					<div class="post__thumb mb-90 min-height-75">
						<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
							<img width="180" height="135" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(180, 135); ?>" alt="<?php the_title(); ?>"/>
						</a>
					</div>
					<div class="post__text ">
						<h3 class="post__title typescale-1">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="post__meta">
							<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
						</div>
					</div>
					</article>
					</li>
					<?php else : ?>
					<li><article class="post post--horizontal ">
					<div class="post__text ">
						<h3 class="post__title typescale-0 xin_hide">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
					</div>
					</article>
					</li>
					<?php endif; ?>
					<?php $i++; endwhile; wp_reset_query();?>
				</ul>
			</div>
			<?php } ?>
		</div>
	<?php if( $full_background_white ){?>
	</div>
	<?php }?>
	</div>
</div>