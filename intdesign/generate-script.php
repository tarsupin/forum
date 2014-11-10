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

$forumID = AppForumAdmin::createForum($catID, 0, "Interior Design News", "News related to interior design.", 0, 2, "IntDesignNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Interior Design Discussion", "Talk about anything related to interior design and decor.", 0, 2, "InteriorDesign");
$forumID = AppForumAdmin::createForum($catID, 0, "Beginner's Lounge", "New to interior design? Start here!", 0, 2, "IntDesignBeginner");
$forumID = AppForumAdmin::createForum($catID, 0, "The Showcase", "Show off your projects!", 0, 2, "IntDesignShowcase");

// Room Design and Decor
$catID = AppForumAdmin::createCategory("Room Design");

$forumID = AppForumAdmin::createForum($catID, 0, "Basements", "", 0, 2, "IntDesignBasement");
$forumID = AppForumAdmin::createForum($catID, 0, "Bathrooms", "", 0, 2, "IntDesignBathroom");
$forumID = AppForumAdmin::createForum($catID, 0, "Bedrooms", "", 0, 2, "IntDesignBedroom");
$forumID = AppForumAdmin::createForum($catID, 0, "Closets", "", 0, 2, "IntDesignCloset");
$forumID = AppForumAdmin::createForum($catID, 0, "Decks", "", 0, 2, "IntDesignDeck");
$forumID = AppForumAdmin::createForum($catID, 0, "Dining Room", "", 0, 2, "IntDesignDining");
$forumID = AppForumAdmin::createForum($catID, 0, "Kitchens", "", 0, 2, "IntDesignKitchen");
$forumID = AppForumAdmin::createForum($catID, 0, "Living Areas", "", 0, 2, "IntDesignLiving");
$forumID = AppForumAdmin::createForum($catID, 0, "Offices", "", 0, 2, "IntDesignOffice");

// Interior Decorating
$catID = AppForumAdmin::createCategory("Interior Decorating");

$forumID = AppForumAdmin::createForum($catID, 0, "Architecture", "", 0, 2, "IntDesignArchitecture");
$forumID = AppForumAdmin::createForum($catID, 0, "2D and 3D Art", "", 0, 2, "IntDesignArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Blinds, Shades, and Shutters", "", 0, 2, "IntDesignBlinds");
$forumID = AppForumAdmin::createForum($catID, 0, "Draperies", "", 0, 2, "IntDesignDraperies");
$forumID = AppForumAdmin::createForum($catID, 0, "Upholstery", "", 0, 2, "IntDesignUpholstery");
$forumID = AppForumAdmin::createForum($catID, 0, "Flooring", "", 0, 2, "IntDesignFlooring");
$forumID = AppForumAdmin::createForum($catID, 0, "Furniture", "", 0, 2, "IntDesignFurniture");
$forumID = AppForumAdmin::createForum($catID, 0, "Carpeting and Rugs", "", 0, 2, "IntDesignCarpeting");
$forumID = AppForumAdmin::createForum($catID, 0, "Walls and Ceilings", "", 0, 2, "IntDesignWalls");
$forumID = AppForumAdmin::createForum($catID, 0, "Windows", "", 0, 2, "IntDesignWindows");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "IntDesignLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the humor community.", 0, 2, "IntDesignIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about humor or the forums.", 0, 2, "IntDesignInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

