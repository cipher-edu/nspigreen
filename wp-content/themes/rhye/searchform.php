<?php

$unique_id = uniqid( 'search-form-' );

?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-float input-search js-input-float">
		<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="input-float__input input-search__input" value="<?php echo get_search_query(); ?>" name="s"/><span class="input-float__label"><?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'rhye' ); ?></span>
		<button type="submit" class="input-search__submit"><i class="material-icons">search</i></button>
	</div>
</form>
