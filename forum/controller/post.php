<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Make sure you have a valid ID for this forum and thread
if(!isset($_GET['forum']) or !isset($_GET['id']))
{
	header("Location: /"); exit;
}

// Require Login
if(!Me::$loggedIn)
{
	Me::redirectLogin("/post?forum=" . ($_GET['forum'] + 0) . "&id=" . ($_GET['id'] + 0));
}

// If the avi type is "avatar", we need to make sure the user can post
if(AVI_TYPE == "avatar")
{
	if(!AppForumAvatar::confirmAvi(Me::$id))
	{
		Alert::saveError("No Avatar", "You must create and select an avatar to post on this forum.");
		
		header("Location: /settings"); exit;
	}
}

// Get the current thread
if(!$thread = AppThread::get((int) $_GET['forum'], (int) $_GET['id']))
{
	header("Location: /"); exit;
}

// Recognize Integers
$thread['id'] = (int) $thread['id'];
$thread['forum_id'] = (int) $thread['forum_id'];

// Get Forum Details
$forum = Database::selectOne("SELECT id, parent_id, url_slug, title, active_hashtag, perm_post FROM forums WHERE id=? LIMIT 1", array($thread['forum_id']));

// Make sure you have permission to post
if(Me::$clearance < (int) $forum['perm_post'])
{
	Alert::saveError("Low Permissions", "You must have higher permissions to post here.");
	
	header("Location: /" . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug'] . '?page=last'); exit;
}

// Check Edit Mode & Post if applicable
$post = array();

if($editMode = (isset($_GET['edit']) ? true : false))
{
	if(!$post = Database::selectOne("SELECT p.id, p.uni_id, p.avi_id, p.body, p.date_post, u.handle, u.display_name FROM posts p INNER JOIN users u ON u.uni_id=p.uni_id WHERE p.thread_id=? AND p.id=? LIMIT 1", array($thread['id'], $_GET['edit'])))
	{
		header("Location: /" . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug'] . '?page=last'); exit;
	}
	
	// Recognize Integers
	$post['id'] = (int) $post['id'];
	$post['uni_id'] = (int) $post['uni_id'];
	$post['avi_id'] = (int) $post['avi_id'];
	$post['date_post'] = (int) $post['date_post'];
	
	// Prepare Values
	$myPost = (Me::$id == $post['uni_id']);
	
	// If the user isn't you, or a moderator
	if(!$myPost && Me::$clearance < 6)
	{
		Alert::saveError("No Permissions", "You do not have permission to edit this post.");
		
		header("Location: /" . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug'] . '?page=last'); exit;
	}
}

// Sanitize the message
$_POST['body'] = isset($_POST['body']) ? Security::purify($_POST['body']) : '';

if(!$_POST['body'] and isset($post['body']))
{
	$_POST['body'] = $post['body'];
}

// Create the post
if(Form::submitted(SITE_HANDLE . 'post-thrd'))
{
	FormValidate::text("Message", $_POST['body'], 1, 32000);
	
	if(FormValidate::pass())
	{
		// If we're editing this post, run the edit script
		if($editMode)
		{
			if(AppPost::edit($thread['id'], $post['id'], $_POST['body']))
			{
				Alert::saveSuccess("Post Edited", 'The post has been successfully modified.');
				
				header("Location: /" . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug'] . '?page=last'); exit;
			}
		}
		
		// Standard Post Mode
		else if($postID = AppPost::create($forum, $thread['id'], Me::$id, $_POST['body'], (int) Me::$vals['avatar_opt']))
		{
			// Update subscriptions for this thread
			AppSubscriptions::update($thread['forum_id'], $thread['id'], Me::$id, $thread['title']);
			
			Alert::saveSuccess("Post Successful", 'You have successfully posted to the thread.');
			
			header("Location: /" . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug'] . '?page=last'); exit;
		}
	}
}

// Get Forum Breadcrumbs
$breadcrumbs = AppForum::getBreadcrumbs($forum);

// Prepare the active hashtag
$config['active-hashtag'] = $forum['active_hashtag'];

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

echo ' &gt; <a href="/' . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug'] . '">' . $thread['title'] . '</a> &gt; Reply
</div>';

echo '
<div class="overwrap-box">
	<div class="overwrap-line" style="margin-bottom:10px;">
		<div class="overwrap-name">' . ($editMode ? 'Edit Post by ' . $post['display_name'] . ' (@' . $post['handle'] . ')' : 'Reply To Thread') . '</div>
	</div>
	' . UniMarkup::buttonLine() . '
	<div style="padding:6px;">
		<form class="uniform" action="/post?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . ($editMode ? "&edit=" . $_GET['edit'] : "") . '" method="post" style="padding-right:20px;">' . Form::prepare(SITE_HANDLE . 'post-thrd') . '
			<textarea id="core_text_box" name="body" placeholder="Enter your message here . . ." style="resize:vertical; width:100%; height:300px;">' . $_POST['body'] . '</textarea>
			<div style="margin-top:10px;"><input type="submit" name="submit" value="Post to Thread" /></div>
		</form>
	</div>
</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
