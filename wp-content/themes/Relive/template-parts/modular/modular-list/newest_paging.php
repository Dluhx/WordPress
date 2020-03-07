<?php
if ( !get_query_var('paged') ) { //分页不显示模块
    switch ( $id['modular_style_list_newest_paging'] ) {
        case '1':
			get_template_part( 'template-parts/modular/newest-paging/content-list');
            break;
        case '2':
			get_template_part( 'template-parts/modular/newest-paging/content-grid');
            break;
    }
}
?>