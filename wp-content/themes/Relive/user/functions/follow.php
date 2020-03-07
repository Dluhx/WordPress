<?php
/* Create database */
// user_id -> be followed
// follow_user_id -> follower
function xintheme_follow_install(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'xintheme_follow';   
    if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) :   
		$sql = " CREATE TABLE `$table_name` (
			`id` int NOT NULL AUTO_INCREMENT, 
			PRIMARY KEY(id),
			INDEX uid_index(user_id),
			INDEX fuid_index(follow_user_id),
			`user_id` int,
			`follow_user_id` int,
			`follow_status` int,
			`follow_time` datetime
		) ENGINE = MyISAM CHARSET=utf8;";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');   
			dbDelta($sql);   
    endif;
}
add_action( 'admin_menu', 'xintheme_follow_install' ); 

/* 关注 */
function xintheme_following($uid,$limits){
	$uid = (int)$uid;
	$limits = (int)$limits;
	if(!$uid) return 0;
	global $wpdb;
	$table_name = $wpdb->prefix . 'xintheme_follow';
	$results = $wpdb->get_results("SELECT * FROM $table_name WHERE follow_user_id='$uid' AND follow_status IN(1,2) ORDER BY follow_time DESC LIMIT $limits");
	return $results;
}

function xintheme_following_count($uid){
	$uid = (int)$uid;
	if(!$uid) return 0;
	global $wpdb;
	$table_name = $wpdb->prefix . 'xintheme_follow';
	$results = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE follow_user_id='$uid' AND follow_status IN(1,2)");
	return $results;
}

/* 粉丝 */
function xintheme_follower($uid,$limits){
	$uid = (int)$uid;
	$limits = (int)$limits;
	if(!$uid) return 0;
	global $wpdb;
	$table_name = $wpdb->prefix . 'xintheme_follow';
	$results = $wpdb->get_results("SELECT * FROM $table_name WHERE user_id='$uid' AND follow_status IN(1,2) ORDER BY follow_time DESC LIMIT $limits");
	return $results;
}

function xintheme_follower_count($uid){
	$uid = (int)$uid;
	if(!$uid) return 0;
	global $wpdb;
	$table_name = $wpdb->prefix . 'xintheme_follow';
	$results = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE user_id='$uid' AND follow_status IN(1,2)");
	return $results;
}

/* 关注/粉丝 用户列表 */
function xintheme_follow_list($uid,$limits,$type='follower'){
	if($type=='following'){$results = xintheme_following($uid,$limits);$field='user_id';} else {$results = xintheme_follower($uid,$limits);$field='follow_user_id';}
	$html = '';
	if($results)
		foreach($results as $result){
			global $wp_query;
			$user = get_userdata($result->$field);
			$username = $user->display_name;
			$xintheme_cover = get_user_meta($user->ID,"xintheme_cover",true);
			$xintheme_cover2 = THEME_DIR.'/static/images/user/3.png';
			$html .= '<li class="col-lg-4">';
			$html .= '<div class="ui-block">';
				$html .= '<div class="friend-item">';
					if(get_user_meta($user->ID,'xintheme_cover',true)){
						$html .= '<div class="friend-header-thumb" style="height:115px;background-size:cover;background-repeat:no-repeat;background-position:center center;background-image:url('.$xintheme_cover.')">';
					}else{
						$html .= '<div class="friend-header-thumb" style="height:115px;background-size:cover;background-repeat:no-repeat;background-position:center center;background-image:url('.$xintheme_cover2.')">';
					}
					$html .= '</div>';
					$html .= '<div class="friend-item-content">';
						$html .= '<div class="friend-avatar">';
							$html .= '<a class="author-thumb" href="'.xintheme_get_user_url('post',$user->ID).'">'.xintheme_get_avatar( $result->$field , '100' , xintheme_get_avatar_type($result->$field) ).'</a>';
							$html .= '<div class="author-content">';
								$html .= '<a href="'.xintheme_get_user_url('post',$user->ID).'" target="_blank" class="h5 author-name" title="'.$username.'">'.$username.'</a>';
								$html .= '<div class="country xin_hide">';
								if ($user->description){
									$html .= $user->description;
								}else{
									$html .= '我还没有学会写个人说明！';
								}
								$html .= '</div>';
							$html .= '</div>';							
						$html .= '</div>';
						$html .= '<div class="member-all-info">';
							$html .= '<div class="friend-count">';
								$html .= '<a href="'.xintheme_get_user_url('follow',$user->ID).'" class="friend-count-item"><div class="h6">'.xintheme_following_count($user->ID).'</div><div class="title">关注</div></a>';
								$html .= '<a href="'.xintheme_get_user_url('fans',$user->ID).'" class="friend-count-item"><div class="h6">'.xintheme_follower_count($user->ID).'</div><div class="title">粉丝</div></a>';
								$html .= '<a href="'.xintheme_get_user_url('post',$user->ID).'" class="friend-count-item"><div class="h6">'.count_user_posts($user->ID , 'post', false).'</div><div class="title">文章</div></a>';
							$html .= '</div>';
						$html .= '</div>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '</li>';

		}
	return $html;
}









/* AJAX follow & disfollow */
function xintheme_follow_unfollow(){
	date_default_timezone_set ('Asia/Shanghai');
	$followed = (int)$_POST['followed'];
	$follower = get_current_user_id();
	$action = isset($_POST['act'])&&$_POST['act']=='disfollow'?'disfollow':'follow';
	$success=0;
	$msg = '';
	$type = 0;
	//if ( !wp_verify_nonce( trim($_POST['wp_nonce']), 'check-nonce' ) ){
		//echo 'NonceIsInvalid';
		//die();
	//}
	if($follower&&$follower!=$followed){
		global $wpdb;
		$table_name = $wpdb->prefix . 'xintheme_follow';
		if($action=='disfollow'){
			$check = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE user_id='$followed' AND follow_user_id='$follower'");
			$status = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE user_id='$follower' AND follow_user_id='$followed' AND follow_status IN(1,2)");
			$status1 = 0;
			$status2 = $status?1:0;
			if($check){
				if($wpdb->query("UPDATE $table_name SET follow_status = '$status1' WHERE user_id='$followed' AND follow_user_id='$follower'")){
					$success = 1;
					$msg = '取消关注成功';
					$wpdb->query("UPDATE $table_name SET follow_status = '$status2' WHERE user_id='$follower' AND follow_user_id='$followed'");
				}else{$msg = '取消关注失败,请重试';}
			}else{
				$msg = '取消关注失败,你没有关注该用户';
			}
		}else{
			$check = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE user_id='$followed' AND follow_user_id='$follower'");
			$status = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE user_id='$follower' AND follow_user_id='$followed' AND follow_status IN(1,2)");
			$status1 = $status?2:1;
			$status2 = $status?2:0;
			$type = $status1;
			$time = current_time('mysql');
			if($check){
				if($wpdb->query("UPDATE $table_name SET follow_status = '$status1',follow_time = '$time' WHERE user_id='$followed' AND follow_user_id='$follower'")){
					$success = 1;
					$msg = '关注成功';
					$wpdb->query("UPDATE $table_name SET follow_status = '$status2' WHERE user_id='$follower' AND follow_user_id='$followed'");
				}else{$msg = '关注失败,请重试';}
			}else{
				if($wpdb->query( "INSERT INTO $table_name (user_id,follow_user_id,follow_status,follow_time) VALUES ('$followed', '$follower', '$status1', '$time')" )){
					$success = 1;
					$msg = '关注成功';
					$wpdb->query("UPDATE $table_name SET follow_status = '$status2' WHERE user_id='$follower' AND follow_user_id='$followed'");
				}else{$msg = '关注失败,请重试';}
			}
		}

	}
	$return = json_encode(array('success'=>$success,'msg'=>$msg,'type'=>$type));
	echo $return;
	exit;
}
add_action( 'wp_ajax_follow', 'xintheme_follow_unfollow' );
add_action( 'wp_ajax_nopriv_follow', 'xintheme_follow_unfollow' );

/* 关注按钮 */
function xintheme_follow_button($uid){
	$uid = (int)$uid;
	$cuid = get_current_user_id();
	if($uid==0)return;
	global $wpdb;
	$table_name = $wpdb->prefix . 'xintheme_follow';
	$check = $wpdb->get_row("SELECT * FROM $table_name WHERE user_id='$uid' AND follow_user_id='$cuid' AND follow_status IN(1,2)");

	if ( is_user_logged_in() ) {
		if($check){
			if($check->follow_status==2){$button = '<span data-uid="'.$uid.'" data-act="disfollow" class="follow-btn followed"><i class="fa fa-exchange"></i>互相关注</span>';}else{$button = '<span data-uid="'.$uid.'" data-act="disfollow" class="follow-btn followed"><i class="fa fa-check"></i>已关注</span>';}
		}else{
			$button = '<span data-uid="'.$uid.'" data-act="follow" class="follow-btn unfollowed"><i class="fa fa-plus"></i>关 注</span>';
		}
	}else{
		$button = '<span data-toggle="modal" data-target="#login-modal" data-uid="'.$uid.'" data-act="follow" class="follow-btn unfollowed"><i class="fa fa-plus"></i>关 注</span>';
	}
	
	return $button;
}