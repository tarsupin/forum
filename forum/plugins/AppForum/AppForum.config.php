<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class AppForum_config {
	
	
/****** Plugin Variables ******/
	public $pluginType = "standard";
	public $pluginName = "AppForum";
	public $title = "Primary Forum Tools";
	public $version = 1.0;
	public $author = "Brint Paris";
	public $license = "UniFaction License";
	public $website = "http://unifaction.com";
	public $description = "Provides the main system tools for the forum.";
	
	public $data = array();
	
	
/****** Install this plugin ******/
	public function install (
	)			// <bool> RETURNS TRUE on success, FALSE on failure.
	
	// $plugin->install();
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
		
		Database::exec("
		CREATE TABLE IF NOT EXISTS `forums`
		(
			`id`					int(10)			unsigned	NOT NULL	AUTO_INCREMENT,
			`category_id`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			`forum_order`			tinyint(2)		unsigned	NOT NULL	DEFAULT '0',
			
			`url_slug`				varchar(45)					NOT NULL	DEFAULT '',
			`title`					varchar(42)					NOT NULL	DEFAULT '',
			`description`			varchar(128)				NOT NULL	DEFAULT '',
			
			`active_hashtag`		varchar(22)					NOT NULL	DEFAULT '',
			
			`posts`					int(10)			unsigned	NOT NULL	DEFAULT '0',
			`views`					int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`last_thread_id`		int(10)			unsigned	NOT NULL	DEFAULT '0',
			`last_poster`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`date_lastPost`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`perm_read`				tinyint(1)		unsigned	NOT NULL	DEFAULT '0',
			`perm_post`				tinyint(1)		unsigned	NOT NULL	DEFAULT '0',
			
			PRIMARY KEY (`id`),
			INDEX (`category_id`, `forum_order`),
			UNIQUE (`url_slug`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
		");
		
		return $this->isInstalled();
	}
	
	
/****** Check if the plugin was successfully installed ******/
	public static function isInstalled (
	)			// <bool> TRUE if successfully installed, FALSE if not.
	
	// $plugin->isInstalled();
	{
		// Make sure the newly installed tables exist
		$pass1 = DatabaseAdmin::columnsExist("forum_categories", array("id", "title"));
		$pass2 = DatabaseAdmin::columnsExist("forums", array("id", "title"));
		
		return ($pass1 and $pass2);
	}
	
}