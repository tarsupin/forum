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

// Fashion Community
$catID = AppForumAdmin::createCategory("Fashion Community");

$forumID = AppForumAdmin::createForum($catID, 0, "Fashion News", "The latest news and updates for the fashion community.", 0, 2, "FashionNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Beginner's Lounge", "New to the fashion community? Find help here.", 0, 2, "FashionBeginner");
$forumID = AppForumAdmin::createForum($catID, 0, "Fashion Advice", "Questions and discussion on fashion advice for you and others.", 0, 2, "FashionAdvice");
$forumID = AppForumAdmin::createForum($catID, 0, "Designers", "The top fashion designers and brands.", 0, 2, "FashionDesigners");
$forumID = AppForumAdmin::createForum($catID, 0, "Collections", "Discuss top fashion collections.", 0, 2, "FashionCollections");
$forumID = AppForumAdmin::createForum($catID, 0, "Trends", "Anything related to current or passing fashion trends.", 0, 2, "FashionTrends");
$forumID = AppForumAdmin::createForum($catID, 0, "Fashion Events", "Anything related to fashion events.", 0, 2, "FashionEvents");
$forumID = AppForumAdmin::createForum($catID, 0, "The Catwalk", "High fashion, models, styles, etc.", 0, 2, "HighFashion");

// Fashion Products
$catID = AppForumAdmin::createCategory("Fashion Products");

$forumID = AppForumAdmin::createForum($catID, 0, "Footwear", "Heels, flats, platforms, sandals, and more.", 0, 2, "Footwear");
$forumID = AppForumAdmin::createForum($catID, 0, "Handbags", "Purses, clutches, totes, satchels, etc.", 0, 2, "Handbags");
$forumID = AppForumAdmin::createForum($catID, 0, "Clothing", "Dresses, skirts, swimwear, hosiery, etc.", 0, 2, "Clothing");
$forumID = AppForumAdmin::createForum($catID, 0, "Vintage", "Anything related to vintage fashion.", 0, 2, "VintageFashion");
$forumID = AppForumAdmin::createForum($catID, 0, "Other Accessories", "Belts, bracelets, necklaces, jewellery, etc.", 0, 2, "Accessories");
$forumID = AppForumAdmin::createForum($catID, 0, "Male Fashion", "Products for male fashion.", 0, 2, "MaleFashion");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "FashionLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the fashion community.", 0, 2, "FashionIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about fashion or the forums.", 0, 2, "FashionInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

