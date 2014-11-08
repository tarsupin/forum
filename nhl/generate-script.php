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


// NHL
$catID = AppForumAdmin::createCategory("NHL");

$forumID = AppForumAdmin::createForum($catID, 0, "NHL News", "The latest news and updates for the NHL community.", 0, 2, "NHLNews");
$forumID = AppForumAdmin::createForum($catID, 0, "NHL Discussion", "Discussing all things NHL that don't belong elsewhere.", 0, 2, "NHL");
	$subID = AppForumAdmin::createForum(0, $forumID, "History", "", 0, 2, "NHLHistory");
	$subID = AppForumAdmin::createForum(0, $forumID, "Game Previews", "", 0, 2, "NHLGamePreviews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Player and Team Comparisons", "", 0, 2, "NHL Comparisons");
	$subID = AppForumAdmin::createForum(0, $forumID, "Power Rankings", "", 0, 2, "NHLPowerRankings");
	$subID = AppForumAdmin::createForum(0, $forumID, "Predictions", "", 0, 2, "NHLPredictions");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NHL Draft", "Insights into this year's NHL Draft", 0, 2, "NHLDraft");
$forumID = AppForumAdmin::createForum($catID, 0, "Fantasy Hockey", "The web's best forum to help you win your NHL Fantasy league.", 0, 2, "NHLFantasy");
$forumID = AppForumAdmin::createForum($catID, 0, "NHL Gaming", "Tips and tricks for NHL15 gamers.", 0, 2, "NHLGaming");

// Divisions
$catID = AppForumAdmin::createCategory("NHLDivisions");

$forumID = AppForumAdmin::createForum($catID, 0, "Atlantic Division (East)", "", 0, 2, "NHLAtlantic");
	$subID = AppForumAdmin::createForum(0, $forumID, "Boston Bruins", "", 0, 2, "BOSBruins");
	$subID = AppForumAdmin::createForum(0, $forumID, "Buffalo Sabres", "", 0, 2, "BUFSabres");
	$subID = AppForumAdmin::createForum(0, $forumID, "Detroit Red Wings", "", 0, 2, "DETRedWings");
	$subID = AppForumAdmin::createForum(0, $forumID, "Florida Panthers", "", 0, 2, "FLPanthers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Montreal Canadiens", "", 0, 2, "MTLCanadiens");
	$subID = AppForumAdmin::createForum(0, $forumID, "Ottawa Senators", "", 0, 2, "OTTSenators");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tampa Bay Lightning", "", 0, 2, "TBLightning");
	$subID = AppForumAdmin::createForum(0, $forumID, "Toronto Maple Leafs", "", 0, 2, "TORMapleLeafs");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Metropolitan Division (East)", "", 0, 2, "NHLMetro");
	$subID = AppForumAdmin::createForum(0, $forumID, "Carolina Hurricanes", "", 0, 2, "CARHurricanes");
	$subID = AppForumAdmin::createForum(0, $forumID, "Columbus Blue Jackets", "", 0, 2, "COLBlueJackets");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Jersey Devils", "", 0, 2, "NJDevils");
	$subID = AppForumAdmin::createForum(0, $forumID, "New York Islanders", "", 0, 2, "NYIslanders");
	$subID = AppForumAdmin::createForum(0, $forumID, "New York Rangers", "", 0, 2, "NYRangers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Philadelphia Flyers", "", 0, 2, "PHIFlyers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Pittsburgh Penguins", "", 0, 2, "PITTPenguins");
	$subID = AppForumAdmin::createForum(0, $forumID, "Washington Capitals", "", 0, 2, "WASCapitals");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Central Divisions (West)", "", 0, 2, "NHLCentral");
	$subID = AppForumAdmin::createForum(0, $forumID, "Chicago Blackhawks", "", 0, 2, "CHIBlackhawks");
	$subID = AppForumAdmin::createForum(0, $forumID, "Colorado Avalanche", "", 0, 2, "COAvalanche");
	$subID = AppForumAdmin::createForum(0, $forumID, "Dallas Stars", "", 0, 2, "DALStars");
	$subID = AppForumAdmin::createForum(0, $forumID, "Minnesota Wild", "", 0, 2, "MNWild");
	$subID = AppForumAdmin::createForum(0, $forumID, "Nashville Predators", "", 0, 2, "NSHPredators");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Louis Blues", "", 0, 2, "STLBlues");
	$subID = AppForumAdmin::createForum(0, $forumID, "Winnipeg Jets", "", 0, 2, "WPGJets");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Pacific Division(West)", "", 0, 2, "NHLPacific");
	$subID = AppForumAdmin::createForum(0, $forumID, "Anaheim Ducks", "", 0, 2, "ANADucks");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arizona Coyotes", "", 0, 2, "AZCoyotes");
	$subID = AppForumAdmin::createForum(0, $forumID, "Calgary Flames", "", 0, 2, "CALFlames");
	$subID = AppForumAdmin::createForum(0, $forumID, "Edmonton Oilers", "", 0, 2, "EDMOilers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Los Angeles Kings", "", 0, 2, "LAKings");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Jose Sharks", "", 0, 2, "SJSharks");
	$subID = AppForumAdmin::createForum(0, $forumID, "Vancouver Canucks", "", 0, 2, "VANCanucks");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss any off-topic things here.", 0, 2, "NHLLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the NHL community.", 0, 2, "NHLIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about the NHL or the forums.", 0, 2, "NHLInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

