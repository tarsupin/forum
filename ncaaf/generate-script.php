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


// NCAAF
$catID = AppForumAdmin::createCategory("NCAAF");

$forumID = AppForumAdmin::createForum($catID, 0, "NCAAF News", "The latest news and updates for the NCAAF community.", 0, 2, "NCAAFNews");
$forumID = AppForumAdmin::createForum($catID, 0, "NCAAF Discussion", "Discussing all things NCAAF that don't belong elsewhere.", 0, 2, "NCAAF");
	$subID = AppForumAdmin::createForum(0, $forumID, "History", "", 0, 2, "NCAAFHistory");
	$subID = AppForumAdmin::createForum(0, $forumID, "Game Previews", "", 0, 2, "NCAAFGamePreviews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Player and Team Comparisons", "", 0, 2, "NCAAFComparisons");
	$subID = AppForumAdmin::createForum(0, $forumID, "Power Rankings", "", 0, 2, "NCAAFPowerRankings");
	$subID = AppForumAdmin::createForum(0, $forumID, "Predictions", "", 0, 2, "NCAAFPredictions");
$forumID = AppForumAdmin::createForum($catID, 0, "NCAAF Playoff", "Discussing who should be in and out of the NCAAF Playoff", 0, 2, "NCAAFPlayoff");
$forumID = AppForumAdmin::createForum($catID, 0, "Heisman Watch", "Keeping tabs on the frontrunner for this year's Heisman Trophy.", 0, 2, "HeismanWatch");
$forumID = AppForumAdmin::createForum($catID, 0, "NFL Draft", "Insights into this year's NFL Draft", 0, 2, "NFLDraft");


// Conferences
$catID = AppForumAdmin::createCategory("NCAAF Conferences");

$forumID = AppForumAdmin::createForum($catID, 0, "AAC", "", 0, 2, "AACFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cincinnati", "", 0, 2, "UCBearcatsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Connecticut", "", 0, 2, "UConnFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "East Carolina", "", 0, 2, "ECUPiratesFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Houston", "", 0, 2, "HOUCougarsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Memphis", "", 0, 2, "MEMTigersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "SMU", "", 0, 2, "SMUMustangsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Temple", "", 0, 2, "TempleFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tulane", "", 0, 2, "TulaneFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tulsa", "", 0, 2, "TulsaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UCF", "", 0, 2, "UCFKnightsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "USF", "", 0, 2, "USFBullsFB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "ACC", "", 0, 2, "ACCFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Boston College", "", 0, 2, "BCEagles");
	$subID = AppForumAdmin::createForum(0, $forumID, "Clemson", "", 0, 2, "ClemsonFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Duke", "", 0, 2, "DukeFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "FSU", "", 0, 2, "SeminoleFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Georgia Tech", "", 0, 2, "GATechFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Louisville", "", 0, 2, "LouisvilleFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miami", "", 0, 2, "UMiamiFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "North Carolina", "", 0, 2, "TarHeelFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "NC State", "", 0, 2, "NCStateFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Pittsburgh", "", 0, 2, "PittPanthersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Syracuse", "", 0, 2, "SyracuseFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Virginia", "", 0, 2, "UVCavaliersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Virginia Tech", "", 0, 2, "HokiesFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wake Forest", "", 0, 2, "WakeForestFB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Big 12", "", 0, 2, "Big12Football");
	$subID = AppForumAdmin::createForum(0, $forumID, "Baylor", "", 0, 2, "BaylorFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Iowa St", "", 0, 2, "IowaStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kansas", "", 0, 2, "KansasFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kansas St", "", 0, 2, "KStateFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oklahoma", "", 0, 2, "SoonersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "OK State", "", 0, 2, "OKStateFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "TCU", "", 0, 2, "HornedFrogsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas", "", 0, 2, "TexasFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas Tech", "", 0, 2, "TexasTechFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "West Virginia", "", 0, 2, "WestVirginiaFB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Big Ten", "", 0, 2, "BigTenFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Illinois", "", 0, 2, "IllinoisFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Indiana", "", 0, 2, "IndianaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Iowa", "", 0, 2, "IowaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Maryland", "", 0, 2, "MarylandFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Michigan", "", 0, 2, "MichiganFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Michigan St", "", 0, 2, "MichStateFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Minnesota", "", 0, 2, "MinnesotaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Nebraska", "", 0, 2, "NebraskaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Northwestern", "", 0, 2, "NWWildcatsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Ohio St", "", 0, 2, "OhioStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Penn St", "", 0, 2, "PennStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Purdue", "", 0, 2, "PurdueFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Rutgers", "", 0, 2, "RutgersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wisconsin", "", 0, 2, "WisconsinFB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Conference USA", "", 0, 2, "ConferenceUSAFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "FAU", "", 0, 2, "FAUOwlsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "FIU", "", 0, 2, "FIUPanthersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "LA Tech", "", 0, 2, "LATechFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Marshall", "", 0, 2, "MarshallFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Middle Tennessee", "", 0, 2, "BlueRaidersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "North Texas", "", 0, 2, "MeanGreenFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Old Dominion", "", 0, 2, "OldDominionFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Rice", "", 0, 2, "RiceFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Southern Miss", "", 0, 2, "SouthernMissFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UAB", "", 0, 2, "UABBlazersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UTEP", "", 0, 2, "UTEPMinersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UTSA", "", 0, 2, "UTSARoadrunnersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Western Kentucky", "", 0, 2, "HilltoppersFB");

	
$forumID = AppForumAdmin::createForum($catID, 0, "FBS Independents", "", 0, 2, "IndependentFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Army", "", 0, 2, "ArmyFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "BYU", "", 0, 2, "BYUCougarFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Navy", "", 0, 2, "NavyFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Notre Dame", "", 0, 2, "NotreDameFB");

	
$forumID = AppForumAdmin::createForum($catID, 0, "MAC", "", 0, 2, "MACFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Akron", "", 0, 2, "AkronFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Ball St", "", 0, 2, "BallStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Bowling Green", "", 0, 2, "BowlingGreenFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Buffalo", "", 0, 2, "BuffaloFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Central Mich", "", 0, 2, "CMUChipsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Eastern Mich", "", 0, 2, "EMUEaglesFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kent St", "", 0, 2, "KentStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UMass", "", 0, 2, "UMassFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miami(OH)", "", 0, 2, "MiamiOhioFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "NIU", "", 0, 2, "NIUHuskiesFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Ohio", "", 0, 2, "OhioFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Toledo", "", 0, 2, "ToledoFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Western Mich", "", 0, 2, "WMUBroncosFB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Mountain West", "", 0, 2, "MountainWestFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Air Force", "", 0, 2, "AirForceFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Boise St", "", 0, 2, "BoiseStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Colorado St", "", 0, 2, "ColoradoStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Fresno St", "", 0, 2, "FresnoStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Hawaii", "", 0, 2, "HawaiiFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Nevada", "", 0, 2, "NevadaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Mexico", "", 0, 2, "NewMexicoFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Diego St", "", 0, 2, "SanDiegoStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Jose St", "", 0, 2, "SanJoseStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UNLV", "", 0, 2, "UNLVRebelsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Utah St", "", 0, 2, "UtahStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wyoming", "", 0, 2, "WyomingFB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Pac 12", "", 0, 2, "PAC12Football");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arizona", "", 0, 2, "ArizonaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arizona St", "", 0, 2, "ArizonaStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cal", "", 0, 2, "CalBearFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Colorado", "", 0, 2, "ColoradoFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oregon", "", 0, 2, "OregonFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oregon St", "", 0, 2, "OregonStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Stanford", "", 0, 2, "StanfordFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UCLA", "", 0, 2, "UCLABruinsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "USC", "", 0, 2, "USCTrojansFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Utah", "", 0, 2, "UtahFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Washington", "", 0, 2, "WashingtonFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Washington St", "", 0, 2, "WashingtonStFB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "SEC", "", 0, 2, "SECFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Alabama", "", 0, 2, "AlabamaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arkansas", "", 0, 2, "ArkansasFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Auburn", "", 0, 2, "AuburnFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Florida", "", 0, 2, "FloridaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Georgia", "", 0, 2, "GeorgiaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kentucky", "", 0, 2, "KentuckyFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "LSU", "", 0, 2, "LSUTigersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Ole Miss", "", 0, 2, "OleMissFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miss State", "", 0, 2, "MudDogsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Missouri", "", 0, 2, "MissouriFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "South Carolina", "", 0, 2, "SouthCarolinaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tennessee", "", 0, 2, "TennesseeFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas A&M", "", 0, 2, "AggiesFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Vanderbilt", "", 0, 2, "VanderbiltFB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Sun Belt", "", 0, 2, "SunBeltFootball");
	$subID = AppForumAdmin::createForum(0, $forumID, "App State", "", 0, 2, "AppStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arkansas St", "", 0, 2, "ArkStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Georgia Southern", "", 0, 2, "GASouthern FB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Georgia St", "", 0, 2, "GAStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Idaho", "", 0, 2, "IdahoFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "LA-Lafayette", "", 0, 2, "RaginCajunsFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "LA-Monroe", "", 0, 2, "WarhawksFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Mexico St", "", 0, 2, "NMStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "South Alabama", "", 0, 2, "SouthAlabamaFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas St", "", 0, 2, "TexasStFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Troy", "", 0, 2, "TroyFB");
	
// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss any off-topic things here.", 0, 2, "NCAAFLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the NCAAF community.", 0, 2, "NCAAFIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about the NCAAF or the forums.", 0, 2, "NCAAFInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

