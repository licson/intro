			<div id="site-menu" class="flexcroll">
				<div class="clearfix">
					<h1><a href="<?php echo site_url(); ?>" title="Go Home"><?php bloginfo('name');?></a></h1>
					<span id="mobile-show"> </span>
				</div>
				<!-- Nav -->
				<nav>
				<?php
				wp_nav_menu(array(
					'depth' => 6,
					'sort_column' => 'menu_order',
					'container' => 'ul',
					'menu_id' => 'main-nav',
					'menu_class' => 'menu',
					'theme_location' => 'primary-menu'
				));
                ?>
				</nav>
				<!-- Search box -->
				<a href="#" id="search-button">Search</a>
				<div id="search">
					<?php get_search_form(); ?>
				</div>
				<div id="footer">
					<p><?php echo get_option('intro_footer_text'); ?></p>
					<p>Powered by <a href="http://wordpress.org/">WordPress</a>.</p>
				</div>
			</div>