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


// NBA
$catID = AppForumAdmin::createCategory("NBA");

$forumID = AppForumAdmin::createForum($catID, 0, "NBA News", "The latest news and updates for the NBA community.", 0, 2, "NBANews");
$forumID = AppForumAdmin::createForum($catID, 0, "NBA Discussion", "Discussing all things NBA that don't belong elsewhere.", 0, 2, "NBA");
	$subID = AppForumAdmin::createForum(0, $forumID, "History", "", 0, 2, "NBAHistory");
	$subID = AppForumAdmin::createForum(0, $forumID, "Game Previews", "", 0, 2, "NBAGamePreviews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Player and Team Comparisons", "", 0, 2, "NBAComparisons");
	$subID = AppForumAdmin::createForum(0, $forumID, "Power Rankings", "", 0, 2, "NBAPowerRankings");
	$subID = AppForumAdmin::createForum(0, $forumID, "Predictions", "", 0, 2, "NBAPredictions");
	
$forumID = AppForumAdmin::createForum($catID, 0, "NBA Draft", "Insights into this year's NBA Draft", 0, 2, "NBADraft");
$forumID = AppForumAdmin::createForum($catID, 0, "Fantasy Basketball", "The web's best forum to help you win your NBA Fantasy league.", 0, 2, "NBAFantasy");
$forumID = AppForumAdmin::createForum($catID, 0, "NBA Gaming", "Tips and tricks for NBA Live and NBA 2K gamers.", 0, 2, "NBAGaming");

// Divisions
$catID = AppForumAdmin::createCategory("NBADivisions");

$forumID = AppForumAdmin::createForum($catID, 0, "Atlantic", "", 0, 2, "NBAAtlantic");
	$subID = AppForumAdmin::createForum(0, $forumID, "Boston Celtics", "", 0, 2, "BOSCeltics");
	$subID = AppForumAdmin::createForum(0, $forumID, "Brooklyn Nets", "", 0, 2, "BKYNets");
	$subID = AppForumAdmin::createForum(0, $forumID, "New York Knicks", "", 0, 2, "NYKnick");
	$subID = AppForumAdmin::createForum(0, $forumID, "Philadelphia 76ers", "", 0, 2, "PHI76ers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Toronto Raptors", "", 0, 2, "TORRaptors");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Central", "", 0, 2, "NBACentral");
	$subID = AppForumAdmin::createForum(0, $forumID, "Chicago Bulls", "", 0, 2, "CHIBulls");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cleveland Cavaliers", "", 0, 2, "CLECavaliers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Detroit Pistons", "", 0, 2, "DETPistons");
	$subID = AppForumAdmin::createForum(0, $forumID, "Indiana Pacers", "", 0, 2, "INDPacers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Milwaukee Bucks", "", 0, 2, "MKEBucks");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Southeast", "", 0, 2, "NBASoutheast");
	$subID = AppForumAdmin::createForum(0, $forumID, "Atlanta Hawks", "", 0, 2, "ATLHawks");
	$subID = AppForumAdmin::createForum(0, $forumID, "Charlotte Hornets", "", 0, 2, "CHAHornets");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miami Heat", "", 0, 2, "MIAHeat");
	$subID = AppForumAdmin::createForum(0, $forumID, "Orlando Magic", "", 0, 2, "ORLMagic");
	$subID = AppForumAdmin::createForum(0, $forumID, "Washington Wizards", "", 0, 2, "WASWizards");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Northwest", "", 0, 2, "NBANorthwest");
	$subID = AppForumAdmin::createForum(0, $forumID, "Denver Nuggets", "", 0, 2, "DENNuggets");
	$subID = AppForumAdmin::createForum(0, $forumID, "Minnesota Timberwolves", "", 0, 2, "MNTimberwolves");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oklahoma City Thunder", "", 0, 2, "OKCThunder");
	$subID = AppForumAdmin::createForum(0, $forumID, "Portland Trail Blazers", "", 0, 2, "PORTrailBlazers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Utah Jazz", "", 0, 2, "UTJazz");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Pacific", "", 0, 2, "NBAPacific");
	$subID = AppForumAdmin::createForum(0, $forumID, "Golden State Warriors", "", 0, 2, "GSWarriors");
	$subID = AppForumAdmin::createForum(0, $forumID, "Los Angeles Clippers", "", 0, 2, "LACLippers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Los Angeles Lakers ", "", 0, 2, "LALakers");
	$subID = AppForumAdmin::createForum(0, $forumID, "Phoenix Suns", "", 0, 2, "PHXSuns");
	$subID = AppForumAdmin::createForum(0, $forumID, "Sacramento Kings", "", 0, 2, "SACKings");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Southwest", "", 0, 2, "NBASouthwest");
	$subID = AppForumAdmin::createForum(0, $forumID, "Dallas Mavericks", "", 0, 2, "DALMavericks");
	$subID = AppForumAdmin::createForum(0, $forumID, "Houston Rockets", "", 0, 2, "HOURockets");
	$subID = AppForumAdmin::createForum(0, $forumID, "Memphis Grizzlies", "", 0, 2, "MEMGrizzlies");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Orleans Pelicans", "", 0, 2, "NOLAPelicans");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Antonio Spurs", "", 0, 2, "SASpurs");
	

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss any off-topic things here.", 0, 2, "NBALounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the music community.", 0, 2, "NBAIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about the NBA or the forums.", 0, 2, "NBAInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

