<?php

/****** Preparation ******/
define("CONF_PATH",		dirname(__FILE__));
define("SYS_PATH", 		dirname(dirname(CONF_PATH)) . "/system");

// Load phpTesla
require(SYS_PATH . "/phpTesla.php");

// Initialize Active User
Me::initialize();

// Base style sheet for this site
Metadata::addHeader('<link rel="stylesheet" href="' . CDN . '/css/unifaction-2col.css" />');

// Determine which page you should point to, then load it
require(SYS_PATH . "/routes.php");

/****** Dynamic URLs ******
// If a page hasn't loaded yet, check if there is a dynamic load
if($url[0] != '')
{
	$channel = Sanitize::variable($url[0]);
	
	// Auto-create the channel if it does not exist
	if(!AppChannel::exists($channel))
	{
		AppChannel::createChannel($channel);
	}
	
	require(APP_PATH . '/controller/chat.php'); exit;
}
//*/

/****** 404 Page ******/
// If the routes.php file or dynamic URLs didn't load a page (and thus exit the scripts), run a 404 page.
require(SYS_PATH . "/controller/404.php");