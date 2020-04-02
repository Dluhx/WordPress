<?php if ( ! defined( 'ABSPATH' ) ) { die; } // 无法直接访问页面
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// 主题设置
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
  'menu_title'      => '主题设置',
  'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'xintheme',
  'menu_position'   => 100,//59
  'ajax_save'       => true,
  'show_reset_all'  => false,
  'menu_icon'		=> 'dashicons-hammer',
  'framework_title' => ''.wp_get_theme().' <small>&nbsp;&nbsp;v '. wp_get_theme()->get( 'Version' ).' 版本</small><style>.cs-framework .cs-body {min-height: 700px;}#qt_head_code_toolbar,#qt_foot_code_toolbar,#qt_single_copyright_toolbar,#qt_footer_copyright_toolbar,#qt_full_ad_code_pc_toolbar,#qt_full_ad_code_mobile_toolbar,#qt_list_ad_code_pc_toolbar,#qt_list_ad_code_mobile_toolbar {display: none;}.icon-quanjushezhi{font-size: 18px !important}.icon-mobile{font-size: 16px !important}</style>',
);

//获取链接分类目录
$options_linkcats = array();
$options_linkcats_obj = get_terms('link_category');
foreach ( $options_linkcats_obj as $tag ) {
	$options_linkcats[$tag->term_id] = $tag->name;
}
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// 主题选项
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// 全局设置
// ----------------------------------------
$options[]      = array(
  'name'        => 'other-settings',
  'title'       => '全局设置',
  'icon'        => 'iconfont icon-quanjushezhi',

  'fields' => array(

		array(
			'id'      => 'full_background_white',
			'type'    => 'switcher',
			'title'   => '全站模块增加白底效果',
			'desc'    => '此功能对个别模块无效（如首页全宽幻灯片模块之类）',
			'default' => true
		),
		array(
			'id'      => 'img_border_radius',
			'type'    => 'switcher',
			'title'   => '全站图片增加圆角',
			'default' => false
		),
		array(
			'id'      => 'title_hover_color',
			'type'    => 'color_picker',
			'title'   => '文章标题 Hover 颜色',
			'default' => '#ee5b2e',
		),
		array(
			'id'	  => 'xintheme_post_meta_comment',
			'type'	  => 'switcher',
			'title'	  => '文章列表显示评论量',
			'desc'    => '部分模块本就不显示评论量，此处开启也不会显示',
			'default' => true
		),
		array(
			'id'	  => 'xintheme_post_meta_views',
			'type'	  => 'switcher',
			'title'	  => '文章列表显示浏览量',
			'desc'    => '部分模块本就不显示浏览量，此处开启也不会显示',
			'default' => true
		),
		array(
			'id'      => 'relive_all_blank',
			'type'    => 'switcher',
			'title'   => '所有页面新窗口打开',
			'default' => false
		),
		array(
			'id'      => 'relive_false_f12',
			'type'    => 'switcher',
			'title'   => '禁用复制粘贴以及F12',
			'default' => false
		),
		array(
			'id'      => 'all_img_fancybox',
			'type'    => 'switcher',
			'title'   => '所有文章内图像，自动连接到媒体文件，点击弹窗显示',
			'default' => false
		),

  ),

);

// ----------------------------------------
// 手机端设置
// ----------------------------------------
$options[]      = array(
  'name'        => 'mobile-settings',
  'title'       => '手机端设置',
  'icon'        => 'iconfont icon-mobile',

  'fields' => array(

		array(
			'id'      => 'mobile_no_sidebar',
			'type'    => 'switcher',
			'title'   => '手机端隐藏网站侧栏内容',
			'default' => false
		),
		array(
			'id'      => 'mobile_menu_post',
			'type'    => 'switcher',
			'title'   => '手机端，菜单底部显示5篇最新文章',
			'default' => true
		),
		array(
			'id'      => 'mobile_foot_menu_sw',
			'type'    => 'switcher',
			'title'   => '手机端底部菜单',
			'default' => false
		),
		array(
		  	'id'              => 'add_mobile_foot_menu',
		  	'type'            => 'group',
		  	'title'           => '手机端底部菜单设置',
		  	'button_title'    => '添加手机端底部菜单',
		 	'accordion_title' => '添加手机端底部菜单',
		 	'fields'          => array(
				array(
					'id'			=> 'mobile_foot_menu_type',
					'type'			=> 'radio',
					'title'			=> '菜单类型',
					'class'			=> 'horizontal',
					'options'		=> array(
						'link'		=> '跳转链接',
						'img'		=> '弹出图像',
						'user'		=> '登陆/用户中心',
					),
					'default'		=> 'link',
				),
				array(
					'id'			=> 'mobile_foot_menu_text',
					'type'			=> 'text',
					'title'			=> '菜单名称',
					'dependency'	=> array( 'mobile_foot_menu_type_user', '==', false )
				),
		        array(
		        	'id'			=> 'mobile_foot_menu_icon',
		        	'type'			=> 'icon',
		        	'title'			=> '选择菜单图标',
		        	'dependency'	=> array( 'mobile_foot_menu_type_user', '==', false )
		        ),
				array(
					'id'			=> 'mobile_foot_menu_img',
				  	'type'        	=> 'upload',
				  	'title'      	=> '上传图像',
				  	'after'			=> '<p class="cs-text-muted">建议尺寸 200*200</p>',
				  	'settings'      => array(
						'button_title' => '上传图像',
						'frame_title'  => '选择图像',
						'insert_title' => '插入图像',
				  	),
				  	'dependency'	=> array( 'mobile_foot_menu_type_img', '==', true )
				),
				array(
					'id'			=> 'mobile_foot_menu_img_text',
					'type'			=> 'text',
					'title'			=> '图像标题',
					'dependency'	=> array( 'mobile_foot_menu_type_img', '==', true )
				),
				array(
					'id'			=> 'mobile_foot_menu_url',
					'type'			=> 'text',
					'title'			=> '跳转链接',
					'after'			=> '<p class="cs-text-muted">不要忘记了“http(s)://”</p>',
					'attributes'	=> array('style'=> 'width: 100%;'),
					'dependency'	=> array( 'mobile_foot_menu_type_link', '==', true )
				),

		  ),
		  'dependency'	=> array( 'mobile_foot_menu_sw', '==', true )
		),

  ),

);

// ----------------------------------------
// 网站图标
// ----------------------------------------
$options[]      = array(
  'name'        => 'logo',
  'title'       => '网站图标',
  'icon'        => 'iconfont icon-tuxiang',

  'fields'      => array(

  	array(
		'id'        => 'logo',
		'type'      => 'image',
		'title'     => '网站 LOGO',
		'desc'      => '上传网站 LOGO （ 130*24 或同比例放大 ）',
		'add_title' => '上传 LOGO',
	),
	
  	array(
		'id'        => 'mobile_menu_logo',
		'type'      => 'image',
		'title'     => '手机端菜单栏 LOGO',
		'desc'      => '上传网站，显示在手机端弹出层菜单栏顶部。 （ 130*24 或同比例放大 ）',
		'add_title' => '上传 LOGO',
	),

	array(
		'id'        => 'favicon',
		'type'      => 'image',
		'title'     => '网站 Favicon图标',
		'desc'      => '上传网站 Favicon图标（ 建议尺寸：32*32 ）',
		'add_title' => '上传 Favicon',
	),

    array(
		'id'          => 'timthumb',
		'type'        => 'gallery',
		'title'       => '默认缩略图',
		'after'    	  => '<p class="cs-text-muted">（请在下面的选项中填写你上传了几张默认缩略图）如果有设置特色图像将优先显示特色图像，没有特色图像则显示文章内第一张图片，文章内没有图片才显示此处设置的图像</p>',
		'add_title'   => '添加默认缩略图',
		'edit_title'  => '编辑默认缩略图',
		'clear_title' => '全部删除',
    ),
	
	/*
    array(
		'id'      => 'timthumb_num',
		'type'    => 'number',
		'title'   => '你上传了几张默认缩略图？',
		'after'   => ' <i class="cs-text-muted">张图像随机显示</i>',
		'default' => '1',
    ),
    */

  ),

);

// ------------------------------
// 用户中心
// ------------------------------
$options[]   = array(
  'name'     => 'user_center',
  'title'    => '用户中心',
  'icon'     => 'iconfont icon-denglu',
  'sections' => array(

    // sub section 1
    array(
		'name'     => 'open_ucenter',
		'title'    => '用户中心设置',
		'icon'     => '',
		'fields'   => array(

			array(
				'id'      => 'open_ucenter',
				'type'    => 'switcher',
				'title'   => '开启个人中心',
				'default' => false
			),
			array(
				'id'      => 'tougao',
				'type'    => 'switcher',
				'title'   => '开启投稿',
				'default' => true,
				'dependency'   => array( 'open_ucenter', '==', true )
			),
			array(
				'id'		=> 'tougao_describe',
				'type'		=> 'wysiwyg',
				'title'		=> '自定义投稿页面提示语',
				'after'		=> '<p class="cs-text-muted">如：请不要发布垃圾文章，如有发现，封号处理...</p>',
				'settings'	=> array(
					'textarea_rows' => 5,
					'tinymce'       => false,
					'media_buttons' => false,
				),
				'dependency'   => array( 'tougao', '==', true )
			),
		    array(
				'id'      => 'tougao_tnumber',
				'type'    => 'number',
				'title'   => '限制投稿最少输入多少个字',
				'after'   => ' <i class="cs-text-muted">个字符</i>',
				'default' => '140',
				'dependency'   => array( 'tougao', '==', true )
		    ),
			array(
				'id'      => 'uesr_no_wpadmin',
				'type'    => 'switcher',
				'title'   => '禁止除管理员外的所有用户进入后台',
				'default' => false
			),
	        array(
				'id'             => 'xintheme_open_role',
				'type'           => 'select',
				'title'          => '新注册用户角色',
				'options'        => array(
					'subscriber'	=> '订阅者',
					'contributor'	=> '投稿者',
					'author'		=> '作者',
					'editor'		=>'编辑',
				),
				'default'        => 'author',
	        ),

		)
    ),

    // sub section 2
    array(
		'name'     => 'social_login',
		'title'    => '社会化登录设置',
		'icon'     => '',
		'fields'   => array(

		array(
			'id'      => 'xintheme_open_qq',
			'type'    => 'switcher',
			'title'   => 'QQ快速登录',
			'default' => false
		),
        array(
            'id'		   => 'xintheme_open_qq_id',
            'type'		   => 'text',
            'title'		   => 'QQ开放平台ID',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'   => array( 'xintheme_open_qq', '==', true )
        ),
        array(
            'id'		   => 'xintheme_open_qq_key',
            'type'		   => 'text',
            'title'		   => 'QQ开放平台KEY',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'   => array( 'xintheme_open_qq', '==', true )
        ),
		
		array(
			'id'      => 'xintheme_open_weibo',
			'type'    => 'switcher',
			'title'   => '微博快速登录',
			'default' => false
		),
        array(
            'id'		   => 'xintheme_open_weibo_key',
            'type'		   => 'text',
            'title'		   => '微博开放平台KEY',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'   => array( 'xintheme_open_weibo', '==', true )
        ),
        array(
            'id'		   => 'xintheme_open_weibo_secret',
            'type'		   => 'text',
            'title'		   => '微博开放平台SECRET',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'   => array( 'xintheme_open_weibo', '==', true )
        ),
/* 		array(
			'id'      => 'xintheme_open_weixin',
			'type'    => 'switcher',
			'title'   => '微信快速登录',
			'default' => false
		), */

      )
    ),
    // sub section 3
    array(
		'name'     => 'user_cover',
		'title'    => '自定义封面图像',
		'icon'     => '',
		'fields'   => array(

		array(
			'id'			=> 'default_user_cover_img',
			'type'			=> 'upload',
			'title'			=> '默认用户封面图像',
			'desc'			=> '建议尺寸：1000*265 px',
			'settings'		=> array(
				'button_title' => '上传图像',
				'frame_title'  => '选择图像',
				'insert_title' => '插入图像',
			),
        ),
		
        array(
			'id'			  => 'user_cover',
			'type'            => 'group',
			'title'           => '用户中心自定义封面设置',
			'button_title'    => '添加封面图像',
			'accordion_title' => '添加封面图像',
			'desc'			  => '建议尺寸：1000*265 px',
			'fields'          => array(
			
				array(
					'id'		=> 'user_cover_img',
					'type'		=> 'upload',
					'title'		=> '上传图像',
					'settings'	=> array(
						'button_title' => '上传图像',
						'frame_title'  => '选择图像',
						'insert_title' => '插入图像',
					),
				),
			)
        ),

      )
    ),

  ),
);

// ----------------------------------------
// 头部样式
// ----------------------------------------
$options[]      = array(
  'name'        => 'header_setting',
  'title'       => '头部样式',
  'icon'        => 'iconfont icon-yemei',

  'fields'    => array(

	array(
	  'id'        => 'header_style',
	  'type'      => 'image_select',
	  'title'     => '选择头部样式',
	  'options'   => array(
		'1' => get_stylesheet_directory_uri() . '/static/images/admin/header-1.png',
		'2' => get_stylesheet_directory_uri() . '/static/images/admin/header-2.png',
	  ),
	  'default'    => '1',
	),
	
    array(
      'id'		=> 'header_style_1_width',
      'type'    => 'radio',
      'title'   => '导航栏宽度',
      'class'   => 'horizontal',
      'options' => array(
        'full'  	=> '全宽',
        'middle'	=> '居中',
      ),
	  'default'    => 'full',
	  'dependency'	=> array( 'header_style_1', '==', true )
    ),
		
    array(
      'id'		=> 'header_style_1_position',
      'type'    => 'radio',
      'title'   => '菜单位置',
      'class'   => 'horizontal',
      'options' => array(
        'left'  	=> '靠左',
        'right'	=> '靠右',
      ),
	  'default'    => 'right',
	  'dependency'	=> array( 'header_style_1', '==', true )
    ),
	
    array(
      'id'      => 'header_style_1_color',
      'type'    => 'color_picker',
      'title'   => '导航栏背景色',
      'default' => '#1B1D1C',
    ),
    array(
      'id'      => 'header_style_1_color_2',
      'type'    => 'color_picker',
      'title'   => '导航栏背景色-2',
      'default' => '#1B1D1C',
    ),
	
    array(
      'id'      => 'header_menu_color',
      'type'    => 'color_picker',
      'title'   => '导航栏字体颜色',
      'default' => '#fff',
    ),
    array(
      'id'      => 'current_menu_color',
      'type'    => 'color_picker',
      'title'   => '菜单选中时颜色',
      'default' => '#FC3C2D',
    ),

	array(
      'id'    => 'header_contribute',
      'type'  => 'switcher',
      'title' => '导航栏显示投稿按钮',
    ),
	array(
      'id'    => 'header_sticky',
      'type'  => 'switcher',
      'title' => '导航栏一直固定显示在顶部',
    ),
	
  ),

);

// ----------------------------------------
// 首页模块
// ----------------------------------------
$options[]      = array(
  'name'        => 'modular',
  'title'       => '首页模块',
  'icon'        => 'iconfont icon-mokuai',

  'fields'    => array(

	array(
		'id'		=> 'banner_switcher',
		'type'		=> 'switcher',
		'title'		=> '开启首页幻灯片模块',
		'default'	=> false
	),
	array(
	  'id'              => 'banner',
	  'type'            => 'group',
	  'title'           => '首页幻灯片设置',
	  'button_title'    => '添加幻灯片',
	  'accordion_title' => '添加幻灯片',
	  'fields'          => array(
		array(
		  'id'          => 'banner_img',
		  'type'        => 'upload',
		  'title'       => '上传图像(电脑端)',
		  'after'		=> '<p class="cs-text-muted">建议尺寸 1920*700</p>',
		  'settings'       => array(
			'button_title' => '上传图像(电脑端)',
			'frame_title'  => '选择图像(电脑端)',
			'insert_title' => '插入图像(电脑端)',
		  ),
		),
		array(
		  'id'          => 'banner_img_mobile',
		  'type'        => 'upload',
		  'title'       => '上传图像(手机端)',
		  'after'		=> '<p class="cs-text-muted">建议尺寸 750*580，不上传则默认显示电脑端的图像</p>',
		  'settings'       => array(
			'button_title' => '上传图像(手机端)',
			'frame_title'  => '选择图像(手机端)',
			'insert_title' => '插入图像(手机端)',
		  ),
		),
		array(
		  'id'      => 'banner_url',
		  'type'    => 'text',
		  'title'   => '跳转链接',
		  'attributes'   => array('style'=> 'width: 100%;'),
		),
		array(
		  'id'      => 'banner_alt',
		  'type'    => 'text',
		  'title'   => '图像描述',
		),
		array(
		  'id'      => 'banner_blank',
		  'type'    => 'switcher',
		  'title'   => '新窗口打开',
		  'default' => false
		),
		array(
		  'id'      => 'banner_nofollow',
		  'type'    => 'switcher',
		  'title'   => 'Nofollow',
		  'default' => false
		),
	  ),
	  'dependency'	=> array( 'banner_switcher', '==', true )
	),

    //全宽模块
	array(
		'id'			=> 'modular_full',
		'type'			=> 'group',
		'title'			=> '全宽模块',
		'button_title'	=> '添加模块',
		'accordion_title' => '添加模块',
		'fields'		=> array(

        array(
            'id'		=> 'modular_title_full',
            'type'		=> 'text',
            'title'		=> '模块标题',
			'desc'		=> '不填写则不显示（部分模块不显示标题）',
        ),
		array(
			'id'		=> 'modular_full_mobile',
			'type'		=> 'switcher',
			'title'		=> '禁止手机端显示此模块',
			'after'		=> '<p class="cs-text-muted"><br><br>开启后手机端浏览将不显示这个模块</p>',
			'default'	=> false
		),
		
		array(
			'id'			=> 'modular_type_full',
			'type'			=> 'radio',
			'title'			=> '调用内容',
			'class'			=> 'horizontal',
			'options'		=> array(
				'stick'			=> '置顶文章',
				'random'		=> '随机文章',
				'newest'		=> '最新文章',
				'category'		=> '指定分类文章',
				'tags'			=> '指定标签文章',
				'see'			=> '最多浏览文章',
				'comment'		=> '最多评论文章',
				'countdown'		=> '倒计时',
				'full_ad'		=> '广告模块',
			),
			'default'		=> 'stick',
		),
		
		array(
			'id'			=> 'modular_style_full_stick',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'	=> array(
				'1' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_1.png',
				'2' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_2.png',
				'3' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_3.png',
				'4' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_4.png',
				'5' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_5.png',
				'6' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_6.png',
				'7' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_7.png',
				'8' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_8.png',
				'9' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_9.png',
				'10' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_10.png',
				'11' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_11.png',
				'12' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_12.png',
				'13' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_13.png',
				'14' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_14.png',
				'15' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_15.png',
				//16、17，暂时隐藏，后续版本美化
				//'16' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_16.png',
				//'17' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_17.png',
				'18' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_18.png',
				'19' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_19.png',
				//'20' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_20.png',
				//'21' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_21.png',
				'22' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_22.png',
				'23' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_23.png',
				//'24' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_24.png',
				'25' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_25.png',
				'26' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_26.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_full_stick', '==', true )
		),
		
		array(
			'id'			=> 'modular_style_full_random',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'	=> array(
				'1' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_1.png',
				'2' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_2.png',
				'3' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_3.png',
				'4' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_4.png',
				'5' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_5.png',
				'6' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_6.png',
				'7' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_7.png',
				'8' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_8.png',
				'9' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_9.png',
				'10' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_10.png',
				'11' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_11.png',
				'12' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_12.png',
				'13' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_13.png',
				'14' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_14.png',
				'15' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_15.png',
				//16、17，暂时隐藏，后续版本美化
				//'16' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_16.png',
				//'17' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_17.png',
				'18' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_18.png',
				'19' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_19.png',
				//'20' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_20.png',
				//'21' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_21.png',
				'22' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_22.png',
				'23' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_23.png',
				//'24' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_24.png',
				'25' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_25.png',
				'26' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_26.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_full_random', '==', true )
		),
		
		array(
			'id'			=> 'modular_style_full_newest',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'	=> array(
				'1' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_1.png',
				'2' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_2.png',
				'3' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_3.png',
				'4' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_4.png',
				'5' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_5.png',
				'6' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_6.png',
				'7' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_7.png',
				'8' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_8.png',
				'9' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_9.png',
				'10' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_10.png',
				'11' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_11.png',
				'12' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_12.png',
				'13' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_13.png',
				'14' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_14.png',
				'15' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_15.png',
				//16、17，暂时隐藏，后续版本美化
				//'16' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_16.png',
				//'17' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_17.png',
				'18' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_18.png',
				'19' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_19.png',
				//'20' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_20.png',
				//'21' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_21.png',
				'22' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_22.png',
				'23' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_23.png',
				//'24' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_24.png',
				'25' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_25.png',
				'27' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_27.png',
				'28' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_28.png',
				'26' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_26.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_full_newest', '==', true )
		),
		
		array(
			'id'			=> 'modular_style_full_category',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'	=> array(
				'1' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_1.png',
				'2' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_2.png',
				'3' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_3.png',
				'4' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_4.png',
				'5' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_5.png',
				'6' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_6.png',
				'7' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_7.png',
				'8' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_8.png',
				'9' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_9.png',
				'10' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_10.png',
				'11' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_11.png',
				'12' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_12.png',
				'13' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_13.png',
				'14' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_14.png',
				'15' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_15.png',
				//16、17，暂时隐藏，后续版本美化
				//'16' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_16.png',
				//'17' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_17.png',
				'18' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_18.png',
				'19' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_19.png',
				'20' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_20.png',
				'21' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_21.png',
				'22' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_22.png',
				'23' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_23.png',
				'24' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_24.png',
				'25' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_25.png',
				'26' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_26.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_full_category', '==', true )
		),
		
		array(
			'id'			=> 'modular_style_full_tags',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'	=> array(
				'1' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_1.png',
				'2' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_2.png',
				'3' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_3.png',
				'4' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_4.png',
				'5' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_5.png',
				'6' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_6.png',
				'7' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_7.png',
				'8' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_8.png',
				'9' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_9.png',
				'10' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_10.png',
				'11' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_11.png',
				'12' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_12.png',
				'13' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_13.png',
				'14' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_14.png',
				'15' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_15.png',
				//16、17，暂时隐藏，后续版本美化
				//'16' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_16.png',
				//'17' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_17.png',
				'18' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_18.png',
				'19' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_19.png',
				'20' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_20.png',
				'21' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_21.png',
				'22' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_22.png',
				'23' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_23.png',
				'24' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_24.png',
				'25' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_25.png',
				'26' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_26.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_full_tags', '==', true )
		),
		
		array(
			'id'			=> 'modular_style_full_see',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'	=> array(
				'1' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_1.png',
				'2' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_2.png',
				'3' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_3.png',
				'4' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_4.png',
				'5' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_5.png',
				'6' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_6.png',
				'7' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_7.png',
				'8' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_8.png',
				'9' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_9.png',
				'10' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_10.png',
				'11' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_11.png',
				'12' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_12.png',
				'13' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_13.png',
				'14' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_14.png',
				'15' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_15.png',
				//16、17，暂时隐藏，后续版本美化
				//'16' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_16.png',
				//'17' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_17.png',
				'18' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_18.png',
				'19' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_19.png',
				//'20' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_20.png',
				//'21' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_21.png',
				'22' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_22.png',
				'23' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_23.png',
				//'24' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_24.png',
				'25' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_25.png',
				'26' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_26.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_full_see', '==', true )
		),
		
		array(
			'id'			=> 'modular_style_full_comment',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'	=> array(
				'1' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_1.png',
				'2' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_2.png',
				'3' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_3.png',
				'4' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_4.png',
				'5' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_5.png',
				'6' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_6.png',
				'7' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_7.png',
				'8' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_8.png',
				'9' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_9.png',
				'10' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_10.png',
				'11' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_11.png',
				'12' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_12.png',
				'13' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_13.png',
				'14' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_14.png',
				'15' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_15.png',
				//16、17，暂时隐藏，后续版本美化
				//'16' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_16.png',
				//'17' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_17.png',
				'18' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_18.png',
				'19' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_19.png',
				//'20' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_20.png',
				//'21' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_21.png',
				'22' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_22.png',
				'23' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_23.png',
				//'24' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_24.png',
				'25' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_25.png',
				'26' 	=> get_stylesheet_directory_uri() . '/static/images/admin/modular_full_26.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_full_comment', '==', true )
		),
		
		//倒计时模块
		array(
			'id'			=> 'countdown_color_1',
			'type'			=> 'color_picker',
			'title'			=> '模块背景颜色-1',
			'default'		=> '#191654',
			'dependency'	=> array( 'modular_type_full_countdown', '==', true ),
		),
		array(
			'id'			=> 'countdown_color_2',
			'type'			=> 'color_picker',
			'title'			=> '模块背景颜色-2',
			'default'		=> '#43C6AC',
			'dependency'	=> array( 'modular_type_full_countdown', '==', true ),
		),
		array(
			'id'			=> 'countdown_time',
			'type'			=> 'text',
			'title'			=> '结束日期',
			'after'			=> '<p class="cs-text-muted">日期格式：2018-10-01（或者：2018-10-01 18:00:00，注意不要使用：24:00:00）</p>',
			'dependency'	=> array( 'modular_type_full_countdown', '==', true )
		),
		array(
			'id'			=> 'countdown_time_none',
			'type'			=> 'switcher',
			'title'			=> '倒计时结束后 不再显示此模块',
			'after'			=> '<p class="cs-text-muted"><br><br>开启这个选项后，倒计时结束后网站首页将不再显示这个模块</p>',
			'default'		=> false,
          	'dependency'	=> array( 'modular_type_full_countdown', '==', true )
		),
		
		array(
			'id'			=> 'countdown_describe',
			'type'			=> 'text',
			'title'			=> '活动描述',
			'attributes'	=> array('style' => 'width: 100%;'),
			'dependency'	=> array( 'modular_type_full_countdown', '==', true )
		),
			
        array(
            'id'			=> 'countdown_button_text',
            'type'			=> 'text',
            'title'			=> '按钮文字',
            'default'		=> '查看详情',
			'dependency'	=> array( 'modular_type_full_countdown', '==', true ),
        ),
        array(
            'id'			=> 'countdown_button_url',
            'type'			=> 'text',
            'title'			=> '按钮跳转链接',
			'dependency'	=> array( 'modular_type_full_countdown', '==', true ),
        ),
		array(
			'id'			=> 'countdown_button_color',
			'type'			=> 'color_picker',
			'title'			=> '按钮颜色',
			'default'		=> '#FC3C2D',
			'dependency'	=> array( 'modular_type_full_countdown', '==', true ),
		),
        //倒计时模块结束

		array(
			'id'			=> 'modular_cat_full',
			'type'			=> 'checkbox',
			'title'			=> '选择分类',
			'class'			=> 'horizontal',
			'options'		=> 'categories',
			'after'			=> '<div class="cs-text-muted">如果勾选多个分类，就会显示多个相同样式的模块，但调用的分类不同</div>',
			'dependency'	=> array( 'modular_type_full_category', '==', true )
		),
		
		array(
			'id'			=> 'modular_tags_full',
			'type'			=> 'text',
			'title'			=> '输入标签ID',
			'after'			=> '<div class="cs-text-muted">如果添加多个标签ID，请使用英文逗号隔开（不会查看标签id ？<a href="https://wpmes.cn/relive-documentation#c51" target="_blank">点击查看</a>）</div>',
			'dependency'	=> array( 'modular_type_full_tags', '==', true )
		),
		
		/*array(
			'id'			=> 'modular_number_full',
			'type'			=> 'number',
			'title'			=> '显示篇数',
			'dependency'	=> array( 'modular_style_full_category_25', '==', true ),
		),*/
		
		array(
			'id'			=> 'full_newest_exclude_category',
			'type'			=> 'checkbox',
			'title'			=> '排除指定分类下的文章',
			'class'			=> 'horizontal',
			'options'		=> 'categories',
			'after'			=> '<div class="cs-text-muted">最新文章中排除此处勾选的分类文章</div>',
			'dependency'	=> array( 'modular_type_full_newest', '==', true )
		),
		
		//广告模块
        array(
            'type'			=> 'notice',
            'class'			=> 'warning',
            'content'		=> '以下是图片广告设置选项（图片广告和联盟广告填写一项即可）',
			'dependency'	=> array( 'modular_type_full_full_ad', '==', true )
        ),
		array(
			'id'			=> 'full_ad_url',
			'type'			=> 'text',
			'title'			=> '图片广告-跳转链接',
			'attributes'	=> array(
            'style'			=> 'width: 50%;'
			),
			'dependency'	=> array( 'modular_type_full_full_ad', '==', 'true' ),
		),
        array(
			'id'			=> 'full_ad_img_pc',
			'type'			=> 'upload',
			'title'			=> '上传广告图(电脑端)',
			'desc'			=> '建议尺寸：810*100',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'modular_type_full_full_ad', '==', 'true' ),
        ),
        array(
			'id'			=> 'full_ad_img_mobile',
			'type'			=> 'upload',
			'title'			=> '上传广告图(移动端)',
			'desc'			=> '建议尺寸：760*130',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'modular_type_full_full_ad', '==', 'true' ),
        ),
        array(
            'type'			=> 'notice',
            'class'			=> 'warning',
            'content'		=> '如果需要投放联盟广告，请在下面贴入广告代码（图片广告和联盟广告填写一项即可）',
			'dependency'	=> array( 'modular_type_full_full_ad', '==', true )
        ),
		array(
			'id'			=> 'full_ad_code_pc',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(电脑端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows'	=> 5,
				'tinymce'		=> false,
				'media_buttons'	=> false,
			),
			'dependency'	=> array( 'modular_type_full_full_ad', '==', 'true' ),
		),
		array(
			'id'			=> 'full_ad_code_mobile',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(移动端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows'	=> 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'	=> array( 'modular_type_full_full_ad', '==', 'true' ),
		),
		//广告模块结束

		//文章信息
		/*
		array(
			'id'			=> 'xintheme_post_meta_author',
			'type'			=> 'switcher',
			'title'			=> '显示文章作者',
			'default'		=> true,
			'dependency'	=> array( 'modular_type_full_stick', '==', true )
		),
		array(
			'id'			=> 'xintheme_post_meta_time',
			'type'			=> 'switcher',
			'title'			=> '显示文章发布时间',
			'default'		=> true,
			'dependency'	=> array( 'modular_type_full_stick', '==', true )
		),
		*/
		//文章信息结束
		
		//自定义模块背景颜色--------------------------------------------------------------------------------------
		array(
			'id'			=> 'color_stick_1',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-1',
			'default'		=> '#000',
			'after'			=> '<p class="cs-text-muted">只有第 5、9、11、17、21 个模块支持自定义背景颜色，同时设置两种颜色将启用渐变效果</p>',
			'dependency'	=> array( 'modular_type_full_stick', '==', true )
		),
		array(
			'id'			=> 'color_stick_2',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-2',
			'default'		=> '#000',
			'dependency'	=> array( 'modular_type_full_stick', '==', true ),
		),

		//-----------------------------------------------------------------------------------------------------------

		array(
			'id'			=> 'color_random_1',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-1',
			'default'		=> '#000',
			'after'			=> '<p class="cs-text-muted">只有第 5、9、11、17、21 个模块支持自定义背景颜色，同时设置两种颜色将启用渐变效果</p>',
			'dependency'	=> array( 'modular_type_full_random', '==', true )
		),
		array(
			'id'			=> 'color_random_2',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-2',
			'default'		=> '#000',
			'dependency'	=> array( 'modular_type_full_random', '==', true ),
		),

		//-----------------------------------------------------------------------------------------------------------

		array(
			'id'			=> 'color_newest_1',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-1',
			'default'		=> '#000',
			'after'			=> '<p class="cs-text-muted">只有第 5、9、11、17、21 个模块支持自定义背景颜色，同时设置两种颜色将启用渐变效果</p>',
			'dependency'	=> array( 'modular_type_full_newest', '==', true )
		),
		array(
			'id'			=> 'color_newest_2',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-2',
			'default'		=> '#000',
			'dependency'	=> array( 'modular_type_full_newest', '==', true ),
		),

		//-----------------------------------------------------------------------------------------------------------

		array(
			'id'			=> 'color_category_1',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-1',
			'default'		=> '#000',
			'after'			=> '<p class="cs-text-muted">只有第 5、9、11、17、24 个模块支持自定义背景颜色，同时设置两种颜色将启用渐变效果</p>',
			'dependency'	=> array( 'modular_type_full_category', '==', true )
		),
		array(
			'id'			=> 'color_category_2',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-2',
			'default'		=> '#000',
			'dependency'	=> array( 'modular_type_full_category', '==', true ),
		),

		//-----------------------------------------------------------------------------------------------------------

		array(
			'id'			=> 'color_tags_1',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-1',
			'default'		=> '#000',
			'after'			=> '<p class="cs-text-muted">只有第 5、9、11、17、24 个模块支持自定义背景颜色，同时设置两种颜色将启用渐变效果</p>',
			'dependency'	=> array( 'modular_type_full_tags', '==', true )
		),
		array(
			'id'			=> 'color_tags_2',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-2',
			'default'		=> '#000',
			'dependency'	=> array( 'modular_type_full_tags', '==', true ),
		),

		//-----------------------------------------------------------------------------------------------------------

		array(
			'id'			=> 'color_see_1',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-1',
			'default'		=> '#000',
			'after'			=> '<p class="cs-text-muted">只有第 5、9、11、17、21 个模块支持自定义背景颜色，同时设置两种颜色将启用渐变效果</p>',
			'dependency'	=> array( 'modular_type_full_see', '==', true )
		),
		array(
			'id'			=> 'color_see_2',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-2',
			'default'		=> '#000',
			'dependency'	=> array( 'modular_type_full_see', '==', true ),
		),

		//-----------------------------------------------------------------------------------------------------------

		array(
			'id'			=> 'color_comment_1',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-1',
			'default'		=> '#000',
			'after'			=> '<p class="cs-text-muted">只有第 5、9、11、17、21 个模块支持自定义背景颜色，同时设置两种颜色将启用渐变效果</p>',
			'dependency'	=> array( 'modular_type_full_comment', '==', true )
		),
		array(
			'id'			=> 'color_comment_2',
			'type'			=> 'color_picker',
			'title'			=> '背景颜色-2',
			'default'		=> '#000',
			'dependency'	=> array( 'modular_type_full_comment', '==', true ),
		),


		//自定义模块背景颜色 结束--------------------------------------------------------------------------------------
		
      ),

    ),
	//全宽模块结束

	//列表内模块
    array(
		'id'				=> 'modular_list',
		'type'				=> 'group',
		'title'				=> '列表内模块',
		'button_title'		=> '添加模块',
		'accordion_title' 	=> '添加模块',
		'fields'			=> array(

        array(
            'id'			=> 'modular_title_list',
            'type'			=> 'text',
            'title'			=> '模块标题',
			'desc'			=> '不填写则不显示（部分模块不显示标题）',
        ),
		array(
			'id'			=> 'modular_list_mobile',
			'type'			=> 'switcher',
			'title'			=> '禁止手机端显示此模块',
			'after'			=> '<p class="cs-text-muted"><br><br>开启后手机端浏览将不显示这个模块</p>',
			'default'		=> false
		),

		array(
			'id'			=> 'modular_type_list',
			'type'			=> 'radio',
			'title'			=> '调用内容',
			'class'			=> 'horizontal',
			'options'		=> array(
				'stick'			=> '置顶文章',
				'random'		=> '随机文章',
				'newest'		=> '最新文章',
				'category'		=> '指定分类文章',
				'tags'			=> '指定标签文章',
				'see'			=> '最多浏览文章',
				'comment'		=> '最多评论文章',
				'list_ad'		=> '广告模块',
			),
			'default'		=> 'stick',
		),
			
		array(
			'id'			=> 'modular_style_list_stick',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'		=> array(
				'1'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_1.png',
				'2'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_2.png',
				'3'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_3.png',
				'4'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_4.png',
				//第五个模块仅限于调用分类 '5' => get_stylesheet_directory_uri() . '/static/images/admin/modular_list_5.png',
				//第六个模块仅限于调用分类 '6' => get_stylesheet_directory_uri() . '/static/images/admin/modular_list_6.png',
				//第七个模块仅限于调用分类 '7' => get_stylesheet_directory_uri() . '/static/images/admin/modular_list_7.png',
				'8'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_8.png',
				'9'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_9.png',
				'10'		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_10.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_list_stick', '==', true )
		),
			
		array(
			'id'			=> 'modular_style_list_random',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'		=> array(
				'1'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_1.png',
				'2'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_2.png',
				'3'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_3.png',
				'4' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_4.png',
				'8' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_8.png',
				'9' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_9.png',
				'10' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_10.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_list_random', '==', true )
		),
		
        array(
            'type'			=> 'notice',
            'class'			=> 'warning',
            'content'		=> '第8和第9个模块是带分页按钮的。<br><br>第8个模块，大图样式在编辑文章的时候，选择【大图】文章形式。<br><br>第9个模块第一篇和第6篇自动显示为大图样式。',
			'dependency'	=> array( 'modular_type_list_newest', '==', true )
        ),
		
		array(
			'id'			=> 'modular_style_list_newest',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'		=> array(
				'1'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_1.png',
				'2'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_2.png',
				'3'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_3.png',
				'4'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_4.png',
				'8'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_8.png',
				'9'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_9.png',
				'10'		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_10.png',
				'11'		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_11.png',//带分页的最新文章
				'12'		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_12.png',//带分页的最新文章
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_list_newest', '==', true )
		),
			
		array(
			'id'			=> 'modular_style_list_category',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'		=> array(
				'1'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_1.png',
				'2' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_2.png',
				'3' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_3.png',
				'4' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_4.png',
				'5' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_5.png',
				'6' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_6.png',
				'7' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_7.png',
				'8' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_8.png',
				'9' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_9.png',
				'10' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_10.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_list_category', '==', true )
		),
		
		array(
			'id'			=> 'modular_style_list_tags',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'		=> array(
				'1'			=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_1.png',
				'2' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_2.png',
				'3' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_3.png',
				'4' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_4.png',
				'5' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_5.png',
				'6' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_6.png',
				'7' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_7.png',
				'8' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_8.png',
				'9' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_9.png',
				'10' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_10.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_list_tags', '==', true )
		),

		array(
			'id'			=> 'modular_style_list_see',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'		=> array(
				'1' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_1.png',
				'2' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_2.png',
				'3' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_3.png',
				'4' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_4.png',
				'8' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_8.png',
				'9' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_9.png',
				'10' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_10.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_list_see', '==', true )
		),
			
		array(
			'id'			=> 'modular_style_list_comment',
			'type'			=> 'image_select',
			'title'			=> '模块样式',
			'options'		=> array(
				'1' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_1.png',
				'2' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_2.png',
				'3' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_3.png',
				'4' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_4.png',
				'8' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_8.png',
				'9' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_9.png',
				'10' 		=> get_stylesheet_directory_uri() . '/static/images/admin/modular_list_10.png',
			),
			'default'		=> '1',
			'dependency'	=> array( 'modular_type_list_comment', '==', true )
		),

		array(
			'id'			=> 'modular_cat_list',
			'type'			=> 'checkbox',
			'title'			=> '选择分类',
			'class'			=> 'horizontal',
			'options'		=> 'categories',
			'after'			=> '<div class="cs-text-muted">如果勾选多个分类，就会显示多个相同样式的模块，但调用的分类不同</div>',
			'dependency'	=> array( 'modular_type_list_category', '==', true )
		),
		
		array(
			'id'			=> 'modular_tags_list',
			'type'			=> 'text',
			'title'			=> '输入标签ID',
			'after'			=> '<div class="cs-text-muted">如果添加多个标签ID，请使用英文逗号隔开（不会查看标签id ？<a href="https://wpmes.cn/relive-documentation#c51" target="_blank">点击查看</a>）</div>',
			'dependency'	=> array( 'modular_type_list_tags', '==', true )
		),
		
		array(
			'id'			=> 'list_newest_exclude_category',
			'type'			=> 'checkbox',
			'title'			=> '排除指定分类下的文章',
			'class'			=> 'horizontal',
			'options'		=> 'categories',
			'after'			=> '<div class="cs-text-muted">最新文章中排除此处勾选的分类文章</div>',
			'dependency'	=> array( 'modular_type_list_newest', '==', true )
		),
		
		//广告模块
        array(
            'type'			=> 'notice',
            'class'			=> 'warning',
            'content'		=> '以下是图片广告设置选项（图片广告和联盟广告填写一项即可）',
			'dependency'	=> array( 'modular_type_list_list_ad', '==', true )
        ),
		array(
			'id'			=> 'list_ad_url',
			'type'			=> 'text',
			'title'			=> '广告链接',
			'attributes'	=> array('style' => 'width: 50%;'),
			'dependency'	=> array( 'modular_type_list_list_ad', '==', 'true' ),
		),
        array(
			'id'			=> 'list_ad_img_pc',
			'type'			=> 'upload',
			'title'			=> '上传图片(电脑端)',
			'desc'			=> '上传广告图',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'modular_type_list_list_ad', '==', 'true' ),
        ),
        array(
			'id'			=> 'list_ad_img_mobile',
			'type'			=> 'upload',
			'title'			=> '上传图片(移动端)',
			'desc'			=> '上传广告图',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'modular_type_list_list_ad', '==', 'true' ),
        ),
        array(
            'type'			=> 'notice',
            'class'			=> 'warning',
            'content'		=> '如果需要投放联盟广告，请在下面贴入广告代码（图片广告和联盟广告填写一项即可）',
			'dependency'	=> array( 'modular_type_list_list_ad', '==', true )
        ),
		array(
			'id'			=> 'list_ad_code_pc',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(电脑端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows'	=> 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'	=> array( 'modular_type_list_list_ad', '==', 'true' ),
		),
		array(
			'id'			=> 'list_ad_code_mobile',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(移动端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'	=> array( 'modular_type_list_list_ad', '==', 'true' ),
		),
		//广告模块结束

      ),

    ),
	//列表内模块结束

  ),

);

// ----------------------------------------
// 社交工具
// ----------------------------------------
$options[]      = array(
  'name'        => 'social',
  'title'       => '社交工具',
  'icon'        => 'iconfont icon-QQ',

  'fields'      => array(

    array(
		'id'			=> 'header_qq_url',
		'type'			=> 'text',
		'title'			=> 'QQ号码',
		'after'			=> '<p class="cs-text-muted">输入QQ号码，当用户点击QQ图标的时候会打开与您的QQ临时会话窗口。</p>',
    ),
    array(
		'id'			=> 'header_weibo_url',
		'type'			=> 'text',
		'title'			=> '新浪微博',
		'after'			=> '<p class="cs-text-muted">输入您的微博链接地址。</p>',
    ),
  	array(
		'id'			=> 'header_weixin_img',
		'type'			=> 'image',
		'title'			=> '微信二维码',
		'desc'			=> '上传您的微信二维码。',
		'add_title'		=> '上传二维码',
	),
    array(
		'id'			=> 'header_email_url',
		'type'			=> 'text',
		'title'			=> '电子邮箱',
		'after'			=> '<p class="cs-text-muted">输入您的电子邮箱地址。</p>',
    ),

    array(
      'id'    => 'header_style_1_social',
      'type'  => 'switcher',
      'title' => '导航栏显示社交图标',
	  //'after'    => '<p class="cs-text-muted"><br><br>社交工具在【社交工具】栏进行设置,此处仅控制显示或关闭</p>',
    ),

  ),

);

// ----------------------------------------
// 页脚样式
// ----------------------------------------
$options[]      = array(
  'name'        => 'footer_setting',
  'title'       => '页脚样式',
  'icon'        => 'iconfont icon-yejiao',

  'fields'		=> array(

	array(
		'id'		=> 'footer_copyright',
		'type'		=> 'wysiwyg',
		'title'		=> '自定义页脚版权信息',
		'after'		=> '<p class="cs-text-muted">如需添加链接，请使用 a 标签...</p>',
		'settings'	=> array(
			'textarea_rows' => 5,
			'tinymce'       => false,
			'media_buttons' => false,
		)
	),
	array(
      'id'			=> 'footer_color',
      'type'		=> 'color_picker',
      'title'		=> '页脚背景色',
      'default'		=> '#dd3333',
    ),
	array(
		'id'		=> 'footer_icp',
		'type'		=> 'text',
		'title'		=> 'ICP备案号',
	),
	array(
		'id'		=> 'footer_gaba',
		'type'		=> 'text',
		'title'		=> '公安备案号',
	),
	array(
		'id'		=> 'footer_gaba_url',
		'type'		=> 'text',
		'title'		=> '公安备案跳转链接',
	),
	array(
		'id'		=> 'foot_link',
		'type'		=> 'switcher',
		'title'		=> '友情链接',
		'desc'		=> '选择是否显示首页底部 友情链接',
		'default'	=> true
	),
	array(
		'id'		=> 'foot_link_cat',
		'type'		=> 'checkbox',
		'title'		=> '选择链接分类',
		'class'		=> 'horizontal',
		'options'	=> $options_linkcats,
		'after'		=> '<p class="cs-text-muted">如果此处没有显示您创建的链接分类，是因为您的链接分类中没有添加链接。</p>',
		'dependency'=> array( 'foot_link', '==', true )
	),
    array(
		'id'		=> 'xintheme_social_or_menu',
		'type'		=> 'radio',
		'title'		=> '社交工具 or 自定义菜单？',
		'class'		=> 'horizontal',
		'options'	=> array(
			'social'=> '社交工具',
			'menu'	=> '菜单',
		),
		'default'	=> 'social',
		'after'		=> '<p class="cs-text-muted">社交工具在【社交工具】栏进行设置，菜单在【后台 - 外观 - 菜单 - 新建菜单 - 选择显示位置（页脚菜单）】</p>',
    ),
	array(
		'id'		=> 'xintheme_link',
		'type'		=> 'switcher',
		'title'		=> '主题版权信息',
		'desc'		=> '保留页脚主题版权链接',
		'default'	=> true
	),

  ),

);

// ----------------------------------------
// 文章页面
// ----------------------------------------
$options[]      = array(
  'name'        => 'single_setting',
  'title'       => '文章页面',
  'icon'        => 'iconfont icon-wenzhang',

  'fields'		=> array(

		array(
			'id'      => 'post_sidebar_author',
			'type'    => 'switcher',
			'title'   => '文章侧栏显示作者模块',
			'default' => false
		),
		array(
			'id'      => 'xintheme_checkBaidu',
			'type'    => 'switcher',
			'title'   => '显示文章是否被百度收录（ 仅对管理员权限可见 ）',
			'default' => false
		),
		array(
			'id'      => 'post_expand_all',
			'type'    => 'switcher',
			'title'   => '展开阅读全文',
			'default' => false
		),
		array(
			'id'      => 'post_no_sidebar_all',
			'type'    => 'switcher',
			'title'   => '所有文章均使用单栏文章页',
			'help'    => '开启后，所有文章页面都显示为单栏样式。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_post_indent',
			'type'    => 'switcher',
			'title'   => '段落首行缩进',
			'help'    => '用CSS定义每段首行缩进2个字符。',
			'default' => false
		),
 		array(
			'id'      => 'xintheme_single_author',
			'type'    => 'switcher',
			'title'   => '文章作者',
			'default' => true
		),
 		array(
			'id'      => 'xintheme_single_cat',
			'type'    => 'switcher',
			'title'   => '文章分类目录',
			'default' => true
		),
 		array(
			'id'      => 'xintheme_single_time',
			'type'    => 'switcher',
			'title'   => '文章发布时间',
			'default' => true
		),
 		array(
			'id'      => 'xintheme_single_views',
			'type'    => 'switcher',
			'title'   => '文章浏览量',
			'default' => true
		),
 		array(
			'id'      => 'xintheme_single_duration',
			'type'    => 'switcher',
			'title'   => '文章预计阅读时长',
			'default' => true
		),
		
 		array(
			'id'      => 'xintheme_post_share',
			'type'    => 'switcher',
			'title'   => '文章开头显示分享、点赞和评论数量',
			'default' => true
		),
 		array(
			'id'      => 'xintheme_post_end_share',
			'type'    => 'switcher',
			'title'   => '文章结尾显示分享、点赞和评论数量',
			'default' => true
		),	

 		array(
			'id'      => 'xintheme_post_haibao',
			'type'    => 'switcher',
			'title'   => '生成分享海报',
			'default' => true
		),
		array(
			'id'        => 'xintheme_post_haibao_logo',
			'type'      => 'image',
			'title'     => '海报logo（尺寸：200*50）',
			'desc'      => '显示在海报图片底部，建议与网站Logo保持一致。',
			'add_title' => '上传 LOGO',
			'dependency'=> array( 'xintheme_post_haibao', '==', true )
		),
        array(
            'id'		   => 'xintheme_post_haibao_txt',
            'type'		   => 'text',
            'title'		   => '海报Logo下面的一段文字描述',
			'attributes'   => array('style'=> 'width: 100%;'),
			'dependency'   => array( 'xintheme_post_haibao', '==', true )
        ),
		
 		array(
			'id'      => 'xintheme_post_author',
			'type'    => 'switcher',
			'title'   => '作者模块',
			'default' => true
		),
 		array(
			'id'      => 'xintheme_post_prev_next',
			'type'    => 'switcher',
			'title'   => '上一篇 下一篇',
			'default' => true
		),
		array(
			'id'			=> 'xintheme_post_prev_next_bg_color',
			'type'			=> 'color_picker',
			'title'			=> '上一篇 下一篇 - 背景颜色',
			'default'		=> '#FC3C2D',
			'dependency'	=> array( 'xintheme_post_prev_next', '==', true )
		),
 		array(
			'id'      => 'xintheme_post_relevant',
			'type'    => 'switcher',
			'title'   => '你也可能喜欢（相关文章）',
			'default' => true
		),
		array(
			'id'      => 'single_copyright_switch',
			'type'    => 'switcher',
			'title'   => '文章版权信息',
			'default' => true
		),
		array(
			'id'		=> 'single_copyright',
			'type'		=> 'wysiwyg',
			'title'		=> '自定义文章版权信息',
			'after'		=> '<p class="cs-text-muted">出现在文章内容底部，可使用html...</p>',
			'settings'	=> array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'=> array( 'single_copyright_switch', '==', true )
		),

  ),

);

// ----------------------------------------
// 网址导航
// ----------------------------------------
$options[]      = array(
  'name'        => 'url_navigation',
  'title'       => '网址导航',
  'icon'        => 'iconfont icon-lianjie',

  'fields'    => array(

        array(
            'type'			=> 'notice',
            'class'			=> 'info',
            'content'		=> '请确保已在后台创建网址导航页面（后台 - 页面 - 新建页面 - 选择网址导航模板）。',
        ),
        array(
			'id'              => 'url_navigation',
			'type'            => 'group',
			'title'           => '网址导航',
			'button_title'    => '添加链接分类',
			'accordion_title' => '新增链接分类',
			'fields'          => array(

				array(
					'id'          => 'xintheme_nav_cat_title',
					'type'        => 'text',
					'title'       => '分类标题',
				),

				array(
					'id'		=> 'xintheme_nav_cat_list',
					'type'		=> 'radio',
					'title'		=> '选择链接分类',
					'class'		=> 'horizontal',
					'options'	=> $options_linkcats,
				),

			)
        ),

  ),

);

// ----------------------------------------
// 专题页面
// ----------------------------------------
$options[]      = array(
  'name'        => 'zhuanti',
  'title'       => '专题页面',
  'icon'        => 'iconfont icon-buju',

  'fields'    => array(

        array(
            'type'			=> 'notice',
            'class'			=> 'info',
            'content'		=> '请确保已在后台创建专题页面（后台 - 页面 - 新建页面 - 选择专题模板）。',
        ),
        array(
			'id'              => 'zhuanti',
			'type'            => 'group',
			'title'           => '专题页面',
			'button_title'    => '添加专题',
			'accordion_title' => '添加专题',
			'fields'          => array(

				array(
					'id'			=> 'zhuanti_type',
					'type'			=> 'radio',
					'title'			=> '调用内容',
					'class'			=> 'horizontal',
					'options'		=> array(
						'cat'		=> '添加分类',
						'tag'		=> '添加标签',
					),
					'default'		=> 'cat',
				),
				array(
					'id'			=> 'zhuanti_cat',
					'type'			=> 'checkbox',
					'title'			=> '选择分类',
					'class'			=> 'horizontal',
					'options'		=> 'categories',
					'dependency'	=> array( 'zhuanti_type_cat', '==', true )
				),
				array(
					'id'			=> 'zhuanti_tag',
					'type'			=> 'text',
					'title'			=> '输入标签ID',
					'after'			=> '<div class="cs-text-muted">如果添加多个标签ID，请使用英文逗号隔开（不会查看标签id ？<a href="https://wpmes.cn/relive-documentation#c51" target="_blank">点击查看</a>）</div>',
					'dependency'	=> array( 'zhuanti_type_tag', '==', true )
				),

			)
        ),

  ),

);

// ----------------------------------------
// SEO设置
// ----------------------------------------
$options[]      = array(
  'name'        => 'xintheme-notice',
  'title'       => '网站公告',
  'icon'        => 'iconfont icon-tishi5',

  'fields'      => array(

		array(
			'id'		=> 'xintheme-notice',
			'type'		=> 'switcher',
			'title'		=> '开启网站公告（ 弹出框 ）',
			'default'	=> false
		),
		array(
			'id'		=> 'xintheme-notice-home',
			'type'		=> 'switcher',
			'title'		=> '仅在首页显示',
			'default'	=> false,
			'dependency'=> array( 'xintheme-notice', '==', true )
		),
		array(
			'id'		=> 'xintheme-notice-cookie',
			'type'		=> 'switcher',
			'title'		=> '关闭公告后，一小时内不再弹出',
			'default'	=> false,
			'dependency'=> array( 'xintheme-notice', '==', true )
		),
		array(
	    	'id'		=> 'notice_bg_color',
	    	'type'		=> 'color_picker',
	    	'title'		=> '弹出框背景颜色',
	    	'default'	=> '#35a785',
	    	'dependency'	=> array( 'xintheme-notice', '==', true )
	    ),
	    array(
	    	'id'		=> 'notice_fadein',
	    	'type'		=> 'radio',
	    	'title'		=> '弹出框加载动画',
	    	'class'		=> 'horizontal',
	    	'options'	=> array(
	    		'1'			=> '从上往下',
	    		'2'			=> '从下往上',
	    		'3'			=> '从右往左',
	    		'4'			=> '放大',
	    	),
			'default'   => '4',
			'dependency'=> array( 'xintheme-notice', '==', true )
	    ),
        array(
            'id'		=> 'xintheme-notice-title',
            'type'		=> 'text',
            'title'		=> '输入公告标题',
			'attributes'=> array('style'=> 'width: 100%;'),
			'dependency'=> array( 'xintheme-notice', '==', true )
        ),
		array(
			'id'		=> 'xintheme-notice-content',
			'type'		=> 'wysiwyg',
			'title'		=> '输入公告内容',
			'after'		=> '<p class="cs-text-muted">支持html标签...</p>',
			'settings'	=> array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'=> array( 'xintheme-notice', '==', true )
		),

  ),

);

// ----------------------------------------
// SEO设置
// ----------------------------------------
$options[]      = array(
  'name'        => 'index-seo',
  'title'       => 'SEO设置',
  'icon'        => 'iconfont icon-wz-seo',

  'fields'      => array(

        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '全局SEO功能设定',
        ),
		array(
			'id'      => 'tag_link',
			'type'    => 'switcher',
			'title'   => '文章内标签自动添加链接',
			'default' => false
		),
        array(
            'id' => 'seo_auto_des',
            'type' => 'switcher',
            'title' => '文章页描述',
            'help' => '开启后将自动截取文章内容作为文章description标签',
            'default' => true
        ),

        array(
            'id' => 'seo_auto_des_num',
            'type' => 'text',
            'title' => '自动截取字节数',
            'default' => '120',
            'dependency' => array('seo_auto_des', '==', true),
        ),

        array(
            'id' => 'seo_sep',
            'type' => 'text',
            'title' => 'Title后缀分隔符',
            'default' => ' - ',
        ),

        array(
            'type' => 'notice',
            'class' => 'info',
            'content' => '首页SEO设置',
        ),
        array(
            'id' => 'seo_home_title',
            'type' => 'text',
            'title' => '首页标题',
            'help' => '关键词使用英文逗号隔开',
        ),

        array(
            'id' => 'seo_home_keywords',
            'type' => 'text',
            'title' => '首页关键词',
        ),

        array(
            'id' => 'seo_home_desc',
            'type' => 'textarea',
            'title' => '首页描述',
        ),

  ),

);

// ----------------------------------------
// 优化加速
// ----------------------------------------
$options[]      = array(
  'name'        => 'optimization',
  'title'       => '优化加速',
  'icon'        => 'iconfont icon-youhuajiasu',

  // 字段开始
  'fields'      => array(

    	array(
			'id'		=> 'thumbnail',
			'type'		=> 'radio',
			'title'		=> '选择缩略图剪裁模式',
		    'options'	=> array(
				'timthumb'	=> '使用timthumb.php剪裁缩略图',
				'default'	=> '输出原图（如果需要使用七牛或是阿里云OSS加速，请在【扩展功能 - CDN加速】中进行配置）',
		    ),
		    'default'	=> 'timthumb',
			'desc'		=> '如果开启了【扩展功能 - CDN加速】此处设置将不生效'
    	),
		array(
			'id'      => 'img_lazysizes',
			'type'    => 'switcher',
			'title'   => '延迟加载图片',
			'help'    => '减轻服务器压力，加速图片加载，节省宽带支出。',
			'default' => false
		),
		array(
			'id'        => 'img_lazysizes_thumbnail',
			'type'      => 'image',
			'title'     => '延迟加载默认缩略图',
			'desc'      => '图片未加载出来的时候显示一张默认缩略图',
			'add_title' => '上传默认缩略图',
			'dependency'=> array( 'img_lazysizes', '==', true )
		),
		array(
			'id'      => 'prohibit_comment',
			'type'    => 'switcher',
			'title'   => '禁止纯英文评论',
			'default' => false
		),
		array(
			'id'      => 'xintheme_option_thumbnail',
			'type'    => 'switcher',
			'title'   => '禁止WP默认缩略图',
			'help'    => '彻底禁止WordPress自动生成各类尺寸的缩略图。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_no_gutenberg',
			'type'    => 'switcher',
			'title'   => '彻底禁用古腾堡编辑器',
			'default' => false
		),
		array(
			'id'      => 'xintheme_article',
			'type'    => 'switcher',
			'title'   => '登陆后台跳转到文章列表',
			'help'    => 'WordPress登陆后一般是显示仪表盘页面，开启这个功能后登陆后台默认显示文章列表（默认开启）。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_wp_head',
			'type'    => 'switcher',
			'title'   => '移除顶部多余信息',
			'help'    => '移除WordPress Head 中的多余信息，能够有效的提高网站自身安全（默认开启）。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_api',
			'type'    => 'switcher',
			'title'   => '禁用REST API',
			'help'    => '禁用REST API、移除wp-json链接（默认关闭，如果你的网站没有做小程序或是APP，建议开启这个功能，禁用REST API）。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_pingback',
			'type'    => 'switcher',
			'title'   => '禁用XML-RPC',
			'help'    => '此功能会关闭 XML-RPC 的 pingback 端口（默认开启，提高网站安全性）。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_feed',
			'type'    => 'switcher',
			'title'   => '禁用Feed',
			'help'    => 'Feed易被利用采集，造成不必要的资源消耗（默认开启）。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_category',
			'type'    => 'switcher',
			'title'   => '去除分类标志',
			'help'    => '去除链接中的分类category标志，有利于SEO优化，每次开启或关闭此功能，都需要重新保存一下固定链接！（默认关闭）。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_privacy',
			'type'    => 'switcher',
			'title'   => '移除后台隐私',
			'help'    => '彻底删除WordPress后台隐私相关设置。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_revision',
			'type'    => 'switcher',
			'title'   => '禁用日志修订功能',
			'help'    => '文章修订会在 Posts 表中插入多条历史数据，造成 Posts 表冗余，建议屏蔽文章修订功能，提高数据库效率。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_delete_post_attachments',
			'type'    => 'switcher',
			'title'   => '删除文章时删除图片附件',
			'default' => false
		),
		array(
			'id'      => 'xintheme_v2ex',
			'type'    => 'switcher',
			'title'   => 'Gravatar镜像服务',
			'help'    => '使用国内的Gravatar镜像服务，提高网站加载速度，https://cdn.v2ex.com/gravatar',
			'default' => false
		),
		array(
			'id'      => 'xintheme_upload_img_rename',
			'type'    => 'switcher',
			'title'   => '上传图片重命名',
			'help'    => '上传的图片使用日期格式重命名',
			'default' => false
		),
		array(
			'id'      => 'xintheme_remove_script_version',
			'type'    => 'switcher',
			'title'   => '去除前端版本号',
			'help'    => '去除前端加载的css和js后面的版本号',
			'default' => false
		),
		array(
			'id'      => 'xintheme_all_settings',
			'type'    => 'switcher',
			'title'   => '高级设置',
			'help'    => '在设置菜单下面显示高级设置选项（不懂的不要乱设置）',
			'default' => false
		),
		array(
			'id'      => 'xintheme_language',
			'type'    => 'switcher',
			'title'   => '禁止前台加载语言包',
			'help'    => '禁止前台加载语言包可提升 0.1-0.5 秒不等的加载时间',
			'default' => false
		),

  ),

);

// ------------------------------
// 扩展功能
// ------------------------------
$options[]   = array(
    'name'     => 'xintheme_extension',
    'title'    => '扩展功能',
    'icon'     => 'iconfont icon-tishi4',
    'fields' => array(

		array(
			'id'      => 'xintheme_simple_urls',
			'type'    => 'switcher',
			'title'   => '外链转内链',
			'desc'    => '开启后刷新一下页面即可在菜单栏显示按钮',
			'help'    => '集成Simple Urls外链转内链插件，开启即可使用。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_wp-clean-up',
			'type'    => 'switcher',
			'title'   => '数据库优化清理',
			'desc'    => '开启后刷新一下页面，在外观 - 数据库清理 中进行优化',
			'help'    => '集成wp-clean-up插件，WordPress数据库优化，它包含删除冗余数据和数据库优化两大功能，操作界面十分简洁易于理解。',
			'default' => false
		),
		array(
			'id'      => 'xintheme_sitemap',
			'type'    => 'switcher',
			'title'   => '站点地图（Sitemap）',
			'desc'    => '开启后刷新一下页面，在外观 - 站点地图 中进行设置',
			'help'    => '自动生成xml文件，遵循Sitemap协议，用于指引搜索引擎快速、全面的抓取或更新网站上内容。兼容百度、google、360等主流搜索引擎。',
			'default' => false
		),
		
        array(
            'type'			=> 'notice',
            'class'			=> 'info',
            'content'		=> 'CDN加速，支持七牛云储存和阿里云OSS',
			'dependency'	=> array( 'cdn_switch', '==', true )
        ),
		
		array(
			'id'      => 'cdn_switch',
			'type'    => 'switcher',
			'title'   => 'CDN加速，支持七牛云储存和阿里云OSS以及腾讯云COS',
			'default' => false
		),
        array(
			'id'      => 'cdn_type',
			'type'    => 'select',
			'title'   => '选择云储存',
			'options' => array(
				'qiniu'		=> '七牛云储存',
				'alioss'	=> '阿里云OSS',
				'txcos'		=> '腾讯云COS',
			),
			'dependency'	=> array( 'cdn_switch', '==', true )
        ),
        array(
            'id'		   => 'cdn_url',
            'type'		   => 'text',
            'title'		   => '加速域名',
			'help'   	   => '你的加速域名',
			'after'		   => '<p class="cs-text-muted">不要忘记了“http(s)://”</p>',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'	=> array( 'cdn_switch', '==', true )
        ),
        array(
            'id'		   => 'cdn_file_format',
            'type'		   => 'text',
            'title'		   => '镜像文件格式',
			'default'	   => 'png|jpg|jpeg|gif|ico|7z|zip|rar|pdf|ppt|wmv|mp4|avi|mp3|txt',
			'help'   	   => '在输入框内添加准备镜像的文件格式，比如png|jpg|jpeg|gif|ico|html|7z|zip|rar|pdf|ppt|wmv|mp4|avi|mp3|txt（使用|分隔）',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'	=> array( 'cdn_switch', '==', true )
        ),
        array(
            'id'		   => 'cdn_mirror_folder',
            'type'		   => 'text',
            'title'		   => '镜像文件夹',
			'default'	   => 'wp-content|wp-includes',
			'help'		   => '在输入框内添加准备镜像的文件夹，比如wp-content|wp-includes（使用|分隔）',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'	=> array( 'cdn_switch', '==', true )
        ),
		array(
			'id'			=> 'admin_cdn',
			'type'			=> 'switcher',
			'title'			=> '后台媒体库同时使用CDN加速',
			'dependency'	=> array( 'cdn_switch', '==', true ),
			'default'		=> false
		),
		
        array(
            'type'			=> 'notice',
            'class'			=> 'info',
            'content'		=> 'SMTP邮箱设置',
			'dependency'	=> array( 'xintheme_smtp_switcher', '==', true )
        ),
		array(
			'id'      => 'xintheme_smtp_switcher',
			'type'    => 'switcher',
			'title'   => 'SMTP邮箱设置',
			'default' => false
		),
        array(
            'id'		   => 'xintheme_email',
            'type'		   => 'text',
            'title'		   => '发件人邮箱',
			'after'		   => '<p class="cs-text-muted">请输入您的邮箱地址</p>',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'   => array( 'xintheme_smtp_switcher', '==', true )
        ),
        array(
            'id'		   => 'xintheme_mailname',
            'type'		   => 'text',
            'title'		   => '发件人昵称',
			'after'		   => '<p class="cs-text-muted">请输入您的昵称</p>',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'   => array( 'xintheme_smtp_switcher', '==', true )
        ),
        array(
            'id'		   => 'xintheme_mailsmtp',
            'type'		   => 'text',
            'title'		   => 'SMTP服务器地址',
			'default'	   => 'smtp.qq.com',
			'after'		   => '<p class="cs-text-muted">请输入您邮箱的SMTP服务器</p>',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'   => array( 'xintheme_smtp_switcher', '==', true )
        ),
		array(
			'id'      => 'xintheme_smtpssl',
			'type'    => 'switcher',
			'title'   => 'SSL安全连接',
			'dependency'	=> array( 'xintheme_smtp_switcher', '==', true ),
			'default' => true
		),
		array(
		  'id'      	   => 'xintheme_mailport',
		  'type'    	   => 'number',
		  'title'   	   => 'SMTP服务器端口',
		  'default'	   	   => '465',
		  'dependency'	   => array( 'xintheme_smtp_switcher', '==', true ),
		),
        array(
            'id'		   => 'xintheme_mailuser',
            'type'		   => 'text',
            'title'		   => '邮箱帐号',
			'after'		   => '<p class="cs-text-muted">请输入您的邮箱地址，例如：670088886@qq.com</p>',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'   => array( 'xintheme_smtp_switcher', '==', true )
        ),
        array(
            'id'		   => 'xintheme_mailpass',
            'type'		   => 'text',
            'title'		   => '邮箱认证密码',
			'after'		   => '<p class="cs-text-muted">这里不是QQ密码，请前往QQ邮箱 - 设置 - 账户中生成授权码</p>',
			'attributes'   => array('style'=> 'width: 50%;'),
			'dependency'   => array( 'xintheme_smtp_switcher', '==', true )
        ),
    
    ),
);

// ------------------------------
// 广告设置
// ------------------------------
$options[]	= array(
    'name'		=> 'xintheme_ad',
    'title'		=> '广告设置',
    'icon'		=> 'iconfont icon-feiji',
    'fields'	=> array(

		//信息流广告模块
        array(
            'type'			=> 'notice',
            'class'			=> 'warning',
            'content'		=> '信息流广告',
        ),
        array(
			'id'			=> 'post_ad_type',
			'type'			=> 'select',
			'title'			=> '信息流广告（穿插在最新文章列表内，包括分类列表）',
			'options'		=> array(
				'close'		=> '关闭广告',
				'img'		=> '图片广告',
				'code'		=> '广告代码'
			),
			'default'		=> 'close',
			'attributes'   => array(
				'data-depend-id' => 'post_ad_type',
			),
        ),
		array(
			'id'			=> 'post_ad_number',
			'type'			=> 'number',
			'title'			=> '显示在第几篇文章后面？',
			'dependency'	=> array( 'post_ad_type', 'any', 'img,code' ),
		),
		array(
			'id'			=> 'post_ad_url',
			'type'			=> 'text',
			'title'			=> '广告链接',
			'attributes'	=> array('style' => 'width: 50%;'),
			'dependency'	=> array( 'post_ad_type', 'any', 'img' ),
		),
        array(
			'id'			=> 'post_ad_img_pc',
			'type'			=> 'upload',
			'title'			=> '上传图片(电脑端)',
			'desc'			=> '上传广告图',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'post_ad_type', 'any', 'img' ),
        ),
        array(
			'id'			=> 'post_ad_img_mobile',
			'type'			=> 'upload',
			'title'			=> '上传图片(移动端)',
			'desc'			=> '上传广告图',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'post_ad_type', 'any', 'img' ),
        ),
		array(
			'id'			=> 'post_ad_code_pc',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(电脑端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows'	=> 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'	=> array( 'post_ad_type', 'any', 'code' ),
		),
		array(
			'id'			=> 'post_ad_code_mobile',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(移动端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'	=> array( 'post_ad_type', 'any', 'code' ),
		),
		//信息流广告模块结束
		
		//文章顶部广告模块
        array(
            'type'			=> 'notice',
            'class'			=> 'warning',
            'content'		=> '文章内容顶部广告',
        ),
        array(
			'id'			=> 'single_top_ad_type',
			'type'			=> 'select',
			'title'			=> '文章内容头部广告',
			'options'		=> array(
				'close'		=> '关闭广告',
				'img'		=> '图片广告',
				'code'		=> '广告代码'
			),
			'default'		=> 'close',
			'attributes'   => array(
				'data-depend-id' => 'single_top_ad_type',
			),
        ),
		array(
			'id'			=> 'single_top_ad_url',
			'type'			=> 'text',
			'title'			=> '广告链接',
			'attributes'	=> array('style' => 'width: 50%;'),
			'dependency'	=> array( 'single_top_ad_type', 'any', 'img' ),
		),
        array(
			'id'			=> 'single_top_ad_img_pc',
			'type'			=> 'upload',
			'title'			=> '上传图片(电脑端)',
			'desc'			=> '上传广告图',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'single_top_ad_type', 'any', 'img' ),
        ),
        array(
			'id'			=> 'single_top_ad_img_mobile',
			'type'			=> 'upload',
			'title'			=> '上传图片(移动端)',
			'desc'			=> '上传广告图',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'single_top_ad_type', 'any', 'img' ),
        ),
		array(
			'id'			=> 'single_top_ad_code_pc',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(电脑端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows'	=> 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'	=> array( 'single_top_ad_type', 'any', 'code' ),
		),
		array(
			'id'			=> 'single_top_ad_code_mobile',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(移动端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'	=> array( 'single_top_ad_type', 'any', 'code' ),
		),
		//文章顶部广告结束
		
		//文章底部广告模块
        array(
            'type'			=> 'notice',
            'class'			=> 'warning',
            'content'		=> '文章内容底部广告',
        ),
        array(
			'id'			=> 'single_ad_type',
			'type'			=> 'select',
			'title'			=> '文章内容底部广告',
			'options'		=> array(
				'close'		=> '关闭广告',
				'img'		=> '图片广告',
				'code'		=> '广告代码'
			),
			'default'		=> 'close',
			'attributes'   => array(
				'data-depend-id' => 'single_ad_type',
			),
        ),
		array(
			'id'			=> 'single_ad_url',
			'type'			=> 'text',
			'title'			=> '广告链接',
			'attributes'	=> array('style' => 'width: 50%;'),
			'dependency'	=> array( 'single_ad_type', 'any', 'img' ),
		),
        array(
			'id'			=> 'single_ad_img_pc',
			'type'			=> 'upload',
			'title'			=> '上传图片(电脑端)',
			'desc'			=> '上传广告图',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'single_ad_type', 'any', 'img' ),
        ),
        array(
			'id'			=> 'single_ad_img_mobile',
			'type'			=> 'upload',
			'title'			=> '上传图片(移动端)',
			'desc'			=> '上传广告图',
			'settings'		=> array(
				'button_title'	=> '选择图像',
				'frame_title'	=> '选择图像',
				'insert_title'	=> '插入图像',
			),
			'dependency'	=> array( 'single_ad_type', 'any', 'img' ),
        ),
		array(
			'id'			=> 'single_ad_code_pc',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(电脑端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows'	=> 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'	=> array( 'single_ad_type', 'any', 'code' ),
		),
		array(
			'id'			=> 'single_ad_code_mobile',
			'type'			=> 'wysiwyg',
			'title'			=> '广告代码(移动端)',
			'after'			=> '<p class="cs-text-muted">输入您的广告代码...</p>',
			'settings'		=> array(
				'textarea_rows' => 5,
				'tinymce'       => false,
				'media_buttons' => false,
			),
			'dependency'	=> array( 'single_ad_type', 'any', 'code' ),
		),
		//文章底部广告模块结束
    
    ),
);

// ----------------------------------------
// 添加代码
// ----------------------------------------
$options[]      = array(
  'name'        => 'xintheme_add_code',
  'title'       => '添加代码',
  'icon'        => 'iconfont icon-programming__easyiconnet',

  'fields' => array(
	array(
	  'id'      => 'head_code',
	  'type'    => 'wysiwyg',
	  'title'   => '添加代码到头部',
	  'after'    => '<p class="cs-text-muted">出现在网站 head 中，主要用于验证网站...</p>',
      'settings' => array(
        'textarea_rows' => 5,
        'tinymce'       => false,
        'media_buttons' => false,
      )
	),
	array(
	  'id'      => 'foot_code',
	  'type'    => 'wysiwyg',
	  'title'   => '添加代码到页脚',
	  'after'    => '<p class="cs-text-muted">出现在网站底部 body 前，主要用于站长统计代码...</p>',
      'settings' => array(
        'textarea_rows' => 5,
        'tinymce'       => false,
        'media_buttons' => false,
      )
	),
  ),

);

// ------------------------------
// 图标
// ------------------------------
$options[]   = array(
    'name'     => 'iconfont',
    'title'    => '基础图标',
    'icon'     => 'iconfont icon-tubiao',
    'fields' => array(

/*
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '更新主题版本时图标库也会跟随更新。使用方式： &lt;span class="iconfont icon-Name"&gt;&lt;/span&gt;',
        ),
*/
        array(
            'type'    => 'content',
            'content' => '<iframe src="'. get_bloginfo('template_directory') .'/static/font/fonts.html" style="width:100%;height:1000px;"></iframe>',
        ),
    
    ),
);



CSFramework::instance( $settings, $options );
