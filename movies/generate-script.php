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

// Movie Central
$catID = AppForumAdmin::createCategory(0, "Movie Central");

$forumID = AppForumAdmin::createForum($catID, "Movie Discussion", "Discuss anything related to movies here.", 0, 2, "Movies");
$forumID = AppForumAdmin::createForum($catID, "Upcoming Movies", "Details about the new movies that are right around the corner.", 0, 2, "UpcomingMovies");
$forumID = AppForumAdmin::createForum($catID, "Movie Reviews", "Post and read reviews and critique on movies.", 0, 2, "MovieReviews");
$forumID = AppForumAdmin::createForum($catID, "Top 10+ Lists", "Post your top ten favorite movies of all time.", 0, 2, "MovieLists");
$forumID = AppForumAdmin::createForum($catID, "Just Watched", "Tell us what you just watched and what you thought.", 0, 2, "MovieReviews");

// Behind the Scenes
$catID = AppForumAdmin::createCategory(0, "Behind the Scenes");

$forumID = AppForumAdmin::createForum($catID, "Movie Trivia", "Post challenges or compete in movie trivia.", 0, 2, "MovieTrivia");
$forumID = AppForumAdmin::createForum($catID, "Movie Games", "Create or participate in movie-related forum games.", 0, 2, "MovieGames");
$forumID = AppForumAdmin::createForum($catID, "Actors and Directors", "Topics relating to actors and directors.", 0, 2, "MovieActors");
$forumID = AppForumAdmin::createForum($catID, "Film Events", "Discuss events related to the movie industry.", 0, 2, "MovieEvents");
$forumID = AppForumAdmin::createForum($catID, "Fan Theories", "Speculate on the hidden stories told by a movie.", 0, 2, "MovieTheories");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Movie News", "The latest news and updates for the movie community.", 0, 2, "MovieNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the movie community.", 0, 2, "MovieIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "MovieLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

