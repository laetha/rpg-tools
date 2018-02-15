<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.html";
   include_once($headpath);

//Display specific page or Table of Contents
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
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.html";
include_once($footpath);
?>
