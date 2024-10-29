<?php

get_header();
get_template_part( 'template-parts/masthead/masthead', 'blog' );
get_template_part( 'template-parts/blog/blog', esc_attr( get_theme_mod( 'blog_layout', 'list' ) ) );
get_footer();
