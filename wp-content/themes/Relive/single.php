<?php
$post_extend = get_post_meta( get_the_ID(), 'extend_info', true );
$post_layout = isset($post_extend['post_layout']) ?$post_extend['post_layout'] : '';
$post_subtitle	= isset($post_extend['post_subtitle']) ?$post_extend['post_subtitle'] : '';
$no_sidebar	= isset($post_extend['no_sidebar']) ?$post_extend['no_sidebar'] : '';
$single_copyright	= isset($post_extend['single_copyright']) ?$post_extend['single_copyright'] : '';
$no_sidebar_all = xintheme('post_no_sidebar_all');
$full_background_white = xintheme('full_background_white');
get_header();
while( have_posts() ): the_post(); $p_id = get_the_ID();?>
	<?php if( xintheme('xintheme_post_indent') ) : ?>
	<style type="text/css">.entry-content p {text-indent: 2em;}</style>
	<?php endif; ?>
	<div class="site-content">
		<?php get_template_part( 'template-parts/single-top' );?>
		<div class="mnmd-block mnmd-block--fullwidth">
			<div class="container <?php if( $no_sidebar==true || $no_sidebar_all ) : ?>container--narrow <?php if( $full_background_white ){?>relive_v3_container--narrow<?php }?><?php endif;?>">
				<div class="row">
					<?php if( $full_background_white ){?>
					<div class="relive_v3_15 mnmd-main-col">
					<?php echo get_breadcrumbs();?>
					<?php }?>
					<div class="<?php if( !$full_background_white ){?>mnmd-main-col<?php }?><?php if( $full_background_white ){?> relive_v3 relive_v3_bottom_0<?php }?>">
						<?php if( !$full_background_white ){?>
							<?php echo get_breadcrumbs();?>
						<?php }?>
						<article class="mnmd-block post">
						<div class="single-content">
							<?php if( $post_layout == '1' ){
								get_template_part( 'template-parts/single-top-default' );
							}elseif( $post_layout == '2' ){

							}else{
								get_template_part( 'template-parts/single-top-default' );
							} ?>
							<?php get_template_part('template-parts/single_top_ad'); ?>
							<?php if( xintheme('xintheme_post_share') ) { get_template_part( 'template-parts/share');}?>
							<div class="entry-content typography-copy<?php if( xintheme('post_expand_all') ){?> expand-content<?php }?>">
							<?php the_content(); wp_link_pages('before=<div id="page-links">&after=</div>');?>
							<?php if( xintheme('single_copyright_switch') ) : ?>
							<?php if($single_copyright){
									echo'<div class="single_copyright">'.$single_copyright.'</div>';
								}elseif( xintheme('single_copyright')){
									echo'<div class="single_copyright">'.xintheme('single_copyright').'</div>';
								}else{
									echo'<div class="single_copyright">本文由 <a rel="author" href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_the_author().'</a> 发布在 <a rel="home" href="'.get_option('home').'">'.get_bloginfo( 'name' ).'</a>，转载此文请保持文章完整性，并请附上文章来源（'.get_bloginfo( 'name' ).'）及本页链接。<br>原文链接：'.get_the_permalink().' </div>'; 
								}
							?>
							<?php endif; ?>
							</div>
							<?php endwhile; wp_reset_query(); ?>
							<?php if( xintheme('post_expand_all') ){?>
							<div class="expand-all">
								展开阅读全文<svg viewbox="0 0 10 6" width="10" height="16" aria-hidden="true" style=";"><title></title><g><path d="M8.716.217L5.002 4 1.285.218C.99-.072.514-.072.22.218c-.294.29-.294.76 0 1.052l4.25 4.512c.292.29.77.29 1.063 0L9.78 1.27c.293-.29.293-.76 0-1.052-.295-.29-.77-.29-1.063 0z"></path></g></svg>
							</div>
							<?php }?>
							<footer class="single-footer entry-footer">
							<div class="entry-info">
								<div class="row row--space-between grid-gutter-10">
									<div class="entry-categories col-sm-4">
										<ul>
											<li class="entry-categories__icon">
												<i class="iconfont icon-wenjianjia"></i><span class="sr-only">发布在</span>
											</li>
											<?php the_category(' '); ?>
										</ul>
									</div>
									<div class="entry-tags col-sm-8">
										<ul>
											<?php the_tags('<li class="entry-tags__icon"><i class="iconfont icon-tag"></i><span class="sr-only">文章标签</span></li><li>', '</li><li>', '</li>') ?>
										</ul>
									</div>
								</div>
							</div>
							<?php if( xintheme('xintheme_post_end_share') ) { get_template_part( 'template-parts/share');}?>
							<?php get_template_part('template-parts/single_ad'); ?>
							</footer>
						</div>
						</article>
						<?php if( xintheme('xintheme_post_author') ) : ?>
						<div class="author-box single-entry-section">
							<div class="author-box__image">
								<div class="author-avatar">
									<?php echo xintheme_get_avatar( get_the_author_meta('ID') , '180' , xintheme_get_avatar_type( get_the_author_meta('ID') ) ); ?>
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
						<?php endif; ?>
						<?php if( xintheme('xintheme_post_prev_next') ){ get_template_part( 'template-parts/post_prev'); }?>
						<?php if( xintheme('xintheme_post_relevant') ){ get_template_part( 'template-parts/related'); }?>
						<?php comments_template();?>
					</div>
					<?php if( $full_background_white ){?>
					</div>
					<?php }?>
					<?php if( $no_sidebar==false && $no_sidebar_all==false ) : get_sidebar(); endif;?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();?>