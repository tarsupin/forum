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
$catID = AppForumAdmin::createCategory(0, "Africa");

$forumID = AppForumAdmin::createForum($catID, "North Africa", "", 0, 2, "Astronomy");
$forumID = AppForumAdmin::createForum($catID, "Egypt", "", 0, 2, "Biology");
$forumID = AppForumAdmin::createForum($catID, "Sub-Saharan", "", 0, 2, "Chemistry");

// Asia
$catID = AppForumAdmin::createCategory(0, "Asia");

$forumID = AppForumAdmin::createForum($catID, "China", "", 0, 2, "ChinaTravel");
$forumID = AppForumAdmin::createForum($catID, "India", "", 0, 2, "IndiaTravel");
$forumID = AppForumAdmin::createForum($catID, "Middle East", "", 0, 2, "MiddleEastTravel");
$forumID = AppForumAdmin::createForum($catID, "Pacific Islands", "", 0, 2, "PacificIslandsTravel");
$forumID = AppForumAdmin::createForum($catID, "Russia", "", 0, 2, "RussiaTravel");
$forumID = AppForumAdmin::createForum($catID, "Southeast Asia", "", 0, 2, "SEAsiaTravel");
$forumID = AppForumAdmin::createForum($catID, "West Asia", "", 0, 2, "WestAsiaTravel");

// Australia
$catID = AppForumAdmin::createCategory(0, "Australia");

$forumID = AppForumAdmin::createForum($catID, "Australia", "", 0, 2, "AustraliaTravel");

// Europe
$catID = AppForumAdmin::createCategory(0, "Europe");

$forumID = AppForumAdmin::createForum($catID, "Eastern Europe", "", 0, 2, "EastEuropeTravel");
$forumID = AppForumAdmin::createForum($catID, "Mediterranean", "", 0, 2, "MediterraneanTravel");
$forumID = AppForumAdmin::createForum($catID, "Scandinavia", "", 0, 2, "ScandinaviaTravel");
$forumID = AppForumAdmin::createForum($catID, "Western Europe", "", 0, 2, "WestEuropeTravel");

// North America
$catID = AppForumAdmin::createCategory(0, "North America");

$forumID = AppForumAdmin::createForum($catID, "Canada", "", 0, 2, "CanadaTravel");
$forumID = AppForumAdmin::createForum($catID, "Mexico", "", 0, 2, "MexicoTravel");
$forumID = AppForumAdmin::createForum($catID, "United States", "", 0, 2, "USATravel");

// South America
$catID = AppForumAdmin::createCategory(0, "South America");

$forumID = AppForumAdmin::createForum($catID, "South America", "", 0, 2, "SouthAmericaTravel");


// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Travel News", "The latest news and updates for the travel community.", 0, 2, "TravelNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the travel community.", 0, 2, "TravelIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "TravelLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

