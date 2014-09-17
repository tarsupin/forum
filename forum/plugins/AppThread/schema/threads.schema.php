<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class threads_schema {
	
	
/****** Plugin Variables ******/
	public $title = "Threads";		// <str> The title for this table.
	public $description = "Stores the threads on the site.";		// <str> The description of this table.
	
	// Table Settings
	public $tableKey = "threads";		// <str> The name of the table.
	public $fieldIndex = array("forum_id", "id");	// <int:str> The field(s) used for the index (for editing, deleting, row ID, etc).
	public $autoDelete = false;			// <bool> TRUE will delete rows instantly, FALSE will require confirmation.
	
	// Permissions
	// Note: Set a permission value to 11 or higher to disallow it completely.
	public $permissionView = 6;			// <int> The clearance level required to view this table.
	public $permissionSearch = 6;		// <int> The clearance level required to search this table.
	public $permissionCreate = 11;		// <int> The clearance level required to create an entry on this table.
	public $permissionEdit = 6;			// <int> The clearance level required to edit an entry on this table.
	public $permissionDelete = 11;		// <int> The clearance level required to delete an entry on this table.
	
	
/****** Install the table ******/
	public function install (
	)			// RETURNS <bool> TRUE if the installation was success, FALSE if not.
	
	// $schema->install();
	{
		Database::exec("
		CREATE TABLE IF NOT EXISTS `threads`
		(
			`id`					int(10)			unsigned	NOT NULL	DEFAULT '0',
			`forum_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`posts`					mediumint(8)	unsigned	NOT NULL	DEFAULT '0',
			`views`					mediumint(8)	unsigned	NOT NULL	DEFAULT '0',
			`title`					varchar(48)					NOT NULL	DEFAULT '',
			
			`author_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`last_poster_id`		int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`date_created`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			`date_last_post`		int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`perm_post`				tinyint(1)		unsigned	NOT NULL	DEFAULT '0',
			
			INDEX (`forum_id`, `id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 PARTITION BY KEY(forum_id) PARTITIONS 13;
		");
		
		return DatabaseAdmin::tableExists($this->tableKey);
	}
	
	
/****** Build the schema for the table ******/
	public function buildSchema (
	)			// RETURNS <bool> TRUE on success, FALSE on failure.
	
	// $schema->buildSchema();
	{
		Database::startTransaction();
		
		// Create Schmea
		$define = new SchemaDefine($this->tableKey, true);
		
		$define->set("id")->title("Thread ID")->description("The ID of the thread.")->isUnique()->isReadonly();
		$define->set("forum_id")->title("Forum ID")->description("The ID of the forum that the thread belongs to.");
		$define->set("posts")->description("The number of posts in the thread.");
		$define->set("views")->description("The number of views in the thread.");
		$define->set("title")->description("The title of the thread.");
		$define->set("author_id")->title("Author")->description("The UniID of the last person who posted in this thread.");
		$define->set("last_poster_id")->title("Last Poster")->description("The UniID of the last person who posted in this thread.");
		$define->set("date_created")->title("Date Created")->description("The timestamp of the time this thread was created.")->fieldType("timestamp");
		$define->set("date_last_post")->title("Last Post Time")->description("The timestamp of the last time someone posted in this thread.")->fieldType("timestamp");
		$define->set("perm_post")->title("Clearance to Post")->description("The clearance level required to post on this forum.")->pullType("select", "users-clearance");
		
		Database::endTransaction();
		
		return true;
	}
	
	
/****** Set the rules for interacting with this table ******/
	public function __call
	(
		$name		// <str> The name of the method being called ("view", "search", "create", "delete")
	,	$args		// <mixed> The args sent with the function call (generaly the schema object)
	)				// RETURNS <mixed> The resulting schema object.
	
	// $schema->view($schema);		// Set the "view" options
	// $schema->search($schema);	// Set the "search" options
	{
		// Make sure that the appropriate schema object was sent
		if(!isset($args[0])) { return; }
		
		// Set the schema object
		$schema = $args[0];
		
		switch($name)
		{
			case "view":
				$schema->addFields("id", "forum_id", "posts", "views", "title", "author_id", "last_poster_id", "date_created", "date_last_post", "perm_post");
				$schema->sort("forum_id");
				$schema->sort("id");
				break;
				
			case "search":
				$schema->addFields("id", "forum_id", "title", "author_id", "date_created", "date_last_post");
				break;
				
			case "create":
				break;
				
			case "edit":
				$schema->addFields("id", "forum_id", "posts", "views", "title", "author_id", "last_poster_id", "date_created", "date_last_post", "perm_post");
				break;
		}
		
		return $schema;
	}
	
}