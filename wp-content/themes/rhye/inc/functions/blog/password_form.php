<?php

/**
 * Style Password Form in Protected Posts
 */
add_filter( 'the_password_form', 'arts_password_form' );
function arts_password_form() {

	global $post;
	$post   = get_post( $post );
	$label  = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<p>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'rhye' ) . '</p>
	<div class="input-float input-search js-input-float">' . ' <input class="input-float__input input-search__input" name="post_password" id="' . $label . '" type="password" size="20" /><span class="input-float__label">' . esc_html__( 'Password', 'rhye' ) . '</span><button class="input-search__submit" type="submit" name="Submit"><i class="material-icons">keyboard_arrow_right</i></button></div></form>
	';

	return $output;

}

