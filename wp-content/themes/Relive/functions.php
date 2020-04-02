<?php
session_start();
error_reporting(E_ALL^E_NOTICE);
define('THEME_DIR', get_template_directory_uri());
include_once TEMPLATEPATH.'/admin/cs-framework/cs-framework.php';
include_once TEMPLATEPATH.'/public/hooks.php';
include_once TEMPLATEPATH.'/public/utils.php';
include_once TEMPLATEPATH.'/public/widget.php';
include_once TEMPLATEPATH.'/public/xintheme-seo.php';
include_once TEMPLATEPATH.'/public/shortcodes.php';
include_once TEMPLATEPATH.'/public/xintheme-block.php';
include_once TEMPLATEPATH.'/admin/admin.php';
include_once TEMPLATEPATH.'/admin/colorful-categories/colorful-categories.php';
include_once TEMPLATEPATH.'/user/functions/functions.php';

if( xintheme('xintheme_simple_urls') ) :
	include_once TEMPLATEPATH.'/admin/simple-urls/simple-urls.php';
endif;
if( xintheme('xintheme_wp-clean-up') ) :
	include_once TEMPLATEPATH.'/admin/wp-clean-up/wp-clean-up.php';
endif;
if( xintheme('xintheme_sitemap') ) :
	include_once TEMPLATEPATH.'/admin/Sitemap/sitemap.php';
endif;

register_nav_menus(['main'	=> '主菜单','footer'	=> '页脚菜单']);

add_theme_support('post-thumbnails');

add_theme_support('post-formats',array( 'image','gallery','video' ) );
function rename_post_formats( $safe_text ) {
if ( $safe_text == '图像' )
return '大图';
return $safe_text;
}
add_filter( 'esc_html', 'rename_post_formats' );

add_filter( 'pre_option_link_manager_enabled', '__return_true' );

function xintheme_img ($id,$default){
    $cs_id= xintheme($id);
    if (!empty($cs_id )){
        $id_url= wp_get_attachment_image_src( $cs_id, 'full' );
        return $id_url[0];
    }
    elseif (empty($cs_id )){
        return $default;
    }
}