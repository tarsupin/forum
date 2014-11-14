<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// If you're not logged in
if(!Me::$loggedIn)
{
	header("Location: /"); exit;
}

// Unsubscribe Action
if(isset($_GET['unsub']) and isset($_GET['f']) and isset($_GET['t']))
{
	if(AppSubscriptions::unsubscribe((int) $_GET['f'], (int) $_GET['t'], Me::$id))
	{
		Alert::success("Unsubscribed", "You have successfully unsubscribed from the thread!");
	}
	else
	{
		Alert::error("Unsubscibe Failed", "There was an error trying to unsubscribe from that thread.");
	}
}

// Gather list of subscriptions
$subscriptions = AppSubscriptions::get(Me::$id);

// Update User Activity
UserActivity::update();

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
	<div class="inner-line">
		<div class="inner-name">
			<a href="/' . $sub['forum_slug'] . '/' . $sub['id'] . '-' . $sub['thread_slug'] . '?page=last">' . $sub['title'] . '</a>
			<div class="inner-desc"><a href="/subscriptions?unsub=1&f=' . $sub['forum_id'] . '&t=' . $sub['id'] . '"><span class="icon-circle-close"></span> Unsubscribe</a></div>
		</div>
		<div class="inner-posts">' . $sub['posts'] . '</div>
		<div class="inner-views">' . $sub['views'] . '</div>
		<div class="inner-details"><a href="' . URL::unifaction_social() . '/' . $sub['handle'] . '">@' . $sub['handle'] . '</a> - ' . Time::fuzzy((int) $sub['date_last_post']) . '</div>
	</div>';
}

echo '
	</div>
</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
