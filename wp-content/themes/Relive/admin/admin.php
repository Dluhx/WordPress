<?php
if( !defined('WPJAM_BASIC_PLUGIN_FILE') ){
	//在后台文章列表增加一列数据
	add_filter( 'manage_posts_columns', 'xintheme_customer_posts_columns' );
	function xintheme_customer_posts_columns( $columns ) {
	$columns['views'] = '浏览次数';
	return $columns;
	}
	//输出浏览次数
	add_action('manage_posts_custom_column', 'xintheme_customer_columns_value', 10, 2);
	function xintheme_customer_columns_value($column, $post_id){
	if($column=='views'){
	$count = get_post_meta($post_id, 'views', true);
	if(!$count){
	$count = 0;
	}
	echo $count;
	}
	return;
	}
}
//自定义分类-1
function xintheme_category_color() {
	$categories = get_the_category();
	$color = get_term_meta($categories[0]->term_id, 'cc_color', true);
	$separator = '';
	$output = '';
	if($categories[0]){
		//foreach($categories as $category) {
			$output .= '<a class="post__cat cat-theme" href="'.get_category_link($categories[0]->term_id ).'" title="' . esc_attr( sprintf( __( "查看【%s】类目下所有文章" ), $categories[0]->name ) ) . '" style="color: '.$color.' !important;">'.$categories[0]->cat_name.'</a>'.$separator;
		//}
		echo trim($output, $separator);
	}
}
//自定义分类样式-2
function xintheme_category_colors() {
	$categories = get_the_category();
	$color = get_term_meta($categories[0]->term_id, 'cc_color', true);
	$separator = '';
	$output = '';
	if($categories[0]){
		//foreach($categories as $category) {
			$output .= '<a class="post__cat post__cat--bg cat-theme-bg overlay-item--top-left" href="'.get_category_link($categories[0]->term_id ).'" title="' . esc_attr( sprintf( __( "查看【%s】类目下所有文章" ), $categories[0]->name ) ) . '" style="background: '.$color.' !important;">'.$categories[0]->cat_name.'</a>'.$separator;
		//}
		echo trim($output, $separator);
	}
}
function xintheme_category_colorss() {
	$categories = get_the_category();
	$color = get_term_meta($categories[0]->term_id, 'cc_color', true);
	$separator = '';
	$output = '';
	if($categories[0]){
		//foreach($categories as $category) {
			$output .= '<a class="post__cat post__cat--bg cat-theme-bg" href="'.get_category_link($categories[0]->term_id ).'" title="' . esc_attr( sprintf( __( "查看【%s】类目下所有文章" ), $categories[0]->name ) ) . '" style="background: '.$color.' !important;">'.$categories[0]->cat_name.'</a>'.$separator;
		//}
		echo trim($output, $separator);
	}
}
function xintheme_category_colorsss() {
	$categories = get_the_category();
	$color = get_term_meta($categories[0]->term_id, 'cc_color', true);
	$separator = '';
	$output = '';
	if($categories[0]){
		//foreach($categories as $category) {
			$output .= '<a class="post__cat post__cat--bg post__cat--overlap cat-theme-bg" href="'.get_category_link($categories[0]->term_id ).'" title="' . esc_attr( sprintf( __( "查看【%s】类目下所有文章" ), $categories[0]->name ) ) . '" style="background: '.$color.' !important;">'.$categories[0]->cat_name.'</a>'.$separator;
		//}
		echo trim($output, $separator);
	}
}

//去掉后台Wordpress LOGO
function my_edit_toolbar($wp_toolbar) {
	$wp_toolbar->remove_node('wp-logo'); 
}
add_action('admin_bar_menu', 'my_edit_toolbar', 999);
//后台菜单部分
add_action('admin_menu', function () {
	//后台菜单重命名
	//global $menu;
    //$menu[15][0] = '友链';
	//$menu[60][0] = '主题设置';
	//$menu[80][0] = '设置';
	//屏蔽设置下的媒体菜单
	if( xintheme('xintheme_option_thumbnail') ) :
		remove_submenu_page('options-general.php', 'options-media.php');
	endif;
	//开启所有设置
	if( xintheme('xintheme_all_settings') ) :
		add_options_page('高级设置', '高级设置', 'administrator', 'options.php'); 
	endif;
});

//彻底关闭WordPress生成默认尺寸的缩略图
if( xintheme('xintheme_option_thumbnail') ) :
	add_filter('pre_option_thumbnail_size_w',	'__return_zero');
	add_filter('pre_option_thumbnail_size_h',	'__return_zero');
	add_filter('pre_option_medium_size_w',		'__return_zero');
	add_filter('pre_option_medium_size_h',		'__return_zero');
	add_filter('pre_option_large_size_w',		'__return_zero');
	add_filter('pre_option_large_size_h',		'__return_zero');
endif;
//WordPress替换登陆后跳转的后台默认首页
if( xintheme('xintheme_article') ) :
	function my_login_redirect($redirect_to, $request){
	if( empty( $redirect_to ) || $redirect_to == 'wp-admin/' || $redirect_to == admin_url() )
	return home_url("/wp-admin/edit.php");
	else
	return $redirect_to;
	}
	add_filter("login_redirect", "my_login_redirect", 10, 3);
endif;
//去json*
if( xintheme('xintheme_api') ) :
	add_filter('rest_enabled', '_return_false');
	add_filter('rest_jsonp_enabled', '_return_false');
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	//禁用REST API、移除wp-json链接
	add_filter('rest_enabled', '_return_false');
	add_filter('rest_jsonp_enabled', '_return_false');
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
endif;
//彻底删除后台隐私相关设置
if( xintheme('xintheme_privacy') ) :
add_action('admin_menu', function (){

	global $menu, $submenu;

	unset($submenu['options-general.php'][45]);

	// Bookmark hooks.
	remove_action( 'admin_page_access_denied', 'wp_link_manager_disabled_message' );

	// Privacy tools
	remove_action( 'admin_menu', '_wp_privacy_hook_requests_page' );
	// Privacy hooks
	remove_filter( 'wp_privacy_personal_data_erasure_page', 'wp_privacy_process_personal_data_erasure_page', 10, 5 );
	remove_filter( 'wp_privacy_personal_data_export_page', 'wp_privacy_process_personal_data_export_page', 10, 7 );
	remove_filter( 'wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10 );
	remove_filter( 'wp_privacy_personal_data_erased', '_wp_privacy_send_erasure_fulfillment_notification', 10 );

	// Privacy policy text changes check.
	remove_action( 'admin_init', array( 'WP_Privacy_Policy_Content', 'text_change_check' ), 100 );

	// Show a "postbox" with the text suggestions for a privacy policy.
	remove_action( 'edit_form_after_title', array( 'WP_Privacy_Policy_Content', 'notice' ) );

	// Add the suggested policy text from WordPress.
	remove_action( 'admin_init', array( 'WP_Privacy_Policy_Content', 'add_suggested_content' ), 1 );

	// Update the cached policy info when the policy page is updated.
	remove_action( 'post_updated', array( 'WP_Privacy_Policy_Content', '_policy_page_updated' ) );
},9);
endif;
//禁用日志修订功能
if( xintheme('xintheme_revision') ) :
	add_action('wp_print_scripts',function() {wp_deregister_script('autosave');});
	define('WP_POST_REVISIONS', false);
	remove_action('pre_post_update', 'wp_save_post_revision' );
	// 自动保存设置为10个小时
	define('AUTOSAVE_INTERVAL', 36000 );
endif;
//删除文章时删除图片附件
if( xintheme('xintheme_delete_post_attachments') ) :
function xintheme_delete_post_and_attachments($post_ID) {
    global $wpdb;
    //删除特色图片
    $thumbnails = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_key = '_thumbnail_id' AND post_id = $post_ID" );
    foreach ( $thumbnails as $thumbnail ) {
    wp_delete_attachment( $thumbnail->meta_value, true );
    }
    //删除图片附件
    $attachments = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_parent = $post_ID AND post_type = 'attachment'" );
    foreach ( $attachments as $attachment ) {
    wp_delete_attachment( $attachment->ID, true );
    }
    $wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key = '_thumbnail_id' AND post_id = $post_ID" );
}
add_action('before_delete_post', 'xintheme_delete_post_and_attachments');
endif;
//删除后台外观 编辑选项
function remove_submenu() {   
	// 删除"外观"下面的子菜单"编辑"   
	remove_submenu_page( 'themes.php', 'theme-editor.php' );   
}   

if ( is_admin() ) {   
add_action('admin_init','remove_submenu');   
}
function custom_menu_css() {  
    $custom_menu_css = '<style type="text/css">  
        #wp-admin-bar-custom_menu img { margin:0 0 -4px 0; } /** moves icon over */  
        #wp-admin-bar-custom_menu { width:75px; } /** sets width of custom menu */  
		#wp-admin-bar-custom_menu {width:92px;}
		.wp-first-item.wp-not-current-submenu.wp-menu-separator,.hide-if-no-customize{display: none;}
    </style>';  
    echo $custom_menu_css;  
}  
add_action( 'admin_head', 'custom_menu_css' );
//移除后台标题后缀 - WordPress
add_filter('admin_title', 'xintheme_custom_admin_title', 10, 2);
function xintheme_custom_admin_title($admin_title, $title){
	return $title.' &lsaquo; '.get_bloginfo('name');
}
//上传图片使用日期重命名
if( xintheme('xintheme_upload_img_rename') ) :
	function uazoh_wp_upload_filter($file){  
	$time=date("YmdHis");  
	$file['name'] = $time."".mt_rand(1,100).".".pathinfo($file['name'] , PATHINFO_EXTENSION);  
	return $file;  
	}  
	add_filter('wp_handle_upload_prefilter', 'uazoh_wp_upload_filter'); 
endif;

//用户列表显示昵称
function XinTheme_display_name_column( $columns ) {
    $columns['XinTheme_display_name'] = __('用户昵称', 'XinTheme');
    unset($columns['name']);
    return $columns;
}
add_filter( 'manage_users_columns', 'XinTheme_display_name_column' );

function XinTheme_display_name_column_callback( $value, $column_name, $user_id ) {

    if( 'XinTheme_display_name' == $column_name ){
        $user = get_user_by( 'id', $user_id );
        $value = ( $user->display_name ) ? $user->display_name : '';
    }

    return $value;
}
add_action( 'manage_users_custom_column', 'XinTheme_display_name_column_callback', 10, 3 );

//用户列表显示最近登录时间
function xintheme_latest_login_column( $columns ) {
    $columns['xintheme_latest_login'] = __('最后登录', 'XinTheme');
    return $columns;
}
add_filter( 'manage_users_columns', 'xintheme_latest_login_column' );

function xintheme_latest_login_column_callback( $value, $column_name, $user_id ) {
    if('xintheme_latest_login' == $column_name){
        $value = get_user_meta($user_id, 'xintheme_latest_login', true) ? : __('没有记录','XinTheme');
    }
    return $value;
}
add_action( 'manage_users_custom_column', 'xintheme_latest_login_column_callback', 10, 3 );

//用户列表显示最近登录IP
function xintheme_latest_login_ip_column( $columns ) {
    $columns['xintheme_latest_ip'] = __('登录IP', 'XinTheme');
    return $columns;
}
add_filter( 'manage_users_columns', 'xintheme_latest_login_ip_column' );

function xintheme_latest_login_ip_column_callback( $value, $column_name, $user_id ) {
    if('xintheme_latest_ip' == $column_name){
        $value = get_user_meta($user_id, 'xintheme_latest_ip', true) ? : __('没有记录','XinTheme');
    }
    return $value;
}
add_action( 'manage_users_custom_column', 'xintheme_latest_login_ip_column_callback', 10, 3 );

//禁用古腾堡编辑器
if( xintheme('xintheme_no_gutenberg') ) :
	add_filter('use_block_editor_for_post_type', '__return_false');
endif;

//后台文章列表添加缩略图
if( !defined('WPJAM_BASIC_PLUGIN_FILE') ){
    if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
	    // for post and page
	    function fb_AddThumbColumn($cols) {
	    	$cols['thumbnail'] = __('缩略图');
	    	return $cols;
	    }
	    function fb_AddThumbValue($column_name) {
			if ( 'thumbnail' == $column_name ) {
				echo '<img src="'.post_thumbnail(80, 80).'" height="80" width="80" alt="">';
			}
	    }
	    // for posts
	    add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
	    add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
    }
}