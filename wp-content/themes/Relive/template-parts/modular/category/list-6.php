<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_list_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block<?php if( $full_background_white ){?> relive_v3<?php }?>">
	<div class="row row--space-between">
		<?php
		if($categories= $id['modular_cat_list']);
		foreach ($categories as $cat=>$catid ){
		?>
		<div class="col-xs-12 col-sm-6">
			<div class="block-heading block-heading--line">
				<h4 class="block-heading__title"><?php $cat = get_category($catid);echo $cat->name; ?></h4>
			</div>
			<div class="row row--space-between">
				<?php
					query_posts( 'cat='.$catid.'&posts_per_page=6,&ignore_sticky_posts=1' );
					$i = 1;
					while( have_posts() ): the_post();
				?>
				<?php if ( 1 === $i ) : ?>
				<div class="col-xs-12">
					<article class="post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-xs">
					<div class="background-img " style="background-image:url(<?php echo post_thumbnail(600, 338); ?>)">
					</div>
					<div class="post__text inverse-text">
						<div class="post__text-wrap">
							<div class="post__text-inner ">
								<h3 class="xin_hide post__title typescale-2">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
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
					</div>
					<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
					<?php xintheme_category_colors();?>
					</article>
				</div>
				<?php elseif ( 2 === $i ) : ?>
				<div class="col-xs-6">
					<article class="xin_hover post post--vertical ">
					<div class="post__thumb min-height-132">
						<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
							<img <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>" width="400" height="200">
						</a>
					</div>
					<div class="post__text ">
						<h3 class="xin_hide post__title typescale-0">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
					</div>
					<?php xintheme_category_colors();?>
					</article>
				</div>
				<?php elseif ( 3 === $i ) : ?>
				<div class="col-xs-6">
					<article class="xin_hover post post--vertical ">
					<div class="post__thumb min-height-132">
						<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
							<img <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>" width="400" height="200">
						</a>
					</div>
					<div class="post__text ">
						<h3 class="xin_hide post__title typescale-0">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
					</div>
					<?php xintheme_category_colors();?>
					</article>
				</div>
				<div class="col-xs-12">
					<ul class="list-space-xs list-unstyled list-seperated list-square-bullet">
						<?php else : ?>
						<li><article class="post post--horizontal ">
						<div class="post__text ">
							<h3 class="xin_hide post__title typescale-0">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
						</div>
						</article>
						</li>
						<?php endif; ?>
						<?php $i++; endwhile; wp_reset_query();?>
					</ul>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>