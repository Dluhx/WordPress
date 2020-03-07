<?php if ( !get_query_var('paged') ) { ?>
<div id="owl-banner" class="owl-carousel mnmd-block">
	<?php foreach ( xintheme('banner') as $value ): $i++;?>
	<a href="<?php echo $value['banner_url'];?>" <?php if( $value['banner_blank'] ){?>target="_blank"<?php } ?> <?php if( $value['banner_nofollow'] ){?>rel="nofollow"<?php } ?> title="<?php echo $value['banner_alt'];?>" class="item">
		<?php if ( wp_is_mobile() && $value['banner_img_mobile'] ){ ?>
			<img src="<?php echo $value['banner_img_mobile'];?>" alt="<?php echo $value['banner_alt'];?>" />
		<?php }else { ?>
			<img src="<?php echo $value['banner_img'];?>" alt="<?php echo $value['banner_alt'];?>" />
		<?php } ?>
	</a>
	<?php endforeach;?>
</div>
<?php }?>