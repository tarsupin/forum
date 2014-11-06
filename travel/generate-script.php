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

// Africa
$catID = AppForumAdmin::createCategory("Africa");

$forumID = AppForumAdmin::createForum($catID, 0, "North Africa", "", 0, 2, "Astronomy");
$forumID = AppForumAdmin::createForum($catID, 0, "Egypt", "", 0, 2, "Biology");
$forumID = AppForumAdmin::createForum($catID, 0, "Sub-Saharan", "", 0, 2, "Chemistry");

// Asia
$catID = AppForumAdmin::createCategory("Asia");

$forumID = AppForumAdmin::createForum($catID, 0, "China", "", 0, 2, "ChinaTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "India", "", 0, 2, "IndiaTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "Middle East", "", 0, 2, "MiddleEastTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "Pacific Islands", "", 0, 2, "PacificIslandsTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "Russia", "", 0, 2, "RussiaTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "Southeast Asia", "", 0, 2, "SEAsiaTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "West Asia", "", 0, 2, "WestAsiaTravel");

// Australia
$catID = AppForumAdmin::createCategory("Australia");

$forumID = AppForumAdmin::createForum($catID, 0, "Australia", "", 0, 2, "AustraliaTravel");

// Europe
$catID = AppForumAdmin::createCategory("Europe");

$forumID = AppForumAdmin::createForum($catID, 0, "Eastern Europe", "", 0, 2, "EastEuropeTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "Mediterranean", "", 0, 2, "MediterraneanTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "Scandinavia", "", 0, 2, "ScandinaviaTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "Western Europe", "", 0, 2, "WestEuropeTravel");

// North America
$catID = AppForumAdmin::createCategory("North America");

$forumID = AppForumAdmin::createForum($catID, 0, "Canada", "", 0, 2, "CanadaTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "Mexico", "", 0, 2, "MexicoTravel");
$forumID = AppForumAdmin::createForum($catID, 0, "United States", "", 0, 2, "USATravel");

// South America
$catID = AppForumAdmin::createCategory("South America");

$forumID = AppForumAdmin::createForum($catID, 0, "South America", "", 0, 2, "SouthAmericaTravel");


// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "Travel News", "The latest news and updates for the travel community.", 0, 2, "TravelNews");
$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "TravelLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the travel community.", 0, 2, "TravelIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about travel or the forums.", 0, 2, "TravelInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

