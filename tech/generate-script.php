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
$catID = AppForumAdmin::createCategory(0, "Gadgets and Hardware");

$forumID = AppForumAdmin::createForum($catID, "Laptops", "Learn the newest ongoings with laptops.", 0, 2, "TechLaptops");
$forumID = AppForumAdmin::createForum($catID, "Tablets", "Tips, news, reviews, and discussion on tablets.", 0, 2, "TechTablets");
$forumID = AppForumAdmin::createForum($catID, "Desktops", "Have high-performance requirements? Get news and tips on desktops.", 0, 2, "TechDesktops");
$forumID = AppForumAdmin::createForum($catID, "Phones and Mobile Devices", "Get the latest news and discussion on mobile devices.", 0, 2, "TechMobile");
$forumID = AppForumAdmin::createForum($catID, "Peripherals", "Get news on monitors, printers, external drives, and other peripherals.", 0, 2, "TechPeripherals");
$forumID = AppForumAdmin::createForum($catID, "Other Electronics", "All electronics that don't fit elsewhere are discussed here.", 0, 2, "TechElectronics");

// Software
$catID = AppForumAdmin::createCategory(0, "Software");

$forumID = AppForumAdmin::createForum($catID, "Viruses and Malware", "Discuss and find solutions to viruses and malware infections.", 0, 2, "Malware");
$forumID = AppForumAdmin::createForum($catID, "Open Source", "Discuss open source projects and software of interest.", 0, 2, "OpenSource");
$forumID = AppForumAdmin::createForum($catID, "Security", "Tips and important news on system security.", 0, 2, "TechSecurity");
$forumID = AppForumAdmin::createForum($catID, "Mac Software", "News and discussion on software for Apple systems and devices.", 0, 2, "AppleSoftware");
$forumID = AppForumAdmin::createForum($catID, "Windows Software", "News and discussion on software for Microsoft systems and devices.", 0, 2, "MicrosoftSoftware");
$forumID = AppForumAdmin::createForum($catID, "Linux Software", "News and discussion on software for Linux.", 0, 2, "LinuxSoftware");

// Troubleshooting
$catID = AppForumAdmin::createCategory(0, "The Technology Corner");
$forumID = AppForumAdmin::createForum($catID, "Hardware Troubleshooting", "Having hardware issues? Find assistance or lend help to others in need.", 0, 2, "TroubleshootHardware");
$forumID = AppForumAdmin::createForum($catID, "System Upgrades and Modding", "Looking to upgrade your system? Here's the right place for you..", 0, 2, "TechModding");
$forumID = AppForumAdmin::createForum($catID, "Tech Careers", "Discuss jobs, resume building, and careers in technology.", 0, 2, "TechCareers");
$forumID = AppForumAdmin::createForum($catID, "Tech Support Stories", "Share your stories on tech support, or hear others.", 0, 2, "TechSupportStory");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Tech News", "The latest news and updates for the tech community.", 0, 2, "TechNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the tech community.", 0, 2, "TechIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "TechLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

