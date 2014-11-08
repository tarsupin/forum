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


// MLB
$catID = AppForumAdmin::createCategory("MLB");

$forumID = AppForumAdmin::createForum($catID, 0, "MLB News", "The latest news and updates for the MLB community.", 0, 2, "MLBNews");
$forumID = AppForumAdmin::createForum($catID, 0, "MLB Discussion", "Discussing all things MLB that don't belong elsewhere.", 0, 2, "MLB");
	$subID = AppForumAdmin::createForum(0, $forumID, "History", "", 0, 2, "MLBHistory");
	$subID = AppForumAdmin::createForum(0, $forumID, "Game Previews", "", 0, 2, "MLBGamePreviews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Player and Team Comparisons", "", 0, 2, "MLBComparisons");
	$subID = AppForumAdmin::createForum(0, $forumID, "Power Rankings", "", 0, 2, "MLBPowerRankings");
	$subID = AppForumAdmin::createForum(0, $forumID, "Predictions", "", 0, 2, "MLBPredictions");
	
$forumID = AppForumAdmin::createForum($catID, 0, "MLB Draft", "Insights into this year's MLB Draft", 0, 2, "MLBDraft");
$forumID = AppForumAdmin::createForum($catID, 0, "Fantasy Basketball", "The web's best forum to help you win your MLB Fantasy league.", 0, 2, "MLBFantasy");
$forumID = AppForumAdmin::createForum($catID, 0, "MLB Gaming", "Tips and tricks for MLB The Show gamers.", 0, 2, "MLBGaming");

// Divisions
$catID = AppForumAdmin::createCategory("MLBDivisions");

$forumID = AppForumAdmin::createForum($catID, 0, "AL East", "", 0, 2, "ALEast");
	$subID = AppForumAdmin::createForum(0, $forumID, "Baltimore Orioles", "", 0, 2, "BALOrioles");
	$subID = AppForumAdmin::createForum(0, $forumID, "Boston Red Sox", "", 0, 2, "BOSRedSox");
	$subID = AppForumAdmin::createForum(0, $forumID, "New York Yankees", "", 0, 2, "NYYankees");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tampa Bay Rays", "", 0, 2, "TBRays");
	$subID = AppForumAdmin::createForum(0, $forumID, "Toronto Blue Jays", "", 0, 2, "TORBlueJays");
	
$forumID = AppForumAdmin::createForum($catID, 0, "AL Central", "", 0, 2, "ALCentral");
	$subID = AppForumAdmin::createForum(0, $forumID, "Chicago White Sox", "", 0, 2, "CHIWhiteSox");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cleveland Indians", "", 0, 2, "CLEIndians");
	$subID = AppForumAdmin::createForum(0, $forumID, "Detroit Tigers", "", 0, 2, "DETTigers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kansas City Royals", "", 0, 2, "KCRoyals");
	$subID = AppForumAdmin::createForum(0, $forumID, "Minnesota Twins", "", 0, 2, "MNTwins");
	
$forumID = AppForumAdmin::createForum($catID, 0, "AL West", "", 0, 2, "ALWest");
	$subID = AppForumAdmin::createForum(0, $forumID, "Houston Astros", "", 0, 2, "HOUAstros");
	$subID = AppForumAdmin::createForum(0, $forumID, "Los Angeles Angels of Anaheim", "", 0, 2, "LAAngels");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oakland Athletics", "", 0, 2, "OAKAthletics");
	$subID = AppForumAdmin::createForum(0, $forumID, "Seattle Mariners", "", 0, 2, "SEAMariners");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas Rangers", "", 0, 2, "TXRangers");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NL East", "", 0, 2, "NLEast");
	$subID = AppForumAdmin::createForum(0, $forumID, "Atlanta Braves", "", 0, 2, "ATLBraves");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miami Marlins", "", 0, 2, "MIAMarlins");
	$subID = AppForumAdmin::createForum(0, $forumID, "New York Mets", "", 0, 2, "NYMets");
	$subID = AppForumAdmin::createForum(0, $forumID, "Philadelphia Phillies", "", 0, 2, "PHIPhillies");
	$subID = AppForumAdmin::createForum(0, $forumID, "Washington Nationals", "", 0, 2, "WASNationals");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NL Central", "", 0, 2, "NLCentral");
	$subID = AppForumAdmin::createForum(0, $forumID, "Chicago Cubs", "", 0, 2, "CHICubs");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cincinnati Reds", "", 0, 2, "CINReds");
	$subID = AppForumAdmin::createForum(0, $forumID, "Milwaukee Brewers", "", 0, 2, "MKEBrewers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Pittsburgh Pirates", "", 0, 2, "PITTPirates");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Louis Cardinals", "", 0, 2, "STLCardinals");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NL West", "", 0, 2, "NLWest");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arizona Diamondbacks", "", 0, 2, "AZDiamondbacks");
	$subID = AppForumAdmin::createForum(0, $forumID, "Colorado Rockies", "", 0, 2, "CORockies");
	$subID = AppForumAdmin::createForum(0, $forumID, "Los Angeles Dodgers", "", 0, 2, "LADodgers");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Diego Padres", "", 0, 2, "SDPadres");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Francisco Giants", "", 0, 2, "SFGiants");
	

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss any off-topic things here.", 0, 2, "MLBLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the music community.", 0, 2, "MLBIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about the MLB or the forums.", 0, 2, "MLBInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

