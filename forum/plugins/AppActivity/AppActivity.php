<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); } /*

------------------------------------------
------ About the AppActivity Plugin ------
------------------------------------------

This plugin allows you to load the user activity bar.

-------------------------------
------ Methods Available ------
-------------------------------

*/

abstract class AppActivity {
	
	
/****** Get User Activity Module ******/
	public static function getActivityModule
	(
		$duration = 600	// <int> The duration across which to monitor the module's activity.
	,	$refresh = 45	// <int> The amount of time (in seconds) before refreshing the module.
	)					// RETURNS <void>
	
	// echo AppActivity::getActivityModule($duration, $refresh);
	{
		if(!$cache = CacheFile::load("onlineUserActivity", $refresh))
		{
			// Recover activity within the duration provided
			$activeUsers = UserActivity::getUsersOnline($duration);
			$userCount = UserActivity::getUsersOnlineCount($duration);
			$guestCount = UserActivity::getGuestsOnlineCount($duration);
			
			$socialURL = URL::unifaction_social();
			$html = "";
			
			foreach($activeUsers as $user)
			{
				$html .= ($html == "" ? "" : ", ") . '<a' . ($user['role'] != "" ? ' class="user-role-' . $user['role'] . '"' : '') . ' href="' . $socialURL . '/' . $user['handle'] . '">' . $user['handle'] . '</a>';
			}
			
			// Prepend the Guest Count
			$html = ($guestCount + 0) . " Guests, " . ($userCount + 0) . " Users: " . $html;
			
			CacheFile::save("onlineUserActivity", $html);
			$cache = CacheFile::load("onlineUserActivity");
		}
		
		// Display the module, if loaded
		if($cache)
		{
			echo '<div class="overwrap-box"><div style="font-weight:bold;">Users Online</div><div class="inner-box"><div style="padding:6px;">' . $cache . '</div></div></div>';
		}
	}
}
