<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// UniFaction Dropdown Menu
WidgetLoader::add("UniFactionMenu", 10, '
<div class="menu-wrap hide-600">
	<ul class="menu"><li class="menu-slot"><a href="/">Home</a><ul><li class="menu-slot"><a href="/settings">Settings</a></li></ul></li><li class="menu-slot"><a href="/subscriptions">Subscriptions</a></li><li class="menu-slot"><a href="' . URL::travel_unifaction_community() . Me::$slg . '">Travel Community</a></li><li class="menu-slot"><a href="' . URL::fitness_unifaction_community() . Me::$slg . '">Fitness Community</a></li><li class="menu-slot"><a href="' . URL::relationship_unifaction_community() . Me::$slg . '">Relationship Community</a></li></ul>
</div>');

// Main Navigation
WidgetLoader::add("SidePanel", 50, '
<div class="panel-box">
	<ul class="panel-slots">
		<li class="nav-slot' . ($url[0] == "" ? " nav-active" : "") . '"><a href="/">Main Forum<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "settings" ? " nav-active" : "") . '"><a href="/settings">Settings<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "subscriptions" ? " nav-active" : "") . '"><a href="/subscriptions">Subscriptions<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::travel_unifaction_community() . Me::$slg . '">Travel Community<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::fitness_unifaction_community() . Me::$slg . '">Fitness Community<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::relationship_unifaction_community() . Me::$slg . '">Relationship Community<span class="icon-circle-right nav-arrow"></span></a></li>
	</ul>
</div>');