<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// If you're not logged in
if(!Me::$loggedIn)
{
	header("Location: /"); exit;
}

// Unsubscribe Action
if(isset($_GET['unsub']) and isset($_GET['f']))
{
	if(isset($_GET['t']))
	{
		if(AppSubscriptions::unsubscribe((int) $_GET['f'], (int) $_GET['t'], Me::$id))
		{
			Alert::success("Unsubscribed", "You have successfully unsubscribed from the thread!");
		}
		else
		{
			Alert::error("Unsubscribe Failed", "There was an error trying to unsubscribe from that thread.");
		}
	}
	else
	{
		if(AppSubscriptions::unsubscribeForum((int) $_GET['f'], Me::$id))
		{
			Alert::success("Unsubscribed", "You have successfully unsubscribed from the forum!");
		}
		else
		{
			Alert::error("Unsubscribe Failed", "There was an error trying to unsubscribe from that forum.");
		}
	}
}

// Gather list of subscriptions
$subscriptions = AppSubscriptions::get(Me::$id);
$subscriptionsForum = AppSubscriptions::getForum(Me::$id);

// Update User Activity
UserActivity::update();

$config['pageTitle'] = $config['site-name'] . " > Subscriptions";

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
		<div class="overwrap-name">My Thread Subscriptions</div>
		<div class="overwrap-posts">Posts</div>
		<div class="overwrap-views">Views</div>
		<div class="overwrap-details">Details</div>
	</div>
	<div class="inner-box">';

if(count($subscriptions) == 0)
{
	echo '
	<div class="inner-line">You do not have any thread subscriptions.</div>';
}

foreach($subscriptions as $sub)
{
	echo '
	<div class="inner-line">
		<div class="inner-name">
			' . ($sub['new_posts'] ? '<img src="' . CDN . '/images/new.png" /> ' :  '') . '<a href="/' . $sub['forum_slug'] . '/' . $sub['id'] . '-' . $sub['thread_slug'] . '?page=last">' . $sub['title'] . '</a>
			<div class="inner-desc"><a href="/subscriptions?unsub=1&f=' . $sub['forum_id'] . '&t=' . $sub['id'] . '"><span class="icon-circle-close"></span> Unsubscribe</a></div>
		</div>
		<div class="inner-posts">' . $sub['posts'] . '</div>
		<div class="inner-views">' . $sub['views'] . '</div>
		<div class="inner-details"><a '. ($sub['role'] != '' ? 'class="role-' . $sub['role'] . '" ' : '') . 'href="' . URL::unifaction_social() . '/' . $sub['handle'] . '">@' . $sub['handle'] . '</a> - ' . Time::fuzzy((int) $sub['date_last_post']) . '</div>
	</div>';
}

echo '
	</div>
</div>';

echo '
<div class="overwrap-box">
	<div class="overwrap-line">
		<div class="overwrap-name">My Forum Subscriptions</div>
		<div class="overwrap-posts">Posts</div>
		<div class="overwrap-views">Views</div>
		<div class="overwrap-details">Details</div>
	</div>
	<div class="inner-box">';

if(count($subscriptionsForum) == 0)
{
	echo '
	<div class="inner-line">You do not have any forum subscriptions.</div>';
}

foreach($subscriptionsForum as $sub)
{
	echo '
	<div class="inner-line">
		<div class="inner-name">
			<a href="/' . $sub['forum_slug'] . '">' . $sub['title'] . '</a>
			<div class="inner-desc"><a href="/subscriptions?unsub=1&f=' . $sub['id'] . '"><span class="icon-circle-close"></span> Unsubscribe</a></div>
		</div>
		<div class="inner-posts">' . $sub['posts'] . '</div>
		<div class="inner-views">' . $sub['views'] . '</div>
		<div class="inner-details"><a '. ($sub['role'] != '' ? 'class="role-' . $sub['role'] . '" ' : '') . 'href="' . URL::unifaction_social() . '/' . $sub['handle'] . '">@' . $sub['handle'] . '</a> - ' . Time::fuzzy((int) $sub['date_lastPost']) . '</div>
	</div>';
}

echo '
	</div>
</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
