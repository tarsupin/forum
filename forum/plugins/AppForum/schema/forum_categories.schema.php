<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class forum_categories_schema {
	
	
/****** Plugin Variables ******/
	public $title = "Forum Categories";		// <str> The title for this table.
	public $description = "Contains the forum categories for the site.";		// <str> The description of this table.
	
	// Table Settings
	public $tableKey = "forum_categories";			// <str> The name of the table.
	public $fieldIndex = array("id");		// <int:str> The field(s) used for the index (for editing, deleting, row ID, etc).
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
		CREATE TABLE IF NOT EXISTS `forum_categories`
		(
			`id`					int(10)			unsigned	NOT NULL	AUTO_INCREMENT,
			`parent_forum`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			`cat_order`				tinyint(2)		unsigned	NOT NULL	DEFAULT '0',
			
			`title`					varchar(32)					NOT NULL	DEFAULT '',
			
			PRIMARY KEY (`id`),
			INDEX (`parent_forum`, `cat_order`)
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
		
		$define->set("id")->title("Category ID")->description("T")->isUnique()->isReadonly();
		$define->set("parent_forum")->description("The forum ID that this category belongs to.")->pullType("database", array("table" => "forums", "key" => "id", "value" => "title"));
		$define->set("cat_order")->title("Sort Order")->description("The order that the category will be listed in.");
		$define->set("title")->description("The title of the category.");
		
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
				$schema->addFields("id", "parent_forum", "title", "cat_order");
				$schema->sort("id");
				break;
				
			case "search":
				$schema->addFields("id", "parent_forum", "title", "cat_order");
				break;
				
			case "create":
				$schema->addFields("id", "parent_forum", "title", "cat_order");
				break;
				
			case "edit":
				$schema->addFields("id", "parent_forum", "title", "cat_order");
				break;
		}
		
		return $schema;
	}
	
}