<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

/*
	/admin/categories/create		{this is specific to forums}
	
	This page allows you to create categories.
*/

// Submit Form
if(Form::submitted("forum-category-create"))
{
	FormValidate::text("Category", $_POST['category'], 1, 32);
	
	// If form has passed
	if(FormValidate::pass())
	{
		$catID = AppForumAdmin::createCategory($_POST['category']);
		
		Alert::success("Category", "You have created a new category!");
	}
}

// Run Permissions
require(SYS_PATH . "/controller/includes/admin_perm.php");

// Run Header
require(SYS_PATH . "/controller/includes/admin_header.php");

echo '
<form class="uniform" action="/admin/categories/create" method="post">' . Form::prepare("forum-category-create") . '
	<p>Category: <input type="text" name="category" value="" /></p>
	<p><input type="submit" name="submit" value="Create Category" /></p>
</form>';

// Display the Footer
require(SYS_PATH . "/controller/includes/admin_footer.php");
