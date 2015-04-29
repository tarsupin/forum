<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Make sure you're logged in
if(!Me::$loggedIn)
{
	Me::redirectLogin("/");
}

if(!isset($_GET['id']))
{
	header("Location: /");
	exit;
}

$_GET['id'] = (int) $_GET['id'];

if(!$question = Poll::getQuestion($_GET['id']))
{
	header("Location: /");
	exit;
}

// process vote
if(Form::submitted("pollanswer"))
{
	foreach($_POST as $key => $val)
	{
		if($key != "selection" && substr($key, 0, 5) != "optid" && $key != "redo")
		{
			unset($_POST[$key]);
		}
	}
	
	if(Poll::vote((int) $question['id'], Poll::getRules($question), $_POST))
	{
		$_POST = array();
		Alert::success("Voted", "Thanks for voting!");
	}
	else
	{
		if(isset($_POST['redo']))
		{
			unset($_POST['redo']);
		}
		Alert::error("Not Voted", "Sorry, something went wrong. Please check whether you have chosen at least one option and your vote follows the instructions, if any.");
	}
}

// Set page title
$config['pageTitle'] = "View Poll";

// Run Global Script
//require(APP_PATH . "/includes/global.php"); // use this after moving to its own site
require(CONF_PATH . "/includes/global.php");

// Display the Header
require(SYS_PATH . "/controller/includes/metaheader.php");
require(SYS_PATH . "/controller/includes/header.php");

// Display Side Panel
require(SYS_PATH . "/controller/includes/side-panel.php");

// Display the page
// style is temporary; remove when switching to its own site
echo '
<style>
	.overwrap-box { background-color:#d5e4ed; border:solid 1px #c0c0c0; border-radius:4px; padding:6px; margin-bottom:7px; }
	.inner-box { background-color:#e8eef1; border:solid 1px #c0c0c0; border-radius:4px; padding:6px; margin-top:6px; width:100%; overflow:hidden; border-collapse:separate; }
	.overwrap-line { padding:0px 2px 0px 2px; font-weight:bold; font-size:1.2em; }
	.spacer { height:50px; }
</style>
<div id="panel-right"></div>
<div id="content">' . Alert::display() . '
<div class="overwrap-box">
	<div class="overwrap-line">' . UniMarkup::parse($question['title']) . '</div>
	<div class="inner-box">';

echo Poll::displayPoll((int) $question['id']);
	
echo '
	</div>
</div>
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");