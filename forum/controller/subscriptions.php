<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Gather list of subscriptions
$subscriptions = AppSubscriptions::get(Me::$id);

// Run Global Script
require(CONF_PATH . "/includes/global.php");

// Display the Header
require(SYS_PATH . "/controller/includes/metaheader.php");
require(SYS_PATH . "/controller/includes/header.php");

// Display Side Panel
require(SYS_PATH . "/controller/includes/side-panel.php");

echo '
<div id="content">
' . Alert::display();

echo '
<div class="overwrap-box">
	<div class="overwrap-line">
		<div class="overwrap-name">My Subscriptions</div>
		<div class="overwrap-posts">Posts</div>
		<div class="overwrap-views">Views</div>
		<div class="overwrap-details">Details</div>
	</div>
	<div class="inner-box">';

if(count($subscriptions) == 0)
{
	echo '
	<div class="inner-line">You do not have any subscriptions.</div>';
}

foreach($subscriptions as $sub)
{
	echo '
	<a href="/thread?forum=' . $sub['forum_id'] . '&id=' . $sub['id'] . '">
	<div class="inner-line">
		<div class="inner-name">
			' . $sub['title'] . '
			<div class="inner-desc">' . ($sub['new_posts'] > 0 ? 'New Posts!' : '&nbsp;') . '</div>
		</div>
		<div class="inner-posts">' . $sub['posts'] . '</div>
		<div class="inner-views">' . $sub['views'] . '</div>
		<div class="inner-details"><strong>Last Post:</strong><br />' . Time::fuzzy((int) $sub['date_last_post']) . '</div>
	</div>
	</a>';
}

echo '
	</div>
</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
