<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

// Load Forum-Specific Panel Links
$userPanel['Forum']['Thread Subscriptions'] = "/user-panel/subscriptions";

// Reorder the Panel
$userPanel = array('Forum' => $userPanel['Forum']) + $userPanel;