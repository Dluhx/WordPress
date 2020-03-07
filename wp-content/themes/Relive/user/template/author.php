<?php
global $wp_query;
// Current author
$curauth = $wp_query->get_queried_object();
$user_name = filter_var($curauth->user_url, FILTER_VALIDATE_URL) ? '<a href="'.$curauth->user_url.'" target="_blank" rel="external">'.$curauth->display_name.'</a>' : $curauth->display_name;
$user_info = get_userdata($curauth->ID);
$posts_count =  $wp_query->found_posts;
$comments_count = get_comments( array('status' => '1', 'user_id'=>$curauth->ID, 'count' => true) );
$collects = $user_info->xintheme_collect?$user_info->xintheme_collect:0;
$collects_array = explode(',',$collects);
$collects_count = $collects!=0?count($collects_array):0;
// Current user
$current_user = wp_get_current_user();
// Myself?
$oneself = $current_user->ID==$curauth->ID || current_user_can('edit_users') ? 1 : 0;
// Admin ?
$admin = $current_user->ID==$curauth->ID&&current_user_can('edit_users') ? 1 : 0;
// Tabs
$top_tabs = array(
	'post' => __('文章','xintheme')."($posts_count)",
	'comment' => __('评论','xintheme')."($comments_count)",
	'collect' => __('收藏','xintheme')."($collects_count)",
	'follow' => __('关注','xintheme')."($follow_count)",
	'fans' => __('粉丝','xintheme')."($fans_count)",
);

$manage_tabs = array(
	'profile' => __('个人资料','xintheme')
);

$other_tabs = array(
	'following' => __('关注','xintheme'),
	'follower' => __('粉丝','xintheme')
);

$tabs = array_merge($top_tabs,$manage_tabs,$other_tabs);
foreach( $tabs as $tab_key=>$tab_value ){
	if( $tab_key ) $tab_array[] = $tab_key;
}

// Current tab
$get_tab = isset($_GET['tab']) && in_array($_GET['tab'], $tab_array) ? $_GET['tab'] : 'post';

// 提示
$message = $pages = '';
if($get_tab=='profile' && ($current_user->ID!=$curauth->ID && current_user_can('edit_users')) ) $message = sprintf(__('你正在查看的是%s的资料，修改请慎重！', 'xintheme'), $curauth->display_name);

	//~ 页码start
	$paged = max( 1, get_query_var('page') );
	$number = get_option('posts_per_page', 10);
	$offset = ($paged-1)*$number;
	//~ 页码end

	//$item_html = '<li class="tip">'.__('没有找到记录','xintheme').'</li>';
	$item_html = sprintf( __('发表了 %s 篇文章', 'xintheme'), $posts_count );

	//~ 个人资料
if( $oneself ){
	$user_id = $curauth->ID;
	$avatar = $user_info->xintheme_avatar;
	$qq = xintheme_is_open_qq();
	$weibo = xintheme_is_open_weibo();
	if( isset($_POST['update']) && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) {
		$message = __('没有发生变化','xintheme');	
		$update = sanitize_text_field($_POST['update']);
		if($update=='info'){
			$update_user_id = wp_update_user( array(
				'ID' => $user_id, 
				'weibo' => $_POST['weibo'],
				'qq' => $_POST['qq'],
				'weixin' => $_POST['weixin'],
				'nickname' => sanitize_text_field($_POST['display_name']),
				'display_name' => sanitize_text_field($_POST['display_name']),
				'user_url' => esc_url($_POST['siteurl']),
				'description' => $_POST['description'],
				'gender' => $_POST['gender']
			 ) );
			if (($_FILES['file']['error'])==0&&!empty($_FILES['file'])) {
				define( 'AVATARS_PATH', ABSPATH.'/wp-content/uploads/avatars/' );
				$filetype=array("jpg","gif","bmp","jpeg","png");
    			$ext = pathinfo($_FILES['file']['name']);
    			$ext = strtolower($ext['extension']);
    			$tempFile = $_FILES['file']['tmp_name'];
    			$targetPath   = AVATARS_PATH;
    			if( !is_dir($targetPath) ){
        			mkdir($targetPath,0755,true);
    			}
    			$time = date("YmdHis");
    			$new_file_name = 'avatar-'.$user_id.'-'.$time.'.'.$ext;
    			$targetFile = $targetPath . $new_file_name;
    			if(!in_array($ext, $filetype)){
    				$message = __('仅允许上传JPG、GIF、BMP、PNG图片','xintheme');
    			}else{
    				move_uploaded_file($tempFile,$targetFile);
    				if( !file_exists( $targetFile ) ){
	        			$message = __('图片上传失败','xintheme');
    				} elseif( !$imginfo=xintheme_getImageInfo($targetFile) ) {
        				$message = __('图片不存在','xintheme');
    				} else {
        				$img = $new_file_name;
        				xintheme_resize($img);
        				$message = __('头像上传成功','xintheme');
        				$update_user_avatar = update_user_meta( $user_id , 'xintheme_avatar', 'customize');
						$update_user_avatar_img = update_user_meta( $user_id , 'xintheme_customize_avatar', $img);
   	 				}
   	 			}
			} else {
	    		$update_user_avatar = update_user_meta( $user_id , 'xintheme_avatar', sanitize_text_field($_POST['avatar']) );
				if ( ! is_wp_error( $update_user_id ) || $update_user_avatar ) $message = __('基本信息已更新','xintheme');	
			}
		}

		if($update=='pass'){
			$data = array();
			$data['ID'] = $user_id;
			$data['user_email'] = sanitize_text_field($_POST['email']);
			if( !empty($_POST['pass1']) && !empty($_POST['pass2']) && $_POST['pass1']===$_POST['pass2'] ) $data['user_pass'] = sanitize_text_field($_POST['pass1']);
			$user_id = wp_update_user( $data );
			if ( ! is_wp_error( $user_id ) ) $message = __('安全信息已更新','xintheme');
		}
		
		//$message .= ' <a href="'.xintheme_get_current_page_url().'">'.__('点击刷新','xintheme').'</a>';
		
		$user_info = get_userdata($curauth->ID);
	}
}
//~ 个人资料end
	
	
//~ 投稿start

if( isset($_GET['action']) && in_array($_GET['action'], array('new', 'edit')) && $oneself ){
	
	if( isset($_GET['id']) && is_numeric($_GET['id']) && get_post($_GET['id']) && intval(get_post($_GET['id'])->post_author) === get_current_user_id() ){
		$action = 'edit';
		$the_post = get_post($_GET['id']);
		$post_title = $the_post->post_title;
		$post_content = $the_post->post_content;
		foreach((get_the_category($_GET['id'])) as $category) { 
			$post_cat[] = $category->term_id; 
		}
	}else{
		$action = 'new';
		$post_title = !empty($_POST['post_title']) ? $_POST['post_title'] : '';
		$post_content = !empty($_POST['post_content']) ? $_POST['post_content'] : '';
		$post_cat = !empty($_POST['post_cat']) ? $_POST['post_cat'] : array();
	}

	if( isset($_POST['action']) && trim($_POST['action'])=='update' && wp_verify_nonce( trim($_POST['_wpnonce']), 'check-nonce' ) ) {
		
		$title = sanitize_text_field($_POST['post_title']);
		$content = $_POST['post_content'];
		$cat = (!empty($_POST['post_cat'])) ? $_POST['post_cat'] : '';
		$tougao_tnumber = xintheme('tougao_tnumber');
		
		if( $title && $content ){
			
			if( mb_strlen($content,'utf8') < $tougao_tnumber ){
				
				$message = __('提交失败，文章内容至少140字。','xintheme');
				
			}else{
				
				$status = sanitize_text_field($_POST['post_status']);
				
				if( $action==='edit' ){

					$new_post = wp_update_post( array(
						'ID' => intval($_GET['id']),
						'post_title'    => $title,
						'post_content'  => $content,
						'post_status'   => ( $status==='pending' ? 'pending' : 'draft' ),
						'post_author'   => get_current_user_id(),
						'post_category' => $cat
					) );

				}else{

					$new_post = wp_insert_post( array(
						  'post_title'    => $title,
						  'post_content'  => $content,
						  'post_status'   => ( $status==='pending' ? 'pending' : 'draft' ),
						  'post_author'   => get_current_user_id(),
						  'post_category' => $cat
						) );

				}
				
				if( is_wp_error( $new_post ) ){
					$message = __('操作失败，请重试或联系管理员。','xintheme');
				}else{
					
					//update_post_meta( $new_post, 'xintheme_copyright_content', htmlspecialchars($_POST['post_copyright']) );
					
					wp_redirect(xintheme_get_user_url('post'));
				}

			}
		}else{
			$message = __('投稿失败，标题和内容不能为空！','xintheme');
		}
	}
}
//~ 投稿end

?>
<!-- Header -->
<?php get_header(); ?>
<style>.site-wrapper {background-color: #f5f6f9;}
<?php if( isset($_GET['action']) && in_array($_GET['action'], array('new', 'edit')) ) echo '#tab-bar li.current.post a{color: #333;background-color: #0000;}'; ?>
</style>
<!-- Main Wrap -->
<div id="main-wrap">
	<div class="bd clx" id="author-page">
	<!-- Cover -->
	<div id="cover">
		<img src="<?php if(get_user_meta($curauth->ID,'xintheme_cover',true)) echo get_user_meta($curauth->ID,'xintheme_cover',true); else echo xintheme('default_user_cover_img'); ?>" alt="个人封面">
			<?php if($current_user->ID==$curauth->ID){ ?><a href="#" id="custom-cover">自定义封面</a><?php } ?>
	</div>
	<!-- Cover change -->
	<div id="cover-change">
		<div id="cover-c-header"><strong>自定义封面</strong><a href="#" id="cover-close"><i class="iconfont icon-close"></i></a></div>
		<div id="cover-list">
			<div id="cover-change-inner">
				<ul class="clx">
				<?php
					$user_cover = xintheme('user_cover');
					if(!empty($user_cover)){ ?>
					<?php foreach ( xintheme('user_cover') as $value ):?>
					<li><a href="#" class="basic"><img src="<?php echo $value['user_cover_img'];?>" width="240" height="64"></a></li>
					<?php endforeach;?>
				<?php }else{ ?>
					<li><a href="#" class="basic"><img src="<?php echo xintheme('default_user_cover_img'); ?>" width="240" height="64"></a></li>
				<?php } ?>
				</ul>
				<div id="cover-c-footer">
					<a href="#" id="cover-sure" curuserid="<?php echo $current_user->ID; ?>">确定</a>
					<a href="#" id="cover-cancle">取消</a>
				</div>
				<script type="text/javascript">var default_cover = "<?php echo xintheme('default_user_cover_img'); ?>";</script>
			</div>
		</div>	
	</div>
	<!-- Author info -->
	<div id="ai">
		<div id="avatar-wrap">
			<?php echo xintheme_get_avatar( $curauth->ID , '140' , xintheme_get_avatar_type($curauth->ID) ); ?>
			<div id="num-info">
				<div>
					<a href="<?php echo xintheme_get_user_url('follow',$curauth->ID); ?>" title="关注">
						<span class="num"><?php echo xintheme_following_count($curauth->ID); ?></span><span class="text">关注</span>
					</a>
				</div>
				<div>
					<a href="<?php echo xintheme_get_user_url('fans',$curauth->ID); ?>" title="粉丝">
						<span class="num"><?php echo xintheme_follower_count($curauth->ID); ?></span><span class="text">粉丝</span>
					</a>
				</div>
				<div>
					<a href="<?php echo xintheme_get_user_url('post',$curauth->ID); ?>" title="文章">
						<span class="num"><?php echo $posts_count; ?></span><span class="text">文章</span>
					</a>
				</div>
			</div>
		</div>
		<div class="name"><?php echo $curauth->display_name; ?></div>
		<?php if($curauth->gender=='女') echo '<i class="iconfont icon-nv1" style="color: #FF88AF;font-size: 17px !important;"></i>'; else echo '<i class="iconfont icon-nan1" style="color: #00b6f8;font-size: 17px !important;"></i>'; ?>
		<div class="des"><?php $description = $curauth->description;echo $description ? $description : __('我还没有学会写个人说明！','xintheme'); ?></div>
		<?php if($curauth->ID!=$current_user->ID){ ?>
		<div class="fp-btns">
		<?php echo xintheme_follow_button($curauth->ID); ?>
		<span class="pm-btn"><a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo $user_info->user_email;?>" target="_blank" title="发私信">发私信</a></span>
		</div>
		<?php }else{ ?>
		<?php if($current_user->ID){ ?><a href="<?php echo xintheme_get_user_url('profile'); ?>" class="edit-btn" title="编辑个人资料">编辑个人资料</a><?php } ?>
		<?php } ?>
	</div>
	<!-- Main content -->
	<div id="mc">
		<div id="mc-body">
			<div id="mc-bdinner">
			<?php if(!isset($_GET['action'])||($_GET['action']!='edit'&&$_GET['action']!='new')) $cls = 'part'; else $cls = 'full'; ?>
				<div id="mc-body-box" class="clx <?php echo $cls; ?>">
					<!-- Left content -->
					<div id="lc">
						<div id="tab-bar">
							<ul class="clx">
								<li class="<?php if(!isset($_GET['tab'])||(isset($_GET['tab'])&&$_GET['tab']=='post')) echo 'current post'; ?>"><a class="tab-post" href="<?php echo xintheme_get_user_url('post',$curauth->ID); ?>" title="文章">文章</a></li>
								<li class="<?php if(isset($_GET['tab'])&&$_GET['tab']=='comment') echo 'current'; ?>"><a class="tab-comment" href="<?php echo xintheme_get_user_url('comment',$curauth->ID); ?>" title="评论">评论</a></li>
								<li class="<?php if(isset($_GET['tab'])&&$_GET['tab']=='collect') echo 'current'; ?>"><a class="tab-collect" href="<?php echo xintheme_get_user_url('collect',$curauth->ID); ?>" title="收藏">收藏</a></li>
								<li class="<?php if(isset($_GET['tab'])&&$_GET['tab']=='follow') echo 'current'; ?>"><a class="tab-follow" href="<?php echo xintheme_get_user_url('follow',$curauth->ID); ?>" title="关注">关注</a></li>
								<li class="<?php if(isset($_GET['tab'])&&$_GET['tab']=='fans') echo 'current'; ?>"><a class="tab-fans" href="<?php echo xintheme_get_user_url('fans',$curauth->ID); ?>" title="粉丝">粉丝</a></li>
								<div class="clear"></div>
							</ul>
						</div>
						<div id="tab-content">
						<!-- Page global message -->
						<?php if($message) echo '<div class="alert alert-success">'.$message.'</div>'; ?>
						<!-- Tab-post -->

						<?php if( $get_tab=='post' ) {
							$can_post_cat = get_cat_ids()?get_cat_ids():0;
							$cat_count = $can_post_cat!=0?count($can_post_cat):0;
							if( isset($_GET['action']) && in_array($_GET['action'], array('new', 'edit')) && $cat_count && is_user_logged_in() && $oneself && current_user_can('edit_posts') ){
								if( xintheme('tougao') ){
									if( xintheme('tougao_describe') ){
										echo '<ul class="user-msg"><li class="tip">'.xintheme('tougao_describe').'</ul></li>';
									}else{
										echo '<ul class="user-msg"><li class="tip">'.__('请不要发布垃圾文章，如有发现，封号处理...','xintheme').'</ul></li>';
									}
								}
						?>
						<?php if( xintheme('tougao') ){?>
						<article class="panel panel-default <?php if(!isset($_GET['action'])) echo 'archive'; ?>" role="main">
							<div class="panel-body" style="padding:0;">
							<h3 class="page-header"><?php _e('投稿','xintheme');?> <small><?php _e('POST NEW','xintheme');?></small></h3>
							<form role="form" method="post">
								<div class="form-group">
									<input type="text" class="form-control" name="post_title" placeholder="<?php _e('在此输入标题','xintheme');?>" value="<?php echo $post_title;?>" aria-required='true' required>
								</div>
								<div class="form-group">
								<?php wp_editor(  wpautop($post_content), 'post_content', array('media_buttons'=>true, 'quicktags'=>true, 'editor_class'=>'form-control', 'editor_css'=>'<style>.wp-editor-container{border:1px solid #ddd;}.switch-html, .switch-tmce{height:25px !important}</style>' ) ); ?>
								</div>
								<div class="form-group">
								<?php
									$can_post_cat = get_cat_ids();
									if($can_post_cat){
										$post_cat_output = '<p class="help-block">'.__('选择文章分类', 'xintheme').'</p>';
										$post_cat_output .= '<select name="post_cat[]" class="form-control">';
										foreach ( $can_post_cat as $term_id ) {
											$category = get_category( $term_id );
											//~ if( (!empty($post_cat)) && in_array($category->term_id,$post_cat)) 
											$post_cat_output .= '<option value="'.$category->term_id.'">'.$category->name.'</option>';
										}
										$post_cat_output .= '</select>';
										echo $post_cat_output;
									}
								?>
								</div>
								<div class="form-group text-right">
									<select name="post_status" style="width: auto;">
										<option value ="pending"><?php _e('提交审核','xintheme');?></option>
										<option value ="draft"><?php _e('保存草稿','xintheme');?></option>
									</select>
									<input type="hidden" name="action" value="update">
									<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
									<button type="submit" class="btn btn-success" style="margin-top:5px;"><?php _e('确认操作','xintheme');?></button>
								</div>	
							</form>
							</div>
			 			</article>
			 			<?php }?>
					<?php }else{
					if($cat_count){
						if( xintheme('tougao') ){
							$item_html = sprintf( __('现有 %s 个分类接受投稿。', 'xintheme'), $cat_count );
							if( is_user_logged_in() && !current_user_can('edit_posts') ){
								$item_html .= __('遗憾的是，你现在登录的账号没有投稿权限！', 'xintheme');	
							}else{
								
								if ( is_user_logged_in() ) {
									$item_html .= '<a href="'.add_query_arg(array('tab'=>'post','action'=>'new'), get_author_posts_url($current_user->ID)).'">'.__('点击投稿', 'xintheme').'</a>';
								}else{
									$item_html .= '<a href="#login-modal" data-toggle="modal" data-target="#login-modal">'.__('登录后投稿', 'xintheme').'</a>';
								}
								
							}
						}
					}else{
						if( have_posts() ) $item_html = sprintf( __('发表了 %s 篇文章', 'xintheme'), $posts_count );
					}
					echo '<ul class="user-msg"><li class="tip">'.$item_html.'</ul></li>';
					echo '<div class="posts-list list-space-md list-seperated">';
					global $wp_query;
					$args = is_user_logged_in() ? array_merge( $wp_query->query_vars, array( 'post_status' => array( 'publish', 'pending', 'draft' ) ) ) : $wp_query->query_vars;
					query_posts( $args );
					while ( have_posts() ) : the_post();
						include(TEMPLATEPATH.'/user/template/content-archive.php');
					endwhile; // end of the loop. 
					echo '</div>';
					xintheme_paginate();
					wp_reset_query();
				}
			}
			?>
		<!-- End Tab-post -->
		<!-- Tab-comment -->
		<?php 
		if( $get_tab=='comment' ) {
			$comments_status = $oneself ? '' : 'approve';
			$all = get_comments( array('status' => '', 'user_id'=>$curauth->ID, 'count' => true) );
			$approve = get_comments( array('status' => '1', 'user_id'=>$curauth->ID, 'count' => true) );
			$pages = $oneself ? ceil($all/$number) : ceil($approve/$number);
			$comments = get_comments(array('status' => $comments_status,'order' => 'DESC','number' => $number,'offset' => $offset,'user_id' => $curauth->ID));
		if($comments){
			$item_html = '<li class="tip">' . sprintf(__('共有 %1$s 条评论，其中 %2$s 条已获准， %3$s 条正等待审核。','xintheme'),$all, $approve, $all-$approve) . '</li>';
		foreach( $comments as $comment ){
			$item_html .= ' <li>';
			if($comment->comment_approved!=1) $item_html .= '<small class="text-danger">'.__( '这条评论正在等待审核','xintheme' ).'</small>';
			$item_html .= '<div class="message-content">'.$comment->comment_content . '</div>';
			$item_html .= '<a class="info" href="'.htmlspecialchars( get_comment_link( $comment->comment_ID) ).'">'.sprintf(__('%1$s  发表在  %2$s','xintheme'),$comment->comment_date,get_the_title($comment->comment_post_ID)).'</a>';
			$item_html .= '</li>';
		}
		if($pages>1) $item_html .= '<li class="tip">'.sprintf(__('第 %1$s 页，共 %2$s 页，每页显示 %3$s 条。','xintheme'),$paged, $pages, $number).'</li>';
		}
		echo '<ul class="user-msg">'.$item_html.'</ul>';
		echo xintheme_pager($paged, $pages);
		}
		?>
		<!-- End Tab-comment -->
		<!-- Tab-collect -->
		<?php 
			if( $get_tab=='collect'){
			$item_html = '<li class="tip">'.__('共收藏了 ','xintheme').$collects_count.' 篇文章</li>';
			echo '<ul class="user-msg">'.$item_html.'</ul>';
			//global $wp_query;
			//$args = array_merge( $wp_query->query_vars, array( 'post__in' => $collects_array, 'post_status' => 'publish' ) );
			echo '<div class="posts-list list-space-md list-seperated">';
			query_posts( array( 'post__not_in'=>get_option('sticky_posts'), 'post__in' => $collects_array, 'post_status' => 'publish' ) );
			while ( have_posts() ) : the_post();
			include(TEMPLATEPATH.'/user/template/content-archive.php');
			endwhile; // end of the loop. 
			echo '</div>';
			xintheme_paginate();
			wp_reset_query();
			}
		?>
		<!-- End Tab-collect -->

		<!--关注-->
		<?php
			if( $get_tab=='follow'){ 
			$item_html = '<li class="tip">'.__('共关注了 ','xintheme').xintheme_following_count($curauth->ID).' 个用户</li>';
			echo '<ul class="user-msg">'.$item_html.'</ul>';
			echo '<ul class="flowlist following-list clx">';
			echo xintheme_follow_list($curauth->ID,20,'following');
			echo '</ul>';
			}
		?>
		<!--关注结束-->
		
		<!--粉丝-->
		<?php
			if( $get_tab=='fans'){
			$item_html = '<li class="tip">'.__('共有 ','xintheme').xintheme_follower_count($curauth->ID).' 个粉丝</li>';
			echo '<ul class="user-msg">'.$item_html.'</ul>';
			echo '<ul class="flowlist followers-list clx">';
			echo xintheme_follow_list($curauth->ID,20);
			echo '</ul>';
			}
		?>
		<!--粉丝结束-->
		
		<!-- Tab-profile -->
		<?php
			if( $get_tab=='profile' ) {

		$avatar_type = array(
			'default' => __('默认头像', 'xintheme'),
			'qq' => __('腾讯QQ头像', 'xintheme'),
			'weibo' => __('新浪微博头像', 'xintheme'),
			'customize' => __('自定义头像', 'xintheme'),
		);
		
		$days_num = round(( strtotime(date('Y-m-d')) - strtotime( $user_info->user_registered ) ) /3600/24);
		
		echo '<ul class="user-msg"><li class="tip">'.sprintf(__('%s来%s已经%s天了', 'xintheme') , $user_info->display_name, get_bloginfo('name'), ( $days_num>1 ? $days_num : 1 ) ).'</li></ul>';
		
	if( $oneself ){
		
	?>

<form id="info-form" class="form-horizontal" role="form" method="POST" action="">
	<input type="hidden" name="update" value="info">
	<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
			<div class="page-header">
				<h3 id="info"><?php _e('基本信息','xintheme');?></h3>
			</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php _e('头像','xintheme');?></label>
		<div class="col-sm-9">

<div class="radio">
<?php echo xintheme_get_avatar( $user_info->ID , '40' , xintheme_get_avatar_type($user_info->ID) ); ?>
  <label>
	<input type="radio" name="avatar"  value="default" <?php if( ($avatar!='qq' || xintheme_is_open_qq($user_info->ID)===false) && ($avatar!='weibo' || xintheme_is_open_weibo($user_info->ID)===false) ) echo 'checked';?>><?php _e('默认头像','xintheme'); ?>
  </label>
  <label id="edit-umavatar"><?php _e('(上传头像)','xintheme'); ?></label>
</div>

<div id="upload-input">    
    <input name="file" type="file"  value="<?php _e('浏览','xintheme'); ?>" >              
    <span id="upload-umavatar"><?php _e('上传','xintheme'); ?></span>   
</div>
<p id="upload-avatar-msg"></p>

<?php if(xintheme_is_open_qq($user_info->ID)){ ?>
<div class="radio">
<?php echo xintheme_get_avatar( $user_info->ID , '40' , 'qq' ); ?>
  <label>
    <input type="radio" name="avatar" value="qq" <?php if($avatar=='qq') echo 'checked';?>> <?php _e('QQ头像', 'xintheme');?>
  </label>
</div>
<?php } ?>

<?php if(xintheme_is_open_weibo($user_info->ID)){ ?>
<div class="radio">
<?php echo xintheme_get_avatar( $user_info->ID , '40' , 'weibo' ); ?>
  <label>
    <input type="radio" name="avatar" value="weibo" <?php if($avatar=='weibo') echo 'checked';?>> <?php _e('微博头像', 'xintheme');?>
  </label>
</div>
<?php } ?>

		</div>
	</div>
	
	<div class="form-group">
		<label for="display_name" class="col-sm-3 control-label"><?php _e('性别','xintheme');?></label>
		<div class="col-sm-9">
			<select name="gender">
				<option value ="男" <?php if($user_info->gender=='男') echo 'selected = "selected"'; ?>><?php _e('男','xintheme');?></option>
				<option value ="女" <?php if($user_info->gender=='女') echo 'selected = "selected"'; ?>><?php _e('女','xintheme');?></option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="display_name" class="col-sm-3 control-label"><?php _e('昵称','xintheme');?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="display_name" name="display_name" value="<?php echo $user_info->display_name;?>">
		</div>
	</div>

	<div class="form-group">
		<label for="url" class="col-sm-3 control-label"><?php _e('站点','xintheme');?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="url" name="siteurl" value="<?php echo $user_info->user_url;?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="qq" class="col-sm-3 control-label"><?php _e('QQ','xintheme');?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="qq" name="qq" value="<?php echo $user_info->qq;?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="weibo" class="col-sm-3 control-label"><?php _e('微博','xintheme');?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="weibo" name="weibo" value="<?php echo $user_info->weibo;?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="weixin" class="col-sm-3 control-label"><?php _e('微信二维码图片地址','xintheme');?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="weixin" name="weixin" value="<?php echo $user_info->weixin;?>">
		</div>
	</div>
	
	<div class="form-group">
		<label for="description" class="col-sm-3 control-label"><?php _e('个人说明','xintheme');?></label>
		<div class="col-sm-9">
			<textarea class="form-control" rows="3" name="description" id="description"><?php echo $user_info->description;?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-primary"><?php _e('保存更改','xintheme');?></button>
		</div>
	</div>
	
</form>


<?php if( $qq || $weibo ) { ?>
<form id="open-form" class="form-horizontal" role="form" method="post">
			<div class="page-header">
				<h3 id="open"><?php _e('绑定账号','xintheme');?></h3>
			</div>
			
	<?php if($qq){ ?>
		<div class="form-group">
			<label class="col-sm-3 control-label"><?php _e('QQ账号','xintheme');?></label>
			<div class="col-sm-9">
		<?php  if(xintheme_is_open_qq($user_info->ID)) { ?>
			<span class="help-block"><?php _e('已绑定','xintheme');?> <a href="<?php echo home_url('/?connect=qq&action=logout'); ?>"><?php _e('点击解绑','xintheme');?></a></span>
			<?php echo xintheme_get_avatar( $user_info->ID , '140' , 'qq' ); ?>
		<?php }else{ ?>
			<a class="btn btn-primary" href="<?php echo home_url('/?connect=qq&action=login&redirect='.urlencode(get_edit_profile_url())); ?>"><?php _e('绑定QQ账号','xintheme');?></a>
		<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if($weibo){ ?>
		<div class="form-group">
			<label class="col-sm-3 control-label"><?php _e('微博账号','xintheme');?></label>
			<div class="col-sm-9">
		<?php if(xintheme_is_open_weibo($user_info->ID)) { ?>
			<span class="help-block"><?php _e('已绑定','xintheme');?> <a href="<?php echo home_url('/?connect=weibo&action=logout'); ?>"><?php _e('点击解绑','xintheme');?></a></span>
			<?php echo xintheme_get_avatar( $user_info->ID , '140' , 'weibo' ); ?>
		<?php }else{ ?>
			<a class="btn btn-danger" href="<?php echo home_url('/?connect=weibo&action=login&redirect='.urlencode(get_edit_profile_url())); ?>"><?php _e('绑定微博账号','xintheme');?></a>
		<?php } ?>
			</div>
		</div>
	<?php } ?>
</form>
<?php } ?>
<form id="pass-form" class="form-horizontal" role="form" method="post">
	<input type="hidden" name="update" value="pass">
	<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'check-nonce' );?>">
			<div class="page-header">
				<h3 id="pass"><?php _e('账号安全','xintheme');?></h3>
			</div>
	<div class="form-group">
		<label for="email" class="col-sm-3 control-label"><?php _e('电子邮件 (必填)','xintheme');?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $user_info->user_email;?>" aria-required='true' required>
		</div>
	</div>
	<div class="form-group">
		<label for="pass1" class="col-sm-3 control-label"><?php _e('新密码','xintheme');?></label>
		<div class="col-sm-9">
			<input type="password" class="form-control" id="pass1" name="pass1" >
			<span class="help-block"><?php _e('如果您想修改您的密码，请在此输入新密码。不然请留空。','xintheme');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="pass2" class="col-sm-3 control-label"><?php _e('重复新密码','xintheme');?></label>
		<div class="col-sm-9">
			<input type="password" class="form-control" id="pass2" name="pass2" >
			<span class="help-block"><?php _e('再输入一遍新密码。 提示：您的密码最好至少包含7个字符。为了保证密码强度，使用大小写字母、数字和符号（例如! " ? $ % ^ & )）。','xintheme');?></span>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<button type="submit" class="btn btn-primary"><?php _e('保存更改','xintheme');?></button>
		</div>
	</div>
</form>
	<?php
	}
}
		?>
		<!-- End Tab-profile -->

						</div>
					</div>
					<!-- Sidebar -->
					<?php if(!isset($_GET['action'])||($_GET['action']!='edit'&&$_GET['action']!='new')) { ?>
					<div class="mnmd-sub-col js-sticky-sidebar">
					<div class="theiaStickySidebar">
					<div id="rb">
						<div id="rb-inner">
						<!-- Manage menu widget -->

							<div class="um-widget follow-widget">
								<div class="widget__title block-heading block-heading--line">
									<h4 class="widget__title-text">个人信息</h4>
								</div>
								<div class="widget-body">
									<div class="user-time">
										<?php $days_num = round(( strtotime(date('Y-m-d')) - strtotime( $user_info->user_registered ) ) /3600/24); $days_num = $days_num>1?$days_num:1;echo '<p><span>'.__('注册日期 :','xintheme').'</span>'.date( 'Y年m月d日', strtotime( $user_info->user_registered ) ).' ( '.$days_num.'天 )</p>';
										
										if($user_info->xintheme_latest_login) echo '<p><span>'.__('最后登录 :','xintheme').'</span>'.date( 'Y年m月d日 H时i分', strtotime( $user_info->xintheme_latest_login ) ).'</p>';
				 						?>
									</div>									
									<div class="item">
										<div class="widget__title block-heading block-heading--line">
											<h4 class="widget__title-text">社交网络</h4>
										</div>
										<ul class="sociallist clx">
											<?php if(!empty($user_info->user_url)){ ?>
											<span><a class="as-img as-home" href="<?php echo $user_info->user_url; ?>" rel="nofollow" target="_blank" title="<?php _e('个人网站','xintheme'); ?>"><i class="iconfont icon-lianjie"></i></a></span>
											<?php } ?>
											<?php if(!empty($user_info->qq)){ ?>
											<span><a class="as-img as-qq" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $user_info->qq; ?>&site=qq&menu=yes" rel="nofollow" target="_blank" title="<?php _e('QQ交谈','xintheme'); ?>"><i class="iconfont icon-QQ"></i></a></span>
											<?php } ?>
											<?php if(!empty($user_info->weibo)){ ?>
											<span><a class="as-img as-sinawb" href="<?php echo $user_info->weibo; ?>" rel="nofollow" target="_blank" title="<?php _e('微博','xintheme'); ?>"><i class="iconfont icon-weibo"></i></a></span>
											<?php } ?>
											<?php if(!empty($user_info->weixin)){ ?>
											<span><a class="as-img as-weixin" href="#" id="as-weixin-a" title="<?php _e('微信','xintheme'); ?>"><i class="iconfont icon-weixin"></i>
												<div id="as-weixin-qr" class="as-qr"><img src="<?php echo $user_info->weixin; ?>" title="<?php _e('微信扫描二维码','xintheme'); ?>" /><div>微信扫描二维码</div></div></a></span>		
											<?php } ?>
											<span style="margin: 0;"><a class="as-img as-email" style="padding: 3px 0;" href="mailto:<?php echo $user_info->user_email; ?>" rel="nofollow" target="_blank" title="<?php _e('联系邮箱','xintheme'); ?>"><i class="iconfont icon-youxiang"></i></a></span>
										</ul>
									</div>
								</div>
							</div>

						</div>
					</div>
					</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>

<!-- Footer -->
<?php get_footer(); ?>