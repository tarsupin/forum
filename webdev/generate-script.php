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
$catID = AppForumAdmin::createCategory("Web Development Workshop");

$forumID = AppForumAdmin::createForum($catID, 0, "Web Development News", "The latest news and updates for the web development community.", 0, 2, "WebDevNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Beginner's Lounge", "New to web development? Get familiarized with the basics here.", 0, 2, "WebDevBeginner");
$forumID = AppForumAdmin::createForum($catID, 0, "Frameworks and Libraries", "Learn about good frameworks and libraries to use for web development.", 0, 2, "WebLibraries");
$forumID = AppForumAdmin::createForum($catID, 0, "Tools and Resources", "Discuss your favorite resources, the advantages of certain tools, etc.", 0, 2, "WebDevResources");
$forumID = AppForumAdmin::createForum($catID, 0, "Multimedia", "Discuss anything related to multimedia on the web.", 0, 2, "WebDevMultimedia");

// Web Languages
$catID = AppForumAdmin::createCategory("Web Languages");

$forumID = AppForumAdmin::createForum($catID, 0, "HTML", "Discuss the most fundamental web language.", 0, 2, "HTML");
$forumID = AppForumAdmin::createForum($catID, 0, "CSS", "Exchange tips and news on Cascading Style Sheets.", 0, 2, "CSS");
$forumID = AppForumAdmin::createForum($catID, 0, "JavaScript", "News, tips, and discussion on the most popular scripting language.", 0, 2, "JavaScript");
$forumID = AppForumAdmin::createForum($catID, 0, "PHP", "Discuss PHP, the most popular server-side language.", 0, 2, "PHPLang");
$forumID = AppForumAdmin::createForum($catID, 0, "Hack", "Discuss the Hack language.", 0, 2, "HackLang");
$forumID = AppForumAdmin::createForum($catID, 0, "ASP", "Discuss the ASP language.", 0, 2, "ASPLang");
$forumID = AppForumAdmin::createForum($catID, 0, "SQL", "Discuss the structured query language.", 0, 2, "SQLLang");
$forumID = AppForumAdmin::createForum($catID, 0, "Ruby", "Discuss the Ruby language.", 0, 2, "RubyLang");
$forumID = AppForumAdmin::createForum($catID, 0, "Python", "Discuss the Python language.", 0, 2, "PythonLang");
$forumID = AppForumAdmin::createForum($catID, 0, "Other Languages", "Discuss all other web languages that aren't listed above.", 0, 2, "WebDevLanguages");

// Web Concepts
$catID = AppForumAdmin::createCategory("Web Concepts");

$forumID = AppForumAdmin::createForum($catID, 0, "Responsive Design", "Discuss responsive design techniques and tips.", 0, 2, "ResponsiveDesign");
$forumID = AppForumAdmin::createForum($catID, 0, "APIs", "Discuss useful APIs such as payment processing, geo-location, etc.", 0, 2, "APIDev");
$forumID = AppForumAdmin::createForum($catID, 0, "User Experience", "Discuss user experience tips, techniques, etc.", 0, 2, "UserExperience");
$forumID = AppForumAdmin::createForum($catID, 0, "Security and Encryption", "Discuss important security techniques, tips, and news.", 0, 2, "WebDevSecurity");
$forumID = AppForumAdmin::createForum($catID, 0, "System Administration", "System administration techniques, tips, and discussion.", 0, 2, "SystemAdmin");
$forumID = AppForumAdmin::createForum($catID, 0, "SEO", "Search Engine Optimization techniques, tips, and discussion.", 0, 2, "SEO");
$forumID = AppForumAdmin::createForum($catID, 0, "Domains and DNS", "Discuss working with domains and DNS.", 0, 2, "WebDevDNS");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "WebDevLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the web development community.", 0, 2, "WebDevIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about travel or the forums.", 0, 2, "WebDevInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

