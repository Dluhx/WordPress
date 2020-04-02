<?php
$category_data = get_term_meta( $cat, 'category_options', true );
$category_type = isset($category_data['cat_layout']) ?$category_data['cat_layout'] : '';

$tag_data = get_term_meta( $tag_id, 'tag_options', true );
$tag_type = isset($tag_data['tag_layout']) ?$tag_data['tag_layout'] : '';

$media = xintheme('post_ad_type');
$num = xintheme('post_ad_number');
if ($wp_query->current_post == $num) { 
if(  $media == 'img' ) : ?>
<div class="xintheme-ad <?php if($category_type == 'grid' || $tag_type == 'grid' ){?>col-xs-12<?php } ?>" style="margin-bottom: 0;">
	<div class="mobile">
		<a href="<?php echo xintheme('post_ad_url');?>" target="_blank" rel="nofollow">
		<img src="<?php echo xintheme('post_ad_img_mobile');?>">
		</a>
		<span style="bottom: 30px;<?php if($category_type == 'grid' || $tag_type == 'grid' ){?>right: 25px;<?php } ?>">广告</span>
	</div>
	<div class="pc">
		<a href="<?php echo xintheme('post_ad_url');?>" target="_blank" rel="nofollow">
		<img src="<?php echo xintheme('post_ad_img_pc');?>">
		</a>
		<span style="bottom: 30px;<?php if($category_type == 'grid' || $tag_type == 'grid' ){?>right: 25px;<?php } ?>">广告</span>
	</div>
</div>
<?php endif;

if(  $media == 'code' ) : ?>
<div class="xintheme-ad" style="margin-bottom: 0;">
	<div class="mobile">
		<?php echo xintheme('post_ad_code_mobile');?>
	</div>
	<div class="pc">
		<?php echo xintheme('post_ad_code_pc');?>
	</div>
</div>
<?php endif;?>
<?php } ?>