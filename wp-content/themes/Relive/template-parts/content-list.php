<?php get_template_part('template-parts/post_list_ad'); ?>
<?php if( has_post_format( 'image' )) { //图像 ?>
<div class="list-item">
	<article class="post--overlay post--overlay-floorfade post--overlay-bottom post--overlay-sm post--overlay-padding-lg">
	<div class="background-img " style="background-image:url(<?php echo post_thumbnail(800, 450); ?>)">
	</div>
	<div class="post__text inverse-text">
		<div class="post__text-wrap">
			<div class="post__text-inner ">
				<h3 class="post__title typescale-4">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="post__excerpt ">
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<div class="post__meta post__meta--flex post__meta--border-top">
					<div class="post__meta-left">
						<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
					</div>
					<div class="post__meta-right">
						<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time><?php if( xintheme('xintheme_post_meta_views') ){?><span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span><?php }?><?php if( xintheme('xintheme_post_meta_comment') ){?><span class="mobile-none"><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span><?php }?>
						<?php $open_ucenter = xintheme('open_ucenter');
						if( $open_ucenter ){
							// include(TEMPLATEPATH.'/user/template/action-meta.php'); 
						}?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
	<?php
		$category_data = get_term_meta( $cat, 'category_options', true );
		$category_switch = isset($category_data['category_switch']) ?$category_data['category_switch'] : '';
		if( $category_switch || is_home() ){
			xintheme_category_colors();
		}
	?>
	</article>
</div>
<?php } else{  ?>
<div class="list-item">
	<article class="xin_hover post post--horizontal post--horizontal-sm">
	<div class="post__thumb min-height-160">
		<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
			<img <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>" width="400" height="200">
			<?php if( has_post_format( 'gallery' )) { //相册 ?>
			<div class="overlay-item post-type-icon--inverse gallery-icon">
				<i class="iconfont icon-h-album"></i>
				<span><?php echo xintheme_post_images_number(); ?></span>
			</div>
			<?php } else if ( has_post_format( 'video' )) { //视频 ?>
			<div class="post-type-icon overlay-item post-type-icon--inverse overlay-item--sm-p">
				<i class="iconfont icon-shipin1"></i>
			</div>
			<?php } ?>
		</a>
	</div>
	<div class="post__text ">
		<?php
			$category_data = get_term_meta( $cat, 'category_options', true );
			$category_switch = isset($category_data['category_switch']) ?$category_data['category_switch'] : '';
			if( $category_switch || is_home() ){
				xintheme_category_color();
			}
		?>
		<h3 class="post__title typescale-2 xin-underline">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<div class="post__excerpt ">
			<div class="excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>
		<div class="post__meta xin_meta">
			<span class="entry-author mobile-none"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
			<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time><?php if( xintheme('xintheme_post_meta_views') ){?><span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span><?php }?><?php if( xintheme('xintheme_post_meta_comment') ){?><span class="mobile-none"><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span><?php }?>
			<?php $open_ucenter = xintheme('open_ucenter');
			if( $open_ucenter ){
				// include(TEMPLATEPATH.'/user/template/action-meta.php'); 
			}?>
		</div>
	</div>
	</article>
</div>
<?php } ?>