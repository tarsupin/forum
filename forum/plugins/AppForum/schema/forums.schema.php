<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class forums_schema {
	
	
/****** Plugin Variables ******/
	public $title = "Forums";		// <str> The title for this table.
	public $description = "The list of forums on the site.";		// <str> The description of this table.
	
	// Table Settings
	public $tableKey = "forums";		// <str> The name of the table.
	public $fieldIndex = array("id");	// <int:str> The field(s) used for the index (for editing, deleting, row ID, etc).
	public $autoDelete = false;			// <bool> TRUE will delete rows instantly, FALSE will require confirmation.
	
	// Permissions
	// Note: Set a permission value to 11 or higher to disallow it completely.
	public $permissionView = 5;			// <int> The clearance level required to view this table.
	public $permissionSearch = 5;		// <int> The clearance level required to search this table.
	public $permissionCreate = 6;		// <int> The clearance level required to create an entry on this table.
	public $permissionEdit = 6;			// <int> The clearance level required to edit an entry on this table.
	public $permissionDelete = 6;		// <int> The clearance level required to delete an entry on this table.
	
	
/****** Install the table ******/
	public function install (
	)			// RETURNS <bool> TRUE if the installation was success, FALSE if not.
	
	// $schema->install();
	{
		Database::exec("
		CREATE TABLE IF NOT EXISTS `forums`
		(
			`id`					int(10)			unsigned	NOT NULL	AUTO_INCREMENT,
			`category_id`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			`forum_order`			tinyint(2)		unsigned	NOT NULL	DEFAULT '0',
			
			`title`					varchar(42)					NOT NULL	DEFAULT '',
			`description`			varchar(128)				NOT NULL	DEFAULT '',
			
			`posts`					int(10)			unsigned	NOT NULL	DEFAULT '0',
			`views`					int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`last_thread_id`		int(10)			unsigned	NOT NULL	DEFAULT '0',
			`last_poster`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`date_lastPost`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`perm_read`				tinyint(1)		unsigned	NOT NULL	DEFAULT '0',
			`perm_post`				tinyint(1)		unsigned	NOT NULL	DEFAULT '0',
			
			PRIMARY KEY (`id`),
			INDEX (`category_id`, `forum_order`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
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
		
		$define->set("id")->title("Forum ID")->description("The ID of the forum.")->isUnique()->isReadonly();
		$define->set("category_id")->title("Category ID")->description("The ID of the category that this forum rests in.")->pullType("database", array("table" => "forum_categories", "key" => "id", "value" => "title"));
		$define->set("forum_order")->title("Sort Order")->description("The order that the forum will be listed in.");
		$define->set("title")->description("The title of the forum.");
		$define->set("description")->description("The description of the forum.");
		$define->set("posts")->description("The number of posts in the forum.");
		$define->set("views")->description("The number of views in the forum.");
		$define->set("last_thread_id")->title("Last Thread")->description("The last thread that was posted in this forum.");
		$define->set("last_poster")->title("Last Poster")->description("The UniID of the last person who posted in this forum.");
		$define->set("date_lastPost")->title("Last Post Time")->description("The timestamp of the last time someone posted in this forum.");
		$define->set("perm_read")->title("Clearance to Read")->description("The clearance level required to read this forum.")->pullType("select", "users-clearance");
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
				$schema->addFields("id", "category_id", "forum_order", "title", "posts", "views");
				$schema->sort("category_id");
				$schema->sort("forum_order");
				break;
				
			case "search":
				$schema->addFields("id", "category_id", "title", "description", "posts", "views", "date_lastPost", "perm_read", "perm_post");
				break;
				
			case "create":
				$schema->addFields("id", "category_id", "forum_order", "title", "description", "posts", "views", "perm_read", "perm_post");
				break;
				
			case "edit":
				$schema->addFields("id", "category_id", "forum_order", "title", "description", "posts", "views", "perm_read", "perm_post");
				break;
		}
		
		return $schema;
	}
	
}