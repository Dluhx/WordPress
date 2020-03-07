<?php 
if ( !get_query_var('paged') ) { //分页不显示模块
    switch ( $id['modular_style_list_category'] ) {
        case '1':
			get_template_part( 'template-parts/modular/category/list-1');
            break;
        case '2':
			get_template_part( 'template-parts/modular/category/list-2');
            break;
        case '3':
			get_template_part( 'template-parts/modular/category/list-3');
            break;
        case '4':
			get_template_part( 'template-parts/modular/category/list-4');
            break;
        case '5':
			get_template_part( 'template-parts/modular/category/list-5');
            break;
        case '6':
			get_template_part( 'template-parts/modular/category/list-6');
            break;
        case '7':
			get_template_part( 'template-parts/modular/category/list-7');
            break;
        case '8':
			get_template_part( 'template-parts/modular/category/list-8');
            break;
        case '9':
			get_template_part( 'template-parts/modular/category/list-9');
            break;
        case '10':
			get_template_part( 'template-parts/modular/category/list-10');
            break;
    }
}
?>