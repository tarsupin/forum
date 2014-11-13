<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class AppPost_config {
	
	
/****** Plugin Variables ******/
	public $pluginType = "standard";
	public $pluginName = "AppPost";
	public $title = "Post Handler";
	public $version = 1.0;
	public $author = "Brint Paris";
	public $license = "UniFaction License";
	public $website = "http://unifaction.com";
	public $description = "Provides tools for working with posts.";
	
	public $data = array();
	
	
/****** Install this plugin ******/
	public function install (
	)			// <bool> RETURNS TRUE on success, FALSE on failure.
	
	// $plugin->install();
	{
		Database::exec("
		CREATE TABLE IF NOT EXISTS `posts`
		(
			`thread_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`id`					int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`uni_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`avi_id`				tinyint(1)		unsigned	NOT NULL	DEFAULT '0',
			
			`body`					text						NOT NULL	DEFAULT '',
			`likes`					tinyint(3)		unsigned	NOT NULL	DEFAULT '0',
			
			`date_post`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			UNIQUE (`thread_id`, `id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 PARTITION BY KEY(thread_id) PARTITIONS 23;
		");
		
		Database::exec("
		CREATE TABLE IF NOT EXISTS `posts_likes`
		(
			`post_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`uni_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			UNIQUE (`post_id`, `uni_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 PARTITION BY KEY(post_id) PARTITIONS 5;
		");
		
		Database::exec("
		CREATE TABLE IF NOT EXISTS `posts_recent`
		(
			`date_posted`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`thread_title`			varchar(72)					NOT NULL	DEFAULT '',
			`thread_posts`			mediumint(6)	unsigned	NOT NULL	DEFAULT '0',
			`thread_views`			int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`post_link`				varchar(120)				NOT NULL	DEFAULT '',
			`post_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`poster_handle`			varchar(22)					NOT NULL	DEFAULT '',
			`uni_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`body`					varchar(255)				NOT NULL	DEFAULT '',
			
			INDEX (`date_posted`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		");
		
		// Add user post count
		DatabaseAdmin::addColumn("users", "post_count", "mediumint(6) unsigned not null", 0);
		
		return $this->isInstalled();
	}
	
	
/****** Check if the plugin was successfully installed ******/
	public static function isInstalled (
	)			// <bool> TRUE if successfully installed, FALSE if not.
	
	// $plugin->isInstalled();
	{
		// Make sure the newly installed tables exist
		$pass1 = DatabaseAdmin::columnsExist("posts", array("id", "thread_id"));
		$pass2 = DatabaseAdmin::columnsExist("posts_likes", array("post_id", "uni_id"));
		$pass3 = DatabaseAdmin::columnsExist("posts_recent", array("date_posted", "post_id"));
		$pass4 = DatabaseAdmin::columnsExist("users", array("post_count"));
		
		return ($pass1 and $pass2 and $pass3 and $pass4);
	}
	
}