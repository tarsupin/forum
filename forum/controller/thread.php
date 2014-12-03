<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

/*
	$forum		// `id, active_hashtag, title, perm_read`
	$thread		// `id, forum_id, posts, perm_post`
*/

// Make sure that the appropriate information was sent
if(!isset($forum) or !isset($thread))
{
	header("Location: /"); exit;
}

// Recognize Integers
$threadID = (int) $thread['id'];
$forumID = (int) $thread['forum_id'];
$thread['posts'] = (int) $thread['posts'];
$thread['perm_post'] = (int) $thread['perm_post'];

// Ensure if you have proper permissions to access this forum
if((int) $forum['perm_read'] > Me::$clearance)
{
	Alert::saveError("Read Permissions", "You don't have the necessary permissions to read this forum.");
	
	header("Location: /"); exit;
}

// View the Thread (increase view count)
AppThread::view($forum, $threadID);

// Prepare Values
$postsPerPage = 20;
$highestPage = ceil($thread['posts'] / $postsPerPage);
$isMod = (Me::$clearance >= 6 ? true : false);

$script = '';
if(isset($_GET['page']) && $_GET['page'] == 'last')
{
	$script = '
	if (window.location.href.indexOf("page=last") >= 0)
	{
		var posts = document.getElementsByClassName("post-anchor");
		var target = posts[posts.length-1];
		target.scrollIntoView(true);
	}';
}
$_GET['page'] = (isset($_GET['page']) ? ($_GET['page'] == 'last' ? (int) $highestPage : (int) $_GET['page']) : 1);
$pageLine = '';
$subData = array();

// Check for functionality that requires you to be logged in
if(Me::$loggedIn)
{
	// If the avi type is "avatar", we need to make sure the user can post
	$has_avatar = true;
	if(AVI_TYPE == "avatar")
	{
		if(!AppForumAvatar::confirmAvi(Me::$id))
		{
			$has_avatar = false;
			Alert::error("No Avatar", "You must create and select an avatar to post on this forum.");
		}
	}

	// Check your Subscription
	if($subData = AppSubscriptions::getData(Me::$id, $forumID, $threadID))
	{
		if($subData['new_posts'] > 0)
		{
			AppSubscriptions::clear(Me::$id, $forumID, $threadID);
		}
	}
	
	// Run Actions
	if(isset($_GET['action']))
	{
		// Subscribe to the Thread
		if($_GET['action'] == "subscribe")
		{
			if(AppSubscriptions::subscribe($forumID, $threadID, Me::$id))
			{
				$subData = array('uni_id' => Me::$id, 'new_posts' => 0);
				Alert::success("Subscribed", "You are now subscribed to \"" . $thread['title'] . "\"!");
			}
		}
		
		// Unsubscribe from the Thread
		else if($_GET['action'] == "unsubscribe")
		{
			if(AppSubscriptions::unsubscribe($forumID, $threadID, Me::$id))
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
				
				if(AppForumAdmin::lockThread($forumID, $threadID, $thread['perm_post']))
				{
					Alert::success("Thread Locked", "You have locked this thread.");
					Alert::info("Update Report", 'Would you like to <a href="/admin/reports/update-report?id=' . SiteReport::$lastReportID . '">update this report</a>?');
				}
			}
			
			// Unlock the Thread
			else if($_GET['action'] == "unlock")
			{
				$thread['perm_post'] = 2;
				AppForumAdmin::lockThread($forumID, $threadID, $thread['perm_post']);
			}
			
			// Sticky the Thread
			else if($_GET['action'] == "sticky")
			{
				Alert::success("Sticky", "This post has been stickied.");
				AppForumAdmin::alterSticky($forumID, $threadID, 1);
			}
			
			// Unsticky the Thread
			else if($_GET['action'] == "unsticky")
			{
				Alert::success("Post Unstickied", "This post is unstickied.");
				AppForumAdmin::alterSticky($forumID, $threadID, 0);
			}
			
			// Urgent-Sticky the Thread
			else if($_GET['action'] == "stickyImportant")
			{
				Alert::success("Important Sticky", "This post has been marked as important.");
				AppForumAdmin::alterSticky($forumID, $threadID, 4);
			}
			
			// Move the Thread
			else if($_GET['action'] == "moveThread")
			{
				header("Location: /admin/threads/move?forum=" . $forumID . '&id=' . $threadID); exit;
			}
			
			// Delete a Post
			else if($_GET['action'] == "deletePost" && isset($_GET['post']))
			{
				if(AppForumAdmin::deletePost($forumID, $threadID, (int) $_GET['post']))
				{
					Alert::success("Post Deleted", "You have deleted a post.");
					Alert::info("Update Report", 'Would you like to <a href="/admin/reports/update-report?id=' . SiteReport::$lastReportID . '">update this report</a>?');
				}
			}
			
			// Delete a Thread
			else if($_GET['action'] == "deleteThread")
			{
				if(AppForumAdmin::deleteThread($forumID, $threadID))
				{
					Alert::success("Thread Deleted", "You have deleted a post.");
					Alert::info("Update Report", 'Would you like to <a href="/admin/reports/update-report?id=' . SiteReport::$lastReportID . '">update this report</a>?');
				}
			}
		}
	}	
}

// Get the posts
$posts = AppThread::getPosts($threadID, $_GET['page'], $postsPerPage);

// Get all users listed
$userList = array();
$avatarName = array();

foreach($posts as $post)
{
	$uniID = (int) $post['uni_id'];
	$aviID = (int) $post['avi_id'];
	
	if(!isset($userList[$uniID]))
	{
		$userList[$uniID] = User::get($uniID, "role, handle, display_name, post_count, date_joined");
	}
	if(!isset($avatarName[$uniID][$aviID]))
	{
		$avatarName[$uniID][$aviID] = "";
	}
	if($aviID > 0)
	{
		$avatarName[$uniID][$aviID] = AppForum::getName($uniID, $aviID);
	}
}

// Get Forum Breadcrumbs
$breadcrumbs = AppForum::getBreadcrumbs($forum);

// Get Pagination Values
$paginate = new Pagination($thread['posts'], $postsPerPage, $_GET['page'], "division");

if($paginate->highestPage > 1)
{
	$pageLine = '
	<div style="float:right;">Page: ';
	
	foreach($paginate->pages as $page)
	{
		$pageLine .= '
		<a class="thread-page' . ($page == $_GET['page'] ? ' thread-page-active' : '') . '" href="/' . $forum['url_slug'] . '/' . $threadID . '-' . $thread['url_slug'] . '?page=' . $page . '">' . $page . '</a>';
	}
	
	$pageLine .= '
	</div>';
}

// Prepare the active hashtag
$config['active-hashtag'] = $forum['active_hashtag'];

/****** Page Configuration ******/
$config['canonical'] = "/" . $threadID . '-' . $thread['url_slug'];
Metadata::$index = true;
Metadata::$follow = true;

// Update User Activity
AppActivity::updateUser();

// Update the last time viewing this forum
$_SESSION[SITE_HANDLE]['posts-new'][$threadID] = time() - $_SESSION[SITE_HANDLE]['new-tracker'];

$config['pageTitle'] = $config['site-name'] . " > " . $forum['title'] . " > " . $thread['title'];

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
	<a href="/post?forum=' . $forumID . '&id=' . $threadID . '">Reply</a>';
	
	// Display Subscription Option
	if($subData)
	{
		echo '
		<a href="/' . $forum['url_slug'] . '/' . $threadID . '-' . $thread['url_slug'] . '?action=unsubscribe">Unsubscribe</a>';
	}
	else
	{
		echo '
		<a href="/' . $forum['url_slug'] . '/' . $threadID . '-' . $thread['url_slug'] . '?action=subscribe">Subscribe</a>';
	}
	
	// Display Renaming Option
	if($isMod || $thread['author_id'] == Me::$id)
	{
		echo '
			<a href="javascript:changeTitle(' . $forum['id'] . ', ' . $thread['id'] . ');">Change Title</a>';
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
						window.location="/' . $forum['url_slug'] . '/' . $threadID . '-' . $thread['url_slug'] . '?action=" + modDrop.value;
					}
				}
			}
		</script>';
	}
}

echo '
</div>';

// Prepare Values
$social = URL::unifaction_social();

foreach($posts as $post)
{
	// Prepare Values
	$uniID = (int) $post['uni_id'];
	$aviID = (int) $post['avi_id'];
	
	// Prepare the differences between AVATAR and PROFILE sites
	if($aviID)
	{
		$img = Avatar::image($uniID, $aviID);
	}
	else
	{
		$img = ProfilePic::image($uniID, "huge");
	}
	
	// Anchor needs to be offset by the height of the fixed header
	echo '
	<span class="post-anchor" id="p' . $post['id'] . '" style="display:block; position:relative; top:-60px; height:0px;"></span>';

	// Display the Post
	echo '
	<div class="thread-post">
		<div class="post-left' . ($aviID && AVI_TYPE == "avatar" ? "-avatar" : "") . '">
			<div><a href="' . $social . '/' . $userList[$uniID]['handle'] . '"><img class="post-img' . ($aviID && AVI_TYPE == "avatar" ? "-avatar" : "") . '" src="' . $img . '" /></a></div>
			<div class="post-status">
				<div class="post-status-top">' . (lcfirst($userList[$uniID]['display_name']) != lcfirst($userList[$uniID]['handle']) ? $userList[$uniID]['display_name'] . ' ' : '') . '<a ' . ($userList[$uniID]['role'] != '' ? 'class="role-' . $userList[$uniID]['role'] . '" ' : '') . 'href="' . $social . '/' . $userList[$uniID]['handle'] . '">@' . $userList[$uniID]['handle'] . '</a>' . (!in_array($avatarName[$uniID][$aviID], array('', $userList[$uniID]['display_name'], lcfirst($userList[$uniID]['display_name']))) ? ' (' . $avatarName[$uniID][$aviID] . ')' : '') . '</div>
				<div class="post-status-bottom">
					<div><a href="/' . $forum['url_slug'] . '/' . $threadID . '-' . $thread['url_slug'] . '?page=' . $_GET['page'] . '#p' . $post['id'] . '"><span class="icon-link"></span></a> <span title="' . date("M j, Y g:ia", $post['date_post']) . ' UniTime">Posted ' . Time::fuzzy((int) $post['date_post']) . '</span></div>
					<div style="margin-top:6px;"><span class="icon-clock"></span> Joined ' . Time::fuzzy((int) $userList[$uniID]['date_joined']) . '</div>
					<div style="margin-top:6px;"><a href="' . URL::inbox_unifaction_com() . '/to/' . $userList[$uniID]['handle'] . Me::$slg . '"><span class="icon-envelope"></span> Send Private Message</a></div>
				</div>
			</div>
			<div class="post-like-row"><a href="javascript:likePost(' . $threadID . ', ' . $post['id'] . ');"><img src="' . CDN . '/images/forum/thumb_up.png" /></a> Likes: <span id="likeVal-' . $post['id'] . '">' . $post['likes'] . '</span></div>
			<div class="post-count-row"><span class="icon-pencil"></span> Posts: ' . $userList[$uniID]['post_count'] . '</div>
		</div>
		<div class="post-right' . ($aviID && AVI_TYPE == "avatar" ? "-avatar" : "") . '">
			<div class="post-options">';
			
			// Delete Option
			if($isMod)
			{
				echo '
				<a href="/' . $forum['url_slug'] . '/' . $threadID . '-' . $thread['url_slug'] . '?action=deletePost&post=' . $post['id'] . '"><img src="' . CDN . '/images/forum/delete.png" /></a>';
			}
			
			// Edit Option
			if(Me::$clearance >= $thread['perm_post'] && (Me::$id == $uniID || $isMod))
			{
				echo '
				<a href="/post?forum=' . $forumID . '&id=' . $threadID . '&edit=' . $post['id'] . '"><img src="' . CDN . '/images/forum/edit.png" /></a>';
			}
			
			// Quote Option
			if(Me::$loggedIn && $thread['perm_post'] <= Me::$clearance && $has_avatar)
			{
				echo '
				<a href="javascript:quotePost(' . $forumID . ', ' . $threadID . ', ' . $post['id'] . ');"><img src="' . CDN . '/images/forum/quote.png" /></a>';
			}
			
			echo '
			</div>
			' . nl2br(UniMarkup::parse($post['body']));
			
			if($post['signature'])
			{
				echo '<div class="thread-signature">' . nl2br($post['signature']) . '</div>';
			}
			
		echo '
			<div class="post-status-mobile">' . (lcfirst($userList[$uniID]['display_name']) != lcfirst($userList[$uniID]['handle']) ? $userList[$uniID]['display_name'] . ' ' : '') . '<a ' . ($userList[$uniID]['role'] != '' ? 'class="role-' . $userList[$uniID]['role'] . '" ' : '') . 'href="' . $social . '/' . $userList[$uniID]['handle'] . '">@' . $userList[$uniID]['handle'] . '</a>' . (!in_array($avatarName[$uniID][$aviID], array('', $userList[$uniID]['display_name'], lcfirst($userList[$uniID]['display_name']))) ? ' (' . $avatarName[$uniID][$aviID] . ')' : '') . '</a>
			<br/>' . Time::fuzzy((int) $post['date_post']) . ' (' . date("M j, Y g:ia", $post['date_post']) . ')</div>
		</div>
	</div>
	<div style="clear:both;"></div>';
}

echo '
<script>
function likePost(threadID, postID)
{
	getAjax("", "like-post", "likeActivated", "threadID=" + threadID, "postID=" + postID);
}
function likeActivated(response)
{
	if(!response) { return; }
	
	var obj = JSON.parse(response);
	
	if(typeof(obj.postID) != undefined)
	{
		var l = document.getElementById("likeVal-" + obj.postID);
		
		var c = parseInt(l.innerHTML) + 1;
		
		l.innerHTML = c;
	}
}

function changeTitle(forum, thread)
{
	var new_title = prompt("New Thread Title:", "' . $thread['title'] . '");
	if(new_title)
	{
		getAjax("", "rename-thread", "renameActivated", "forumID=" + forum, "threadID=" + thread, "title=" + new_title);
	}
}
function renameActivated(response)
{
	if(!response) { return; }
	if(response == "") { return; }
	
	window.location="/' . $forum['url_slug'] . '/' . $threadID . '-" + response;
}
' . $script . '
</script>';

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

echo ' &gt; ' . $thread['title'] . ' &gt; <a href="/post?forum=' . $forumID . '&id=' . $threadID . '">Reply</a>
	' . $pageLine . '
</div>';

// Quick Reply Box
if(Me::$loggedIn && $thread['perm_post'] <= Me::$clearance && $has_avatar)
{
	echo '
	<div class="overwrap-box">
		<div class="overwrap-line" style="margin-bottom:10px;">
			<div class="overwrap-name">Quick Reply</div>
		</div>
		' . UniMarkup::buttonLine() . '
		<div style="padding:6px;">
			<form class="uniform" action="/post?forum=' . $forumID . '&id=' . $threadID . '" method="post" style="padding-right:20px;">' . Form::prepare(SITE_HANDLE . 'post-thrd') . '
				<textarea id="core_text_box" name="body" placeholder="Enter your message here . . ." style="resize:vertical; width:100%; height:300px;"></textarea>
				<div style="margin-top:10px;"><input type="button" value="Preview" onclick="previewPost();"/> <input type="submit" name="submit" value="Post to Thread" /></div>
				<div id="preview" class="thread-post" style="display:none; padding:4px; margin-top:10px;"></div>
			</form>
		</div>
	</div>';
}

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
function quotePost(forum, thread, post)
{
	getAjax("", "quote-post", "parseadd", "forumID=" + forum, "threadID=" + thread, "postID=" + post);
}
function parseadd(response)
{
	if(!response) { response = ""; }
	
	document.getElementById("core_text_box").value += response + "\n\n";
}
</script>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
