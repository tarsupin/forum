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

// Gadgets and Hardware
$catID = AppForumAdmin::createCategory("Gadgets and Hardware");

$forumID = AppForumAdmin::createForum($catID, 0, "Laptops", "Learn the newest ongoings with laptops.", 0, 2, "TechLaptops");
$forumID = AppForumAdmin::createForum($catID, 0, "Tablets", "Tips, news, reviews, and discussion on tablets.", 0, 2, "TechTablets");
$forumID = AppForumAdmin::createForum($catID, 0, "Desktops", "Have high-performance requirements? Get news and tips on desktops.", 0, 2, "TechDesktops");
$forumID = AppForumAdmin::createForum($catID, 0, "Phones and Mobile Devices", "Get the latest news and discussion on mobile devices.", 0, 2, "TechMobile");
$forumID = AppForumAdmin::createForum($catID, 0, "Peripherals", "Get news on monitors, printers, external drives, and other peripherals.", 0, 2, "TechPeripherals");
$forumID = AppForumAdmin::createForum($catID, 0, "Other Electronics", "All electronics that don't fit elsewhere are discussed here.", 0, 2, "TechElectronics");

// Software
$catID = AppForumAdmin::createCategory("Software");

$forumID = AppForumAdmin::createForum($catID, 0, "Viruses and Malware", "Discuss and find solutions to viruses and malware infections.", 0, 2, "Malware");
$forumID = AppForumAdmin::createForum($catID, 0, "Open Source", "Discuss open source projects and software of interest.", 0, 2, "OpenSource");
$forumID = AppForumAdmin::createForum($catID, 0, "Security", "Tips and important news on system security.", 0, 2, "TechSecurity");
$forumID = AppForumAdmin::createForum($catID, 0, "Mac Software", "News and discussion on software for Apple systems and devices.", 0, 2, "AppleSoftware");
$forumID = AppForumAdmin::createForum($catID, 0, "Windows Software", "News and discussion on software for Microsoft systems and devices.", 0, 2, "MicrosoftSoftware");
$forumID = AppForumAdmin::createForum($catID, 0, "Linux Software", "News and discussion on software for Linux.", 0, 2, "LinuxSoftware");

// Troubleshooting
$catID = AppForumAdmin::createCategory("The Technology Corner");
$forumID = AppForumAdmin::createForum($catID, 0, "Tech News", "The latest news and updates for the tech community.", 0, 2, "TechNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Hardware Troubleshooting", "Having hardware issues? Find assistance or lend help to others in need.", 0, 2, "TroubleshootHardware");
$forumID = AppForumAdmin::createForum($catID, 0, "System Upgrades and Modding", "Looking to upgrade your system? Here's the right place for you..", 0, 2, "TechModding");
$forumID = AppForumAdmin::createForum($catID, 0, "Tech Careers", "Discuss jobs, resume building, and careers in technology.", 0, 2, "TechCareers");
$forumID = AppForumAdmin::createForum($catID, 0, "Tech Support Stories", "Share your stories on tech support, or hear others.", 0, 2, "TechSupportStory");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "TechLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the tech community.", 0, 2, "TechIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about tech or the forums.", 0, 2, "TechInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

