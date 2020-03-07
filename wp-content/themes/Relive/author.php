<?php get_header(); ?>
	<div class="site-content">
		<div class="mnmd-layout-split mnmd-block mnmd-block--fullwidth">
			<div class="container">
				<div class="row">
					<div class="mnmd-main-col" role="main">
						<div class="author-box">
							<div class="author-box__image">
								<div class="author-avatar">
									<?php echo get_avatar( get_the_author_meta('email'), '180' );?>
								</div>
							</div>
							<div class="author-box__text">
								<div class="author-name meta-font">
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" title="<?php echo get_the_author() ?>" rel="author"><?php echo get_the_author() ?></a>
								</div>
								<div class="author-bio">
									<?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{echo'我还没有学会写个人说明！'; }?>
								</div>
								<div class="author-info">
									<div class="row row--space-between row--flex row--vertical-center grid-gutter-20">
										<div class="author-socials col-xs-12 col-sm-6">
											<ul class="list-unstyled list-horizontal list-space-sm">
												<?php if(get_the_author_meta('qq')){ ?>
												<li><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo the_author_meta( 'qq' ); ?>&site=qq&menu=yes" rel="nofollow" target="_blank"><i class="iconfont icon-QQ"></i><span class="sr-only">QQ</span></a></li>
												<?php } ?>
												
												<?php if(get_the_author_meta('weixin')){ ?>
												<li><a id="uesr_weixin" class="user_weixin" href="javascript:void(0);"><i class="iconfont icon-weixin"></i><span class="sr-only">微信</span></a></li>
												<div class="user-weixin-dropdown">
													<div class="tooltip-weixin-inner">
														<h3>微信扫一扫</h3>
														<div class="qcode"> 
															<img <?php echo is_lazysizes(); ?>src="<?php echo the_author_meta( 'weixin' ); ?>" alt="微信扫一扫">
														</div>
													</div>
													<div class="close-weixin">
														<span class="close-top"></span>
															<span class="close-bottom"></span>
													</div>
												</div>
												<?php } ?>
												
												<?php if(get_the_author_meta('weibo')){ ?>
												<li><a href="<?php echo the_author_meta( 'weibo' ); ?>" rel="nofollow" target="_blank"><i class="iconfont icon-weibo"></i><span class="sr-only">微博</span></a></li>
												<?php } ?>
												
												<?php if(get_the_author_meta('youxiang')){ ?>
												<li><a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo the_author_meta( 'youxiang' ); ?>" rel="nofollow" target="_blank"><i class="iconfont icon-youxiang"></i><span class="sr-only">QQ邮箱</span></a></li>
												<?php } ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="spacer-lg"></div>
						<div class="mnmd-block">
							<div class="block-heading block-heading--line">
								<h4 class="block-heading__title">作者专栏</h4>
							</div>
							<div class="posts-list list-space-md list-seperated">
								<?php
								if ( have_posts() ) {
									while ( have_posts() ) { 
										the_post();
										get_template_part('template-parts/content-list');
									}
								}
								get_template_part( 'template-parts/paging' );
								?>
							</div>
							<div class="mnmd-pagination">
							<h4 class="mnmd-pagination__title sr-only">分页导航</h4>
							<div class="mnmd-pagination__links text-center">
								<?php xintheme_theme_pagenavi();?>
							</div>
							</div>	
						</div>
					</div>
					<?php get_sidebar();?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>