<?hh if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Profile Pic Installation
abstract class Install extends Installation {
	
	
/****** Plugin Variables ******/
	
	// These addon plugins will be selected for installation during the "addon" installation process:
	public static array <str, bool> $addonPlugins = array(	// <str:bool>
		"FeaturedWidget"	=> true
	);
	
	
/****** App-Specific Installation Processes ******/
	public static function setup(
	): bool					// RETURNS <bool> TRUE on success, FALSE on failure.
	
	{
		return true;
	}
}