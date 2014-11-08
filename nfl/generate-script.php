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


// NFL
$catID = AppForumAdmin::createCategory("NFL");

$forumID = AppForumAdmin::createForum($catID, 0, "NFL News", "The latest news and updates for the NFL community.", 0, 2, "NFLNews");
$forumID = AppForumAdmin::createForum($catID, 0, "NFL Discussion", "Discussing all things NFL that don't belong elsewhere.", 0, 2, "NFL");
	$subID = AppForumAdmin::createForum(0, $forumID, "History", "", 0, 2, "NFLHistory");
	$subID = AppForumAdmin::createForum(0, $forumID, "Game Previews", "", 0, 2, "NFLGamePreviews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Player and Team Comparisons", "", 0, 2, "NFL Comparisons");
	$subID = AppForumAdmin::createForum(0, $forumID, "Power Rankings", "", 0, 2, "NFLPowerRankings");
	$subID = AppForumAdmin::createForum(0, $forumID, "Predictions", "", 0, 2, "NFLPredictions");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFL Draft", "Insights into this year's NFL Draft", 0, 2, "NFLDraft");
$forumID = AppForumAdmin::createForum($catID, 0, "Fantasy Basketball", "The web's best forum to help you win your NFL Fantasy league.", 0, 2, "NFLFantasy");
$forumID = AppForumAdmin::createForum($catID, 0, "NFL Gaming", "Tips and tricks for Madden gamers.", 0, 2, "NFLGaming");

// Divisions
$catID = AppForumAdmin::createCategory("NFLDivisions");

$forumID = AppForumAdmin::createForum($catID, 0, "AFC East", "", 0, 2, "AFCEast");
	$subID = AppForumAdmin::createForum(0, $forumID, "Buffalo Bills", "", 0, 2, "BUFBills");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miami Dolphins", "", 0, 2, "MIADolphins");
	$subID = AppForumAdmin::createForum(0, $forumID, "New England Patriots", "", 0, 2, "NEPatriots");
	$subID = AppForumAdmin::createForum(0, $forumID, "New York Jets", "", 0, 2, "NYJets");

$forumID = AppForumAdmin::createForum($catID, 0, "AFC North", "", 0, 2, "AFCNorth");
	$subID = AppForumAdmin::createForum(0, $forumID, "Baltimore Ravens", "", 0, 2, "BALRavens");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cincinnati Bengals", "", 0, 2, "CINBengals");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cleveland Browns", "", 0, 2, "CLEBrowns");
	$subID = AppForumAdmin::createForum(0, $forumID, "Pittsburgh Steelers", "", 0, 2, "PITTSteelers");
	
$forumID = AppForumAdmin::createForum($catID, 0, "AFC South", "", 0, 2, "AFCSouth");
	$subID = AppForumAdmin::createForum(0, $forumID, "Houston Texas", "", 0, 2, "HOUTexans");
	$subID = AppForumAdmin::createForum(0, $forumID, "Indianapolis Colts", "", 0, 2, "INDColts");
	$subID = AppForumAdmin::createForum(0, $forumID, "Jacksonville Jaguars", "", 0, 2, "JAXJaguars");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tennessee Titans", "", 0, 2, "TENTitans");
	
$forumID = AppForumAdmin::createForum($catID, 0, "AFC West", "", 0, 2, "AFCWest");
	$subID = AppForumAdmin::createForum(0, $forumID, "Denver Broncos", "", 0, 2, "DENBroncos");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kansas City Chiefs", "", 0, 2, "KCChiefs");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oakland Raiders", "", 0, 2, "OAKRaiders");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Diego Chargers", "", 0, 2, "SDChargers");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFC East", "", 0, 2, "NFCEast");
	$subID = AppForumAdmin::createForum(0, $forumID, "Dallas Cowboys", "", 0, 2, "DALCowboys");
	$subID = AppForumAdmin::createForum(0, $forumID, "New York Giants", "", 0, 2, "NYGiants");
	$subID = AppForumAdmin::createForum(0, $forumID, "Philadelphia Eagles", "", 0, 2, "PHIEagles");
	$subID = AppForumAdmin::createForum(0, $forumID, "Washington Redskins", "", 0, 2, "WASRedskins");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFC North", "", 0, 2, "NFCNorth");
	$subID = AppForumAdmin::createForum(0, $forumID, "Chicago Bears", "", 0, 2, "CHIBears");
	$subID = AppForumAdmin::createForum(0, $forumID, "Detroit Lions", "", 0, 2, "DETLions");
	$subID = AppForumAdmin::createForum(0, $forumID, "Green Bay Packers", "", 0, 2, "GBPackers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Minnesota Vikings", "", 0, 2, "MNVikings");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFC South", "", 0, 2, "NFCSouth");
	$subID = AppForumAdmin::createForum(0, $forumID, "Atlanta Falcons", "", 0, 2, "ATLFalcons");
	$subID = AppForumAdmin::createForum(0, $forumID, "Carolina Panthers", "", 0, 2, "CARPanthers");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Orleans Saints", "", 0, 2, "NOLASaints");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tampa Bay Buccaneers", "", 0, 2, "TBBuccaneers");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NFC West", "", 0, 2, "NFCWest");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arizona Cardinals", "", 0, 2, "AZCardinals");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Francisco 49ers", "", 0, 2, "SF49ers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Seattle Seahawks", "", 0, 2, "SEASeahawks");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Louis Rams", "", 0, 2, "STLRams");
	

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss any off-topic things here.", 0, 2, "NFLLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the NFL community.", 0, 2, "NFLIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about the NFL or the forums.", 0, 2, "NFLInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);
