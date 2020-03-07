<?php

if( xintheme('full_background_white') ){
	$widget = 'widget relive_widget_v3';
}else{
	$widget = 'widget';
}

//激活小工具
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => '全站侧栏',
		'id'            => 'widget_right',
		'before_widget' => '<div class="'.$widget.' %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="widget__title block-heading block-heading--line"><h4 class="widget__title-text">', 
		'after_title' => '</h4></div>' 
	));
	register_sidebar(array(
		'name'          => '首页侧栏',
		'id'            => 'widget_sidebar',
		'before_widget' => '<div class="'.$widget.' %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="widget__title block-heading block-heading--line"><h4 class="widget__title-text">', 
		'after_title' => '</h4></div>' 
	));

	register_sidebar(array(
		'name'          => '文章页侧栏',
		'id'            => 'widget_post',
		'before_widget' => '<div class="'.$widget.' %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="widget__title block-heading block-heading--line"><h4 class="widget__title-text">', 
		'after_title' => '</h4></div>' 
	));
	
	register_sidebar(array(
		'name'          => '页面侧栏',
		'id'            => 'widget_page',
		'before_widget' => '<div class="'.$widget.' %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="widget__title block-heading block-heading--line"><h4 class="widget__title-text">', 
		'after_title' => '</h4></div>' 
	));
	
	register_sidebar(array(
		'name'          => '分类/标签/搜索页侧栏',
		'id'            => 'widget_other',
		'before_widget' => '<div class="'.$widget.' %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="widget__title block-heading block-heading--line"><h4 class="widget__title-text">', 
		'after_title' => '</h4></div>' 
	));

}
include_once get_template_directory() .'/template-parts/widgets/index.php';

//去除自带小工具
function unregister_widgets() {
   unregister_widget("WP_Widget_Pages");//页面
   unregister_widget("WP_Widget_Calendar");//文章日程表
   unregister_widget("WP_Widget_Archives");//文章归档
   unregister_widget("WP_Widget_Meta");//登入/登出，管理，Feed 和 WordPress 链接
   unregister_widget("WP_Widget_Search");//搜索
   unregister_widget("WP_Widget_Categories");//分类目录
   unregister_widget("WP_Widget_Recent_Posts");//近期文章
   unregister_widget("WP_Widget_Recent_Comments");//近期评论
   unregister_widget("WP_Widget_RSS");//RSS订阅
   unregister_widget("WP_Widget_Links");//链接
   unregister_widget("WP_Widget_Text");//文本
   unregister_widget("WP_Widget_Tag_Cloud");//标签云
   unregister_widget("WP_Nav_Menu_Widget");//自定义菜单
   unregister_widget("WP_Widget_Media_Audio");//音频
   unregister_widget("WP_Widget_Media_Image");//图片
   unregister_widget("WP_Widget_Media_Video");//视频
   unregister_widget("WP_Widget_Media_Gallery");//画廊
}
add_action("widgets_init", "unregister_widgets");