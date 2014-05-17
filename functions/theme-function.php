<?php
add_theme_support('post-thumbnails'); 
add_theme_support('html5');

register_nav_menus(array(
	'primary-menu' => __('Main Menu')
));

register_sidebar(array(
	'name' => 'Bottom Widget Area',
	'id' => 'bottom_widgets',
	'description' => 'Widget area near the footer',
	'before_widget' => '<div class="footer_widget">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="widget_title">',
	'after_title' => '</h4>'
));

function adsense_adder_at_more_tag($text) {
	if(is_single()){
		$ads_text = get_option('intro_post_ads');
		$pos1 = strpos($text, '<span id="more-');
		$pos2 = strpos($text, '</span>', $pos1);
		$text1 = substr($text, 0, $pos2);
		$text2 = substr($text, $pos2);
		$text = $text1 . stripslashes($ads_text) . $text2;
	}
	
	return $text;
};

add_filter('the_content', 'adsense_adder_at_more_tag');

function pagenavi($msg){
	global $paged, $wp_query;
	$max_page = $wp_query->max_num_pages;
	
	if($paged == 0 && $max_page > 1){
		echo sprintf("<a href=\"%s\">Next Page</a>", get_pagenum_link($paged + 2));
	}
	else if($paged > 0 && $paged < $max_page){
		echo sprintf("<a href=\"%s\">Previous Page</a> | <a href=\"%s\">Next Page</a>", get_pagenum_link($paged - 1), get_pagenum_link($paged + 1));
	}
	else if($paged == $max_page && ($paged > 0 && $max_page > 0)){
		echo sprintf("<a href=\"%s\">Previous Page</a>", get_pagenum_link($paged - 1));
	}
	else {
		if($msg) echo '<em>No more posts to display.</em>';
	}
}

function intro_comment_block($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;
?>
<div <?php comment_class(); ?> id="comment-<?php comment_id(); ?>">
	<div class="vcard clearfix">
		<?php echo get_avatar($comment, 36, ''); ?>
		<?php echo sprintf(__('<span class="fn">%s</span>'), get_comment_author_link()); ?>
    </div>
	<div class="comment-meta">
		<?php
			echo sprintf(__('%1$s @ %2$s'), get_comment_date(), get_comment_time());
			edit_comment_link(__('(Edit)'), '  ', '');
		?>
	</div>
	<?php if($comment->comment_approved == '0'){ ?>
	<em class="comment_waiting"><?php _e('Your comment is awaiting moderation.') ?></em>
	<?php } ?>
	<div class="comment-content">
	<?php comment_text() ?>
	</div>
	<div class="reply">
		<?php comment_reply_link(array_merge($args, array(
			'depth' => $depth,
			'max_depth' => $args['max_depth']
		))) ?>
	</div>
</div>
<?php
}