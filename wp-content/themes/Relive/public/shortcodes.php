<?php
//V3.0版本-增加文章倒计时
function xintheme_countdown($atts, $content=null) {
    extract(shortcode_atts(array("time" => '',"color1" => '',"color2" => ''), $atts));
	date_default_timezone_set('PRC');
	$endtime=strtotime($time);
	$nowtime=time();
	global $endtimes;
	$endtimes = str_replace(array("-"," ",":"),",",$time);
    if( $endtime>$nowtime ){
        return '        
        <div class="mnmd-block__inner inverse-text post_countdown">
            <div class="background-img gradient-5" style="background: linear-gradient(225deg,'.$color2.' 0,'.$color1.' 100%);">
                <div class="background-svg-pattern">
                </div>
            </div>
            <div class="row row--flex row--vertical-center">
                <div class="col-xs-12 col-md-6">
                    <div class="mnmd-countdown">
                        <div class="mnmd-countdown__inner meta-font post-js-countdown" data-countdown="'.$time.'">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 text-center">
                    <h3 class="typescale-4"><i class="iconfont icon-jinhangzhong"></i> 活动进行中</h3>
                </div>
            </div>
        </div>
        ';
    }else{
        return '
        <div class="mnmd-block__inner inverse-text post_countdown">
            <div class="background-img gradient-5" style="background: linear-gradient(225deg,'.$color2.' 0,'.$color1.' 100%);">
                <div class="background-svg-pattern">
                </div>
            </div>
            <div class="row row--flex row--vertical-center">
                <div class="col-xs-12 col-md-6">
                    <div class="mnmd-countdown">
                        <div class="mnmd-countdown__inner meta-font post-js-countdown" data-countdown="'.$time.'">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 text-center">
                    <h3 class="typescale-4"><i class="iconfont icon-yijieshu1"></i> 活动已结束</h3>
                </div>
            </div>
        </div>
        ';
    }
}
add_shortcode('countdown', 'xintheme_countdown');

//添加幻灯片
function xintheme_slide( $atts, $content = null ) {
	$shortcode_atts = shortcode_atts(
		array(
			'img_1' => '',
			'img_2' => '',
			'img_3' => '',
			'img_4' => '',
			'img_5' => '',
			'img_6' => '',
			'img_7' => '',
			'img_8' => '',
			'img_9' => '',
			'img_10' => '',
		),
		$atts,
		'slide'
	);
	if ( $shortcode_atts['img_1'] ) {
		$img_1 = '<a href="' . $shortcode_atts['img_1'] . '" data-size="790x445" data-caption=""></a>';
	}
	if ( $shortcode_atts['img_2'] ) {
		$img_2 = '<a href="' . $shortcode_atts['img_2'] . '" data-size="790x445" data-caption=""></a>';
	}
	if ( $shortcode_atts['img_3'] ) {
		$img_3 = '<a href="' . $shortcode_atts['img_3'] . '" data-size="790x445" data-caption=""></a>';
	}
	if ( $shortcode_atts['img_4'] ) {
		$img_4 = '<a href="' . $shortcode_atts['img_4'] . '" data-size="790x445" data-caption=""></a>';
	}
	if ( $shortcode_atts['img_5'] ) {
		$img_5 = '<a href="' . $shortcode_atts['img_5'] . '" data-size="790x445" data-caption=""></a>';
	}
	if ( $shortcode_atts['img_6'] ) {
		$img_6 = '<a href="' . $shortcode_atts['img_6'] . '" data-size="790x445" data-caption=""></a>';
	}
	if ( $shortcode_atts['img_7'] ) {
		$img_7 = '<a href="' . $shortcode_atts['img_7'] . '" data-size="790x445" data-caption=""></a>';
	}
	if ( $shortcode_atts['img_8'] ) {
		$img_8 = '<a href="' . $shortcode_atts['img_8'] . '" data-size="790x445" data-caption=""></a>';
	}
	if ( $shortcode_atts['img_9'] ) {
		$img_9 = '<a href="' . $shortcode_atts['img_9'] . '" data-size="790x445" data-caption=""></a>';
	}
	if ( $shortcode_atts['img_10'] ) {
		$img_10 = '<a href="' . $shortcode_atts['img_10'] . '" data-size="790x445" data-caption=""></a>';
	}
	$output = '<div class="mnmd-gallery-wrap">
					<div class="fotorama mnmd-gallery-slider mnmd-post-media-wide" data-width="100%" data-allowfullscreen="true" data-click="false">
						' . $img_1 . '
						' . $img_2 . '
						' . $img_3 . '
						' . $img_4 . '
						' . $img_5 . '
						' . $img_6 . '
						' . $img_7 . '
						' . $img_8 . '
						' . $img_9 . '
						' . $img_10 . '
					</div>
				</div>';
	return $output;
}

//进度条
function xintheme_progressbar( $atts, $content = null ) {
	$shortcode_atts = shortcode_atts(
		array(
			'label'      => '',
			'percentage' => '',
			'color'      => '',
		),
		$atts,
		'progressbar'
	);
	$percentage = round( $shortcode_atts['percentage'] );
	$output = '<div class="xintheme_progressbar">
					<div class="xintheme_progressbar_label font_alt">' . $shortcode_atts['label'] . '</div>
					<div class="xintheme_progressbar_inner" style="background-color:' . $shortcode_atts['color'] . ';" data-percentage="' . $percentage . '"></div>
					<div class="xintheme_progressbar_status font_alt">' . $percentage . '%</div>
				</div>';
	return $output;
}

//手风琴
function xintheme_accordion( $atts, $content = null ) {
	$shortcode_atts = shortcode_atts(
		array(
			'title' => '',
			'state' => '',
		),
		$atts,
		'accordion'
	);
	$content = do_shortcode( $content );
	$output = '<div class="xintheme_accordion xintheme_accordion_' . $shortcode_atts['state'] . '">
					<div class="xintheme_accordion_header" data-state="' . $shortcode_atts['state'] . '">
						<h3>' . $shortcode_atts['title'] . '</h3>
					</div>
					<div class="xintheme_accordion_content">' . $content . '</div>
				</div>';
	return $output;
}

//按钮
function xintheme_button( $atts, $content = null ) {
	$shortcode_atts = shortcode_atts(
		array(
			'title'    => '',
			'icon'     => '',
			'size'     => '',
			'position' => '',
			'color'    => '',
			'rounded'  => '',
			'blank'    => '',
			'url'      => '',
		),
		$atts,
		'button'
	);
	$classes = 'xintheme_button font_alt';
	if ( $shortcode_atts['size'] ) {
		$classes .= ' xintheme_button_size_' . $shortcode_atts['size'];
	}
	if ( $shortcode_atts['position'] ) {
		$classes .= ' xintheme_button_position_' . $shortcode_atts['position'];
	}
	if ( 'true' == $shortcode_atts['rounded'] ) {
		$classes .= ' xintheme_button_rounded';
	}
	if ( $shortcode_atts['icon'] ) {
		wp_enqueue_style( 'ecko-plugin-font-awesome' );
		$shortcode_atts['icon'] = '<i class="iconfont ' . $shortcode_atts['icon'] . '"></i>';
	}
	if ( 'true' == $shortcode_atts['blank'] ) {
		$shortcode_atts['blank'] = "target='_blank'";
	}
	$output = '<a rel="nofollow" href="' . $shortcode_atts['url'] . '" class=" ' . $classes . ' " style="background-color:' . $shortcode_atts['color'] . ';" ' . $shortcode_atts['blank'] . ' data-color="' . $shortcode_atts['color'] . '">' . $shortcode_atts['icon'] . '' . $shortcode_atts['title'] . '</a>';
	return $output;
}


/** -----------------------------------------------------------------------------------
	INITIALIZE SHORTCODES
------------------------------------------------------------------------------------ */

add_shortcode( 'xintheme_slide', 'xintheme_slide' );
add_shortcode( 'xintheme_progressbar', 'xintheme_progressbar' );
add_shortcode( 'xintheme_accordion', 'xintheme_accordion' );
add_shortcode( 'xintheme_button', 'xintheme_button' );


function xintheme_shortcode_content_filter( $content ) {
	$shortcodes = array(
		'xintheme_slide',
		'xintheme_progressbar',
		'xintheme_accordion',
		'xintheme_button',
	);
	$block = join( '|', $shortcodes );
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", '[$2$3]', $content );
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", '[/$2]', $rep );
	return $rep;
}
add_filter( 'the_content', 'xintheme_shortcode_content_filter' );


/** -----------------------------------------------------------------------------------
	TINYMCE EDITOR CONTROLS
------------------------------------------------------------------------------------ */


function xintheme_tinymce() {
	global $typenow;
	global $wp_version;
	if ( version_compare( $wp_version, '5.0', '<' ) ) {
		if ( ! in_array( $typenow, array( 'post', 'page' ) ) ) {
			return;
		}
		add_filter( 'mce_external_plugins', 'xintheme_tinymce_plugin' );
		add_filter( 'mce_buttons', 'xintheme_tinymce_button' );
	}
}
add_action( 'admin_head', 'xintheme_tinymce' );


function xintheme_theme_css() {
	$active_theme = wp_get_theme();
	$active_theme = $active_theme->display( 'TextDomain', false );
	?>
		<?php echo '<style>'; ?>
			.mce-widget.mce-btn.mce-menubtn.mce-last.mce-btn-has-text .mce-txt{font-weight: 700;color: #666;}
			.mce-theme-specific{ display: none !important; }
			.mce-theme-<?php echo esc_attr( $active_theme ); ?> { display: block !important; }
			.mce-ico.mce-i-xintheme-shortcodes-icon{ background-image: url('<?php echo get_template_directory_uri(); ?>/static/images/shortcodes-icon.png'); }
		<?php echo '</style>'; ?>
		
		
		<?php echo '<script type="text/javascript">'; ?>
		
(function() {

    /**
     * TinyMCE Button
     */

    tinymce.PluginManager.add('xintheme_shortcodes_options', function(editor, url){
        editor.addButton('xinthemeshortcodes_button', {
            text: '插入短代码',
            icon: 'xintheme-shortcodes-icon',
            type: 'menubutton',
            menu: [
                // Single Shortcodes
				XinThemeSlide,
				Codehighlighting,
                progressBarMenuItem,
                accordionMenuItem,
                buttonMenuItem,
            ]
        });
    });


    /**
     * Helpers
     */

    function escapeHTML(text) {
        return text
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
     }

    /**
     * 幻灯片
     */

    var XinThemeSlide = {
        text: '添加幻灯片',
        onclick: function(){
            tinyMCE.activeEditor.windowManager.open({
                title: '幻灯片',
                body: [
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_1',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_2',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_3',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_4',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_5',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_6',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_7',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_8',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_9',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_slide_img_10',
                        label: '图像地址',
                        placeholder: '贴入图像连接',
						minWidth: 425,
                    },
                ],
                onsubmit: function(e){
                    tinyMCE.activeEditor.insertContent('[xintheme_slide img_1="' + e.data.xintheme_slide_img_1 + '" img_2="' + e.data.xintheme_slide_img_2 + '" img_3="' + e.data.xintheme_slide_img_3 + '" img_4="' + e.data.xintheme_slide_img_4 + '" img_5="' + e.data.xintheme_slide_img_5 + '" img_6="' + e.data.xintheme_slide_img_6 + '" img_7="' + e.data.xintheme_slide_img_7 + '" img_8="' + e.data.xintheme_slide_img_8 + '" img_9="' + e.data.xintheme_slide_img_9 + '" img_10="' + e.data.xintheme_slide_img_10 + '"]');
                }
            });
        }
    };

    /**
     * 代码高亮
     */

    var Codehighlighting = {
        text: '代码高亮',
        onclick: function(){
            tinyMCE.activeEditor.windowManager.open({
                title: '插入代码',
                body: [
                    {
                        type: 'listbox',
                        name: 'xintheme_syntax_language',
                        label: 'Language',
                        minWidth: 300,
                        values: [
                            { text: '选择语言', value: 'auto' },
							{ text: 'HTML/XML', value: 'html' },
							{ text: 'CSS', value: 'css' },
							{ text: 'JavaScript', value: 'javascript' },
							{ text: 'PHP', value: 'php' },
							{ text: 'JSON', value: 'json' },
                        ]
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_syntax_code',
                        label: '输入代码',
                        minWidth: 500,
                        minHeight: 150,
                        multiline: true
                    }
                ],
                onsubmit: function(e){
                    var xintheme_syntax_language = '';
                    if(e.data.xintheme_syntax_language !== 'auto'){
                        var xintheme_syntax_language = 'class="language-' + e.data.xintheme_syntax_language + '"';
                    }
                    tinyMCE.activeEditor.insertContent('<pre class="line-numbers language-' + e.data.xintheme_syntax_language + '"><code ' + xintheme_syntax_language + '>' + escapeHTML(e.data.xintheme_syntax_code) + '</code></pre>');
                }
            });
        },
    };

    /**
     * 进度条
     */

    var progressBarMenuItem = {
        text: '进度条',
        onclick: function(){
            tinyMCE.activeEditor.windowManager.open({
                title: '进度条',
                body: [
                    {
                        type: 'textbox',
                        name: 'xintheme_progressbar_label',
                        label: '名称',
                        minWidth: 300,
                    },
                    {
                        type: 'slider',
                        name: 'xintheme_progressbar_percentage',
                        label: '百分比',
                        minWidth: 300,
                    },
                    {
                        type: 'colorpicker',
                        name: 'xintheme_progressbar_color',
                        label: '背景颜色',
                        color: '#2659BA',
                    },
                ],
                onsubmit: function(e){
                    tinyMCE.activeEditor.insertContent('[xintheme_progressbar label="' + e.data.xintheme_progressbar_label + '" percentage="' + e.data.xintheme_progressbar_percentage + '" color="' + e.data.xintheme_progressbar_color + '"]');
                }
            });
        },
    };


    /**
     * 手风琴
     */

    var accordionMenuItem = {
        text: '手风琴',
        onclick: function(){
            tinyMCE.activeEditor.windowManager.open({
                title: '手风琴',
                body: [
                    {
                        type: 'textbox',
                        name: 'xintheme_accordion_title',
                        label: '标题',
                        minWidth: 300,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_accordion_content',
                        label: '内容',
                        multiline: true,
                        minHeight: 125,
                        minWidth: 425,
                    },
                    {
                        type: 'listbox',
                        name: 'xintheme_accordion_state',
                        label: '默认状态',
                        values: [
                            { text: '关闭', value: 'closed' },
                            { text: '展开', value: 'open' },
                        ]
                    },
                ],
                onsubmit: function(e){
                    tinyMCE.activeEditor.insertContent('[xintheme_accordion title="' + e.data.xintheme_accordion_title + '" state="' + e.data.xintheme_accordion_state + '"]' + e.data.xintheme_accordion_content + '[/xintheme_accordion]');
                }
            });
        },
    };


    /**
     * 按钮
     */

    var buttonMenuItem = {
        text: '添加按钮',
        onclick: function(){
            tinyMCE.activeEditor.windowManager.open({
                title: '添加按钮',
                body: [
                    {
                        type: 'textbox',
                        name: 'xintheme_button_title',
                        label: '按钮文本',
                        minWidth: 300,
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_button_icon',
                        label: 'Iconfont 图标',
                        values: '',
                        placeholder: 'icon-QQ'
                    },
                    {
                        type: 'textbox',
                        name: 'xintheme_button_url',
                        label: '跳转链接',
                        values: '',
                        placeholder: 'https://wpmes.cn/'
                    },
                    {
                        type: 'listbox',
                        name: 'xintheme_button_size',
                        label: '按钮尺寸',
                        values: [
                            { text: '标准', value: 'standard' },
                            { text: '大号', value: 'large' },
                            { text: '特大号', value: 'extra' },
                        ]
                    },
                    {
                        type: 'listbox',
                        name: 'xintheme_button_position',
                        label: '位置',
                        values: [
                            { text: '标准', value: 'inline' },
                            { text: '全宽', value: 'block' },
                            { text: '居中', value: 'center' },
                        ]
                    },
                    {
                        type: 'colorpicker',
                        name: 'xintheme_button_color',
                        label: '背景颜色',
                        color: '#2659BA',
                    },
                    {
                        type: 'checkbox',
                        name: 'xintheme_button_rounded',
                        label: '圆角样式',
                    },
                    {
                        type: 'checkbox',
                        name: 'xintheme_button_blank',
                        label: '在新窗口打开链接',
                    },
                ],
                onsubmit: function(e){
                    tinyMCE.activeEditor.insertContent('[xintheme_button title="' + e.data.xintheme_button_title + '" icon="' + e.data.xintheme_button_icon + '" size="' + e.data.xintheme_button_size + '" position="' + e.data.xintheme_button_position + '" color="' + e.data.xintheme_button_color + '" rounded="' + e.data.xintheme_button_rounded + '" url="' + e.data.xintheme_button_url + '" blank="' + e.data.xintheme_button_blank + '"]');
                }
            });
        }
    };


})();

		
		<?php echo '</script>'; ?>
		
		
	<?php
}
add_action( 'admin_head', 'xintheme_theme_css' );


function xintheme_tinymce_plugin( $plugin_array ) {
	$plugin_array['xintheme_shortcodes_options'] = get_template_directory_uri() .'/static/js/shortcodes.js';
	return $plugin_array;
}


function xintheme_tinymce_button( $buttons ) {
	array_push( $buttons, 'xinthemeshortcodes_button' );
	return $buttons;
}
