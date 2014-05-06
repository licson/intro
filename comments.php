<?php
if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die();
if(post_password_required()) { ?>
	<p class="head">Please enter password to view this post.</p>
<?php
	return;
}
?>
<p class="head"><?php comments_number('No Comments', 'One Comment', '% Comments' ); ?> </p>
<?php if(have_comments()): ?>
<?php wp_list_comments('type=comment&callback=intro_comment_block'); ?>
<div class="comment-navigation">
	<div class="older"><?php previous_comments_link() ?></div>
	<div class="newer"><?php next_comments_link() ?></div>
</div>
<?php endif; ?>

<form id="respond" method="POST" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php">
	<p class="head"><?php comment_form_title('Leave a comment', 'In response to %s'); ?></p>

	<?php if(get_option('comment_registration') && !is_user_logged_in()) : ?>
	<p>You need to <a href="<?php echo wp_login_url(get_permalink()); ?>">login</a> to be able to comment.</p>
	<?php else : ?>
	<?php if(is_user_logged_in()): ?>
	<p>Login as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
	<?php endif; ?>
	<?php endif; ?>
	<?php cancel_comment_reply_link(); ?>
	
	<?php if(!is_user_logged_in()): ?>
	<p class="form-controls">
		<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="author">Your name <?php if($req) echo "<strong>*</strong>"; ?></label>
	</p>
	<p class="form-controls">
		<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="email">Your E-Mail <?php if($req) echo "<strong>*</strong>"; ?></label>
	</p>
	<p class="form-controls">
		<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
		<label for="url">Your Site</label>
	</p>
	<?php endif; ?>
	<p class="form-controls">
		<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
		<label for="comment">Your comment</label>
	</p>
	<p><small>You can use these HTML tags: <code><?php echo allowed_tags(); ?></code></small></p>
	<input name="submit" class="comm_button" type="submit" id="submit" tabindex="5" value="Comment!" />
	<?php comment_id_fields(); ?>
	<?php do_action('comment_form', $post->ID); ?>
</form>