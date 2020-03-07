<div class="entry-interaction entry-interaction--horizontal">
	<div class="entry-interaction__left">
		<div class="post-sharing post-sharing--simple">
			<ul>
				<?php if( xintheme('xintheme_post_haibao') && is_single() ){ ?>
				<li><a class="sharing-btn sharing-btn-primary poster-bt share-haibao" data-toggle="tooltip" data-placement="top" title="点击生成分享图片" rel="nofollow" href="javascript:;"><i class="iconfont icon-feiji"></i><span class="sharing-btn__text">生成海报</span></a></li>
				<?php } ?>
				<li class="sharing-no"><a class="sharing-btn weibo-theme-bg" data-toggle="tooltip" data-placement="top" title="分享到新浪微博" rel="nofollow" target="_blank" href="https://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>&amp;type=button&amp;language=zh_cn&amp;title=<?php the_title_attribute(); ?>&amp;pic=<?php post_thumbnail(800, 450); ?>&amp;searchPic=true"><i class="iconfont icon-weibo"></i></a></li>
				<li class="sharing-no"><a class="sharing-btn qqkongjian-theme-bg" data-toggle="tooltip" data-placement="top" title="分享到QQ空间" rel="nofollow" target="_blank" href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php the_title_attribute(); ?>&desc=&summary=&site=&pics=<?php post_thumbnail(800, 450); ?>"><i class="iconfont icon-qqkongjian"></i></a></li>
				<li class="sharing-no"><a class="sharing-btn weixin-theme-bg" data-module="miPopup" data-selector="#post_qrcode" data-toggle="tooltip" data-placement="top" title="微信扫码分享到朋友圈" href="javascript:;"><i class="iconfont icon-weixin"></i></a></li>
				<li class="sharing-no"><a class="sharing-btn baidutieba-theme-bg" data-toggle="tooltip" data-placement="top" title="分享到百度贴吧" rel="nofollow" target="_blank" href="http://tieba.baidu.com/f/commit/share/openShareApi?url=<?php the_permalink(); ?>&title=<?php the_title_attribute(); ?>&desc=&comment=&pic=<?php post_thumbnail(800, 450); ?>"><i class="iconfont icon-baidutieba"></i></a></li>
			</ul>
			<div class="dialog-xintheme" id="post_qrcode">
				<div class="dialog-content dialog-wechat-content">
					<p>
						微信扫一扫,分享到朋友圈
					</p>
					<img src="<?php bloginfo('template_directory'); ?>/public/qrcode?data=<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
					<div class="btn-close">
						<i class="iconfont icon-close"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if ( !is_page() ) { ?>
	<div class="entry-interaction__right">
		<?php $open_ucenter = xintheme('open_ucenter');
			if( $open_ucenter ){
				echo xintheme_post_activity_button(); 
			}?>	
		<?php xintheme_theme_postlike();?>
		<a href="#comments" class="comments-count entry-action-btn" data-toggle="tooltip" data-placement="top" title="<?php echo get_post($post->ID)->comment_count; ?> 条评论"><i class="iconfont icon-pinglun" style="vertical-align: middle;"></i><span><?php echo get_post($post->ID)->comment_count; ?></span></a>
	</div>
	<?php } ?>
</div>