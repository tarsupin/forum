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


// Humor Discussion
$catID = AppForumAdmin::createCategory("Humor Discussion");

$forumID = AppForumAdmin::createForum($catID, 0, "Ridiculous News", "Actual news that is so ridiculous that it belongs on this forum.", 0, 2, "HumorNews");
$forumID = AppForumAdmin::createForum($catID, 0, "General Humor", "Discuss anything related to humor that doesn't belong elsewhere.", 0, 2, "Humor");
$forumID = AppForumAdmin::createForum($catID, 0, "Top 10+ Lists", "Post a list of your best jokes, stories, or humorous content of all time.", 0, 2, "HumorLists");
$forumID = AppForumAdmin::createForum($catID, 0, "Just Heard", "Tell us the most recent humorous thing you heard (or saw).", 0, 2, "HumorReviews");
$forumID = AppForumAdmin::createForum($catID, 0, "Humor Games", "Create or participate in humor-related forum games.", 0, 2, "HumorGames");

// Everything Humor
$catID = AppForumAdmin::createCategory("Everything Humor");

$forumID = AppForumAdmin::createForum($catID, 0, "Stand-up Comedy", "Post and discuss your favorite stand-up routines.", 0, 2, "StandupComedy");
$forumID = AppForumAdmin::createForum($catID, 0, "Jokes", "Post the best jokes and puns you've heard.", 0, 2, "Jokes");
$forumID = AppForumAdmin::createForum($catID, 0, "Funny Pictures", "Humorous images, galleries, and photoshopped pictures.", 0, 2, "HumorPics");
$forumID = AppForumAdmin::createForum($catID, 0, "Funny Audio", "Funny audio clips, pod-casts, etc.", 0, 2, "HumorAudio");
$forumID = AppForumAdmin::createForum($catID, 0, "Funny Videos", "Humorous videos, shorts, and short films.", 0, 2, "HumorVideos");
$forumID = AppForumAdmin::createForum($catID, 0, "Real Stories", "Post funny stories that actually happened.", 0, 2, "HumorStories");
$forumID = AppForumAdmin::createForum($catID, 0, "WTF Humor", "Anything that is both shocking and hilarious at the same time.", 0, 2, "HumorStories");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "HumorLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the humor community.", 0, 2, "HumorIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about humor or the forums.", 0, 2, "HumorInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

