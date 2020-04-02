<?php 
if ( !get_query_var('paged') ) { //分页不显示模块
    switch ( $id['modular_style_list_tags'] ) {
        case '1':
			get_template_part( 'template-parts/modular/tags/list-1');
            break;
        case '2':
			get_template_part( 'template-parts/modular/tags/list-2');
            break;
        case '3':
			get_template_part( 'template-parts/modular/tags/list-3');
            break;
        case '4':
			get_template_part( 'template-parts/modular/tags/list-4');
            break;
        case '5':
			get_template_part( 'template-parts/modular/tags/list-5');
            break;
        case '6':
			get_template_part( 'template-parts/modular/tags/list-6');
            break;
        case '7':
			get_template_part( 'template-parts/modular/tags/list-7');
            break;
        case '8':
			get_template_part( 'template-parts/modular/tags/list-8');
            break;
        case '9':
			get_template_part( 'template-parts/modular/tags/list-9');
            break;
        case '10':
			get_template_part( 'template-parts/modular/tags/list-10');
            break;
    }
}
?>