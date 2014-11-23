<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Make sure you have a valid ID for this forum
if(!isset($_GET['forum']) or !$forum = AppForum::get((int) $_GET['forum']))
{
	header("Location: /"); exit;
}

// Must log in
if(!Me::$loggedIn)
{
	Me::redirectLogin("/new-thread?forum=" . ($_GET['forum'] + 0));
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

// Recognize Integers
$forum['id'] = (int) $forum['id'];
$forum['perm_post'] = (int) $forum['perm_post'];

// Make sure you have permission to post
if(Me::$clearance < $forum['perm_post'])
{
	Alert::saveError("Invalid Permissions", "You must have higher permissions to post threads on this forum.");
	
	header("Location: /" . $forum['url_slug']); exit;
}

// Prepare Variables
$_POST['body'] = (isset($_POST['body']) ? Security::purify($_POST['body']) : "");

// Create the thread
if(Form::submitted(SITE_HANDLE . '-forum-thrd'))
{
	FormValidate::text("Title", $_POST['title'], 1, 48);
	
	if(strlen($_POST['body']) < 1)
	{
		Alert::error("Message", "Please enter a message.");
	}
	
	if(FormValidate::pass())
	{
		// Create the Thread
		Database:: startTransaction();
		
		if($threadID = AppThread::create($forum, Me::$id, $_POST['title']))
		{
			if($postID = AppPost::create($forum, $threadID, Me::$id, $_POST['body'], (int) Me::$vals['avatar_opt']))
			{
				Database::endTransaction();
				
				// Get the Thread Data
				$thread = AppThread::get($forum['id'], $threadID);
				
				AppSubscriptions::updateForum($forum, $thread, Me::$id, $postID, Me::$vals['handle']);
				
				// Go to the thread
				header("Location: /" . $forum['url_slug'] . '/' . $thread['id'] . '-' . $thread['url_slug']); exit;
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
$breadcrumbs = AppForum::getBreadcrumbs($forum);

// Prepare the active hashtag
$config['active-hashtag'] = $forum['active_hashtag'];

// Update User Activity
UserActivity::update();

$config['pageTitle'] = $config['site-name'] . " > " . $forum['title'] . " > New Thread";

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

echo ' &gt; New Thread
</div>';

echo '
<div class="overwrap-box">
	<div class="overwrap-line">
		<div class="overwrap-name">Post New Thread</div>
	</div>
	<div style="padding:6px;">
		<form class="uniform" action="/new-thread?forum=' . $forum['id'] . '" method="post" style="padding-right:20px;">' . Form::prepare(SITE_HANDLE . '-forum-thrd') . '
			<input type="text" name="title" value="' . $_POST['title'] . '" placeholder="Title . . ." style="width:100%;margin-bottom:10px;" autocomplete="off" maxlength="48" tabindex="10" autofocus />
			' . UniMarkup::buttonLine() . '
			<textarea id="core_text_box" name="body" placeholder="Enter your message here . . ." style="resize:vertical;width:100%;height:300px;" tabindex="20">' . $_POST['body'] . '</textarea>
			<div style="margin-top:10px;"><input type="button" value="Preview" onclick="previewPost();"/> <input type="submit" name="submit" value="Post New Thread" /></div>
			<div id="preview" class="thread-post" style="display:none; padding:4px; margin-top:10px;"></div>
		</form>
	</div>
</div>';

echo '
</div>
<script>
function previewPost()
{
	var text = encodeURIComponent(document.getElementById("core_text_box").value);
	getAjax("", "preview-post", "parse", "body=" + text);
}
function parse(response)
{
	if(!response) { response = ""; }
	
	document.getElementById("preview").style.display = "block";
	document.getElementById("preview").innerHTML = response;
}
</script>';
// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
