<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Make sure you're logged in
if(!Me::$loggedIn)
{
	Me::redirectLogin("/transfer");
}

// Run Action to Transfer
if(Form::submitted("transfer"))
{
	$_POST['account'] = Sanitize::variable($_POST['account'], ".");
	$_POST['password'] = trim($_POST['password']);
	$pass = Database::selectOne("SELECT account, password, post_count, joinDate FROM _transfer_accounts WHERE account=? AND uni6_id=? LIMIT 1", array($_POST['account'], 0));
	if(!$pass)
	{
		Alert::error("Wrong Username", "The user " . $_POST['account'] . " does not exist on Uni5, or you have already transferred.");
	}
	else
	{
		// check password
		if($pass['password'] == sha1($_POST['password']))
		{
			Database::startTransaction();
			
			if($pass['joinDate'] != 0)
			{		
				// transfer post count and join date
				if($pass2 = Database::query("UPDATE users SET date_joined=?, post_count=post_count+? WHERE uni_id=? LIMIT 1", array((int) $pass['joinDate'], (int) $pass['post_count'], Me::$id)))
				{
					if($pass2 = Database::query("UPDATE _transfer_accounts SET uni6_id=? WHERE account=? LIMIT 1", array(Me::$id, $pass['account'])))
					{
						Alert::success("Transfer", "Your join date and post count have been transferred.");
					}
				}
				
				Database::endTransaction($pass2);
			}
			else
			{
				Alert::error("No Date", "You didn't have an account on the Uni5 forum.");
			}
		}
		else
		{
			Alert::error("Wrong Password", "The password does not match.");
		}
	}
}

// Set page title
$config['pageTitle'] = $config['site-name'] . " > Transfer from Uni5";

// Run Global Script
require(CONF_PATH . "/includes/global.php");

// Display the Header
require(SYS_PATH . "/controller/includes/metaheader.php");
require(SYS_PATH . "/controller/includes/header.php");

// Display Side Panel
require(SYS_PATH . "/controller/includes/side-panel.php");

echo '
<div id="panel-right"></div>
<div id="content">' .
Alert::display() . '
<div class="overwrap-box">
	<div class="overwrap-line">Transfer from Uni5</div>
	<div class="inner-box">
	<p>This will transfer your join date and post count.</p>
	
	<form class="uniform" method="post">' . Form::prepare("transfer") . '
		<h4>Uni5 Account Name</h4>
		<p><input type="text" name="account"/></p>
		<h4>Uni5 Password</h4>
		<p><input type="password" name="password"/></p>
		<input type="submit" name="submit" value="Transfer" />
	</form>
	</div>
</div>
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
