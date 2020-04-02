<div class="post__meta">
	<?php if( $id['xintheme_post_meta'] == 'author' ){?>
	<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
	<?php } ?>
	<?php if( $id['xintheme_post_meta'] == 'time' ){?>
	<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
	<?php } ?>
	<?php if( $id['xintheme_post_meta'] == 'views' ){?>
	<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
	<?php } ?>
	<?php if( $id['xintheme_post_meta'] == 'comment' ){?>
	<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
	<?php } ?>
	<?php if( $id['xintheme_post_meta'] == 'collection' ){?>
	<?php
	$open_ucenter = xintheme('open_ucenter');
	if( $open_ucenter ){
		include(TEMPLATEPATH.'/user/template/action-meta.php'); 
	}?>
	<?php } ?>
</div>