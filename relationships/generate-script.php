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

// Platonic Relationships
$catID = AppForumAdmin::createCategory(0, "Platonic Relationships");

$forumID = AppForumAdmin::createForum($catID, "Social Skills", "Advice, knowledge, and discussion about social skills.", 0, 2, "SocialSkills");
$forumID = AppForumAdmin::createForum($catID, "Friendships", "Anything related to friendships, including advice, hardships, etc.", 0, 2, "Friendships");
$forumID = AppForumAdmin::createForum($catID, "Healing", "Discussion on healing and recovering from loss and grief.", 0, 2, "RelationshipHealing");

// Dating
$catID = AppForumAdmin::createCategory(0, "Dating");

$forumID = AppForumAdmin::createForum($catID, "Dating", "Dating advice, questions, and discussion.", 0, 2, "Dating");
$forumID = AppForumAdmin::createForum($catID, "Flirting", "Advice and tips on flirting with others.", 0, 2, "Flirting");
$forumID = AppForumAdmin::createForum($catID, "Fashion Advice", "Advice on fashion for courting and dating.", 0, 2, "DatingFashion");
$forumID = AppForumAdmin::createForum($catID, "Dating Ideas", "Need ideas for a great first date? Post your thoughts here.", 0, 2, "DatingIdeas");
$forumID = AppForumAdmin::createForum($catID, "Long-Distance Relationships", "Anything relating to long distance relationships.", 0, 2, "DistanceDating");

// Relationship Corner
$catID = AppForumAdmin::createCategory(0, "Relationship Center");

$forumID = AppForumAdmin::createForum($catID, "Romantic Love", "Discussions on finding and strengthening romantic love.", 0, 2, "RomanticLove");
$forumID = AppForumAdmin::createForum($catID, "Sex and Romance", "For advice and discussion. All posts must be clean and respectful.", 0, 2, "SexAndRomance");
$forumID = AppForumAdmin::createForum($catID, "Marriage", "For advice and discussion on marriage and engagements.", 0, 2, "Marriage");
$forumID = AppForumAdmin::createForum($catID, "Parenting", "Discuss parenting tips and advice.", 0, 2, "Parenting");
$forumID = AppForumAdmin::createForum($catID, "Breaking Up and Divorce", "Discussion and advice on break-ups and divorce.", 0, 2, "BreakingUp");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Relationship News", "The latest news and updates for the relationship community.", 0, 2, "RelationshipNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the relationship community.", 0, 2, "RelationshipIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "RelationshipLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

