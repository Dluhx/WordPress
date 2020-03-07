<?php 
$category_data = get_term_meta( $cat, 'category_options', true );
$category_type = isset($category_data['cat_layout']) ?$category_data['cat_layout'] : '';
$cat_banner_type = isset($category_data['cat_banner']) ?$category_data['cat_banner'] : '';
$full_background_white = xintheme('full_background_white');
get_header();?>
	<div class="site-content">
		<div class="mnmd-block mnmd-block--fullwidth mnmd-block--contiguous page-heading page-heading--has-background<?php if( $full_background_white ){?> relive_v3_background_white<?php }?> <?php if( $cat_banner_type == '2' ){?>cat_banner<?php }?>" <?php if( $cat_banner_type == '2' ){?>style="background: url('<?php echo $category_data['cat_banner_img'];?>') center center no-repeat;"<?php }?>>
			<div class="container">
				<?php if( $cat_banner_type == '2' ){?>
				<?php if( category_description() ){?>
				<div style="margin: 100px 0 20px;display: inline-block">
				<?php }else{ ?>
				<div style="margin: 120px 0 20px;display: inline-block">
				<?php }?>
					<h2 class="page-heading__title"><?php $term_id = get_queried_object_id(); echo get_cat_name($term_id); ?></h2>
					<div class="page-heading__subtitle">
						<?php echo category_description(); ?>
					</div>
				</div>
				<?php }else {?>
				<h2 class="page-heading__title"><?php $term_id = get_queried_object_id(); echo get_cat_name($term_id); ?></h2>
				<div class="page-heading__subtitle">
					<?php echo category_description(); ?>
				</div>
				<?php }?>
				</div>
			</div>
		<div class="mnmd-block mnmd-block--fullwidth">
			<div class="container">
				<div class="row">
					<?php if( $full_background_white ){?>
					<div class="relive_v3_15 mnmd-main-col"<?php if($category_type == 'grid-3' || $category_type == 'grid-4'){?> style="padding-right: 15px"<?php }?>>
					<?php echo get_breadcrumbs();?>
					<?php }?>
					<div class="<?php if( !$full_background_white ){?>mnmd-main-col<?php }?><?php if( $full_background_white ){?> relive_v3 relive_v3_bottom_0<?php }?>" <?php if($category_type == 'grid-3' || $category_type == 'grid-4'){?>style="width: 100%;padding-left: 0;padding-right: 0;display: inline-block"<?php }?>>
						<?php if( !$full_background_white ){?>
							<?php echo get_breadcrumbs();?>
						<?php }?>
						<div class="mnmd-block">
							<div class="posts-list <?php if($category_type == 'list' ){?>list-unstyled list-seperated list-space-md <?php } else{ ?>list-unstyled list-space-xl<?php } ?><?php if($category_type == 'grid-3' || $category_type == 'grid-4' ){?> list-grid-3<?php }?><?php if($category_type == 'timeaxis' ){?> timeaxis-list<?php }?>">
							<?php if($category_type == 'grid' ){?><div class="row row--space-between"><?php } ?>
							<?php
								$i = 1;
								while(have_posts()) : the_post();
								if($category_type == 'grid'){
									include( 'template-parts/content-grid.php' );
								}elseif($category_type == 'list'){
									get_template_part( 'template-parts/content-list' );
								}elseif($category_type == 'grid-3'){
									get_template_part( 'template-parts/content-grid-3' );
								}elseif($category_type == 'grid-4'){
									get_template_part( 'template-parts/content-grid-4' );
								}elseif($category_type == 'timeaxis'){
									get_template_part( 'template-parts/content-timeaxis' );
								}else{
									get_template_part( 'template-parts/content-list' );
								}
								$i++; endwhile; wp_reset_query();?>
							<?php if($category_type == 'grid' ){?></div><?php } ?>
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
					</div>
					<?php if( $full_background_white ){?>
					</div>
					<?php }?>
					<?php if( $category_type == 'grid-3' || $category_type == 'grid-4' ) { ?>
						<style>.mnmd-main-col{width: 100%;}</style>
					<?php }else{ ?>
						<?php get_sidebar();?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>