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
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "News and Updates", "The latest news, important updates, etc.", 0, 6, "AvatarNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself, greet others, and meet new friends!", 0, 2, "AvatarIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments, Suggestions, Petitions", "Post your comments and great ideas here!", 0, 2, "AvatarComments");
$forumID = AppForumAdmin::createForum($catID, 0, "Help and Assistance", "Confused? Need assistance? Here's the place to be!", 0, 2, "AvatarHelp");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);
$forumID = AppForumAdmin::createForum($catID, 0, "Archive", "The thread moratorium.", 0, 6);

// Community Discussion
$catID = AppForumAdmin::createCategory("Community Discussion");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss a variety of topics here.", 0, 2, "AvatarDiscuss");
$forumID = AppForumAdmin::createForum($catID, 0, "Random Chatter", "The miscellaneous topics that don't seem to fit elsewhere.", 0, 2, "AvatarRandom");
$forumID = AppForumAdmin::createForum($catID, 0, "Hangout Threads", "Create your own hangout thread and chill with friends!", 0, 2, "AvatarHangout");
$forumID = AppForumAdmin::createForum($catID, 0, "Forum Games", "Play your favorite forum games!", 0, 2, "AvatarGames");
$forumID = AppForumAdmin::createForum($catID, 0, "Art and Expression", "Showcase your art, writing, poetry, philosophies, and more!", 0, 2, "AvatarExpress");

// Community Outreach
$catID = AppForumAdmin::createCategory("Community Outreach");

$forumID = AppForumAdmin::createForum($catID, 0, "User Shops", "See what other members have for sale!", 0, 2, "AvatarUserShops");
$forumID = AppForumAdmin::createForum($catID, 0, "User Charities", "New, or need help with your character?", 0, 2, "AvatarCharity");
$forumID = AppForumAdmin::createForum($catID, 0, "User Events and Creations", "Create your own unique threads here.", 0, 2, "AvatarUserEvents");
$forumID = AppForumAdmin::createForum($catID, 0, "The Trading Spot", "Look for or trade specific items.", 0, 2, "AvatarTrade");
$forumID = AppForumAdmin::createForum($catID, 0, "Advice and Debate", "Share help on personal matters, or strike up thoughtful debates.", 0, 2, "AvatarDebate");
$forumID = AppForumAdmin::createForum($catID, 0, "Art Commissions", "Gift, and exchange art with other members!", 0, 2, "AvatarCommissions");

// Roleplaying
$catID = AppForumAdmin::createCategory("Roleplaying");

$forumID = AppForumAdmin::createForum($catID, 0, "Roleplaying Recruitment", "Seek recruits for all your epic adventures!", 0, 2, "AvatarRoleplay");
$forumID = AppForumAdmin::createForum($catID, 0, "Roleplaying Discussion", "Ask questions or comment about roleplaying here.", 0, 2, "AvatarRoleplay");
$forumID = AppForumAdmin::createForum($catID, 0, "Group Roleplaying", "Join up with your roleplaying group here.", 0, 2, "AvatarRoleplay");
$forumID = AppForumAdmin::createForum($catID, 0, "1-on-1 Roleplaying", "This forum is for 1-on-1 roleplaying games only.", 0, 2, "AvatarRoleplay");

// Avatar Games
$catID = AppForumAdmin::createCategory("Avatar Games");

$forumID = AppForumAdmin::createForum($catID, 0, "UniCreatures", "Updates, news, and community discussion on UniCreatures!", 0, 2, "UniCreatures");