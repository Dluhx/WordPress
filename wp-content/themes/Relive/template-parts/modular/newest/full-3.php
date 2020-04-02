<?php
$exclude_category = $id['full_newest_exclude_category'];
if( $exclude_category ){
	$pool = array();
	foreach ($exclude_category as $cat=>$catid) {
		if( $catid ) $pool[] = $catid;
	}
	$exclude_id = '-'.implode($pool, ',-');
}?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth featured-with-overlap-posts mnmd-block--contiguous">
	<?php query_posts('cat='.$exclude_id.'&posts_per_page=1&ignore_sticky_posts=1&orderby=date'); ?>
	<?php while (have_posts()) : the_post(); ?>
	<article class="main-post post">
	<div class="background-img" style="background-image:url(<?php echo post_thumbnail(2000, 1125); ?>)">
	</div>
	<div class="post__text inverse-text">
		<div class="container">
			<div class="post__text-inner max-width-sm text-center">
				<?php xintheme_category_colorss();?>
				<h3 class="post__title typescale-5">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="post__excerpt post__excerpt--lg hidden-xs">
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<div class="post__meta">
					<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
					<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
					<?php if( xintheme('xintheme_post_meta_views') ){?>
					<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
					<?php }?>
					<?php if( xintheme('xintheme_post_meta_comment') ){?>
					<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	</article>
	<?php endwhile; wp_reset_query();?>
	<div class="container">
		<div class="sub-posts">
			<ul class="row row--space-between">
				<?php query_posts('cat='.$exclude_id.'&posts_per_page=4&ignore_sticky_posts=1&orderby=date&offset=1'); ?>
				<?php while (have_posts()) : the_post(); ?>
				<li class="col-xs-6 col-md-3 mb-123">
				<article class="xin_hover post post--vertical post--vertical-cat-overlap">
				<div class="post__thumb tnm-default-thumb min-height-160">
					<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
						<img width="400" height="200" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>"/>
					</a>
					<?php xintheme_category_colorsss();?>
				</div>
				<div class="post__text text-center">
					<h3 class="post__title typescale-1">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="post__meta">
						<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
						<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
						<?php if( xintheme('xintheme_post_meta_views') ){?>
						<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
						<?php }?>
					</div>
				</div>
				</article>
				</li>
				<?php endwhile; wp_reset_query();?>
			</ul>
		</div>
	</div>
</div>