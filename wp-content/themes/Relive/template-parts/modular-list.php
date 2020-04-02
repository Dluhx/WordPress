<?php
	$modular_list = xintheme('modular_list');
	if(is_array($modular_list)):foreach($modular_list as $id):
		$modular_type_list=$id['modular_type_list'];
			switch ($modular_type_list){
				case	'stick':	get_template_part( 'template-parts/modular/modular-list/stick');break;
				case	'random':	get_template_part( 'template-parts/modular/modular-list/random');break;
				case	'newest':	get_template_part( 'template-parts/modular/modular-list/newest');break;
				case	'category':	get_template_part( 'template-parts/modular/modular-list/category');break;
				case	'tags':		get_template_part( 'template-parts/modular/modular-list/tags');break;
				case	'see':		get_template_part( 'template-parts/modular/modular-list/see');break;
				case	'comment':	get_template_part( 'template-parts/modular/modular-list/comment');break;
				case	'list_ad':	get_template_part( 'template-parts/modular/modular-list/list_ad');break;
			}
			endforeach;			

	endif;
?>