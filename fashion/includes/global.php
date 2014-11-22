<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// UniFaction Dropdown Menu
WidgetLoader::add("UniFactionMenu", 10, '
<div class="menu-wrap hide-600">
	<ul class="menu"><li class="menu-slot"><a href="/">Home</a></li><li class="menu-slot"><a href="/settings">Settings</a></li><li class="menu-slot"><a href="/subscriptions">Subscriptions</a></li><li class="menu-slot"><a href="' . URL::unifaction_com() . '/communities">Communities</a><ul><li class="dropdown-slot"><a href="' . URL::diy_unifaction_community() . Me::$slg . '">DIY Community</a></li><li class="dropdown-slot"><a href="' . URL::fitness_unifaction_community() . Me::$slg . '">Fitness Community</a></li><li class="dropdown-slot"><a href="' . URL::relationships_unifaction_community() . Me::$slg . '">Relationships</a></li><li class="dropdown-slot"><a href="' . URL::travel_unifaction_community() . Me::$slg . '">Travel Community</a></li><li class="dropdown-slot"><a href="' . URL::unifaction_com() . '/communities' . Me::$slg . '">... more</a></li></ul></li></ul>
</div>');

// Main Navigation
WidgetLoader::add("MobilePanel", 50, '
<div class="panel-box">
	<ul class="panel-slots">
		<li class="nav-slot' . ($url[0] == "" ? " nav-active" : "") . '"><a href="/">Main Forum<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "settings" ? " nav-active" : "") . '"><a href="/settings">Settings<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "subscriptions" ? " nav-active" : "") . '"><a href="/subscriptions">Subscriptions<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::unifaction_com() . '/communities' . Me::$slg . '">All Communities<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::diy_unifaction_community() . Me::$slg . '">DIY Community<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::fitness_unifaction_community() . Me::$slg . '">Fitness Community<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::relationships_unifaction_community() . Me::$slg . '">Relationships<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::travel_unifaction_community() . Me::$slg . '">Travel Community<span class="icon-circle-right nav-arrow"></span></a></li>
	</ul>
</div>');