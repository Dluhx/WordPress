<?php
    if (post_password_required()) return;
?>
<div class="comments-section single-entry-section">
    <div id="comments" class="comments-area">
        <?php if (have_comments()):?>
            <h2 class="comments-title">
                <?php comments_number( esc_html__( '', 'xintheme' ), esc_html__( '1 条评论', 'xintheme' ), esc_html__( '% 条评论', 'xintheme' ) ); ?>
            </h2>
        <?php endif;?>
            <?php if ( have_comments() ) : ?>
            <ol class="comment-list">
                <?php wp_list_comments('type=comment&callback=xintheme_comments&style=ol');?>
            </ol>
                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <nav role="navigation" id="comment-nav-bottom" class="comment-navigation">
                    <div class="nav-previous"><?php previous_comments_link( esc_html__( '上一页', 'xintheme' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( '下一页', 'xintheme' ) ); ?></div>
                </nav>
                <?php endif;?>
            <?php endif;?>
        <?php if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) && !is_page() ) :?>
			<p class="nocomments"><?php esc_html_e( '评论已经被关闭。', 'xintheme' ); ?></p>
        <?php endif; ?>
    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $comments_args = array(
			'comment_notes_after' => '<!--p class="form-allowed-tags">' . sprintf( __( '您可以使用这些HTML标记和属性：%s' ), '<br/><code>' . allowed_tags() . '</code>' ) . '</p-->',
            'title_reply'=> esc_html__('发表评论', 'xintheme'),
            'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' => '<p class="comment-form-author"><label for="author">'.esc_html__('Name', 'xintheme').' <span class="required">*</span></label><input id="author" name="author" type="text" size="30" maxlength="245" ' .  $aria_req . ' /></p>',
                'email' => '<p class="comment-form-email"><label for="email">'.esc_html__('Email', 'xintheme').' <span class="required">*</span></label><input id="email" name="email" size="30" maxlength="100" type="text" '. $aria_req .' /></p>' ) ),
            'id_submit' => '提交评论',
			'cancel_reply_link' => __( '取消回复' ),
			'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( '当前登陆账号为： <a href="%1$s">%2$s</a>，<a href="%3$s" title="Log out of this account">退出登陆?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            'label_submit' => esc_html__('提交评论', 'xintheme'),
            'comment_field' => '<p class="comment-form-comment"><label for="comment">'.esc_html__( '评论内容', 'xintheme' ).'</label><a class="comment-emoticon" data-original-title="添加表情" style="padding-left: 5px;" data-toggle="tooltip" data-placement="top"><i class="iconfont icon-tubiao" style="font-size: 14px !important;"></i></a><!--a class="comment-upload" data-original-title="上传图片" data-toggle="tooltip" data-placement="top" data-balloon-pos="up"><i class="iconfont icon-tuxiang"></i></a--><div class="comment-card-smiley">'.xintheme_emoticon().'</div><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea></p>');
    } else {
        $comments_args = array(
		'comment_notes_before'  => '<p class="comment-notes"><span id="email-notes">'.esc_html__('您的电子邮件地址不会被公开。', 'xintheme').' </span>'.esc_html__(' 必填项已用', 'xintheme').' <span class="required">*</span> 标注</p>',
        'title_reply'=> esc_html__('发表评论', 'xintheme'),
        'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' => '<p class="comment-form-author"><label for="author">'.esc_html__('昵称', 'xintheme').' <span class="required">*</span></label><input id="author" name="author" type="text" size="30" maxlength="245" required="required" ' .  $aria_req . ' /></p><!--',
                'email' => '--><p class="comment-form-email"><label for="email">'.esc_html__('邮箱', 'xintheme').' <span class="required">*</span></label><input id="email" name="email" size="30" maxlength="100" required="required" type="text" '. $aria_req .' /></p><!--',
				'url' => '--><p class="comment-form-url"><label for="url">'.esc_html__('网址', 'xintheme').'</label><input id="url" name="url" size="30" maxlength="200" type="text"></p>') ),
        'id_submit' => '提交评论',
		'cancel_reply_link' => __( '取消回复' ),
		'must_log_in' => '<p class="must-log-in" style="padding: 50px;background-color: #f2f2f2;text-align: center;font-size: 16px;">要发表评论，您必须先<a href="#login-modal" data-toggle="modal" data-target="#login-modal" style="text-decoration: none;"> <i class="iconfont icon-denglu"></i> 登录</a></p>',
        'label_submit' => esc_html__('提交评论', 'xintheme'),
        'comment_field' => '<p class="comment-form-comment"><label for="comment">'.esc_html__( '评论内容', 'xintheme' ).'</label><a class="comment-emoticon" data-original-title="添加表情" style="padding-left: 5px;" data-toggle="tooltip" data-placement="top"><i class="iconfont icon-tubiao" style="font-size: 14px !important;"></i></a><!--a class="comment-upload" data-original-title="上传图片" data-toggle="tooltip" data-placement="top" data-balloon-pos="up"><i class="iconfont icon-tuxiang"></i></a--><div class="comment-card-smiley">'.xintheme_emoticon().'</div>
		<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea></p><span class="xintheme-no-robot"><label><input type="checkbox" name="no-robot" required="required" id="xintheme-no-robot" value="xintheme-no-robot"  class="no-robot" />
        <em data-on="通过" data-off="验证"></em><i></i></label><span class="comment-tips">提示：点击验证后方可评论！</span>
        </span>');
    }
	
	if ( !have_comments() ){
		$comments_args['title_reply'] = esc_html__('发表评论', 'xintheme');
	}
	
    comment_form($comments_args); ?>
    </div>
</div>
<div class="comment-upload-box"></div>
<div class="comment-upload-donate">
	<p class="close"><i class="iconfont icon-close"></i><p>
	<div id="comment-img-add">插入图片</div>
	<div class="comment-add-img">
		<input id="comment-img-file" type="file" accept="image/*">
		<button class="comment-img-file" onclick="return false;"><i class="czs-upload-l" aria-hidden="true"></i> 本地上传</button>
	</div>
</div>
<script type="text/javascript">
	function grin(tag){if(document.getElementById('comment')&&document.getElementById('comment').type=='textarea'){myField=document.getElementById('comment');}else{return false;}
	tag=' '+tag+' ';if(document.selection){myField.focus();sel=document.selection.createRange();sel.text=tag;myField.focus();}
	else if(myField.selectionStart||myField.selectionStart=='0'){startPos=myField.selectionStart
	endPos=myField.selectionEnd;cursorPos=startPos;myField.value=myField.value.substring(0,startPos)
	+tag
	+myField.value.substring(endPos,myField.value.length);cursorPos+=tag.length;myField.focus();myField.selectionStart=cursorPos;myField.selectionEnd=cursorPos;}
	else{myField.value+=tag;myField.focus();}}
</script>