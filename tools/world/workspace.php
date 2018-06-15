<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

     $pgtitle = 'Workspace - ';

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);

?>
<div class="mainbox">

  <div class="col-md-4">
  <select id="search1">
  <option value=""></option>
  <?php
  $searchdrop = "SELECT title FROM world";
  $searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
  while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
    $search = $searchrow['title'];
    $searchvalue = $search.'1';
    echo "<option value=\"$searchvalue\">$search</option>";
  }
  ?>
  <?php
  $searchdrop1 = "SELECT title FROM compendium";
  $searchdata1 = mysqli_query($dbcon, $searchdrop1) or die('error getting data');
  while($searchrow1 =  mysqli_fetch_array($searchdata1, MYSQLI_ASSOC)) {
    $search1 = $searchrow1['title'];
    $searchvalue1 = $search1.'2';
    echo "<option value=\"$searchvalue1\">$search1</option>";
  }
  ?>
  <?php
  $searchdrop2 = "SELECT title FROM srd";
  $searchdata2 = mysqli_query($dbcon, $searchdrop2) or die('error getting data');
  while($searchrow2 =  mysqli_fetch_array($searchdata2, MYSQLI_ASSOC)) {
    $search2 = $searchrow2['title'];
    $searchvalue2 = $search2.'3';
    echo "<option value=\"$searchvalue2\">Rules: $search2</option>";
  }
  ?>
  </select>
  <div id="box1"><iframe class="blockframe" id="frame1"></iframe></div>
</div>


<div class="col-md-4">
<select id="search2">
<option value=""></option>
<?php
$searchdrop = "SELECT title FROM world";
$searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
  $search = $searchrow['title'];
  $searchvalue = $search.'1';
  echo "<option value=\"$searchvalue\">$search</option>";
}
?>
<?php
$searchdrop1 = "SELECT title FROM compendium";
$searchdata1 = mysqli_query($dbcon, $searchdrop1) or die('error getting data');
while($searchrow1 =  mysqli_fetch_array($searchdata1, MYSQLI_ASSOC)) {
  $search1 = $searchrow1['title'];
  $searchvalue1 = $search1.'2';
  echo "<option value=\"$searchvalue1\">$search1</option>";
}
?>
<?php
$searchdrop2 = "SELECT title FROM srd";
$searchdata2 = mysqli_query($dbcon, $searchdrop2) or die('error getting data');
while($searchrow2 =  mysqli_fetch_array($searchdata2, MYSQLI_ASSOC)) {
  $search2 = $searchrow2['title'];
  $searchvalue2 = $search2.'3';
  echo "<option value=\"$searchvalue2\">Rules: $search2</option>";
}
?>
</select>
<div id="box2"><iframe class="blockframe" id="frame2"></iframe></div>

</div>

<div class="col-md-4">
<select id="search3">
<option value=""></option>
<?php
$searchdrop = "SELECT title FROM world";
$searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
  $search = $searchrow['title'];
  $searchvalue = $search.'1';
  echo "<option value=\"$searchvalue\">$search</option>";
}
?>
<?php
$searchdrop1 = "SELECT title FROM compendium";
$searchdata1 = mysqli_query($dbcon, $searchdrop1) or die('error getting data');
while($searchrow1 =  mysqli_fetch_array($searchdata1, MYSQLI_ASSOC)) {
  $search1 = $searchrow1['title'];
  $searchvalue1 = $search1.'2';
  echo "<option value=\"$searchvalue1\">$search1</option>";
}
?>
<?php
$searchdrop2 = "SELECT title FROM srd";
$searchdata2 = mysqli_query($dbcon, $searchdrop2) or die('error getting data');
while($searchrow2 =  mysqli_fetch_array($searchdata2, MYSQLI_ASSOC)) {
  $search2 = $searchrow2['title'];
  $searchvalue2 = $search2.'3';
  echo "<option value=\"$searchvalue2\">Rules: $search2</option>";
}
?>
</select>
<div id="box3"><iframe class="blockframe" id="frame3"></iframe></div>

</div>



  <script type="text/javascript">
  $('#search1').selectize({
  onChange: function(value){
    if(value.slice(-1) == 1) {
    document.getElementById("frame1").src = '/tools/world/world1.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 2) {

    document.getElementById("frame1").src = '/tools/compendium/compendium1.php?id=' + value.slice(0, -1);
  }
  else {

    document.getElementById("frame1").src = '/tools/srd/rules1.php?id=' + value.slice(0, -1);
  }
  },
  create: false,
  openOnFocus: false,
  maxOpions: 4,
  sortField: 'text',
  placeholder: 'search...'
  },);
  </script>

  <script type="text/javascript">
  $('#search2').selectize({
  onChange: function(value){
    if(value.slice(-1) == 1) {
    document.getElementById("frame2").src = '/tools/world/world1.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 2) {

    document.getElementById("frame2").src = '/tools/compendium/compendium1.php?id=' + value.slice(0, -1);
  }
  else {

    document.getElementById("frame2").src = '/tools/srd/rules1.php?id=' + value.slice(0, -1);
  }
  },
  create: false,
  openOnFocus: false,
  maxOpions: 4,
  sortField: 'text',
  placeholder: 'search...'
  },);
  </script>

  <script type="text/javascript">
  $('#search3').selectize({
  onChange: function(value){
    if(value.slice(-1) == 1) {
    document.getElementById("frame3").src = '/tools/world/world1.php?id=' + value.slice(0, -1);
  }
  else if(value.slice(-1) == 2) {

    document.getElementById("frame3").src = '/tools/compendium/compendium1.php?id=' + value.slice(0, -1);
  }
  else {

    document.getElementById("frame3").src = '/tools/srd/rules1.php?id=' + value.slice(0, -1);
  }
  },
  create: false,
  openOnFocus: false,
  maxOpions: 4,
  sortField: 'text',
  placeholder: 'search...'
  },);
  </script>

</div>
<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
