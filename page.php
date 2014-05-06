<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="content" class="flexcroll">
	<?php while (have_posts()) : the_post(); ?>
	<div id="banner">
		<h2><?php the_title(); ?></h2>
	</div>
	
	<article>
		<header class="entry-header">
			<?php if(has_post_thumbnail()): ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php endif; ?>
			<div class="postmeta">
				<span class="ion-ios7-clock-outline"></span>
				<span class="entry-time"><?php the_time('Y/m/d'); ?></span> 
				<span class="ion-ios7-chatboxes-outline"></span>
				<span class="entry-comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
			</div>
		</header>
		<div class="entry-content">
			<?php the_content('More...');?>
		</div>
		<p class="head"><?php wp_link_pages(array('before' => 'Pages: ', 'after' => '', 'next_or_number' => 'number')); ?></p>
		<div class="entry-tags">Tags: <?php has_tag() ? the_tags('', ',', '') : print('None') ; ?>.</div>
	</article>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
	<div id="comments">
	<?php comments_template(); ?>
	</div>
<?php get_footer(); ?>