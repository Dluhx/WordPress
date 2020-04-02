<div class="posts-navigation single-entry-section clearfix">
	<?php
		$prev_post = get_previous_post();
		if(!empty($prev_post)):?>
	<div class="posts-navigation__prev">
		<article class="post--overlay post--overlay-bottom post--overlay-floorfade">
		<div class="background-img" style="background-image:url(<?php echo xintheme_prev_thumbnail_url(); ?>)">
		</div>
		<div class="post__text inverse-text">
			<div class="post__text-wrap">
				<div class="post__text-inner">
					<h3 class="post__title typescale-1"><?php echo $prev_post->post_title;?></h3>
				</div>
			</div>
		</div>
		<a href="<?php echo get_permalink($prev_post->ID);?>" class="link-overlay"></a>
		</article>
		<a class="posts-navigation__label" href="<?php echo get_permalink($prev_post->ID);?>" style="background: <?php echo xintheme('xintheme_post_prev_next_bg_color');?>"><span><i class="iconfont icon-return"></i>上一篇</span></a>
	</div>
	<?php endif;?>
	<?php
		$next_post = get_next_post();
		if(!empty($next_post)):?>
	<div class="posts-navigation__next">
		<article class="post--overlay post--overlay-bottom post--overlay-floorfade">
		<div class="background-img" style="background-image:url(<?php echo xintheme_next_thumbnail_url(); ?>)">
		</div>
		<div class="post__text inverse-text">
			<div class="post__text-wrap">
				<div class="post__text-inner">
					<h3 class="post__title typescale-1"><?php echo $next_post->post_title;?></h3>
				</div>
			</div>
		</div>
		<a href="<?php echo get_permalink($next_post->ID);?>" class="link-overlay"></a>
		</article>
		<a class="posts-navigation__label" href="<?php echo get_permalink($next_post->ID);?>" style="background: <?php echo xintheme('xintheme_post_prev_next_bg_color');?>"><span>下一篇<i class="iconfont icon-enter"></i></span></a>
	</div>
	<?php endif;?>
</div>