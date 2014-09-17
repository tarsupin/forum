<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); } /*

-------------------------------------
------ About the AppPost Class ------
-------------------------------------

This plugin provides handling for forum posts.

Note: You will probably notice that a lot of functions call the ID of their parents, not just the ID of the child.

For example, deleting a post requires $threadID and $postID, not just $postID. This is because the indexing for the system is based on the thread_id column, and partitioned. Therefore, it is MUCH faster to call the parent in these cases. Review the schemas to see how the database is structured.


-------------------------------
------ Methods Available ------
-------------------------------

$postID = AppPost::create($forumID, $threadID, $uniID, $body);

AppPost::edit($threadID, $postID, $uniID, $newMessage);

*/

abstract class AppPost {
	
	
/****** Create a new Post ******/
	public static function create
	(
		$forumID		// <int> The ID of the forum that the thread is in.
	,	$threadID		// <int> The ID of the thread you're posting in.
	,	$uniID	 		// <int> The uniID of the user creating the post.
	,	$body			// <str> The post message.
	)					// RETURNS <int> ID of the post that was created, or 0 on failure.
	
	// $postID = AppPost::create($forumID, $threadID, $uniID, "Here is the message that I'd like to post.");
	{
		Database::startTransaction();
		
		$postID = (int) UniqueID::get("post");
		$timestamp = time();
		
		// Insert the Post
		if(Database::query("INSERT INTO `posts` (id, thread_id, uni_id, body, date_post) VALUES (?, ?, ?, ?, ?)", array($postID, $threadID, $uniID, $body, $timestamp)))
		{
			// Update the Thread Details
			if(Database::query("UPDATE threads SET posts=posts+1, last_poster_id=?, date_last_post=? WHERE forum_id=? AND id=? LIMIT 1", array($uniID, $timestamp, $forumID, $threadID)))
			{
				// Update the Forum Details
				if(Database::query("UPDATE forums SET posts=posts+1, last_poster=?, last_thread_id=?, date_lastPost=? WHERE id=? LIMIT 1", array($uniID, $threadID, $timestamp, $forumID)))
				{
					Database::endTransaction();
					
					// Process the Comment
					Comment::process($uniID, $body, SITE_URL . "/thread?forum=" . $forumID . "&id=" . $threadID . "&pID=" . $postID);
					
					return $postID;
				}
			}
		}
		
		Database::endTransaction(false);
		return 0;
	}
	
	
/****** Edit a Post ******/
	public static function edit
	(
		$threadID		// <int> The ID of the thread the post is in.
	,	$postID			// <int> The ID of the post you're editing.
	,	$body			// <str> The new (edited) post message.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppPost::edit($threadID, $postID, "Hey everyone! Edit: Oh yeah, check out my blog!");
	{
		return Database::query("UPDATE posts SET body=? WHERE thread_id=? AND id=?", array($body, $threadID, $postID));
	}
	
}
