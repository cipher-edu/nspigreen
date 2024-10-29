'use strict';

/**
 * Elementor Document Settings
 * Live Preview
 */
(function (elementor) {
  elementor.once('preview:loaded', () => {

    const classes = {
      backgrounds: ['bg-dark-1', 'bg-dark-2', 'bg-dark-3', 'bg-dark-4', 'bg-light-1', 'bg-light-2', 'bg-light-3', 'bg-light-4', 'bg-white', 'bg-gray-1', 'bg-gray-2'],
      pt: ['pt-xsmall', 'pt-small', 'pt-medium', 'pt-large', 'pt-xlarge'],
      pb: ['pb-xsmall', 'pb-small', 'pb-medium', 'pb-large', 'pb-xlarge'],
      mt: ['mt-xsmall', 'mt-small', 'mt-medium', 'mt-large', 'mt-xlarge'],
      mb: ['mb-xsmall', 'mb-small', 'mb-medium', 'mb-large', 'mb-xlarge'],
      align: ['text-left', 'text-center', 'text-right'],
      container: ['section_w-container-left', 'container', 'container-fluid', 'section_w-container-right', 'w-100'],
      typography: ['xl', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'paragraph', 'blockquote', 'subheading']
    };

    /**
     * Page Header Overrides
     */
    elementor.settings.page.addChangeCallback('page_header_settings_overridden', () => {
      reloadPreview('page_settings', 'settings', 'page_header_section');
    });

    elementor.settings.page.addChangeCallback('page_header_main_theme', () => {
      reloadPreview('page_settings', 'settings', 'page_header_section');
    });

    elementor.settings.page.addChangeCallback('page_header_main_logo', () => {
      reloadPreview('page_settings', 'settings', 'page_header_section');
    });

    elementor.settings.page.addChangeCallback('page_header_sticky_theme', () => {
      reloadPreview('page_settings', 'settings', 'page_header_section');
    });

    elementor.settings.page.addChangeCallback('page_header_sticky_logo', () => {
      reloadPreview('page_settings', 'settings', 'page_header_section');
    });

    elementor.settings.page.addChangeCallback('page_header_overlay_menu_theme', () => {
      reloadPreview('page_settings', 'settings', 'page_header_section');
    });

    /**
     * Page Footer Overrides
     */
    elementor.settings.page.addChangeCallback('page_footer_settings_overridden', () => {
      reloadPreview('page_settings', 'settings', 'page_footer_section');
    });

    elementor.settings.page.addChangeCallback('page_footer_theme', (newval) => {
      jQuery(elementor.$previewContents).find('#page-footer').removeClass(classes.backgrounds.join(' ')).addClass(newval);
    });

    elementor.settings.page.addChangeCallback('page_footer_main_theme', (newval) => {
      jQuery(elementor.$previewContents).find('#page-footer').attr('data-arts-theme-text', newval);
    });

    elementor.settings.page.addChangeCallback('page_footer_main_logo', (newval) => {
      jQuery(elementor.$previewContents).find('#page-footer').attr('data-arts-footer-logo', newval);
    });

    elementor.settings.page.addChangeCallback('page_footer_border_enabled_upper', (newval) => {
      if (newval) {
        jQuery(elementor.$previewContents).find('#page-footer .footer__area_upper').addClass('footer__area-border-top');
      } else {
        jQuery(elementor.$previewContents).find('#page-footer .footer__area_upper').removeClass('footer__area-border-top');
      }
    });

    elementor.settings.page.addChangeCallback('page_footer_border_enabled_lower', (newval) => {
      if (newval) {
        jQuery(elementor.$previewContents).find('#page-footer .footer__area_lower').addClass('pt-sm-3 pb-sm-1 pt-2 pb-0 footer__area-border-top');
      } else {
        jQuery(elementor.$previewContents).find('#page-footer .footer__area_lower').removeClass('pt-sm-3 pb-sm-1 pt-2 pb-0 footer__area-border-top');
      }
    });

    elementor.settings.page.addChangeCallback('page_footer_hide', () => {
      reloadPreview('page_settings', 'settings', 'page_footer_section');
    });

    /**
     * Page Portfolio Nav
     */
    elementor.settings.page.addChangeCallback('page_portfolio_nav_settings_overridden', () => {
      reloadPreview('page_settings', 'settings', 'page_portfolio_nav_section');
    });

    elementor.settings.page.addChangeCallback('page_portfolio_nav_background', (newval) => {
      jQuery(elementor.$previewContents).find('#page-bottom-nav').removeClass(classes.backgrounds.join(' ')).addClass(newval);
    });

    elementor.settings.page.addChangeCallback('page_portfolio_nav_theme', (newval) => {
      jQuery(elementor.$previewContents).find('#page-bottom-nav').attr('data-arts-theme-text', newval);
    });

    elementor.settings.page.addChangeCallback('page_portfolio_nav_divider_enabled', (newval) => {
      if (newval) {
        jQuery(elementor.$previewContents).find('#page-bottom-nav .section__divider').addClass('section__divider_top').removeClass('d-none');
      } else {
        jQuery(elementor.$previewContents).find('#page-bottom-nav .section__divider').removeClass('section__divider_top').addClass('d-none');
      }
    });

    /**
     * Page Background
     */
    elementor.settings.page.addChangeCallback('page_color_theme_background', (newval) => {
      jQuery(elementor.$previewContents).find('#page-wrapper').removeClass(classes.backgrounds.join(' ')).addClass(newval);
    });

    /**
     * Page Color Theme
     */
    elementor.settings.page.addChangeCallback('page_color_theme_theme', (newval) => {
      jQuery(elementor.$previewContents).find('#page-wrapper').attr('data-arts-theme-text', newval);
    });

    /**
     * Layout
     */
    elementor.settings.page.addChangeCallback('page_masthead_content_alignment', (newval) => {
      const $header = jQuery(elementor.$previewContents).find('.section-masthead__header_absolute');

      jQuery(elementor.$previewContents).find('.section-masthead .split-text__line').css('text-align', '');

      // is halfscreen with properties
      if ($header.length) {
        $header.removeClass(classes.align.join(' ')).addClass(newval);
        jQuery(elementor.$previewContents).find('.section-masthead__scroll-down').removeClass(classes.align.join(' ')).addClass(newval);
      } else {
        jQuery(elementor.$previewContents).find('.section-masthead').removeClass(classes.align.join(' ')).addClass(newval);
      }
    });

    elementor.settings.page.addChangeCallback('page_masthead_content_container', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead__inner').removeClass(classes.container.join(' ')).addClass(newval);
    });

    elementor.settings.page.addChangeCallback('page_masthead_layout', () => {
      reloadPreview('page_settings', 'settings', 'page_masthead_section');
    });

    elementor.settings.page.addChangeCallback('page_masthead_image_alignment', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead__background').removeClass(classes.container.join(' ')).addClass(newval);
    });

    elementor.settings.page.addChangeCallback('page_masthead_image_parallax_enabled', () => {
      reloadPreview('page_settings', 'settings', 'page_masthead_section');
    });

    elementor.settings.page.addChangeCallback('page_masthead_image_parallax_transform_origin', () => {
      reloadPreview('page_settings', 'settings', 'page_masthead_section');
    });

    elementor.settings.page.addChangeCallback('page_masthead_image_placement', () => {
      reloadPreview('page_settings', 'settings', 'page_masthead_section');
    });

    /**
     * Typography Presets
     */
    elementor.settings.page.addChangeCallback('page_masthead_heading_preset', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead__heading').removeClass(classes.typography.join(' ')).addClass(newval);
    });

    elementor.settings.page.addChangeCallback('page_masthead_subheading_preset', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead__subheading').removeClass(classes.typography.join(' ')).addClass(newval);
    });

    elementor.settings.page.addChangeCallback('page_masthead_text_preset', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead__text').removeClass(classes.typography.join(' ')).addClass(newval);
    });

    /**
     * Paddings & Margins
     */
    elementor.settings.page.addChangeCallback('page_masthead_pt', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead').removeClass(classes.pt.join(' ')).addClass(newval);
    });

    elementor.settings.page.addChangeCallback('page_masthead_pb', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead').removeClass(classes.pb.join(' ')).addClass(newval);
    });

    elementor.settings.page.addChangeCallback('page_masthead_mt', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead').removeClass(classes.mt.join(' ')).addClass(newval);
    });

    elementor.settings.page.addChangeCallback('page_masthead_mb', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead').removeClass(classes.mb.join(' ')).addClass(newval);
    });

    /**
     * Overlay dither
     */
    elementor.settings.page.addChangeCallback('page_masthead_background_overlay_dither_enabled', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead__overlay').removeClass('overlay_dither').addClass(newval);
    });

    /**
     * Background
     */
    elementor.settings.page.addChangeCallback('page_masthead_background', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead').removeClass(classes.backgrounds.join(' ')).addClass(newval);
    });

    /**
     * Theme
     */
    elementor.settings.page.addChangeCallback('page_masthead_theme', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead').attr('data-arts-theme-text', newval);
    });

    /**
     * Show Category / Subheading
     */
    elementor.settings.page.addChangeCallback('page_masthead_subheading_enabled', (newval) => {
      const $el = jQuery(elementor.$previewContents).find('.section-masthead__subheading');

      if ($el.length) {
        if (newval) {
          $el.removeClass('d-none');
        } else {
          $el.addClass('d-none');
        }
      } else {
        reloadPreview('page_settings', 'settings', 'page_masthead_section');
      }
    });

    /**
     * Show Text
     */
    elementor.settings.page.addChangeCallback('page_masthead_text_enabled', (newval) => {
      const $el = jQuery(elementor.$previewContents).find('.section-masthead__text');

      if ($el.length) {
        if (newval) {
          $el.removeClass('d-none');
        } else {
          $el.addClass('d-none');
        }
      } else {
        reloadPreview('page_settings', 'settings', 'page_masthead_section');
      }
    });

    /**
     * Show Headline
     */
    elementor.settings.page.addChangeCallback('page_masthead_headline_enabled', (newval) => {
      const $el = jQuery(elementor.$previewContents).find('.section-masthead__headline');

      if ($el.length) {
        if (newval) {
          $el.removeClass('d-none');
        } else {
          $el.addClass('d-none');
        }
      } else {
        reloadPreview('page_settings', 'settings', 'page_masthead_section');
      }
    });

    /**
     * Show Scroll Down
     */
    elementor.settings.page.addChangeCallback('page_masthead_scroll_down_enabled', (newval) => {
      const $el = jQuery(elementor.$previewContents).find('.section-masthead__scroll-down');

      if ($el.length) {
        if (newval) {
          $el.removeClass('d-none');
        } else {
          $el.addClass('d-none');
        }
      } else {
        reloadPreview('page_settings', 'settings', 'page_masthead_section');
      }
    });

    /**
     * Background Gutters
     */
    elementor.settings.page.addChangeCallback('page_masthead_image_gutters_enabled', (newval) => {
      const
        $el = jQuery(elementor.$previewContents).find('.section-masthead__background'),
        guttersClass = 'section-masthead__background_halfscreen-gutters';

      if (newval) {
        $el.addClass(guttersClass);
      } else {
        $el.removeClass(guttersClass);
      }
    });

    /**
     * Halfscreen Image Background
     */
    elementor.settings.page.addChangeCallback('page_masthead_background_image', (newval) => {
      jQuery(elementor.$previewContents).find('.section-masthead__bg').removeClass(classes.backgrounds.join(' ')).addClass(newval);
    });

    /**
     * Fixed masthead layout
     */
    elementor.settings.page.addChangeCallback('page_masthead_fullscreen_fixed_enabled', () => {
      reloadPreview('page_settings', 'settings', 'page_masthead_section');
    });

    /**
     * OS Animation
     */
    elementor.settings.page.addChangeCallback('page_masthead_animation_enabled', () => {
      reloadPreview('page_settings', 'settings', 'page_masthead_section');
    });

    /**
     * Reload Preview & Open Panel
     */
    function updatePreview(openedPageAfter, openedTabAfter, openedSectionAfter) {
      elementor.reloadPreview();

      elementor.once('preview:loaded', () => {
        setTimeout(() => {
          if (openedPageAfter) {
            elementor.getPanelView().setPage(openedPageAfter);
          }

          if (openedTabAfter) {
            elementor.getPanelView().getCurrentPageView().activeTab = openedTabAfter;
          }

          if (openedSectionAfter) {
            elementor.getPanelView().getCurrentPageView().activateSection(openedSectionAfter);
          }

          elementor.getPanelView().getCurrentPageView().render();
        }, 50);
      });
    }

    /**
     * Reload Elementor Preview
     */
    function reloadPreview(openedPageAfter, openedTabAfter, openedSectionAfter) {
      $e.run('document/save/update').then(() => {
        updatePreview(openedPageAfter, openedTabAfter, openedSectionAfter)
      });
    }

  });

})(elementor);
