<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// The user must be logged in
if(!Me::$loggedIn)
{
	exit;
}

// Check if the thread is posted
if(!isset($_POST['forumID']) or !isset($_POST['threadID']) or !isset($_POST['postID']))
{
	exit;
}

// Get the current thread
if(!$thread = AppThread::get((int) $_POST['forumID'], (int) $_POST['threadID']))
{
	exit;
}

// Get Forum Details
$forum = Database::selectOne("SELECT perm_read, perm_post FROM forums WHERE id=? LIMIT 1", array((int) $thread['forum_id']));

// Make sure you have permission to post
if(Me::$clearance < (int) $forum['perm_post'] || Me::$clearance < (int) $forum['perm_read'])
{
	exit;
}

// Get post content
$post = array();

if(!$post = Database::selectOne("SELECT p.body, u.handle FROM posts p INNER JOIN users u ON u.uni_id=p.uni_id WHERE p.thread_id=? AND p.id=? LIMIT 1", array((int) $thread['id'], (int) $_POST['postID'])))
{
	exit;
}

// Sanitize the message
echo '[quote=' . $post['handle'] . ']' . Security::purify($post['body']) . '[/quote]';