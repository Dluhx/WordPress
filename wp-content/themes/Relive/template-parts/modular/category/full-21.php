<?php $full_background_white = xintheme('full_background_white'); ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-posts-listing-a grid-gutter-10<?php if( $full_background_white ){?> relive_v3_bottom_0<?php }?>">
<style>.grayscale {filter: none;}</style>
	<div class="container">
		<?php if( $full_background_white ){?>
		<div class="relive_v3">
		<?php }?>
		<div class="row row--space-between">
			<?php
			if($categories= $id['modular_cat_full']);
			foreach ($categories as $cat=>$catid ){
			?>
			<div class="col-sm-6 col-md-3">
				<div class="mnmd-posts-listing-a__cat-wrap">
					<?php
						query_posts( 'cat='.$catid.'&posts_per_page=1,&ignore_sticky_posts=1' );
						while( have_posts() ): the_post();
					?>
					<div class="background-img background-img--darkened grayscale" style="background-image:url(<?php echo post_thumbnail(1200, 900); ?>)">
					</div>
					<?php endwhile; wp_reset_query();?>
					<div class="background-overlay cat-theme-bg cat-191">
					</div>
					<div class="mnmd-posts-listing-a__cat-inner inverse-text">
						<h4 class="cat-title"><?php $cat = get_category($catid);echo $cat->name; ?></h4>
						<ul class="list-space-sm list-seperated list-unstyled">
							<?php
								query_posts( 'cat='.$catid.'&posts_per_page=4,&ignore_sticky_posts=1' );
								while( have_posts() ): the_post();
							?>
							<li>
								<article class="post">
								<h3 class="post__title typescale-0">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								</article>
							</li>
							<?php endwhile; wp_reset_query();?>
						</ul>
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