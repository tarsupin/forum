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

// DIY: Auto
$catID = AppForumAdmin::createCategory("DIY: Auto");

$forumID = AppForumAdmin::createForum($catID, 0, "Cars", "Repair, maintenance, and servicing on cars.", 0, 2, "DIYCars");
$forumID = AppForumAdmin::createForum($catID, 0, "SUVs", "All Sports Utility Vehicle repairs and servicing.", 0, 2, "DIYSUVs");
$forumID = AppForumAdmin::createForum($catID, 0, "Trucks and Trailers", "Pick-up trucks, trailers, campers, mobile homes, etc.", 0, 2, "DIYTrucks");
$forumID = AppForumAdmin::createForum($catID, 0, "Hybrid and Electric Vehicles", "DIY for vehicles that are electric or hybrids.", 0, 2, "DIYElectricVehicles");
$forumID = AppForumAdmin::createForum($catID, 0, "Small Vehicles", "Motorcycles, ATVs, motorized bikes, snowmobiles, etc.", 0, 2, "DIYVehicles");
$forumID = AppForumAdmin::createForum($catID, 0, "Powered Machinery", "Lawn mowers, generators, snowblowers, and other powered machinery.", 0, 2, "DIYMachinery");
$forumID = AppForumAdmin::createForum($catID, 0, "Water Crafts", "Powered boats, sailing, and more.", 0, 2, "DIYWatercrafts");


// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "DIYAutoLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the humor community.", 0, 2, "DIYAutoIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about humor or the forums.", 0, 2, "DIYAutoInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

