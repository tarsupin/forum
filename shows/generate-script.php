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
$catID = AppForumAdmin::createCategory("Show Central");

$forumID = AppForumAdmin::createForum($catID, 0, "Show News", "The latest news and updates on TV shows and web shows.", 0, 2, "ShowNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Show Discussion", "Discuss anything related to shows here.", 0, 2, "Shows");
$forumID = AppForumAdmin::createForum($catID, 0, "Show Reviews", "Post and read reviews and critique on shows.", 0, 2, "ShowReviews");
$forumID = AppForumAdmin::createForum($catID, 0, "Top 10+ Lists", "Post your top ten favorite shows of all time.", 0, 2, "ShowLists");
$forumID = AppForumAdmin::createForum($catID, 0, "Just Watched", "Tell us what you just watched and what you thought.", 0, 2, "ShowReviews");

// Show Categories
$catID = AppForumAdmin::createCategory("Show Categories");

$forumID = AppForumAdmin::createForum($catID, 0, "Action and Adventure", "Action-oriented and adventuring shows.", 0, 2, "ActionShows");
$forumID = AppForumAdmin::createForum($catID, 0, "Animated", "Animated shows, cartoons, anime, etc.", 0, 2, "AnimatedShows");
$forumID = AppForumAdmin::createForum($catID, 0, "Comedy", "Sitcoms, romantic comedies, animated adult shows, etc.", 0, 2, "ComedyShows");
$forumID = AppForumAdmin::createForum($catID, 0, "Drama", "Romance, soap operas, troubling conflicts, etc.", 0, 2, "DramaShows");
$forumID = AppForumAdmin::createForum($catID, 0, "Educational", "Food shows, tech shows, science shows, etc.", 0, 2, "EducationalShows");
$forumID = AppForumAdmin::createForum($catID, 0, "Fantasy and Sci-Fi", "High fantasy, magic, science fiction, etc.", 0, 2, "FantasyShows");
$forumID = AppForumAdmin::createForum($catID, 0, "Game and Talent Shows", "Game shows, talent shows, contests, etc.", 0, 2, "GameShows");
$forumID = AppForumAdmin::createForum($catID, 0, "Reality TV", "Shows that thrive on unrealistic scenarios.", 0, 2, "RealityTV");
$forumID = AppForumAdmin::createForum($catID, 0, "Thrillers and Suspense", "Psychological thrillers, horror, crime shows, etc.", 0, 2, "SuspenseShows");
$forumID = AppForumAdmin::createForum($catID, 0, "Web Series", "Series that are predominantly (or exclusively) available online.", 0, 2, "WebShows");

// Behind the Scenes
$catID = AppForumAdmin::createCategory("Behind the Scenes");

$forumID = AppForumAdmin::createForum($catID, 0, "Shows Trivia", "Post challenges or compete in show trivia.", 0, 2, "ShowTrivia");
$forumID = AppForumAdmin::createForum($catID, 0, "Shows Games", "Create or participate in show-related forum games.", 0, 2, "ShowGames");
$forumID = AppForumAdmin::createForum($catID, 0, "Actors and Directors", "Topics relating to actors and directors.", 0, 2, "ShowActors");
$forumID = AppForumAdmin::createForum($catID, 0, "Film Events", "Discuss events related to TV and web shows.", 0, 2, "ShowEvents");
$forumID = AppForumAdmin::createForum($catID, 0, "Fan Theories", "Speculate on the hidden stories told by shows.", 0, 2, "ShowTheories");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "ShowLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the community.", 0, 2, "ShowIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about shows or the forums.", 0, 2, "ShowsInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

