<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Update User Activity
UserActivity::update();

// Prepare Notifications (if available)
if(Me::$loggedIn)
{
	WidgetLoader::add("SidePanel", 1, Notifications::sideWidget());
}

// Main Navigation
WidgetLoader::add("SidePanel", 50, '
<div class="panel-box">
	<ul class="panel-slots">
		<li class="nav-slot' . ($url[0] == "" ? " nav-active" : "") . '"><a href="/">Main Forum<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "subscriptions" ? " nav-active" : "") . '"><a href="/subscriptions">Subscriptions<span class="icon-circle-right nav-arrow"></span></a></li>
	</ul>
</div>');

