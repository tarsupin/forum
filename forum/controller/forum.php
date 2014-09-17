<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Make sure you have a valid ID for this forum
if(!isset($_GET['id']))
{
	header("Location: /"); exit;
}

// Get the current forum
if(!$forum = Database::selectOne("SELECT id, title, perm_read FROM forums WHERE id=? LIMIT 1", array((int) $_GET['id'])))
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
AppForum::view($forum['id']);

// Prepare Values
$_GET['page'] = (isset($_GET['page']) ? (int) $_GET['page'] : 1);
$pageList = "";
$threadsToShow = 20;
$postsPerPage = 10;

if($_GET['page'] > 1)
{
	$pageList = '<a href="/forum?id=' . $forum['id'] . '&page=' . ($_GET['page'] - 1) . '">Previous Page</a>';
}

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
	$pageList = '<a href="/forum?id=' . $forum['id'] . '&page=' . ($_GET['page'] + 1) . '">Next Page</a>';
	array_pop($threads);
}

// Get Forum Breadcrumbs
$breadcrumbs = AppForum::getBreadcrumbs($forum['id']);
array_pop($breadcrumbs); // remove the final breadcrumb (this forum)

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

echo '
<div class="thread-tline">
	<a href="/new-thread?forum=' . $forum['id'] . '">New Thread</a>
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
			$paginate = new Pagination($stick['posts'], $postsPerPage, 1, "division");
			
			foreach($paginate->pages as $page)
			{
				$drawDesc .= '
					<a href="/thread?forum=' . $stick['forum_id'] . '&id=' . $stick['id'] . '&page=' . $page . '"><span>' . $page . '</span></a>';
			}
		}
		
		// Display each thread
		echo '
		<div class="inner-line sticky-thread">
			<div class="inner-name">
				<a href="/thread?forum=' . $stick['forum_id'] . '&id=' . $stick['id'] . '">' . $stick['title'] . '</a>
				<div class="inner-paginate">' . $drawDesc . '</div>
			</div>
			<div class="inner-posts">' . $stick['posts'] . '</div>
			<div class="inner-views">' . $stick['views'] . '</div>
			<div class="inner-details"><a href="/' . $stick['handle'] . '">' . $stick['display_name'] . '</a><br />' . Time::fuzzy($stick['date_last_post']) . '</div>
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
		$paginate = new Pagination($thread['posts'], $postsPerPage, 1, "division");
		
		foreach($paginate->pages as $page)
		{
			$drawDesc .= '
				<a href="/thread?forum=' . $stick['forum_id'] . '&id=' . $stick['id'] . '&page=' . $page . '"><span>' . $page . '</span></a>';
		}
	}
	
	// Display each thread
	echo '
	<div class="inner-line">
		<div class="inner-name">
			<a href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '">' . $thread['title'] . '</a>
			<div class="inner-paginate">' . $drawDesc . '</div>
		</div>
		<div class="inner-posts">' . $thread['posts'] . '</div>
		<div class="inner-views">' . $thread['views'] . '</div>
		<div class="inner-details"><a href="/' . $thread['handle'] . '">' . $thread['display_name'] . '</a><br />' . Time::fuzzy($thread['date_last_post']) . '</div>
	</div>';
}

echo '
	</div>
</div>';

echo '
<div class="thread-tline">
	<a href="/new-thread?forum=' . $forum['id'] . '">New Thread</a>
	' . ($pageList ? '<div style="float:right;">' . $pageList . '</div>' : "") .'
</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
