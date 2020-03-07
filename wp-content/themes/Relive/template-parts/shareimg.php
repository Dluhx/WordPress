<?php if ( is_single() ) { ?>
<div class="dialog_overlay share"></div>
<div class="bigger-share">
    <div class="row-share">
        <div class="img-share">
            <img <?php echo is_lazysizes(); ?>src="<?php echo get_haibaoimg(); ?>" alt="<?php the_title(); ?>">
		</div>
        <div class="share-item">
            <h3>分享文章到：</h3>
			<?php
			$qzone='https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=';
	        $weibo='http://service.weibo.com/share/share.php?title=';
	        $qq='http://connect.qq.com/widget/shareqq/index.html?url=';
			$get_haibaoimg = get_haibaoimg();
            echo'<div class="button">
                <a target="_blank" href="'.$weibo,get_the_title().'&url='.get_permalink().'&source='._get_excerpt().'&pic='.$get_haibaoimg.'" class="btn btn-danger">
                    <i class="iconfont icon-weibo"></i> 新浪微博</a>
            </div>
            <div class="button">
                <a target="_blank" href="'.$qq,get_permalink().'&desc='._get_excerpt().'&summary='.get_the_title().'&site=zeshlife&pics='.$get_haibaoimg.'" class="btn btn-info">
                    <i class="iconfont icon-QQ"></i> QQ好友</a>
            </div>
            <div class="button">
                <a target="_blank" href="'.$qzone,get_permalink().'&title='.get_the_title().'&desc=&summary='._get_excerpt().'&site=zeshlife&pics='.$get_haibaoimg.'" class="btn btn-warning">
                    <i class="iconfont icon-qqkongjian"></i> QQ空间</a>
            </div>
            <div class="button">
                <a href="'.$get_haibaoimg.'" download="'.get_the_title().'.png" class="btn btn-primary">
                    <i class="iconfont icon-xiazai"></i> 下载海报</a>
            </div>'; ?>
        </div>
		<div class="text-weixin">
            <p>长按储存图像，分享给朋友</p>
        </div>
    </div>
</div>
<?php } ?>