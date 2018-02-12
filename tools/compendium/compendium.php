<?php
include('../../sql-connect.php');
include('header.html');
$id = "index";
$disallowed_paths = array('header', 'footer');
if (!empty($_GET['id'])) {
  $tmp_action = basename($_GET['id']);
  if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("compendium/{$tmp_action}.php")*/)
        $id = $tmp_action;
  include("index.php");
  }
if (empty($_GET['id'])) {
  include('toc.php');

}
  include('footer.html');
?>
