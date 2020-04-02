<style>.post__meta--flex .post__meta-left {flex: 0.5;}</style>
<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-featured-block-c<?php if( $full_background_white ){?> relive_v3_bottom_0<?php }?>">
	<div class="container">
		<?php if( $full_background_white ){?>
		<div class="relive_v3">
		<?php }?>
		<?php
		$modular_title = $id['modular_title_full'];
		if( $modular_title ){?>
		<div class="block-heading block-heading--line">
			<h4 class="block-heading__title"><?php echo $modular_title; ?></h4>
		</div>
		<?php } ?>
		<div class="row row--space-between grid-gutter-20">
			<?php
				query_posts('posts_per_page=5&ignore_sticky_posts=1&meta_key=views&orderby=meta_value_num&order=DESC');
				$i = 1;
				while (have_posts()) : the_post();
			?>
			<?php if ( 1 === $i ) : ?>
			<div class="col-xs-12 col-sm-7 col-md-8">
				<article class="post--overlay post--overlay-bottom post--overlay-md post--overlay-floorfade post--overlay-padding-lg post--overlay-primary-xs">
				<div class="background-img" style="background-image:url(<?php echo post_thumbnail(800, 600); ?>)">
				</div>
				<div class="post__text inverse-text">
					<div class="post__text-wrap">
						<div class="post__text-inner ">
							<h3 class="post__title typescale-4">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post__excerpt post__excerpt--lg hidden-xs hidden-sm">
								<div class="excerpt">
									<?php the_excerpt(); ?>
								</div>
							</div>
							<div class="post__meta post__meta--flex post__meta--border-top">
								<div class="post__meta-left">
									<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
								</div>
								<div class="post__meta-right">
									<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
									<?php if( xintheme('xintheme_post_meta_views') ){?>
									<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
				<?php xintheme_category_colors();?>
				</article>
			</div>
			<?php elseif ( 2 === $i ) : ?>
			<div class="col-xs-12 col-sm-5 col-md-4">
				<article class="post--overlay post--overlay-bottom post--overlay-md post--overlay-floorfade post--overlay-padding-lg">
				<div class="background-img " style="background-image:url(<?php echo post_thumbnail(600, 600); ?>)">
				</div>
				<div class="post__text inverse-text">
					<div class="post__text-wrap">
						<div class="post__text-inner ">
							<h3 class="post__title typescale-3">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post__meta post__meta--flex post__meta--border-top">
								<div class="post__meta-left">
									<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
								</div>
								<div class="post__meta-right">
									<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
									<?php if( xintheme('xintheme_post_meta_views') ){?>
									<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
				<?php xintheme_category_colors();?>
				</article>
			</div>
		</div>
		<div class="row row--space-between">
			<?php else : ?>
			<div class="col-xs-12 col-md-4">
				<article class="post post--horizontal post--horizontal-middle post--horizontal-xs">
				<div class="post__thumb post__thumb--circle min-height-100">
					<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
						<img width="180" height="180" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(180, 180); ?>" alt="<?php the_title(); ?>"/>
					</a>
				</div>
				<div class="post__text ">
					<?php xintheme_category_colorss();?>
					<h3 class="post__title typescale-1">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
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