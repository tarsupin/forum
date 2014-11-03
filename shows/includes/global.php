<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// UniFaction Dropdown Menu
WidgetLoader::add("UniFactionMenu", 10, '
<div class="menu-wrap">
	<ul class="menu"><li class="menu-slot"><a href="/">Home</a></li><li class="menu-slot"><a href="/subscriptions">Subscriptions</a></li><li class="menu-slot"><a href="' . URL::music_unifaction_community() . Me::$slg . '">Music Community</a></li><li class="menu-slot"><a href="' . URL::shows_unifaction_community() . Me::$slg . '">Shows Community</a></li></ul>
</div>');

// Main Navigation
WidgetLoader::add("SidePanel", 50, '
<div class="panel-box">
	<ul class="panel-slots">
		<li class="nav-slot' . ($url[0] == "" ? " nav-active" : "") . '"><a href="/">Main Forum<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot' . ($url[0] == "subscriptions" ? " nav-active" : "") . '"><a href="/subscriptions">Subscriptions<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::music_unifaction_community() . Me::$slg . '">Music Community<span class="icon-circle-right nav-arrow"></span></a></li>
		<li class="nav-slot"><a href="' . URL::shows_unifaction_community() . Me::$slg . '">Shows Community<span class="icon-circle-right nav-arrow"></span></a></li>
	</ul>
</div>');