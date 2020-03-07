<?php 
$img_mb = $id['list_ad_img_mobile'];
$img_pc	= $id['list_ad_img_pc'];
if(  $img_mb || $img_pc	 ) : 
?>
<div class="<?php if( $id['modular_list_mobile'] ){ ?>mobile_modular_no <?php } ?>xintheme-ad">
	<div class="mobile">
		<a href="<?php echo $id['list_ad_url'];?>" target="_blank" rel="nofollow">
		<img src="<?php echo $img_mb;?>">
		</a>
		<span>广告</span>
	</div>
	<div class="pc">
		<a href="<?php echo $id['list_ad_url'];?>"  target="_blank" rel="nofollow">
		<img src="<?php echo $img_pc;?>">
		</a>
		<span>广告</span>
	</div>
</div>
<?php endif;
	$code_mb = $id['list_ad_code_mobile'];
	$code_pc = $id['list_ad_code_pc'];
	if(  $code_mb || $code_pc ) : ?>
<div class="<?php if( $id['modular_list_mobile'] ){ ?>mobile_modular_no <?php } ?>xintheme-ad">
	<div class="mobile">
		<?php echo $code_mb;?>
	</div>
	<div class="pc">
		<?php echo $code_pc;?>
	</div>
</div>
<?php endif;?>	