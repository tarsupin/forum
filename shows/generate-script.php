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

// Show Central
$catID = AppForumAdmin::createCategory(0, "Show Central");

$forumID = AppForumAdmin::createForum($catID, "Show Discussion", "Discuss anything related to shows here.", 0, 2, "Shows");
$forumID = AppForumAdmin::createForum($catID, "Show Reviews", "Post and read reviews and critique on shows.", 0, 2, "ShowReviews");
$forumID = AppForumAdmin::createForum($catID, "Top 10+ Lists", "Post your top ten favorite shows of all time.", 0, 2, "ShowLists");
$forumID = AppForumAdmin::createForum($catID, "Just Watched", "Tell us what you just watched and what you thought.", 0, 2, "ShowReviews");

// Show Categories
$catID = AppForumAdmin::createCategory(0, "Show Categories");

$forumID = AppForumAdmin::createForum($catID, "Action and Adventure", "Action-oriented and adventuring shows.", 0, 2, "ActionShows");
$forumID = AppForumAdmin::createForum($catID, "Animated", "Animated shows, cartoons, anime, etc.", 0, 2, "AnimatedShows");
$forumID = AppForumAdmin::createForum($catID, "Comedy", "Sitcoms, romantic comedies, animated adult shows, etc.", 0, 2, "ComedyShows");
$forumID = AppForumAdmin::createForum($catID, "Drama", "Romance, soap operas, troubling conflicts, etc.", 0, 2, "DramaShows");
$forumID = AppForumAdmin::createForum($catID, "Educational", "Food shows, tech shows, science shows, etc.", 0, 2, "EducationalShows");
$forumID = AppForumAdmin::createForum($catID, "Fantasy and Sci-Fi", "High fantasy, magic, science fiction, etc.", 0, 2, "FantasyShows");
$forumID = AppForumAdmin::createForum($catID, "Game and Talent Shows", "Game shows, talent shows, contests, etc.", 0, 2, "GameShows");
$forumID = AppForumAdmin::createForum($catID, "Reality TV", "Shows that thrive on unrealistic scenarios.", 0, 2, "RealityTV");
$forumID = AppForumAdmin::createForum($catID, "Thrillers and Suspense", "Psychological thrillers, horror, crime shows, etc.", 0, 2, "SuspenseShows");
$forumID = AppForumAdmin::createForum($catID, "Web Series", "Series that are predominantly (or exclusively) available online.", 0, 2, "WebShows");

// Behind the Scenes
$catID = AppForumAdmin::createCategory(0, "Behind the Scenes");

$forumID = AppForumAdmin::createForum($catID, "Shows Trivia", "Post challenges or compete in show trivia.", 0, 2, "ShowTrivia");
$forumID = AppForumAdmin::createForum($catID, "Shows Games", "Create or participate in show-related forum games.", 0, 2, "ShowGames");
$forumID = AppForumAdmin::createForum($catID, "Actors and Directors", "Topics relating to actors and directors.", 0, 2, "ShowActors");
$forumID = AppForumAdmin::createForum($catID, "Film Events", "Discuss events related to TV and web shows.", 0, 2, "ShowEvents");
$forumID = AppForumAdmin::createForum($catID, "Fan Theories", "Speculate on the hidden stories told by shows.", 0, 2, "ShowTheories");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Music News", "The latest news and updates for the music community.", 0, 2, "ShowNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the music community.", 0, 2, "ShowIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "ShowLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

