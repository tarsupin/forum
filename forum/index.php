<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Initialize and Test Active User's Behavior
Me::$getColumns = "uni_id, role, clearance, handle, display_name, avatar_opt, date_lastVisit";

Me::initialize();

// Base style sheet for this site
Metadata::addHeader('<link rel="stylesheet" href="' . CDN . '/css/unifaction-2col.css" /><link rel="stylesheet" href="' . CDN . '/css/forum.css">');

// Determine which page you should point to, then load it
require(SYS_PATH . "/routes.php");

/****** Dynamic URLs ******/
// If a page hasn't loaded yet, check if there is a dynamic load
if($url[0] != '')
{
	// Check if the URL points to a valid forum
	if($forum = Database::selectOne("SELECT * FROM forums WHERE url_slug=? LIMIT 1", array($url[0])))
	{
		// Check if a thread is being loaded
		if(isset($url[1]))
		{
			$extract = explode('-', $url[1]);
			
			$threadID = (int) $extract[0];
			
			// Retrieve the thread
			if($thread = Database::selectOne("SELECT * FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($forum['id'], $threadID)))
			{
				require(APP_PATH . '/controller/thread.php'); exit;
			}
		}
		
		// If only the forum is being loaded
		else
		{
			require(APP_PATH . '/controller/forum.php'); exit;
		}
	}
}
//*/

/****** 404 Page ******/
// If the routes.php file or dynamic URLs didn't load a page (and thus exit the scripts), run a 404 page.
require(SYS_PATH . "/controller/404.php");