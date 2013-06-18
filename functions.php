<?php
define( 'TEMPPATH', get_bloginfo('stylesheet_directory'));
define( 'IMAGES', TEMPPATH. "/images"); 

add_theme_support( 'nav-menus' );

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main' => 'Main Nav'
		)
	);
}

//require_once('cpt_template.php');


/*****Sidebars!******/

register_sidebar( array (
	'name' => __( 'Sidebar', 'main-sidebar' ),
	'id' => 'primary-widget-area',
	'description' => __( 'The primary widget area', 'wpbp' ),
	'before_widget' => '<div class="widget">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array (
	'name' => __( 'Sidebar2', 'secondary-sidebar' ),
	'id' => 'secondar-widget-area',
	'description' => __( 'The seconardy widget area', 'wpbp' ),
	'before_widget' => '<div class="widget">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );


function jlc_get_attachements($pid){
	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $pid ); 
	$attachments = get_posts( $args );
	if ($attachments) {
		foreach ( $attachments as $post ) {
			setup_postdata($post);
			the_attachment_link($post->ID, false, false, true);
		}
	}
}

function jlc_page_url() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


function print_post_nav(){
?>
		<div class="navigation group">
			<div class="alignleft"><?php next_posts_link('&laquo; Next') ?></div>
			<div class="alignright"><?php previous_posts_link('Previous &raquo;') ?></div>
		</div>
<?php

}

function print_not_found(){
?>
		<h3 class="center">No posts found. Try a different search?</h3>
		<?php get_search_form(); ?>
<?php
}


function jlc_print_array($a){
	print "<pre>";
	print_r($a);
	print "</pre>";
}

function jlc_twitter_handles($content){
	$pattern= '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z]+[A-Za-z0-9_]+)/i';
	//$pattern= array('|@([a-zA-Z0-9_]*)|');
	$replace= '@<a href="http://www.twitter.com/$1">$1</a>';
	$content= preg_replace($pattern, $replace, $content);
	return $content;
}

//add_filter( "the_content", "casabona_twitter_handles" );

?>