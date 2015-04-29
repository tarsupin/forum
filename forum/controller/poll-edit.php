<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Make sure you're logged in
if(!Me::$loggedIn)
{
	Me::redirectLogin("/");
}

// this is temporary until everything is ready for public use
if(Me::$clearance < 4)
{
	header("Location: /");
	exit;
}

if(!isset($_GET['id']))
{
	header("Location: /");
	exit;
}
$_GET['id'] = (int) $_GET['id'];

if(!$question = Poll::checkEditPermission($_GET['id']))
{
	header("Location: /");
	exit;
}
$rules = Poll::getRules($question);

// edit the poll
if(Form::submitted("polledit"))
{
	$start = date_create_from_format("Y/m/d h:ia", trim($_POST['starttime']));
	$end = date_create_from_format("Y/m/d h:ia", trim($_POST['endtime']));
	if(Poll::edit((int) $question['id'], $_POST['title'], $_POST['description'], $start->getTimestamp(), $end->getTimestamp(), (int) $_POST['maxchoice'], ($_POST['priority'] == "yes" ? true : false), $_POST['standings'], ($_POST['randomize'] == "yes" ? true : false)))
	{
		Alert::success("Poll Edited", "The poll has been edited.");
	}
	else
	{
		Alert::error("Poll Not Edited", "The poll could not be edited. Please correct your input and try again.");
	}
}

// add an option
if(Form::submitted("addoption"))
{
	if(Poll::addOption((int) $question['id'], $_POST['option']))
	{
		Alert::success("Option Added", "The option has been added.");
	}
	else
	{
		Alert::error("Not Added", "The option could not be added.");
	}
}

if(Form::submitted("editoption"))
{
	// edit an option
	if(isset($_POST['edit']))
	{
		if(Poll::editOption((int) $question['id'], (int) $_POST['id'], $_POST['option']))
		{
			Alert::success("Option Edited", "The option has been edited.");
		}
		else
		{
			Alert::error("Not Edited", "The option could not be edited.");
		}
	}
	
	// delete an option
	elseif(isset($_POST['delete']))
	{
		if(Poll::deleteOption((int) $question['id'], (int) $_POST['id']))
		{
			Alert::success("Option Deleted", "The option has been deleted.");
		}
		else
		{
			Alert::error("Not Deleted", "The option could not be deleted.");
		}
	}

	// move an option
	elseif(isset($_POST['up']) || isset($_POST['down']))
	{
		if(Poll::moveOption((int) $question['id'], (int) $_POST['id'], (isset($_POST['up']) ? true : false)))
		{
			Alert::success("Option Moved", "The option has been moved.");
		}
		else
		{
			Alert::error("Not Moved", "The option could not be moved.");
		}
	}
}

// Set page title
$config['pageTitle'] = "Edit Poll";

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
	<div class="overwrap-line">Edit Poll</div>
	<div class="inner-box">';

echo '
	<form class="uniform" method="post">' . Form::prepare("polledit") . '
		Title (max 100 characters):<br/>
		<input type="text" name="title" maxlength="100" style="width:100%;" value="' . (isset($_POST['title']) ? $_POST['title'] : $question['title']) . '"/><br/>
		Question (max 250 characters):<br/>
		<input type="text" name="description" maxlength="250" style="width:100%;" value="' . (isset($_POST['description']) ? $_POST['description'] : $question['description']) . '"/><br/>
		Start date and time:<br/>
		<input type="text" name="starttime" maxlength="18" value="' . date("Y/m/d h:ia", (isset($_POST['date_start']) ? $_POST['date_start'] : $question['date_start'])) . '"/><br/>
		End date and time:<br/>
		<input type="text" name="endtime" maxlength="18" value="' . date("Y/m/d h:ia", (isset($_POST['date_end']) ? $_POST['date_end'] : $question['date_end'])) . '"/><br/>
		
		<div class="spacer"></div>
		
		Max number of answers a participant is allowed to give:<br/>
		<input type="number" name="maxchoice" size="3" min="1" max="100" value="' . $rules['max_choices'] . '"/><br/>
		Randomize display order of options:<br/>
		<select name="randomize">
			<option value="no">no</option>
			<option value="yes"' . ($rules['randomize_display'] ? ' selected' : '') . '>yes</option>
		</select><br/>
		Weight answers:<br/>
		<select name="priority">
			<option value="no">no</option>
			<option value="yes"' . ($rules['priority_weight'] ? ' selected' : '') . '>according to priority</option>
		</select><br/>
		Standings may be seen:<br/>
		<select name="standings">
			<option value="closed">after the poll has ended</option>
			<option value="vote"' . ($rules['view_standings'] == "vote" ? ' selected' : '') . '>after voting</option>
			<option value="public"' . ($rules['view_standings'] == "public" ? ' selected' : '') . '>at any time</option>
		</select><br/>
		
		<div class="spacer"></div>
		
		<input type="submit" value="Edit Poll"/>
		
	</form>';

echo '
	</div>
</div>

<div class="overwrap-box">
	<div class="overwrap-line">Edit Options</div>
	<div class="inner-box">';
	
$options = Poll::getOptions((int) $question['id']);
if($options != array())
{
	echo '
	Edit options (max 120 characters):<br/>';
	
	// sort by set position
	usort($options, function($a, $b)
	{
		if($a['sort_position'] == $b['sort_position'])
		{
			return 0;
		}
		return ($a['sort_position'] < $b['sort_position']) ? -1 : 1;
	});
}
foreach($options as $opt)
{
	echo '
	<form class="uniform" method="post">' . Form::prepare("editoption") . '
		<input type="hidden" name="id" value="' . $opt['option_id'] . '"/>
		<input type="text" name="option" value="' . $opt['text'] . '" style="width:100%;"/><br/>
		<input type="submit" name="edit" value="Edit"/>
		<input type="submit" name="delete" value="Delete"/>
		<input type="submit" name="up" value="Up"/>
		<input type="submit" name="down" value="Down"/>
	</form>';
}

echo '
	Add an option (max 120 characters):<br/>
	<form class="uniform" method="post">' . Form::prepare("addoption") . '
		<input type="text" name="option" maxlength="120" style="width:100%;"/><br/>
		<input type="submit" value="Add"/>
	</form>';
	
echo '
	</div>
</div>
</div>';

// Display the Footer
require(SYS_PATH . "/controller/includes/footer.php");