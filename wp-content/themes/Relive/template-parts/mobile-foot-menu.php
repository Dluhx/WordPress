<style>@media screen and (max-width:767px){.site-footer{margin-bottom: 55px}}</style>
<div class="mobile_btn">
	<ul>
		<?php foreach ( xintheme('add_mobile_foot_menu') as $value ): $i++; ?>
		<?php if($i > 4){?><style>.mobile_btn ul li {min-width: 20%}</style><?php }?>
		<?php if( $value['mobile_foot_menu_type'] == 'link' ){?>
		<li>
			<a href="<?php echo $value['mobile_foot_menu_url'];?>" rel="nofollow"><i class="<?php echo $value['mobile_foot_menu_icon'];?>"></i><?php echo $value['mobile_foot_menu_text'];?></a>
		</li>
		<?php }elseif( $value['mobile_foot_menu_type'] == 'img' ){?>
		<li>
			<a id="mobile_foot_menu_img" class="mobile_foot_menu_img" href="javascript:void(0);"><i class="<?php echo $value['mobile_foot_menu_icon'];?>"></i><?php echo $value['mobile_foot_menu_text'];?></a>
		</li>
		<div class="mobile-foot-weixin-dropdown">
			<div class="tooltip-weixin-inner">
				<h3><?php echo $value['mobile_foot_menu_img_text'];?></h3>
				<div class="qcode"> 
					<img src="<?php echo $value['mobile_foot_menu_img'];?>" alt="">
				</div>
			</div>
			<div class="close-weixin">
				<span class="close-top"></span>
					<span class="close-bottom"></span>
		    </div>
		</div>
		<?php }else{?>
			<?php global $current_user; if ( is_user_logged_in() ) { ?>
				<li>
					<a href="<?php echo get_author_posts_url($current_user->ID); ?>" rel="nofollow"><i class="iconfont icon-denglu"></i>个人中心</a>
				</li>
			<?php }else{?>
				<li>
					<a href="#login-modal" data-toggle="modal" data-target="#login-modal" rel="nofollow"><i class="iconfont icon-denglu"></i>登录</a>
				</li>
			<?php }?>
		<?php }?>
		<?php endforeach;?>
	</ul>
</div>