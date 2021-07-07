<?php

function loonymoon_get_header_image() {
	return get_theme_file_uri( 'resources/images/misty-evening.jpeg' );
}

function loonymoon_get_logo_image() {
	$logo_path = get_theme_file_path( 'resources/images/logo.svg' );

	if ( file_exists( $logo_path ) ) {
		return file_get_contents( $logo_path );
	} else {
		return '';
	}
}