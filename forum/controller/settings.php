<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// You must be logged in
if(!Me::$loggedIn)
{
	Me::redirectLogin("/settings"); exit;
}

// Run the Form
if(Form::submitted(SITE_HANDLE . "setting-form"))
{
	FormValidate::text("Signature", $_POST['signature'], 0, 20000);
	
	if(FormValidate::pass())
	{
		AppForum::updateSignature(Me::$id, $_POST['signature']);
		
		Alert::success("Signature Updated", "You have successfully updated your settings.");
	}
}

// Get the user's signature
$signature = AppForum::getSignature(Me::$id, true);

// Update Activity
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
<div class="overwrap-box">
	<div class="overwrap-line" style="margin-bottom:10px;">
		<div class="overwrap-name">My Signature</div>
	</div>
	' . UniMarkup::buttonLine() . '
	<div style="padding:6px;">
		<form class="uniform" action="/settings" method="post" style="padding-right:20px;">' . Form::prepare(SITE_HANDLE . 'setting-form') . '
			<textarea id="core_text_box" name="signature" placeholder="Enter your signature here . . ." style="resize:vertical; width:100%; height:280px;" maxlength="20000">' . $signature . '</textarea>
			<div style="margin-top:10px;"><input type="submit" name="submit" value="Update My Signature" /></div>
		</form>
	</div>
</div>';

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");
