/**
 * equalize.js
 * Author & copyright (c) 2012: Tim Svensen
 * Dual MIT & GPL license
 *
 * Page: http://tsvensen.github.com/equalize.js
 * Repo: https://github.com/tsvensen/equalize.js/
 */
(function(b){b.fn.equalize=function(a){var d=!1,g=!1,c,e;b.isPlainObject(a)?(c=a.equalize||"height",d=a.children||!1,g=a.reset||!1):c=a||"height";if(!b.isFunction(b.fn[c]))return!1;e=0<c.indexOf("eight")?"height":"width";return this.each(function(){var a=d?b(this).find(d):b(this).children(),f=0;a.each(function(){var a=b(this);g&&a.css(e,"");a=a[c]();a>f&&(f=a)});a.css(e,f+"px")})}})(jQuery);

/**
 * Intro Theme-specific JS
 * Author & copyright (c) 2014 - Licson Lee
 * GPL Licensed
 */

jQuery(function($){
	var searchFieldFocused = false;
	
	var adjustSettings = function(){
		if(window.innerWidth <= 768) {
			if(IntroThemeSettings.scrollbars) $('#site-menu').removeClass('flexcroll');
			
			if(!searchFieldFocused){
				$('#site-menu').css({
					height: 60
				});
			}
			
			cancelWidgetHeight();
		}
		else if(window.innerWidth > 768) {
			if(IntroThemeSettings.scrollbars) $('#site-menu').addClass('flexcroll');
			$('#site-menu').css({
				bottom: 0,
				height: '100%'
			})

			equalizeWidgetHeight();
		}
		fleXenv.updateScrollBars();
	};
	
	var equalizeWidgetHeight = function(){
		$('#widgets').equalize({reset: true});
	};
	
	var cancelWidgetHeight = function(){
		$('.footer_widget').attr("style", "");
	};
	
	var loadPage = function(url, effects){
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'html',
			beforeSend: function(){
				$('#ajax-loader').fadeIn(250);
				if($('#site-menu').outerHeight() > 80 && $('#mobile-show').is(':visible')){
					$('#site-menu').animate({
						height: 60
					}, 500);
				}
			},
			success: function(data){
				$('#ajax-loader').fadeOut(250);
				
				var nodes = $.parseHTML(data, null, true);
				window.history.pushState(null, nodes[3].textContent, url);
				document.title = nodes[3].textContent;
				
				if(effects){
					$('#content').fadeOut(250, function(){
						$('#content').replaceWith($('#content', nodes).hide());
						$('#content').fadeIn(250);
						if(window.innerWidth > 768) equalizeWidgetHeight();
						if(IntroThemeSettings.scrollbars) fleXenv.initByClass('flexcroll');
					});
				}
				else {
					$('#content').replaceWith($('#content', nodes));
					if(window.innerWidth > 768) equalizeWidgetHeight();
					if(IntroThemeSettings.scrollbars) fleXenv.initByClass('flexcroll');
				}
			}
		});
	};
	
	$('#search-button').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		$('#search').slideToggle();
	});
	
	$('body').on('click', '#container a', function(e){
		if(this.href.indexOf(window.location.host) > -1 || !(/^https?:\/\//i).test(this.href)) {
			if(!(/(wp-login|feed|rss|wp-admin|png|jpg|jpeg|gif|psd|mp3|mp4|ts|mpg|wmv|aac)/i.test(this.href)) && !(/#/g.test(this.href))) {
				if(window.history.pushState && IntroThemeSettings.ajax_navigation) {
					e.preventDefault();
					var useEffect = !$(this).hasClass('comment-reply-link');
					loadPage(this.href, useEffect);
				}
			}
		}
	});
	
	$('body').on('submit', '.form-search', function(e){
		e.preventDefault();
		var search = $(this).find('.search').val();
		loadPage($(this).attr('action') + '?s=' + search, true);
	});
	
	$('body').on('focus', '.form-search .search', function(e){
		searchFieldFocused = true;
	});
	
	$('body').on('blur', '.form-search .search', function(e){
		searchFieldFocused = false;
	});
	
	$(window).one('popstate', function(e){
		$(window).on('popstate', function(e){
			loadPage(window.location.pathname + window.location.search, true);
		});
	});
	
	$('#mobile-show').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		if($('#site-menu').outerHeight() > 60){
			$('#site-menu').animate({
				height: 60
			}, 500);
		}
		else {
			$('#site-menu').animate({
				height: $('#site-menu')[0].scrollHeight + 60
			}, 500);
		}
	});
	
	if(!IntroThemeSettings.scrollbars) {
		$('#site-menu, #content').removeClass('flexcroll');
	}
	
	adjustSettings();
	$(window).on('resize', function(){
		adjustSettings();
	});
});