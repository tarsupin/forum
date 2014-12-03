<?hh if(!defined("CONF_PATH")) { die("No direct script access allowed."); } /*

-------------------------------------
------ About the AppMod Plugin ------
-------------------------------------

This plugin provides improved moderation handling for forums. It utilizes the behavior of the SiteReport plugin.

One of the main purposes of this class it to automatically generate mod reports on various activities.


-------------------------------
------ Methods Available ------
-------------------------------

AppMod::sendReport_lockThread($forumID, $threadID);
AppMod::sendReport_deleteThread($forumID, $threadID);
AppMod::sendReport_deletePost($forumID, $threadID, $postID);

*/

abstract class AppMod {
	
	
/****** Send a Mod Report: Lock a Thread ******/
	public static function sendReport_lockThread
	(
		int $forumID		// <int> The ID of the forum you're locking a thread in.
	,	int $threadID		// <int> The ID of the thread being locked.
	): bool					// RETURNS <bool> TRUE on success, FALSE on failure.
	
	// AppMod::sendReport_lockThread($forumID, $threadID);
	{
		if($thread = Database::selectOne("SELECT url_slug, author_id FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($forumID, $threadID)))
		{
			if($forum = Database::selectOne("SELECT url_slug FROM forums WHERE id=? LIMIT 1", array($forumID)))
			{
				$url = '/' . $forum['url_slug'] . '/' . $threadID . '-' . $thread['url_slug'];
				return SiteReport::create("Locked Thread", $url, Me::$id, (int) $thread['author_id'], "");
			}
		}
		
		return false;
	}
	
	
/****** Send a Mod Report: Delete a Thread ******/
	public static function sendReport_deleteThread
	(
		int $forumID		// <int> The ID of the forum you're locking a thread in.
	,	int $threadID		// <int> The ID of the thread being locked.
	): bool					// RETURNS <bool> TRUE on success, FALSE on failure.
	
	// AppMod::sendReport_deleteThread($forumID, $threadID);
	{
		if(!$threadData = Database::selectOne("SELECT forum_id, url_slug, posts, views, title, author_id, date_created, date_last_post FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($forumID, $threadID)))
		{
			return false;
		}
		
		if($forum = Database::selectOne("SELECT url_slug FROM forums WHERE id=? LIMIT 1", array($forumID)))
		{
			$url = '/' . $forum['url_slug'] . '/' . $threadID . '-' . $threadData['url_slug'];
			unset($threadData['url_slug']);
			$details = print_r($threadData, true);
			
			return SiteReport::create("Deleted Thread", $url, Me::$id, (int) $threadData['author_id'], $details);
		}
		
		return false;
	}
	
	
/****** Send a Mod Report: Delete a Post ******/
	public static function sendReport_deletePost
	(
		int $forumID		// <int> The ID of the associated forum.
	,	int $threadID		// <int> The ID of the associated thread.
	,	int $postID			// <int> The ID of the post being deleted.
	): bool					// RETURNS <bool> TRUE on success, FALSE on failure.
	
	// AppMod::sendReport_deletePost($forumID, $threadID, $postID);
	{
		if(!$postData = Database::selectOne("SELECT thread_id, uni_id, body, date_post FROM posts WHERE thread_id=? AND id=? LIMIT 1", array($threadID, $postID)))
		{
			return false;
		}
		
		$details = print_r($postData, true);
		
		if($thread = Database::selectOne("SELECT url_slug FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($forumID, $threadID)))
		{
			if($forum = Database::selectOne("SELECT url_slug FROM forums WHERE id=? LIMIT 1", array($forumID)))
			{
				$url = '/' . $forum['url_slug'] . '/' . $threadID . '-' . $thread['url_slug'];
				return SiteReport::create("Deleted Post", $url, Me::$id, (int) $postData['uni_id'], $details);
			}
		}
		
		return false;
	}
	
}