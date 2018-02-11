<?php
include('../sql-connect.php');
include('compendium/header.html');
$id = "index";
$disallowed_paths = array('header', 'footer');
if (!empty($_GET['action'])) {
  $tmp_action = basename($_GET['action']);
  if (!in_array($tmp_action, $disallowed_paths) && file_exists("compendium/{$tmp_action}.php"))
        $id = $tmp_action;
  }
  include("compendium/$id.php");
  include('compendium/footer.html');
?>
