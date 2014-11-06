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

// Fitness Center
$catID = AppForumAdmin::createCategory("Fitness Center");

$forumID = AppForumAdmin::createForum($catID, 0, "Fitness News", "The latest news and updates for the fitness community.", 0, 2, "FitnessNews");
$forumID = AppForumAdmin::createForum($catID, 0, "Exercises", "Questions and discussions about exercises.", 0, 2, "Exercises");
$forumID = AppForumAdmin::createForum($catID, 0, "Weight Lifting", "Weight lifting, body building, power lifting, etc.", 0, 2, "WeightLifting");
$forumID = AppForumAdmin::createForum($catID, 0, "Workout Programs", "Topics about workout programs, goals, etc.", 0, 2, "WorkoutPrograms");
$forumID = AppForumAdmin::createForum($catID, 0, "Workout Equipment", "All topics relating to workout equipment.", 0, 2, "WorkoutEquipment");
$forumID = AppForumAdmin::createForum($catID, 0, "Cardio Training", "Questions and discussions about cardiovascular training.", 0, 2, "CardioTraining");
$forumID = AppForumAdmin::createForum($catID, 0, "Workout Journals", "Keep track of and monitor your workouts and progress.", 0, 2, "WorkoutJournals");

// Health Center
$catID = AppForumAdmin::createCategory("Health Center");

$forumID = AppForumAdmin::createForum($catID, 0, "Supplements", "Questions and discussions about supplements.", 0, 2, "FitnessSupplements");
$forumID = AppForumAdmin::createForum($catID, 0, "Nutrition and Diet", "Discuss proper nutrition and diets for your training needs.", 0, 2, "Nutrition");
$forumID = AppForumAdmin::createForum($catID, 0, "Weight Loss / Fat Loss", "Share tips, ask questions, and learn about losing weight.", 0, 2, "WeightLoss");

// Personalized Training
$catID = AppForumAdmin::createCategory("Personalized Training");

$forumID = AppForumAdmin::createForum($catID, 0, "Women's Training", "Training, nutrition, and fitness for Women.", 0, 2, "WomensFitness");
$forumID = AppForumAdmin::createForum($catID, 0, "Teen Training", "Training, nutrition, and fitness for Teens.", 0, 2, "TeenFitness");
$forumID = AppForumAdmin::createForum($catID, 0, "Over 40 Training", "Training, nutrition, and fitness for anyone over 40.", 0, 2, "Over40Fitness");
$forumID = AppForumAdmin::createForum($catID, 0, "Sports Training", "All topics related to sports training.", 0, 2, "SportTraining");
$forumID = AppForumAdmin::createForum($catID, 0, "Strength Training", "All topics related to strength training.", 0, 2, "StrengthTraining");

// The Lounge
$catID = AppForumAdmin::createCategory("The Lounge");

$forumID = AppForumAdmin::createForum($catID, 0, "General Discussion", "Discuss off-topic things here.", 0, 2, "FitnessLounge");
$forumID = AppForumAdmin::createForum($catID, 0, "Introductions", "Introduce yourself to the fitness community.", 0, 2, "FitnessIntro");
$forumID = AppForumAdmin::createForum($catID, 0, "Comments and Questions", "Questions and comments about fitness or the forums.", 0, 2, "FitnessInquiry");
$forumID = AppForumAdmin::createForum($catID, 0, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

