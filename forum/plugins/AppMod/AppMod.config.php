<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

class AppMod_config {
	
	
/****** Plugin Variables ******/
	public $pluginType = "standard";
	public $pluginName = "AppMod";
	public $title = "Mod Functions";
	public $version = 1.0;
	public $author = "Brint Paris";
	public $license = "UniFaction License";
	public $website = "http://unifaction.com";
	public $description = "Provides moderating tools for the forum";
	public $dependencies = array("SiteReport");
	
	public $data = array();
	
}