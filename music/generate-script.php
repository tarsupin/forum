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


// General Discussion
$forumID = AppForumAdmin::createForum($catID, "General Music", "Discuss anything related to music that doesn't belong elsewhere.", 0, 2, "Music");
$forumID = AppForumAdmin::createForum($catID, "Top 10+ Lists", "Post your top ten favorite songs of all time.", 0, 2, "PopMusic");
$forumID = AppForumAdmin::createForum($catID, "Just Listened", "Tell us what you just listened to and what you thought.", 0, 2, "ReggaeMusic");
$forumID = AppForumAdmin::createForum($catID, "Music Games", "Create or participate in music-related forum games.", 0, 2, "Music");

// Music Central
$catID = AppForumAdmin::createCategory(0, "Music Central");

$forumID = AppForumAdmin::createForum($catID, "Rock", "Classic rock, alternative rock, progressive rock, etc.", 0, 2, "RockMusic");
$forumID = AppForumAdmin::createForum($catID, "Rap and Hip-Hop", "Topics related to rap, hip-hop, R&B, etc.", 0, 2, "RapMusic");
$forumID = AppForumAdmin::createForum($catID, "Pop", "Discuss pop music.", 0, 2, "PopMusic");
$forumID = AppForumAdmin::createForum($catID, "Reggae and Ska", "Topics relating to the reggae and ska genres.", 0, 2, "ReggaeMusic");
$forumID = AppForumAdmin::createForum($catID, "Punk", "Discuss punk rock music.", 0, 2, "PunkMusic");
$forumID = AppForumAdmin::createForum($catID, "Classical", "Discuss topics related to classical music.", 0, 2, "ClassicalMusic");
$forumID = AppForumAdmin::createForum($catID, "Indie Music", "Discuss music, songs, and bands that fall into mainstream categories.", 0, 2, "IndieMusic");
$forumID = AppForumAdmin::createForum($catID, "Electronica", "Discuss all electronica genres - Techno, Trance, etc.", 0, 2, "ElectronicaMusic");
$forumID = AppForumAdmin::createForum($catID, "Country", "Country, altnerative country, country rock, etc.", 0, 2, "CountryMusic");
$forumID = AppForumAdmin::createForum($catID, "Soul and Funk", "Discuss funk and soul music.", 0, 2, "SoulMusic");
$forumID = AppForumAdmin::createForum($catID, "Christian", "All topics relating to Christian music.", 0, 2, "ChristianMusic");
$forumID = AppForumAdmin::createForum($catID, "Holiday Music", "Discuss any holiday music here.", 0, 2, "HolidayMusic");
$forumID = AppForumAdmin::createForum($catID, "Metal", "Metal, power metal, heavy metal, etc.", 0, 2, "MetalMusic");
$forumID = AppForumAdmin::createForum($catID, "Soundtracks and Musicals", "All topics relating to soundtracks and musicals.", 0, 2, "SoundtrackMusic");

// The Studio
$catID = AppForumAdmin::createCategory(0, "The Studio");

$forumID = AppForumAdmin::createForum($catID, "Showcase", "Show off your music and get feedback.", 0, 2, "ShowcaseMusic");
$forumID = AppForumAdmin::createForum($catID, "Song Writing", "Post lyrics you've written to get feedback.", 0, 2, "SongWriting");
$forumID = AppForumAdmin::createForum($catID, "Production", "Questions and discussion about producing music.", 0, 2, "MusicProduction");
$forumID = AppForumAdmin::createForum($catID, "Equipment", "Share tips or discuss the equipment you use to produce music.", 0, 2, "MusicEquipment");
$forumID = AppForumAdmin::createForum($catID, "Collaboration", "Find others to collaborate on, or share tips on collaboration.", 0, 2, "MusicCollaboration");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Music News", "The latest news and updates for the music community.", 0, 2, "MusicNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the music community.", 0, 2, "MusicIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "MusicLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

