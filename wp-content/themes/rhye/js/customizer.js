'use strict';

const
	$page = jQuery('#page-wrapper'),
	$header = jQuery('#page-header'),
	$headerCurtain = jQuery('.header__curtain'),
	$headerContainer = jQuery('.header__container'),
	$section404 = jQuery('.section-404'),
	$sectionBlog = jQuery('.section-blog'),
	$sectionBlogContainer = $sectionBlog.find('.section-blog__container'),
	$sectionMasthead = jQuery('.section-masthead'),
	$mastheadHeading = $sectionMasthead.find('.section-masthead__heading'),
	$wrapperPost = $sectionBlog.find('.section-blog__wrapper-post'),
	isSinglePost = jQuery('body').hasClass('single-post'),
	$footer = jQuery('#page-footer'),
	$footerContainer = $footer.find('.footer__container'),
	$footerAreaUpper = $footer.find('.footer__area_upper'),
	$footerAreaLower = $footer.find('.footer__area_lower'),
	$portfolioNavNext = jQuery('.section-nav-projects__subheading, #page-bottom-nav .section-list__wrapper-item_next .list-projects__subheading'),
	$portfolioNavPrev = jQuery('#page-bottom-nav .section-list__wrapper-item_prev .list-projects__subheading'),
	$portfolioNavHeading = jQuery('.section-nav-projects__heading, #page-bottom-nav .list-projects__heading'),
	$burger = jQuery('#js-burger'),
	buttonStyles = [
		'button_solid',
		'button_bordered',
	],
	colorThemes = [
		'bg-dark-1',
		'bg-dark-2',
		'bg-dark-3',
		'bg-dark-4',
		'bg-light-1',
		'bg-light-2',
		'bg-light-3',
		'bg-light-4',
		'bg-white',
		'bg-gray-1',
		'bg-gray-2',
	],
	headerColors = [
		'dark',
		'light'
	],
	logoThemes = [
		'primary',
		'secondary'
	],
	typography = [
		'xl',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'paragraph',
		'blockquote',
		'subheading',
		'small'
	],
	ornamentClass = 'bg-ornament',
	stringColorThemes = colorThemes.join(' '),
	stringHeaderColors = headerColors.join(' '),
	stringButtonStyles = buttonStyles.join(' '),
	stringLogoThemes = logoThemes.join(' '),
	stringTypography = typography.join(' ');

/**
 * Blog Sidebar Position
 */
wp.customize('sidebar_position', (value) => {
	value.bind((newval) => {
		if (newval === 'left_side') {
			jQuery('.section-blog__posts, .section-blog__col-post').removeClass('order-lg-1').addClass('order-lg-2');
			jQuery('.section-blog__sidebar').removeClass('order-lg-2').addClass('order-lg-1');
		} else {
			jQuery('.section-blog__posts, .section-blog__col-post').removeClass('order-lg-2').addClass('order-lg-1');
			jQuery('.section-blog__sidebar').removeClass('order-lg-1').addClass('order-lg-2');
		}
	});

});

/**
 * Blog Home: Color Theme
 */
wp.customize('blog_style_theme', (value) => {
	value.bind((newval) => {
		if ($sectionBlog.length && !isSinglePost) { // Blog homepage
			$page.add($sectionBlog).removeClass(stringColorThemes).addClass(newval);
		}
	});
});

/**
 * Blog Home: Main Elements Color
 */
wp.customize('blog_style_main_theme', (value) => {
	value.bind((newval) => {
		if ($sectionBlog.length && !isSinglePost) { // Blog homepage
			$page.add($sectionBlog).attr('data-arts-theme-text', newval);
		}
	});
});

/**
 * Blog Home: Posts Headings
 */
wp.customize('blog_posts_heading_preset', (value) => {
	value.bind((newval) => {
		if ($sectionBlog.length && !isSinglePost) {
			jQuery('.figure-post__header h2').removeClass(stringTypography).addClass(newval);
		}
	});
});

/**
 * Blog Single Post: Color Theme
 */
wp.customize('blog_style_single_post_theme', (value) => {
	value.bind((newval) => {
		if ($sectionBlog.length && isSinglePost) { // Blog homepage
			$page.add($sectionBlog).removeClass(stringColorThemes).addClass(newval);
		}
	});
});

/**
 * Blog Single Post: Main Elements Color
 */
wp.customize('blog_style_single_post_main_theme', (value) => {
	value.bind((newval) => {
		if ($sectionBlog.length && isSinglePost) { // Blog homepage
			$page.add($sectionBlog).attr('data-arts-theme-text', newval);
		}
	});
});

/**
 * Blog Single Post: Posts Headings
 */
wp.customize('blog_single_post_heading_preset', (value) => {
	value.bind((newval) => {
		if ($sectionMasthead.length && isSinglePost) { // single post
			$mastheadHeading.html($mastheadHeading.text()).removeClass(stringTypography).addClass(newval);
		}
	});
});

/**
 * Blog: Container
 */
wp.customize('blog_container', (value) => {
	value.bind((newval) => {
		$sectionBlogContainer.removeClass('container container-fluid').addClass(newval);
	});
})

/**
 * Page 404: Title
 */
wp.customize('404_title', (value) => {
	value.bind((newval) => {
		$section404.find('.section-content__heading > *').html(newval);
	});
});

/**
 * Page 404: Message
 */
wp.customize('404_message', (value) => {
	value.bind((newval) => {
		$section404.find('.section-content__text > *').html(newval);
	});
});

/**
 * Page 404: Section Theme
 */
wp.customize('404_theme', (value) => {
	value.bind((newval) => {
		$section404.removeClass(stringColorThemes).addClass(newval);
	});
});

/**
 * Page 404: Main Color Theme
 */
wp.customize('404_main_theme', (value) => {
	value.bind((newval) => {
		$section404.attr('data-arts-theme-text', newval);
	});
});

/**
 * Page 404: Button Label
 */
wp.customize('404_button_label', (value) => {
	value.bind((newval) => {
		$section404.find('.section-content__button .button__label-hover').html(newval);
		$section404.find('.section-content__button .button').attr('data-hover', newval);
	});
});

/**
 * Page 404: Button Style
 */
wp.customize('404_button_style', (value) => {
	value.bind((newval) => {
		$section404.find('.section-content__button .button').removeClass(stringButtonStyles).addClass(newval);
	});
});

/**
 * Page 404: Button Theme
 */
wp.customize('404_button_theme', (value) => {
	value.bind((newval) => {
		$section404.find('.section-content__button .button').removeClass(stringColorThemes).addClass(newval);
	});
});

/**
 * Header Container
 */
wp.customize('header_container', (value) => {
	value.bind((newval) => {
		$headerContainer.removeClass('container container-fluid').addClass(newval);
	});
});

/**
 * Footer: Container
 */
wp.customize('footer_container', (value) => {
	value.bind((newval) => {
		$footerContainer.removeClass('container container-fluid').addClass(newval);
	});
});

/**
 * Footer: Color Theme
 */
wp.customize('footer_theme', (value) => {
	value.bind((newval) => {
		$footer.removeClass(stringColorThemes).addClass(newval);
	});
});

/**
 * Footer: Main Elements Color
 */
wp.customize('footer_main_theme', (value) => {
	value.bind((newval) => {
		$footer.attr('data-arts-theme-text', newval);
	});
});

/**
 * Footer: Logo to Display
 */
wp.customize('footer_main_logo', (value) => {
	value.bind((newval) => {
		$footer.attr('data-arts-footer-logo', newval);
	});
});

/**
 * Footer: Border Upper Section
 */
wp.customize('footer_border_enabled_upper', (value) => {
	value.bind((newval) => {
		if (newval) {
			$footerAreaUpper.addClass('footer__area-border-top');
		} else {
			$footerAreaUpper.removeClass('footer__area-border-top');
		}
	});
});

/**
 * Footer: Border Lower Section
 */
wp.customize('footer_border_enabled_lower', (value) => {
	value.bind((newval) => {
		if (newval) {
			$footerAreaLower.attr('class', 'pt-sm-2 pb-sm-0-5 pt-2 pb-0 footer__area-border-top');
		} else {
			$footerAreaLower.attr('class', 'pb-sm-0-5 pb-0');
		}
	});
});

/**
 * Portfolio Nav: Next Label
 */
wp.customize('portfolio_nav_next_label', (value) => {
	value.bind((newval) => {
		$portfolioNavNext.html(newval);
	});
});

/**
 * Portfolio Nav: Prev Label
 */
wp.customize('portfolio_nav_prev_label', (value) => {
	value.bind((newval) => {
		$portfolioNavPrev.html(newval);
	});
});

/**
 * Portfolio Nav: Headings
 */
wp.customize('portfolio_nav_headings_preset', (value) => {
	value.bind((newval) => {
		$portfolioNavHeading.removeClass(stringTypography).addClass(newval);
	});
});

/**
 * Portfolio Nav: Labels
 */
wp.customize('portfolio_nav_labels_preset', (value) => {
	value.bind((newval) => {
		$portfolioNavPrev.add($portfolioNavNext).removeClass(stringTypography).addClass(newval);
	});
});

/**
 * Burger Button Style
 */
wp.customize('header_overlay_menu_burger_style', (value) => {
	value.bind((newval) => {
		$burger.removeClass('header__burger_2-lines').addClass(newval);
	});
});
