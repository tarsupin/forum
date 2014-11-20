<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// UniFaction Dropdown Menu
WidgetLoader::add("UniFactionMenu", 10, '
<div class="menu-wrap hide-600">
	<ul class="menu"><li class="menu-slot"><a href="/">Home</a></li><li class="menu-slot"><a href="/settings">Settings</a></li><li class="menu-slot"><a href="/subscriptions">Subscriptions</a></li><li class="menu-slot"><a href="' . URL::unifaction_com() . '/communities">Communities</a><ul><li class="dropdown-slot"><a href="' . URL::art_unifaction_community() . Me::$slg . '">Art Community</a></li><li class="dropdown-slot"><a href="' . URL::music_unifaction_community() . Me::$slg . '">Music Community</a></li><li class="dropdown-slot"><a href="' . URL::pets_unifaction_community() . Me::$slg . '">Pet Community</a></li><li class="dropdown-slot"><a href="' . URL::writers_unifaction_community() . Me::$slg . '">Writer\'s Community</a></li><li class="dropdown-slot"><a href="' . URL::unifaction_com() . '/communities' . Me::$slg . '">... more</a></li></ul></li></ul>
</div>');

// Main Navigation
WidgetLoader::add("SidePanel", 50, '
<div class="panel-box">
	<ul class="panel-slots">
		<li class="nav-slot' . ($url[0] == "" ? " nav-active" : "") . '"><a href="/">Main Forum<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "settings" ? " nav-active" : "") . '"><a href="/settings">Settings<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "subscriptions" ? " nav-active" : "") . '"><a href="/subscriptions">Subscriptions<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::unifaction_com() . '/communities' . Me::$slg . '">All Communities<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::art_unifaction_community() . Me::$slg . '">Art Community<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::music_unifaction_community() . Me::$slg . '">Music Community<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::pets_unifaction_community() . Me::$slg . '">Pet Community<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::writers_unifaction_community() . Me::$slg . '">Writer\'s Community<span class="icon-circle-right nav-arrow"></span></a></li>
	</ul>
</div>');