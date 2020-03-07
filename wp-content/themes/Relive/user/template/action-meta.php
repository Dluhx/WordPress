<?php $xincollects=get_post_meta($post->ID,'xintheme_post_collects',true); if(empty($xincollects)):$xincollects=0; endif;?>
	<?php $uid = get_current_user_id(); if(!empty($uid)&&$uid!=0){ ?>		
	<?php $mycollects = get_user_meta($uid,'xintheme_collect',true);
		$mycollects = explode(',',$mycollects);
	?>
	<?php global $curauth; ?>
	<?php if (!in_array($post->ID,$mycollects)){ ?>
		<div class="postlist-meta-collect collect-btn collect-no remove-collect mobile-none" style="display: inline-block;margin-left: 3px;" pid="<?php echo $post->ID ; ?>" uid="<?php echo get_current_user_id(); ?>" title="<?php _e('点击收藏','xintheme'); ?>"> <i class="iconfont icon-collection"></i><span><?php echo $xincollects; ?></span>&nbsp;</div>
	<?php }elseif(isset($curauth->ID)&&$curauth->ID==$uid){ ?>
		<div class="postlist-meta-collect collect-btn collect-yes remove-collect mobile-none" style="display: inline-block;margin-left: 3px;cursor:pointer;" pid="<?php echo $post->ID ; ?>" uid="<?php echo get_current_user_id(); ?>" title="<?php _e('取消收藏','xintheme'); ?>"><i class="iconfont icon-collection_fill"></i><span><?php echo $xincollects; ?></span>&nbsp;</div>
	<?php }else{ ?>
		<div class="postlist-meta-collect collect-btn collect-yes remove-collect mobile-none" style="display: inline-block;margin-left: 3px;cursor:pointer;" pid="<?php echo $post->ID ; ?>" uid="<?php echo get_current_user_id(); ?>" title="<?php _e('取消收藏','xintheme'); ?>"><i class="iconfont icon-collection_fill"></i><span><?php echo $xincollects; ?></span>&nbsp;</div>
	<?php } ?>
	<?php }else{ ?>
		<a class="postlist-meta-collect collect-btn collect-no mobile-none" href="#login-modal" data-toggle="modal" data-target="#login-modal" title="你必须注册并登录才能收藏"><i class="iconfont icon-collection"></i><span><?php echo $xincollects; ?></span></a>
<?php } ?>