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
	public static function updateUser (
	)				// RETURNS <void>
	
	// AppActivity::updateUser();
	{
		// Update User Activity
		UserActivity::update();
		
		// Prepare essential sessions
		if(!isset($_SESSION[SITE_HANDLE]['forums-new']))
		{
			$_SESSION[SITE_HANDLE]['forums-new'] = array();
		}
		
		if(!isset($_SESSION[SITE_HANDLE]['posts-new']))
		{
			$_SESSION[SITE_HANDLE]['posts-new'] = array();
		}
		
		// Prepare "New Post" Data
		if(!isset($_SESSION[SITE_HANDLE]['new-tracker']))
		{
			$_SESSION[SITE_HANDLE]['new-tracker'] = (Me::$loggedIn and Me::$vals['date_lastVisit']) ? (int) Me::$vals['date_lastVisit'] : time();
		}
		
		// Update the last visit occasionally
		if(Me::$loggedIn and Me::$vals['date_lastVisit'] < time() - 25)
		{
			Me::$vals['date_lastVisit'] = time();
			
			Database::query("UPDATE users SET date_lastVisit=? WHERE uni_id=? LIMIT 1", array(Me::$vals['date_lastVisit'], Me::$id));
		}
	}
	
	
/****** Get User Activity Module ******/
	public static function getActivityModule
	(
		$duration = 600	// <int> The duration across which to monitor the module's activity.
	,	$refresh = 45	// <int> The amount of time (in seconds) before refreshing the module.
	)					// RETURNS <void>
	
	// echo AppActivity::getActivityModule($duration, $refresh);
	{
		if(!$cache = CacheFile::load("usersOn-" . SITE_HANDLE, $refresh))
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
			
			CacheFile::save("usersOn-" . SITE_HANDLE, $html);
			$cache = CacheFile::load("usersOn-" . SITE_HANDLE);
		}
		
		// Display the module, if loaded
		if($cache)
		{
			echo '<div class="overwrap-box overwrap-module"><div class="overwrap-line" style="font-size:1.0em;">Users Online</div><div class="inner-box"><div style="padding:6px;">' . $cache . '</div></div></div>';
		}
	}
}
