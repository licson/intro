<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="content" class="flexcroll">
	<div id="banner">
		<h2><?php bloginfo('description'); ?></h2>
	</div>
	
	<?php while (have_posts()) : the_post(); ?>
	<article>
		<header class="entry-header">
			<?php if(has_post_thumbnail()): ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php endif; ?>
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<div class="postmeta">
				<span class="ion-ios7-clock-outline"></span>
				<span class="entry-time"><?php the_time('Y/m/d'); ?></span> 
				<span class="ion-ios7-photos-outline"></span>
				<span class="entry-cate"><?php the_category(','); ?></span> 
				<span class="ion-ios7-chatboxes-outline"></span>
				<span class="entry-comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
			</div>
		</header>
		<div class="entry-content">
			<?php the_content('More...');?>
		</div>
		<p class="head"><?php wp_link_pages(array('before' => 'Pages: ', 'after' => '', 'next_or_number' => 'number')); ?></p>
		<div class="entry-tags"><?php has_tag() ? the_tags('', ', ', '') : print('None') ; ?> <span class="ion-pricetags"></span></div>
	</article>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
	<?php if(get_option('intro_author')){ ?>
	<div class="author-profile clearfix">
		<div class="author-avatar"><?php echo get_avatar(get_the_author_meta('ID'), 90); ?></div>
		<div class="author-desc">
			<span class="author-name"><?php the_author_meta('display_name'); ?></span>
			<p><?php the_author_meta('description'); ?></p>
			<p><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">More posts of <?php the_author_meta('display_name'); ?>.</a></p>
		</div>
	</div>
	<?php } ?>
	<div id="comments">
	<?php comments_template(); ?>
	</div>
<?php get_footer(); ?>