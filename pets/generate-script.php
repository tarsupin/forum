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

// The Pet Club
$catID = AppForumAdmin::createCategory("The Pet Club");

$forumID = AppForumAdmin::createForum($catID, 0, "Pet News", "The latest news and updates for the pet community.", 0, 2, "PetNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Pet Talk", "Discuss anything pet-related that fits nowhere else.", 0, 2, "Pets");
$forumID = AppForumAdmin::createForum($catID, 0, "Pet Stories", "Has your pet done something silly, unexpected, or cute? Tell us!", 0, 2, "PetStories");
$forumID = AppForumAdmin::createForum($catID, 0, "Pet Advice", "Share tips on the best advice on owning pets.", 0, 2, "PetAdvice");
$forumID = AppForumAdmin::createForum($catID, 0, "Pet Shows and Events", "Discuss pet shows and events.", 0, 2, "PetEvents");

// Dog Center
$catID = AppForumAdmin::createCategory("Dog Center");

$forumID = AppForumAdmin::createForum($catID, 0, "Dog Discussion", "Discuss anything related to dogs.", 0, 2, "Dogs");
$forumID = AppForumAdmin::createForum($catID, 0, "Dog Health and Nutrition", "Discuss proper dog wellness and nutritional needs.", 0, 2, "DogHealth");
$forumID = AppForumAdmin::createForum($catID, 0, "Dog Training and Behavior", "Discuss training and behaviors related to dogs.", 0, 2, "DogTraining");

// Cat Center
$catID = AppForumAdmin::createCategory("Cat Center");

$forumID = AppForumAdmin::createForum($catID, 0, "Cat Discussion", "Discuss anything related to cats.", 0, 2, "Cats");
$forumID = AppForumAdmin::createForum($catID, 0, "Cat Health and Nutrition", "Discuss proper cat wellness and nutritional needs.", 0, 2, "CatHealth");
$forumID = AppForumAdmin::createForum($catID, 0, "Cat Training and Behavior", "Discuss training and behaviors related to cats.", 0, 2, "CatTraining");

// All Pets
$catID = AppForumAdmin::createCategory("All Pets");

$forumID = AppForumAdmin::createForum($catID, 0, "Birds", "Chirp chirp? Post anything about birds here.", 0, 2, "Birds");
$forumID = AppForumAdmin::createForum($catID, 0, "Fish", "It feels like everyone has owned a fish at some point.", 0, 2, "Fish");
$forumID = AppForumAdmin::createForum($catID, 0, "Rodents", "Rats, hamsters, guinea pigs, and your cuddly small pets.", 0, 2, "Rodents");
$forumID = AppForumAdmin::createForum($catID, 0, "Horses", "Graceful, beautiful creatures that have helped mankind for millennia.", 0, 2, "Horses");
$forumID = AppForumAdmin::createForum($catID, 0, "Reptiles", "Snakes, turtles, lizards, and other reptiles.", 0, 2, "Reptiles");
$forumID = AppForumAdmin::createForum($catID, 0, "Amphibians", "Frogs, toads, salamanders, and other amphibians.", 0, 2, "Reptiles");
$forumID = AppForumAdmin::createForum($catID, 0, "Spiders and Insects", "The tiny creatures that make up the largest creature population.", 0, 2, "Insects");
$forumID = AppForumAdmin::createForum($catID, 0, "Other Pets", "All other pets that didn't get a category.", 0, 2, "Pets");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "PetLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the pet community.", 0, 2, "PetIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about pets or the forums.", 0, 2, "MovieInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

