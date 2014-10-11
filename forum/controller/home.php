<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Create a notification and sync it
// Notifications::create($uniID, $noteType, $message, [$url], [$senderID], [$sync]);
Notifications::create(1, "Friend Request", "This is a notification about a thing.", "http://unifaction.test", 13, true);

// Run Global Script
require(APP_PATH . "/includes/global.php");

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
		$forum['date_lastPost'] = (int) $forum['date_lastPost'];
		
		// Prepare the details (if available)
		$desc = "";
		
		if($forum['handle'])
		{
			$desc = '
				<a href="/' . $forum['handle'] . '">' . $forum['display_name'] . '</a>
				<br />' . Time::fuzzy($forum['date_lastPost']);
		}
		
		// Display the forum
		echo '
		<div class="inner-line">
			<div class="inner-name">
				<a href="/forum?id=' . $forum['id'] . '">' . $forum['title'] . '</a>
				<div class="inner-desc">' . $forum['description'] . '</div>
			</div>
			<div class="inner-posts">' . $forum['posts'] . '</div>
			<div class="inner-views">' . $forum['views'] . '</div>
			<div class="inner-details">' . $desc . '</div>
		</div>';
	}
	
	echo '
		</div>
	</div>';
}

// Activity Module
/*
echo '
<div style="clear:both; width:100%;">' . AppActivity::getActivityModule(600, 5) . '</div>';
*/

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
