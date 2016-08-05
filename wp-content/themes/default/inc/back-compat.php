<?php
function webidom_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'webidom_upgrade_notice' );
}
add_action( 'after_switch_theme', 'webidom_switch_theme' );

function webidom_upgrade_notice() {
	$message = sprintf( __( 'Webidom requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'webidom' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

function webidom_customize() {
	wp_die( sprintf( __( 'Webidom requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'webidom' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'webidom_customize' );


function webidom_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Webidom requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'webidom' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'webidom_preview' );
