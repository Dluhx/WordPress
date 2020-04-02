<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth<?php if( $full_background_white ){?> relive_v3_bottom_0<?php }?>">
	<div class="container">
		<?php if( $full_background_white ){?>
		<div class="relive_v3">
		<?php }?>
		<?php
		$modular_title = $id['modular_title_full'];
		if( $modular_title ){
		?>
		<div class="block-heading block-heading--line">
			<h4 class="block-heading__title"><?php echo $modular_title; ?></h4>
		</div>
		<?php } ?>
		<div class="row row--space-between">
			<?php
			if($categories= $id['modular_cat_full']);
			foreach ($categories as $cat=>$catid ){
			?>
			<div class="col-xs-6 col-md-3 category">
				<div class="category-tile">
					<div class="category-tile__wrap">
						<?php
							query_posts( 'cat='.$catid.'&posts_per_page=1,&ignore_sticky_posts=1' );
							while( have_posts() ): the_post();
						?>
						<div class="background-img background-img--darkened" style="background-image:url(<?php echo post_thumbnail(400, 300); ?>)">
						</div>
						<?php endwhile;?>
						<div class="category-tile__inner">
							<div class="category-tile__text inverse-text">
								<div class="category-tile__name cat-theme-bg" style="background: <?php $category = get_the_category(); echo get_term_meta($category[0]->term_id, 'cc_color', true);?>;">
									<?php $cat = get_category($catid);echo $cat->name; ?>
								</div>
								<div class="category-tile__description">
									<?php echo $cat->count; ?> 篇文章
								</div>
							</div>
						</div>
						<a href="<?php echo get_category_link($catid);?>" class="link-overlay" title="查看全部文章"></a>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	<?php if( $full_background_white ){?>
	</div>
	<?php }?>
	</div>
</div>