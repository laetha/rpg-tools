<div class="mainbox col-md-9">

  <!-- Page Header -->
  <div class="col-md-12">
  <div class="pagetitle" id="pgtitle"><?php
  $id = addslashes($id);
  $worldtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '$id'";
  $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   echo htmlspecialchars($row['title']);
   $title = $row['title'];
 }
  ?>
</div>
</div>
  <div class="body sidebartext col-xs-12" id="body">

    <!-- Body Text -->
      <?php
        $worldtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '$id'";
        $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
          //echo ('<h2>'.ucwords($row['type']).'</h2>');
          $type = $row['type'];
          if($type == 'background'){
            echo nl2br('<div class="sidebartext">'.$row['backgroundTraits'].'</div>');
            $sidebartype = $row['type'];
          }
          elseif($type == 'feat'){
            if($row['featModifier'] != ''){
            echo ('<strong>Ability Score Increase: '.ucwords($row['featModifier']).'</strong><p></p>');
          }
            echo nl2br('<div class="sidebartext">'.$row['text'].'</div>');
            $sidebartype = $row['type'];
          }
          elseif($type == 'item'){
            echo ('<strong>Type: '.ucwords($row['itemType']).'</strong><br />');
            if($row['itemMagic'] == 1){
              echo ('Magic Item, '.$row['itemDetail'].'<br />');
            }
            if($row['itemWeight'] != ''){
              echo ('Weight: '.$row['itemWeight'].'lbs.<br />');
            }
            if($row['itemValue'] != ''){
              echo ('Cost: '.$row['itemValue'].'gp<br />');
            }
            if($row['itemRange'] != ''){
              echo ('Range: '.$row['itemRange'].'<br />');
            }
            if($row['itemStrength'] != ''){
              echo ('Strength Requirement: '.$row['itemStrength'].'<br />');
            }
            if($row['itemStealth'] != ''){
              echo ('Stealth: Disadvantage<br />');
            }
            echo nl2br('<p></p><div class="sidebartext">'.$row['text'].'</div>');
            $sidebartype = $row['type'];
          }
        }
      ?>
      </div>

<!-- Search and add hyperlinks -->
<?php
  /*  $sqlworld = "SELECT * FROM world WHERE title NOT LIKE '%{$id}%'";
    $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
    while($linkrow = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
    $temp = $linkrow['title'];
    ?>
    <script>
    var foundlink = "<?php echo $temp ?>";
    function replace (querytext){
      var bodytext = document.getElementById("body").innerHTML;
      //var pgtitle = document.getElementById("pgtitle").innerHTML;
      var url = "<a href=\"world.php?id=" + querytext + "\">" + querytext + "</a>";
      var regex = new RegExp(querytext, 'ig');
      var newtext = bodytext.replace(regex, url)
      document.getElementById("body").innerHTML = newtext;
    }
    replace(foundlink);

    </script>
    <?php
  }
  ?>
  <!-- Search and add hyperlinks -->
    <?php
      $sqlworld = "SELECT * FROM world";
      $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
      while($linkrow = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
      $temp = $linkrow['title'];
      ?>
      <script>
      var foundlink = "<?php echo $temp ?>";
      function replace (querytext){
        var bodytext = document.getElementById("body2").innerHTML;
        var url = "<a href=\"world.php?id=" + querytext + "\">" + querytext + "</a>";
        var regex = new RegExp(querytext, 'ig');
        var newtext = bodytext.replace(regex, url)
        document.getElementById("body2").innerHTML = newtext;
      }
      replace(foundlink);

      </script>
      <?php
    }
*/    ?>

</div>



<!-- Sidebar -->
    <div class="sidebar sidebartext col-xs-2">
    <p><a href="/tools/compendium/compendium.php">Back</a></p>

    <h2><?php
    if ($sidebartype == "npc" ) {
      echo "NPC";
    }
    else if ($sidebartype == "deity" ) {
      echo "Dietie";
    }
    else {
    echo ucwords($sidebartype);
  }
    echo "s"; ?></h2>
    <?php
      $sidebar = "SELECT title FROM compendium WHERE type LIKE '%{$sidebartype}%' LIMIT 0,12";
      $sidebardata = mysqli_query($dbcon, $sidebar) or die('error getting data');
      while($row =  mysqli_fetch_array($sidebardata, MYSQLI_ASSOC)) {
      $entry = $row['title'];
      echo "<a href=\"compendium.php?id=$entry\">";
      echo $entry;
      echo "</a>";
      echo "<br>";
    }
      ?>
  </div>
