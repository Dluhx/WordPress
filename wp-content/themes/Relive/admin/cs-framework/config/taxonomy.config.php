<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// TAXONOMY OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options     = array();

// -----------------------------------------
// Taxonomy Options                        -
// -----------------------------------------
$options[]   = array(
  'id'       => 'category_options',
  'taxonomy' => 'category', // category, post_tag or your custom taxonomy name
  'fields'   => array(

        array(
            'type'          => 'notice',
            'class'         => 'info',
            'content'       => '选择布局样式',
        ),
    	array(
			'id'    => 'cat_layout',
			'type'  => 'image_select',
			'title' => '布局样式',
		    'options' => array(
				'list'    => get_stylesheet_directory_uri() . '/static/images/admin/archive_list_1.png',
				'grid'    => get_stylesheet_directory_uri() . '/static/images/admin/archive_list_2.png',
				'grid-3'  => get_stylesheet_directory_uri() . '/static/images/admin/archive_list_3.png',
                'grid-4'  => get_stylesheet_directory_uri() . '/static/images/admin/modular_full_28.png',
                'timeaxis'=> get_stylesheet_directory_uri() . '/static/images/admin/archive_list_5.png',
		    ),
		    'default'   => 'list',
    	),

        array(
            'id'      => 'category_switch',
            'type'    => 'switcher',
            'title'   => '文章显示分类目录',
            'default' => true
        ),

        array(
            'type'          => 'notice',
            'class'         => 'info',
            'content'       => '选择 Banner 样式',
        ),
        array(
            'id'    => 'cat_banner',
            'type'  => 'radio',
            'title' => 'Banner 样式',
            'class' => 'horizontal',
            'options'   => array(
                '1'     => '标准',
                '2'     => '背景图像',
            ),
            'default'   => '1',
        ),
        array(
            'id'          => 'cat_banner_img',
            'type'        => 'upload',
            'title'       => '上传图像(电脑端)',
            'after'       => '<p class="cs-text-muted">建议尺寸 1920*300</p>',
            'settings'       => array(
                'button_title' => '上传图像',
                'frame_title'  => '选择图像',
                'insert_title' => '插入图像',
            ),
            'dependency'  => array( 'cat_banner_2', '==', true )
        ),

        array(
            'type'          => 'notice',
            'class'         => 'info',
            'content'       => '自定义SEO设置',
        ),
        array(
            'id'    => 'seo_custom_title',
            'type'  => 'text',
            'title' => '自定义标题',
            'after' => '<div class="cs-text-muted">留空则调用默认全局SEO设置</div>'
        ),
        array(
            'id'    => 'seo_custom_keywords',
            'type'  => 'text',
            'title' => '自定义关键词',
            'after' => '<div class="cs-text-muted">留空则调用默认全局SEO设置</div>'
        ),
        array(
            'id'    => 'seo_custom_desc',
            'type'  => 'textarea',
            'title' => '自定义描述',
			'after' => '<div class="cs-text-muted">留空则调用默认全局SEO设置</div>'
        ),

  ),
);

$options[]   = array(
    'id'       => 'tag_options',
    'taxonomy' => 'post_tag',
    'fields'   => array(

        array(
            'type'          => 'notice',
            'class'         => 'info',
            'content'       => '选择布局样式',
        ),
        array(
            'id'    => 'tag_layout',
            'type'  => 'image_select',
            'title' => '布局样式',
            'options' => array(
                'list'    => get_stylesheet_directory_uri() . '/static/images/admin/archive_list_1.png',
                'grid'    => get_stylesheet_directory_uri() . '/static/images/admin/archive_list_2.png',
                'grid-3'  => get_stylesheet_directory_uri() . '/static/images/admin/archive_list_3.png',
                'grid-4'  => get_stylesheet_directory_uri() . '/static/images/admin/modular_full_28.png',
            ),
            'default'   => 'list',
        ),

        array(
            'type'          => 'notice',
            'class'         => 'info',
            'content'       => '选择 Banner 样式',
        ),
        array(
            'id'    => 'tag_banner',
            'type'  => 'radio',
            'title' => 'Banner 样式',
            'class' => 'horizontal',
            'options'   => array(
                '1'     => '标准',
                '2'     => '背景图像',
            ),
            'default'   => '1',
        ),
        array(
            'id'          => 'tag_banner_img',
            'type'        => 'upload',
            'title'       => '上传图像(电脑端)',
            'after'       => '<p class="cs-text-muted">建议尺寸 1920*300</p>',
            'settings'       => array(
                'button_title' => '上传图像',
                'frame_title'  => '选择图像',
                'insert_title' => '插入图像',
            ),
            'dependency'  => array( 'tag_banner_2', '==', true )
        ),

        array(
            'type'          => 'notice',
            'class'         => 'info',
            'content'       => '自定义SEO设置',
        ),
        array(
            'id'    => 'seo_custom_title',
            'type'  => 'text',
            'title' => '自定义标题',
            'after'   => '<div class="cs-text-muted">留空则调用默认全局SEO设置</div>'
        ),
        array(
            'id'    => 'seo_custom_keywords',
            'type'  => 'text',
            'title' => '自定义关键词',
            'after'   => '<div class="cs-text-muted">留空则调用默认全局SEO设置</div>'
        ),
        array(
            'id'    => 'seo_custom_desc',
            'type'  => 'textarea',
            'title' => '自定义描述',
            'after'   => '<div class="cs-text-muted">留空则调用默认全局SEO设置</div>'
        ),
    ),
);

CSFramework_Taxonomy::instance( $options );
