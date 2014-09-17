<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class posts_schema {
	
	
/****** Plugin Variables ******/
	public $title = "Posts";		// <str> The title for this table.
	public $description = "The thread posts.";		// <str> The description of this table.
	
	// Table Settings
	public $tableKey = "posts";		// <str> The name of the table.
	public $fieldIndex = array("thread_id", "id");	// <int:str> The field(s) used for the index (for editing, deleting, row ID, etc).
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
		CREATE TABLE IF NOT EXISTS `posts`
		(
			`thread_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`id`					int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`uni_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`body`					text						NOT NULL	DEFAULT '',
			
			`date_post`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			UNIQUE (`thread_id`, `id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 PARTITION BY KEY(thread_id) PARTITIONS 23;
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
		
		$define->set("id")->title("Post ID")->description("The ID of the post.")->isUnique()->isReadonly();
		$define->set("thread_id")->title("Thread ID")->description("The ID of the thread that the post belongs to.")->isReadonly();
		$define->set("uni_id")->title("Author ID")->description("The UniID of the person who posted this.")->isReadonly();
		$define->set("body")->title("Message")->description("The message text of the post.");
		$define->set("date_post")->title("Date Posted")->description("The timestamp of when this post was created.")->fieldType("timestamp");
		
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
				$schema->addFields("id", "thread_id", "uni_id", "body", "date_post");
				$schema->sort("thread_id");
				$schema->sort("id");
				break;
				
			case "search":
				$schema->addFields("id", "thread_id", "uni_id", "body", "date_post");
				break;
				
			case "create":
				break;
				
			case "edit":
				$schema->addFields("id", "thread_id", "uni_id", "body", "date_post");
				break;
		}
		
		return $schema;
	}
	
}