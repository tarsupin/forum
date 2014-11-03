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
$catID = AppForumAdmin::createCategory(0, "Gaming News, Reviews, and More");

$forumID = AppForumAdmin::createForum($catID, "PC Gaming", "Discuss PC gaming, news, reviews, streaming, and more.", 0, 2, "PCGaming");
$forumID = AppForumAdmin::createForum($catID, "Mobile Gaming", "Discuss mobile gaming, news, reviews, and more.", 0, 2, "MobileGaming");
$forumID = AppForumAdmin::createForum($catID, "XBox Gaming", "Discuss XBox gaming, news, reviews, streaming, and more.", 0, 2, "XBoxGaming");
$forumID = AppForumAdmin::createForum($catID, "Playstation Gaming", "Discuss Playstation gaming, news, reviews, streaming, and more.", 0, 2, "PSGaming");
$forumID = AppForumAdmin::createForum($catID, "Wii Gaming", "Discuss Nintendo Wii gaming, news, reviews, streaming, and more.", 0, 2, "WiiGaming");
$forumID = AppForumAdmin::createForum($catID, "Retro Gaming", "Relive nostalgia with retro games and consoles.", 0, 2, "RetroGaming");
$forumID = AppForumAdmin::createForum($catID, "Miscellaneous Gaming", "Discuss consoles that don't fit elsewhere.", 0, 2, "MiscGaming");

// The Game Center
$catID = AppForumAdmin::createCategory(0, "The Game Center");

$forumID = AppForumAdmin::createForum($catID, "Action and Adventure", "Stealth, survival, horrors, thrillers, and more.", 0, 2, "ActionGaming");
$forumID = AppForumAdmin::createForum($catID, "Arcade", "Platform games, pinball, beat-em-ups, etc.", 0, 2, "ArcadeGaming");
$forumID = AppForumAdmin::createForum($catID, "Multiplayer Games", "Online games that involve many players simultaneously.", 0, 2, "MultiplayerGaming");
$forumID = AppForumAdmin::createForum($catID, "MMOs", "Massively multiplayer online games.", 0, 2, "MMOGaming");
$forumID = AppForumAdmin::createForum($catID, "Puzzles", "Matching games, educational games, tile games, mazes, etc.", 0, 2, "PuzzleGaming");
$forumID = AppForumAdmin::createForum($catID, "RPGs", "Action RPGs, Rogue RPGs, Tactical RPGs, etc.", 0, 2, "RPGGaming");
$forumID = AppForumAdmin::createForum($catID, "RTS", "Real time strategy games, MOBAs, etc.", 0, 2, "RTSGaming");
$forumID = AppForumAdmin::createForum($catID, "Simulations", "Life sims, city sims, vehicle sims, management sims, etc.", 0, 2, "SimulationGaming");
$forumID = AppForumAdmin::createForum($catID, "Sports", "Football, hockey, baseball... you get the idea.", 0, 2, "SportsGaming");
$forumID = AppForumAdmin::createForum($catID, "Strategy", "Tower defence, turn based, war games, and more.", 0, 2, "StrategyGaming");
$forumID = AppForumAdmin::createForum($catID, "Other", "All other game genres that don't fit elsewhere.", 0, 2, "MiscGaming");

// Interactive Gaming
$catID = AppForumAdmin::createCategory(0, "Community Interaction");

$forumID = AppForumAdmin::createForum($catID, "Guild Recruitment", "Find other gamers for your guild.", 0, 2, "GuildRecruiting");
$forumID = AppForumAdmin::createForum($catID, "Game Streaming", "Find or discuss gaming channels and live streams.", 0, 2, "GamingStream");
$forumID = AppForumAdmin::createForum($catID, "Competitions", "Find, create, and discuss gaming competitions.", 0, 2, "GamingCompete");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Gaming News", "The latest news and updates for the gaming community.", 0, 2, "GamingNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the gaming community.", 0, 2, "GamingIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "GamingLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

