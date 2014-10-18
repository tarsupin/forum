<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class AppSubscriptions_config {
	
	
/****** Plugin Variables ******/
	public $pluginType = "standard";
	public $pluginName = "AppSubscriptions";
	public $title = "Thread Handler";
	public $version = 1.0;
	public $author = "Brint Paris";
	public $license = "UniFaction License";
	public $website = "http://unifaction.com";
	public $description = "Set and interact with the subscriptions.";
	
	public $data = array();
	
	
/****** Install this plugin ******/
	public function install (
	)			// <bool> RETURNS TRUE on success, FALSE on failure.
	
	// $plugin->install();
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
		
		Database::exec("
		CREATE TABLE IF NOT EXISTS `thread_subs_by_user`
		(
			`uni_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`forum_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			`thread_id`				int(10)			unsigned	NOT NULL	DEFAULT '0',
			
			`new_posts`				tinyint(1)		unsigned	NOT NULL	DEFAULT '0',
			
			INDEX (`uni_id`, `forum_id`, `thread_id`)
			
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 PARTITION BY KEY(uni_id) PARTITIONS 23;
		");
		
		return $this->isInstalled();
	}
	
	
/****** Check if the plugin was successfully installed ******/
	public static function isInstalled (
	)			// <bool> TRUE if successfully installed, FALSE if not.
	
	// $plugin->isInstalled();
	{
		// Make sure the newly installed tables exist
		$pass1 = DatabaseAdmin::columnsExist("thread_subs", array("forum_id", "thread_id"));
		$pass2 = DatabaseAdmin::columnsExist("thread_subs_by_user", array("uni_id", "forum_id"));
		
		return ($pass1 and $pass2);
	}
	
}