<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Update User Activity
AppActivity::updateUser();

// Run Global Script
require(CONF_PATH . "/includes/global.php");

// Display the Header
require(SYS_PATH . "/controller/includes/metaheader.php");
require(SYS_PATH . "/controller/includes/header.php");

// Display Side Panel
require(SYS_PATH . "/controller/includes/side-panel.php");

echo '
<div id="panel-right"></div>
<div id="content">' . Alert::display();

// Cycle through categories
$categories = AppForum::getCategories();

foreach($categories as $cat)
{
	// Gather all forums
	$forums = AppForum::getForums($cat['id']);
	
	// Skip this category if there are no forums you can view
	if(count($forums) < 1) { continue; }
	
	// Display the category
	echo '
	<div class="overwrap-box">
		<div class="overwrap-line">
			<div class="overwrap-name">' . $cat['title'] . '</div>
			<div class="overwrap-posts">Posts</div>
			<div class="overwrap-views">Views</div>
			<div class="overwrap-details">Details</div>
		</div>
		<div class="inner-box">';
	
	foreach($forums as $forum)
	{
		$forum['id'] = (int) $forum['id'];
		
		// Check for the New Icon
		if($newIcon = ($forum['date_lastPost'] > $_SESSION[SITE_HANDLE]['new-tracker']) ? true : false)
		{
			if(isset($_SESSION[SITE_HANDLE]['forums-new'][$forum['id']]))
			{
				if($newIcon = ($forum['date_lastPost'] > ($_SESSION[SITE_HANDLE]['new-tracker'] + $_SESSION[SITE_HANDLE]['forums-new'][$forum['id']])) ? true : false)
				{
					unset($_SESSION[SITE_HANDLE]['forums-new'][$forum['id']]);
				}
			}
		}
		
		// Display the Forum Line
		AppForum::displayLine($forum, $newIcon);
	}
	
	echo '
		</div>
	</div>';
}

// Activity Module
echo '
<div style="clear:both; width:100%;">' . AppActivity::getActivityModule(600, 30) . '</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
