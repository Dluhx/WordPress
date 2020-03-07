<?php 
$post_extend	= get_post_meta( get_the_ID(), 'extend_info', true );
$post_layout	= isset($post_extend['post_layout']) ?$post_extend['post_layout'] : '';
$post_subtitle	= isset($post_extend['post_subtitle']) ?$post_extend['post_subtitle'] : '';
$no_sidebar	= isset($post_extend['no_sidebar']) ?$post_extend['no_sidebar'] : '';
$xintheme_single_author = xintheme('xintheme_single_author');
$xintheme_single_time = xintheme('xintheme_single_time');
$xintheme_single_views = xintheme('xintheme_single_views');
$xintheme_single_duration = xintheme('xintheme_single_duration');
if( $post_layout == '1' ){?>

<?php }elseif( $post_layout == '2' ){?>
<div class="mnmd-block mnmd-block--fullwidth mnmd-block--contiguous single-billboard">
	<?php 
		$header_img =  $post_extend['header_img'];
		if( ! empty( $header_img ) ) :
        $header_img = explode( ',', $post_extend['header_img'] );
        foreach ( $header_img as $id ) :
        $header_img_src = wp_get_attachment_image_src( $id, 'full' );
		$src = $header_img_src;
  		$cdn_switch = xintheme('cdn_switch');
  		if( $cdn_switch ){
        	$cdn_url = xintheme('cdn_url');
        	$src = str_replace(home_url(),$cdn_url,$src);
        }?>
	<div class="background-img hidden-xs hidden-sm" style="background-image:url(<?php echo $src[0];?>)">
	</div>
	<?php endforeach;endif ?>
	<?php

		if( $post_extend['mobile_header_img'] ){
			$header_img2 =  $post_extend['mobile_header_img'];
		}else{
			$header_img2 =  $post_extend['header_img'];
		}

		$header_img =  $header_img2;
		if( ! empty( $header_img ) ) :
        $header_img = explode( ',', $header_img2 );
        foreach ( $header_img as $id ) :
        $header_img_src = wp_get_attachment_image_src( $id, 'full' );
		$src = $header_img_src;
  		$cdn_switch = xintheme('cdn_switch');
  		if( $cdn_switch ){
        	$cdn_url = xintheme('cdn_url');
        	$src = str_replace(home_url(),$cdn_url,$src);
        }?>
	<div class="background-img hidden-md hidden-lg" style="background-image:url(<?php echo $src[0];?>)">
	</div>
	<?php endforeach;endif ?>
	<div class="single-billboard__inner">
		<header class="single-header">
		<div class="container <?php if( $no_sidebar==true ) : ?>container--narrow<?php endif;?>">
			<div class="single-header__inner inverse-text">
				<?php if( xintheme('xintheme_single_cat') ){?>
				<?php xintheme_category_color();?>
				<?php }?>
				<h1 class="entry-title entry-title--lg"><?php the_title(); ?></h1>
				<div class="entry-teaser hidden-xs">
					<?php echo $post_subtitle;?>
				</div>
				<div class="entry-meta">
					<?php if( $xintheme_single_author ){ ?>
					<span class="entry-author entry-author--with-ava">
						<?php echo xintheme_get_avatar( get_the_author_meta('ID') , '34' , xintheme_get_avatar_type( get_the_author_meta('ID') ) ); ?>
						<a class="entry-author__name" rel="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php echo get_the_author() ?></a>
					</span>
					<?php } ?>
					<?php edit_post_link('<span>[编辑文章]</span>'); ?>
					<?php if( $xintheme_single_time ){ ?>
					<time class="time published" title="<?php echo date_i18n( __( 'Y-m-d H:i:s' ), strtotime( $post->post_date ) ); ?>"><i class="iconfont icon-time"></i><?php echo date_i18n( __( 'Y-m-d H:i:s' ), strtotime( $post->post_date ) ); ?></time>
					<?php } ?>
					<?php if( $xintheme_single_views ){ ?>
					<span><a title="<?php post_views('',''); ?> 次浏览" href="<?php the_permalink(); ?>"><i class="iconfont icon-browse"></i><?php post_views('',''); ?></a></span>
					<?php } ?>
					<?php
					$post_extend = get_post_meta( get_the_ID(), 'extend_info', true );
					$single_source = isset($post_extend['single_source']) ?$post_extend['single_source'] : '';
					if( $single_source ){ ?>
					<span><i class="iconfont icon-lianjie" style="font-size: 13px !important;"></i><?php echo $single_source; ?></span>
					<?php } ?>
					<?php if( $xintheme_single_duration ){ ?>
					<?php if ( wp_is_mobile() ){ ?><br><br><?php }?>
					<span><i class="iconfont icon-tishi1"></i><?php echo xintheme_count_words_read_time(); ?></span>
					<?php } ?>
					<?php if( current_user_can( 'manage_options' ) && xintheme('xintheme_checkBaidu') ) {?>
						<?php echo xintheme_checkBaidu(get_the_permalink());?>
					<?php }?>
				</div>
			</div>
		</div>
		</header>
	</div>
</div>
<?php }?>