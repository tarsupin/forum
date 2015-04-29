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

if(isset($_GET['remove']))
{
	if($uniID = User::getIDByHandle($_GET['remove']))
	{
		if(Poll::removeVote((int) $question['id'], $uniID))
		{
			Alert::success("Removed", $_GET['remove'] . '\'s vote has been removed.');
		}
		else
		{
			Alert::error("Not Removed", $_GET['remove'] . '\'s vote could not be removed.');
		}
	}
}

if(!$standings = Poll::getStandings((int) $question['id']))
{
	header("Location: /");
	exit;
}

// Set page title
$config['pageTitle'] = "View Standings";

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
	.polltable { border-right:solid 1px #e2e2e1; width:100%; text-align:left; }
	.polltable th { border-left:solid 1px #e2e2e1; color:white; background-color:#57c2c1; padding:6px 10px 6px 12px; }
	.polltable td { border-left:solid 1px #e2e2e1; color:#263a54; padding:6px 10px 6px 12px; font-size:0.85em; }
	.polltable tr:nth-child(odd) { background-color:#f8f8f7; }
</style>
<div id="panel-right"></div>
<div id="content">' . Alert::display() . '
<div class="overwrap-box">
	<div class="overwrap-line">View Standings</div>
	<div class="inner-box">' . 
		Poll::displayStandings($standings) . '
		<br/>
		<form class="uniform">
			<input type="button" value="Back to Poll" onclick="window.location.href=\'/poll-participate?id=' . $question['id'] . '\'">
		</form>
	</div>
</div>';

$participants = Poll::displayVotes((int) $question['id'], (int) $question['author_id']);
if($participants != "")
{
	echo '
<div class="overwrap-box">
	<div class="overwrap-line">View Participants</div>
	<div class="inner-box">' . 
		$participants . '
	</div>
</div>
';
}

echo '
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");