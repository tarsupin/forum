<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

/*
	/admin/forums/create		{this is specific to forums}
	
	This page allows you to create new forums.
*/

// Submit Form
if(Form::submitted("forum-create"))
{
	FormValidate::number("Category ID", $_POST['category_id'], 1);
	FormValidate::number("Parent ID", $_POST['parent_id'], 0);
	
	FormValidate::text("Title", $_POST['title'], 1, 42);
	FormValidate::text("Description", $_POST['description'], 0, 128);
	
	FormValidate::number("Visible To", $_POST['perm_read'], 0, 9);
	FormValidate::number("Post Clearance", $_POST['perm_post'], 0, 9);
	
	// Confirm that the category ID exists
	if(!$getCat = Database::selectValue("SELECT id FROM forum_categories WHERE id=? LIMIT 1", array($_POST['category_id'])))
	{
		Alert::error("Category", "That category doesn't exist.");
	}
	
	if(FormValidate::pass())
	{
		$forumID = AppForumAdmin::createForum($_POST['category_id'], $_POST['parent_id'], $_POST['title'], $_POST['description'], $_POST['perm_read'], $_POST['perm_post']);
		
		Alert::success("Forum Created", "You have successfully created a forum.");
	}
}
else
{
	$_POST['title'] = '';
	$_POST['parent_id'] = 0;
	$_POST['description'] = '';
	$_POST['perm_read'] = 0;
	$_POST['perm_post'] = 2;
}

// Run Permissions
require(SYS_PATH . "/controller/includes/admin_perm.php");

// Run Header
require(SYS_PATH . "/controller/includes/admin_header.php");

// Gather the list of categories available
$categories = AppForum::getCategories();

if(!$categories)
{
	Alert::saveSuccess("No Categories", "You cannot create a forum until you have at least one category.");
	
	header("Location: /admin/categories/create"); exit;
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

$forums = array();
foreach($categories as $cat)
{
	$forum = AppForum::getForums((int) $cat['id']);
	foreach($forum as $f)
	{
		$forums[] = array('id' => $f['id'], 'title' => $f['title']);
	}
}

echo '
<h2>Create a Forum</h2>
<form class="uniform" action="/admin/forums/create" method="post">' . Form::prepare("forum-create") . '
	
	<p>Category:
	<select name="category_id">';
	
	foreach($categories as $cat)
	{
		echo '
		<option value="' . $cat['id'] . '"' . ($_POST['category_id'] == $cat['id'] ? ' selected' : '') . '>' . $cat['title'] . '</option>';
	}
	
	echo '
	</select>
	</p>
	<p>Parent Forum:
	<select name="parent_id">
		<option value="0">&nbsp;</option>';
	
	foreach($forums as $forum)
	{
		echo '
		<option value="' . $forum['id'] . '"' . ($_POST['parent_id'] == $forum['id'] ? ' selected' : '') . '>' . $forum['title'] . '</option>';
	}
	
	echo '
	</select>
	</p>
	
	<p>Title: <input type="text" name="title" value="' . htmlspecialchars($_POST['title']) . '" /></p>
	<p>Description: <input type="text" name="description" value="' . htmlspecialchars($_POST['description']) . '" /></p>
	
	<p>Visible To:
	<select name="perm_read">' . str_replace('value="' . ($_POST['perm_read'] + 0) . '"', 'value="' . ($_POST['perm_read'] + 0) . '" selected', $select) . '
	</select>
	</p>
	
	<p>Post Clearance:
	<select name="perm_post">' . str_replace('value="' . ($_POST['perm_post'] + 0) . '"', 'value="' . ($_POST['perm_post'] + 0) . '" selected', $select) . '
	</select>
	</p>
	
	<p><input type="submit" name="submit" value="Create Forum" /></p>
</form>';

// Display the Footer
require(SYS_PATH . "/controller/includes/admin_footer.php");