<div class="related-posts single-entry-section">
	<div class="block-heading ">
		<h4 class="block-heading__title">你也可能喜欢</h4>
	</div>
	<div class="posts-list">
		<div class="row row--space-between">
			<div class="col-xs-12 col-sm-12">
				<ul class="list-space-md list-unstyled list-seperated">
				<?php
				$post_num = 4;
				$exclude_id = $post->ID;
				$posttags = get_the_tags(); $i = 0;
				if ( $posttags ) {
				$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
				$args = array(
				'post_status' => 'publish',
				'tag__in' => explode(',', $tags),
				'post__not_in' => explode(',', $exclude_id),
				'ignore_sticky_posts' => 1,
				'orderby' => 'comment_date',
				'posts_per_page' => $post_num
				);
				query_posts($args);
				while( have_posts() ) { the_post(); ?>
					<li><article class="post post--horizontal post--horizontal-xs">
					<div class="post__thumb min-height-100">
						<a href="<?php the_permalink(); ?>">
							<img <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(180, 180); ?>" alt="<?php the_title(); ?>" width="180" height="180">
						</a>
					</div>
					<div class="post__text ">
						<h3 class="post__title typescale-1">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="post__meta">
							<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
							<?php if( xintheme('xintheme_post_meta_comment') ){?>
							<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
							<?php }?>
							<?php if( xintheme('xintheme_post_meta_views') ){?>
							<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
							<?php }?>
						</div>
					</div>
					</article>
					</li>
					<?php
					$exclude_id .= ',' . $post->ID; $i ++;
					} wp_reset_query();
					}
					if ( $i < $post_num ) {
					$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
					$args = array(
					'category__in' => explode(',', $cats),
					'post__not_in' => explode(',', $exclude_id),
					'ignore_sticky_posts' => 1,
					'orderby' => 'comment_date',
					'posts_per_page' => $post_num - $i
					);
					query_posts($args);
					while( have_posts() ) {the_post(); ?>
					<li><article class="post post--horizontal post--horizontal-xs">
					<div class="post__thumb min-height-100">
						<a href="<?php the_permalink(); ?>">
							<img <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(180, 180); ?>" alt="<?php the_title(); ?>" width="180" height="180">
						</a>
					</div>
					<div class="post__text ">
						<h3 class="post__title typescale-1">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="post__meta">
							<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
							<?php if( xintheme('xintheme_post_meta_comment') ){?>
							<span><a title="<?php echo get_post($post->ID)->comment_count; ?> 条评论" href="<?php the_permalink(); ?>"><i class="iconfont icon-interactive"></i><?php echo get_post($post->ID)->comment_count; ?></a></span>
							<?php }?>
							<?php if( xintheme('xintheme_post_meta_views') ){?>
							<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
							<?php }?>
						</div>
					</div>
					</article>
					</li>
				<?php $i++; } wp_reset_query();}
					if ( $i  == 0 )  echo '<p>暂无相关文章!</p>';
				?>
				</ul>
			</div>
		</div>
	</div>
</div>