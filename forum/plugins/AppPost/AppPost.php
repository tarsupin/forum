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

$postID = AppPost::create($forum, $threadID, $uniID, $body);

AppPost::edit($threadID, $postID, $uniID, $newMessage);

*/

abstract class AppPost {
	
	
/****** Create a new Post ******/
	public static function create
	(
		$forum			// <str:mixed> The forum data.
	,	$threadID		// <int> The ID of the thread you're posting in.
	,	$uniID	 		// <int> The uniID of the user creating the post.
	,	$body			// <str> The post message.
	,	$aviID = 0		// <int> The avatar ID being used in this post.
	)					// RETURNS <int> ID of the post that was created, or 0 on failure.
	
	// $postID = AppPost::create($forum, $threadID, $uniID, $body, [$aviID]);
	{
		Database::startTransaction();
		
		$postID = (int) UniqueID::get("post");
		$timestamp = time();
		
		// Insert the Post
		if(Database::query("INSERT INTO `posts` (id, thread_id, uni_id, avi_id, body, date_post) VALUES (?, ?, ?, ?, ?, ?)", array($postID, $threadID, $uniID, $aviID, $body, $timestamp)))
		{
			// Update the Thread Details
			if(Database::query("UPDATE threads SET posts=posts+1, last_poster_id=?, date_last_post=? WHERE forum_id=? AND id=? LIMIT 1", array($uniID, $timestamp, $forum['id'], $threadID)))
			{
				// Update the Forum Details
				if(Database::query("UPDATE forums SET posts=posts+1, last_poster=?, last_thread_id=?, date_lastPost=? WHERE id=? LIMIT 1", array($uniID, $threadID, $timestamp, $forum['id'])))
				{
					$parentID = (int) $forum['parent_id'];
					
					while($parentID)
					{
						if(!$nextForum = Database::selectOne("SELECT id, parent_id FROM forums WHERE id=? LIMIT 1", array($parentID)))
						{
							break;
						}
						
						Database::query("UPDATE forums SET posts=posts+1, last_poster=?, last_thread_id=?, date_lastPost=? WHERE id=? LIMIT 1", array($uniID, $threadID, $timestamp, $nextForum['id']));
						
						$parentID = (int) $nextForum['parent_id'];
					}
					
					Database::endTransaction();
					
					// Process the Comment (for hashtags, etc)
					//Comment::process($uniID, $body, SITE_URL . "/thread?forum=" . $forum['id'] . "&id=" . $threadID . "&pID=" . $postID);
					
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
	
	
/****** Like a Post ******/
	public static function like
	(
		$threadID		// <int> The ID of the thread the post is in.
	,	$postID			// <int> The ID of the post you're liking.
	,	$uniID			// <int> The UniID that is liking the post.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppPost::like($threadID, $postID, $uniID);
	{
		// Make sure that you haven't already liked the post
		if($check = Database::selectValue("SELECT post_id FROM posts_likes WHERE post_id=? AND uni_id=? LIMIT 1", array($postID, $uniID)))
		{
			return false;
		}
		
		// Add the like to the post
		Database::startTransaction();
		
		if($pass = Database::query("UPDATE posts SET likes=likes+1 WHERE thread_id=? AND id=? LIMIT 1", array($threadID, $postID)))
		{
			$pass = Database::query("REPLACE INTO posts_likes (post_id, uni_id) VALUES (?, ?)", array($postID, $uniID));
		}
		
		return Database::endTransaction($pass);
	}
	
}
