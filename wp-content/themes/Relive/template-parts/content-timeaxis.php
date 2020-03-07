<div class="timeaxis-list-item">
	<div class="timeaxis-node-diamond"></div>
	<div class="timeaxis-node-card">
		<div class="timeaxis-node_time js-timeaxis-node_time">
			<?php echo date_i18n( __( 'Y-m-d H:i:s' ), strtotime( $post->post_date ) ); ?>
		</div>
		<div class="timeaxis-node_title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
		<div class="timeaxis-node_excerpt">
			<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"..."); ?>
		</div>
		<a href="<?php the_permalink(); ?>"><i class="iconfont icon-fenxiang"></i><span>阅读更多</span></a>
	</div>
</div>