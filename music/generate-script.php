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
$forumID = AppForumAdmin::createForum($catID, 0, "Music News", "The latest news and updates for the music community.", 0, 2, "MusicNews");
$forumID = AppForumAdmin::createForum($catID, 0, "General Music", "Discuss anything related to music that doesn't belong elsewhere.", 0, 2, "Music");
$forumID = AppForumAdmin::createForum($catID, 0, "Top 10+ Lists", "Post your top ten favorite songs of all time.", 0, 2, "MusicLists");
$forumID = AppForumAdmin::createForum($catID, 0, "Just Listened", "Tell us what you just listened to and what you thought.", 0, 2, "MusicReviews");
$forumID = AppForumAdmin::createForum($catID, 0, "Music Games", "Create or participate in music-related forum games.", 0, 2, "MusicGames");

// Music Central
$catID = AppForumAdmin::createCategory("Music Central");

$forumID = AppForumAdmin::createForum($catID, 0, "Rock", "Classic rock, alternative rock, progressive rock, etc.", 0, 2, "RockMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Rap and Hip-Hop", "Topics related to rap, hip-hop, R&B, etc.", 0, 2, "RapMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Pop", "Discuss pop music.", 0, 2, "PopMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Reggae and Ska", "Topics relating to the reggae and ska genres.", 0, 2, "ReggaeMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Punk", "Discuss punk rock music.", 0, 2, "PunkMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Classical", "Discuss topics related to classical music.", 0, 2, "ClassicalMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Indie Music", "Discuss music, songs, and bands that fall into mainstream categories.", 0, 2, "IndieMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Electronica", "Discuss all electronica genres - Techno, Trance, etc.", 0, 2, "ElectronicaMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Country", "Country, altnerative country, country rock, etc.", 0, 2, "CountryMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Soul and Funk", "Discuss funk and soul music.", 0, 2, "SoulMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Christian", "All topics relating to Christian music.", 0, 2, "ChristianMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Holiday Music", "Discuss any holiday music here.", 0, 2, "HolidayMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Metal", "Metal, power metal, heavy metal, etc.", 0, 2, "MetalMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Soundtracks and Musicals", "All topics relating to soundtracks and musicals.", 0, 2, "SoundtrackMusic");

// The Studio
$catID = AppForumAdmin::createCategory("The Studio");

$forumID = AppForumAdmin::createForum($catID, 0, "Showcase", "Show off your music and get feedback.", 0, 2, "ShowcaseMusic");
$forumID = AppForumAdmin::createForum($catID, 0, "Song Writing", "Post lyrics you've written to get feedback.", 0, 2, "SongWriting");
$forumID = AppForumAdmin::createForum($catID, 0, "Production", "Questions and discussion about producing music.", 0, 2, "MusicProduction");
$forumID = AppForumAdmin::createForum($catID, 0, "Equipment", "Share tips or discuss the equipment you use to produce music.", 0, 2, "MusicEquipment");
$forumID = AppForumAdmin::createForum($catID, 0, "Collaboration", "Find others to collaborate on, or share tips on collaboration.", 0, 2, "MusicCollaboration");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "MusicLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the music community.", 0, 2, "MusicIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about music or the forums.", 0, 2, "MusicInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

