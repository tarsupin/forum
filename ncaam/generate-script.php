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


// NCAAM
$catID = AppForumAdmin::createCategory("NCAAM");

$forumID = AppForumAdmin::createForum($catID, 0, "NCAAM News", "The latest news and updates for the NCAAM community.", 0, 2, "NCAAMNews");
$forumID = AppForumAdmin::createForum($catID, 0, "NCAAM Discussion", "Discussing all things NCAAM that don't belong elsewhere.", 0, 2, "NCAAM");
	$subID = AppForumAdmin::createForum(0, $forumID, "History", "", 0, 2, "NCAAMHistory");
	$subID = AppForumAdmin::createForum(0, $forumID, "Game Previews", "", 0, 2, "NCAAMGamePreviews");
	$subID = AppForumAdmin::createForum(0, $forumID, "Player and Team Comparisons", "", 0, 2, "NCAAMComparisons");
	$subID = AppForumAdmin::createForum(0, $forumID, "Power Rankings", "", 0, 2, "NCAAMPowerRankings");
	$subID = AppForumAdmin::createForum(0, $forumID, "Predictions", "", 0, 2, "NCAAMPredictions");
$forumID = AppForumAdmin::createForum($catID, 0, "March Madness", "Discussing the Big Dance", 0, 2, "NCAAMMarchMadness");
$forumID = AppForumAdmin::createForum($catID, 0, "NIT", "Discussing who didn't make the Big Dance", 0, 2, "NITTournament");
$forumID = AppForumAdmin::createForum($catID, 0, "NBA Draft", "Insights into this year's NBA Draft", 0, 2, "NBADraft");


// Conferences
$catID = AppForumAdmin::createCategory("NCAAM Conferences");

$forumID = AppForumAdmin::createForum($catID, 0, "AAC", "", 0, 2, "AACBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cincinnati", "", 0, 2, "UCBearcatsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Connecticut", "", 0, 2, "UConnBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "East Carolina", "", 0, 2, "ECUPiratesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Houston", "", 0, 2, "HOUCougarsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Memphis", "", 0, 2, "MEMTigersFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "SMU", "", 0, 2, "SMUMustangsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Temple", "", 0, 2, "TempleBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tulane", "", 0, 2, "TulaneBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tulsa", "", 0, 2, "TulsaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UCF", "", 0, 2, "UCFKnightsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "USF", "", 0, 2, "USFBullsBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "ACC", "", 0, 2, "ACCBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Boston College", "", 0, 2, "BCEaglesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Clemson", "", 0, 2, "ClemsonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Duke", "", 0, 2, "DukeBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "FSU", "", 0, 2, "SeminoleBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Georgia Tech", "", 0, 2, "GATechBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Louisville", "", 0, 2, "LouisvilleBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miami", "", 0, 2, "UMiamiBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "North Carolina", "", 0, 2, "TarHeelBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "NC State", "", 0, 2, "NCStateBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Notre Dame", "", 0, 2, "NotreDameBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Pittsburgh", "", 0, 2, "PittPanthersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Syracuse", "", 0, 2, "SyracuseBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Virginia", "", 0, 2, "UVCavaliersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Virginia Tech", "", 0, 2, "HokiesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wake Forest", "", 0, 2, "WakeForestBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "America East", "", 0, 2, "AmericaEastBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Albany", "", 0, 2, "AlbanyBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Binghamton", "", 0, 2, "BinghamtonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Hartford", "", 0, 2, "HartfordHawksBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Maine", "", 0, 2, "MaineBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Hampshire", "", 0, 2, "NHWildcatsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Stony Brook", "", 0, 2, "StonyBrookBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UMass-Lowell", "", 0, 2, "RiverHawksBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UMBC", "", 0, 2, "UMBCRetrieversBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Vermont", "", 0, 2, "VermontBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Atlantic Sun", "", 0, 2, "some");
	$subID = AppForumAdmin::createForum(0, $forumID, "Florida Gulf Coast", "", 0, 2, "FGCEaglesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Jacksonville", "", 0, 2, "JacksonvilleBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kennesaw St", "", 0, 2, "KennesawBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Lipscomb", "", 0, 2, "LipscombBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "North Florida", "", 0, 2, "NFloridaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Northern Kentucky", "", 0, 2, "NKentuckyBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Stetson", "", 0, 2, "StetsonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "USC Upstate", "", 0, 2, "UpstateBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Atlantic 10", "", 0, 2, "Atlantic10Basketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Davidson", "", 0, 2, "DavidsonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Dayton", "", 0, 2, "DaytonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Duquesne", "", 0, 2, "DuquesneBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Fordham", "", 0, 2, "FordhamBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "George Mason", "", 0, 2, "GeorgeMasonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "George Washinton", "", 0, 2, "sGeorgeWashBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "La Salle", "", 0, 2, "LaSalleBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UMass", "", 0, 2, "UMassBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Rhode Island", "", 0, 2, "RhodeIsandBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Richmond", "", 0, 2, "SpidersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Joseph's", "", 0, 2, "StJoeBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Louis", "", 0, 2, "BillikensBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Bonaventure", "", 0, 2, "BonniesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "VCU", "", 0, 2, "VCURamsBB");
	
	
$forumID = AppForumAdmin::createForum($catID, 0, "Big 12", "", 0, 2, "Big12Basketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Baylor", "", 0, 2, "BaylorBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Iowa St", "", 0, 2, "IowaStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kansas", "", 0, 2, "KansasBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kansas St", "", 0, 2, "KStateBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oklahoma", "", 0, 2, "SoonersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "OK State", "", 0, 2, "OKStateBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "TCU", "", 0, 2, "HornedFrogsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas", "", 0, 2, "TexasBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas Tech", "", 0, 2, "TexasTechBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "West Virginia", "", 0, 2, "WestVirginiaBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Big East", "", 0, 2, "BigEastBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Butler", "", 0, 2, "ButlerBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Creighton", "", 0, 2, "CreightonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "DePaul", "", 0, 2, "DePaulBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Georgetown", "", 0, 2, "HoyasBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Marquette", "", 0, 2, "MarquetteBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Providence", "", 0, 2, "ProvidenceBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. John's", "", 0, 2, "StJohnsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Seton Hall", "", 0, 2, "SetonHallBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Villanova", "", 0, 2, "VillanovaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Xavier", "", 0, 2, "XavierBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Big Sky", "", 0, 2, "BigSkyBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Eastern Wash", "", 0, 2, "EWEaglesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Idaho St", "", 0, 2, "IdahoStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Montana", "", 0, 2, "MontanaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Montana St", "", 0, 2, "MontanaStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "North Dakota", "", 0, 2, "NDakotaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Northern Arizona", "", 0, 2, "NArizonaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Northern Colorado", "", 0, 2, "NColoradoBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Portland St", "", 0, 2, "PortlandStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Southern Utah", "", 0, 2, "SUtahBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Weber St", "", 0, 2, "WeberStBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Big South", "", 0, 2, "BigSouthBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Campbell", "", 0, 2, "CampbellBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Charleston Southern", "", 0, 2, "CharlestonSouthernBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Coastal Carolina", "", 0, 2, "ChanticleersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Gardner-Webb", "", 0, 2, "GardnerWebbBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "High Point", "", 0, 2, "HighPointBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Liberty", "", 0, 2, "LIbertyBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Longwood", "", 0, 2, "LongwoodBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UNC Asheville", "", 0, 2, "UNCAshevilleBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Presbyterian", "", 0, 2, "BlueHoseBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Radford", "", 0, 2, "RadfordBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Winthrop", "", 0, 2, "WinthropBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Big Ten", "", 0, 2, "BigTenBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Illinois", "", 0, 2, "IllinoisBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Indiana", "", 0, 2, "IndianaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Iowa", "", 0, 2, "IowaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Maryland", "", 0, 2, "MarylandBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Michigan", "", 0, 2, "MichiganBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Michigan St", "", 0, 2, "MichStateBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Minnesota", "", 0, 2, "MinnesotaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Nebraska", "", 0, 2, "NebraskaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Northwestern", "", 0, 2, "NWWildcatsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Ohio St", "", 0, 2, "OhioStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Penn St", "", 0, 2, "PennStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Purdue", "", 0, 2, "PurdueBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Rutgers", "", 0, 2, "RutgersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wisconsin", "", 0, 2, "WisconsinBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Big West", "", 0, 2, "BigWestBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cal Poly", "", 0, 2, "CalPolyBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cal State Fullerton", "", 0, 2, "CalStFullertonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cal State Northridge", "", 0, 2, "MatadorsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Hawaii", "", 0, 2, "HawaiiBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Long Beach State", "", 0, 2, "CSLB49ersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UC Davis", "", 0, 2, "UCDavisBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UC Irvine", "", 0, 2, "UCIrvineBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UC Riverside", "", 0, 2, "UCRiversideBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UC Santa Barbara", "", 0, 2, "GauchosBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Colonial", "", 0, 2, "ColonialBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Charleston", "", 0, 2, "CharlesonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Delaware", "", 0, 2, "DelawareBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Drexel", "", 0, 2, "DrexelBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Elon", "", 0, 2, "ElonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Hofstra", "", 0, 2, "HofstraBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "James Madison", "", 0, 2, "JamesMadisonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Northeastern", "", 0, 2, "NEHuskiesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "NC-Wilmington", "", 0, 2, "NCWilmingtonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Towson", "", 0, 2, "TowsonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "William & Mary", "", 0, 2, "TribeBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Conference USA", "", 0, 2, "ConferenceBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Charlotte", "", 0, 2, "Charlotte49ersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "FAU", "", 0, 2, "FAUOwlsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "FIU", "", 0, 2, "FIUPanthersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "LA Tech", "", 0, 2, "LATechBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Marshall", "", 0, 2, "MarshallBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Middle Tennessee", "", 0, 2, "BlueRaidersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "North Texas", "", 0, 2, "MeanGreenBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Old Dominion", "", 0, 2, "OldDominionBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Rice", "", 0, 2, "RiceBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Southern Miss", "", 0, 2, "SouthernMissBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UAB", "", 0, 2, "UABBlazersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UTEP", "", 0, 2, "UTEPMinersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UTSA", "", 0, 2, "UTSARoadrunnersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Western Kentucky", "", 0, 2, "HilltoppersBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Horizon League", "", 0, 2, "HorizonLeagueBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cleveland St", "", 0, 2, "CLEStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Detroit", "", 0, 2, "DETTitansBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Green Bay", "", 0, 2, "GBPhoenixBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "IL-Chicago", "", 0, 2, "ILChicagoFlamesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Milwaukee", "", 0, 2, "MKEPanthersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oakland", "", 0, 2, "GoldenGrizzliesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Valparasio", "", 0, 2, "ValparaisoBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wright St", "", 0, 2, "WrightStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Youngstown", "", 0, 2, "YoungstownStBB");


$forumID = AppForumAdmin::createForum($catID, 0, "Independents", "", 0, 2, "IndependentBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "NJIT Highlanders", "", 0, 2, "NJITHighlandersBB");

$forumID = AppForumAdmin::createForum($catID, 0, "Ivy League", "", 0, 2, "IvyLeagueBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Brown", "", 0, 2, "BrownBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Columbia", "", 0, 2, "ColumbiaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cornell", "", 0, 2, "CornellBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Dartmouth", "", 0, 2, "DartmouthBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Harvard", "", 0, 2, "HarvardBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Pennsylvania", "", 0, 2, "PennQuakersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Princeton", "", 0, 2, "PrincetonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Yale", "", 0, 2, "YaleBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "MAAC", "", 0, 2, "MAACBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Canisius", "", 0, 2, "CanisiusBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Fairfield", "", 0, 2, "FairfieldBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Iona", "", 0, 2, "IonaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Manhattan", "", 0, 2, "ManhattanBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Marist", "", 0, 2, "MaristBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Monmouth", "", 0, 2, "MonmouthBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Niagara", "", 0, 2, "NiagaraBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Quinnipiac", "", 0, 2, "QuinnipiacBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Siena", "", 0, 2, "SienaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Peter's", "", 0, 2, "StPetersBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "MAC", "", 0, 2, "MACBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Akron", "", 0, 2, "AkronBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Ball St", "", 0, 2, "BallStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Bowling Green", "", 0, 2, "BowlingGreenBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Buffalo", "", 0, 2, "BuffaloFB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Central Mich", "", 0, 2, "CMUChipsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Eastern Mich", "", 0, 2, "EMUEaglesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kent St", "", 0, 2, "KentStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miami(OH)", "", 0, 2, "MiamiOhioBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "NIU", "", 0, 2, "NIUHuskiesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Ohio", "", 0, 2, "OhioBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Toledo", "", 0, 2, "ToledoBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Western Mich", "", 0, 2, "WMUBroncosBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "MEAC", "", 0, 2, "MEACBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Bethune-Cookman", "", 0, 2, "BethuneCookmanBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Coppin St", "", 0, 2, "CoppinBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Delaware St", "", 0, 2, "DelawareBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Florida A&M", "", 0, 2, "RattlersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Hampton", "", 0, 2, "HamptonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Howard", "", 0, 2, "HowardBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Maryland-Easton", "", 0, 2, "ShorehawksBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Morgan St", "", 0, 2, "MorganStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Norfolk St", "", 0, 2, "NorfolkStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "NC A&T", "", 0, 2, "NCATAggiesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "NC Central", "", 0, 2, "NCCEaglesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Savannah St", "", 0, 2, "SavannahBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "SC State", "", 0, 2, "SCStBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Missouri Valley", "", 0, 2, "MissouriValleyBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Bradley", "", 0, 2, "BradleyBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Drake", "", 0, 2, "DrakeBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Evansville", "", 0, 2, "EvansvilleBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Illinois St", "", 0, 2, "RedbirdsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Indiana St", "", 0, 2, "SycamoresBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Loyola(IL)", "", 0, 2, "RamblersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Missouri St", "", 0, 2, "MissouriStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Northern Iowa", "", 0, 2, "NorthernIowaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Southern Illinois", "", 0, 2, "SalukisBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wichita St", "", 0, 2, "ShockersBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Mountain West", "", 0, 2, "MountainWestBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Air Force", "", 0, 2, "AirForceBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Boise St", "", 0, 2, "BoiseStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Colorado St", "", 0, 2, "ColoradoStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Fresno St", "", 0, 2, "FresnoBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Nevada", "", 0, 2, "NevadaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Mexico", "", 0, 2, "NewMexicoBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Diego St", "", 0, 2, "SanDiegoStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Jose St", "", 0, 2, "SanJoseStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UNLV", "", 0, 2, "UNLVRebelsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Utah St", "", 0, 2, "UtahStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wyoming", "", 0, 2, "WyomingBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Northeast", "", 0, 2, "NortheastBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Bryant", "", 0, 2, "BryantBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Central Conn St", "", 0, 2, "CCSBlueDevilsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Fairleigh Dickinson", "", 0, 2, "FairleighDickinsonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "LIU Brooklyn", "", 0, 2, "BlackbirdsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Mount St. Mary's", "", 0, 2, "MountStMarysBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Robert Morris", "", 0, 2, "RobertMorrisBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Sacred Heart", "", 0, 2, "SacredHeartBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Francis (NY)", "", 0, 2, "StFrancisTerriersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Francis U", "", 0, 2, "RedFlashBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wagner", "", 0, 2, "WagnerBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Ohio Valley", "", 0, 2, "OhioValleyBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Austin Peay St", "", 0, 2, "AustinPeayStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Belmont", "", 0, 2, "BelmontBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Eastern Illinois", "", 0, 2, "EasternIllinoisBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Eastern Kentucky", "", 0, 2, "EasternKentuckyBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Jacksonville St", "", 0, 2, "JacksonvilleStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Morehead St", "", 0, 2, "MoreheadStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Murray St", "", 0, 2, "MurrayStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "SE Missouri St", "", 0, 2, "SEMissouriStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "SIU-Edwardsville", "", 0, 2, "SIUEdwardsvilleBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tennessee-Martin", "", 0, 2, "TNMartinBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tennessee St", "", 0, 2, "TNStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tennessee Tech", "", 0, 2, "TNTechBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Pac 12", "", 0, 2, "PAC12Basketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arizona", "", 0, 2, "ArizonaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arizona St", "", 0, 2, "ArizonaStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cal", "", 0, 2, "CalBearBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Colorado", "", 0, 2, "ColoradoBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oregon", "", 0, 2, "OregonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oregon St", "", 0, 2, "OregonStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Stanford", "", 0, 2, "StanfordBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UCLA", "", 0, 2, "UCLABruinsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "USC", "", 0, 2, "USCTrojansBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Utah", "", 0, 2, "UtahBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Washington", "", 0, 2, "WashingtonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Washington St", "", 0, 2, "WashingtonStBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Patriot League", "", 0, 2, "PatriotLeaugeBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "American U", "", 0, 2, "AmericanBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Army", "", 0, 2, "ArmyBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Boston U", "", 0, 2, "BostonUTerriersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Bucknell", "", 0, 2, "BucknellBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Colgate", "", 0, 2, "ColgateBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Holy Cross", "", 0, 2, "HolyCrossBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Lafayette", "", 0, 2, "LafayetteBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Lehigh", "", 0, 2, "LehighBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Loyola (MD)", "", 0, 2, "GreyhoundsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Navy", "", 0, 2, "NavyBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "SEC", "", 0, 2, "SECBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Alabama", "", 0, 2, "AlabamaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arkansas", "", 0, 2, "ArkansasBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Auburn", "", 0, 2, "AuburnBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Florida", "", 0, 2, "FloridaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Georgia", "", 0, 2, "GeorgiaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Kentucky", "", 0, 2, "KentuckyBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "LSU", "", 0, 2, "LSUTigersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Ole Miss", "", 0, 2, "OleMissBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Miss State", "", 0, 2, "MudDogsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Missouri", "", 0, 2, "MissouriBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "South Carolina", "", 0, 2, "SouthCarolinaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Tennessee", "", 0, 2, "TennesseeBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas A&M", "", 0, 2, "AggiesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Vanderbilt", "", 0, 2, "VanderbiltBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Southern", "", 0, 2, "SouthernBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Chattanooga", "", 0, 2, "ChattanoogaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Citadel", "", 0, 2, "CitadelBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "East TN St", "", 0, 2, "ETennStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Furman", "", 0, 2, "FurmanBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Mercer", "", 0, 2, "MercerBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Samford", "", 0, 2, "SamfordBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UNC Greensboro", "", 0, 2, "UNCGreensboroBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "VMI", "", 0, 2, "KeydetsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Western Carolina", "", 0, 2, "WCCatamountsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Wofford", "", 0, 2, "WoffordBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Southland", "", 0, 2, "SouthlandBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Abilene Christian", "", 0, 2, "AbileneChristianBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Central Arkansas", "", 0, 2, "CentralArkBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Houston Baptist", "", 0, 2, "HoustonBaptistBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Incarnate Word", "", 0, 2, "IncarnateWordBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Lamar", "", 0, 2, "LamarBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "McNeese St", "", 0, 2, "McNeeseStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Orleans", "", 0, 2, "NewOrleansBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Nicholls St", "", 0, 2, "NichollsStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Northwestern St", "", 0, 2, "NWStateBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Sam Houston St", "", 0, 2, "SamHoustonStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Southeastern Louisiana", "", 0, 2, "SELouisianaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Stephen F. Austin", "", 0, 2, "SFALumberjacksBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas A&M-CC", "", 0, 2, "TexasAMCCIslandersBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "SWAC", "", 0, 2, "SWACBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Alabama A&M", "", 0, 2, "AlabamaAMBulldogBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Alabama St", "", 0, 2, "AlabamaStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Alcorn St", "", 0, 2, "AlcornStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arkansas-Pines Bluff", "", 0, 2, "ArkPinesBluffBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Grambling St", "", 0, 2, "GramblingStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Jackson St", "", 0, 2, "JacksonStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Mississippi Valley St", "", 0, 2, "DeltaDevilsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Prairie View A&M", "", 0, 2, "PrairieViewAMPanthersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Southern University", "", 0, 2, "SouthernBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas Southern", "", 0, 2, "TexasSouthernBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Summit League", "", 0, 2, "SummitLeagueBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Denver", "", 0, 2, "DenverBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "IUPU-Fort Wayne", "", 0, 2, "MastadonsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "IUPU-Indianapolis", "", 0, 2, "IUPUIndianapolisBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Nebraska-Omaha", "", 0, 2, "NebraskaOmahaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "North Dakota St", "", 0, 2, "NDSUBisonBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Oral Roberts", "", 0, 2, "OralRoberts");
	$subID = AppForumAdmin::createForum(0, $forumID, "South Dakota", "", 0, 2, "SDCoyotesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "South Dakota St", "", 0, 2, "JackrabbitsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Western Illinois", "", 0, 2, "LeathernecksBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "Sun Belt", "", 0, 2, "SunBeltBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "App State", "", 0, 2, "AppStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Arkansas St", "", 0, 2, "ArkStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Georgia Southern", "", 0, 2, "GASouthernBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Georgia St", "", 0, 2, "GAStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Idaho", "", 0, 2, "IdahoBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "LA-Lafayette", "", 0, 2, "RaginCajunsBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "LA-Monroe", "", 0, 2, "WarhawksBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Mexico St", "", 0, 2, "NMStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "South Alabama", "", 0, 2, "SouthAlabamaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas St", "", 0, 2, "TexasStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Troy", "", 0, 2, "TroyBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "West Coast", "", 0, 2, "WestCoastBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "BYU", "", 0, 2, "BYUCougarBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Gonzaga", "", 0, 2, "GonzagaBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Loyola Marymount", "", 0, 2, "LoyolaMarymountBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Pacific", "", 0, 2, "PacificBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Pepperdine", "", 0, 2, "PepperdineBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Portland", "", 0, 2, "PortlandBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "St. Mary's", "", 0, 2, "StMarysBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Diego", "", 0, 2, "SanDiegoBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "San Francisco", "", 0, 2, "SanFranciscoBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Santa Clara", "", 0, 2, "SantaClaraBB");
	
$forumID = AppForumAdmin::createForum($catID, 0, "WAC", "", 0, 2, "WACBasketball");
	$subID = AppForumAdmin::createForum(0, $forumID, "Cal State Bakersfield", "", 0, 2, "CSBRoadrunnersBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Chicago St", "", 0, 2, "ChicagoStBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Grand Canyon", "", 0, 2, "AntelopesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "New Mexico Aggies", "", 0, 2, "NMStAggiesBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Seattle", "", 0, 2, "SeattleBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Texas-Pan American", "", 0, 2, "TexasPanAmBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "UMKC", "", 0, 2, "KangaroosBB");
	$subID = AppForumAdmin::createForum(0, $forumID, "Utah Valley", "", 0, 2, "UtahValleyBB");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss any off-topic things here.", 0, 2, "NCAAMLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the NCAAM community.", 0, 2, "NCAAMIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about the NCAAM or the forums.", 0, 2, "NCAAMInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

