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
$catID = AppForumAdmin::createCategory("Sciences");

$forumID = AppForumAdmin::createForum($catID, 0, "Astronomy", "The study of celestial objects.", 0, 2, "Astronomy");
$forumID = AppForumAdmin::createForum($catID, 0, "Biology", "The study of life and living organisms.", 0, 2, "Biology");
$forumID = AppForumAdmin::createForum($catID, 0, "Chemistry", "The study of composition, structure, properties, and change of matter.", 0, 2, "Chemistry");
$forumID = AppForumAdmin::createForum($catID, 0, "Computer Science", "The scientific approach to computation.", 0, 2, "ComputerScience");
$forumID = AppForumAdmin::createForum($catID, 0, "Earth Science", "The fields of science dealing with the planet Earth.", 0, 2, "EarthScience");
$forumID = AppForumAdmin::createForum($catID, 0, "Engineering", "The application of several scientific fields.", 0, 2, "Engineering");
$forumID = AppForumAdmin::createForum($catID, 0, "Mathematics", "The study of numbers, quantity, algorithms, etc.", 0, 2, "Mathematics");
$forumID = AppForumAdmin::createForum($catID, 0, "Medical Science", "The science of diagnosis, treatment, and prevention of disease.", 0, 2, "MedicalScience");
$forumID = AppForumAdmin::createForum($catID, 0, "Parapsychology", "The study of psychic phenomena.", 0, 2, "Parapsychology");
$forumID = AppForumAdmin::createForum($catID, 0, "Physics", "The study of matter and it's motion through space and time.", 0, 2, "Physics");

// Social Sciences
$catID = AppForumAdmin::createCategory("Social Sciences");

$forumID = AppForumAdmin::createForum($catID, 0, "Business and Economics", "The studies of business, the economy, and their activities.", 0, 2, "Economics");
$forumID = AppForumAdmin::createForum($catID, 0, "Law, Criminology, and Forensic Science", "The studies of law and crime, for individuals and as a society.", 0, 2, "Criminology");
$forumID = AppForumAdmin::createForum($catID, 0, "Geography", "The study of the lands, features, inhabitants, and phenomena of Earth.", 0, 2, "Geography");
$forumID = AppForumAdmin::createForum($catID, 0, "History", "The study of the past and its effects on humanity.", 0, 2, "History");
$forumID = AppForumAdmin::createForum($catID, 0, "Philosophy", "The study of general and fundamental problems.", 0, 2, "Philosophy");
$forumID = AppForumAdmin::createForum($catID, 0, "Political Science", "The study of the state, nation, government, and politics and policies of government.", 0, 2, "PoliticalScience");
$forumID = AppForumAdmin::createForum($catID, 0, "Psychology", "The study of mental functions and behaviors.", 0, 2, "Psychology");
$forumID = AppForumAdmin::createForum($catID, 0, "Study of Religion", "Relating to the scientific study of religion.", 0, 2, "ReligionStudies");
$forumID = AppForumAdmin::createForum($catID, 0, "Sociology", "The study of social behavior, its origins, development, organization, and institutions.", 0, 2, "Sociology");

// The Mad Scientist Workshop
$catID = AppForumAdmin::createCategory("The Mad Scientist Workshop");

$forumID = AppForumAdmin::createForum($catID, 0, "Science News", "The latest news and updates for the science community.", 0, 2, "ScienceNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Beginner Lounge", "Have simple questions or are new to the scientific community? Start here!", 0, 2, "ScienceBeginner");
$forumID = AppForumAdmin::createForum($catID, 0, "Personal Theories", "Discuss personal hypotheses.", 0, 2, "ScienceTheories");
$forumID = AppForumAdmin::createForum($catID, 0, "Pseudoscience", "Topics regarding theories or sciences that aren't accepted by the scientific community.", 0, 2, "Pseudoscience");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "ScienceLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the science community.", 0, 2, "ScienceIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about science or the forums.", 0, 2, "ScienceInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

