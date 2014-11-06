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

// General Writing
$catID = AppForumAdmin::createCategory("General Writing");

$forumID = AppForumAdmin::createForum($catID, 0, "Writing News", "The latest news and updates for the writer's community.", 0, 6, "WritersNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Beginner's Lounge", "New to writing? Here's the best place to start!", 0, 2, "WritingBeginners");
$forumID = AppForumAdmin::createForum($catID, 0, "General Writing Advice", "Exchanges tips and advice on general writing practices.", 0, 2, "WritingAdvice");
$forumID = AppForumAdmin::createForum($catID, 0, "Publishing", "Discuss anything related to publishing.", 0, 2, "Publishing");
$forumID = AppForumAdmin::createForum($catID, 0, "Reader Psychology", "Discuss what captivates the audience and makes them love something.", 0, 2, "ReaderPsychology");

// The Writer's Corner
$catID = AppForumAdmin::createCategory("The Writer's Corner");

$forumID = AppForumAdmin::createForum($catID, 0, "Writing Prompts", "Get inspiration and help break writer's block.", 0, 2, "WritingPrompts");
$forumID = AppForumAdmin::createForum($catID, 0, "Writing Challenges", "Engage in writing challenges to hone your talents.", 0, 2, "WritingChallenges");
$forumID = AppForumAdmin::createForum($catID, 0, "Character Development", "Discuss character development and techniques.", 0, 2, "WritingCharacter");
$forumID = AppForumAdmin::createForum($catID, 0, "Plot Development", "Discuss techniques and imaginative ways to develop a plot.", 0, 2, "WritingPlot");
$forumID = AppForumAdmin::createForum($catID, 0, "Setting Development", "Discuss how to develop settings.", 0, 2, "WritingSetting");

// The Workshop
$catID = AppForumAdmin::createCategory("The Workshop");

$forumID = AppForumAdmin::createForum($catID, 0, "Novels", "Discuss and get feedback about your novel and its concepts.", 0, 2, "WritingNovels");
$forumID = AppForumAdmin::createForum($catID, 0, "Short Stories", "Get feedback on the short stories you've written.", 0, 2, "WritingShortStories");
$forumID = AppForumAdmin::createForum($catID, 0, "Fan Fiction", "Discuss and write fan fiction about your favorite stories.", 0, 2, "WritingFanFiction");
$forumID = AppForumAdmin::createForum($catID, 0, "Poetry", "Write poetry and get feedback.", 0, 2, "WritingPoetry");
$forumID = AppForumAdmin::createForum($catID, 0, "Songs", "Write awesome new lyrics and songs and get feedback.", 0, 2, "WritingSongs");
$forumID = AppForumAdmin::createForum($catID, 0, "Scripts", "Create scripts and pilots and get feedback.", 0, 2, "WritingScripts");
$forumID = AppForumAdmin::createForum($catID, 0, "Non-Fiction", "Get feedback on your non-fiction works.", 0, 2, "WritingNonFiction");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "WritersLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the writing community.", 0, 2, "WritersIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about writing or the forums.", 0, 2, "WritersInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);