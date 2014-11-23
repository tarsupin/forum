<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// UniFaction Dropdown Menu
WidgetLoader::add("UniFactionMenu", 10, '
<div class="menu-wrap hide-600">
	<ul class="menu"><li class="menu-slot"><a href="/">Home</a></li><li class="menu-slot"><a href="/settings">Settings</a></li><li class="menu-slot"><a href="/subscriptions">Subscriptions</a></li><li class="menu-slot"><a href="' . URL::unifaction_community() . Me::$slg . '">Communities</a><ul><li class="dropdown-slot"><a href="' . URL::books_unifaction_community() . Me::$slg . '">Book Club</a></li><li class="dropdown-slot"><a href="' . URL::gaming_unifaction_community() . Me::$slg . '">Gaming Fans</a></li><li class="dropdown-slot"><a href="' . URL::movies_unifaction_community() . Me::$slg . '">Movie Fans</a></li><li class="dropdown-slot"><a href="' . URL::tech_unifaction_community() . Me::$slg . '">Tech Community</a></li><li class="dropdown-slot"><a href="' . URL::shows_unifaction_community() . Me::$slg . '">TV and Web Shows</a></li><li class="dropdown-slot"><a href="' . URL::unifaction_community() . Me::$slg . '">... more</a></li></ul></li></ul>
</div>');

// Main Navigation
WidgetLoader::add("MobilePanel", 50, '
<div class="panel-box">
	<ul class="panel-slots">
		<li class="nav-slot' . ($url[0] == "" ? " nav-active" : "") . '"><a href="/">Main Forum<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "settings" ? " nav-active" : "") . '"><a href="/settings">Settings<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "subscriptions" ? " nav-active" : "") . '"><a href="/subscriptions">Subscriptions<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::unifaction_community() . Me::$slg . '">All Communities<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::books_unifaction_community() . Me::$slg . '">Gaming Fans<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::gaming_unifaction_community() . Me::$slg . '">Gaming Fans<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::movies_unifaction_community() . Me::$slg . '">Movies Fans<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::tech_unifaction_community() . Me::$slg . '">Tech Community<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::shows_unifaction_community() . Me::$slg . '">TV and Web Shows<span class="icon-circle-right nav-arrow"></span></a></li>
	</ul>
</div>');