<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

/*
	This script will be used for generating forum data for this site.
	
	// This script uses the following methods
	$catID = AppForumAdmin::createCategory($forumID, $title);
	$forumID = AppForumAdmin::createForum($categoryID, $forumID, $title, $desc, $readPerm, $postPerm, $activeHashtag);
*/

// Make sure the page is only loaded during installation
if(!defined("GENERATE_FORUM_DATA"))
{
	die("You are only allowed to load this page during installation.");
}

// Initialize the root user
Database::initRoot();


// NFL
$catID = AppForumAdmin::createCategory("NFL");

$forumID = AppForumAdmin::createForum($catID, 0, "NFL News", "The latest news and updates for the NFL community.", 0, 2, "NFLNews");
$forumID = AppForumAdmin::createForum($catID, 0, "NFL Discussion", "Discuss anything related to the NFL that doesn't belong elsewhere.", 0, 2, "NFL");
	$subID = AppForumAdmin::createForum(0, $forumID, "History", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Matchup Previews", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Player and Team Comparisons", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Power Rankings", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Predictions", "", 0, 2, "MusicNews");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFL Draft", "", 0, 2, "NFLDraft");
$forumID = AppForumAdmin::createForum($catID, 0, "Fantasy Football", "", 0, 2, "NFLFantasy");
$forumID = AppForumAdmin::createForum($catID, 0, "Madden Gaming", "", 0, 2, "MaddenGaming");

	
// Divisions
$catID = AppForumAdmin::createCategory("Divisions");

$forumID = AppForumAdmin::createForum($catID, 0, "AFC East", "", 0, 2, "AFCEast");
	$subID = AppForumAdmin::createForum(0, $forumID, "Buffalo Bills", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miami Dolphins", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "New England Patriots", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "New York Jets", "", 0, 2, "MusicNews");

$forumID = AppForumAdmin::createForum($catID, 0, "AFC North", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Baltimore Ravens", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cincinnati Bengals", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cleveland Browns", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Pittsburgh Steelers", "", 0, 2, "MusicNews");
	
$forumID = AppForumAdmin::createForum($catID, 0, "AFC South", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Houston Texas", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Indianapolis Colts", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Jacksonville Jaguars", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tennessee Titans", "", 0, 2, "MusicNews");
	
$forumID = AppForumAdmin::createForum($catID, 0, "AFC West", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Denver Broncos", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kanvas City Chiefs", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oakland Raiders", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Diego Chargers", "", 0, 2, "MusicNews");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFC East", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Dallas Cowboys", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "New York Giants", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Philadelphia Eagles", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Washington Redskins", "", 0, 2, "MusicNews");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFC North", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Chicago Bears", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Detroit Lions", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Green Bay Packers", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Minnesota Vikings", "", 0, 2, "MusicNews");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFC South", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Atlanta Falcons", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Carolina Panthers", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Orleans Saints", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tampa Bay Buccaneers", "", 0, 2, "MusicNews");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFC West", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arizona Cardinals", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Francisco 49ers", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Seattle Seahawks", "", 0, 2, "MusicNews");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Louis Rams", "", 0, 2, "MusicNews");


// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss any off-topic things here.", 0, 2, "NFLLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the music community.", 0, 2, "NFLIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about the NFL or the forums.", 0, 2, "NFLInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

