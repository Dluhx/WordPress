<div class="list-item">
	<article class="xin_hover post post--horizontal post--horizontal-sm">
	<div class="post__thumb min-height-160">
		<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
			<img src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>" width="400" height="200">
		</a>
	</div>
	<div class="post__text ">
		<?php xintheme_category_color();?>
		<h3 class="post__title typescale-2">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<div class="post__excerpt ">
			<div class="excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>		
		<?php if( $post->post_status=='publish' ){ ?>		
		<div class="post__meta xin_meta">
			<?php if(isset($_GET['collect'])){ ?>
			<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
			<?php } ?><time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time><span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span><span class="comment"><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
			<?php include(TEMPLATEPATH.'/user/template/action-meta.php'); ?>
		</div>
		<?php } ?>
		<?php if( $post->post_status!='publish' ){ 
			$meta_output = '<div class="post__meta xin_meta">';
				if( $post->post_status==='pending' ) $meta_output .= sprintf(__('正在等待审核，你可以 <a href="%1$s" style="color: #FC3C2D;">预览</a> 或 <a href="%2$s" style="color: #FC3C2D;">重新编辑</a> 。','tinection'), get_permalink(), get_edit_post_link() );
				if( $post->post_status==='draft' ) $meta_output .= sprintf(__('这是一篇草稿，你可以 <a href="%1$s" style="color: #FC3C2D;margin-right: 0;">预览</a> 或 <a href="%2$s" style="color: #FC3C2D;">继续编辑</a> 。','tinection'), get_permalink(), get_edit_post_link() );
				$meta_output .= '</div>';
				echo $meta_output;
		} ?>
	</div>
	</article>	
</div>