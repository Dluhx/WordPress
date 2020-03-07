<div id="mnmd-offcanvas-mobile" class="mnmd-offcanvas js-mnmd-offcanvas js-perfect-scrollbar">
	<div class="mnmd-offcanvas__title">
		<h2 class="site-logo">
			<a href="<?php bloginfo('url'); ?>">
				<img <?php echo is_lazysizes(); ?>src="<?php echo xintheme_img('mobile_menu_logo','');?>" alt="<?php bloginfo('name'); ?>">
			</a>
		</h2>
		<ul class="social-list list-horizontal">
		</ul>
		<a href="#mnmd-offcanvas-mobile" class="mnmd-offcanvas-close js-mnmd-offcanvas-close" aria-label="Close"><span aria-hidden="true">&#10005;</span></a>
	</div>
	<?php
		$open_ucenter = xintheme('open_ucenter');
		if( $open_ucenter ){
	?>
	<div class="mnmd-offcanvas__section visible-xs visible-sm">
		<div class="text-center">
		<?php 
		if ( is_user_logged_in() ) { ?>
			<?php get_template_part( 'template-parts/header/login'); ?>
		<?php }else{?>
			<a href="#login-modal" class="btn btn-default" data-toggle="modal" data-target="#login-modal"><i class="iconfont icon-denglu"></i> <span>登录/注册</span></a>		
		<?php }?>
		</div>
	</div>
	<?php }?>
	<div class="mnmd-offcanvas__section mnmd-offcanvas__section-navigation">
		<div id="offcanvas-menu" class="menu-main-menu-container">
			<ul class="navigation navigation--offcanvas">
				<?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'main')); ?>
				<?php 
				if( xintheme('header_contribute')){
				global $current_user; if ( is_user_logged_in() ) { ?>
				<li class="menu-item"><a href="<?php echo get_author_posts_url($current_user->ID); ?>?tab=post&action=new"><i class="iconfont icon-write"></i> 投稿</a></li>
				<?php }else{?>
				<li class="menu-item"><a href="#login-modal" data-toggle="modal" data-target="#login-modal"><i class="iconfont icon-write"></i> 投稿</a></li>
				<?php } } ?>
			</ul>
		</div>
	</div>
	<?php if( xintheme('mobile_menu_post') ){?>
	<div class="mnmd-offcanvas__section">
		<div class="widget mnmd-widget">
			<div class="mnmd-widget-indexed-posts-a">
				<div class="widget__title block-heading">
					<h4 class="widget__title-text">最新文章</h4>
				</div>
				<ol class="posts-list list-space-sm list-unstyled">
					<?php $posts_new = get_posts('numberposts=5&orderby=date');foreach($posts_new as $post) : ?> 
					<li><article class="post post--horizontal post--horizontal-xxs">
					<div class="post__thumb">
						<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
							<img width="180" height="180" src="<?php echo post_thumbnail(180, 180); ?>" alt="<?php the_title(); ?>"></a>
					</div>
					<div class="post__text">
						<h3 class="post__title typescale-0">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="post__meta">
							<time class="time published" title="<?php the_time('Y-m-d') ?>"><i class="iconfont icon-time"></i><?php the_time('Y-m-d') ?></time>
							<?php if( xintheme('xintheme_post_meta_views') ){?>
							<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
							<?php } ?>
						</div>
					</div>
					</article></li>
					<?php endforeach;wp_reset_query();?>
				</ol>
			</div>
		</div>
	</div>
	<?php } ?>
</div>