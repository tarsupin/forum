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

// Art Community
$catID = AppForumAdmin::createCategory("Art Community");

$forumID = AppForumAdmin::createForum($catID, 0, "Art News", "The latest news and updates for the art community.", 0, 2, "ArtNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Beginner's Lounge", "Are you new to the artistic life? Need help? Get started here!", 0, 2, "ArtBeginner");
$forumID = AppForumAdmin::createForum($catID, 0, "General Art Discussion", "Anything related to art that doesn't fit elsewhere.", 0, 2, "Art");
$forumID = AppForumAdmin::createForum($catID, 0, "Commissions", "Looking to commission an artist for something? Here's your spot.", 0, 2, "ArtCommissions");


// The Workshop
$catID = AppForumAdmin::createCategory("The Workshop");

$forumID = AppForumAdmin::createForum($catID, 0, "Abstract and Contemporary Art", "Post or give feedback on abstract art.", 0, 2, "AbstractArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Comics", "Post your comics, or see what others have created.", 0, 2, "ComicArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Fantasy and Sci-Fi", "Post or give feedback on fantasy and science fiction art.", 0, 2, "FantasyArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Game Art", "Art that was made for games or roleplaying.", 0, 2, "GameArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Graphic Design", "Logos, GUI, and all graphic design.", 0, 2, "GraphicDesign");
$forumID = AppForumAdmin::createForum($catID, 0, "Realistic and Still Life", "Post or comment on realistic and still life art.", 0, 2, "RealisticArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Crafts / Decorative Art", "Show off your crafted works here and see what others created.", 0, 2, "DecorativeArt");

// Art Mediums
$catID = AppForumAdmin::createCategory("Art Mediums");

$forumID = AppForumAdmin::createForum($catID, 0, "Acrylic", "", 0, 2, "AcrylicArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Digital Art", "", 0, 2, "DigitalArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Drawing and Sketching", "", 0, 2, "Drawing");
$forumID = AppForumAdmin::createForum($catID, 0, "Oil", "", 0, 2, "OilArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Pastels", "", 0, 2, "PastelArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Photography", "", 0, 2, "Photography");
$forumID = AppForumAdmin::createForum($catID, 0, "Pixel Art and Sprites", "", 0, 2, "PixelArt");
$forumID = AppForumAdmin::createForum($catID, 0, "Watermedia", "", 0, 2, "Watermedia");
$forumID = AppForumAdmin::createForum($catID, 0, "Other Mediums", "Sculptures, calligraphy, glass art, clay, etc.", 0, 2, "Art");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "ArtLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the art community.", 0, 2, "ArtIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Help, questions, and comments about art or the forums.", 0, 2, "NFLInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

