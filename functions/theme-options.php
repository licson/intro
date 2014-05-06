<?php
$themename = "Intro";
$shortname = "intro_";
$options = array(
	array(
		"type" => "section",
		"desc" => '<div class="op_section">',
		"name" => "Icons"
	) ,
	array(
		"name" => "Favicon",
		"id" => $shortname . "favicon",
		"type" => "upload",
		"std" => "",
		"desc" => 'The icon shown at the title bar and favourites.'
	) ,
	array(
		"name" => "Banner picture",
		"id" => $shortname . "banner",
		"type" => "upload",
		"std" => "",
		"desc" => "Upload your own banner image."
	) ,
	array(
		"type" => "section",
		"desc" => '</div><div class="op_section">',
		"name" => "Feel and Looks"
	) ,
	array(
		"name" => "Enable AJAX Navigation",
		"id" => $shortname . "ajax",
		"type" => "checkbox",
		"std" => "",
		"desc" => "Use AJAX to load pages without refresh. This may cause some problems with plugins like Disqus so if that bothers you, try disabling this."
	) ,
	array(
		"name" => "Enable Custom Scrollbars",
		"id" => $shortname . "scrollbars",
		"type" => "checkbox",
		"std" => "",
		"desc" => "Use the theme's custom scrollbars instead of the browser one."
	) ,
	array(
		"name" => "Show author information",
		"id" => $shortname . "author",
		"type" => "checkbox",
		"std" => true,
		"desc" => "Show the description of the author"
	) ,
	array(
		"name" => "Custom CSS",
		"id" => $shortname . "custom_css",
		"type" => "textarea",
		"std" => "",
		"desc" => "Enter your custom CSS here."
	) ,
	array(
		"name" => "Analytics Code",
		"id" => $shortname . "analytics",
		"type" => "textarea",
		"std" => "",
		"desc" => "Put your analytics code here."
	) ,
	array(
		"name" => "Footer Text",
		"id" => $shortname . "footer_text",
		"type" => "text",
		"std" => "Theme Intro by Licson.",
		"desc" => "Show extra piece of text at the footer."
	) ,
	array(
		"type" => "section",
		"desc" => '</div><div class="op_section">',
		"name" => "Ads"
	) ,
	array(
		"name" => "Post Ads",
		"id" => $shortname . "post_ads",
		"type" => "textarea",
		"std" => "",
		"desc" => "Put your ads code here."
	) ,
	array(
		"type" => "section",
		"desc" => '</div>',
	)
);
global $options, $value, $shortname;

function mytheme_add_admin()
{
	global $themename, $shortname, $options;
	if ($_GET['page'] == 'intro_theme_options') {
		if ('save' == $_REQUEST['action']) {
			foreach($options as $value) {
				update_option($value['id'], $_REQUEST[$value['id']]);
			}

			foreach($options as $value) {
				if (isset($_REQUEST[$value['id']])) {
					update_option($value['id'], $_REQUEST[$value['id']]);
				}
				else {
					delete_option($value['id']);
				}
			}

			header("Location: admin.php?page=intro_theme_options&saved=true");
			die;
		}
		else
		if ('reset' == $_REQUEST['action']) {
			foreach($options as $value) {
				delete_option($value['id']);
			}

			header("Location: admin.php?page=intro_theme_options&reset=true");
			die;
		}
	}

	add_theme_page($themename, $themename . ' Settings', 'administrator', 'intro_theme_options', 'mytheme_admin');
}

function mytheme_add_init()
{
	global $themename, $shortname, $options;
	$theme_dir = get_bloginfo('template_directory');
	wp_enqueue_style("style", $theme_dir . "/functions/css/op_styles.css", false, "1.0", "all");
	wp_enqueue_script("uploader", $theme_dir . "/functions/js/custom_uploader.js");
	wp_enqueue_media();
}

add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

function mytheme_admin()
{
	global $themename, $shortname, $options;
?>
<div class="op_wrapper">
    <h2><?php echo $themename; ?> Settings</h2>
	<?php
		if ($_REQUEST['saved']) echo '<div id="message" class="updated fade"><p>' . $themename . ' Theme Settings Saved</p></div>';
		if ($_REQUEST['reset']) echo '<div id="message" class="updated fade"><p>' . $themename . ' Theme Settings Resetted.</p></div>';
	?>
    <div class="op_content">
        <form method="post" class="op_form" enctype="multipart/form-data">
        <?php
	foreach($options as $value) {
		switch ($value['type']) {
		case 'section' :
			echo $value['desc']; ?>
			<?php if ($value['name']) { ?>
			<div class="section_title">
				<span><?php echo $value['name']; ?></span>
			</div>
			<?php } ?>
        <?php
		break;
		case 'upload':
?>
		<div class="op_input op_text">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
			<input id="<?php echo $value['id']; ?>" class="upload_input" type="text" size="90" name="<?php echo $value['id']; ?>" value="<?php echo (get_option($value['id'])); ?>" />
			<div class="upload_button">
				<input class="upload_image_button" id="upload_image_button" type="button" value="Select" />
			</div>
			<small><?php echo $value['desc']; ?></small>
			<?php
				$preview = get_option($value['id']);
				if ($preview) { ?>
			<div class="upload_preview">Preview</div>
				<img src="<?php echo (get_option($value['id'])); ?>" class="up_img">
			<?php } ?>
			<div class="clear"></div>
		</div>
        <?php
		break;
		case 'text':
?>
		<div class="op_input op_text">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
			<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php
				if (get_option($value['id']) != "") {
					echo stripslashes(get_option($value['id']));
				}
				else {
					echo $value['std'];
				} ?>" />
			<small><?php echo $value['desc']; ?></small>
			<div class="clear"></div>
		</div>
        <?php
		break;
		case 'textarea':
?>
		<div class="op_input op_textarea">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
			<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"><?php
				if (get_option($value['id']) != "") {
					echo stripslashes(get_option($value['id']));
				}
				else {
					echo $value['std'];
				} ?></textarea>
			<small><?php echo $value['desc']; ?></small>
			<div class="clear"></div>
		</div>
        <?php
		break;
		case 'select':
?>
		<div class="op_input op_select">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
			<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php
				foreach($value['options'] as $option) { ?>
					<option <?php
					if (get_option($value['id']) == $option) {
						echo 'selected="selected"';
					} ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			<small><?php echo $value['desc']; ?></small>
			<div class="clear"></div>
		</div>
<?php
		break;
		case "checkbox":
?>
		<div class="op_input op_checkbox">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
			<?php
				if (get_option($value['id'])) {
					$checked = "checked=\"checked\"";
				}
				else {
					$checked = "";
				} ?>
		 
			<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
			<small><?php echo $value['desc']; ?></small>
			<div class="clear"></div>
		</div>
<?php
		break;
	}
}

?>
    <input type="hidden" name="action" value="save" />
    <input name="save" class="save" type="submit" value="Save" />
</form>
<form method="post">
    <input name="reset" class="reset" type="submit" value="Reset all changes" />
    <input type="hidden" name="action" value="reset" />
</form>
</div>
</div>
<?php
}