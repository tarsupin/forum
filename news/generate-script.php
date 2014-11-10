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


// News Headquarters
$catID = AppForumAdmin::createCategory("News Headquarters");

$forumID = AppForumAdmin::createForum($catID, 0, "Business News", "News related to corporations, start-ups, and finance.", 0, 2, "BusinessNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Entertainment", "Celebrities, new movie releases, new shows, etc.", 0, 2, "EntertainmentNews");
$forumID = AppForumAdmin::createForum($catID, 0, "International News", "News that affects the global economy, global politics, etc.", 0, 2, "InternationalNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Science News", "Advances and discoveries in science, health, etc.", 0, 2, "ScienceNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Tech News", "Advances and discoveries in technology.", 0, 2, "TechNews");


// The Thermometer
$catID = AppForumAdmin::createCategory("The Thermometer");

$forumID = AppForumAdmin::createForum($catID, 0, "Good Business", "Discuss businesses that are advancing society and the world.", 0, 2, "GoodBusiness");
$forumID = AppForumAdmin::createForum($catID, 0, "Bad Business", "Discuss businesses that are harming humanity.", 0, 2, "BadBusiness");
$forumID = AppForumAdmin::createForum($catID, 0, "Good Politics", "Discuss political actions that helping the world.", 0, 2, "GoodPolitics");
$forumID = AppForumAdmin::createForum($catID, 0, "Bad Politics", "Discuss political actions that are harming humanity.", 0, 2, "BadPolitics");


// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "NewsLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the humor community.", 0, 2, "NewsIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about humor or the forums.", 0, 2, "NewsInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

