<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class thread_subs_schema {
	
	
/****** Plugin Variables ******/
	public $title = "Thread Subscriptions";		// <str> The title for this table.
	public $description = "The list of user's subscriptions to threads.";		// <str> The description of this table.
	
	// Table Settings
	public $tableKey = "thread_subs";		// <str> The name of the table.
	public $fieldIndex = array("forum_id", "thread_id", "uni_id");	// <int:str> The field(s) used for the index (for editing, deleting, row ID, etc).
	public $autoDelete = false;			// <bool> TRUE will delete rows instantly, FALSE will require confirmation.
	
	// Permissions
	// Note: Set a permission value to 11 or higher to disallow it completely.
	public $permissionView = 6;			// <int> The clearance level required to view this table.
	public $permissionSearch = 6;		// <int> The clearance level required to search this table.
	public $permissionCreate = 11;		// <int> The clearance level required to create an entry on this table.
	public $permissionEdit = 11;		// <int> The clearance level required to edit an entry on this table.
	public $permissionDelete = 11;		// <int> The clearance level required to delete an entry on this table.
	
	
/****** Install the table ******/
	public function install (
	)			// RETURNS <bool> TRUE if the installation was success, FALSE if not.
	
	// $schema->install();
	{
		Database::exec("
		CREATE TABLE IF NOT EXISTS `thread_subs`
		(
			`forum_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`thread_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`uni_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			INDEX (`forum_id`, `thread_id`, `uni_id`)
			
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 PARTITION BY KEY(forum_id, thread_id) PARTITIONS 23;
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
		
		$define->set("forum_id")->title("Forum ID")->description("The ID of the forum the contains the subscribed thread.")->isReadonly();
		$define->set("thread_id")->title("Thread ID")->description("The ID of the thread being subscribed to.")->isReadonly();
		$define->set("uni_id")->title("UniID")->description("The UniID of the subscriber.")->isReadonly();
		
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
				$schema->addFields("forum_id", "thread_id", "uni_id");
				$schema->sort("forum_id");
				$schema->sort("thread_id");
				$schema->sort("uni_id");
				break;
				
			case "search":
				$schema->addFields("forum_id", "thread_id", "uni_id");
				break;
				
			case "create":
			case "edit":
				break;
		}
		
		return $schema;
	}
	
}