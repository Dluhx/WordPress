<?php
// 分页代码
if ( !function_exists('xintheme_theme_pagenavi') ) {
	function xintheme_theme_pagenavi( $p = 2 ) { // 取当前页前后各 2 页
		if ( is_singular() ) return; // 文章与插页不用
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return; // 只有一页不用
		if ( empty( $paged ) ) $paged = 1;
		
		if ( $paged > 1 ) p_link( $paged - 1, '上一页', '<i class="iconfont icon-return"></i>' );/* 如果当前页大于1就显示上一页链接 */
		if ( $paged > $p + 1 ) p_link( 1, '最前页' );
		if ( $paged > $p + 2 ) echo '<a class="page-numbers">...</a>';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // 中间页
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<a class='mnmd-pagination__item mnmd-pagination__item-current' href='javascript:void(0);'>{$i}</a>" : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '<a class="mnmd-pagination__item" href="javascript:void(0);">...</a>';
		if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' );
		if ( $paged < $max_page ) p_link( $paged + 1,'下一页', ' <i class="iconfont icon-enter"></i>' );/* 如果当前页不是最后一页显示下一页链接 */
		//echo '<li><a class="page-numbers" href="javascript:void(0);">' . $paged . ' / ' . $max_page . ' </a></li> '; // 显示页数
	}
	function p_link( $i, $title = '', $linktype = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
		echo "<a class='mnmd-pagination__item' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a>";
	}
}
//获取文章中的图片个数
if( !function_exists('xintheme_post_images_number') ){  
    function xintheme_post_images_number(){  
        global $post;  
        $content = $post->post_content;    
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $result, PREG_PATTERN_ORDER);    
        return count($result[1]);    
    }  
}
/**
 * WordPress 获取“上一篇”文章缩略图的图片地址
 */
function xintheme_prev_thumbnail_url() {
	$timthumb = xintheme_img('timthumb','');
	$prev_post = get_previous_post();
	if ( get_post_meta($prev_post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($prev_post->ID, 'thumbnail', true);
		return $image;
	} else {
		if ( has_post_thumbnail($prev_post->ID) ) {
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'full');
			return $img_src[0];
		} else {
			$content = $prev_post->post_content;
			preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
			$n = count($strResult[1]);
			if($n > 0){
				return $strResult[1][0];
		}else {
			return $timthumb;
			}
		}
	}
}

/**
 * WordPress 获取“下一篇”文章缩略图的图片地址
 */
function xintheme_next_thumbnail_url() {
	$timthumb = xintheme_img('timthumb','');
	$next_post = get_next_post();
	if ( get_post_meta($next_post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($next_post->ID, 'thumbnail', true);
		return $image;
	} else {
		if ( has_post_thumbnail($next_post->ID) ) {
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'full');
			return $img_src[0];
		} else {
			$content = $next_post->post_content;
			preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
			$n = count($strResult[1]);
			if($n > 0){
				return $strResult[1][0];
			}else {
				return $timthumb;
			}
		}
	}
}
//字数和预计阅读时间统计
function xintheme_count_words_read_time () {
global $post;
   $text_num = mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8');
   $read_time = ceil($text_num/400);
   $output = '本文共' . $text_num . '个字，预计阅读需要'.$read_time.'分钟。';
   //$output = '预计阅读需要'.$read_time.'分钟。';
   return $output;
}
//点赞
function xintheme_theme_postlike(){  
    global $wpdb, $post;
    $dot_good = get_post_meta($post->ID, 'like', true) ? get_post_meta($post->ID, 'like', true) : '0';  
    $done = isset($_COOKIE['like_' . $post->ID]) ? 'done' : '';  
    echo '<a href="javascript:;" data-action="topTop" data-id="'.$post->ID.'" data-toggle="tooltip" data-placement="top" class="like like-count entry-action-btn '.$done.'" data-original-title="'.$dot_good.' 个点赞"><i class="iconfont icon-zan1" style="vertical-align: middle;font-size: 20px !important;"></i><span class="count">'.$dot_good.'</span></a>';  
}
// 评论验证
function xintheme_robot_comment(){
  if ( !$_POST['no-robot'] && !is_user_logged_in()) {
     wp_die('请勾选评论验证按钮后再发表。');
  }
}
add_action('pre_comment_on_post', 'xintheme_robot_comment');
// 评论框  用户信息栏显示在上方
function xintheme_recover_comment_fields($comment_fields){
    $comment = array_shift($comment_fields);
    $comment_fields =  array_merge($comment_fields ,array('comment' => $comment));
    return $comment_fields;
}
add_filter('comment_form_fields','xintheme_recover_comment_fields');
//添加@评论
add_filter('comment_text', 'xintheme_comment_add_at_parent');
function xintheme_comment_add_at_parent($comment_text) {
    $comment_ID = get_comment_ID();
    $comment = get_comment($comment_ID);
    if ($comment->comment_parent) {
        $parent_comment = get_comment($comment->comment_parent);
        $comment_text = '<a href="#comment-' . $comment->comment_parent . '"><span class="parent-icon">@' . $parent_comment->comment_author . '</a></span> ' . $comment_text;
    }
    return $comment_text;
}
//利用图床添加评论图片上传功能
add_action('comment_text', 'comments_embed_img', 2);
function comments_embed_img($comment) {
    $comment = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img src="$1" alt="评论图片">', $comment);
    return $comment;
}
//记住我的信息
function comment_form_change_cookies_consent( $fields ) {
	$fields['cookies'] = '<p style="display: none;" class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" checked="checked" />' .
	'<label for="wp-comment-cookies-consent">记住我的信息</label></p>';
	return $fields;
}
add_filter( 'comment_form_default_fields', 'comment_form_change_cookies_consent' );
//评论表情
function smilies_reset() {
    global $wpsmiliestrans, $wp_smiliessearch;
    if ( !get_option( 'use_smilies' ) )
        return;
    $wpsmiliestrans = array(
    '[阴险]' => 'yinxian.png',
    '[大哭]' => 'daku.png',
    '[白眼]' => 'baiyan.png',
    '[吃惊]' => 'chijing.png',
	'[呲牙]' => 'ciya.png',
	'[打脸]' => 'dalian.png',
	'[掉泪]' => 'diaolei.png',
	'[发呆]' => 'fadai.png',
	'[尴尬]' => 'ganga.png',
	'[嘿哈]' => 'heiha.png',
	'[机智]' => 'jizhi.png',
	'[奸笑]' => 'jianxiao.png',
	'[流泪]' => 'liulei.png',
	'[色]'	 => 'se.png',
	'[思考]' => 'sikao.png',
	'[捂脸]' => 'wulian.png',
	'[笑哭]' => 'xiaoku.png',
	'[咒骂]' => 'zhouma.png',
	'[咖啡]' => 'kafei.png',
	'[啤酒]' => 'pijiu.png',
    );
}
smilies_reset();

add_filter('smilies_src','xintheme_emoticon_src',1,10);
function xintheme_emoticon_src ($img_src, $img, $siteurl) {
    $img = trim($img);
    return get_bloginfo('template_directory').'/static/smilies/'.$img;
}

function xintheme_emoticon(){
    global $wpsmiliestrans;
    $wpsmilies = array_unique($wpsmiliestrans);
    foreach($wpsmilies as $alt => $src_path){
        $output .= '<a href="javascript:grin(\''.$alt.'\')"><img src="'.xintheme_emoticon_src(false, $src_path, false).'"></a>';
    }
    return $output;
}
//评论点赞
add_action('wp_ajax_nopriv_pinglun_zan', 'pinglun_zan');
add_action('wp_ajax_pinglun_zan', 'pinglun_zan');
function pinglun_zan(){
	$id = $_POST["um_id"];
	$action = $_POST["um_action"];
	if ($action == 'ding'){
		$specs_raters = get_comment_meta($id, 'pinglun_zan', true);
		$expire = time() + 99999999;
		$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
		setcookie('pinglun_zan_' . $id, $id, $expire, '/', $domain, false);
		if (!$specs_raters || !is_numeric($specs_raters)){
			update_comment_meta($id, 'pinglun_zan', 1);
		}else {
			update_comment_meta($id, 'pinglun_zan', ($specs_raters + 1));
		}
		echo get_comment_meta($id, 'pinglun_zan', true);
	}
	die;
}
// 禁止全英文评论
if( xintheme('prohibit_comment') ){
	function xintheme_prohibit_comment_post( $incoming_comment ) {
	    $pattern = '/[一-龥]/u';
	    if(!preg_match($pattern, $incoming_comment['comment_content'])) {
	    wp_die( "抱歉，本站禁止全英文评论，请输入一些汉字，谢谢！" );
	    }
	    return( $incoming_comment );
	}
	add_filter('preprocess_comment', 'xintheme_prohibit_comment_post');
}
//评论列表
if ( ! function_exists( 'xintheme_comments') ) {
    function xintheme_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <footer class="comment-meta">
                    <div class="comment-author vcard"> 
                        <?php
                        if( xintheme('open_ucenter') ){
                            echo xintheme_get_avatar( $comment->user_id , '54' , xintheme_get_avatar_type($comment->user_id) );
                        }else{
                            echo get_avatar($comment, '60');
                        } ?>
                        <b><?php printf('<span class="comment-author-name">%s</span>', get_comment_author_link()) ?></b>
                    </div>
                    <div class="comment-metadata">
                        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment-timestamp"><?php comment_date("Y-m-d H:m"); ?></a>
                        <span class="edit-link">
                            <?php edit_comment_link(__('编辑', 'xintheme'),'  ','');?>
                        </span>
                    </div>
                </footer><!-- .comment-meta -->
                <div class="comment-content">
    				<?php if ($comment->comment_approved == '0') : ?>
    				<div class="alert info">
    					<p><?php esc_html_e('您的评论正在审核中...', 'xintheme') ?></p>
    				</div>
    				<?php endif; ?>
    				<?php comment_text() ?>
                </div>
				<div class="reply">
					<a href="javascript:;" data-action="ding" data-id="<?php comment_ID(); ?>"
					class="pinglunZan <?php if (isset($_COOKIE['pinglun_zan_' . $comment->comment_ID]))echo 'done';
					?>"><i class="iconfont icon-zan1"></i> <span class="count"><?php $comment_id = $comment->comment_ID; if (get_comment_meta($comment_id, 'pinglun_zan', true)){echo get_comment_meta($comment_id, 'pinglun_zan', true); } else {echo '0';}?></span></a>
                    <?php
                        comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => " 回复", 'login_text' => " <i class='iconfont icon-denglu'></i> 登陆后回复")));
                    ?>
                </div>
			</div>
		<!-- </li> 由 wordpress 自动添加 -->
		<?php
    }
}

//CDN加速储存
if (!is_admin() && xintheme('cdn_switch')) {
    add_action('wp_loaded', 'xintheme_ob_start');
    function xintheme_ob_start() {
        ob_start('xintheme_cdn_replace');
    }
    function xintheme_cdn_replace($html) {
        $local_host = home_url(); //博客域名
        $cdn_host = xintheme('cdn_url'); //CDN域名
        $cdn_exts = xintheme('cdn_file_format'); //扩展名（使用|分隔）
        $cdn_dirs = xintheme('cdn_mirror_folder'); //目录（使用|分隔）
        $cdn_dirs = str_replace('-', '\-', $cdn_dirs);
        if ($cdn_dirs) {
            $regex = '/' . str_replace('/', '\/', $local_host) . '\/((' . $cdn_dirs . ')\/[^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
            $html = preg_replace($regex, $cdn_host . '/$1$4', $html);
        } else {
            $regex = '/' . str_replace('/', '\/', $local_host) . '\/([^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
            $html = preg_replace($regex, $cdn_host . '/$1$3', $html);
        }
        return $html;
    }
}
//自动替换媒体库图片的域名
if (is_admin() && xintheme('cdn_url') && xintheme('admin_cdn')) {
    function xintheme_attachment_replace($text) {
        $replace = array(
            '' . home_url() . '' => '' . xintheme('cdn_url') . ''
        );
        $text = str_replace(array_keys($replace) , $replace, $text);
        return $text;
    }
    add_filter('wp_get_attachment_url', 'xintheme_attachment_replace');
}
//SMTP邮箱设置
if (xintheme('xintheme_smtp_switcher')) {
    function xintheme_mail_smtp($phpmailer) {
        $phpmailer->From = xintheme('xintheme_email'); //发件人地址
        $phpmailer->FromName = xintheme('xintheme_mailname'); //发件人昵称
        $phpmailer->Host = xintheme('xintheme_mailsmtp'); //SMTP服务器地址
        $phpmailer->Port = xintheme('xintheme_mailport'); //SMTP邮件发送端口
        if (xintheme('xintheme_smtpssl')) {
            $phpmailer->SMTPSecure = 'ssl';
        } else {
            $phpmailer->SMTPSecure = '';
        } //SMTP加密方式(SSL/TLS)没有为空即可
        $phpmailer->Username = xintheme('xintheme_mailuser'); //邮箱帐号
        $phpmailer->Password = xintheme('xintheme_mailpass'); //邮箱密码
        $phpmailer->IsSMTP();
        $phpmailer->SMTPAuth = true; //启用SMTPAuth服务

    }
    add_action('phpmailer_init', 'xintheme_mail_smtp');
}

//标签云-热门标签
function xintheme_hot_tag_list( $num = null , $hot = null , $offset = null){
    $num = $num ? $num : 14;
    $hot = $hot ? $hot : 5;
    $offset = $offset ? $offset : 0;
    
    $output = '<ul class="colorful-categories box">';
    $tags = get_tags(array("number" => $num,
        "orderby"=>"count",
		"order" => "DESC",
        "offset"=>$offset,
    ));
    foreach($tags as $tag){
        $count = intval( $tag->count );
        $name = $tag->name;
        $output .= '<li><a href="'. esc_attr( get_tag_link( $tag->term_id ) ) .'" class="tag-item" title="#' . $name . '# 共有'. $tag->count .'篇文章"># ' . $name .' # <sup>'. $tag->count .'</sup></a></li>';

    }
    $output .= '</ul>';
    return $output;

}

//使用短代码在文章内添加推荐文章
function posts( $atts, $content = null ){
    extract( shortcode_atts( array('id' => ''),$atts ) );
    global $post;
    $content = '';
    $postids = explode(',', $id);
    $inset_posts = get_posts(array('post__in'=>$postids));
    //$category = get_the_category();
    foreach ($inset_posts as $key => $post) {
    setup_postdata( $post );
    $content .= '<span class="embed-card">
    <span class="embed-card-img">
    <a target="_blank" href="' . get_permalink() . '"><img alt="'. get_the_title() . '" src="'.post_thumbnail(400, 300).'"></a>
    </span>
    <span class="embed-card-info">
    <a target="_blank" href="' . get_permalink() . '">
    <span class="card-name">'. get_the_title() . '</span>
    </a>
    <span class="card-abstract">'.mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"...").'</span>
    <span class="card-controls">
    <span class="group-data"> <i class="iconfont icon-time"></i>'. get_the_time('Y-n-j') .'</span>
    <span class="group-data"> <i class="iconfont icon-browse"></i>'. post_views(false, '', '', false) .'</span>
    <span class="group-data"> <i class="iconfont icon-interactive"></i>'. get_comments_number()  .'</span>
    </span>
    </span>
    </span>';
    }
    wp_reset_postdata();
    return $content;
}
add_shortcode('post', 'posts');

//使用短代码添加回复后可见内容开始
function reply_to_read($atts, $content = null) {
    extract(shortcode_atts(array(
        "notice" => '<fieldset><legend>此部分内容已被隐藏</legend><p style="margin: 5px 0"> 请【<a href="' . get_permalink() . '#respond" title="发表评论">发表评论</a>】并【<a href="javascript:window.location.reload();" title="刷新">刷新</a>】页面方可查看！</p></fieldset>'
    ) , $atts));
    $email = null;
    $user_ID = (int)wp_get_current_user()->ID;
    if ($user_ID > 0) {
        $email = get_userdata($user_ID)->user_email;
        //对博主直接显示内容
        $admin_email = get_bloginfo('admin_email');
        if ($email == $admin_email) {
            return $content;
        }
    } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
        $email = str_replace('%40', '@', $_COOKIE['comment_author_email' . COOKIEHASH]);
    } else {
        return $notice;
    }
    if (empty($email)) {
        return $content;
    }
    global $wpdb;
    $post_id = get_the_ID();
    $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
    if ($wpdb->get_results($query)) {
        return do_shortcode($content);
    } else {
        return $notice;
    }
}
add_shortcode('reply', 'reply_to_read');
//分享海报
function get_haibaoimg() {
    $bt = get_the_title(); //标题
    $zy = wp_trim_words(get_the_excerpt() , 80); //摘要
    $haibao_logo = xintheme_img('xintheme_post_haibao_logo','');
	if ($haibao_logo) {
		$lo = $haibao_logo;
    } else {
        $lo = get_stylesheet_directory_uri() . "/static/images/logo.png";
    } //logo
    $bg = get_stylesheet_directory_uri() . "/static/images/timebg.png"; //时间背景
    $xux = get_stylesheet_directory_uri() . "/static/images/xuxian.png"; //虚线
    $sj = get_the_time('Y/m d'); //时间
    $zz = "作者：" . get_the_author_meta('nickname'); //作者
	$describe= xintheme('xintheme_post_haibao_txt'); //副标题
    $qr = get_stylesheet_directory_uri() . "/public/qrcode?data=".get_permalink(); //二维码
    $the_post_category = get_the_category(get_the_ID());
	$im = get_stylesheet_directory_uri() . '/public/image?pic=' . post_thumbnail(648, 450) . '&title=' . $bt . '&excerpt=' . $zy . '&line=' . $xux . '&logo=' . $lo . '&timebg=' . $bg . '&time=' . $sj . '&author=' . $zz . '  发布于：「' . $the_post_category[0]->cat_name . '」&describe=' . $describe . '&code=' . $qr;
    return $im;
}
function _get_excerpt($limit = 100, $after = '...') {
	$excerpt = get_the_excerpt();
	if (_new_strlen($excerpt) > $limit) {
		return _str_cut(strip_tags($excerpt), 0, $limit, $after);
	} else {
		return $excerpt;
	}
}
function _new_strlen($str,$charset='utf-8') {        
    $n = 0; $p = 0; $c = '';
    $len = strlen($str);
    if($charset == 'utf-8') {
        for($i = 0; $i < $len; $i++) {
            $c = ord($str{$i});
            if($c > 252) {
                $p = 5;
            } elseif($c > 248) {
                $p = 4;
            } elseif($c > 240) {
                $p = 3;
            } elseif($c > 224) {
                $p = 2;
            } elseif($c > 192) {
                $p = 1;
            } else {
                $p = 0;
            }
            $i+=$p;$n++;
        }
    } else {
        for($i = 0; $i < $len; $i++) {
            $c = ord($str{$i});
            if($c > 127) {
                $p = 1;
            } else {
                $p = 0;
        }
            $i+=$p;$n++;
        }
    }        
    return $n;
}

//延迟加载
if( xintheme('img_lazysizes') ){
	//为文章内图像增加lazyloa类
/* 	function add_image_responsive_class($content) {
	   global $post;
	   $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
	   $replacement = '<img$1class="$2 lazyload"$3>';
	   $content = preg_replace($pattern, $replacement, $content);
	   return $content;
	}
	add_filter('the_content', 'add_image_responsive_class'); */

	//文章内图片延迟加载
/* 	add_filter ('the_content', 'lazyload');
	function lazyload($content) {
		$loadimg_url = xintheme_img('img_lazysizes_thumbnail','');
		if(!is_feed()||!is_robots) {
			$content = preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i',"<img\$1data-src=\"\$2\" src=\"$loadimg_url\"\$3>",$content);
		}
		return $content;
	} */	
	
	// 图片延迟加载
	function xintheme_lazysizes(){
		$GLOBALS['img_lazysizes'] = true;
		echo sprintf('<script src="%s" async=""></script>', get_template_directory_uri() . '/static/js/lazysizes.min.js');
	}
	add_action( 'wp_head', 'xintheme_lazysizes', 1 );

}
// 判断是否延迟加载图片
function is_lazysizes(){
	if( isset( $GLOBALS['img_lazysizes'] ) ){
		return 'class="lazyload" src="'.xintheme_img('img_lazysizes_thumbnail','').'" data-';
	}
}

//面包屑导航
function get_breadcrumbs()  {
    global $wp_query;
    if ( !is_home() ){
        // Start the UL
        echo '<ul class="breadcrumb">'; 
        echo '<li><i class="iconfont icon-tripposition"></i> 当前位置：</li>';
        // Add the Home link  
        echo '<a href="'. get_settings('home') .'">首页</a>';

        if ( is_category() )  {
            $catTitle = single_cat_title( "", false );
            $cat = get_cat_ID( $catTitle );
            echo " &raquo; ". get_category_parents( $cat, TRUE, " &raquo; " ) ."";
        }
        elseif ( is_tag() )  {
            echo " &raquo; ".single_cat_title($prefix,$display)."";
        }
        elseif ( is_archive() && !is_category() )  {
            echo " &raquo; Archives";
        }
        elseif ( is_search() ) {
            echo ' &raquo; 搜索结果（共搜索到 ' . $wp_query->found_posts . ' 篇文章）';
        }
        elseif ( is_404() )  {
            echo " &raquo; 404 Not Found";
        }
        elseif ( is_single() )  {
            $category = get_the_category();
            $category_id = get_cat_ID( $category[0]->cat_name );
            echo ' &raquo; '. get_category_parents( $category_id, TRUE, "  &raquo; " );
            echo get_the_title();  
        }
        elseif ( is_page() )  {
            $post = $wp_query->get_queried_object();
            if ( $post->post_parent == 0 ){
                echo " &raquo; ".the_title('','', FALSE)."";
            } else {
                $title = the_title('','', FALSE);
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                array_push($ancestors, $post->ID);
    
                foreach ( $ancestors as $ancestor ){
                    if( $ancestor != end($ancestors) ){
                        echo ' &raquo; <a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a>'; 
                    } else {
                        echo ' &raquo; '. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'';
                    }
                }
            }
        }
        // End the UL
        echo "</ul>";
    }
}

/*识别当前作者身份*/
function xintheme_level() { 
$user_id=get_post(get_the_ID())->post_author;   
if(user_can($user_id,'install_plugins')){echo'<span>管理员</span>';}   
elseif(user_can($user_id,'edit_others_posts')){echo'<span>编辑</span>';}elseif(user_can($user_id,'publish_posts')){echo'<span>作者</span>';}elseif(user_can($user_id,'delete_posts')){echo'<span>投稿者</span>';}elseif(user_can($user_id,'read')){echo'<span>订阅者</span>';}
}

//判断文章是否被百度收录
function xintheme_checkBaidu($url) { 
    $url = 'http://www.baidu.com/s?wd=' . urlencode($url); 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    $rs = curl_exec($curl); 
    curl_close($curl); 
    if (!strpos($rs, '没有找到')) { //没有找到说明已被百度收录 
        return '<span style="color: #1658f6"><i class="icon iconfont icon-baidu"></i> 百度已收录</span>'; 
    } else { 
        return '<span style="color: #ec4141"><i class="icon iconfont icon-baidu"></i> 百度未收录</span>'; 
    } 
}

/*
//不过滤文章内Html标签
remove_action('init', 'kses_init');   
remove_action('set_current_user', 'kses_init');
*/

