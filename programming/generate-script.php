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
$catID = AppForumAdmin::createCategory(0, "Programming Workshop");

$forumID = AppForumAdmin::createForum($catID, "Beginner's Lounge", "New to programming? Get familiarized with the basics here.", 0, 2, "DevBeginner");
$forumID = AppForumAdmin::createForum($catID, "Engines and Libraries", "Learn about good engines and libraries to use for development.", 0, 2, "DevLibraries");
$forumID = AppForumAdmin::createForum($catID, "Tools and Resources", "Discuss your favorite resources, the advantages of certain tools, etc.", 0, 2, "DevResources");
$forumID = AppForumAdmin::createForum($catID, "Windows Development", "Discuss development for windows.", 0, 2, "WindowsDev");
$forumID = AppForumAdmin::createForum($catID, "Mac Development", "Discuss development for macs.", 0, 2, "MacDev");
$forumID = AppForumAdmin::createForum($catID, "Linux Development", "Discuss linux development.", 0, 2, "LinuxDev");
$forumID = AppForumAdmin::createForum($catID, "Console Development", "Discuss console development.", 0, 2, "ConsoleDev");
$forumID = AppForumAdmin::createForum($catID, "Mobile Development", "Discuss mobile development.", 0, 2, "MobileDev");

// Advanced Concepts
$catID = AppForumAdmin::createCategory(0, "Advanced Concepts");

$forumID = AppForumAdmin::createForum($catID, "APIs", "Discuss useful APIs such as payment processing, geo-location, etc.", 0, 2, "APIDev");
$forumID = AppForumAdmin::createForum($catID, "Graphics", "Discuss graphics programming, tutorials, and relevant news.", 0, 2, "GraphicsDev");
$forumID = AppForumAdmin::createForum($catID, "Networking", "Learn the techniques for proper networking.", 0, 2, "NetworkingDev");
$forumID = AppForumAdmin::createForum($catID, "Security and Encryption", "Discuss important security tips, updates, and news.", 0, 2, "SecurityDev");

// Programming Languages
$catID = AppForumAdmin::createCategory(0, "Programming Languages");

$forumID = AppForumAdmin::createForum($catID, "Java", "News, concepts, tutorials, and techniques with the Java language.", 0, 2, "JavaLang");
$forumID = AppForumAdmin::createForum($catID, "C and C++", "Everything about the C and C++ languages.", 0, 2, "CLang");
$forumID = AppForumAdmin::createForum($catID, "C#", "Find your news, answers, and various topics with the C# language.", 0, 2, "CSharpLang");
$forumID = AppForumAdmin::createForum($catID, "Python", "Discuss the Python language.", 0, 2, "PythonLang");
$forumID = AppForumAdmin::createForum($catID, "Ruby", "Discuss the ruby language, news, tutorials, etc.", 0, 2, "RubyLang");
$forumID = AppForumAdmin::createForum($catID, "SQL", "Discuss the SQL language, learn new techniques, ask questions, etc.", 0, 2, "SQLLang");
$forumID = AppForumAdmin::createForum($catID, "Other Languages", "Perl, Lua, VB, Go, D, and all the other languages.", 0, 2, "DevLanguages");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Programming News", "The latest news and updates for the programming community.", 0, 2, "DevNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the programming community.", 0, 2, "DevIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "DevLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

