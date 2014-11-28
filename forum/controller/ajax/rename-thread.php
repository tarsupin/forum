<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// The user must be logged in
if(!Me::$loggedIn)
{
	exit;
}

// Check if the thread is posted
if(!isset($_POST['forumID']) or !isset($_POST['threadID']))
{
	exit;
}

$_POST['forumID'] = (int) $_POST['forumID'];
$_POST['threadID'] = (int) $_POST['threadID'];

// Get Thread
$thread = AppThread::get($_POST['forumID'], $_POST['threadID']);

// Check permission
if(Me::$clearance < 6 && $thread['author_id'] != Me::$id)
{
	exit;
}

$_POST['title'] = Sanitize::safeword($_POST['title'], "'/\"!?@#$%^&*()[]+={}");

if(