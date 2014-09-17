<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); } /*

----------------------------------------------
------ About the AppSubscriptions Class ------
----------------------------------------------

This plugin provides handling for subscriptions to threads.


-------------------------------
------ Methods Available ------
-------------------------------

$subscriptions = AppSubscriptions::get($uniID);

AppSubscriptions::subscribe($forumID, $threadID, $uniID);
AppSubscriptions::unsubscribe($forumID, $threadID, $uniID);
AppSubscriptions::update($forumID, $threadID, $posterID, $threadName);

$getData = AppSubscriptions::getData($uniID, $forumID, $threadID);

AppSubscriptions::clear($uniID, $forumID, $threadID);

*/

abstract class AppSubscriptions {
	
	
/****** Retrieve a list of your subscriptions ******/
	public static function get
	(
		$uniID			// <int> The UniID that you're checking the subscriptions of.
	)					// RETURNS <int:[str:mixed]> list of subscriptions, or FALSE on failure.
	
	// $subscriptions = AppSubscriptions::get($uniID);
	{
		return Database::selectMultiple("SELECT t.forum_id, t.id, t.title, t.posts, t.views, t.last_poster_id, t.date_last_post, ts.new_posts FROM thread_subs_by_user ts INNER JOIN threads t ON t.forum_id=ts.forum_id AND t.id=ts.thread_id WHERE uni_id=?", array($uniID));
	}
	
	
/****** Subscribe to a Thread ******/
	public static function subscribe
	(
		$forumID		// <int> The ID of the forum that the thread is in.
	,	$threadID		// <int> The ID of the thread to subscribe to.
	,	$uniID			// <int> The UniID that is subscribing to the thread.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppSubscriptions::subscribe($forumID, $threadID, $uniID);
	{
		if($check = (int) Database::selectValue("SELECT uni_id FROM thread_subs WHERE forum_id=? AND thread_id=? AND uni_id=? LIMIT 1", array($forumID, $threadID, $uniID)))
		{
			return false;
		}
		
		// Add the subscription
		Database::startTransaction();
		
		if(Database::query("INSERT INTO `thread_subs` (forum_id, thread_id, uni_id) VALUES (?, ?, ?)", array($forumID, $threadID, $uniID)))
		{
			if(Database::query("INSERT INTO `thread_subs_by_user` (uni_id, forum_id, thread_id) VALUES (?, ?, ?)", array($uniID, $forumID, $threadID)))
			{
				return Database::endTransaction();
			}
		}
		
		return Database::endTransaction(false);
	}
	
	
/****** Unsubscribe from a Thread ******/
	public static function unsubscribe
	(
		$forumID		// <int> The ID of the forum that the thread is in.
	,	$threadID		// <int> The ID of the thread to unsubscribe from.
	,	$uniID			// <int> The UniID that is unsubscribing.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppSubscriptions::unsubscribe($forumID, $threadID, $uniID);
	{
		if(!Database::selectValue("SELECT uni_id FROM thread_subs WHERE forum_id=? AND thread_id=? AND uni_id=? LIMIT 1", array($forumID, $threadID, $uniID)))
		{
			return false;
		}
		
		// Remove the subscription
		Database::startTransaction();
		
		if(Database::query("DELETE FROM thread_subs WHERE forum_id=? AND thread_id=? AND uni_id=? LIMIT 1", array($forumID, $threadID, $uniID)))
		{
			if(Database::query("DELETE FROM thread_subs_by_user WHERE uni_id=? AND forum_id=? AND thread_id=? LIMIT 1", array($uniID, $forumID, $threadID)))
			{
				return Database::endTransaction();
			}
		}
		
		return Database::endTransaction(false);
	}
	
	
/****** Update a thread's subscriptions ******/
	public static function update
	(
		$forumID		// <int> The ID of the forum that the thread is in.
	,	$threadID		// <int> The ID of the thread to update the subscriptions of.
	,	$posterID		// <int> The UniID of the poster.
	,	$threadName		// <str> The name of the thread.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppSubscriptions::update($forumID, $threadID, $posterID, $threadName);
	{
		if(!$subscriptions = Database::selectMultiple("SELECT uni_id FROM thread_subs WHERE forum_id=? AND thread_id=? AND uni_id != ?", array($forumID, $threadID, $posterID)))
		{
			return false;
		}
		
		// Prepare Values
		$threadName = Sanitize::text($threadName);
		
		// Update the subscriptions
		Database::startTransaction();
		
		foreach($subscriptions as $sub)
		{
			$sub['uni_id'] = (int) $sub['uni_id'];
			
			if(Database::query("UPDATE thread_subs_by_user SET new_posts=1 WHERE uni_id=? AND forum_id=? AND thread_id=? AND new_posts=? LIMIT 1", array($sub['uni_id'], $forumID, $threadID, 0)))
			{
				Notifications::create($sub['uni_id'], "Subscriptions", 'The thread "' . $threadName . '" has received new posts!', "/thread?forum=" . $forumID . '&id=' . $threadID . '&page=last');
			}
		}
		
		return Database::endTransaction();
	}
	
	
/****** Return subscription data for a thread, if available ******/
	public static function getData
	(
		$uniID			// <int> The UniID that you're checking the subscriptions of.
	,	$forumID		// <int> The ID of the forum that the thread is in.
	,	$threadID		// <int> The ID of the thread you're checking the subscription of.
	)					// RETURNS <str:mixed> subscription data, or empty array if nothing.
	
	// $getData = AppSubscriptions::getData($uniID, $forumID, $threadID);
	{
		return Database::selectOne("SELECT uni_id, new_posts FROM thread_subs_by_user WHERE uni_id=? AND forum_id=? AND thread_id=? LIMIT 1", array($uniID, $forumID, $threadID));
	}
	
	
/****** Clear a subscription (return new posts to 0) ******/
	public static function clear
	(
		$uniID			// <int> The UniID that you're checking the subscriptions of.
	,	$forumID		// <int> The ID of the forum that the thread is in.
	,	$threadID		// <int> The ID of the thread you're checking the subscription of.
	)					// RETURNS <bool> TRUE on success, FALSE on failure.
	
	// AppSubscriptions::clear($uniID, $forumID, $threadID);
	{
		return Database::query("UPDATE thread_subs_by_user SET new_posts=? WHERE uni_id=? AND forum_id=? AND thread_id=? LIMIT 1", array(0, $uniID, $forumID, $threadID));
	}
	
}
