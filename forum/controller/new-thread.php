<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Must log in
if(!Me::$loggedIn)
{
	Me::redirectLogin("/new-thread");
}

// Make sure you have a valid ID for this forum
if(!isset($_GET['forum']))
{
	header("Location: /"); exit;
}

// Get the current forum
if(!$forum = Database::selectOne("SELECT id, title, perm_post FROM forums WHERE id=? LIMIT 1", array($_GET['forum'])))
{
	header("Location: /"); exit;
}

// Recognize Integers
$forum['id'] = (int) $forum['id'];
$forum['perm_post'] = (int) $forum['perm_post'];

// Make sure you have permission to post
if(Me::$clearance < $forum['perm_post'])
{
	header("Location: /forum?id=" . $forum['id']); exit;
}

// Prepare Variables
$_POST['body'] = (isset($_POST['body']) ? Security::purify($_POST['body']) : "");

// Create the thread
if(Form::submitted(SITE_HANDLE . '-forum-thrd'))
{
	FormValidate::text("Title", $_POST['title'], 1, 42);
	
	if(strlen($_POST['body']) < 1)
	{
		Alert::error("Message", "Please enter a message.");
	}
	
	if(FormValidate::pass())
	{
		// Create the Thread
		Database:: startTransaction();
		
		if($threadID = AppThread::create($forum['id'], Me::$id, $_POST['title']))
		{
			if($postID = AppPost::create($forum['id'], $threadID, Me::$id, $_POST['body']))
			{
				Database::endTransaction();
				
				// Go to the thread
				header("Location: /thread?forum=" . $forum['id'] . '&id=' . $threadID); exit;
			}
		}
		
		Database::endTransaction(false);
	}
}
else
{
	// Final Sanitization ($_POST['body'] was done above with full purification)
	$_POST['title'] = (isset($_POST['title']) ? Sanitize::safeword($_POST['title']) : "");
}

// Get Forum Breadcrumbs
$breadcrumbs = AppForum::getBreadcrumbs($forum['id']);

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

echo ' &gt; New Thread
</div>';

echo '
<div class="overwrap-box">
	<div class="overwrap-line">
		<div class="overwrap-name">Post New Thread</div>
	</div>
	<div class="inner-box" style="padding:7px;">
		<form class="uniform" action="/new-thread?forum=' . $forum['id'] . '" method="post" style="padding-right:20px;">' . Form::prepare(SITE_HANDLE . '-forum-thrd') . '
			<input type="text" name="title" value="' . $_POST['title'] . '" placeholder="Title . . ." style="width:100%;margin-bottom:10px;" autocomplete="off" />
			<textarea name="body" placeholder="Enter your message here . . ." style="resize:vertical;width:100%;height:300px;">' . $_POST['body'] . '</textarea>
			<div style="margin-top:10px;"><input type="submit" name="submit" value="Post New Thread" /></div>
		</form>
	</div>
</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
