<?php get_header();?>
	<div class="site-content">
		<?php if( xintheme('banner_switcher') ){ get_template_part( 'template-parts/banner'); }?>
		<?php get_template_part( 'template-parts/modular-full');?>
		<div class="mnmd-layout-split mnmd-block mnmd-block--fullwidth">
			<div class="container">
				<div class="row">
					<div class="mnmd-main-col<?php if(  xintheme('full_background_white') ){ ?> relive_v3_main-col<?php }?>">
						<?php get_template_part( 'template-parts/modular-list');?>
					</div>
					<?php get_sidebar();?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>