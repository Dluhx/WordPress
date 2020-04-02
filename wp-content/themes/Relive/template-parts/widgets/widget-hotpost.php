<?php

//date_default_timezone_set("Asia/Shanghai");

class xintheme_post_tools extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'xintheme_post_tools',
			'description' => '文章聚合小工具，可以选择调用不同样式和不同内容。',
		);
		parent::__construct( 'xintheme_post_tools', '文章聚合', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		extract($args);
		$number   	= $instance['num'];
		$who   		= $instance['who'];
		$days  		= $instance['days'];
		$style 		= $instance['style'];
		$cat 		= $instance['cat'];
		$strtotime 	= strtotime('-'.$days.' days');
		$title 		= apply_filters('widget_name', $instance['title']);


		switch ($who) {
			case 'new_posts':
				$args = array(
					'type'                => 'post',
					'showposts'           => $number,
					'cat'              	  => $cat,			          
					'ignore_sticky_posts' => 1
				);
				break;

			case 'random_posts':
				$args = array(
					'type'                => 'post',
					'showposts'           => $number,
					'orderby'             => 'rand',
					'cat'              	  => $cat,					          
					'ignore_sticky_posts' => 1
				);
				break;

			case 'comment_posts':
				$args = array(
					'type'                => 'post',
					'showposts'           => $number,
					'orderby'             => 'comment_count',
					'cat'              	  => $cat,					          
					'ignore_sticky_posts' => 1,
					'date_query'          => array(
						array(
							'before' => date( 'Y-m-d H:i:s', time() ),
						),
						array(
							'after' => date( 'Y-m-d H:i:s', $strtotime ),
						),
					),
				);
				break;
			
			case 'like_posts':
				$args = array(
					'type'                => 'post',
					'showposts'           => $number,
					'orderby'             => 'meta_value_num',
					'cat'              	  => $cat,	
					'meta_key'            => 'like',				          
					'ignore_sticky_posts' => 1,
					'date_query'          => array(

						array(
							'before' => date( 'Y-m-d H:i:s', time() ),
						),
						array(
							'after' => date( 'Y-m-d H:i:s', $strtotime ),
						),
			
					),
				);
				break;

			case 'views_posts':
				$args = array(
					'type'                => 'post',
					'showposts'           => $number,
					'orderby'             => 'meta_value_num',
					'cat'              	  => $cat,	
					'meta_key'            => 'views',				          
					'ignore_sticky_posts' => 1,
					'date_query'          => array(
						array(
							'before' => date( 'Y-m-d H:i:s', time() ),
						),
						array(
							'after' => date( 'Y-m-d H:i:s', $strtotime ),
						),
					),
				);
				break;

			default:
				$args = null;
				break;
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
					$post = get_post();
		?>
		<?php if( $style == '1' ){ ?>
		<li><article class="post--overlay post--overlay-bottom post--overlay-floorfade">
		<div class="background-img " style="background-image:url(<?php echo post_thumbnail(400, 225); ?>)">
		</div>
		<div class="post__text inverse-text">
			<div class="post__text-wrap">
				<div class="post__text-inner ">
					</a>
					<?php xintheme_category_color();?>
					<h3 class="post__title typescale-1">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="post__meta ">
						<time class="time published"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
						<?php 
	                        switch ($who) {

								case 'comment_posts':
									if( xintheme('xintheme_post_meta_comment') ){
										echo '<span><i class="iconfont icon-interactive"></i>'.get_post($post->ID)->comment_count .'</span>';
									}
									break;

								case 'like_posts':
									$pnum = get_post_meta($post->ID,'like',true);
									$pnum = $pnum ? $pnum : 0;
									echo sprintf('<i class="%s"></i> %s', 'icon icon-heart', $pnum );
									break;

								case 'views_posts':
									if( xintheme('xintheme_post_meta_views') ){
										echo '<span><i class="iconfont icon-browse"></i>'.get_post_meta($post->ID,'views',true).'</span>';
									}
									break;
							}
							unset($pnum);
	                    ?>
					</div>
				</div>
			</div>
		</div>
		<a href="<?php the_permalink(); ?>" class="link-overlay"></a></article>
		</li>
		<?php } ?>
		<?php if( $style == '2' ){ ?>
		<li><article class="post post--vertical ">
		<div class="post__thumb min-height-200">
			<a href="<?php the_permalink(); ?>">
				<img <?php echo is_lazysizes(); ?>src="<?php echo post_thumbnail(400, 225); ?>" alt="<?php the_title(); ?>" width="400" height="225">
			</a>
		</div>
		<div class="post__text ">
			<?php xintheme_category_color();?>
			<h3 class="post__title typescale-1">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<div class="post__meta ">
				<time class="time published"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
				<?php 
	                switch ($who) {

						case 'comment_posts':
							if( xintheme('xintheme_post_meta_comment') ){
								echo '<span><i class="iconfont icon-interactive"></i>'.get_post($post->ID)->comment_count .'</span>';
							}
							break;

						case 'like_posts':
							$pnum = get_post_meta($post->ID,'like',true);
							$pnum = $pnum ? $pnum : 0;
							echo sprintf('<i class="%s"></i> %s', 'icon icon-heart', $pnum );
							break;

						case 'views_posts':
							if( xintheme('xintheme_post_meta_views') ){
								echo '<span><i class="iconfont icon-browse"></i>'.get_post_meta($post->ID,'views',true).'</span>';
							}
							break;
					}
					unset($pnum);
	            ?>
			</div>
		</div>
		</article></li>
		<?php } ?>
		<?php if( $style == '3' ){ ?>
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
						<?php 
							switch ($who) {

								case 'comment_posts':
									if( xintheme('xintheme_post_meta_comment') ){
										echo '<span><i class="iconfont icon-interactive"></i>'.get_post($post->ID)->comment_count .'</span>';
									}
									break;

								case 'like_posts':
									$pnum = get_post_meta($post->ID,'like',true);
									$pnum = $pnum ? $pnum : 0;
									echo sprintf('<i class="%s"></i> %s', 'icon icon-heart', $pnum );
									break;

								case 'views_posts':
									if( xintheme('xintheme_post_meta_views') ){
										echo '<span><i class="iconfont icon-browse"></i>'.get_post_meta($post->ID,'views',true).'</span>';
									}
									break;
							}
							unset($pnum);
						?>
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
				<?php 
	                switch ($who) {

						case 'comment_posts':
							if( xintheme('xintheme_post_meta_comment') ){
								echo '<span><i class="iconfont icon-interactive"></i>'.get_post($post->ID)->comment_count .'</span>';
							}
							break;

						case 'like_posts':
							$pnum = get_post_meta($post->ID,'like',true);
							$pnum = $pnum ? $pnum : 0;
							echo sprintf('<i class="%s"></i> %s', 'icon icon-heart', $pnum );
							break;

						case 'views_posts':
							if( xintheme('xintheme_post_meta_views') ){
								echo '<span><i class="iconfont icon-browse"></i>'.get_post_meta($post->ID,'views',true).'</span>';
							}
							break;
					}
					unset($pnum);
	            ?>
			</div>
		</div>
		</article>
		</li>
		<?php endif; $i++; ?>
		<?php } ?>
		<?php if( $style == '4' ){ ?>
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
				<?php 
	                switch ($who) {

						case 'comment_posts':
							if( xintheme('xintheme_post_meta_comment') ){
								echo '<span><i class="iconfont icon-interactive"></i>'.get_post($post->ID)->comment_count .'</span>';
							}
							break;

						case 'like_posts':
							$pnum = get_post_meta($post->ID,'like',true);
							$pnum = $pnum ? $pnum : 0;
							echo sprintf('<i class="%s"></i> %s', 'icon icon-heart', $pnum );
							break;

						case 'views_posts':
							if( xintheme('xintheme_post_meta_views') ){
								echo '<span><i class="iconfont icon-browse"></i>'.get_post_meta($post->ID,'views',true).'</span>';
							}
							break;
					}
					unset($pnum);
	            ?>
			</div>
		</div>
		</article></li>
		<?php } ?>
		<?php if( $style == '5' ){ ?>
		<li><article class="post post--horizontal post--horizontal-reverse post--horizontal-xxs">
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
				<?php 
	                switch ($who) {

						case 'comment_posts':
							if( xintheme('xintheme_post_meta_comment') ){
								echo '<span><i class="iconfont icon-interactive"></i>'.get_post($post->ID)->comment_count .'</span>';
							}
							break;

						case 'like_posts':
							$pnum = get_post_meta($post->ID,'like',true);
							$pnum = $pnum ? $pnum : 0;
							echo sprintf('<i class="%s"></i> %s', 'icon icon-heart', $pnum );
							break;

						case 'views_posts':
							if( xintheme('xintheme_post_meta_views') ){
								echo '<span><i class="iconfont icon-browse"></i>'.get_post_meta($post->ID,'views',true).'</span>';
							}
							break;
					}
					unset($pnum);
	            ?>
			</div>
		</div>
		</article></li>
		<?php } ?>
		<?php
			endwhile;
			wp_reset_query();
			else :
				echo '<li><p>抱歉，没有找到文章！</p></li>';
			endif;
			}else{
				echo '<li><p>抱歉，没有找到文章！</p></li>';
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
				'title' => '文章聚合',
				'num'   => 5,
				'days'  => 30,
				'who'   => 'new_posts',
				'style' => '1',
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
		<p>
			<label> 显示样式：
				<select class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
					<option <?php mi_selected( $instance['style'], '1' ); ?> value="1">样式-1</option>
					<option <?php mi_selected( $instance['style'], '2' ); ?> value="2">样式-2</option>
					<option <?php mi_selected( $instance['style'], '3' ); ?> value="3">样式-3</option>
					<option <?php mi_selected( $instance['style'], '4' ); ?> value="4">样式-4</option>
					<option <?php mi_selected( $instance['style'], '5' ); ?> value="5">样式-5</option>
				</select>
			</label>
		</p>
		<p>
			<label> 显示什么：
				<select class="widefat mi_select_handle" id="<?php echo $this->get_field_id('who'); ?>" name="<?php echo $this->get_field_name('who'); ?>">
					<option <?php mi_selected( $instance['who'], 'new_posts' ); ?> value="new_posts">最新文章</option>
					<option <?php mi_selected( $instance['who'], 'random_posts' ); ?> value="random_posts">随机文章</option>
					<option <?php mi_selected( $instance['who'], 'comment_posts' ); ?> value="comment_posts">评论最多</option>
					<option <?php mi_selected( $instance['who'], 'like_posts' ); ?> value="like_posts">点赞最多</option>
					<option <?php mi_selected( $instance['who'], 'views_posts' ); ?> value="views_posts">浏览最多</option>
				</select>
			</label>
		</p>
		<?php if( $instance['who'] == 'new_posts' || $instance['who'] == 'random_posts' ){ ?>
		<p id="<?php echo $this->get_field_id('who'); ?>-box" style="display: none">
		<?php }else{ ?>
		<p id="<?php echo $this->get_field_id('who'); ?>-box">
		<?php } ?>
			<label>
				显示
				<input class="tiny-text" id="<?php echo $this->get_field_id('days'); ?>" name="<?php echo $this->get_field_name('days'); ?>" type="number" step="1" min="4" value="<?php echo $instance['days']; ?>" style="width: 70px;" />
				<span>
				<?php 
					switch ($instance['who']) {
						case 'comment_posts':
							echo '天内评论最多的文章';
							break;
						
						case 'like_posts':
							echo '天内点赞最多的文章';
							break;
						case 'views_posts':
							echo '天内浏览最多的文章';
							break;
						default:
							break;
					}
				?>
				</span>		
			</label>
		</p>
		<p>
			<label>
				分类限制：
				<input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
				格式：1,2 &nbsp;表示只显示分类ID为1,2分类的文章，格式：-1,-2 &nbsp;表示排除分类ID为1,2的文章，也可以直接写1或者-1；注意：多个ID之间用英文逗号隔开！
			</label>
		</p>
<?php
	}

}
add_action('widgets_init', function(){register_widget('xintheme_post_tools' );});

function mi_selected( $t, $i ){
	if( $t == $i ){
		echo 'selected';
	}
}

/**
 * 加载一段JS
 */
function mi_select_handle() {  
?>
	<script>

		jQuery( document ).ready( function() {
			if( jQuery('.mi_select_handle').length > 0 ){
				jQuery('.mi_select_handle').each(function(index, el) {
					mi_select_handle( jQuery(this).attr('id') );
				});
			}

		});

		jQuery(document).on('change', '.mi_select_handle', function(event) {
			event.preventDefault();
			mi_select_handle( jQuery(this).attr('id') );
		});

		function mi_select_handle( id ){
			var selected = jQuery('#'+id+' option:selected');
			if( selected.val() == 'comment_posts' || selected.val() == 'like_posts' || selected.val() == 'views_posts' ){
				jQuery('#'+id+'-box label span').text( ' 天内' + selected.text() + '的文章' );
		 		jQuery('#'+id+'-box').show();

		 	}else{
		 		jQuery('#'+id+'-box').hide();
		 	}
		}
	</script>
<?php
}  
add_action( 'admin_footer', 'mi_select_handle' );

