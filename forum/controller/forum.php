<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

/*
	$forum		// `id, url_slug, active_hashtag, title, perm_read`
*/

// Leave this page if it wasn't accessed properly
if(!isset($forum))
{
	header("Location: /"); exit;
}

// Recognize Integers
$forum['id'] = (int) $forum['id'];
$forum['perm_read'] = (int) $forum['perm_read'];

// Ensure if you have proper permissions to access this forum
$clearance = (isset(Me::$vals['clearance']) ? Me::$vals['clearance'] : 0);

if($forum['perm_read'] > $clearance)
{
	header("Location: /"); exit;
}

// View the Forum (increase view count)
AppForum::view($forum);

// Prepare Values
$_GET['page'] = (isset($_GET['page']) ? (int) $_GET['page'] : 1);
$pageList = "";
$threadsToShow = 20;
$postsPerPage = 20;
$subData = array();

// Check your Subscription
if(Me::$loggedIn)
{
	$subData = AppSubscriptions::getDataForum(Me::$id, $forum['id']);
	
	// Run Actions
	if(isset($_GET['action']))
	{
		// Subscribe to the Forum
		if($_GET['action'] == "subscribe")
		{
			if(AppSubscriptions::subscribeForum($forum['id'], Me::$id))
			{
				$subData = array('uni_id' => Me::$id);
				Alert::success("Subscribed", "You are now subscribed to \"" . $forum['title'] . "\"!");
			}
		}
		
		// Unsubscribe from the Forum
		else if($_GET['action'] == "unsubscribe")
		{
			if(AppSubscriptions::unsubscribeForum($forum['id'], Me::$id))
			{
				$subData = array();
				Alert::success("Unsubscribed", "You are now unsubscribed from \"" . $forum['title'] . "\"!");
			}
		}
	}
}

if($_GET['page'] > 1)
{
	$pageList .= '<a href="/' . $forum['url_slug'] . '?page=' . ($_GET['page'] - 1) . '"><span class="icon-arrow-left"></span> Previous Page</a>';
}

$socialURL = URL::social_unifaction_com();

// Get Stickied Thread
$sThreads = array();
$stickied = AppForum::getStickied($forum['id'], $_GET['page']);

foreach($stickied as $st)
{
	$sThreads[] = $st['id'];
}

// Get Forum Threads
$threads = AppForum::getThreads($forum['id'], $_GET['page'], $threadsToShow);

if(count($threads) > $threadsToShow)
{
	if($_GET['page'] > 1)
	{
		$pageList .= ' ';
	}
	$pageList .= '<a href="/' . $forum['url_slug'] . '?page=' . ($_GET['page'] + 1) . '">Next Page <span class="icon-arrow-right"></span></a>';
	array_pop($threads);
}

// Get Forum Breadcrumbs
$breadcrumbs = AppForum::getBreadcrumbs($forum);
array_pop($breadcrumbs); // remove the final breadcrumb (this forum)

// Prepare Active Hashtag
$config['active-hashtag'] = $forum['active_hashtag'];

// Update Activity
AppActivity::updateUser();

// Update the last time viewing this forum
$_SESSION[SITE_HANDLE]['forums-new'][$forum['id']] = time() - $_SESSION[SITE_HANDLE]['new-tracker'];

$config['pageTitle'] = $config['site-name'] . " > " . $forum['title'];

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

echo '
<div class="thread-tline">';

// Draw the Breadcrumb Trail
$comma = '';
foreach($breadcrumbs as $crumb)
{
	echo $comma . '
	<a href="' . $crumb[0] . '">' . $crumb[1] . '</a>';
	
	$comma = ' &gt; ';
}

echo ' &gt; ' . $forum['title'] . '
</div>';

// Display Sub-Forums, if applicable
if($forum['has_children'])
{
	// Gather all sub-forums
	$subforums = AppForum::getSubforums($forum['id']);
	
	// Skip this category if there are no forums you can view
	if(count($subforums) < 1) { continue; }
	
	// Display the category
	echo '
	<div class="overwrap-box">
		<div class="overwrap-line">
			<div class="overwrap-name">' . $forum['title'] . '</div>
			<div class="overwrap-posts">Posts</div>
			<div class="overwrap-views">Views</div>
			<div class="overwrap-details">Details</div>
		</div>
		<div class="inner-box">';
	
	foreach($subforums as $sub)
	{
		$sub['id'] = (int) $sub['id'];
		
		// Check for the New Icon
		if($newIcon = ($sub['date_lastPost'] > $_SESSION[SITE_HANDLE]['new-tracker']) ? true : false)
		{
			if(isset($_SESSION[SITE_HANDLE]['forums-new'][$sub['id']]))
			{
				if($newIcon = ($sub['date_lastPost'] > ($_SESSION[SITE_HANDLE]['new-tracker'] + $_SESSION[SITE_HANDLE]['forums-new'][$sub['id']])) ? true : false)
				{
					unset($_SESSION[SITE_HANDLE]['forums-new'][$sub['id']]);
				}
			}
		}
		
		// Display the sub-forum Line
		AppForum::displayLine($sub, $newIcon);
	}
	
	echo '
		</div>
	</div>';
}

echo '
<div class="thread-tline">';
if(Me::$loggedIn)
{
	echo '
	<a href="/new-thread?forum=' . $forum['id'] . '">New Thread</a>';
	if($subData)
	{
		echo '
	<a href="/' . $forum['url_slug'] . '?action=unsubscribe">Unsubscribe</a>';
	}
	else
	{
		echo '
	<a href="/' . $forum['url_slug'] . '?action=subscribe">Subscribe</a>';
	}
}
echo '
	' . ($pageList ? '<div style="float:right;">' . $pageList . '</div>' : "") .'
</div>';

echo '
<div class="overwrap-box">
	<div class="overwrap-line">
		<div class="overwrap-name">Threads</div>
		<div class="overwrap-posts">Posts</div>
		<div class="overwrap-views">Views</div>
		<div class="overwrap-details">Details</div>
	</div>
	<div class="inner-box">';
	
// Cycle through stickied threads (if first page)
if($_GET['page'] == 1 && count($stickied) > 0)
{
	foreach($stickied as $stick)
	{
		// Draw Description
		$drawDesc = "";
		
		if($stick['posts'] > $postsPerPage)
		{
			$paginate = new Pagination((int) $stick['posts'], $postsPerPage, 1, "division");
			
			foreach($paginate->pages as $page)
			{
				$drawDesc .= '
					<a href="/' . $forum['url_slug'] . '/' . $stick['id'] . '-' . $stick['url_slug'] . '?page=' . $page . '"><span>' . $page . '</span></a>';
			}
		}
		
		// Prepare New Icons
		$stick['id'] = (int) $stick['id'];
		
		// Check for the New Icon
		if($newIcon = ($stick['date_last_post'] > $_SESSION[SITE_HANDLE]['new-tracker']) ? true : false)
		{
			if(isset($_SESSION[SITE_HANDLE]['posts-new'][$stick['id']]))
			{
				if($newIcon = ($stick['date_last_post'] > ($_SESSION[SITE_HANDLE]['new-tracker'] + $_SESSION[SITE_HANDLE]['posts-new'][$stick['id']])) ? true : false)
				{
					unset($_SESSION[SITE_HANDLE]['posts-new'][$stick['id']]);
				}
			}
		}
		
		// Display each thread
		echo '
		<div class="inner-line sticky-thread">
			<div class="inner-name">
				' . ($newIcon ? '<img src="' . CDN . '/images/new.png" /> ' :  '') . '<span class="icon-star"></span> ' . ($stick['perm_post'] > 2 ? '<span class="icon-lock"></span> ' : '') . '<a href="/' . $forum['url_slug'] . '/' . $stick['id'] . '-' . $stick['url_slug'] . '">' . $stick['title'] . '</a> <a title="last post" href="/' . $forum['url_slug'] . '/' . $stick['id'] . '-' . $stick['url_slug'] . '?page=last"><span class="icon-arrow-right"></span></a>
				<div class="inner-paginate">' . $drawDesc . '</div>
			</div>
			<div class="inner-posts">' . $stick['posts'] . '</div>
			<div class="inner-views">' . $stick['views'] . '</div>
			<div class="inner-details"><a ' . ($stick['role'] != '' ? 'class="role-' . $stick['role'] . '" ' : '') . 'href="' . $socialURL . '/' . $stick['handle'] . '">@' . $stick['handle'] . '</a><br />' . Time::fuzzy((int) $stick['date_last_post']) . '</div>
		</div>';
	}
}

// Cycle through threads
foreach($threads as $thread)
{
	// If the thread is also stickied, hide it
	if(in_array($thread['id'], $sThreads))
	{
		continue;
	}
	
	// Draw Description
	$drawDesc = "";
	
	if($thread['posts'] > $postsPerPage)
	{
		$paginate = new Pagination((int) $thread['posts'], $postsPerPage, 1, "division");
		
		foreach($paginate->pages as $page)
		{
			$drawDesc .= '
				<a href="/' . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug'] . '?page=' . $page . '"><span>' . $page . '</span></a>';
		}
	}
	
	// Prepare New Icons
	$thread['id'] = (int) $thread['id'];
	
	// Check for the New Icon
	if($newIcon = ($thread['date_last_post'] > $_SESSION[SITE_HANDLE]['new-tracker']) ? true : false)
	{
		if(isset($_SESSION[SITE_HANDLE]['posts-new'][$thread['id']]))
		{
			if($newIcon = ($thread['date_last_post'] > ($_SESSION[SITE_HANDLE]['new-tracker'] + $_SESSION[SITE_HANDLE]['posts-new'][$thread['id']])) ? true : false)
			{
				unset($_SESSION[SITE_HANDLE]['posts-new'][$thread['id']]);
			}
		}
	}
	
	// Display each thread
	echo '
	<div class="inner-line">
		<div class="inner-name">
			' . ($newIcon ? '<img src="' . CDN . '/images/new.png" /> ' :  '') . ($thread['perm_post'] > 2 ? '<span class="icon-lock"></span> ' : '') . '<a href="/' . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug'] . '">' . $thread['title'] . '</a> <a title="last post" href="/' . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug'] . '?page=last"><span class="icon-arrow-right"></span></a>
			<div class="inner-paginate">' . $drawDesc . '</div>
		</div>
		<div class="inner-posts">' . $thread['posts'] . '</div>
		<div class="inner-views">' . $thread['views'] . '</div>
		<div class="inner-details"><a ' . ($thread['role'] != '' ? 'class="role-' . $thread['role'] . '" ' : '') . 'href="' . $socialURL . '/' . $thread['handle'] . '">@' . $thread['handle'] . '</a><br />' . Time::fuzzy((int) $thread['date_last_post']) . '</div>
	</div>';
}

echo '
	</div>
</div>';

echo '
<div class="thread-tline">';
if(Me::$loggedIn)
{
	echo '
	<a href="/new-thread?forum=' . $forum['id'] . '">New Thread</a>';
	if($subData)
	{
		echo '
	<a href="/' . $forum['url_slug'] . '?action=unsubscribe">Unsubscribe</a>';
	}
	else
	{
		echo '
	<a href="/' . $forum['url_slug'] . '?action=subscribe">Subscribe</a>';
	}
}
echo '
	' . ($pageList ? '<div style="float:right;">' . $pageList . '</div>' : "") .'
</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
