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

// Fashion Products
$catID = AppForumAdmin::createCategory(0, "Fashion Products");

$forumID = AppForumAdmin::createForum($catID, "Footwear", "Heels, flats, platforms, sandals, and more.", 0, 2, "Footwear");
$forumID = AppForumAdmin::createForum($catID, "Handbags", "Purses, clutches, totes, satchels, etc.", 0, 2, "Handbags");
$forumID = AppForumAdmin::createForum($catID, "Clothing", "Dresses, skirts, swimwear, hosiery, etc.", 0, 2, "Clothing");
$forumID = AppForumAdmin::createForum($catID, "Vintage", "Anything related to vintage fashion.", 0, 2, "VintageFashion");
$forumID = AppForumAdmin::createForum($catID, "Other Accessories", "Belts, bracelets, necklaces, jewellery, etc.", 0, 2, "Accessories");
$forumID = AppForumAdmin::createForum($catID, "Male Fashion", "Products for male fashion.", 0, 2, "MaleFashion");

// Fashion Community
$catID = AppForumAdmin::createCategory(0, "Fashion Community");

$forumID = AppForumAdmin::createForum($catID, "Beginner's Lounge", "New to the fashion community? Find help here.", 0, 2, "FashionBeginner");
$forumID = AppForumAdmin::createForum($catID, "Fashion Advice", "Questions and discussion on fashion advice for you and others.", 0, 2, "FashionAdvice");
$forumID = AppForumAdmin::createForum($catID, "Designers", "The top fashion designers and brands.", 0, 2, "FashionDesigners");
$forumID = AppForumAdmin::createForum($catID, "Collections", "Discuss top fashion collections.", 0, 2, "FashionCollections");
$forumID = AppForumAdmin::createForum($catID, "Trends", "Anything related to current or passing fashion trends.", 0, 2, "FashionTrends");
$forumID = AppForumAdmin::createForum($catID, "Fashion Events", "Anything related to fashion events.", 0, 2, "FashionEvents");
$forumID = AppForumAdmin::createForum($catID, "The Catwalk", "High fashion, models, styles, etc.", 0, 2, "HighFashion");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Fashion News", "The latest news and updates for the fashion community.", 0, 2, "FashionNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the fashion community.", 0, 2, "FashionIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "FashionLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

