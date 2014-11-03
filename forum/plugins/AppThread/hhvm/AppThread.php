<?hh if(!defined("CONF_PATH")) { die("No direct script access allowed."); } /*

---------------------------------------
------ About the AppThread Class ------
---------------------------------------

This class provides handling for forum threads.

Note: You will probably notice that a lot of functions call the ID of their parents, not just the ID of the child.

For example, deleting a post requires $threadID and $postID, not just $postID. This is because the indexing for the system is based on the thread_id column, and partitioned. Therefore, it is MUCH faster to call the parent in these cases. Review the schemas to see how the database is structured.


-------------------------------
------ Methods Available ------
-------------------------------

$posts = AppThread::getPosts($threadID, $page, $show = 10);	// Returns the posts in a thread

AppThread::view($forumID, $threadID);

AppThread::edit($forumID, $threadID, $title, $sticky);

$threadID = AppThread::create($forumID, $uniID, $title, $sticky);

*/

abstract class AppThread {
	
	
/****** Retrieve a Thread ******/
	public static function get
	(
		int $forumID		// <int> The ID of the forum the thread is in.
	,	int $threadID		// <int> The ID of the thread you're retrieving.
	): array <str, mixed>					// RETURNS <str:mixed> an array of the thread data.
	
	// $thread = AppThread::get($forumID, $threadID);
	{
		return Database::selectOne("SELECT * FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($forumID, $threadID));
	}
	
	
/****** Get a list of Posts (within the thread specified) ******/
	public static function getPosts
	(
		int $threadID		// <int> The ID of the thread you're retrieving posts from.
	,	int $page 			// <int> The thread page that you're viewing.
	,	int $show = 10		// <int> The number of posts to show.
	): array <int, array<str, mixed>>					// RETURNS <int:[str:mixed]> an array of posts.
	
	// $posts = AppThread::getPosts($forumID, $page, $show = 20);
	{
		$startLimit = max(0, ($page - 1) * $show);
		
		return Database::selectMultiple("SELECT id, uni_id, body, date_post FROM posts WHERE thread_id=? ORDER BY id ASC LIMIT " . ($startLimit + 0) . ', ' . max(1, $show), array($threadID));
	}
	
	
/****** View a Thread ******/
	public static function view
	(
		int $forumID		// <int> The ID of the forum that the thread is in.
	,	int $threadID		// <int> The ID of the thread you're posting in.
	): bool					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppThread::view($forumID, $threadID);
	{
		return Database::query("UPDATE threads SET views=views+1 WHERE forum_id=? AND id=? LIMIT 1", array($forumID, $threadID));
	}
	
	
/****** Create a new Thread ******/
	public static function create
	(
		int $forumID		// <int> The ID of the forum you're creating a thread in.
	,	int $uniID	 		// <int> The uni_id of the user creating the thread.
	,	string $title			// <str> The title of the thread.
	,	int $sticky = 0		// <int> The level of sticky importance (0 to 9).
	): int					// RETURNS <int> ID of the thread that was created, or FALSE on failure.
	
	// $threadID = AppThread::create($forumID, $uniID, "My awesome title", [$sticky]);
	{
		Database::startTransaction();
		
		// Prepare Values
		$threadID = UniqueID::get("post");
		$timestamp = time();
		
		// Create the URL Slug for this post
		$urlSlug = Sanitize::variable(str_replace(" ", "-", strtolower($title)), "-");
		
		// Create the thread
		if(Database::query("INSERT INTO `threads` (id, forum_id, url_slug, title, author_id, last_poster_id, date_created, date_last_post) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", array($threadID, $forumID, $urlSlug, $title, $uniID, $uniID, $timestamp, $timestamp)))
		{
			// Add the sticky functionality (if applicable)
			if($sticky > 0)
			{
				Database::query("INSERT INTO threads_stickied (forum_id, thread_id, sticky_level) VALUES (?, ?, ?)", array($forumID, $threadID, $sticky));
			}
			
			// Create the actual thread's post
			if(Database::query("UPDATE forums SET last_thread_id=?, last_poster=?, date_lastPost=? WHERE id=? LIMIT 1", array($threadID, $uniID, $timestamp, $forumID)))
			{
				Database::endTransaction();
				return $threadID;
			}
		}
		
		return Database::endTransaction(false);
	}
	
	
/****** Edit an existing Thread ******/
	public static function edit
	(
		int $forumID		// <int> The forum ID that contains the thread you're editing.
	,	int $threadID		// <int> The ID of the thread you're editing.
	,	string $title			// <str> The title of the thread.
	,	int $sticky = 0		// <int> The level of sticky importance (0 to 9).
	): bool					// RETURNS <bool> TRUE on success, or FALSE on failure.
	
	// AppThread::edit($forumID, $threadID, $title, $sticky);
	{
		// Get the Thread Data (to confirm it exists)
		if(!Database::selectValue("SELECT id FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($forumID, $threadID)))
		{
			return false;
		}
		
		// Sticky Check & Modifications
		if($stickyLevel = (int) Database::selectValue("SELECT sticky_level FROM threads_stickied WHERE forum_id=? AND thread_id=? LIMIT 1", array($forumID, $threadID)))
		{
			if($stickyLevel != $sticky)
			{
				AppThread::alterSticky($forumID, $threadID, $sticky);
			}
		}
		
		// Update Title
		return Database::query("UPDATE `threads` SET title=? WHERE forum_id=? AND id=? LIMIT 1", array($title, $forumID, $threadID));
	}
	
}