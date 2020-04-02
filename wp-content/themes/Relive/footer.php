	<footer class="site-footer footer-6 site-footer--inverse inverse-text" style="background-color: <?php echo xintheme('footer_color') ?>;">
	<?php if( xintheme('foot_link') && is_home() ) : ?>
	<div class="site-footer__section site-footer__section--flex site-footer__section--seperated">
		<div class="container">
			<div class="site-footer__section-inner">
				<div class="site-logo">
					<span>友情链接：</span>
					<?php $foot_link_cat= xintheme('foot_link_cat');?>
					<?php if( $foot_link_cat ){
						foreach ($foot_link_cat as $key => $value );
						$foot_link_cat = implode(',', $foot_link_cat);
						$default_ico = get_template_directory_uri().'/static/images/favicon.ico'; 
						$bookmarks = get_bookmarks('orderby=rating&title_li=&categorize=0&category='.$foot_link_cat.''); 
					?>
					<?php if(!empty($bookmarks)): ?>
					<?php foreach ($bookmarks as $bookmark): ?> 
						<li>
						<?php if( $bookmark->link_image ){?>
						<img src="<?php echo $bookmark->link_image ?>" alt="<?php echo $bookmark->link_name ?>" onerror="javascript:this.src='<?php echo $default_ico; ?>'">
						<?php } ?>
						<a href="<?php echo $bookmark->link_url ?>" target="_blank"><?php echo $bookmark->link_name ?></a>
						</li>
					<?php endforeach ?>
					<?php endif ;?>
					<?php }else{ ?>
						请在后台-外观-主题设置-页脚样式中勾选需要调用的链接分类。
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="site-footer__section site-footer__section--flex site-footer__section--bordered-inner" style="padding-top: 0;">
		<div class="container">
			<div class="site-footer__section-inner">
				<div class="site-footer__section-left">
					<?php
						$footer_icp = xintheme('footer_icp');
						$footer_gaba = xintheme('footer_gaba');
						$footer_copyright = xintheme('footer_copyright');
					?>
					<?php if( $footer_copyright ){?><?php echo $footer_copyright;?><?php }else{?>© <?php echo date('Y'); ?>.&nbsp;All Rights Reserved.<?php } ?><?php if( $footer_icp ) : ?>&nbsp;<a rel="nofollow" target="_blank" href="http://www.beian.miit.gov.cn/"><?php echo $footer_icp;?></a><?php endif; ?><?php if( $footer_gaba ) : ?>&nbsp;<img class="gaba" alt="公安备案" src="<?php bloginfo('template_directory'); ?>/static/images/gaba.png"><a rel="nofollow" target="_blank" href="<?php echo xintheme('footer_gaba_url');?>"><?php echo $footer_gaba;?></a><?php endif; ?><?php if( xintheme('xintheme_link') ) : ?>&nbsp;Theme By&nbsp;<a href="https://wpmes.cn" target="_blank">XinTheme</a><?php endif; ?>
				</div>
				<?php get_template_part( 'template-parts/foot-right' );?>
			</div>
		
		</div>
	</div>
	</footer>
	<?php get_template_part( 'template-parts/header/sticky-header'); ?>

	<?php get_template_part( 'template-parts/header/mobile-menu'); ?>
	<a href="#" class="mnmd-go-top btn btn-default js-go-top-el"><i class="iconfont icon-packup"></i></a>
</div>
<?php wp_footer(); ?>
<?php if( xintheme('xintheme_post_haibao') ){ get_template_part('template-parts/shareimg'); }?>
<?php if( xintheme('header_weixin_img') ) : ?>
<div class="f-weixin-dropdown">
	<div class="tooltip-weixin-inner">
		<h3>微信扫一扫</h3>
		<div class="qcode"> 
			<img src="<?php echo xintheme_img('header_weixin_img','');?>" alt="微信扫一扫">
		</div>
	</div>
	<div class="close-weixin">
		<span class="close-top"></span>
			<span class="close-bottom"></span>
    </div>
</div>
<?php endif; ?>
<div style="display: none !important;"><?php echo xintheme('foot_code');?></div>

<?php if(xintheme('all_img_fancybox') && is_single()){?>
<script language="Javascript">
	(function($){
	$(function() {  
		$('.entry-content img').each(function(i){  
			if (! this.parentNode.href) {  
				$(this).wrap("<a href='"+this.src+"' data-fancybox='images'></a>");  
			}  
		});  
	});
	})(jQuery);
</script>
<?php }?>
<?php $open_ucenter = xintheme('open_ucenter'); if($open_ucenter){ get_template_part( 'user/xintheme-login' );}?>
<?php if( xintheme('xintheme-notice') ){ get_template_part( 'template-parts/xintheme-notice' );}?>
<?php if( xintheme('mobile_foot_menu_sw') ){ get_template_part( 'template-parts/mobile-foot-menu' );}?>
</body>
</html>