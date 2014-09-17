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
$coreDiscussID = AppForumAdmin::createCategory(0, "Core Discussion");

$forumID = AppForumAdmin::createForum($coreDiscussID, "News and Updates", "The latest news and updates affecting all architects.", 0, 6);
$forumID = AppForumAdmin::createForum($coreDiscussID, "Important Comments and Inquiries", "Things that should be brought to UniFaction's attention.", 0, 2);
$forumID = AppForumAdmin::createForum($coreDiscussID, "Goals and Strategies", "What UniFaction's interests and strategies are.", 0, 6);
$forumID = AppForumAdmin::createForum($coreDiscussID, "Resources", "Lists of useful resources for architects.", 0, 6);
$forumID = AppForumAdmin::createForum($coreDiscussID, "General Discussion", "Talk with other architects about non-UniFaction stuff.", 0, 2);

// Community Systems: Entertainment
$commID = AppForumAdmin::createCategory(0, "Communities: Entertainment");

$forumID = AppForumAdmin::createForum($commID, "Art and Photography", "Drawing, sculpting, photos, etc.", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Books", "Book reviews, novels, comic books, etc.", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Gaming", "Video game reviews, mobile games, etc.", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Humor", "Comedy, stand up, funny videos, etc.", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Movies", "Movie reviews, short videos, etc.", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Music", "Music reviews, genres, etc.", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Pop Culture", "Pop culture, etc.", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Shows", "Show reviews, upcoming releases, etc.", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Roleplaying", "Roleplaying games, content, etc.", 0, 2);

// Community Systems: Sports
$commID = AppForumAdmin::createCategory(0, "Communities: Sports");

$forumID = AppForumAdmin::createForum($commID, "Baseball", "", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Football", "", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Hockey", "", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Soccer", "", 0, 2);

// Community Systems: Culture and Lifestyle
$commID = AppForumAdmin::createCategory(0, "Communities: Other");

$forumID = AppForumAdmin::createForum($commID, "DIY", "", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Fashion", "", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Interviews", "", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Outdoor", "", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Science", "", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Technology", "", 0, 2);
$forumID = AppForumAdmin::createForum($commID, "Travel", "", 0, 2);
