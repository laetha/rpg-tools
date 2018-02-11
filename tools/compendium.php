<?php
include('../sql-connect.php');
include('compendium/header.html');
$id = "index";
$disallowed_paths = array('header', 'footer');
if (!empty($_GET['id'])) {
  $tmp_action = basename($_GET['id']);
  if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("compendium/{$tmp_action}.php")*/)
        $id = $tmp_action;
  }
  include("compendium/index.php");
  include('compendium/footer.html');
?>
