<style>.post--card-sm .post__thumb {height: 200px;}</style>
<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-featured-block-d<?php if( $full_background_white ){?> relive_v3_bottom_0<?php }?>">
	<div class="container grid-gutter-20">
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
		<div class="row row--space-between">
			<?php
				$sticky = get_option('sticky_posts');  
				rsort( $sticky );  
				query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts'=>1, 'posts_per_page'=>6) );
				if (have_posts()) :  
				$i = 1;
				while (have_posts()) : the_post();
			?>
			<?php if ( 1 === $i ) : ?>
			<div class="col-xs-12 col-md-6">
				<article class="post--overlay post--overlay-bottom post--overlay-sm post--overlay-floorfade post--overlay-padding-lg has-score-badge">
				<div class="background-img " style="background-image:url(<?php echo post_thumbnail(600, 450); ?>)">
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
				<?php xintheme_category_colors();?>
			</div>
			<?php elseif( 6 === $i): ?>
			<div class="col-xs-12 col-md-6">
				<article class="post--overlay post--overlay-bottom post--overlay-sm post--overlay-floorfade post--overlay-padding-lg has-score-badge">
				<div class="background-img " style="background-image:url(<?php echo post_thumbnail(600, 450); ?>)">
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
				<?php xintheme_category_colors();?>
			</div>
			<?php else : ?>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<article class="post post--card post--card-sm ">
				<div class="post__thumb">
					<a href="<?php the_permalink(); ?>" style="-moz-transform: initial;-webkit-transform: initial;">
						<div class="background-img" style="background-image:url(<?php echo post_thumbnail(400, 260); ?>)">
						</div>
					</a>
					<?php xintheme_category_colorsss();?>
				</div>
				<div class="post__text text-center">
					<h3 class="xin_no_hide post__title typescale-1">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>

				</div>
				<div class="post__footer">
					<div class="post__footer-left post__meta">
						<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
					</div>
					<div class="post__footer-right post__meta">
						<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
					</div>
				</div>
				</article>
			</div>
			<?php endif; ?>
			<?php $i++; endwhile; endif; wp_reset_query();?>
		</div>
	<?php if( $full_background_white ){?>
	</div>
	<?php }?>
	</div>
</div>