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

// General Discussion
$catID = AppForumAdmin::createCategory("General Discussion");

$forumID = AppForumAdmin::createForum($catID, 0, "Political News", "Discuss the recent news happening in politics.", 0, 2, "PoliticalNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Political Discussion", "Talk about anything related to politics that fits nowhere else.", 0, 2, "Politics");
$forumID = AppForumAdmin::createForum($catID, 0, "Beginner's Lounge", "New to politics? Start here!", 0, 2, "PoliticsBeginner");
$forumID = AppForumAdmin::createForum($catID, 0, "Political Games", "Play forum games relating to politics.", 0, 2, "PoliticalGames");

// Political Topics
$catID = AppForumAdmin::createCategory("Political Topics");

$forumID = AppForumAdmin::createForum($catID, 0, "Business", "The politics and ideologies of business and finance.", 0, 2, "ClimatePolitics");
$forumID = AppForumAdmin::createForum($catID, 0, "Climate", "Climate change, its consequences, and political factors.", 0, 2, "ClimatePolitics");
$forumID = AppForumAdmin::createForum($catID, 0, "Economy", "Discuss the economy and the politics surrounding it.", 0, 2, "Economy");
$forumID = AppForumAdmin::createForum($catID, 0, "Education", "Talk about education and the politics affecting it.", 0, 2, "HealthPolitics");
$forumID = AppForumAdmin::createForum($catID, 0, "Health", "The health system, health care, and related discussion.", 0, 2, "HealthPolitics");
$forumID = AppForumAdmin::createForum($catID, 0, "International Affairs", "The political issues that relate to the entire world.", 0, 2, "HealthPolitics");
$forumID = AppForumAdmin::createForum($catID, 0, "Jobs", "Discuss jobs, job creation, etc.", 0, 2, "JobPolitics");
$forumID = AppForumAdmin::createForum($catID, 0, "Social Issues", "The social issues that affect our world.", 0, 2, "SocialSecurity");
$forumID = AppForumAdmin::createForum($catID, 0, "Social Security", "Discuss social security and the politics of it.", 0, 2, "SocialSecurity");
$forumID = AppForumAdmin::createForum($catID, 0, "Social Services", "All topics relating to all other social services.", 0, 2, "SocialSecurity");


// Political Topics
$catID = AppForumAdmin::createCategory("Political Corner");

$forumID = AppForumAdmin::createForum($catID, 0, "Elections", "Discuss elections, tactics, voting, districts, and more.", 0, 2, "Elections");
$forumID = AppForumAdmin::createForum($catID, 0, "Intelligent Debate", "Participate in intelligent (and peaceful) political debates.", 0, 2, "IntelligentDebate");
$forumID = AppForumAdmin::createForum($catID, 0, "Judicial System", "The practices and politics surrounding the judicial system.", 0, 2, "JusticialSystem");
$forumID = AppForumAdmin::createForum($catID, 0, "Political Parties", "Thoughts, ideologies, and discussion of the political parties.", 0, 2, "PoliticalParties");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "PoliticalLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the humor community.", 0, 2, "PoliticalIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about humor or the forums.", 0, 2, "PoliticalInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

