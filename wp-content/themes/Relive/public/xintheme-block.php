<?php

//载入前端样式
add_action('wp_head', 'xintheme_blocks_block_assets');
function xintheme_blocks_block_assets() {
	wp_enqueue_style( 'xintheme_blocks_block_assets', get_template_directory_uri().'/static/dist/blocks.style.build.css', array(), '' );
}



function xintheme_blocks_block_frontend_assets() {
	if ( ! is_admin() ) {
		wp_enqueue_script('xintheme-blocks-block-front-js',get_template_directory_uri() . '/static/dist/blocks.front.build.js', array(),false, true);
	}
}

add_action( 'enqueue_block_assets', 'xintheme_blocks_block_frontend_assets' );


function xintheme_blocks_editor_assets() {
	wp_enqueue_style( 'xintheme-blocks-block-style-css', get_template_directory_uri().'/static/dist/blocks.style.build.css', array(), '' );

	wp_enqueue_style( 'xintheme-blocks-block-editor-css', get_template_directory_uri().'/static/dist/blocks.editor.build.css', array(), '' );

	wp_enqueue_script('xintheme-blocks-block-js',get_template_directory_uri() . '/static/dist/blocks.build.js', array( 'wp-blocks', 'wp-i18n', 'wp-element' ),false, true);
	
	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'xintheme-blocks-block-js', 'xintheme-block' );
	}
}

add_action( 'enqueue_block_editor_assets', 'xintheme_blocks_editor_assets' );


function xintheme_blocks_dependency_assets() {
	wp_enqueue_script('prism-js',get_template_directory_uri() . '/static/dist/prismjs.min.js', array(),false, true);
}

add_action( 'enqueue_block_assets', 'xintheme_blocks_dependency_assets' );


function xintheme_blocks_block_categories( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'xintheme-block',
				'title' => __( '主题自带区块（XINTHEME）', 'xintheme-block' ),
			),
		)
	);
}

add_filter( 'block_categories', 'xintheme_blocks_block_categories', 10, 2 );
