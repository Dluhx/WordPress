<?php
$media = xintheme('single_top_ad_type');
if(  $media == 'img' ) : ?>
<div class="xintheme-ad" style="margin-bottom: 25px;">
	<div class="mobile">
		<a href="<?php echo xintheme('single_top_ad_url');?>" target="_blank" rel="nofollow">
		<img src="<?php echo xintheme('single_top_ad_img_mobile');?>">
		</a>
		<span>广告</span>
	</div>
	<div class="pc">
		<a href="<?php echo xintheme('single_top_ad_url');?>" target="_blank" rel="nofollow">
		<img src="<?php echo xintheme('single_top_ad_img_pc');?>">
		</a>
		<span>广告</span>
	</div>
</div>
<?php endif;

if(  $media == 'code' ) : ?>
<div class="xintheme-ad" style="margin-bottom: 25px;">
	<div class="mobile">
		<?php echo xintheme('single_top_ad_code_mobile');?>
	</div>
	<div class="pc">
		<?php echo xintheme('single_top_ad_code_pc');?>
	</div>
</div>
<?php endif;?>