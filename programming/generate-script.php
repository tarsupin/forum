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

// Programming Workshop
$catID = AppForumAdmin::createCategory("Programming Workshop");

$forumID = AppForumAdmin::createForum($catID, 0, "Programming News", "The latest news and updates for the programming community.", 0, 2, "DevNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Beginner's Lounge", "New to programming? Get familiarized with the basics here.", 0, 2, "DevBeginner");
$forumID = AppForumAdmin::createForum($catID, 0, "Engines and Libraries", "Learn about good engines and libraries to use for development.", 0, 2, "DevLibraries");
$forumID = AppForumAdmin::createForum($catID, 0, "Tools and Resources", "Discuss your favorite resources, the advantages of certain tools, etc.", 0, 2, "DevResources");
$forumID = AppForumAdmin::createForum($catID, 0, "Windows Development", "Discuss development for windows.", 0, 2, "WindowsDev");
$forumID = AppForumAdmin::createForum($catID, 0, "Mac Development", "Discuss development for macs.", 0, 2, "MacDev");
$forumID = AppForumAdmin::createForum($catID, 0, "Linux Development", "Discuss linux development.", 0, 2, "LinuxDev");
$forumID = AppForumAdmin::createForum($catID, 0, "Console Development", "Discuss console development.", 0, 2, "ConsoleDev");
$forumID = AppForumAdmin::createForum($catID, 0, "Mobile Development", "Discuss mobile development.", 0, 2, "MobileDev");

// Advanced Concepts
$catID = AppForumAdmin::createCategory("Advanced Concepts");

$forumID = AppForumAdmin::createForum($catID, 0, "APIs", "Discuss useful APIs such as payment processing, geo-location, etc.", 0, 2, "APIDev");
$forumID = AppForumAdmin::createForum($catID, 0, "Graphics", "Discuss graphics programming, tutorials, and relevant news.", 0, 2, "GraphicsDev");
$forumID = AppForumAdmin::createForum($catID, 0, "Networking", "Learn the techniques for proper networking.", 0, 2, "NetworkingDev");
$forumID = AppForumAdmin::createForum($catID, 0, "Security and Encryption", "Discuss important security tips, updates, and news.", 0, 2, "SecurityDev");

// Programming Languages
$catID = AppForumAdmin::createCategory("Programming Languages");

$forumID = AppForumAdmin::createForum($catID, 0, "Java", "News, concepts, tutorials, and techniques with the Java language.", 0, 2, "JavaLang");
$forumID = AppForumAdmin::createForum($catID, 0, "C and C++", "Everything about the C and C++ languages.", 0, 2, "CLang");
$forumID = AppForumAdmin::createForum($catID, 0, "C#", "Find your news, answers, and various topics with the C# language.", 0, 2, "CSharpLang");
$forumID = AppForumAdmin::createForum($catID, 0, "Python", "Discuss the Python language.", 0, 2, "PythonLang");
$forumID = AppForumAdmin::createForum($catID, 0, "Ruby", "Discuss the ruby language, news, tutorials, etc.", 0, 2, "RubyLang");
$forumID = AppForumAdmin::createForum($catID, 0, "SQL", "Discuss the SQL language, learn new techniques, ask questions, etc.", 0, 2, "SQLLang");
$forumID = AppForumAdmin::createForum($catID, 0, "Other Languages", "Perl, Lua, VB, Go, D, and all the other languages.", 0, 2, "DevLanguages");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "DevLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the programming community.", 0, 2, "DevIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about programming or the forums.", 0, 2, "DevInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

