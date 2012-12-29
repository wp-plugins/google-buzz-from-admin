<?php
/*
Plugin Name: Google Buzz from Admin
Plugin URI: 
Description: This plugin Lets you Google Buzz posts from admin Page
Author: Abbas Suterwala
Version: 1.0
Author URI: http://www.abbassuterwala.com 
*/

/* Use the admin_menu action to define the custom boxes */
add_action('admin_menu', 'GBuzzAdmin_add_custom_box');



/* Adds a custom section to the "advanced" Post  edit screens */

function GBuzzAdmin_add_custom_box() {

  if( function_exists( 'add_meta_box' )) 
  {
    add_meta_box( 'GBuzzAdmin_sectionid', 'Google Buzz from Admin', 'GBuzzAdmin_inner_add_custom_box', 'post', 'side' );
  } 
}

   
/* 
This function retrieves the last Post which is save in Wordpress and 
Gives a link which one can use to publish to Google Buzz. This link will publish the post to google buzz
*/

function GBuzzAdmin_inner_add_custom_box() 
{

	$recentposts =  wp_get_recent_posts( 1 );
	$latestpost = $recentposts[0];
	//print_r ($recentposts);
	$latestPostTitle = $latestpost['post_title'];

	$latestPostPermalink = get_permalink( $latestpost['ID'] );

	echo '<input type="hidden" name="GBuzzAdmin_noncename" id="GBuzzAdmin_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo 'The last post saved is <br><strong>'.$latestPostTitle . '</strong> <br>Do you want to Google<br>';

	echo  '<a href="http://www.google.com/reader/link?url='.$latestPostPermalink.'&title='.str_replace(' ','+',$latestPostTitle).'&srcURL='.get_bloginfo( 'url' ).'" target="_blank" ">Buzz This</a>';

}


?>