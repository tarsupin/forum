<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); } /*

--------------------------------------------
------ About the AppForumAdmin Plugin ------
--------------------------------------------

This plugin provides the ability to administer the forum, forum categories, threads, and posts.


-------------------------------
------ Methods Available ------
-------------------------------

$catID		= AppForumAdmin::createCategory($title);
$forumID	= AppForumAdmin::createForum($categoryID, $title, $desc, $readPerm, $postPerm);

AppForumAdmin::editForum($forumID, $categoryID, $parentID, $title, $desc, $readPerm, $postPerm);
AppForumAdmin::moveForum($forumID, $moveVal = 0, $categoryID = 0);
AppForumAdmin::moveThread($curForumID, $threadID, $newforumID);

AppForumAdmin::deleteForum($forumID);
AppForumAdmin::deleteThread($forumID, $threadID);
AppForumAdmin::deletePost($forumID, $threadID, $postID);

AppForumAdmin::lockThread($forumID, $threadID, $lockLevel = 5);
AppForumAdmin::alterSticky($forumID, $threadID, $sticky);

*/

abstract class AppForumAdmin {
	
	
/****** Create a new Forum Category ******/
	public static function createCategory
	(
		$title			// <str> The title of the forum.
	)					// RETURNS <int> ID of the category that was created, or 0 on failure.
	
	// $catID = AppForumAdmin::createCategory($title);
	{
		// Get the slot to add to the forum
		$slotOrder = 1;
		
		if($checkOther = Database::selectOne("SELECT cat_order FROM forum_categories ORDER BY cat_order DESC LIMIT 1", array()))
		{
			$slotOrder = (int) $checkOther['cat_order'] + 1;
		}
		
		// Run the query
		if(!Database::query("INSERT INTO `forum_categories` (cat_order, title) VALUES (?, ?)", array($slotOrder, $title)))
		{
			return 0;
		}
		
		return Database::$lastID;
	}
	
	
/****** Create a new Forum ******/
	public static function createForum
	(
		$categoryID			// <int> The ID of the category you're creating a forum in.
	,	$parentID			// <int> The ID of the forum that this forum is a sub-forum of.
	,	$title				// <str> The title of the forum.
	,	$description		// <str> The caption (description) of the forum.
	,	$readPerm			// <int> The clearance level required to read the forum.
	,	$postPerm			// <int> The clearance level required to post to the forum.
	,	$activeHashtag = ""	// <str> The active hashtag associated with the forum, if applicable.
	)						// RETURNS <int> ID of the forum that was created, or 0 on failure.
	
	// $forumID = AppForumAdmin::createForum($categoryID, $parentID, "Forum Title", "The forum caption / description", $readPerm, $postPerm, [$activeHashtag]);
	{
		// Prepare Values
		$activeHashtag = Sanitize::variable($activeHashtag);
		$slotOrder = 1;
				
		// Create the URL Slug for this post
		$urlSlug = Sanitize::variable(str_replace(" ", "-", strtolower($title)), "-");
		
		// Get the Slot Order
		if($checkOther = Database::selectOne("SELECT forum_order FROM forums WHERE category_id=? ORDER BY forum_order DESC LIMIT 1", array($categoryID)))
		{
			$slotOrder = (int) $checkOther['forum_order'] + 1;
		}
		
		// Run the query
		if(!Database::query("INSERT INTO `forums` (category_id, parent_id, forum_order, active_hashtag, url_slug, title, description, perm_read, perm_post) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", array(($parentID == 0 ? $categoryID : 0), $parentID, $slotOrder, $activeHashtag, $urlSlug, $title, $description, $readPerm, $postPerm)))
		{
			return 0;
		}
		
		$lastID = (int) Database::$lastID;
		
		// Parent has children
		Database::query("UPDATE forums SET has_children=? WHERE id=? LIMIT 1", array(1, $parentID));
		
		return $lastID;
	}
	
	
/****** Edit an existing Forum ******/
	public static function editForum
	(
		$forumID		// <int> The ID of the forum you're editing.
	,	$categoryID		// <int> The category ID to assign to the forum.
	,	$parentID		// <int> The parent forum ID that the forum is to be assigned to.
	,	$title			// <str> The title of the forum.
	,	$description	// <str> The caption (description) of the forum.
	,	$readPerm		// <int> The clearance level required to read the forum.
	,	$postPerm		// <int> The clearance level required to post to the forum.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppForumAdmin::editForum($forumID, $categoryID, $parentID, "Forum Title", "The forum caption / description", $readPerm, $postPerm);
	{
		// Move to a new category if applicable
		AppForumAdmin::moveForum($forumID, 0, $categoryID);
		
		// Create the URL Slug for this post
		$urlSlug = Sanitize::variable(str_replace(" ", "-", strtolower($title)), "-");
		
		// Update has_children status
		if($parentID > 0)
		{
			Database::query("UPDATE forums SET has_children=? WHERE id=? LIMIT 1", array(1, $parentID));
		}
		
		// Update the forum
		return Database::query("UPDATE forums SET category_id=?, parent_id=?, url_slug=?, title=?, description=?, perm_read=?, perm_post=? WHERE id=? LIMIT 1", array(($parentID == 0 ? $categoryID : 0), $parentID, $urlSlug, $title, $description, $readPerm, $postPerm, $forumID));
	}
	
	
/****** Move a Forum (reposition it) ******/
	public static function moveForum
	(
		$forumID		// <int> The ID of the forum you're moving.
	,	$moveVal = 0	// <int> The movement integer (1 is down, 0 is unmoving, -1 is up).
	,	$categoryID = 0	// <int> The category ID to move to.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppForumAdmin::moveForum($forumID, $moveVal = 0, $categoryID = 0);	// $moveVal of -1 is up, 1 is down
	{
		// Make sure the forum exists
		if(!$forumData = Database::selectOne("SELECT category_id, parent_id, forum_order FROM forums WHERE id=? LIMIT 1", array($forumID)))
		{
			return false;
		}
		
		// Recognize Integers
		$forumData['category_id'] = (int) $forumData['category_id'];
		$forumData['parent_id'] = (int) $forumData['parent_id'];
		$forumData['forum_order'] = (int) $forumData['forum_order'];
		
		// Check if the new category is different from the old category (since this affects ordering)
		if($categoryID != 0 && $categoryID != $forumData['category_id'])
		{
			// Make sure the new category exists
			if(!$catExists = (int) Database::selectValue("SELECT id FROM forum_categories WHERE id=? LIMIT 1", array($categoryID)))
			{
				return false;
			}
			
			// The forum has moved categories, which means we need to reorder the forums
			// Update the current category's forum orders
			Database::query("UPDATE forums SET forum_order=forum_order-1 WHERE category_id=? AND forum_order > ?", array($forumData['category_id'], $forumData['forum_order']));
			
			// Determine the last position of the new category
			$lastPos = (int) Database::selectValue("SELECT forum_order FROM forums WHERE category_id=? ORDER BY forum_order DESC LIMIT 1", array($categoryID));
			
			// Update the forum's order within the new category
			Database::query("UPDATE forums SET forum_order=? WHERE id=? LIMIT 1", array($lastPos + 1, $forumID));
			
			// Update children status
			$subforums = AppForum::getSubforums($forumData['parent_id']);
			Database::query("UPDATE forums SET has_children=? WHERE id=? LIMIT 1", array(($subforums == array() ? 0 : 1), $forumData['parent_id']));
		}
		
		// If you're not moving the forum order, return
		if($moveVal == 0)
		{
			return false;
		}
		
		// Find the forum that you'll be swapping with
		if(!$forumSwapID = (int) Database::selectValue("SELECT id FROM forums WHERE category_id=? AND forum_order=? LIMIT 1", array($forumData['category_id'], $forumData['forum_order'] + $moveVal)))
		{
			return false;
		}
		
		// Swap the two forum orders
		Database::startTransaction();
		
		$pass1 = Database::query("UPDATE forums SET forum_order=? WHERE id=? LIMIT 1", array($forumData['forum_order'], $forumSwapID));
		$pass2 = Database::query("UPDATE forums SET forum_order=? WHERE id=? LIMIT 1", array($forumData['forum_order'] + $moveVal, $forumID));
		
		return Database::endTransaction(($pass1 && $pass2));
	}
	
	
/****** Move a Thread to a new Forum ******/
	public static function moveThread
	(
		$curForumID		// <int> The ID of the forum where the thread currently exists.
	,	$threadID		// <int> The ID of the thread.
	,	$newForumID		// <int> The ID of the forum to move the thread to.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppForumAdmin::moveThread($curForumID, $threadID, $newForumID);
	{
		Database::startTransaction();
		$pass = true;
		
		if($checkSticky = (int) Database::selectValue("SELECT sticky_level FROM threads_stickied WHERE forum_id=? AND thread_id=? LIMIT 1", array($curForumID, $threadID)))
		{
			$pass = Database::query("UPDATE threads_stickied SET forum_id=? WHERE forum_id=? AND thread_id=? LIMIT 1", array($newForumID, $curForumID, $threadID));
		}
		
		$pass = Database::query("UPDATE threads SET forum_id=? WHERE forum_id=? AND id=? LIMIT 1", array($newForumID, $curForumID, $threadID)) ? $pass : false;
		
		if($pass)
		{
			// Adjust thread subscriptions
			Database::query("UPDATE thread_subs SET forum_id=? WHERE forum_id=? AND thread_id=?", array($newForumID, $curForumID, $threadID));
			Database::query("UPDATE thread_subs_by_user SET forum_id=? WHERE forum_id=? AND thread_id=?", array($newForumID, $curForumID, $threadID));
			
			// Notify forum subscriptions
			$forum = Database::selectOne("SELECT id, url_slug, title FROM forums WHERE id=? LIMIT 1", array($newForumID));
			$thread = Database::selectOne("SELECT id, url_slug, title FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($newForumID, $threadID));
			AppSubscriptions::updateForum($forum, $thread, Me::$id, 0, "", "m");
		}
		
		return Database::endTransaction($pass);
	}
	
	
/****** Delete a Forum ******/
	public static function deleteForum
	(
		$forumID	// <int> The ID of the forum you're deleting.
	)				// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppForumAdmin::deletePost($forumID);
	{
		return Database::query("DELETE FROM forum WHERE id=? LIMIT 1", array($forumID));
	}
	
	
/****** Delete a Thread ******/
	public static function deleteThread
	(
		$forumID		// <int> The ID of the forum that contains the thread.
	,	$threadID		// <int> The ID of the thread you're deleting.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppForumAdmin::deleteThread($forumID, $threadID);
	{
		Database::startTransaction();
		
		// Send a Preliminary Mod Report
		$pass = AppMod::sendReport_deleteThread($forumID, $threadID);
		
		// Delete the Thread
		$pass2 = Database::query("DELETE FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($forumID, $threadID));
		
		// Avoiding running too many unnecessary tests
		if(!$pass || !$pass2)
		{
			return Database::endTransaction(false);
		}
		
		// Delete the Thread's Posts
		$pass = Database::query("DELETE FROM posts WHERE thread_id=?", array($threadID));
		
		return Database::endTransaction($pass);
	}
	
	
/****** Delete a Post ******/
	public static function deletePost
	(
		$forumID		// <int> The ID of the associated forum.
	,	$threadID		// <int> The ID of the thread that the post is contained in.
	,	$postID			// <int> The ID of the post you're deleting.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppForumAdmin::deletePost($forumID, $threadID, $postID);
	{
		Database::startTransaction();
		
		// Send a Preliminary Mod Report
		$pass = AppMod::sendReport_deletePost($forumID, $threadID, $postID);
		
		// Delete the Post
		$pass2 = Database::query("DELETE FROM posts WHERE thread_id=? AND id=? LIMIT 1", array($threadID, $postID));
		
		// Avoid unnecessary checks if possible
		if(!$pass || !$pass2) { return Database::endTransaction(false); }
		
		// Count the amount of posts still available on the thread
		if(!$hasPosts = (int) Database::selectValue("SELECT COUNT(*) as hasPosts FROM posts WHERE thread_id=? LIMIT 1", array($threadID)))
		{
			$pass = Database::query("DELETE FROM threads WHERE forum_id=? AND id=?", array($forumID, $threadID));
		}
		else
		{
			$pass = Database::query("UPDATE threads SET posts=posts-1 WHERE forum_id=? AND id=? LIMIT 1", array($forumID, $threadID));
		}
		
		return Database::endTransaction($pass);
	}
	
	
/****** Lock a Thread ******/
	public static function lockThread
	(
		$forumID		// <int> The forum ID of the thread to lock.
	,	$threadID		// <int> The ID of the thread to lock.
	,	$lockLevel = 5	// <int> The level to lock the thread at.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppForumAdmin::lockThread($forumID, $threadID, $lockLevel = 5);
	{
		Database::startTransaction();
		
		// Send a Preliminary Mod Report
		$pass = AppMod::sendReport_lockThread($forumID, $threadID);
		
		$pass2 = Database::query("UPDATE threads SET perm_post=? WHERE forum_id=? AND id=? LIMIT 1", array($lockLevel, $forumID, $threadID));
		
		return Database::endTransaction($pass && $pass2);
	}
	
	
/****** Alter Sticky Level ******/
	public static function alterSticky
	(
		$forumID		// <int> The forum ID that contains the thread you're editing.
	,	$threadID		// <int> The ID of the thread to edit.
	,	$sticky			// <int> The sticky level to change.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppForumAdmin::alterSticky($forumID, $threadID, $sticky);
	{
		if($sticky == 0)
		{
			return Database::query("DELETE FROM threads_stickied WHERE forum_id=? AND thread_id=? LIMIT 1", array($forumID, $threadID));
		}
		
		// Check the thread's sticky level
		if($stickyLevel = (int) Database::selectValue("SELECT sticky_level FROM threads_stickied WHERE forum_id=? AND thread_id=? LIMIT 1", array($forumID, $threadID)))
		{
			return Database::query("UPDATE threads_stickied SET sticky_level=? WHERE forum_id=? AND thread_id=? LIMIT 1", array($sticky, $forumID, $threadID));
		}
		
		return Database::query("INSERT INTO threads_stickied (forum_id, thread_id, sticky_level) VALUES (?, ?, ?)", array($forumID, $threadID, $sticky));
	}
	
}
