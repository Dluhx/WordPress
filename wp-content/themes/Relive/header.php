
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0">
<?php if( xintheme_img('favicon','') ) { ?>
<link rel="shortcut icon" href="<?php echo xintheme_img('favicon','');?>"/>
<?php }else{ ?>
<link rel="shortcut icon" href="<?php bloginfo('template_url');?>/static/images/favicon.ico"/>
<?php }?>
<?php wp_head(); ?>
<?php echo xintheme('head_code');?>
</head>
<body <?php body_class(); ?>>
<div class="site-wrapper">
	<?php get_template_part( 'template-parts/header/header' ); ?>