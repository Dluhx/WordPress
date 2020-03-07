<?php
$exclude_category = $id['list_newest_exclude_category'];
if( $exclude_category ){
	$pool = array();
	foreach ($exclude_category as $cat=>$catid) {
		if( $catid ) $pool[] = $catid;
	}
	$exclude_id = '-'.implode($pool, ',-');
}?>
<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_list_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block<?php if( $full_background_white ){?> relive_v3<?php }?>">
	<?php
	$modular_title = $id['modular_title_list'];
	if( $modular_title ){?>
	<div class="block-heading block-heading--line">
	<?php if ( !get_query_var('paged') ) { ?>
		<h4 class="block-heading__title"><?php echo $modular_title; ?></h4>
	<?php }else{ ?>
		<h4 class="block-heading__title">正在浏览：第<?php global $paged; echo $paged;?>页</h4>
	<?php } ?>
	</div>
	<?php } ?>
	<div class="posts-list list-space-md list-seperated">
		<?php
		$args = array(
		'ignore_sticky_posts' => 1,
		'cat' => $exclude_id,
		'paged' => $paged
		);
		query_posts($args);
		if ( have_posts() ) {
			while ( have_posts() ) { 
				the_post();
				get_template_part('template-parts/content-list');
			}
		}
		?>
	</div>
	<?php if( $GLOBALS["wp_query"]->max_num_pages > 1 ){ ?>
	<div class="mnmd-pagination">
	<h4 class="mnmd-pagination__title sr-only">分页导航</h4>
	<div class="mnmd-pagination__links text-center">
		<?php xintheme_theme_pagenavi();?>
	</div>
	</div>
	<?php }?>
</div>