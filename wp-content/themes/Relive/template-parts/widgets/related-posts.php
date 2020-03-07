<?php
add_action( 'widgets_init', function(){register_widget('Related_Posts' );});
class Related_Posts extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'Related_Posts',
			'description' => '显示相关文章推荐，只在文章页面生效！',
		);
		parent::__construct( 'Related_Posts', '相关文章推荐', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if( !is_single() ){
			return false;
		}
		extract($args);
		$num = $instance['num'];
		$title = apply_filters('widget_name', $instance['title']);

		global $post;
		$post_tags = wp_get_post_tags($post->ID);
		$cats = wp_get_post_categories($post->ID);
		if( $post_tags ){
			
			$tags = array();
			foreach ($post_tags as $value) {
				$tags[] = $value->term_id;
			}

			$args = array(
				'type'                => 'post',
				'tag__in'             => $tags,
				'post__not_in'        => array($post->ID),
				'showposts'           => $num,				          
				'ignore_sticky_posts' => 1
			);

		}else{

			$args = array(
				'type'                => 'post',
				'category__in'        => $cats,
				'post__not_in'        => array( $post->ID ),
				'showposts'           => $num,
				'ignore_sticky_posts' => 1
			);

		}

		if( $args ){
			query_posts($args);
		}
?>
		<div class="widget <?php if( xintheme('full_background_white') ){?>relive_widget_v3<?php }?>">
			<div class="mnmd-widget-reviews-list">	
			<div class="widget__title block-heading block-heading--line">
				<h4 class="widget__title-text"><?php echo $title; ?></h4>
			</div>
			<ol class="posts-list list-space-sm list-unstyled">
				<?php
					if( $args ){ 
						if (have_posts()) :
							$i = 1;
							while (have_posts()) :
							  the_post(); update_post_caches($posts);
				?>
				<?php if ( 1 === $i ) : ?>
				<li><article class="post--overlay post--overlay-bottom post--overlay-floorfade post--overlay-xs">
				<div class="background-img " style="background-image:url(<?php echo post_thumbnail(400, 300); ?>)">
				</div>
				<div class="post__text inverse-text">
					<div class="post__text-wrap">
						<div class="post__text-inner ">
							<?php xintheme_category_colorss();?>
							<h3 class="post__title typescale-1">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post__meta ">
								<time class="time published"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
							</div>
						</div>
					</div>
				</div>
				<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
				</article>
				</li>
				<?php else : ?>
				<li><article class="post post--horizontal post--horizontal-xxs">
				<div class="post__thumb min-height-70">
					<a href="<?php the_permalink(); ?>">
						<img <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(180, 180); ?>" alt="<?php the_title(); ?>" width="180" height="180">
					</a>
				</div>
				<div class="post__text ">
					<h3 class="post__title typescale-0">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="post__meta ">
						<time class="time published"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
					</div>
				</div>
				</article>
				</li>
				<?php endif; $i++; ?>
				<?php 
							endwhile;
							wp_reset_query(); 
						else :
							echo '<li><p>暂时没有相关的文章！</p></li>';
						endif;
					}else{
						echo '<li><p>暂时没有相关的文章！</p></li>';
					}
				?>   
			</ol>	
		</div>
	</div>
<?php		
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
				'title' => '相关文章',
				'num'   => 4,
			) 
		);
?>
		<p>
			<label> 标题：
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label> 显示数量：
				<input class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="number" step="1" min="4" value="<?php echo $instance['num']; ?>" />
			</label>
		</p>
<?php
	}

}