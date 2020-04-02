<?php $header_type = xintheme('header_style');?>
<style>.site-header .navigation-bar,.site-header .mobile-header,.site-header--skin-4, .site-header--skin-4 .mobile-header {background: <?php echo xintheme('header_style_1_color');?>;background: -webkit-linear-gradient(-495deg, <?php echo xintheme('header_style_1_color_2');?> 0, <?php echo xintheme('header_style_1_color');?> 100%);background: linear-gradient(225deg, <?php echo xintheme('header_style_1_color_2');?> 0, <?php echo xintheme('header_style_1_color');?> 100%);}</style>
<?php if ($header_type == '1') { ?>
<header class="site-header <?php if( xintheme('header_style_1_position') == 'right' ){?>site-header--skin-2<?php } ?>">
<?php get_template_part( 'template-parts/header/mobile-header'); ?>
<nav class="navigation-bar navigation-bar--fullwidth hidden-xs hidden-sm js-sticky-header-holder navigation-bar--inverse">
<?php if( xintheme('header_style_1_width') == 'middle' ){?><div class="container container--wide"><?php } ?>
<div class="navigation-bar__inner">
	<div class="navigation-bar__section">
		<div class="site-logo header-logo">
			<a href="<?php bloginfo('url'); ?>">
				<img src="<?php echo xintheme_img('logo','');?>" alt="<?php bloginfo('name'); ?>">
			</a>
		</div>
	</div>
	<div class="navigation-wrapper navigation-bar__section js-priority-nav">
		<div id="main-menu" class="menu-main-menu-container">
			<ul id="menu-main-menu" class="navigation navigation--main navigation--inline">
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
	<?php if( xintheme('header_style_1_social') ) {?>
	<div class="navigation-bar__section">
		<ul class="social-list list-horizontal social-list--inverse">
			<?php get_template_part( 'template-parts/header/social-header'); ?>
		</ul>
	</div>
	<?php } ?>
	<div class="navigation-bar__section lwa lwa-template-modal">
		<?php 
		$open_ucenter = xintheme('open_ucenter');
		if( $open_ucenter ){
			if ( is_user_logged_in() ) { ?>
				<?php get_template_part( 'template-parts/header/login'); ?>
			<?php }else{?>
			<br>
				<a href="<?php echo esc_url(site_url('wp-login.php')); ?>" class="navigation-bar__login-btn navigation-bar-btn">登录</a><span>|</span><a href="<?php echo esc_url(site_url('wp-login.php?action=register')); ?>" class="navigation-bar__login-btn navigation-bar-btn">注册</a><span>|</span><a href="<?php echo esc_url(site_url('index.php/guide/')); ?>" class="navigation-bar__login-btn navigation-bar-btn">注册指南</a>		
			<?php }?>
		<?php }?>
		<button type="submit" class="navigation-bar-btn js-search-dropdown-toggle">
			<i class="iconfont icon-sousuo"></i>
		</button>
	</div>
</div>
<?php get_template_part( 'template-parts/header/search-header'); ?>
<?php if( xintheme('header_style_1_width') == 'middle' ){?></div><?php } ?>
</nav>
</header>
<?php } ?>

<?php if ($header_type == '2') { ?>
<header class="site-header site-header--skin-4">
<?php get_template_part( 'template-parts/header/mobile-header'); ?>
<div class="header-main hidden-xs hidden-sm header-main--inverse">
	<div class="container">
		<div class="row row--flex row--vertical-center">
			<div class="col-xs-8">
				<div class="site-logo header-logo text-left">
					<a href="<?php bloginfo('url'); ?>">
						<img src="<?php echo xintheme_img('logo','');?>" alt="<?php bloginfo('name'); ?>">
					</a>
				</div>
			</div>
			<?php if( xintheme('header_style_1_social') ) {?>
			<div class="col-xs-4">
				<div class="site-header__social inverse-text">
					<ul class="social-list social-list--lg list-horizontal text-right">
						<?php get_template_part( 'template-parts/header/social-header'); ?>
					</ul>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<nav class="navigation-bar hidden-xs hidden-sm js-sticky-header-holder navigation-bar--inverse">
<div class="container">
	<div class="navigation-bar__inner">
		<div class="navigation-wrapper navigation-bar__section js-priority-nav">
			<div id="main-menu" class="menu-main-menu-container">
				<ul id="menu-main-menu" class="navigation navigation--main navigation--inline">
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
		<div class="navigation-bar__section lwa lwa-template-modal">
			<?php 
			$open_ucenter = xintheme('open_ucenter');
			if( $open_ucenter ){
				if ( is_user_logged_in() ) { ?>
					<?php get_template_part( 'template-parts/header/login'); ?>
				<?php }else{?>
					<a href="#login-modal" class="navigation-bar__login-btn navigation-bar-btn" data-toggle="modal" data-target="#login-modal"><i class="iconfont icon-denglu"></i></a>		
				<?php }?>
			<?php }?>
			<button type="submit" class="navigation-bar-btn js-search-dropdown-toggle">
				<i class="iconfont icon-sousuo"></i>
			</button>
		</div>
	</div>
	<?php get_template_part( 'template-parts/header/search-header'); ?>
</div>
</nav>
</header>
<?php } ?>