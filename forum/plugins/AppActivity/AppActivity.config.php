<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class AppActivity_config {
	
	
/****** Plugin Variables ******/
	public $pluginType = "standard";
	public $pluginName = "AppActivity";
	public $title = "Forum Activity";
	public $version = 1.0;
	public $author = "Brint Paris";
	public $license = "UniFaction License";
	public $website = "http://unifaction.com";
	public $description = "Tracks activity on the forum.";
	
	public $data = array();
	
	
/****** Install this plugin ******/
	public function install (
	)			// <bool> RETURNS TRUE on success, FALSE on failure.
	
	// $plugin->install();
	{
		DatabaseAdmin::addColumn("users", "date_lastVisit", "int(10) unsigned not null", 0);
		
		return $this->isInstalled();
	}
	
	
/****** Check if the plugin was successfully installed ******/
	public static function isInstalled (
	)			// <bool> TRUE if successfully installed, FALSE if not.
	
	// $plugin->isInstalled();
	{
		// Make sure the newly installed tables exist
		return DatabaseAdmin::columnsExist("users", array("date_lastVisit"));
	}
	
}