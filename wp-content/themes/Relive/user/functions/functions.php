<?php

require_once('open-social.php');
require_once('follow.php');

/* 加载用户中心css以及js文件 */
function xintheme_add_scripts() {
	$open_ucenter = xintheme('open_ucenter');
	if( $open_ucenter ){
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'user_css', get_template_directory_uri().'/static/css/user.css', array(), '' );
		wp_enqueue_script('user_js', get_template_directory_uri() . '/static/js/user.js', array(),false, true);
	}
	?>
	<script type="text/javascript">
		var xintheme = <?php echo xintheme_script_parameter(); ?>;
	</script>
	<?php
}
add_action('wp_enqueue_scripts', 'xintheme_add_scripts');

function xintheme_script_parameter(){
	$object = array();
	$object['ajax_url'] = admin_url('admin-ajax.php');
	$object['admin_url'] = admin_url();
	$object['wp_url'] = get_bloginfo('url');
	//$object['xintheme_url'] = XINTHEME_URI;
	$object['uid'] = (int)get_current_user_id();
	$object['is_admin'] = current_user_can('edit_users')?1:0;
	//$object['redirecturl'] = xintheme_get_current_page_url();
	$object['loadingmessage'] = '正在请求中，请稍等...';
	$object['paged']	= get_query_var('paged')?(int)get_query_var('paged'):1;
	$object['cpage']	= get_query_var('cpage')?(int)get_query_var('cpage'):1;
	if(is_single()){
		global $post;
		$object['pid'] = $post->ID;
	}
	$object['timthumb'] = THEME_DIR.'/timthumb.php?src=';
	$object_json = json_encode($object);
	return $object_json;
}

/* 载入用户中心模板 */
function xintheme_load_author_template($template_path){
	if(!xintheme('open_ucenter'))return $template_path;
	if(is_author()){
		$template_path = TEMPLATEPATH.'/user/template/author.php';
	}
	return $template_path;
}
add_filter( 'template_include', 'xintheme_load_author_template', 1 );

/* 更改默认用户角色 */
function xintheme_default_role(){
	if(get_option('default_role')!='author')update_option('default_role','author');
}
add_action('admin_menu','xintheme_default_role');

function xintheme_allow_contributor_uploads() {
	if ( current_user_can('contributor') && !current_user_can('upload_files') ){
		$contributor = get_role('contributor');
  		$contributor->add_cap('upload_files');
	} 
}
add_action('admin_init', 'xintheme_allow_contributor_uploads');

/* 用户中心TAB选项 */
function xintheme_get_user_url( $type='', $user_id=0 ){
	$user_id = intval($user_id);
	if( $user_id==0 ){
		$user_id = get_current_user_id();
	}
	$url = add_query_arg( 'tab', $type, get_author_posts_url($user_id) );
	return $url;
}

/* 获取 Avatar头像 */
function xintheme_get_avatar( $id , $size='40' , $type=''){
	if($type==='qq'){
		$O = array(
			'ID'=>xintheme('xintheme_open_qq_id'),
			'KEY'=>xintheme('xintheme_open_qq_key')
		);
		$U = array(
			'ID'=>get_user_meta( $id, 'xintheme_qq_openid', true ),
			'TOKEN'=>get_user_meta( $id, 'xintheme_qq_access_token', true )
		);	
		if( $O['ID'] && $O['KEY'] && $U['ID'] && $U['TOKEN'] ){
			$avatar_url = 'https://q.qlogo.cn/qqapp/'.$O['ID'].'/'.$U['ID'].'/100';
		}	
	}else if($type==='weibo'){
		$O = array(
			'KEY'=>xintheme('xintheme_open_weibo_key'),
			'SECRET'=>xintheme('xintheme_open_weibo_secret')
		);
		$U = array(
			'ID'=>get_user_meta( $id, 'xintheme_weibo_openid', true ),
			'TOKEN'=>get_user_meta( $id, 'xintheme_weibo_access_token', true )
		);
		if( $O['KEY'] && $O['SECRET'] && $U['ID'] && $U['TOKEN'] ){
			$avatar_url = 'https://tp3.sinaimg.cn/'.$U['ID'].'/180/1.jpg';
		}
	}else if($type==='customize'){
		$avatar_url = get_bloginfo('url').'/wp-content/uploads/avatars/'.get_user_meta($id,'xintheme_customize_avatar',true);
	}else{
		return get_avatar( $id, $size );
	}
	return '<img src="'.$avatar_url.'" class="avatar" width="'.$size.'" height="'.$size.'" />';
}

//
function get_xintheme_get_avatar( $id , $size='40' , $type=''){
	if($type==='qq'){
		$O = array(
			'ID'=>xintheme('xintheme_open_qq_id'),
			'KEY'=>xintheme('xintheme_open_qq_key')
		);
		$U = array(
			'ID'=>get_user_meta( $id, 'xintheme_qq_openid', true ),
			'TOKEN'=>get_user_meta( $id, 'xintheme_qq_access_token', true )
		);	
		if( $O['ID'] && $O['KEY'] && $U['ID'] && $U['TOKEN'] ){
			$avatar_url = 'https://q.qlogo.cn/qqapp/'.$O['ID'].'/'.$U['ID'].'/100';
		}	
	}else if($type==='weibo'){
		$O = array(
			'KEY'=>xintheme('xintheme_open_weibo_key'),
			'SECRET'=>xintheme('xintheme_open_weibo_secret')
		);
		$U = array(
			'ID'=>get_user_meta( $id, 'xintheme_weibo_openid', true ),
			'TOKEN'=>get_user_meta( $id, 'xintheme_weibo_access_token', true )
		);
		if( $O['KEY'] && $O['SECRET'] && $U['ID'] && $U['TOKEN'] ){
			$avatar_url = 'https://tp3.sinaimg.cn/'.$U['ID'].'/180/1.jpg';
		}
	}else if($type==='customize'){
		$avatar_url = get_bloginfo('url').'/wp-content/uploads/avatars/'.get_user_meta($id,'xintheme_customize_avatar',true);
	}else{
		return get_avatar_url( $id, $size );
	}
	return $avatar_url;
}

/* Avatar头像类型 */
function xintheme_get_avatar_type($user_id){
	$id = (int)$user_id;
	if($id===0) return 'default';
	$avatar = get_user_meta($id,'xintheme_avatar',true);
	$customize = get_user_meta($id,'xintheme_customize_avatar',true);
	if( $avatar=='qq' && xintheme_is_open_qq($id) ) return 'qq';
	if( $avatar=='weibo' && xintheme_is_open_weibo($id) ) return 'weibo';
	if( $customize && !empty($customize) ) return 'customize';
	return 'default';
}


/* 获取全部分类（投稿使用） */
function get_cat_ids(){
	global $wpdb;
    $request = "SELECT $wpdb->terms.term_id FROM $wpdb->terms ";
    $request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
    $request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    $request .= " ORDER BY term_id asc";
    $categorys = $wpdb->get_results($request,ARRAY_N);
    $ids = array();
    foreach ($categorys as $category){
    	$ids[] .= $category[0];
    }
    return $ids;
}

/* 用户页面 文章翻页 */
function xintheme_paginate($wp_query=''){
	if(empty($wp_query)) global $wp_query;
	$pages = $wp_query->max_num_pages;
	if ( $pages >= 2 ):
		$big = 999999999;
		$paginate = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $pages,
			'prev_text' => __('<i class="iconfont icon-return"></i>'),
			'next_text' => __('<i class="iconfont icon-enter"></i>'),
			'type' => 'array'
		) );
		echo '<div class="mnmd-pagination"><div class="mnmd-pagination__links text-center">';
		foreach ($paginate as $value) {
			echo ''.$value.'';
		}
		echo '</div></div>';
	endif;
}

function xintheme_pager($current, $max){
	$paged = intval($current);
	$pages = intval($max);
	if($pages<2) return '';
	$pager = '<div class="pagination clx">';
		$pager .= '<div class="btn-group">';
			if($paged>1) $pager .= '<a class="btn btn-default" style="float:left;padding:6px 12px;" href="' . add_query_arg('page',$paged-1) . '">'.__('上一页','xintheme').'</a>';
			if($paged<$pages) $pager .= '<a class="btn btn-default" style="float:left;padding:6px 12px;" href="' . add_query_arg('page',$paged+1) . '">'.__('下一页','xintheme').'</a>';
		if ($pages>2 ){
			$pager .= '<div class="btn-group pull-right"><select class="form-control pull-right" onchange="document.location.href=this.options[this.selectedIndex].value;">';
				for( $i=1; $i<=$pages; $i++ ){
					$class = $paged==$i ? 'selected="selected"' : '';
					$pager .= sprintf('<option %s value="%s">%s</option>', $class, add_query_arg('page',$i), sprintf(__('第 %s 页','xintheme'), $i));
				}
			$pager .= '</select></div>';
		}
	$pager .= '</div></div>';
	return $pager;
}


/* AJAX 上传用户背景图像 */
function xintheme_change_cover(){
	$uid = isset($_POST['user'])?(int)$_POST['user']:0;
	if(!$uid) $uid = (int)get_current_user_id();
	if(!$uid) return;
	$cover = $_POST['cover'];
	update_user_meta($uid,'xintheme_cover',$cover);
	echo json_encode(array('success'=>1));
	exit;
}
add_action( 'wp_ajax_author_cover', 'xintheme_change_cover' );

/* 文章收藏 */
function xintheme_collect(){
	$pid = $_POST['pid'];
	$uid = $_POST['uid'];
	$action = $_POST['act'];
	if($action!='remove'){
		$collect = get_user_meta($uid,'xintheme_collect',true);
		$plus=1;
		if(!empty($collect)){
			$collect_arr = explode(',', $collect);
			if(in_array($pid, $collect_arr)){$plus=0;return;}
			$collect .= ','.$pid;
			update_user_meta($uid,'xintheme_collect',$collect);
		}else{
			$collect = $pid;
			update_user_meta($uid,'xintheme_collect',$collect);		
		}
		$collects = get_post_meta($pid,'xintheme_post_collects',true);
		$collects += $plus;
		$plus!=0?update_post_meta($pid,'xintheme_post_collects',$collects):'';
	}else{
		$plus = -1;
		$collect = get_user_meta($uid,'xintheme_collect',true);
		$collect_arr = explode(',', $collect);
		if(!in_array($pid, $collect_arr)){$plus=0;return;}
		$collect = xintheme_delete_string_specific_value(',',$collect,$pid);
		update_user_meta($uid,'xintheme_collect',$collect);
		$collects = get_post_meta($pid,'xintheme_post_collects',true);
		$collects--;
		update_post_meta($pid,'xintheme_post_collects',$collects);
	}
	echo $plus;
	exit;
}
add_action( 'wp_ajax_collect', 'xintheme_collect' );

/* 删除字段记录 */
function xintheme_delete_string_specific_value($separator,$string,$value){
	$arr = explode($separator,$string);
	$key =array_search($value,$arr);
	array_splice($arr,$key,1);
	$str_new = implode($separator,$arr);
	return $str_new;
}

/* 收藏按钮 */
function xintheme_post_activity_button(){
	$xintheme_collects=get_post_meta(get_the_ID(),'xintheme_post_collects',true);
	if(empty($xintheme_collects)):$xintheme_collects=0; endif;

	$uid = get_current_user_id();
	if(!empty($uid)&&$uid!=0){	
		$mycollects = get_user_meta($uid,'xintheme_collect',true);
		$mycollects = explode(',',$mycollects);
		$match = 0;
		foreach ($mycollects as $mycollect){
			if ($mycollect == get_the_ID()):$match++;endif;
		}		
		if ($match==0){
			$content .= '<a data-toggle="tooltip" data-placement="top" class="collect-btn collect-no remove-collect entry-action-btn" pid="'.get_the_ID().'" href="javascript:;" uid="'.get_current_user_id().'" title="点击收藏"><i class="iconfont icon-collection" style="vertical-align: middle;font-size: 20px !important;"></i><span>'.$xintheme_collects.'</span></a>';
		}else{
			$content .= '<a data-toggle="tooltip" data-placement="top" class="collect-btn collect-yes remove-collect entry-action-btn" href="javascript:;" pid="'.get_the_ID().'" uid="'.get_current_user_id().'" title="你已收藏，点击取消"><i class="iconfont icon-collection_fill" style="vertical-align: middle;font-size: 20px !important;"></i><span>'.$xintheme_collects.'</span></a>';
		}
	}else{
		$content .= '<a class="entry-action-btn" href="#login-modal" data-toggle="modal" data-target="#login-modal" title="你必须注册并登录才能收藏"><i class="iconfont icon-collection" style="vertical-align: middle;font-size: 20px !important;"></i><span>'.$xintheme_collects.'</span></a>';		
	}

	return $content;
}

/* 获取当前页面链接 */
/* function xintheme_get_current_page_url(){
	global $wp;
	return get_option( 'permalink_structure' ) == '' ? add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) : home_url( add_query_arg( array(), $wp->request ) );
} */
/* 获取当前页面链接 */
function xintheme_get_current_page_url(){
    $protocol = strtolower($_SERVER['REQUEST_SCHEME']);
    $ssl = $protocol=='https'?true:false;
    $port  = $_SERVER['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    return $protocol . '://' . $host . $port . $_SERVER['REQUEST_URI'];
}

/* 用户登录信息 */
function xintheme_update_latest_login( $login ) {
	$user = get_user_by( 'login', $login );
	$latest_login = get_user_meta( $user->ID, 'xintheme_latest_login', true );
	$latest_ip = get_user_meta( $user->ID, 'xintheme_latest_ip', true );
	update_user_meta( $user->ID, 'xintheme_latest_login_before', $latest_login );
	update_user_meta( $user->ID, 'xintheme_latest_ip_before', $latest_ip );
	update_user_meta( $user->ID, 'xintheme_latest_login', current_time( 'mysql' ) );
	update_user_meta( $user->ID, 'xintheme_latest_ip', $_SERVER['REMOTE_ADDR'] );
}
add_action( 'wp_login', 'xintheme_update_latest_login', 10, 1 );

/* 用户头像 */
function xintheme_resize( $ori ){
    if( preg_match('/^http:\/\/[a-zA-Z0-9]+/', $ori ) ){
        return $ori;
    }
    $info = xintheme_getImageInfo( AVATARS_PATH . $ori );
    if( $info ){
        //上传图片后切割的最大宽度和高度
        $dst_width = 140;
        $dst_height = 140;
        $scrimg = AVATARS_PATH . $ori;
        if( $info['type']=='jpg' || $info['type']=='jpeg' ){
            $im = imagecreatefromjpeg( $scrimg );
        }
        if( $info['type']=='gif' ){
            $im = imagecreatefromgif( $scrimg );
        }
        if( $info['type']=='png' ){
            $im = imagecreatefrompng( $scrimg );
        }
        if( $info['type']=='bmp' ){
            $im = imagecreatefromwbmp( $scrimg );
        }
        if( $info['width']<=$dst_width && $info['height']<=$dst_height ){
            return;
        } else {
            if( $info['width'] > $info['height'] ){
                $height = intval($info['height']);
                $width = $height;
                $x = ($info['width']-$width)/2;
                $y = 0;
            } else {
                $width = intval($info['width']);
                $height = $width;
                $x = 0;
                $y = ($info['height']-$height)/2;
            }

        }
        $newimg = imagecreatetruecolor( $width, $height );
        imagecopy($newimg,$im,0,0,$x,$y,$info['width'],$info['height']);
        $scale = $dst_width/$width;
        $target = imagecreatetruecolor($dst_width, $dst_height);
        $final_w = intval($width*$scale);
        $final_h = intval($height*$scale);
        imagecopyresampled( $target, $newimg, 0, 0, 0, 0, $final_w, $final_h, $width, $height );
        imagejpeg( $target, AVATARS_PATH . $ori );
        imagedestroy( $im );
        imagedestroy( $newimg );
        imagedestroy( $target );
    }
    return;
}
function xintheme_getImageInfo( $img ){
    $imageInfo = getimagesize($img);
    if( $imageInfo!== false) {
        $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]),1));
        $info = array(
                "width"     =>$imageInfo[0],
                "height"    =>$imageInfo[1],
                "type"      =>$imageType,
                "mime"      =>$imageInfo['mime'],
        );
        return $info;
    }else {
        return false;
    }
}

/* 作者链接中使用用户ID，而不是用户名 */
function xintheme_author_link($link, $author_id){
	global $wp_rewrite;
	$author_id = (int)$author_id;
	$link = $wp_rewrite->get_author_permastruct();
	if(empty($link)){
		$file = home_url('/');
		$link = $file.'?author='.$author_id;
	}else{
		$link = str_replace('%author%', $author_id, $link);
		$link = home_url(user_trailingslashit($link));
	}
	return $link;
}
add_filter('author_link','xintheme_author_link',10,2);

function xintheme_author_link_request($query_vars){
	if(array_key_exists('author_name', $query_vars)){
		global $wpdb;
		$author_id = $query_vars['author_name'];
		if($author_id){
			$query_vars['author'] = $author_id;
			unset($query_vars['author_name']);
		}
	}
	return $query_vars;
}
add_filter('request','xintheme_author_link_request');

/* Profile page fronted */
function xintheme_profile_page( $url ) {
    return is_admin() ? $url : xintheme_get_user_url('profile');
}
add_filter( 'edit_profile_url', 'xintheme_profile_page' );

/* 作者页面SEO相关 */
function xintheme_author_tab_no_robots(){
	if( is_author() && isset($_GET['tab']) ) wp_no_robots();
}
add_action('wp_head', 'xintheme_author_tab_no_robots');


if (xintheme('open_ucenter')) {//判断是否开启用户中心
/* 在文章编辑页面的[添加媒体]只显示用户自己上传的文件 */
	function xintheme_my_upload_media( $wp_query_obj ) {
		global $current_user, $pagenow;
		if( !is_a( $current_user, 'WP_User') )
		return;
		if( 'admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments' )
		return;
		if( !current_user_can( 'manage_options' ) && !current_user_can('manage_media_library') )
		$wp_query_obj->set('author', $current_user->ID );
		return;
	}
	add_action('pre_get_posts','xintheme_my_upload_media');

	/* 在[媒体库]只显示用户上传的文件 */
	function xintheme_my_media_library( $wp_query ) {
		if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) !== false ) {
			if ( !current_user_can( 'manage_options' ) && !current_user_can( 'manage_media_library' ) ) {
			global $current_user;
			$wp_query->set( 'author', $current_user->id );
			}
		}
	}
	add_filter('parse_query', 'xintheme_my_media_library' );
	/* 禁止非管理员用户访问后台 */
	if (xintheme('uesr_no_wpadmin')) {
		function xintheme_redirect_wp_admin(){
			$url = xintheme_get_current_page_url();
			if( (is_admin()&&!stripos($url,'media-upload.php')) && is_user_logged_in() && !current_user_can('edit_users') && ( !defined('DOING_AJAX') || !DOING_AJAX )  ){
				wp_redirect( xintheme_get_user_url('profile') );
				exit;
			}
		}
		add_action( 'init', 'xintheme_redirect_wp_admin' );
	}
	/* 非管理员用户前台编辑文章 */
    if (xintheme('uesr_no_wpadmin')) {
        function xintheme_edit_post_link($url, $post_id){
            if( !current_user_can('edit_users') ){
                $url = add_query_arg(array('action'=>'edit', 'id'=>$post_id), xintheme_get_user_url('post'));
            }
            return $url;
        }
        add_filter('get_edit_post_link', 'xintheme_edit_post_link', 10, 2);
    }
}//判断结束



//投稿文章通过时发送邮件通知投稿者
add_action( 'transition_post_status', 'xintheme_submit_post_notifications_send_email', 10, 3 );
function xintheme_submit_post_notifications_send_email( $new_status, $old_status, $post ) {

	// 通知管理员投稿人已提交了帖子
	if ( 'pending' === $new_status && user_can( $post->post_author, 'edit_posts' ) && ! user_can( $post->post_author, 'publish_posts' ) ) {
		//$pending_submission_email = xintheme( 'pending_submission_notification_admin_email' );
		//$admins                   = ( empty( $pending_submission_email ) ) ? get_option( 'admin_email' ) : $pending_submission_email;
		$admins                   = get_option( 'admin_email' );
		$edit_link                = get_edit_post_link( $post->ID, '' );
		$preview_link             = get_permalink( $post->ID ) . '&preview=true';
		$username                 = get_userdata( $post->post_author );
		$username_last_edit       = get_the_modified_author();
		$subject                  = __( '新的稿件待审核：', 'xintheme_submit_post_notifications' ) . '【' . $post->post_title . '】';
		$message                  = __( '你好，有新的稿件正在等待审核，请及时查看！', 'xintheme_submit_post_notifications' );
		$message                 .= "\r\n\r\n";
		$message                 .= __( '作者用户名', 'xintheme_submit_post_notifications' ) . '：' . $username->user_login . "\r\n\r\n";
		$message                 .= __( '文章标题', 'xintheme_submit_post_notifications' ) . '：' . $post->post_title . "\r\n\r\n";
		//$message                 .= __( '最后编辑者', 'xintheme_submit_post_notifications' ) . ': ' . $username_last_edit . "\r\n";
		$message                 .= __( '最后编辑日期', 'xintheme_submit_post_notifications' ) . '：' . $post->post_modified;
		$message                 .= "\r\n\r\n";
		$message                 .= __( '编辑发布稿件', 'xintheme_submit_post_notifications' ) . '：' . $edit_link . "\r\n\r\n";
		$message                 .= __( '预览稿件内容', 'xintheme_submit_post_notifications' ) . '：' . $preview_link;
		$result                   = wp_mail( $admins, $subject, $message );
	} 
	// 通知投稿用户，管理员已通过了他们的帖子
	elseif ( 'pending' === $old_status && 'publish' === $new_status && user_can( $post->post_author, 'edit_posts' ) && ! user_can( $post->post_author, 'publish_posts' ) ) {
		$username = get_userdata( $post->post_author );
		$url      = get_permalink( $post->ID );
		$subject  = __( '恭喜，你投稿的内容已通过审核！ ', 'xintheme_submit_post_notifications' );
		$message  = __( '你投稿的内容：', 'xintheme_submit_post_notifications' ) . '【' . $post->post_title . '】';
		$message .= "\r\n\r\n";
		$message .= $url;
		$result   = wp_mail( $username->user_email, $subject, $message );
	}
}