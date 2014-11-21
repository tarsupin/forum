<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Get the active hashtag of the page
$activeHashtag = isset($_POST['activeHashtag']) ? Sanitize::variable($_POST['activeHashtag']) : '';


// Display a Chat Widget
$chatWidget = new ChatWidget("UniFaction");
echo $chatWidget->get();


// Dynamic Content Loader
echo '
<!-- Content gets dynamically shifted to this section -->
<div id="dynamic-content-loader"></div>';


// Prepare the Featured Widget Data
$categories = array("articles", "people", "communities");

// Create a new featured content widget
$featuredWidget = new FeaturedWidget($activeHashtag, $categories);

// If you want to display the FeaturedWidget by itself:
echo $featuredWidget->get();