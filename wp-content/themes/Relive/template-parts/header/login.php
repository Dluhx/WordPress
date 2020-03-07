<?php 
	global $current_user;
	wp_get_current_user();
?>
<div class="bk-lwa navigation-bar-btn">
	<table>
		<tr>
			<td class="avatar lwa-avatar bk-avatar">
				<a href="#"><?php echo xintheme_get_avatar( $current_user->ID , '27' , xintheme_get_avatar_type($current_user->ID) ); ?></a>
				<div class="bk-username visible-xs visible-sm">
					<a href="<?php echo get_author_posts_url($current_user->ID); ?>"><?php echo  esc_attr($current_user->display_name);  ?></a>
				</div>
				<div class="bk-canvas-logout visible-xs visible-sm">
					<i class="iconfont icon-084tuichu"></i>
					<a class="wp-logout" href="<?php echo wp_logout_url( home_url(add_query_arg(array(),$wp->request)) ); ?>">退出登录</a>
				</div>
			</td>
		</tr>
	</table>
	<div class="bk-account-info hidden-xs hidden-sm">
		<div class="bk-lwa-profile">
			<div class="bk-avatar">
				<?php echo xintheme_get_avatar( $current_user->ID , '110' , xintheme_get_avatar_type($current_user->ID) ); ?>
			</div>
			<div class="bk-user-data clearfix">
				<div class="bk-username">
					<i class="iconfont icon-denglu"></i>
					<a href="<?php echo get_author_posts_url($current_user->ID); ?>">我的主页</a>
				</div>
				<div class="bk-block">
					<i class="iconfont icon-bianji"></i>
					<a href="<?php echo get_author_posts_url($current_user->ID); ?>?tab=profile">个人资料</a>
				</div>
				<?php if( xintheme('tougao') ){?>
				<div class="bk-block">
					<i class="iconfont icon-wenzhang" style="font-weight: 700;"></i>
					<a href="<?php echo get_author_posts_url($current_user->ID); ?>?tab=post&action=new">我要投稿</a>
				</div>
				<?php } ?>
				<?php if( current_user_can( 'manage_options' ) ) {?>
				<div class="bk-block">
					<i class="iconfont icon-wordpress"></i>
					<a href="<?php echo get_option('home'); ?>/wp-admin">进入后台</a>
				</div>
				<?php } ?>				
				<div class="bk-block">
					<i class="iconfont icon-084tuichu"></i>
					<a class="wp-logout" href="<?php echo wp_logout_url( home_url(add_query_arg(array(),$wp->request)) ); ?>">退出登录</a>
				</div>
			</div>  
		</div>
	</div>
</div>