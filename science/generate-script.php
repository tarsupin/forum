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

// Sciences
$catID = AppForumAdmin::createCategory(0, "Sciences");

$forumID = AppForumAdmin::createForum($catID, "Astronomy", "The study of celestial objects.", 0, 2, "Astronomy");
$forumID = AppForumAdmin::createForum($catID, "Biology", "The study of life and living organisms.", 0, 2, "Biology");
$forumID = AppForumAdmin::createForum($catID, "Chemistry", "The study of composition, structure, properties, and change of matter.", 0, 2, "Chemistry");
$forumID = AppForumAdmin::createForum($catID, "Computer Science", "The scientific approach to computation.", 0, 2, "ComputerScience");
$forumID = AppForumAdmin::createForum($catID, "Earth Science", "The fields of science dealing with the planet Earth.", 0, 2, "EarthScience");
$forumID = AppForumAdmin::createForum($catID, "Engineering", "The application of several scientific fields.", 0, 2, "Engineering");
$forumID = AppForumAdmin::createForum($catID, "Mathematics", "The study of numbers, quantity, algorithms, etc.", 0, 2, "Mathematics");
$forumID = AppForumAdmin::createForum($catID, "Medical Science", "The science of diagnosis, treatment, and prevention of disease.", 0, 2, "MedicalScience");
$forumID = AppForumAdmin::createForum($catID, "Parapsychology", "The study of psychic phenomena.", 0, 2, "Parapsychology");
$forumID = AppForumAdmin::createForum($catID, "Physics", "The study of matter and it's motion through space and time.", 0, 2, "Physics");

// Social Sciences
$catID = AppForumAdmin::createCategory(0, "Social Sciences");

$forumID = AppForumAdmin::createForum($catID, "Business and Economics", "The studies of business, the economy, and their activities.", 0, 2, "Economics");
$forumID = AppForumAdmin::createForum($catID, "Law, Criminology, and Forensic Science", "The studies of law and crime, for individuals and as a society.", 0, 2, "Criminology");
$forumID = AppForumAdmin::createForum($catID, "Geography", "The study of the lands, features, inhabitants, and phenomena of Earth.", 0, 2, "Geography");
$forumID = AppForumAdmin::createForum($catID, "History", "The study of the past and its effects on humanity.", 0, 2, "History");
$forumID = AppForumAdmin::createForum($catID, "Philosophy", "The study of general and fundamental problems.", 0, 2, "Philosophy");
$forumID = AppForumAdmin::createForum($catID, "Political Science", "The study of the state, nation, government, and politics and policies of government.", 0, 2, "PoliticalScience");
$forumID = AppForumAdmin::createForum($catID, "Psychology", "The study of mental functions and behaviors.", 0, 2, "Psychology");
$forumID = AppForumAdmin::createForum($catID, "Study of Religion", "Relating to the scientific study of religion.", 0, 2, "ReligionStudies");
$forumID = AppForumAdmin::createForum($catID, "Sociology", "The study of social behavior, its origins, development, organization, and institutions.", 0, 2, "Sociology");

// The Mad Scientist Workshop
$catID = AppForumAdmin::createCategory(0, "The Mad Scientist Workshop");

$forumID = AppForumAdmin::createForum($catID, "Beginner Lounge", "Have simple questions or are new to the scientific community? Start here!", 0, 2, "ScienceBeginner");
$forumID = AppForumAdmin::createForum($catID, "Personal Theories", "Discuss personal hypotheses.", 0, 2, "ScienceTheories");
$forumID = AppForumAdmin::createForum($catID, "Pseudoscience", "Topics regarding theories or sciences that aren't accepted by the scientific community.", 0, 2, "Pseudoscience");

// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Science News", "The latest news and updates for the science community.", 0, 2, "ScienceNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the science community.", 0, 2, "ScienceIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "ScienceLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

