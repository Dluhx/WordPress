<?php 
$tag_data = get_term_meta( $tag_id, 'tag_options', true );
$tag_type = isset($tag_data['tag_layout']) ?$tag_data['tag_layout'] : '';
$tag_banner_type = isset($tag_data['tag_banner']) ?$tag_data['tag_banner'] : '';
$full_background_white = xintheme('full_background_white');
get_header();?>
	<div class="site-content">
		<div class="mnmd-block mnmd-block--fullwidth mnmd-block--contiguous page-heading page-heading--has-background<?php if( $full_background_white ){?> relive_v3_background_white<?php }?> <?php if( $tag_banner_type == '2' ){?>cat_banner<?php }?>" <?php if( $tag_banner_type == '2' ){?>style="background: url('<?php echo $tag_data['tag_banner_img'];?>') center center no-repeat;"<?php }?>>
			<div class="container">
				<?php if( $tag_banner_type == '2' ){?>
				<div style="margin: 120px 0 20px;display: inline-block">
				<h2 class="page-heading__title"># <?php single_cat_title(); ?></h2>
				<div class="page-heading__subtitle">
					<p>当前标签中<?php global $wp_query; echo '共有 ' . $wp_query->found_posts . ' 篇文章';?></p>
				</div>
				</div>
				<?php }else {?>
				<h2 class="page-heading__title"># <?php single_cat_title(); ?></h2>
				<div class="page-heading__subtitle">
					<p>当前标签中<?php global $wp_query; echo '共有 ' . $wp_query->found_posts . ' 篇文章';?></p>
				</div>
				<?php }?>
			</div>
		</div>
		<div class="mnmd-block mnmd-block--fullwidth">
			<div class="container">
				<div class="row">
					<?php if( $full_background_white ){?>
					<div class="relive_v3_15 mnmd-main-col">
					<?php echo get_breadcrumbs();?>
					<?php }?>
					<div class="<?php if( !$full_background_white ){?>mnmd-main-col<?php }?><?php if( $full_background_white ){?> relive_v3 relive_v3_bottom_0<?php }?>" <?php if($tag_type == 'grid-3' || $tag_type == 'grid-4'){?>style="padding-left: 0;padding-right: 0;display: inline-block"<?php }?>>
						<?php if( !$full_background_white ){?>
							<?php echo get_breadcrumbs();?>
						<?php }?>
						<div class="mnmd-block">
							<div class="posts-list <?php if($tag_type == 'list' ){?>list-unstyled list-seperated list-space-md <?php } elseif($tag_type == 'grid' || $tag_type == 'grid-3' || $tag_type == 'grid-4'){ ?>list-unstyled list-space-xl<?php }else{?>list-unstyled list-seperated list-space-md <?php }?><?php if($tag_type == 'grid-3' ||$tag_type == 'grid-4' ){?> list-grid-3<?php }?>">
							<?php if($tag_type == 'grid' ){?><div class="row row--space-between"><?php } ?>
							<?php
								$i = 1;
								while(have_posts()) : the_post();
								if($tag_type == 'grid'){
									include( 'template-parts/content-grid.php' );
								}elseif($tag_type == 'list'){
									get_template_part( 'template-parts/content-list' );
								}elseif($tag_type == 'grid-3'){
									get_template_part( 'template-parts/content-grid-3' );
								}elseif($tag_type == 'grid-4'){
									get_template_part( 'template-parts/content-grid-4' );
								}else{
									get_template_part( 'template-parts/content-list' );
								}
								$i++; endwhile; wp_reset_query();?>
							<?php if($tag_type == 'grid' ){?></div><?php } ?>
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
					<?php if( $tag_type == 'grid-3' || $tag_type == 'grid-4' ) { ?>
						<style>.mnmd-main-col{width: 100%;}</style>
					<?php }else{ ?>
						<?php get_sidebar();?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>