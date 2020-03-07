<?php get_header();?>
	<div class="site-content">
		<div class="mnmd-block mnmd-block--fullwidth mnmd-block--contiguous page-heading page-heading--has-background">
			<div class="container">
				<h2 class="page-heading__title"># <?php echo get_search_query(); ?></h2>
				<div class="page-heading__subtitle">
					<?php global $wp_query; echo '共搜索到 ' . $wp_query->found_posts . ' 篇文章';?>
				</div>
			</div>
		</div>
		<div class="mnmd-block mnmd-block--fullwidth">
			<div class="container">
				<div class="row">
					<div class="mnmd-main-col ">
						<div class="mnmd-block">
							<div class="posts-list list-unstyled list-space-xl">
							<?php if($category_type == 'grid' ){?><div class="row row--space-between"><?php } ?>
							<?php
								while(have_posts()) : the_post();
								get_template_part( 'template-parts/content-list' );
								endwhile; wp_reset_query();?>
							<?php if($category_type == 'grid' ){?></div><?php } ?>
							</div>
							<div class="mnmd-pagination">
							<h4 class="mnmd-pagination__title sr-only">分页导航</h4>
							<div class="mnmd-pagination__links text-center">
								<?php xintheme_theme_pagenavi();?>
							</div>
							</div>
						</div>
					</div>
					<?php get_sidebar();?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>