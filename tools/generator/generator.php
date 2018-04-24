<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic" rel="stylesheet" type="text/css">
<link href="/tools/compendium/statblock.css" rel="stylesheet" type="text/css">
<?php
  //SQL Connect
   $pgtitle = 'Generator - ';
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>


<div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">
  <h1 class="pagetitle">Generator</h1>
  <button class="btn btn-info col-centered" onclick="window.location.reload()">Re-generate</button>
<div class="row">
  <div class="col-md-4 sidebartext">
    <h2 class="col-centered">Magic Items</h2>
    <div class="sidebartext">
    <?php
    $worldtitle = "SELECT * FROM `compendium` WHERE `itemMagic` LIKE '1' ORDER BY rand() LIMIT 3";
    $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
    while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
      echo ('<div class="randitem">');
      $item = $row['title'];
      echo ('<h3 class="randitem"><a href="/tools/compendium/compendium.php?id='.$row['title'].'" target="_BLANK">'.$row['title'].'</a></h3>');
      echo ('<p>'.$row['itemDetail'].'</p>');
      echo nl2br('<p style="margin-bottom: 40px;">'.$row['text'].'</p>');
      echo ('</div>');
    }
    ?>
  </div>
  </div>

  <div class="col-md-4">
    <h2>Weather</h2>
    <div class="bodytext col-centered randitem">
    <?php

    $temperature = rand(1,20);
    $wind = rand(1,20);
    $rain = rand(1,20);

    if($rain >= 1 && $rain <= 6) {
      echo ('<p style="color:#E7BF4C;">Sunny/clear.</p>');
    }
    elseif($rain >= 7 && $rain <= 12) {
      echo ('<p style="color:grey;">Overcast.</p>');
    }
    elseif ($rain >= 13 && $rain <= 17){
      echo ('<p style="color:#5499c7;">Light rain/snow.</p>');
    }
    elseif ($rain >= 18 && $rain <= 20){
      echo ('<p style="color:#3D6D8D;">Heavy rain/snow.</p>');
    }

    if($wind >= 1 && $wind <= 12) {
      echo ('<p>Calm winds.</p>');
    }
    elseif ($wind >= 13 && $wind <= 17){
      echo ('<p>Breezy.</p>');
    }
    elseif ($wind >= 18 && $wind <= 20){
      echo ('<p>Strong winds.</p>');
    }


    if($temperature >= 1 && $temperature <= 14) {
      echo ('<p>Normal Temperature for the season.</p>');
    }
    elseif ($temperature >= 15 && $temperature <= 17){
      echo ('<p style="color:#C26339;">Unseasonably warm.</p>');
    }
    elseif ($temperature >= 18 && $temperature <= 20){
      echo ('<p style="color:#3D6D8D;">Unseasonably cold.</p>');
    }

     ?>
   </div>
  </div>

  <div class="col-md-4">
    <h2>NPCs</h2>
    <div class="randitem">
    <h3 style="color:#5499c7;">Male Names:</h3>
    <div class="sidebartext col-centered">
    <?php
    $worldtitle = "SELECT * FROM `npcs` WHERE `gender` LIKE 'male' ORDER BY rand() LIMIT 5";
    $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
    while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
      echo ('<p>'.$row['name'].'</p>');
    }
     ?>
   </div>
   <h3 style="color:#5499c7;">Female Names:</h3>
   <div class="sidebartext col-centered">
   <?php
   $worldtitle = "SELECT * FROM `npcs` WHERE `gender` LIKE 'female' ORDER BY rand() LIMIT 5";
   $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
   while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
     echo ('<p>'.$row['name'].'</p>');
   }
    ?>
  </div>

  </div>
</div>
</div>
</div> <!-- Mainbox -->

<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>