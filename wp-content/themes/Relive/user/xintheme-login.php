<script>window._Relive_XinTheme = {uri: '<?php echo get_bloginfo("template_url") ?>'}</script>
<div class="modal fade login-modal" id="login-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content login-signup-form">                        
            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&#10005;</span></button>
				<div class="modal-title" id="login-modal-label">
					<ul class="nav nav-tabs js-login-form-tabs" role="tablist">
					   
                        <?php if ( get_option('users_can_register') ) : //判断是否开启注册 wp-login.php ?>
                        <?php endif;?>
					</ul>
				</div>
			</div>
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="login-tab">

						<form id="login" action="<?php echo esc_attr(site_url('wp-login.php', 'login_post')); ?>" method="post">
							<div class="sign-tips"></div>
							<a class="login-lost-password" href="<?php echo esc_url(site_url('wp-login.php')); ?>" title="点击登录">登录</a>
							<a class="login-lost-password" href="<?php echo esc_url(site_url('wp-login.php?action=register')); ?>" title="点击注册">注册</a>
							<a class="login-lost-password" href="<?php echo esc_url(site_url('index.php/guide/')); ?>" title="指南">注册指南</a>
							<a class="login-lost-password" href="<?php echo esc_url(site_url('wp-login.php?action=lostpassword')); ?>" title="重置密码">找回密码</a>
						
                            <div class="lwa-submit login-submit">
                                <div class="lwa-submit-button login-submit">
									<input type="hidden" name="action" value="XinTheme_login">
									<input type="hidden" id="security" name="security" value="<?php echo  wp_create_nonce( 'security_nonce' );?>">
									<input type="hidden" name="_wp_http_referer" value="<?php echo esc_url(home_url('/')); ?>">
        	                    </div>                                     
        	                </div>                            
						</form>

						<?php
							$xintheme_open_qq		= xintheme('xintheme_open_qq');
							$xintheme_open_weibo	= xintheme('xintheme_open_weibo');
							$xintheme_open_weixin	= xintheme('xintheme_open_weixin');
						?>
						<?php if( $xintheme_open_qq || $xintheme_open_weibo || $xintheme_open_weixin ) {?>
						<div class="block-divider"><span>快速登录</span></div>
						<div class="login-with-social">
							<div class="apsl-login-networks theme-1 clearfix">
								<div class="social-networks">
									<?php if( $xintheme_open_qq ){ ?>
									<a href="<?php echo home_url('/?connect=qq&action=login&redirect='.urlencode(xintheme_get_redirect_uri())) ?>" class="login-with-qq" title="使用QQ登录">
									<div class="apsl-icon-block clearfix">
										<i class="iconfont icon-QQ"></i>
									</div>
									</a>
									<?php } ?>
									<?php if( $xintheme_open_weibo ){ ?>
									<a href="<?php echo home_url('/?connect=weibo&action=login&redirect='.urlencode(xintheme_get_redirect_uri())) ?>" class="login-with-weibo" title="使用微博登录">
									<div class="apsl-icon-block clearfix">
										<i class="iconfont icon-weibo"></i>
									</div>
									</a>
									<?php } ?>
									<?php if( $xintheme_open_weixin ){ ?>
									<a href="#" class="login-with-weixin" title="使用微信登录">
									<div class="apsl-icon-block clearfix">
										<i class="iconfont icon-weixin"></i>
									</div>
									</a>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php } ?>
                    </div>
                    <?php if ( get_option('users_can_register') ) : //判断是否开启注册 wp-login.php ?>
                    <div class="tab-pane fade lwa-register" id="signup-tab">

						<form id="register" action="<?php bloginfo('url'); ?>/wp-login.php?action=register" method="post">
							<div class="sign-tips"></div>
							<p class="fieldset">
								<label class="image-replace cd-username" for="user_name">用户名</label>
								<input class="input-control full-width has-padding has-border" id="user_name" type="text" name="user_name" placeholder="输入英文用户名">
							</p>
							<p class="fieldset">
								<label class="image-replace cd-email" for="user_email">邮箱帐号</label>
								<input class="input-control full-width has-padding has-border" id="user_email" type="email" name="user_email" placeholder="输入常用邮箱">
							</p>
							<p class="fieldset" id="captcha_inline">
								<input class="input-control inline full-width has-border" id="captcha" type="text" name="captcha" placeholder="输入验证码">
								<span class="captcha_email">获取验证码</span>
							</p>
							<p class="fieldset">
								<label class="image-replace cd-password" for="user_pass">密码</label>
								<input class="input-control full-width has-padding has-border" id="user_pass" type="password" name="user_pass" placeholder="密码至少6位数">
							</p>
							<p class="fieldset">
								<label class="image-replace cd-password" for="user_pass2">再次输入密码</label>
								<input class="input-control full-width has-padding has-border" id="user_pass2" type="password" name="user_pass2" placeholder="密码至少6位数">
							</p>
							<!--p class="fieldset">
								<input type="checkbox" id="accept-terms">
								<label for="accept-terms">我同意这些 <a href="#0">条款</a></label>
							</p-->
							<p class="fieldset">
								<input type="hidden" name="action" value="XinTheme_register">
								<input class="btn btn-block btn-primary submit register-loader" type="submit" value="立即注册" name="submit">
							</p>
							
							<input type="hidden" id="user_security" name="user_security" value="<?php echo  wp_create_nonce( 'user_security_nonce' );?>"><input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
						</form>
						
						<?php if( $xintheme_open_qq || $xintheme_open_weibo || $xintheme_open_weixin ) {?>
						<div class="block-divider"><span>快速登录</span></div>
						<div class="login-with-social">
							<div class="apsl-login-networks theme-1 clearfix">
								<div class="social-networks">
									<?php if( $xintheme_open_qq ){ ?>
									<a href="<?php echo home_url('/?connect=qq&action=login&redirect='.urlencode(xintheme_get_redirect_uri())) ?>" class="login-with-qq" title="使用QQ登录">
									<div class="apsl-icon-block clearfix">
										<i class="iconfont icon-QQ"></i>
									</div>
									</a>
									<?php } ?>
									<?php if( $xintheme_open_weibo ){ ?>
									<a href="<?php echo home_url('/?connect=weibo&action=login&redirect='.urlencode(xintheme_get_redirect_uri())) ?>" class="login-with-weibo" title="使用微博登录">
									<div class="apsl-icon-block clearfix">
										<i class="iconfont icon-weibo"></i>
									</div>
									</a>
									<?php } ?>
									<?php if( $xintheme_open_weixin ){ ?>
									<a href="#" class="login-with-weixin" title="使用微信登录">
									<div class="apsl-icon-block clearfix">
										<i class="iconfont icon-weixin"></i>
									</div>
									</a>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php } ?>
						
				    </div>
                    <?php endif; ?>
                </div>                                                                                        
            </div>                                                
        </div>
    </div>                                               
</div>