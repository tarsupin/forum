<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Make sure you're logged in
if(!Me::$loggedIn)
{
	Me::redirectLogin("/poll-new");
}

// this is temporary until everything is ready for public use
if(Me::$clearance < 4)
{
	header("Location: /");
	exit;
}

// check and add the new poll
if(Form::submitted("pollcreate"))
{
	$start = date_create_from_format("Y/m/d h:ia", trim($_POST['starttime']));
	$end = date_create_from_format("Y/m/d h:ia", trim($_POST['endtime']));
	
	$poll = Poll::create($_POST['title'], $_POST['description'], $start->getTimestamp(), $end->getTimestamp(), (int) $_POST['maxchoice'], ($_POST['priority'] == "yes" ? true : false), $_POST['standings'], ($_POST['randomize'] == "yes" ? true : false));
	
	if($poll > 0)
	{
		Alert::saveSuccess("Poll Created", "Your poll has been created! You can edit it now and add answer options.");
		header("Location: /poll-edit?id=" . $poll);
		exit;
	}
}

// Set page title
$config['pageTitle'] = "Create Poll";

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
	<div class="overwrap-line">Create Poll</div>
	<div class="inner-box">';

$nextfullhour = mktime((int) date("G")+1, 0);
	
echo '
	<form class="uniform" method="post">' . Form::prepare("pollcreate") . '
		Title (max 100 characters):<br/>
		<input type="text" name="title" maxlength="100" style="width:100%;" value="' . (isset($_POST['title']) ? $_POST['title'] : '') . '"/><br/>
		Question (max 250 characters):<br/>
		<input type="text" name="description" maxlength="250" style="width:100%;" value="' . (isset($_POST['description']) ? $_POST['description'] : '') . '"/><br/>
		Start date and time:<br/>
		<input type="text" name="starttime" maxlength="18" value="' . (isset($_POST['starttime']) ? $_POST['starttime'] : date("Y/m/d h:ia", $nextfullhour)) . '"/><br/>
		End date and time:<br/>
		<input type="text" name="endtime" maxlength="18" value="' . (isset($_POST['endtime']) ? $_POST['endtime'] : date("Y/m/d h:ia", $nextfullhour+3600*24*7)) . '"/><br/>
		
		<div class="spacer"></div>
		
		Max number of answers a participant is allowed to give:<br/>
		<input type="number" name="maxchoice" size="3" min="1" max="100" value="' . (isset($_POST['maxchoice']) ? $_POST['maxchoice'] : '1') . '"/><br/>
		Randomize display order of options:<br/>
		<select name="randomize">
			<option value="no">no</option>
			<option value="yes"' . (isset($_POST['randomize']) && $_POST['randomize'] == "yes" ? ' selected' : '') . '>yes</option>
		</select><br/>
		Weight answers:<br/>
		<select name="priority">
			<option value="no">no</option>
			<option value="yes"' . (isset($_POST['priority']) && $_POST['priority'] == "yes" ? ' selected' : '') . '>according to priority</option>
		</select><br/>
		Standings may be seen:<br/>
		<select name="standings">
			<option value="closed">after the poll has ended</option>
			<option value="vote"' . (isset($_POST['standings']) && $_POST['standings'] == "vote" ? ' selected' : '') . '>after voting</option>
			<option value="public"' . (isset($_POST['standings']) && $_POST['standings'] == "public" ? ' selected' : '') . '>at any time</option>
		</select><br/>
		
		<div class="spacer"></div>
		
		<input type="submit" value="Create Poll"/>
	</form>';

echo '
	</div>
</div>
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");