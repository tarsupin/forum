<?hh if(!defined("CONF_PATH")) { die("No direct script access allowed."); } /*

--------------------------------------------
------ About the AppForumAvatar Class ------
--------------------------------------------

This plugin allows you to handle avatars on a forum.


-------------------------------
------ Methods Available ------
-------------------------------

AppForumAvatar::confirmAvi($uniID);

*/

abstract class AppForumAvatar {
	
	
/****** Confirm that a user has an avatar ******/
	public static function confirmAvi
	(
		int $uniID		// <int> The UniID to confirm if they have an avatar or not.
	): bool				// RETURNS <bool> TRUE on success, REDIRECT on failure.
	
	// AppForumAvatar::confirmAvi($uniID);
	{
		if(Me::$vals['has_avatar'] == 1) { return true; }
		
		// Check the Avatar API
		if($response = Connect::to("avatar", "AvatarExists", array("uni_id" => Me::$id)))
		{
			// Update user to list avatar as active
			Database::query("UPDATE users SET has_avatar=? WHERE uni_id=? LIMIT 1", array(1, $uniID));
			return true;
		}
		
		// Redirect to the avatar site to create a avatar
		header("Location: " . URL::avatar_unifaction_com() . "/"); exit;
	}
}