<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

/*
	This script will be used for generating forum data for this site.
	
	// This script uses the following methods
	$catID = AppForumAdmin::createCategory($forumID, $title);
	$forumID = AppForumAdmin::createForum($categoryID, $title, $desc, $readPerm, $postPerm);
*/

// Make sure the page is only loaded during installation
if(!defined("GENERATE_FORUM_DATA"))
{
	die("You are only allowed to load this page during installation.");
}

// Initialize the root user
Database::initRoot();

// Core Discussion
$catID = AppForumAdmin::createCategory("Core Discussion");

$forumID = AppForumAdmin::createForum($catID, 0, "News and Updates", "The latest news and updates affecting all architects.", 0, 6);
$forumID = AppForumAdmin::createForum($catID, 0, "Important Comments and Inquiries", "Things that should be brought to UniFaction's attention.", 0, 2);
$forumID = AppForumAdmin::createForum($catID, 0, "Goals and Strategies", "What UniFaction's interests and strategies are.", 0, 6);
$forumID = AppForumAdmin::createForum($catID, 0, "Resources", "Lists of useful resources for architects.", 0, 6);
$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Talk with other architects about non-UniFaction stuff.", 0, 2);
