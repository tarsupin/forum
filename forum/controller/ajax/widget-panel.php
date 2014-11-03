<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Get the active hashtag of the page
$activeHashtag = isset($_POST['activeHashtag']) ? Sanitize::variable($_POST['activeHashtag']) : '';

// Get the hashtag of the forum
$serv = explode(".", $_SERVER['SERVER_NAME']);


// Display a Chat Widget
if($activeHashtag)
{
	$chatWidget = new ChatWidget($activeHashtag);
	echo $chatWidget->get();
}


// Prepare the Featured Widget Data
$categories = array("articles", "people", "communities");

// Create a new featured content widget
$featuredWidget = new FeaturedWidget(array($activeHashtag, Sanitize::variable($serv[0])), $categories);

// If you want to display the FeaturedWidget by itself:
echo $featuredWidget->get();