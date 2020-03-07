<?php if( xintheme('header_qq_url') ) : ?>
<li>
	<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo xintheme('header_qq_url'); ?>&site=qq&menu=yes" rel="nofollow" target="_blank"><i class="iconfont icon-QQ"></i></a>
</li>
<?php endif; ?>

<?php if( xintheme('header_weibo_url') ) : ?>
<li>
	<a href="<?php echo xintheme('header_weibo_url'); ?>" rel="nofollow" target="_blank"><i class="iconfont icon-weibo"></i></a>
</li>
<?php endif; ?>

<?php if( xintheme('header_weixin_img') ) : ?>
<li>
	<a id="header_weixin" class="header_weixin" href="javascript:void(0);"><i class="iconfont icon-weixin"></i></a>
</li>
<?php endif; ?>

<?php if( xintheme('header_email_url') ) : ?>
<li>
	<a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo xintheme('header_email_url'); ?>" rel="nofollow" target="_blank"><i class="iconfont icon-youxiang"></i></a>
</li>
<?php endif; ?>