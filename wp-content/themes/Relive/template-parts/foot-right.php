<div class="site-footer__section-right">
	<?php if( xintheme('xintheme_social_or_menu') == 'social' ){?>
	<nav class="social-navigation">
	<div class="menu-social-menu-container" ontouchstart="">
		<ul class="social-links-menu">
			<?php if( xintheme('header_qq_url') ) : ?>
			<li><a class="qq" rel="nofollow" target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo xintheme('header_qq_url'); ?>&amp;site=qq&amp;menu=yes"></a></li>
			<?php endif; ?>
			<?php if( xintheme('header_weibo_url') ) : ?>
			<li><a class="weibo" rel="nofollow" target="_blank" href="<?php echo xintheme('header_weibo_url'); ?>"></a></li>
			<?php endif; ?>
			<?php if( xintheme('header_weixin_img') ) : ?>
			<li class="wechat">
				<a href="javascript:void(0);" class="weixin"></a>
				<div class="wechatimg">
					<img <?php echo is_lazysizes(); ?>src="<?php echo xintheme_img('header_weixin_img',''); ?>">
				</div>
			</li>
			<?php endif; ?>
			<?php if( xintheme('header_email_url') ) : ?>
			<li><a class="mail" rel="nofollow" target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&amp;email=<?php echo xintheme('header_email_url'); ?>"></a></li>
			<?php endif; ?>
		</ul>
	</div>
	</nav>
	<?php }elseif( xintheme('xintheme_social_or_menu') == 'menu' ){?>
	<nav class="footer-menu">
	<div class="menu-footer-container">
		<ul id="menu-footer" class="navigation navigation--footer navigation--inline">
			<?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'footer')); ?>
		</ul>
	</div>
	</nav>
	<?php }?>
</div>