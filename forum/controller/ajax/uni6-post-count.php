<?php if(!defined("CONF_PATH")) { die("No direct script access allowed."); }

if(!isset($_POST['uni_id']) || $_POST['uni_id'] <= 0 || !isset($_POST['uni6_count']))
{
	exit;
}

$_POST['uni_id'] = (int) $_POST['uni_id'];
$_POST['uni6_count'] = (int) $_POST['uni6_count'];

if(!$olddata = Database::selectOne("SELECT post_count FROM _transfer_accounts WHERE uni6_id=? LIMIT 1", array($_POST['uni_id'])))
{
	echo json_encode(array("uni_id" => $_POST['uni_id']));
	exit;
}

echo json_encode(array("uni5" => $olddata['post_count'], "uni6" => ($_POST['uni6_count'] - $olddata['post_count']), "uni_id" => $_POST['uni_id']));