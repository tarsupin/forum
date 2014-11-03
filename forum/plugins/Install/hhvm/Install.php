<?hh if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Forum Installation
abstract class Install extends Installation {
	
	
/****** Plugin Variables ******/
	public static array <str, bool> $addonPlugins = array(		// <str:bool>
		"Avatar"			=> true
	,	"UserActivity"		=> true
	,	"Notifications"		=> true
	);
	
/****** App-Specific Installation Processes ******/
	public static function setup(
	): bool					// RETURNS <bool> TRUE on success, FALSE on failure.
	
	{
		// Add UniqueID Trackers
		UniqueID::newCounter("thread");
		UniqueID::newCounter("post");
		
		// Run the generation script for this site
		if(File::exists(CONF_PATH . "/generate-script.php"))
		{
			define("GENERATE_FORUM_DATA", true);
			
			require(CONF_PATH . "/generate-script.php");
		}
		
		return true;
	}
}