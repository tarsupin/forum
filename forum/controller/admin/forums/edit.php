<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

/*
	/admin/forums/edit		{this is specific to forums}
	
	This page allows you to edit existing forums.
*/

$_POST['forum'] = (int) $_GET['forum'];

// Gather the forum being edited
if(!$forum = Database::selectOne("SELECT id, category_id, parent_id, posts, views, title, description, perm_read, perm_post FROM forums WHERE id=?", array($_POST['forum'])))
{
	header("Location: /admin/forums"); exit;
}

// Recognize Integers
$forum['id'] = (int) $forum['id'];
$forum['category_id'] = (int) $forum['category_id'];
$forum['parent_id'] = (int) $forum['parent_id'];
$forum['posts'] = (int) $forum['posts'];
$forum['views'] = (int) $forum['views'];
$forum['perm_read'] = (int) $forum['perm_read'];
$forum['perm_post'] = (int) $forum['perm_post'];

// Submit Form
if(Form::submitted())
{
	FormValidate::number("Category ID", $_POST['category_id'], 1);
	FormValidate::number("Parent ID", $_POST['parent_id'], 0);
	
	FormValidate::text("Title", $_POST['title'], 1, 42);
	FormValidate::text("Description", $_POST['description'], 0, 128);
	
	// FormValidate::number("Views", $_POST['views'], 0);
	// FormValidate::number("Posts", $_POST['posts'], 0);
	
	FormValidate::number("Visible To", $_POST['perm_read'], 0, 9);
	FormValidate::number("Post Clearance", $_POST['perm_post'], 0, 9);
	
	// Confirm that the category ID exists
	if(!Database::selectValue("SELECT id FROM forum_categories WHERE id=? LIMIT 1", array($_POST['category_id'])))
	{
		Alert::error("Category", "That category doesn't exist.");
	}
	
	// Confirm that the parent ID exists
	if($_POST['parent_id'] != 0)
	{
		if(!Database::selectValue("SELECT id FROM forums WHERE id=? LIMIT 1", array($_POST['parent_id'])))
		{
			Alert::error("Parent Forum", "That parent forum doesn't exist.");
		}
	}
	
	if(FormValidate::pass())
	{
		$forum['category_id'] = (int) $_POST['category_id'];
		$forum['parent_id'] = (int) $_POST['parent_id'];
		$forum['title'] = $_POST['title'];
		$forum['description'] = $_POST['description'];
		$forum['perm_read'] = (int) $_POST['perm_read'];
		$forum['perm_post'] = (int) $_POST['perm_post'];
		
		$success = AppForumAdmin::editForum($forum['id'], $forum['category_id'], $forum['parent_id'], $forum['title'], $forum['description'], $forum['perm_read'], $forum['perm_post']);
		if($success)
		{
			Alert::success("Forum Created", "You have successfully edited the forum \"" . $_POST['title'] . "\"!");
		}
	}
}

// Run Permissions
require(SYS_PATH . "/controller/includes/admin_perm.php");

// Run Header
require(SYS_PATH . "/controller/includes/admin_header.php");

// Gather the list of categories available
$categories = Database::selectMultiple("SELECT id, title FROM forum_categories ORDER BY cat_order", array());

$forums = array();
foreach($categories as $cat)
{
	$for = AppForum::getForums((int) $cat['id']);
	foreach($for as $f)
	{
		$forums[] = array('id' => $f['id'], 'title' => $f['title'], 'category_id' => $cat['id']);
	}
}

$clearances = User::clearance();
$select = '';
foreach($clearances as $key => $clear)
{
	if($key >= 0)
	{
		$select .= '
	<option value="' . $key . '">' . $clear . '</option>';
	}
}

echo '
<h2>Forum List</h2>
<form class="uniform" action="/admin/forums/edit?forum=' . ($_POST['forum'] + 0) . '" method="post">' . Form::prepare();
	
	echo '
	<p>Category:
	<select name="category_id">';
	
	foreach($categories as $cat)
	{
		echo '
		<option name="category_id" value="' . $cat['id'] . '"' . ($cat['id'] == $forum['category_id'] ? ' selected' : '') . '>' . $cat['title'] . '</option>';
	}
	
	echo '
	</select>
	</p>
	
	<p>Parent Forum:
	<select name="parent_id">
		<option value="0">&nbsp;</option>';
	
	foreach($forums as $f)
	{
		echo '
		<option value="' . $f['id'] . '"' . ($forum['parent_id'] == $f['id'] ? ' selected' : '') . '>' . $f['title'] . '</option>';
	}
	
	echo '
	</select>
	</p>
	
	<p>Title: <input type="text" name="title" value="' . $forum['title'] . '" /></p>
	<p>Description: <input type="text" name="description" value="' . $forum['description'] . '" style="min-width:400px;" /></p>';
	
	/*echo '
	<p>Views: <input type="text" name="views" value="' . $forum['views'] . '" readonly /></p>
	<p>Posts: <input type="text" name="posts" value="' . $forum['posts'] . '" readonly /></p>';*/
	
	echo '
	<p>Visible To:
	<select name="perm_read">' . str_replace('value="' . $forum['perm_read'] . '"', 'value="' . $forum['perm_read'] . '" selected', $select) . '
	</select></p>
	
	<p>Post Allowance:
	<select name="perm_post">' . str_replace('value="' . $forum['perm_post'] . '"', 'value="' . $forum['perm_post'] . '" selected', $select) . '
	</select>
	</p>
	
	<p><input type="submit" name="submit" value="Edit Forum" /></p>
</form>';

// Display the Footer
require(SYS_PATH . "/controller/includes/admin_footer.php");
