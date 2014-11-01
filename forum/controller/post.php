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
	AppForumAvatar::confirmAvi(Me::$id);
}

// Get the current thread
if(!$thread = Database::selectOne("SELECT id, forum_id, title FROM threads WHERE forum_id=? AND id=? LIMIT 1", array($_GET['forum'], $_GET['id'])))
{
	header("Location: /"); exit;
}

// Recognize Integers
$thread['id'] = (int) $thread['id'];
$thread['forum_id'] = (int) $thread['forum_id'];

// Get Forum Details
$forum = Database::selectOne("SELECT active_hashtag, perm_post FROM forums WHERE id=? LIMIT 1", array($thread['forum_id']));

// Make sure you have permission to post
if(Me::$clearance < (int) $forum['perm_post'])
{
	Alert::saveError("Low Permissions", "You must have higher permissions to post here.");
	
	header("Location: /thread?forum=" . $thread['forum_id'] . '&id=' . $thread['id']); exit;
}

// Check Edit Mode & Post if applicable
$post = array();

if($editMode = (isset($_GET['edit']) ? true : false))
{
	if(!$post = Database::selectOne("SELECT p.id, p.uni_id, p.body, p.date_post, u.handle, u.display_name FROM posts p INNER JOIN users u ON u.uni_id=p.uni_id WHERE p.thread_id=? AND p.id=? LIMIT 1", array($thread['id'], $_GET['edit'])))
	{
		header("Location: /thread?forum=" . $thread['forum_id'] . '&id=' . $thread['id']); exit;
	}
	
	// Recognize Integers
	$post['id'] = (int) $post['id'];
	$post['uni_id'] = (int) $post['uni_id'];
	$post['date_post'] = (int) $post['date_post'];
	
	// Prepare Values
	$myPost = (Me::$id == $post['uni_id']);
	
	// If the user isn't you, or a moderator
	if(!$myPost && Me::$clearance < 6)
	{
		Alert::saveError("No Permissions", "You do not have permission to edit this post.");
		
		header("Location: /thread?forum=" . $thread['forum_id'] . '&id=' . $thread['id']); exit;
	}
}

// Sanitize the message
$_POST['body'] = isset($_POST['body']) ? Security::purify($_POST['body']) : '';

if(!$_POST['body'] and $post['body'])
{
	$_POST['body'] = $post['body'];
}

// Create the post
if(Form::submitted(SITE_HANDLE . 'post-thrd'))
{
	FormValidate::text("Message", $_POST['body'], 1, 3500);
	
	if(FormValidate::pass())
	{
		// If we're editing this post, run the edit script
		if($editMode)
		{
			if(AppPost::edit($thread['id'], $post['id'], $_POST['body']))
			{
				Alert::saveSuccess("Post Edited", 'The post has been successfully modified.');
				
				header("Location: /thread?forum=" . $thread['forum_id'] . '&id=' . $thread['id'] . '&page=last'); exit;
			}
		}
		
		// Standard Post Mode
		else if($postID = AppPost::create($thread['forum_id'], $thread['id'], Me::$id, $_POST['body']))
		{
			// Update subscriptions for this thread
			AppSubscriptions::update($thread['forum_id'], $thread['id'], Me::$id, $thread['title']);
			
			Alert::saveSuccess("Post Successful", 'You have successfully posted to the thread.');
			
			header("Location: /thread?forum=" . $thread['forum_id'] . '&id=' . $thread['id'] . '&page=last'); exit;
		}
	}
}

// Get Forum Breadcrumbs
$breadcrumbs = AppForum::getBreadcrumbs($thread['forum_id']);

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

echo ' &gt; <a href="/thread?forum=' . $thread['forum_id'] . '&id=' . $thread['id'] . '">' . $thread['title'] . '</a> &gt; Reply
</div>';

echo '
<div class="overwrap-box">
	<div class="overwrap-line" style="margin-bottom:10px;">
		<div class="overwrap-name">' . ($editMode ? 'Edit Post by ' . $post['display_name'] . ' (@' . $post['handle'] . ')' : 'Reply To Thread') . '</div>
	</div>
	' . UniMarkup::buttonLine() . '
	<div class="inner-box" style="padding:7px;">
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
