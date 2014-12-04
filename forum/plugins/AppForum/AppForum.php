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
AppForum::view($forum);

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
	public static function getCategories (
	)					// RETURNS <int:[str:mixed]> an array of categories.
	
	// $categories = AppForum::getCategories();
	{
		return Database::selectMultiple("SELECT id, title FROM forum_categories ORDER BY cat_order ASC", array());
	}
	
	
/****** Get a list of forums within a particular category ******/
	public static function getForums
	(
		$categoryID		// <int> The ID of the category you're retrieving forums from.
	)					// RETURNS <int:[str:mixed]> an array of forums.
	
	// $forums = AppForum::getForums($categoryID);
	{
		$clearance = (isset(Me::$clearance) ? Me::$clearance : 0);
		
		$results = Database::selectMultiple("SELECT f.id, f.has_children, f.url_slug, f.title, f.description, f.posts, f.views, f.last_poster, f.date_lastPost, f.perm_read, f.perm_post, u.role, u.handle, u.display_name FROM forums f LEFT JOIN users u ON u.uni_id=f.last_poster WHERE f.category_id=? AND parent_id=? ORDER BY f.forum_order ASC", array($categoryID, 0));
		
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
	
	
/****** Get a list of subforums within a particular forum ******/
	public static function getSubforums
	(
		$parentID		// <int> The ID of the forum you're retrieving subforums from.
	)					// RETURNS <int:[str:mixed]> an array of forums.
	
	// $subforums = AppForum::getSubforums($parentID);
	{
		$clearance = (isset(Me::$clearance) ? Me::$clearance : 0);
		
		$results = Database::selectMultiple("SELECT f.id, f.has_children, f.url_slug, f.title, f.description, f.posts, f.views, f.last_poster, f.date_lastPost, f.perm_read, f.perm_post, u.role, u.handle, u.display_name FROM forums f LEFT JOIN users u ON u.uni_id=f.last_poster WHERE f.category_id=? AND parent_id=? ORDER BY f.forum_order ASC", array(0, $parentID));
		
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
		
		return Database::selectMultiple("SELECT t.id, t.forum_id, t.url_slug, t.title, t.posts, t.views, t.author_id, t.last_poster_id, t.date_last_post, t.perm_post, u.role, u.handle, u.display_name FROM threads t INNER JOIN users u ON u.uni_id=t.last_poster_id WHERE t.forum_id=? ORDER BY t.date_last_post DESC LIMIT " . ($startLimit + 0) . ', ' . (max(1, $show) + 1), array($forumID));
	}
	
	
/****** Get a list of Stickied Threads (within the forum specified) ******/
	public static function getStickied
	(
		$forumID	// <int> The ID of the forum you're retrieving stickied threads from.
	,	$page = 1	// <int> The page that you're viewing on the forum.
	)				// RETURNS <int:[str:mixed]> an array of stickied threads.
	
	// $stickied = AppForum::getStickied($forumID);
	{
		return Database::selectMultiple("SELECT t.*, ts.sticky_level, u.role, u.handle, u.display_name FROM threads_stickied ts INNER JOIN threads t ON t.id=ts.thread_id INNER JOIN users u ON u.uni_id=t.last_poster_id WHERE ts.forum_id=? ORDER BY ts.sticky_level DESC", array($forumID));
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
		$nextForumID = (int) $forum['parent_id'];
		
		// Get the current forum title
		if($returnLast == true)
		{
			$breadcrumbs[] = array('/' . $forum['url_slug'], $forum['title']);
		}
		
		// Cycle through the previous forums
		while($nextForum = Database::selectOne("SELECT id, parent_id, url_slug, title FROM forums WHERE id=? LIMIT 1", array($nextForumID)))
		{
			$breadcrumbs[] = array('/' . $nextForum['url_slug'], $nextForum['title']);
			
			if(!$nextForum['parent_id']) { break; }
			
			$nextForumID = (int) $nextForum['parent_id'];
		}
		
		$breadcrumbs[] = array('/', "Home");
		
		return array_reverse($breadcrumbs);
	}
	
	
/****** Get a user's signature ******/
	public static function getSettings
	(
		$uniID			// <int> The UniID of the user to retrieve the signature of.
	,	$orig = false	// <bool> TRUE if you're retrieving the original (no markup).
	)					// RETURNS <str:str> The settings for the user.
	
	// $signature = AppForum::getSettings($uniID, [$orig]);
	{
		return Database::selectOne("SELECT signature" . ($orig ? "_orig" : "") . " as signature, avatar_list FROM forum_settings WHERE uni_id=? LIMIT 1", array($uniID));
	}
	

/****** Get a user's avatar name ******/
	public static function getName
	(
		$uniID			// <int> The UniID of the user to retrieve the signature of.
	,	$aviID			// <int> The ID of the avatar to get the name of.
	)					// RETURNS <str> The name for the avatar.
	
	// $aviname = AppForum::getName($uniID, $aviID);
	{
		if($aviID == 0)
		{
			return "";
		}
		
		if($name = Cache::get($uniID . "-" . $aviID . "-avi-name"))
		{
			return $name;
		}
		
		if($name = Database::selectOne("SELECT avatar_list FROM forum_settings WHERE uni_id=? LIMIT 1", array($uniID)))
		{
			if($name['avatar_list'] != "")
			{
				$name = json_decode($name['avatar_list'], true);
				if(isset($name[$aviID]))
				{
					Cache::set($uniID . "-" . $aviID . "-avi-name", $name[$aviID], 60 * 60);
					if($name[$aviID] != "")
					{
						return $name[$aviID];
					}
				}
			}
		}
		
		return "";
	}
	
	
/****** Update a user's signature ******/
	public static function updateSignature
	(
		$uniID		// <int> The UniID of the user to retrieve the signature of.
	,	$signature	// <str> The signature to set for the user.
	)				// RETURNS <bool> TRUE on success, FALSE on failure.
	
	// AppForum::updateSignature($uniID, $signature);
	{
		return Database::query("INSERT INTO forum_settings (uni_id, signature, signature_orig) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE uni_id=?, signature=?, signature_orig=?", array($uniID, UniMarkup::parse($signature), $signature, $uniID, UniMarkup::parse($signature), $signature));
	}
	
	
/****** View a Forum ******/
	public static function view
	(
		$forum			// <str:mixed> The data of the forum.
	)					// RETURNS <void>
	
	// AppForum::view($forum);
	{
		Database::startTransaction();
		
		Database::query("UPDATE forums SET views=views+1 WHERE id=? LIMIT 1", array($forum['id']));
		
		// Update the forums above
		$parentID = (int) $forum['parent_id'];
		
		while($parentID)
		{
			if(!$nextForum = Database::selectOne("SELECT id, parent_id FROM forums WHERE id=? LIMIT 1", array($forum['parent_id'])))
			{
				break;
			}
			
			Database::query("UPDATE forums SET views=views+1 WHERE id=? LIMIT 1", array($nextForum['id']));
			
			$parentID = (int) $nextForum['parent_id'];
		}
		
		Database::endTransaction();
	}
	
	
/****** Run the new post handler ******/
	public static function newPostHandler
	(
		$forum			// <str:mixed> The data of the forum.
	)					// RETURNS <void>
	
	// AppForum::newPostHandler($forum);
	{
		if(Me::$loggedIn)
		{
			// Prepare "New Post" Data
			if(!isset($_SESSION[SITE_HANDLE]['forums-new']))
			{
				if($lastActivity = UserActivity::getUsersLastVisit(Me::$id))
				{
					$_SESSION[SITE_HANDLE]['last-visit'] = $lastActivity;
				}
				else
				{
					$_SESSION[SITE_HANDLE]['last-visit'] = time();
				}
				
				$_SESSION[SITE_HANDLE]['forums-new'] = array();
				
			}
		}
		else
		{
			return time();
		}
	}
	
	
/****** Display a Forum Line by the ID ******/
	public static function displayLine
	(
		$forum				// <str:mixed> The data of the forum to display.
	,	$newPost = false	// <bool> TRUE will show a "new" icon, FALSE does not.
	)						// RETURNS <void> Outputs the line.
	
	// AppForum::displayLine($forum, [$newPost]);
	{
		// Prepare Values
		$desc = $forum['description'];
		
		// If the forum has children, run an additional test
		if($forum['has_children'])
		{
			if(!$subForums = AppForum::getSubforums($forum['id']))
			{
				continue;
			}
			
			$desc .= '<div class="sub-forum-list">';
			
			foreach($subForums as $sub)
			{
				$sub['id'] = (int) $sub['id'];
				
				// Check for the New Icon
				if($subIcon = ($sub['date_lastPost'] > $_SESSION[SITE_HANDLE]['new-tracker']) ? true : false)
				{
					if(isset($_SESSION[SITE_HANDLE]['forums-new'][$sub['id']]))
					{
						if($subIcon = ($sub['date_lastPost'] > ($_SESSION[SITE_HANDLE]['new-tracker'] + $_SESSION[SITE_HANDLE]['forums-new'][$sub['id']])) ? true : false)
						{
							unset($_SESSION[SITE_HANDLE]['forums-new'][$sub['id']]);
						}
					}
				}
				
				// Display the Forum Line
				$desc .= '<a href="/' . $sub['url_slug'] . '"><span class="icon-folder ' . ($subIcon ? 'new-sub' :  '') . '"></span> ' . $sub['title'] . "</a> ";
			}
			
			$desc .= '</div>';
		}
		
		echo '
		<div class="inner-line">
			<div class="inner-name">
				<a href="/' . $forum['url_slug'] . '">' . ($newPost ? '<img src="' . CDN . '/images/new.png" /> ' :  '') . $forum['title'] . '</a>
				<div class="inner-desc">' . $desc . '</div>
			</div>
			<div class="inner-posts">' . $forum['posts'] . '</div>
			<div class="inner-views">' . $forum['views'] . '</div>
			<div class="inner-details">' . ($forum['handle'] ?  '<a ' . ($forum['role'] != '' ? 'class="role-' . $forum['role'] . '" ' : '') . 'href="' . URL::unifaction_social() . '/' . $forum['handle'] . '">@' . $forum['handle'] . '</a><br />' . Time::fuzzy((int) $forum['date_lastPost']) : "") . '</div>
		</div>';
	}
	
}
