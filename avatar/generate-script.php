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

$forumID = AppForumAdmin::createForum($coreDiscussID, "News and Updates", "The latest news, important updates, etc.", 0, 6);
$forumID = AppForumAdmin::createForum($coreDiscussID, "Introductions", "Introduce yourself, greet others, and meet new friends!", 0, 2);
$forumID = AppForumAdmin::createForum($coreDiscussID, "Comments, Suggestions, Petitions", "Post your comments and great ideas here!", 0, 2);
$forumID = AppForumAdmin::createForum($coreDiscussID, "Help and Assistance", "Confused? Need assistance? Here's the place to be!", 0, 2);
$forumID = AppForumAdmin::createForum($coreDiscussID, "Staff Forum", "Ze place for ze staff.", 6, 6);
$forumID = AppForumAdmin::createForum($coreDiscussID, "Archive", "The thread moratorium.", 0, 6);

// Community Discussion
$commDiscussID = AppForumAdmin::createCategory(0, "Community Discussion");

$forumID = AppForumAdmin::createForum($commDiscussID, "General Discussion", "Discuss a variety of topics here.", 0, 2);
$forumID = AppForumAdmin::createForum($commDiscussID, "Random Chatter", "The miscellaneous topics that don't seem to fit elsewhere.", 0, 2);
$forumID = AppForumAdmin::createForum($commDiscussID, "Hangout Threads", "Create your own hangout thread and chill with friends!", 0, 2);
$forumID = AppForumAdmin::createForum($commDiscussID, "Forum Games", "Play your favorite forum games!", 0, 2);
$forumID = AppForumAdmin::createForum($commDiscussID, "Art and Expression", "Showcase your art, writing, poetry, philosophies, and more!", 0, 2);

// Community Outreach
$outreachID = AppForumAdmin::createCategory(0, "Community Outreach");

$forumID = AppForumAdmin::createForum($outreachID, "User Shops", "See what other members have for sale!", 0, 2);
$forumID = AppForumAdmin::createForum($outreachID, "User Charities", "New, or need help with your character?", 0, 2);
$forumID = AppForumAdmin::createForum($outreachID, "User Events and Creations", "Create your own unique threads here.", 0, 2);
$forumID = AppForumAdmin::createForum($outreachID, "The Trading Spot", "Look for or trade specific items.", 0, 2);
$forumID = AppForumAdmin::createForum($outreachID, "Advice and Debate", "Share help on personal matters, or strike up thoughtful debates.", 0, 2);
$forumID = AppForumAdmin::createForum($outreachID, "Art Commissions", "Gift, and exchange art with other members!", 0, 2);

// Roleplaying
$roleplayID = AppForumAdmin::createCategory(0, "Roleplaying");

$forumID = AppForumAdmin::createForum($roleplayID, "Roleplaying Recruitment", "Seek recruits for all your epic adventures!", 0, 2);
$forumID = AppForumAdmin::createForum($roleplayID, "Roleplaying Discussion", "Ask questions or comment about roleplaying here.", 0, 2);
$forumID = AppForumAdmin::createForum($roleplayID, "Group Roleplaying", "Join up with your roleplaying group here.", 0, 2);
$forumID = AppForumAdmin::createForum($roleplayID, "1-on-1 Roleplaying", "This forum is for 1-on-1 roleplaying games only.", 0, 2);

