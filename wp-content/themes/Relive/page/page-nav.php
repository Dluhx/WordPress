<?php
/*
Template Name: 网址导航
*/
/**
 * 获取不带http(s)链接
 *
 * @param $string
 *
 * @return null|string|string[]
 */
function get_no_http_url( $string ) {
	$pattern     = '/^(http:\/\/|https:\/\/)+/';
	$replacement = '';
	$string      = preg_replace( $pattern, $replacement, $string );

	return $string;
}

/**
 * 判断SSL
 *
 * @param $string
 *
 * @return string
 */
function is_url_ssl( $string ) {
	$pattern = '/^(https:\/\/)+/';
	if ( preg_match( $pattern, $string ) ) {
		$isTrue = "true";
	} else {
		$isTrue = "false";
	}

	return $isTrue;
}
get_header();?>
<style>.body_relive_v3 {background-color: #f0f1f4}</style>
<div class="site-content container">
	<div class="row">
		<div class="col-lg-12">
			<div class="content-area">
				<main class="site-main">
				<div class="nav-sidebar col-lg-2">
					<nav class="nav">
						<ul class="nav-list">
						</ul>
					</nav>
				</div>
				<script>
				(function($){
				    $(function(){
				        var notdefault = 0;
				        $('.entry-content').find('h4').each(function(index,item){
				            notdefault = 1;
				            $(this).attr('id','c'+index);
				            var headerText=$(this).text();
				            var tagName=$(this)[0].tagName.toLowerCase();
				            var tagIndex=parseInt(tagName.charAt(1));
							$('.nav-list').append($('<li class="nav-list-item"><a href="#c'+index+'" class="nav-item">'+headerText+'</a></li>'));
				        });
					   //页面平滑滚动
						$('.nav-list  a').click(function () {
							var offsetNum = $($.attr(this, 'href')).offset();//获取偏移量
								offsetTop = offsetNum.top - 25;//偏移量具体调整
								console.log(offsetNum);
								$('html, body').animate({scrollTop: offsetTop}, 1000);
							return false;
						});
						//点击增加active
						$(".nav-list a").click(function(){
							$(".nav-list a").removeClass("active");
							$(this).addClass("active");
						})
				    });
				})(jQuery);
				</script>
				<article class="type-post post col-lg-10">
				<div class="entry-wrapper" id="navs">
				<div class="entry-content u-clearfix items">
					<?php
						$url_navigation = xintheme('url_navigation'); 
						if(is_array($url_navigation)):foreach($url_navigation as $id):
					?>
					<div class="block-heading block-heading--line">
						<h4 class="block-heading__title" style="font-size: 18px"><?php echo $id['xintheme_nav_cat_title']; ?></h4>
					</div>
					<div class="row">
					<?php
					$bookmarks = get_bookmarks( 'orderby=rating&category_name=&category='.$id['xintheme_nav_cat_list'].'' );

					if ( ! empty( $bookmarks ) ) {

						foreach ( $bookmarks as $bookmark ) {
							if ( $bookmark->link_description != '' ) {
								$description = $bookmark->link_description;
							} else {
								$description = '暂无介绍';
							}
							$bookmark->link_image !== '' ? $imgHeader = '<img alt="" src="'. $bookmark->link_image .'" srcset="'. $bookmark->link_image .' 2x" class="avatar photo" height="132" width="132">' : $imgHeader = get_avatar( $bookmark->link_notes, 132 );
							echo '<div class="col-sm-3">		
								<div class="card">	
									<a class="card-heading link-tooltip" title="' . $bookmark->link_url . '" href="' . $bookmark->link_url . '" rel="nofollow" target="_blank">
										<span class="card-icon">' . $imgHeader . '</span>
										<span class="card-title">' . $bookmark->link_name . '</span>
									</a>
									<div class="card-body">
										' . $description . '
									</div>
								</div>
							</div>';
						}
					}
					?>
					</div>
					<?php endforeach; endif;?>
				</div>
				</div>
				</article>
				<?php //comments_template( '', true ); ?>
				</main>
			</div>
		</div>
	</div>
</div>
<?php get_footer();?>