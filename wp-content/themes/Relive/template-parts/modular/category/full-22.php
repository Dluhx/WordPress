<?php
$modular_title = $id['modular_title_full'];
if($categories = $id['modular_cat_full']);
foreach ($categories as $cat=>$catid ){
?>
<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth<?php if( $full_background_white ){?> relive_v3_bottom_0<?php }?>">
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
			<div class="col-xs-12 col-sm-6">
				<article class="post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-sm">
				<div class="background-img " style="background-image:url(<?php echo post_thumbnail(600, 300); ?>)">
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
				</article>
			</div>
			<?php elseif ( 2 === $i ) : ?>
			<div class="col-xs-12 col-sm-6">
				<article class="post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-sm">
				<div class="background-img " style="background-image:url(<?php echo post_thumbnail(600, 300); ?>)">
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
				</article>
			</div>
		</div>
		<div class="row row--space-between">
			<?php else : ?>
			<div class="col-xs-12 col-md-4">
				<article class="xin_hover post post--vertical ">
				<div class="post__thumb min-height-210">
					<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
						<img width="400" height="200" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>"/>
					</a>
				</div>
				<div class="post__text ">
					<h3 class="xin_hide post__title typescale-1">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<!--div class="post__meta">
						<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
					</div-->
				</div>
				<?php xintheme_category_colors();?>
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