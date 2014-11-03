<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); } /*

--------------------------------------
------ About the AppForum Class ------
--------------------------------------

This class provides handling for forums.

Note: You will probably notice that a lot of functions call the ID of their parents, not just the ID of the child.

For example, deleting a post requires $threadID and $postID, not just $postID. This is because the indexing for the system is based on the thread_id column, and partitioned. Therefore, it is MUCH faster to call the parent in these cases. Review the schemas to see how the database is structured.


-------------------------------
------ Methods Available ------
-------------------------------

$cats = AppForum::getCategories($forumID = 0);		// Returns the list of categories (defaults to home categories)
$forums = AppForum::getForums($categoryID);			// Returns the list of forums in a category

$threads = AppForum::getThreads($forumID, $page, $show = 20);	// Returns the threads in a forum.
$stickied = AppForum::getStickied($forumID);					// Returns stickied threads in a forum.

$crumbs = AppForum::getBreadcrumbs($forumID, [$returnLast]);
AppForum::view($forumID);

*/

abstract class AppForum {
	
	
/****** Retrieve a Forum ******/
	public static function get
	(
		$forumID	// <int> The ID of the forum you're retrieving.
	)				// RETURNS <str:mixed> an array of the data for the forum.
	
	// $forum = AppForum::get($forumID);
	{
		return Database::selectOne("SELECT * FROM forums WHERE id=? LIMIT 1", array($forumID));
	}
	
	
/****** Get a list of Forum Categories (within the forum specified) ******/
	public static function getCategories
	(
		$forumID = 0	// <int> The ID of the forum you're retrieve categories from.
	)					// RETURNS <int:[str:mixed]> an array of forums.
	
	// $categories = AppForum::getCategories($forumID);
	{
		return Database::selectMultiple("SELECT id, title FROM forum_categories WHERE parent_forum=? ORDER BY cat_order ASC", array($forumID));
	}
	
	
/****** Get a list of Forum Categories (within the forum specified) ******/
	public static function getForums
	(
		$categoryID		// <int> The ID of the category you're retrieving forums from.
	)					// RETURNS <int:[str:mixed]> an array of forums.
	
	// $forums = AppForum::getForums($categoryID);
	{
		$clearance = (isset(Me::$vals['clearance']) ? Me::$vals['clearance'] : 0);
		
		$results = Database::selectMultiple("SELECT f.id, f.url_slug, f.title, f.description, f.posts, f.views, f.last_poster, f.date_lastPost, f.perm_read, f.perm_post, u.handle, u.display_name FROM forums f LEFT JOIN users u ON u.uni_id=f.last_poster WHERE f.category_id=? ORDER BY f.forum_order ASC", array($categoryID));
		
		// Cycle through the list of forums, and remove any that you don't have permission to read
		foreach($results as $key => $val)
		{
			if((int) $val['perm_read'] > $clearance)
			{
				unset($results[$key]);
			}
		}
		
		return $results;
	}
	
	
/****** Get a list of Threads (within the forum specified) ******/
	public static function getThreads
	(
		$forumID				// <int> The ID of the forum you're retrieving threads from.
	,	$page 					// <int> The page that you're viewing.
	,	$show = 20				// <int> The number of threads to show.
	,	$stickyList = array()	// <array> List of thread IDs that were stickied.
	)							// RETURNS <int:[str:mixed]> an array of threads.
	
	// $threads = AppForum::getThreads($forumID, $page, $show = 20);
	{
		$startLimit = max(0, ($page - 1) * $show);
		
		return Database::selectMultiple("SELECT t.id, t.forum_id, t.url_slug, t.title, t.posts, t.views, t.author_id, t.last_poster_id, t.date_last_post, t.perm_post, u.handle, u.display_name FROM threads t INNER JOIN users u ON u.uni_id=t.author_id WHERE t.forum_id=? ORDER BY t.id DESC LIMIT " . ($startLimit + 0) . ', ' . (max(1, $show) + 1), array($forumID));
	}
	
	
/****** Get a list of Stickied Threads (within the forum specified) ******/
	public static function getStickied
	(
		$forumID	// <int> The ID of the forum you're retrieving stickied threads from.
	,	$page = 1	// <int> The page that you're viewing on the forum.
	)				// RETURNS <int:[str:mixed]> an array of stickied threads.
	
	// $stickied = AppForum::getStickied($forumID);
	{
		return Database::selectMultiple("SELECT t.*, ts.sticky_level, u.handle, u.display_name FROM threads_stickied ts INNER JOIN threads t ON t.id=ts.thread_id INNER JOIN users u ON u.uni_id=t.author_id WHERE ts.forum_id=? ORDER BY ts.sticky_level DESC", array($forumID));
	}
	
	
/****** Return a breadcrumb trail of forums ******/
	public static function getBreadcrumbs
	(
		$forum				// <str:mixed> The data of the forum.
	,	$returnLast = true	// <bool> TRUE returns the last forum, FALSE does not.
	)						// RETURNS <int:[int:str]> a breadcrumb trail from original to last.
	
	// $breadcrumbs = AppForum::getBreadcrumbs($forum, [$returnLast]);
	{
		$breadcrumbs = array();
		$nextForumID = (int) $forum['id'];
		
		// Get the current forum title
		if($returnLast == true)
		{
			$breadcrumbs[] = array('/' . $forum['url_slug'], $forum['title']);
		}
		
		// Cycle through the previous forums & categories
		while($parentCat = Database::selectOne("SELECT id, title FROM forum_categories WHERE parent_forum=? LIMIT 1", array($nextForumID)))
		{
			if(!$parentCat['id']) { break; }
			
			if(!$nextForum = Database::selectOne("SELECT id, url_slug, title FROM forums WHERE category_id=? LIMIT 1", array($parentCat['id'])))
			{
				break;
			}
			
			$nextForumID = (int) $nextForum['id'];
			$breadcrums[] = array('/' . $nextForum['url_slug'], $nextForum['title']);
		}
		
		$breadcrumbs[] = array('/', "Home");
		
		return array_reverse($breadcrumbs);
	}
	
	
/****** View a Forum ******/
	public static function view
	(
		$forumID		// <int> The ID of the forum that the thread is in.
	)					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppForum::view($forumID);
	{
		return Database::query("UPDATE forums SET views=views+1 WHERE id=? LIMIT 1", array($forumID));
	}
	
}
