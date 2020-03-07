<div class="col-xs-12 col-sm-6 col-md-3 grid-4">
	<article class="xin_hover post post--vertical">
	<div class="post__thumb min-height-210">
		<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
			<img width="400" height="200" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>"/>
		</a>
	</div>
	<div class="post__text">
		<h3 class="xin_hide post__title typescale-2">
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
	<?php
		$category_data = get_term_meta( $cat, 'category_options', true );
		$category_switch = isset($category_data['category_switch']) ?$category_data['category_switch'] : '';
		if( $category_switch || is_home() ){
			xintheme_category_colors();
		}
	?>
</div>
