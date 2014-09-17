<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Update User Activity
UserActivity::update();

// Prepare Notifications (if available)
if(Me::$loggedIn)
{
	WidgetLoader::add("SidePanel", 1, Notifications::sideWidget());
}

// Main Navigation
// $urlActive = (isset($url[0]) && $url[0] != "" ? $url[0] : "home");
// <a class="panel-link' . ($urlActive == "home" ? " panel-active" : "") . '" href="/"><span class="icon-image panel-icon"></span><span class="panel-title">Home</span></a>

// Main Navigation
WidgetLoader::add("SidePanel", 50, '
<div class="panel-box">
	<ul class="panel-slots">
		<li class="nav-slot"><a href="/user-panel/subscriptions">Subscriptions<span class="icon-circle-right nav-arrow"></span></a></li>
	</ul>
</div>');

