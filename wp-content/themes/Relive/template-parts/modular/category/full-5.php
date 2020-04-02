<?php
if($categories= $id['modular_cat_full']);
foreach ($categories as $cat=>$catid ){
?>
<?php $color_1 = $id['color_category_1']; $color_2 = $id['color_category_2']; ?>
<div class="<?php if( $id['modular_full_mobile'] ){ ?>mobile_modular_no <?php } ?>mnmd-block mnmd-block--fullwidth mnmd-featured-block-b mnmd-block--contiguous">
	<div class="background-img gradient-5" style=" background: <?php echo $color_1;?>; background: -webkit-linear-gradient(225deg, <?php echo $color_2;?> 0, <?php echo $color_1;?> 100%); background: linear-gradient(225deg, <?php echo $color_2;?> 0, <?php echo $color_1;?> 100%); ">
	</div>
		<div class="container">
			<?php 	query_posts( 'cat='.$catid.'&posts_per_page=1,&ignore_sticky_posts=1' );
			while( have_posts() ): the_post(); ?>
			<article class="xin_hover xin_hover post post--horizontal post--horizontal-lg post--horizontal-reverse">
			<div class="post__thumb min-height-386">
				<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
					<img width="800" height="450" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(800, 450); ?>" alt="<?php the_title(); ?>"/>
				</a>
			</div>
			<div class="post__text inverse-text">
				<?php xintheme_category_colorss();?>
				<h3 class="post__title typescale-5">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="post__excerpt ">
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<div class="post__meta">
					<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
					<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
					<?php if( xintheme('xintheme_post_meta_views') ){?>
					<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
					<?php }?>
					<?php if( xintheme('xintheme_post_meta_comment') ){?>
					<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
					<?php }?>
				</div>
			</div>
			</article>
			<?php endwhile; wp_reset_query();?>
			<div class="spacer-sm">
			</div>
			<div class="row row--space-between">
				<?php query_posts( 'cat='.$catid.'&posts_per_page=3&ignore_sticky_posts=1&offset=1' );
					while( have_posts() ): the_post(); 
				?>
				<div class="col-xs-12 col-sm-4">
					<article class="xin_hover xin_hover post post--vertical ">
					<div class="post__thumb min-height-210">
						<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
							<img width="400" height="200" <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 200); ?>" alt="<?php the_title(); ?>"/>
						</a>
					</div>
					<div class="post__text inverse-text">
						<h3 class="post__title typescale-2 xin_hide">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="post__meta">
							<span class="entry-author"><a class="entry-author__name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><i class="iconfont icon-addressbook"></i><?php echo get_the_author() ?></a></span>
							<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
							<?php if( xintheme('xintheme_post_meta_views') ){?>
							<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
							<?php }?>
							<?php if( xintheme('xintheme_post_meta_comment') ){?>
							<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
							<?php }?>
						</div>
					</div>
					<?php xintheme_category_colors();?>
					</article>
				</div>
				<?php endwhile; wp_reset_query();?>
			</div>
			<div class="spacer-md">
			</div>
		</div>
</div>
<?php } ?>