<?php
	$modular_full = xintheme('modular_full');
	if(is_array($modular_full)):foreach($modular_full as $id):
		$modular_type_full=$id['modular_type_full'];
			if ( !get_query_var('paged') || $id['modular_style_full_newest'] == '27' || $id['modular_style_full_newest'] == '28' ) { //分页不显示模块
			switch ($modular_type_full){
				case	'stick':	get_template_part( 'template-parts/modular/full-width/stick');break;
				case	'random':	get_template_part( 'template-parts/modular/full-width/random');break;
				case	'newest':	get_template_part( 'template-parts/modular/full-width/newest');break;
				case	'category':	get_template_part( 'template-parts/modular/full-width/category');break;
				case	'tags':		get_template_part( 'template-parts/modular/full-width/tags');break;
				case	'see':		get_template_part( 'template-parts/modular/full-width/see');break;
				case	'comment':	get_template_part( 'template-parts/modular/full-width/comment');break;
			}

			switch ($id['modular_type_full']){
				case	'countdown':	get_template_part( 'template-parts/modular/full-width/countdown');break;
				case	'full_ad':		get_template_part( 'template-parts/modular/full-width/full_ad');break;
			}

			}
			endforeach;
	endif;
?>