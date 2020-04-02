<?php

//载入用户中心模版
/* add_action( 'send_headers', 'xintheme_axin');
function xintheme_axin() {
global $url_array;
    $url_array = explode("/",$_SERVER['REQUEST_URI']);
    $route = $url_array[2];
    $template_dir = get_template_directory();
    switch($route) {
    case 'user':
        load_template($template_dir.'/user/index.php');
        die();
        break;
    }
} */

//注册AJAX
if ( ! function_exists( 'xintheme_enqueue_ajax_url' ) ) {
	function xintheme_enqueue_ajax_url() {
        echo '<script type="application/javascript">var ajaxurl = "' . esc_url(admin_url( 'admin-ajax.php' )) . '"</script>';
	}
	add_action( 'wp_enqueue_scripts', 'xintheme_enqueue_ajax_url' );
}
//载入JS\CSS
if ( ! function_exists( 'xintheme_scripts_method' ) ) {
    function xintheme_scripts_method() {
        
        wp_enqueue_style( 'xintheme_vendors', get_template_directory_uri().'/static/css/vendors.css', array(), '' );
        wp_enqueue_style( 'thenextmag-style', get_template_directory_uri().'/static/css/style.css', array('xintheme_vendors'), '' );
		wp_enqueue_style( 'iconfont', get_template_directory_uri().'/static/font/iconfont.css', array(), '' );

		/*$cdn_switch = xintheme('cdn_switch');
		$thumbnail	= xintheme('thumbnail');
		if( !$cdn_switch ){
			if ($thumbnail == 'default') {
				wp_enqueue_style( 'post_thumb', get_template_directory_uri().'/static/css/post_thumb.css', array(), '' );
			}
		}*/

        //vendors
        wp_enqueue_script('throttle-debounce', get_template_directory_uri() . '/static/js/vendors/throttle-debounce.min.js', array('jquery'),false, true);
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/static/js/vendors/bootstrap.min.js', array('throttle-debounce'),false, true);
        wp_enqueue_script('final-countdown', get_template_directory_uri() . '/static/js/vendors/countdown.min.js', array('bootstrap'),false, true);
        wp_enqueue_script('flickity', get_template_directory_uri() . '/static/js/vendors/flickity.min.js', array('final-countdown'),false, true);
        wp_enqueue_script('fotorama', get_template_directory_uri() . '/static/js/vendors/fotorama.min.js', array('flickity'),false, true);
        wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/static/js/vendors/magnific-popup.min.js', array('fotorama'),false, true);
        wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/static/js/owl.carousel.min.js', array('magnific-popup'),false, true);
        wp_enqueue_script('perfect-scrollbar', get_template_directory_uri() . '/static/js/vendors/perfect-scrollbar.min.js', array('owl-carousel'),false, true);
        wp_enqueue_script('theiaStickySidebar', get_template_directory_uri() . '/static/js/vendors/theiaStickySidebar.min.js', array('perfect-scrollbar'),false, true);
        wp_enqueue_script('vticker', get_template_directory_uri() . '/static/js/vendors/vticker.min.js', array('theiaStickySidebar'),false, true);
        wp_enqueue_script('fitvids', get_template_directory_uri() . '/static/js/vendors/fitvids.js', array('vticker'),false, true);
        
        //theme scripts
        wp_enqueue_script('thenextmag-scripts', get_template_directory_uri() . '/static/js/scripts.js', array('fitvids'),false, true);              
        
        if ( is_singular() ) {wp_enqueue_script('comment-reply');}
		
		if (is_single()) {
			wp_enqueue_style('fancybox', get_stylesheet_directory_uri().'/static/fancybox/jquery.fancybox.min.css');
			wp_enqueue_script('fancybox3', get_stylesheet_directory_uri() . '/static/fancybox/jquery.fancybox.min.js', ['jquery'], '', true);
			
			wp_enqueue_script('prism', get_stylesheet_directory_uri() . '/static/js/prism.js', ['jquery'], '', true);
		}
		
     }
}
add_action('wp_enqueue_scripts', 'xintheme_scripts_method');

//Relive v3  全局灰色背景
if( xintheme('full_background_white') ){
	add_filter('body_class','relive_v3_body_class');
	function relive_v3_body_class($body_relive_v3) {
	    $body_relive_v3[] = 'body_relive_v3';
	    return $body_relive_v3;
	}
}

//后台加载css（编辑器部分）
if ( ! function_exists( 'xintheme_post_admin_scripts_and_styles' ) ) {
    function xintheme_post_admin_scripts_and_styles() {        
        add_editor_style('static/css/admin/editor-style.css');
    }
}
add_action('admin_enqueue_scripts', 'xintheme_post_admin_scripts_and_styles');
//自定义导航栏字体颜色
function xintheme_menu_color() {
    echo "<style>.mobile-header--inverse .mobile-header-btn,.mobile-header--inverse .mobile-header-btn:hover,.navigation-bar--inverse .navigation--main > li > a, .navigation-bar--inverse .navigation-bar-btn,.navigation-bar--inverse .navigation--main > li.current-menu-item > a, .navigation-bar--inverse .navigation--main > li:hover > a,.navigation-bar--inverse .navigation-bar-btn:hover,.social-list--inverse > li > a,.social-list--inverse > li > a:hover {color: ".xintheme('header_menu_color').";}</style>";
}
add_action('wp_head', 'xintheme_menu_color');
//当搜索结果只有一篇时直接重定向到日志
add_action('template_redirect', function () {
	if (is_search() && get_query_var('module') == '') {
		global $wp_query;
		$paged	= get_query_var('paged');
		if ($wp_query->post_count == 1 && empty($paged)) {
			wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
		}
	}
});

//删除菜单多余css class
function wpjam_css_attributes_filter($classes) {
	return is_array($classes) ? array_intersect($classes, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent','menu-item-has-children','menu-item')) : '';
}
add_filter('nav_menu_css_class',	'wpjam_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id',		'wpjam_css_attributes_filter', 100, 1);
add_filter('page_css_class', 		'wpjam_css_attributes_filter', 100, 1);

//直接去掉函数 comment_class() 和 body_class() 中输出的 "comment-author-" 和 "author-"
//避免 WordPress 登录用户名被暴露 
function xintheme_comment_body_class($content){
    $pattern = "/(.*?)([^>]*)author-([^>]*)(.*?)/i";
    $replacement = '$1$4';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
add_filter('comment_class', 'xintheme_comment_body_class');
add_filter('body_class', 'xintheme_comment_body_class');


//删除wordpress默认相册样式
add_filter( 'use_default_gallery_style', '__return_false' );

//文章自动nofollow
add_filter( 'the_content', function ( $content ) {
	//fancybox3图片添加 data-fancybox
    global $post;
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 data-fancybox="images" $6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
	//文章自动nofollow
	$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
	if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
		if( !empty($matches) ) {
   
			$srcUrl = get_option('siteurl');
			for ($i=0; $i < count($matches); $i++)
			{
				$tag = $matches[$i][0];
				$tag2 = $matches[$i][0];
				$url = $matches[$i][0];
   
				$noFollow = '';
				$pattern = '/target\s*=\s*"\s*_blank\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 )
					$noFollow .= ' target="_blank" ';
   
				$pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 )
					$noFollow .= ' rel="nofollow" ';
   
				$pos = strpos($url,$srcUrl);
				if ($pos === false) {
					$tag = rtrim ($tag,'>');
					$tag .= $noFollow.'>';
					$content = str_replace($tag2,$tag,$content);
				}
			}
		}
	}
	$content = str_replace(']]>', ']]>', $content);
	return $content;
});

/* 评论作者链接新窗口打开 */
add_filter('get_comment_author_link', function () {
	$url	= get_comment_author_url();
	$author = get_comment_author();
	if ( empty( $url ) || 'http://' == $url ){
		return $author;
	}else{
		return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
	}
});

//去除加载的css和js后面的版本号
if( xintheme('xintheme_remove_script_version') ){
	function _remove_script_version( $src ){
		$parts = explode( '?', $src );
		return $parts[0];
	}
	add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'pre_option_link_manager_enabled', '__return_true' );
}

/* 比功能与bbpress插件冲突
//搜索结果排除所有页面
function search_filter_page($query) {
    if ($query->is_search && !$query->is_admin) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'search_filter_page');
*/

/* 搜索关键词为空 */
add_filter( 'request', function ( $query_variables ) {
	if (isset($_GET['s']) && !is_admin()) {
		if (empty($_GET['s']) || ctype_space($_GET['s'])) {
			wp_redirect( home_url() );
			exit;
		}
	}
	return $query_variables;
} );
/**
 * WordPress 关闭 XML-RPC 的 pingback 端口
 */
if( xintheme('xintheme_pingback') ) :
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );
function remove_xmlrpc_pingback_ping( $methods ) {
	unset( $methods['pingback.ping'] );
	return $methods;
}
endif;
//禁止头部加载s.w.org
add_filter( 'wp_resource_hints', function ( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}, 10, 2 );

//移除头部emoji.js加载
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

//给文章图片自动添加alt和title信息
add_filter('the_content', function ($content) {
	global $post;
	$pattern		= "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement	= '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
});

//修复 WordPress 找回密码提示“抱歉，该key似乎无效”
add_filter('retrieve_password_message', function ( $message, $key ) {
	if ( strpos($_POST['user_login'], '@') ) {
		$user_data = get_user_by('email', trim($_POST['user_login']));
	} else {
		$login = trim($_POST['user_login']);
		$user_data = get_user_by('login', $login);
	}
	
	$user_login = $user_data->user_login;
	$msg	= __('有人要求重设如下帐号的密码：'). "\r\n\r\n";
	$msg	.= network_site_url() . "\r\n\r\n";
	$msg	.= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
	$msg	.= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
	$msg	.= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
	$msg	.= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;

	return $msg;
}, null, 2);
//缩略图
function post_thumbnail($width=400, $height=200, $echo=1){
	
    $default_timthumb	= xintheme('timthumb');

    $timthumb_gallery	= explode( ',', $default_timthumb );
    $timthumb_num = count($timthumb_gallery);

	$random				= mt_rand(0, $timthumb_num);
	$timthumb			= wp_get_attachment_image_src($timthumb_gallery[$random],'full')[0];
	
	$thumbnail = xintheme('thumbnail');
	
	$cdn_type = xintheme('cdn_type');
	$cdn_switch = xintheme('cdn_switch');
	global $post;
	$title = $post->post_title;
	$dir = get_bloginfo('template_directory');
	$post_img = '';
	if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$src = $timthumb_src[0];
		if( $cdn_switch ){
			if( $cdn_type == 'qiniu' ){
				$post_img_src = "$src?imageView2/1/w/$width/h/$height/q/100";
			}elseif( $cdn_type == 'alioss' ){
				$post_img_src = "$src?x-oss-process=image/resize,m_fill,w_$width,h_$height";
			}elseif( $cdn_type == 'txcos' ){
				$post_img_src = "$src?imageView2/1/w/$width/h/$height/q/100";
			}
		}else{
			if ($thumbnail == 'timthumb') {
				$post_img_src = "$dir/timthumb.php&#63;src=$src&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";
			} else {
				$post_img_src = "$src";
			}
		}
	}else{
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			$src = $matches[0][1];
		}else{ // thumb
			
			$src = $timthumb;
		}
		if( $cdn_switch ){
			if( $cdn_type == 'qiniu' ){
				$post_img_src = "$src?imageView2/1/w/$width/h/$height/q/100";
			}elseif( $cdn_type == 'alioss' ){
				$post_img_src = "$src?x-oss-process=image/resize,m_fill,w_$width,h_$height";
			}elseif( $cdn_type == 'txcos' ){
				$post_img_src = "$src?imageView2/1/w/$width/h/$height/q/100";
			}
		}else{
			if ($thumbnail == 'timthumb') {
				$post_img_src = "$dir/timthumb.php&#63;src=$src&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";
			} else {
				$post_img_src = "$src";
			}
		}
	}
	$post_img =$post_img_src;
	return $post_img;
	
}

//文章摘要
add_filter('the_excerpt',function($post_excerpt){
	global $post;
	$meta_data = get_post_meta($post->ID, 'extend_info', true); 
	$post_abstract = isset($meta_data['post_abstract']) ?$meta_data['post_abstract'] : '';
	if(!empty($post_abstract)){
		return mb_strimwidth($post_abstract, 0, 120, '...');
	}elseif( has_excerpt() ){
		$description = get_the_excerpt();
		return mb_strimwidth($description, 0, 120, '...');
	}else{
		return get_post_excerpt($post, 120, '...');
	}
});
if(!defined('WPJAM_BASIC_PLUGIN_FILE')){
	//获取日志摘要
	function get_post_excerpt($post=null, $excerpt_length=240){
		$post = get_post($post);
		if ( empty( $post ) ) {
			return '';
		}

		$post_excerpt = $post->post_excerpt;
		if($post_excerpt == ''){
			$post_content   = strip_shortcodes($post->post_content);
			//$post_content = apply_filters('the_content',$post_content);
			$post_content   = wp_strip_all_tags( $post_content );
			$excerpt_length = apply_filters('excerpt_length', $excerpt_length);	 
			$excerpt_more   = apply_filters('excerpt_more', ' ' . '...');
			$post_excerpt   = get_first_p($post_content); // 获取第一段
			if(mb_strwidth($post_excerpt) < $excerpt_length*1/3 || mb_strwidth($post_excerpt) > $excerpt_length){ // 如果第一段太短或者太长，就获取内容的前 $excerpt_length 字
				$post_excerpt = mb_strimwidth($post_content,0,$excerpt_length,$excerpt_more,'utf-8');
			}
		}

		$post_excerpt = wp_strip_all_tags( $post_excerpt );
		$post_excerpt = trim( preg_replace( "/[\n\r\t ]+/", ' ', $post_excerpt ), ' ' );

		return $post_excerpt;
	}
	//获取第一段
	function get_first_p($text){
		if($text){
			$text = explode("\n",strip_tags($text)); 
			$text = trim($text['0']); 
		}
		return $text;
	}
}
//文章浏览量统计
function record_visitors(){
    if (is_singular()) {global $post;
     $post_ID = $post->ID;
      if($post_ID) 
      {
          $post_views = (int)get_post_meta($post_ID, 'views', true);
          if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
          {
            add_post_meta($post_ID, 'views', 1, true);
          }
      }
    }
}
add_action('wp_head', 'record_visitors');  

function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
};
//使用v2ex镜像avatar头像
if( xintheme('xintheme_v2ex') ) :
	add_filter( 'get_avatar', function ($avatar) {
		return str_replace(['cn.gravatar.com/avatar', 'secure.gravatar.com/avatar', '0.gravatar.com/avatar', '1.gravatar.com/avatar', '2.gravatar.com/avatar'], 'cdn.v2ex.com/gravatar', $avatar);
	}, 10, 3 );
	
endif;
function xintheme_get_https_avatar($avatar) {
	// Replacement for HTTPS domain 替换为 https 的域名
	$avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "secure.gravatar.com", $avatar);
	// Replacement for HTTPS protocol 替换为 https 协议
	$avatar = str_replace("http:", "https:", $avatar);
	return $avatar;
}
add_filter('get_avatar', 'xintheme_get_https_avatar');

//去除分类标志代码
if( xintheme('xintheme_category') ) :
add_action( 'load-themes.php',  'no_category_base_refresh_rules');
add_action('created_category', 'no_category_base_refresh_rules');
add_action('edited_category', 'no_category_base_refresh_rules');
add_action('delete_category', 'no_category_base_refresh_rules');
function no_category_base_refresh_rules() {
	global $wp_rewrite;
	$wp_rewrite -> flush_rules();
}

// register_deactivation_hook(__FILE__, 'no_category_base_deactivate');
// function no_category_base_deactivate() {
// 	remove_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
// 	// We don't want to insert our custom rules again
// 	no_category_base_refresh_rules();
// }

// Remove category base
add_action('init', 'no_category_base_permastruct');
function no_category_base_permastruct() {
	global $wp_rewrite, $wp_version;
	if (version_compare($wp_version, '3.4', '<')) {
		// For pre-3.4 support
		$wp_rewrite -> extra_permastructs['category'][0] = '%category%';
	} else {
		$wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
	}
}

// Add our custom category rewrite rules
add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
function no_category_base_rewrite_rules($category_rewrite) {
	//var_dump($category_rewrite); // For Debugging

	$category_rewrite = array();
	$categories = get_categories(array('hide_empty' => false));
	foreach ($categories as $category) {
		$category_nicename = $category -> slug;
		if ($category -> parent == $category -> cat_ID)// recursive recursion
			$category -> parent = 0;
		elseif ($category -> parent != 0)
			$category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
		$category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
		$category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
		$category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
	}
	// Redirect support from Old Category Base
	global $wp_rewrite;
	$old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
	$old_category_base = trim($old_category_base, '/');
	$category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';

	//var_dump($category_rewrite); // For Debugging
	return $category_rewrite;
}


// Add 'category_redirect' query variable
add_filter('query_vars', 'no_category_base_query_vars');
function no_category_base_query_vars($public_query_vars) {
	$public_query_vars[] = 'category_redirect';
	return $public_query_vars;
}

// Redirect if 'category_redirect' is set
add_filter('request', 'no_category_base_request');
function no_category_base_request($query_vars) {
	//print_r($query_vars); // For Debugging
	if (isset($query_vars['category_redirect'])) {
		$catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
		status_header(301);
		header("Location: $catlink");
		exit();
	}
	return $query_vars;
}
endif;
//去除wordpress前台顶部工具条
show_admin_bar(false);
//移除顶部多余信息
if( xintheme('xintheme_wp_head') ) :
	remove_action( 'wp_head', 'feed_links', 2 ); //移除feed
	remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除feed
	remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
	remove_action( 'wp_head', 'wlwmanifest_link' );  //移除离线编辑器开放接口
	remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
	remove_action('wp_head', 'parent_post_rel_link', 10, 0 );//清除前后文信息
	remove_action('wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'locale_stylesheet' );
	remove_action('publish_future_post','check_and_publish_future_post',10, 1 );
	remove_action( 'wp_head', 'noindex', 1 );
	remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
	remove_action( 'wp_head', 'rel_canonical' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
endif;
//禁止FEED
if( xintheme('xintheme_feed') ) :
	function digwp_disable_feed() {
	wp_die(__('<h1>Feed已经关闭, 请访问网站<a href="'.get_bloginfo('url').'">首页</a>!</h1>'));
	}
	add_action('do_feed', 'digwp_disable_feed', 1);
	add_action('do_feed_rdf', 'digwp_disable_feed', 1);
	add_action('do_feed_rss', 'digwp_disable_feed', 1);
	add_action('do_feed_rss2', 'digwp_disable_feed', 1);
	add_action('do_feed_atom', 'digwp_disable_feed', 1);
endif;
//点赞
function like(){  
    global $wpdb, $post;  
    $id = $_POST["um_id"];  
    if ($_POST["um_action"] == 'topTop') {  
        $specs_raters = get_post_meta($id, 'like', true);  
        $expire = time() + 99999999;  
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost  
        setcookie('like_' . $id, $id, $expire, '/', $domain, false);  
        if (!$specs_raters || !is_numeric($specs_raters)) update_post_meta($id, 'like', 1);  
        else update_post_meta($id, 'like', ($specs_raters + 1));  
        echo get_post_meta($id, 'like', true);  
    }  
    die;  
}
add_action('wp_ajax_nopriv_like', 'like'); 
add_action('wp_ajax_like', 'like');
//增加后台用户信息选项
add_filter('user_contactmethods','xintheme_custom_contactmethods');
function xintheme_custom_contactmethods($user_contactmethods ){
    $user_contactmethods  = array(
        'qq'	 	=> 'QQ号码',
        'weibo' 	=> '微博链接',
        'weixin' 	=> '微信二维码',
        'youxiang'	=> 'QQ邮箱',
		'gender'	=> '性别'
    );
    return $user_contactmethods ;
}
//禁止前台加载语言包
if( !defined('WPJAM_BASIC_PLUGIN_FILE') ){
	if( xintheme('xintheme_language') ) :
		add_filter( 'locale', 'xintheme_language' );
		function xintheme_language($locale) {
			$locale = ( is_admin() ) ? $locale : 'en_US';
			return $locale;
		}
	endif;
}
//全站图像增加圆角处理
if( xintheme('img_border_radius') ) :
	add_action('wp_head', 'xintheme_wp_head');
	function xintheme_wp_head() {
		echo '<style>.post__thumb a:first-child{-webkit-backface-visibility: hidden;-moz-backface-visibility: hidden;-webkit-transform: translate3d(0, 0, 0);-moz-transform: translate3d(0, 0, 0);}.post__thumb a,.post--overlay,.post__thumb img,.xintheme-ad img,.widget img,.entry-content img,.featured-with-overlap-posts .sub-posts article .post__thumb{border-radius: 5px}.post__thumb a + a{border-radius: 2px}.post__cat,.category-tile__name{border-radius: 2px}</style>';
	}
endif;
//文章标题 Hover 颜色
add_action('wp_head', 'title_hover_color');
function title_hover_color() {
	echo '<style>.breadcrumb a:hover,.post .post__title a:hover {color:'.xintheme('title_hover_color').'}.navigation--main > li > a::before {background:'.xintheme('current_menu_color').'}.site-header--skin-4 .navigation--main > li > a::before {background: '.xintheme('current_menu_color').' !important;}</style>';
}
//修改搜索结果的链接
function xintheme_redirect_search() {
	if (is_search() && !empty($_GET['s'])) {
		wp_redirect(home_url("index.php/search/").urlencode(get_query_var('s')));
		exit();
	}
}

add_action('template_redirect', 'xintheme_redirect_search' );
//整站所有页面新窗口打开
if( xintheme('relive_all_blank') ){
	add_action('wp_head', 'relive_all_blank');
	function relive_all_blank() {
		echo '<base target="_blank" />';
	}
}


//tag关键词自动描文本
if( xintheme('tag_link') ){
	$match_num_from = 1;  //每篇文章中的关键词数量低于多少则不描文本（请不要低于1）
	$match_num_to = 1; //同一篇文章中，同一个关键词最多描几次文本（这里是1次，建议不超过2次）
	$num_id = 0; //请不要修改这个参数
	add_filter('the_content','tag_link',1);
	function tag_sort($a, $b){
	    if ( $a->name == $b->name ) return 0;
		$num_id--;
	    return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
	}
	function tag_link($content){
	global $match_num_from,$match_num_to;
	     $posttags = get_the_tags();
	     if ($posttags) {
	         usort($posttags, "tag_sort");
	         foreach($posttags as $tag) {
				if($num_id >= 4){ //最多添加4个
					break;
				}else{
					$num_id++;
				}
	            $link = get_tag_link($tag->term_id);
	            $keyword = $tag->name;
	            $cleankeyword = stripslashes($keyword);
	            $url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('浏览关于“%s”的文章'))."\"";
	            $url .= ' target="_blank" class="tag_link"';
	            $url .= ">".addcslashes($cleankeyword, '$')."</a>";
	            $limit = rand($match_num_from,$match_num_to);
	   
	            $content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
	            $content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
	   
	                $cleankeyword = preg_quote($cleankeyword,'\'');
	   
	                    $regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
	   
	                $content = preg_replace($regEx,$url,$content,$limit);
	   
	    $content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);
	   
	         }
	    }
	    return $content;
	}
}

//禁用复制粘贴以及F12
if( xintheme('relive_false_f12') ){
	add_action('wp_head', 'relive_false_f12');
	function relive_false_f12() {
		echo '<script language="Javascript">document.onselectstart = new Function("return false;");  document.oncontextmenu = new Function("return false;");document.onkeydown = document.onkeyup = document.onkeypress = function(event) { var e = event || window.event || arguments.callee.caller.arguments[0]; if (e && e.keyCode == 123) {  e.returnValue = false; return (false); } }</script>';
	}
}