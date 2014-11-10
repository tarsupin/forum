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

$forumID = AppForumAdmin::createForum($catID, 0, "Home Improvement Discussion", "Talk about anything related to home development.", 0, 2, "HomeImprovement");
$forumID = AppForumAdmin::createForum($catID, 0, "Beginner's Lounge", "New to home improvement? Start here!", 0, 2, "DIYHomeBeginner");
$forumID = AppForumAdmin::createForum($catID, 0, "The Showcase", "Show off your projects!", 0, 2, "HomeShowcase");


// DIY: Home Improvement
$catID = AppForumAdmin::createCategory("DIY: Home Improvement");

$forumID = AppForumAdmin::createForum($catID, 0, "Air Conditioning", "", 0, 2, "DIYAirConditioning");
$forumID = AppForumAdmin::createForum($catID, 0, "Appliances", "", 0, 2, "DIYAppliances");
$forumID = AppForumAdmin::createForum($catID, 0, "Carpentry", "", 0, 2, "DIYCarpentry");
$forumID = AppForumAdmin::createForum($catID, 0, "Doors", "", 0, 2, "DIYDoors");
$forumID = AppForumAdmin::createForum($catID, 0, "Electrical", "", 0, 2, "DIYElectrical");
$forumID = AppForumAdmin::createForum($catID, 0, "Flooring", "", 0, 2, "DIYFlooring");
$forumID = AppForumAdmin::createForum($catID, 0, "Green Homes", "", 0, 2, "DIYGreenHomes");
$forumID = AppForumAdmin::createForum($catID, 0, "Heating", "", 0, 2, "DIYHeating");
$forumID = AppForumAdmin::createForum($catID, 0, "Home Security", "", 0, 2, "DIYHomeSecurity");
$forumID = AppForumAdmin::createForum($catID, 0, "Insulation", "", 0, 2, "DIYInsulation");
$forumID = AppForumAdmin::createForum($catID, 0, "Lighting", "", 0, 2, "DIYLighting");
$forumID = AppForumAdmin::createForum($catID, 0, "Painting", "", 0, 2, "DIYPainting");
$forumID = AppForumAdmin::createForum($catID, 0, "Plumbing", "", 0, 2, "DIYPlumbing");
$forumID = AppForumAdmin::createForum($catID, 0, "Remodelling", "", 0, 2, "DIYRemodelling");
$forumID = AppForumAdmin::createForum($catID, 0, "Roofing", "", 0, 2, "DIYRoofting");
$forumID = AppForumAdmin::createForum($catID, 0, "Siding", "", 0, 2, "DIYSiding");
$forumID = AppForumAdmin::createForum($catID, 0, "Sub-Flooring", "", 0, 2, "DIYSubFlooring");
$forumID = AppForumAdmin::createForum($catID, 0, "Ventilation", "", 0, 2, "DIYVentilation");
$forumID = AppForumAdmin::createForum($catID, 0, "Walls", "", 0, 2, "DIYWalls");
$forumID = AppForumAdmin::createForum($catID, 0, "Windows", "", 0, 2, "DIYWindows");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "DIYHomeLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the humor community.", 0, 2, "DIYHomeIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about humor or the forums.", 0, 2, "DIYHomeInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

