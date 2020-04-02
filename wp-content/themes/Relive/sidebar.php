<div class="mnmd-sub-col mnmd-sub-col--right js-sticky-sidebar<?php if( xintheme('mobile_no_sidebar') ){?> mobile_no_sidebar<?php }?>">
	<div class="theiaStickySidebar">
	<!--作者模块开始-->
	<?php
		if ( is_single() && xintheme('post_sidebar_author') ) {
		$author_id = get_the_author_meta('ID');
		$author_url = get_author_posts_url($author_id);	
		$user_email = get_the_author_meta( 'user_email' );
	?>
	<div id="zuozhebg" style="background: url(<?php echo get_xintheme_get_avatar( get_the_author_meta('ID') , '98' , xintheme_get_avatar_type( $author_id ) ); ?>) center center no-repeat;background-size:cover"></div>
	<div class="relive_widget_v3">
		<div class="box-author-info">
			<div class="author-face">
				<a href="<?php echo $author_url;?>" target="_blank" rel="nofollow" title="访问<?php echo the_author_meta( 'nickname' ); ?>的主页">
					<?php echo xintheme_get_avatar( get_the_author_meta('ID') , '98' , xintheme_get_avatar_type( $author_id ) ); ?>
				</a>
			</div>
			<div class="author-name">
				<?php echo the_author_meta( 'nickname' ); ?> </a> <?php echo xintheme_level() ?>
			</div>
			<div class="author-one">
				<?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{echo'我还没有学会写个人说明！'; }?>
			</div>
			<div class="author-article-pl">
				<ul>
					<li><a href="<?php echo $author_url;?>" target="_blank" rel="nofollow" title="访问<?php echo the_author_meta( 'nickname' ); ?>的主页">作者主页</a></li>
					<span>|</span>
					<li><a href="<?php echo $author_url;?>" title="共发布了<?php the_author_posts(); ?>篇文章" target="_blank" rel="nofollow"><?php the_author_posts(); ?> 篇文章</a></li>
				</ul>
			</div>
		</div>
		<dl class="article-newest">
			<dt><span class="tit">最近文章</span></dt>
			<?php
				global $post;
				$post_author = get_the_author_meta( 'user_login' );
				$args = array(
					'author_name' => $post_author,
					'post__not_in' => array($post->ID),
					'showposts' => 6, // 显示相关文章数量
					'ignore_sticky_posts' => 1
				);
				query_posts($args);
				$i = 0;
				if (have_posts()) {
				while (have_posts()) { $i++;
				the_post(); update_post_caches($posts); ?>
				<li>
					<span class="order od-<?php echo $i;?>"><?php echo $i;?></span>
					<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title_attribute(); ?>"><i class="iconfont icon-sanjiao"></i><?php the_title(); ?></a>
				</li>
				<?php } }
				else {
				echo '<li>* 没有更多文章了</li>';
				}
				wp_reset_query();?>
		</dl>
	</div>
	<?php }?>
	<!--作者模块结束-->
	<?php
	if ( is_single() ) {
	$post_extend = get_post_meta( get_the_ID(), 'extend_info', true );
	$sidebar_doc = isset($post_extend['sidebar-doc']) ?$post_extend['sidebar-doc'] : '';
	if( $sidebar_doc ){ ?>
	<script type="text/javascript">
	(function( $ ){
		$(function(){
			var notdefault = 0;
			$('.entry-content').find('h2').each(function(index,item){
				notdefault = 1;
				$(this).attr('id','xin'+index);
				var headerText=$(this).text();
				var tagName=$(this)[0].tagName.toLowerCase();
				var tagIndex=parseInt(tagName.charAt(1));
				$('.sidebar-doc-nav').append($('<li class="sidebar-doc-nav-h'+tagIndex+'"><a href="#xin'+index+'">'+headerText+'</a></li>'));
			});
		   //页面平滑滚动
			$('.sidebar-doc-nav-h2  a').click(function () {
				var offsetNum = $($.attr(this, 'href')).offset();//获取偏移量
					offsetTop = offsetNum.top - 80;//偏移量具体调整
					console.log(offsetNum);
					$('html, body').animate({scrollTop: offsetTop}, 1000);
				return false;
			});
			//选中标题增加 active class类
			$(".sidebar-doc-nav-h2 a").click(function(){
				$(".sidebar-doc-nav-h2 a").removeClass("active");
				$(this).addClass("active");
			});
			
		});
	})( jQuery );
	</script>
	<div class="widget sidebar-doc">
		<div class="mnmd-widget-reviews-list">
			<div class="widget__title block-heading block-heading--line">
				<h4 class="widget__title-text">文章目录</h4>
			</div>
			<ul class="sidebar-doc-nav">
			</ul>
		</div>
	</div>
	<?php } } ?>
	
	<?php 
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_right')) : endif; 

	if (is_single()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_post')) : endif; 
	}

	else if (is_page()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_page')) : endif; 
	}

	else if (is_home()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sidebar')) : endif; 
	}
	else {
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_other')) : endif; 
	}
	?>
	</div>
</div>