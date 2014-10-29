<?hh if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

abstract class AppActivity {

/****** AppActivity Class ******
* This class allows you to manage the user activity bar.
* 
****** Examples of using this class ******



****** Methods Available ******
* AppActivity::deleteThread($forumID, $threadID);
* AppActivity::deletePost($threadID, $postID);
*/
	
	
/****** Get User Activity Module ******/
	public static function getActivityModule
	(
		int $duration = 600	// <int> The duration across which to monitor the module's activity.
	,	int $refresh = 120	// <int> The amount of time before refreshing the module.
	): void					// RETURNS <void>
	
	// echo AppActivity::getActivityModule($duration, $refresh);
	{
		if(!CacheFile::load("activityModule", $refresh))
		{
			// Recover activity within the duration provided
			$activeUsers = Analytics::getUserActivity($duration);
			
			$socialURL = URL::unifaction_social();
			$html = "";
			
			foreach($activeUsers['users'] as $user)
			{
				$html .= ($html == "" ? "" : ", ") . '<a' . ($user['role'] != "" ? ' class="user-role-' . $user['role'] . '"' : '') . ' href="' . $socialURL . '/' . $user['handle'] . '">' . $user['display_name'] . '</a>';
			}
			
			// Prepend the Guest Count
			$html = "Guests: " . ($activeUsers['guests'] + 0) . '. ' . $html;
			
			CacheFile::save("activityModule", $html);
			CacheFile::load("activityModule");
		}
	}
}