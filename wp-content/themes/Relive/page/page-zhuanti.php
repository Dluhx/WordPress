<?php
/*
Template Name: 专题页面
*/
get_header();?>
<div class="mnmd-block mnmd-block--fullwidth" style="margin-top: 40px;">
	<div class="container">
		<div class="block-heading block-heading--line">
			<h4 class="block-heading__title"><?php the_title(); ?></h4>
		</div>
		<div class="row row--space-between">
			<?php
				$zhuanti = xintheme('zhuanti');
				foreach($zhuanti as $id):
				if( $id['zhuanti_type'] == "cat" ){
				if($categories = $id['zhuanti_cat']);
				foreach ($categories as $cat=>$catid ){?>
			<div class="col-xs-6 col-md-3 category">
				<div class="category-tile">
					<div class="category-tile__wrap">
                      	<?php query_posts( 'cat='.$catid.'&posts_per_page=1,&ignore_sticky_posts=1' );?>
						<?php while ( have_posts() ) : the_post();?>
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
			<?php } } ?>
			
			<?php
			if( $id['zhuanti_type'] == "tag" ){
			$tag_id = explode(",",$id['zhuanti_tag']);
			foreach ( $tag_id as $tag_ids ){?>
			<div class="col-xs-6 col-md-3 category">
				<div class="category-tile">
					<div class="category-tile__wrap">
						<?php
              				query_posts( 'tag_id='.$tag_ids.'&posts_per_page=1,&ignore_sticky_posts=1' );
							while( have_posts() ): the_post();
						?>
						<div class="background-img background-img--darkened" style="background-image:url(<?php echo post_thumbnail(400, 300); ?>)">
						</div>
						<?php endwhile;?>
						<div class="category-tile__inner">
							<div class="category-tile__text inverse-text">
								<div class="category-tile__name cat-theme-bg" style="background: <?php $category = get_the_category(); echo get_term_meta($category[0]->term_id, 'cc_color', true);?>;">
									<?php $cat = get_tag($tag_ids);echo $cat->name; ?>
								</div>
								<div class="category-tile__description">
									<?php echo $cat->count; ?> 篇文章
								</div>
							</div>
						</div>
						<a href="<?php echo get_category_link($tag_ids);?>" class="link-overlay" title="查看全部文章"></a>
					</div>
				</div>
			</div>
			<?php } } endforeach; ?>
			
		</div>
	</div>
</div>
<?php get_footer();?>