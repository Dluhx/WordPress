<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth<?php if( $full_background_white ){?> relive_v3_bottom_0<?php }?>">
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
			<div class="col-xs-12 col-sm-6 col-md-5">
				<article class="post--overlay post--overlay-floorfade post--overlay-bottom post--overlay-sm">
				<div class="background-img" style="background-image:url(<?php echo post_thumbnail(600, 450); ?>)">
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
			<div class="col-xs-12 col-sm-6 col-md-3 mb-200">
				<article class="post post--vertical ">
				<div class="post__thumb min-height-200">
					<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
						<img width="400" height="300" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 300); ?>" alt="<?php the_title(); ?>"/>
					</a>
				</div>
				<div class="post__text ">
					<h3 class="post__title typescale-2">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="post__excerpt">
						<div class="excerpt">
						<?php
							$meta_data = get_post_meta(get_the_ID(), 'extend_info', true); 
							$post_abstract = isset($meta_data['post_abstract']) ?$meta_data['post_abstract'] : '';
							if(!empty($post_abstract)){
								echo mb_strimwidth($post_abstract, 0, 65,"...");
								
							}else{
								echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 65,"……");
							}
						?>
						</div>
					</div>
					<div class="post__meta">
						<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
					</div>
				</div>
				<?php xintheme_category_colors();?>
				</article>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4">
				<ul class="posts-list list-space-sm list-unstyled list-seperated">
					<?php else : ?>
					<li><article class="post post--horizontal post--horizontal-xxs post--horizontal-reverse">
					<div class="post__thumb min-height-70">
						<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
							<img width="180" height="180" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(180, 180); ?>" alt="<?php the_title(); ?>"/>
						</a>
					</div>
					<div class="post__text ">
						<h3 class="post__title typescale-0">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="post__meta">
							<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
						</div>
					</div>
					</article>
					</li>
					<?php endif; ?>
					<?php $i++; endwhile; endif; wp_reset_query();?>
				</div>
			</ul>
		</div>
	<?php if( $full_background_white ){?>
	</div>
	<?php }?>
	</div>
</div>