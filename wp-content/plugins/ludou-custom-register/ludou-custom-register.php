<?php
/*
Plugin Name: Ludou Custom User Register
Plugin URI: http://www.ludou.org/wordpress-ludou-custom-user-register.html
Description: 修改默认的后台用户注册表单，用户可以自行输入密码，不必用Email接收密码，跳过Email验证。
Version: 2.0.3
Author: Ludou
Author URI: http://www.ludou.org
*/

if (!isset($_SESSION)) {
 	session_start();
	session_regenerate_id();
}

/**
 * 后台注册模块，添加注册表单,修改新用户通知。
 */
if ( !function_exists('wp_new_user_notification') ) :
/**
 * Notify the blog admin of a new user, normally via email.
 *
 * @since 2.0
 *
 * @param int $user_id User ID
 * @param string $plaintext_pass Optional. The user's plaintext password
 */
function wp_new_user_notification($user_id, $plaintext_pass = '', $flag='') {
	if(func_num_args() > 1 && $flag !== 1)
		return;

	$user = new WP_User($user_id);

	$user_login = stripslashes($user->user_login);
	$user_email = stripslashes($user->user_email);

	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
	// we want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

	$message  = sprintf(__('New user registration on your site %s:'), $blogname) . "\r\n\r\n";
	$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
	$message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

	@wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message);
	
	if ( empty($plaintext_pass) )
		return;

	// 你可以在此修改发送给用户的注册通知Email
	$message  = sprintf(__('Username: %s'), $user_login) . "\r\n";
	$message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n";
	$message .= '登陆网址: ' . wp_login_url() . "\r\n";

	// sprintf(__('[%s] Your username and password'), $blogname) 为邮件标题
	wp_mail($user_email, sprintf(__('[%s] Your username and password'), $blogname), $message);
}
endif;

/* 修改注册表单 */
function ludou_show_password_field() {
  // 生成token，防止跨站攻击
	$token = md5(uniqid(rand(), true));
	
	$_SESSION['ludou_register_584226_token'] = $token;
	
?>
<p>
	<label>密码(至少6位)<br/>
		<input id="user_pwd1" class="input" type="password" size="25" value="<?php echo $_POST['user_pass']; ?>" name="user_pass"/>
	</label>
</p>
<p>
	<label>重复密码<br/>
		<input id="user_pwd2" class="input" type="password" size="25" value="<?php echo $_POST['user_pass2']; ?>" name="user_pass2" />
	</label>
</p>
<input type="hidden" name="spam_check" value="<?php echo $token; ?>" />
<?php
}

/* 处理表单提交的数据 */
function ludou_check_fields($login, $email, $errors) {
  if(empty($_POST['spam_check']) || $_POST['spam_check'] != $_SESSION['ludou_register_584226_token'])
		$errors->add('spam_detect', "<strong>错误</strong>：请勿恶意注册");
		
	global $wpdb;
	$last_reg = $wpdb->get_var("SELECT `user_registered` FROM `$wpdb->users` ORDER BY `user_registered` DESC LIMIT 1");

	if ( (time() - strtotime($last_reg)) < 60 )
		$errors->add('anti_spam', "<strong>错误</strong>：先歇会，稍后再注册，谢谢您的理解");
		
	if(strlen($_POST['user_pass']) < 6)
		$errors->add('password_length', "<strong>错误</strong>：密码长度至少6位");
	elseif($_POST['user_pass'] != $_POST['user_pass2'])
		$errors->add('password_error', "<strong>错误</strong>：两次输入的密码必须一致");
}

/* 保存表单提交的数据 */
function ludou_register_extra_fields($user_id, $password="", $meta=array()) {
	$userdata = array();
	$userdata['ID'] = $user_id;
	$userdata['user_pass'] = $_POST['user_pass'];

	wp_new_user_notification( $user_id, $_POST['user_pass'], 1 );
	wp_update_user($userdata);
}

function remove_default_password_nag() {
	global $user_ID;
	delete_user_setting('default_password_nag', $user_ID);
	update_user_option($user_ID, 'default_password_nag', false, true);
}

function ludou_register_change_translated_text( $translated_text, $untranslated_text, $domain ) {
  if ( $untranslated_text === 'A password will be e-mailed to you.' || $untranslated_text === 'Registration confirmation will be emailed to you.' )
    return '';
  else if ($untranslated_text === 'Registration complete. Please check your e-mail.' || $untranslated_text === 'Registration complete. Please check your email.')
    return '注册成功！';
  else
    return $translated_text;
}

add_filter('gettext', 'ludou_register_change_translated_text', 20, 3);
add_action('admin_init', 'remove_default_password_nag');
add_action('register_form','ludou_show_password_field');
add_action('register_post','ludou_check_fields',10,3);
add_action('user_register', 'ludou_register_extra_fields');

?>