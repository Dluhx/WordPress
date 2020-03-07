<?php 
if( !is_user_logged_in() ){
    wp_safe_redirect( get_option('home') );
    die();
}

$current_user = wp_get_current_user();
$user_id = get_current_user_id();

$action = get_query_var('action') ?: 'posts';

$action_file = get_template_directory().'/user/action/'.$action.'.php';

if(!is_file($action_file)){
    include(get_template_directory().'/404.php');
    exit;
}

add_action('wp_head',function(){
    ?>
    <style>.widget ul li a {font-size: 14px;padding: 15px 1px 15px;margin-top: 0 !important;width: 100%;}
    .widget.widget_categories ul li{border-bottom: 1px solid #f1f1f1;}
    .widget.widget_categories ul li:last-child {border-bottom: none;}
    .widget-area .widget-title {font-size: 18px;}
    .widget ul li i{border-left: 3px solid var(--accent-color);padding-right: 10px;}
    @media (max-width:767px){.col-lg-9 {padding-left: 20px !important;padding-right: 20px !important;margin-top: 30px !important;}
    .tougao {padding: 20px !important;}
    aside.widget-area {margin-top: 0px !important;}
    .grid-item {padding: 0 !important;}
    .col-lg-9 .posts-wrapper {padding: 20px !important;}
    .col-sm-2,.col-sm-4{padding: 0 !important;}
    .form-horizontal {padding-top: 0 !important;}
    .form-group .col-sm-9 {padding: 0 !important;}
    }
    </style>
    <?php
});

get_header();
?>
<div class="site-content container">
	<div class="row">
		<div class="col-lg-3">
			<aside class="widget-area">
				<section class="widget widget_categories"><h5 class="widget-title">用户中心</h5>
					<ul>
                        <li><a href="<?php echo home_url(user_trailingslashit('/user/contribute')); ?>"><?php if($action == 'contribute') echo '<i></i>';?>我要投稿</a></li>
                        <li><a href="<?php echo home_url(user_trailingslashit('/user/posts')); ?>"><?php if($action == 'posts') echo '<i></i>';?>我的文章</a></li>
                        <li><a href="<?php echo home_url(user_trailingslashit('/user/comments')); ?>"><?php if($action == 'comments') echo '<i></i>';?>我的评论</a></li>
                        <li><a href="<?php echo home_url(user_trailingslashit('/user/profile')); ?>"><?php if($action == 'profile') echo '<i></i>';?>账号信息</a></li>
                        <li><a href="<?php echo home_url(user_trailingslashit('/user/password')); ?>"><?php if($action == 'password') echo '<i></i>';?>修改密码</a></li>
                        <li><a href="<?php echo wp_logout_url( home_url() ); ?>">退出登录</a></li>
					</ul>
				</section>
			</aside>
		</div>

        <?php  include($action_file);?>

       </div>
    </div>
<?php get_footer();?>