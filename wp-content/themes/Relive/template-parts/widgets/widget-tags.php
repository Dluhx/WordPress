<?php  
add_action('widgets_init', function(){register_widget('xintheme_tag' );});
class xintheme_tag extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'xintheme_tag', 'description' => '显示文章标签' );
		parent::__construct('xintheme_tag', '标签云（热门标签） ', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		$title = apply_filters('widget_name', $instance['title']);
		$offset = $instance['offset'];
		$count = $instance['count'];
		$hot = $instance['hot'];
		echo $before_title.$title.$after_title; 
		echo xintheme_hot_tag_list($count , $hot , $offset);
		echo $after_widget;
	}

	function form($instance) {
	    $instance = wp_parse_args( (array) $instance, array( 
			'title' => '热门标签',
			'count' => '15',
			'offset' => '0',
			//'hot' => '5',
			) 
		);
?>

<p>
	<label> 名称：
		<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label> 显示数量：
		<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" value="<?php echo $instance['count']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label> 去除前几个：
		<input id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="number" value="<?php echo $instance['offset']; ?>" class="widefat" />
	</label>
</p>
<!--p>
	<label> 热门标签规则（超过此数则为热门标签）：
		<input id="<?php // echo $this->get_field_id('hot'); ?>" name="<?php // echo $this->get_field_name('hot'); ?>" type="number" value="<?php // echo $instance['hot']; ?>" class="widefat" />
	</label>
</p-->
<?php
	}
}

?>
