<?php
if ( !get_query_var('paged') ) { //分页不显示模块
    switch ( $id['modular_style_list_comment'] ) {
        case '1':
			get_template_part( 'template-parts/modular/comment/list-1');
            break;
        case '2':
			get_template_part( 'template-parts/modular/comment/list-2');
            break;
        case '3':
			get_template_part( 'template-parts/modular/comment/list-3');
            break;
        case '4':
			get_template_part( 'template-parts/modular/comment/list-4');
            break;
        case '8':
			get_template_part( 'template-parts/modular/comment/list-8');
            break;
        case '9':
			get_template_part( 'template-parts/modular/comment/list-9');
            break;
        case '10':
			get_template_part( 'template-parts/modular/comment/list-10');
            break;
    }
}
?>