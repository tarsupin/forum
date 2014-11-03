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

// Food Community
$catID = AppForumAdmin::createCategory(0, "Food Community");

$forumID = AppForumAdmin::createForum($catID, "Beginner Cooks", "New to cooking? Need some advice to get started? Here's your place!", 0, 2, "FoodBeginner");
$forumID = AppForumAdmin::createForum($catID, "Cooking Techniques", "Any topics relating to cooking and techniques.", 0, 2, "CookingTechniques");
$forumID = AppForumAdmin::createForum($catID, "Nutrition and Health", "Everything about nutrition, supplements, and health.", 0, 2, "FoodNutrition");

// Diets
$catID = AppForumAdmin::createCategory(0, "Diets");

$forumID = AppForumAdmin::createForum($catID, "Gluten-Free", "All recipes and topics relating to the gluten free diet.", 0, 2, "GlutenFreeDiet");
$forumID = AppForumAdmin::createForum($catID, "Paleo", "All recipes and topics relating to the paleo diet.", 0, 2, "PaleoDiet");
$forumID = AppForumAdmin::createForum($catID, "Vegan", "All recipes and topics relating to the vegan diet.", 0, 2, "VeganDiet");
$forumID = AppForumAdmin::createForum($catID, "Vegetarian", "All recipes and topics relating to the vegetarian diet.", 0, 2, "VegetarianDiet");
$forumID = AppForumAdmin::createForum($catID, "Weight Watchers", "All recipes and topics relating to the weight watchers diet.", 0, 2, "WeightWatchersDiet");
$forumID = AppForumAdmin::createForum($catID, "Other Diets", "Atkins, pescetarian, and other diets go here.", 0, 2, "OtherDiets");

// Cuisine
$catID = AppForumAdmin::createCategory(0, "Cuisine");

$forumID = AppForumAdmin::createForum($catID, "American", "Recipes, cooking tips, and discussion on American cuisine.", 0, 2, "AmericanCuisine");
$forumID = AppForumAdmin::createForum($catID, "Chinese", "Recipes, cooking tips, and discussion on Chinese cuisine.", 0, 2, "ChineseCuisine");
$forumID = AppForumAdmin::createForum($catID, "French", "Recipes, cooking tips, and discussion on French cuisine.", 0, 2, "FrenchCuisine");
$forumID = AppForumAdmin::createForum($catID, "German", "Recipes, cooking tips, and discussion on German cuisine.", 0, 2, "GermanCuisine");
$forumID = AppForumAdmin::createForum($catID, "Indian", "Recipes, cooking tips, and discussion on Indian cuisine.", 0, 2, "IndianCuisine");
$forumID = AppForumAdmin::createForum($catID, "Italian", "Recipes, cooking tips, and discussion on Italian cuisine.", 0, 2, "ItalianCuisine");
$forumID = AppForumAdmin::createForum($catID, "Japanese", "Recipes, cooking tips, and discussion on Japanese cuisine.", 0, 2, "JapaneseCuisine");
$forumID = AppForumAdmin::createForum($catID, "Mexican", "Recipes, cooking tips, and discussion on Mexican cuisine.", 0, 2, "MexicanCuisine");
$forumID = AppForumAdmin::createForum($catID, "Other Cuisine", "Recipes, cooking tips, and discussion on all other cuisines.", 0, 2, "OtherCuisine");

// Recipes
$catID = AppForumAdmin::createCategory(0, "Recipes");

$forumID = AppForumAdmin::createForum($catID, "Appetizers", "All of your favorite pre-meal appetizers.", 0, 2, "Appetizers");
$forumID = AppForumAdmin::createForum($catID, "Baked Goods", "Cookies, cakes, brownies, and other baked goods.", 0, 2, "BakedGoods");
$forumID = AppForumAdmin::createForum($catID, "Beverages", "Smoothies, wine, coffee, and other beverages.", 0, 2, "Beverages");
$forumID = AppForumAdmin::createForum($catID, "Desserts and Snacks", "Your favorite snacks and desserts.", 0, 2, "Desserts");
$forumID = AppForumAdmin::createForum($catID, "Main Courses", "Your recipes for a main course.", 0, 2, "MainCourse");
$forumID = AppForumAdmin::createForum($catID, "Other Recipes", "Your other favorite recipes.", 0, 2, "Recipes");


// The Lounge
$catID = AppForumAdmin::createCategory(0, "The Lounge");

$forumID = AppForumAdmin::createForum($catID, "Food News", "The latest news and updates for the food community.", 0, 2, "FoodNews");
$forumID = AppForumAdmin::createForum($catID, "Introductions", "Introduce yourself to the food community.", 0, 2, "FoodIntro");
$forumID = AppForumAdmin::createForum($catID, "General Discussion", "Discuss off-topic things here.", 0, 2, "FoodLounge");
$forumID = AppForumAdmin::createForum($catID, "Staff Forum", "A place for the staff and moderators to post.", 6, 6);

