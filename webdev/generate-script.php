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

// Web Development Workshop
$catID = AppForumAdmin::createCategory(0, "Web Development Workshop");

$forumID = AppForumAdmin::createForum($catID, "Beginner's Lounge", "New to web development? Get familiarized with the basics here.", 0, 2, "WebDevBeginner");
$forumID = AppForumAdmin::createForum($catID, "Frameworks and Libraries", "Learn about good frameworks and libraries to use for web development.", 0, 2, "WebLibraries");
$forumID = AppForumAdmin::createForum($catID, "Tools and Resources", "Discuss your favorite resources, the advantages of certain tools, etc.", 0, 2, "WebDevResources");
$forumID = AppForumAdmin::createForum($catID, "Multimedia", "Discuss anything related to multimedia on the web.", 0, 2, "WebDevMultimedia");

// Web Languages
$catID = AppForumAdmin::createCategory(0, "Web Languages");

$forumID = AppForumAdmin::createForum($catID, "HTML", "Discuss the most fundamental web language.", 0, 2, "HTML");
$forumID = AppForumAdmin::createForum($catID, "CSS", "Exchange tips and news on Cascading Style Sheets.", 0, 2, "CSS");
$forumID = AppForumAdmin::createForum($catID, "JavaScript", "News, tips, and discussion on the most popular scripting language.", 0, 2, "JavaScript");
$forumID = AppForumAdmin::createForum($catID, "PHP", "Discuss PHP, the most popular server-side language.", 0, 2, "PHPLang");
$forumID = AppForumAdmin::createForum($catID, "Hack", "Discuss the Hack language.", 0, 2, "HackLang");
$forumID = AppForumAdmin::createForum($catID, "ASP", "Discuss the ASP language.", 0, 2, "ASPLang");
$forumID = AppForumAdmin::createForum($catID, "SQL", "Discuss the structured query language.", 0, 2, "SQLLang");
$forumID = AppForumAdmin::createForum($catID, "Ruby", "Discuss the Ruby language.", 0, 2, "RubyLang");
$forumID = AppForumAdmin::createForum($catID, "Python", "Discuss the Python language.", 0, 2, "PythonLang");
$forumID = AppForumAdmin::createForum($catID, "Other Languages", "Discuss all other web languages that aren't listed above.", 0, 2, "WebDevLanguages");

// Web Concepts
$catID = AppForumAdmin::createCategory(0, "Web Concepts");

$forumID = AppForumAdmin::createForum($catID, "Responsive Design", "Discuss responsive design techniques and tips.", 0, 2, "ResponsiveDesign");
$forumID = AppForumAdmin::createForum($catID, "APIs", "Discuss useful APIs such as payment processing, geo-location, etc.", 0, 2, "APIDev");
$forumID = AppForumAdmin::createForum($catID, "User Experience", "Discuss user experience tips, techniques, etc.", 0, 2, "UserExperience");
$forumID = AppForumAdmin::createForum($catID, "Security and Encryption", "Discuss important security techniques, tips, and news.", 0, 2, "WebDevSecurity");
$forumID = AppForumAdmin::createForum($catID, "System Administration", "System administration techniques, tips, and discussion.", 0, 2, "SystemAdmin");
$forumID = AppForumAdmin::createForum($catID, "SEO", "Search Engine Optimization techniques, tips, and discussion.", 0, 2, "SEO");
$forumID = AppForumAdmin::createForum($catID, "Domains and DNS", "Discuss working with domains and DNS.", 0, 2, "WebDevDNS");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Web Development News", "The latest news and updates for the web development community.", 0, 2, "WebDevNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the web development community.", 0, 2, "WebDevIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "WebDevLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

