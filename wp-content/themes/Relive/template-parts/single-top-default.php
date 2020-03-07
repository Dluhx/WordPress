<header class="single-header">
<?php if( xintheme('xintheme_single_cat') ){?>
<?php
	$category = get_the_category();
	$term_id = $category[0]->term_id;	
	$color = get_term_meta($term_id, 'cc_color', true);
	if($category[0]){
	echo '<a class="post__cat cat-theme" href="'.get_category_link($category[0]->term_id ).'" style="color: '.$color.' !important;">'.$category[0]->cat_name.'</a>';
	};
?>
<?php }?>
<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="entry-teaser hidden-xs">
	<?php echo $post_subtitle;?>
</div>
<?php
$post_extend = get_post_meta( get_the_ID(), 'extend_info', true );
$single_source = isset($post_extend['single_source']) ?$post_extend['single_source'] : '';
$xintheme_single_author = xintheme('xintheme_single_author');
$xintheme_single_time = xintheme('xintheme_single_time');
$xintheme_single_views = xintheme('xintheme_single_views');
$xintheme_single_duration = xintheme('xintheme_single_duration');
?>
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
	<?php if( $single_source ){ ?>
	<span><i class="iconfont icon-lianjie" style="font-size: 13px !important;"></i><?php echo $single_source; ?></span>
	<?php } ?>
	<?php if( $xintheme_single_duration ){ ?>
	<?php if ( wp_is_mobile() ){ ?><br><br><?php }?>
	<span><i class="iconfont icon-tishi3"></i><?php echo xintheme_count_words_read_time(); ?></span>
	<?php } ?>
	<?php if( current_user_can( 'manage_options' ) && xintheme('xintheme_checkBaidu') ) {?>
		<?php echo xintheme_checkBaidu(get_the_permalink());?>
	<?php }?>
</div>
</header>