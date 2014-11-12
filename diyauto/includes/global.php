<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// UniFaction Dropdown Menu
WidgetLoader::add("UniFactionMenu", 10, '
<div class="menu-wrap hide-600">
	<ul class="menu"><li class="menu-slot"><a href="/">Home</a><ul><li class="dropdown-slot"><a href="/settings">Settings</a></li></ul></li><li class="menu-slot"><a href="/subscriptions">Subscriptions</a></li><li class="menu-slot"><a href="' . URL::unifaction_com() . '/communities">Communities</a><ul><li class="dropdown-slot"><a href="' . URL::diyhome_unifaction_community() . Me::$slg . '">DIY: Home Improvement</a></li><li class="dropdown-slot"><a href="' . URL::diyoutdoor_unifaction_community() . Me::$slg . '">DIY: Outdoor</a></li><li class="dropdown-slot"><a href="' . URL::intdesign_unifaction_community() . Me::$slg . '">Interior Design</a></li><li class="dropdown-slot"><a href="' . URL::unifaction_com() . '/communities' . Me::$slg . '">... more</a></li></ul></li></ul>
</div>');

// Main Navigation
WidgetLoader::add("SidePanel", 50, '
<div class="panel-box">
	<ul class="panel-slots">
		<li class="nav-slot' . ($url[0] == "" ? " nav-active" : "") . '"><a href="/">Main Forum<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "settings" ? " nav-active" : "") . '"><a href="/settings">Settings<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "subscriptions" ? " nav-active" : "") . '"><a href="/subscriptions">Subscriptions<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::unifaction_com() . '/communities' . Me::$slg . '">All Communities<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::diyhome_unifaction_community() . Me::$slg . '">DIY: Home Improvement<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::intdesign_unifaction_community() . Me::$slg . '">Interior Design<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::diyoutdoor_unifaction_community() . Me::$slg . '">DIY: Outdoor<span class="icon-circle-right nav-arrow"></span></a></li>
	</ul>
</div>');