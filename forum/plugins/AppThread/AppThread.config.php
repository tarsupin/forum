<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class AppThread_config {
	
	
/****** Plugin Variables ******/
	public $pluginType = "standard";
	public $pluginName = "AppThread";
	public $title = "Thread Handler";
	public $version = 1.0;
	public $author = "Brint Paris";
	public $license = "UniFaction License";
	public $website = "http://unifaction.com";
	public $description = "Provides tools for working with forum threads.";
	
	public $data = array();
	
	
/****** Install this plugin ******/
	public function install (
	)			// <bool> RETURNS TRUE on success, FALSE on failure.
	
	// $plugin->install();
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
		
		Database::exec("
		CREATE TABLE IF NOT EXISTS `threads_stickied`
		(
			`forum_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`thread_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`sticky_level`			tinyint(1)		unsigned	NOT NULL	DEFAULT '0',
			
			UNIQUE (`forum_id`, `sticky_level`, `thread_id`)
			
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
		$pass1 = DatabaseAdmin::columnsExist("threads", array("id", "forum_id"));
		$pass2 = DatabaseAdmin::columnsExist("threads_stickied", array("forum_id", "thread_id"));
		
		return ($pass1 and $pass2);
	}
	
}