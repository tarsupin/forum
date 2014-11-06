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

// Gaming News, Reviews, and More
$catID = AppForumAdmin::createCategory("Gaming News, Reviews, and More");

$forumID = AppForumAdmin::createForum($catID, 0, "Gaming News", "The latest news and updates for the gaming community.", 0, 2, "GamingNews");
$forumID = AppForumAdmin::createForum($catID, 0, "PC Gaming", "Discuss PC gaming, news, reviews, streaming, and more.", 0, 2, "PCGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Mobile Gaming", "Discuss mobile gaming, news, reviews, and more.", 0, 2, "MobileGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "XBox Gaming", "Discuss XBox gaming, news, reviews, streaming, and more.", 0, 2, "XBoxGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Playstation Gaming", "Discuss Playstation gaming, news, reviews, streaming, and more.", 0, 2, "PSGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Wii Gaming", "Discuss Nintendo Wii gaming, news, reviews, streaming, and more.", 0, 2, "WiiGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Retro Gaming", "Relive nostalgia with retro games and consoles.", 0, 2, "RetroGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Miscellaneous Gaming", "Discuss consoles that don't fit elsewhere.", 0, 2, "MiscGaming");

// The Game Center
$catID = AppForumAdmin::createCategory("The Game Center");

$forumID = AppForumAdmin::createForum($catID, 0, "Action and Adventure", "Stealth, survival, horrors, thrillers, and more.", 0, 2, "ActionGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Arcade", "Platform games, pinball, beat-em-ups, etc.", 0, 2, "ArcadeGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Multiplayer Games", "Online games that involve many players simultaneously.", 0, 2, "MultiplayerGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "MMOs", "Massively multiplayer online games.", 0, 2, "MMOGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Puzzles", "Matching games, educational games, tile games, mazes, etc.", 0, 2, "PuzzleGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "RPGs", "Action RPGs, Rogue RPGs, Tactical RPGs, etc.", 0, 2, "RPGGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "RTS", "Real time strategy games, MOBAs, etc.", 0, 2, "RTSGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Simulations", "Life sims, city sims, vehicle sims, management sims, etc.", 0, 2, "SimulationGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Sports", "Football, hockey, baseball... you get the idea.", 0, 2, "SportsGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Strategy", "Tower defence, turn based, war games, and more.", 0, 2, "StrategyGaming");
$forumID = AppForumAdmin::createForum($catID, 0, "Other", "All other game genres that don't fit elsewhere.", 0, 2, "MiscGaming");

// Interactive Gaming
$catID = AppForumAdmin::createCategory("Community Interaction");

$forumID = AppForumAdmin::createForum($catID, 0, "Guild Recruitment", "Find other gamers for your guild.", 0, 2, "GuildRecruiting");
$forumID = AppForumAdmin::createForum($catID, 0, "Game Streaming", "Find or discuss gaming channels and live streams.", 0, 2, "GamingStream");
$forumID = AppForumAdmin::createForum($catID, 0, "Competitions", "Find, create, and discuss gaming competitions.", 0, 2, "GamingCompete");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "GamingLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the gaming community.", 0, 2, "GamingIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about gaming or the forums.", 0, 2, "GamingInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

