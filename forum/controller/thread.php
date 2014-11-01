<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Get the current thread
if(!$thread = Database::selectOne("SELECT id, title, forum_id, posts, perm_post FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($_GET['forum'], $_GET['id'])))
{
	header("Location: /"); exit;
}

// Recognize Integers
$thread['id'] = (int) $thread['id'];
$thread['forum_id'] = (int) $thread['forum_id'];
$thread['posts'] = (int) $thread['posts'];
$thread['perm_post'] = (int) $thread['perm_post'];

// Get the parent forum
if(!$forum = Database::selectOne("SELECT active_hashtag, perm_read FROM forums WHERE id=? LIMIT 1", array($thread['forum_id'])))
{
	header("Location: /"); exit;
}

// Ensure if you have proper permissions to access this forum
if((int) $forum['perm_read'] > Me::$clearance)
{
	header("Location: /"); exit;
}

// View the Thread (increase view count)
AppThread::view($thread['forum_id'], $thread['id']);

// Prepare Values
$postsPerPage = 10;
$highestPage = ceil($thread['posts'] / $postsPerPage);
$isMod = (Me::$clearance >= 6 ? true : false);

$_GET['page'] = (isset($_GET['page']) ? ($_GET['page'] == 'last' ? (int) $highestPage : (int) $_GET['page']) : 1);
$pageLine = '';
$subData = array();

// Check for functionality that requires you to be logged in
if(Me::$loggedIn)
{
	// Check your Subscription
	if($subData = AppSubscriptions::getData(Me::$id, $thread['forum_id'], $thread['id']))
	{
		if($subData['new_posts'] > 0)
		{
			AppSubscriptions::clear(Me::$id, $thread['forum_id'], $thread['id']);
		}
	}
	
	// Run Actions
	if(isset($_GET['action']))
	{
		// Subscribe to the Thread
		if($_GET['action'] == "subscribe")
		{
			if(AppSubscriptions::subscribe($thread['forum_id'], $thread['id'], Me::$id))
			{
				$subData = array('uni_id' => Me::$id, 'new_posts' => 0);
				Alert::success("Subscribed", "You are now subscribed to \"" . $thread['title'] . "\"!");
			}
		}
		
		// Unsubscribe from the Thread
		else if($_GET['action'] == "unsubscribe")
		{
			if(AppSubscriptions::unsubscribe($thread['forum_id'], $thread['id'], Me::$id))
			{
				$subData = array();
				Alert::success("Unsubscribed", "You are now unsubscribed from \"" . $thread['title'] . "\"!");
			}
		}
		
		// Moderator Actions
		if($isMod)
		{
			// Lock the Thread
			if($_GET['action'] == "lock")
			{
				$thread['perm_post'] = 5;
				
				if(AppForumAdmin::lockThread($thread['forum_id'], $thread['id'], $thread['perm_post']))
				{
					Alert::success("Thread Locked", "You have locked this thread.");
					Alert::info("Update Report", 'Would you like to <a href="/admin/reports/update-report?id=' . SiteReport::$lastReportID . '">update this report</a>?');
				}
			}
			
			// Unlock the Thread
			else if($_GET['action'] == "unlock")
			{
				$thread['perm_post'] = 2;
				AppForumAdmin::lockThread($thread['forum_id'], $thread['id'], $thread['perm_post']);
			}
			
			// Sticky the Thread
			else if($_GET['action'] == "sticky")
			{
				Alert::success("Sticky", "This post has been stickied.");
				AppForumAdmin::alterSticky($thread['forum_id'], $thread['id'], 1);
			}
			
			// Unsticky the Thread
			else if($_GET['action'] == "unsticky")
			{
				Alert::success("Post Unstickied", "This post is unstickied.");
				AppForumAdmin::alterSticky($thread['forum_id'], $thread['id'], 0);
			}
			
			// Urgent-Sticky the Thread
			else if($_GET['action'] == "stickyImportant")
			{
				Alert::success("Important Sticky", "This post has been marked as important.");
				AppForumAdmin::alterSticky($thread['forum_id'], $thread['id'], 4);
			}
			
			// Move the Thread
			else if($_GET['action'] == "moveThread")
			{
				header("Location: /admin/threads/move?forum=" . $thread['forum_id'] . '&id=' . $thread['id']); exit;
			}
			
			// Delete a Post
			else if($_GET['action'] == "deletePost" && isset($_GET['post']))
			{
				if(AppForumAdmin::deletePost($thread['forum_id'], $thread['id'], $_GET['post']))
				{
					Alert::success("Post Deleted", "You have deleted a post.");
					Alert::info("Update Report", 'Would you like to <a href="/admin/reports/update-report?id=' . SiteReport::$lastReportID . '">update this report</a>?');
				}
			}
			
			// Delete a Thread
			else if($_GET['action'] == "deleteThread")
			{
				if(AppForumAdmin::deleteThread($thread['forum_id'], $thread['id']))
				{
					Alert::success("Thread Deleted", "You have deleted a post.");
					Alert::info("Update Report", 'Would you like to <a href="/admin/reports/update-report?id=' . SiteReport::$lastReportID . '">update this report</a>?');
				}
			}
		}
	}	
}

// Get the posts
$posts = AppThread::getPosts($thread['id'], $_GET['page'], $postsPerPage);

// Get all users listed
$userList = array();

foreach($posts as $post)
{
	$nextID = (int) $post['uni_id'];
	
	if(!isset($userList[$nextID]))
	{
		$userList[$nextID] = User::get($nextID, "handle, display_name");
	}
}

// Get Forum Breadcrumbs
$breadcrumbs = AppForum::getBreadcrumbs($thread['forum_id']);

// Get Pagination Values
$paginate = new Pagination($thread['posts'], $postsPerPage, $_GET['page'], "division");

if($paginate->highestPage > 1)
{
	$pageLine = '
	<div style="float:right;">Page: ';
	
	foreach($pages as $page)
	{
		$pageLine .= '
		<a class="thread-page' . ($page == $_GET['page'] ? ' thread-page-active' : '') . '" href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&page=' . $page . '">' . $page . '</a>';
	}
	
	$pageLine .= '
	</div>';
}

// Prepare the active hashtag
$config['active-hashtag'] = $forum['active_hashtag'];

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

echo ' &gt; ' . $thread['title'] . '
</div>';

echo '
<div class="thread-tline">
	' . $pageLine;

if(Me::$loggedIn)
{
	echo '
	<a href="/post?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '">Reply</a>';
	
	// Display Subscription Option
	if($subData)
	{
		echo '
		<a href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&action=unsubscribe">Unsubscribe</a>';
	}
	else
	{
		echo '
		<a href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&action=subscribe">Subscribe</a>';
	}
	
	// Display Moderator Options
	if($isMod)
	{
		// Mod Toolset Dropdown
		echo '
		<select id="mod-tool-dropdown" name="mod-dropdown">
			<option value="">-- Mod Tools --</option>
			<option value="stickyImportant">Set Level: Important Sticky</option>
			<option value="sticky">Set Level: Sticky</option>
			<option value="unsticky">Set Level: Unstickied</option>';
			
		if($thread['perm_post'] <= 2)
		{
			echo '
			<option value="lock">Lock Thread</option>';
		}
		else
		{
			echo '
			<option value="unlock">Unlock Thread</option>';
		}
		
		echo '
			<option value="moveThread">Move Thread</option>
			<option value="deleteThread">Delete Thread</option>
		</select>
		
		<script>
			var modDrop = document.getElementById("mod-tool-dropdown");
			
			modDrop.onchange = function()
			{
				var confirmTool = window.confirm("Are you sure you want to " + modDrop[modDrop.selectedIndex].text + "?");
				
				if(confirmTool)
				{
					var modList = ["stickyImportant", "sticky", "unsticky", "lock", "unlock", "deleteThread", "moveThread"];
					
					if(modList.indexOf(modDrop.value) > -1)
					{
						window.location="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&action=" + modDrop.value;
					}
				}
			}
		</script>';
		
		/*
		// Sticky Thread
		echo '
		<a href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&action=sticky">Sticky</a>
		<a href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&action=unsticky">Unsticky</a>';
		
		// Lock vs. Unlock
		echo '
		<a href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&action=' . ($thread['perm_post'] <= 2 ? 'lock' : 'unlock') . '">' . ($thread['perm_post'] <= 2 ? 'Lock' : 'Unlock') . ' Thread</a>';
		
		// Delete Thread
		echo '
		<a href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&action=deleteThread">Delete Thread</a>';
		*/
	}
}

echo '
</div>';

// Prepare Values
$social = URL::unifaction_social();
$fastchat = URL::fastchat_social();

foreach($posts as $post)
{
	$uniID = (int) $post['uni_id'];
	
	echo '
	<div class="thread-post">';
		
		if(AVI_TYPE == "avatar" and Avatar::hasAvatar())
		{
			echo '
			<div class="post-avatar">
				<div><a href="' . $social . '/' . $userList[$uniID]['handle'] . '"><img src="' . Avatar::image($uniID) . '" /></a></div>
				<div class="post-avatar-bottom">
					<div class="plr-top"><a href="' . $social . '/' . $userList[$uniID]['handle'] . '">' . $userList[$uniID]['handle'] . '</a></div>
					<div class="plr-bottom">
						<a href="' . $fastchat . '/' . $userList[$uniID]['handle'] . '">@' . $userList[$uniID]['handle'] . '</a>
						<div>' . Time::fuzzy((int) $post['date_post']) . '</div>
					</div>
				</div>
			</div>';
		}
		else
		{
			echo '
			<div class="post-left">
				<div class="pl-left"><a href="' . $social . '/' . $userList[$uniID]['handle'] . '"><img class="circimg" src="' . ProfilePic::image($uniID, "medium") . '" /></a></div>
				<div class="pl-right">
					<div class="plr-top"><a href="' . $social . '/' . $userList[$uniID]['handle'] . '">' . $userList[$uniID]['handle'] . '</a></div>
					<div class="plr-bottom">
						<a href="' . $fastchat . '/' . $userList[$uniID]['handle'] . '">@' . $userList[$uniID]['handle'] . '</a>
						<div>' . Time::fuzzy((int) $post['date_post']) . '</div>
					</div>
				</div>
			</div>';
		}
		
		echo '
		<div class="post-right">
			<div class="post-options">';
			
			// Delete Option
			if($isMod)
			{
				echo '
				<a href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&action=deletePost&post=' . $post['id'] . '">Delete</a>';
			}
			
			// Edit Option
			if(Me::$id == $uniID || $isMod)
			{
				echo '
				<a href="/post?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '&edit=' . $post['id'] . '">Edit</a>';
			}
			
			echo '
			</div>
			' . nl2br(UniMarkup::parse($post['body'])) . '
		</div>
	</div>';
}

echo '
<div class="thread-tline">
	' . $pageLine . '
	<a href="/post?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '">Reply</a>
</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
