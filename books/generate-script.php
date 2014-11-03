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

// Book Club
$catID = AppForumAdmin::createCategory(0, "The Book Club");

$forumID = AppForumAdmin::createForum($catID, "Beginner's Club", "New to the book club? Here's the best place to start!", 0, 2, "BookClubBeginners");
$forumID = AppForumAdmin::createForum($catID, "What Are You Reading?", "Discuss what you're reading right now.", 0, 2, "CurrentlyReading");
$forumID = AppForumAdmin::createForum($catID, "General Book Discussion", "Discuss anything book-related.", 0, 2);
$forumID = AppForumAdmin::createForum($catID, "Hangout Groups", "Start a hangout group with similar book enthusiasts.", 0, 2, "BookClubHangouts");

// Reviews and Discussion
$catID = AppForumAdmin::createCategory(0, "Discussion and Reviews");

$forumID = AppForumAdmin::createForum($catID, "The Classics", "Books that have withstood the test of time.", 0, 2, "BookClubClassics");
$forumID = AppForumAdmin::createForum($catID, "Science Fiction and Fantasy", "All books in the science fiction and fantasy genres.", 0, 2, "BookClubFantasy");
$forumID = AppForumAdmin::createForum($catID, "Suspense", "Thrillers, mysteries, horror, crime, and other suspense genres.", 0, 2, "BookClubSuspense");
$forumID = AppForumAdmin::createForum($catID, "Romance", "Books in the romance and erotica genres.", 0, 2, "BookClubRomance");
$forumID = AppForumAdmin::createForum($catID, "Young Adult", "Books associated with young adults.", 0, 2, "BookClubYoungAdult");
$forumID = AppForumAdmin::createForum($catID, "Non-Fiction", "Historical books, biographies, and other non-fiction books.", 0, 2, "BookClubNonFiction");
$forumID = AppForumAdmin::createForum($catID, "Other Genres", "Discuss books that don't fit into the other categories.", 0, 2, "BookClubOther");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Book Club News", "The latest news and updates for the book club community.", 0, 2, "BookClubNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the book club community.", 0, 2, "BookClubIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "BookClubLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

