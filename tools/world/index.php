<div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">

  <!-- Page Header -->
  <div class="col-md-12">
  <div class="pagetitle" id="pgtitle"><?php
  $id = addslashes($id);
  $worldtitle = "SELECT * FROM `world` WHERE `title` LIKE '%{$id}%'";
  $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   echo $row['title'];
   $title = $row['title'];
   $deleteid = $row['id'];
   ?>
 </div>
 </div>
 <div class="nav sidebartext col-md-12">
 <a href="/index.php">Home</a>  &rarr; <a href="/tools/world/world.php">World Building</a> &rarr;  <a href="<?php echo ($row['type'].'.php">'.ucwords($row['type']).'</a>  &rarr; '.ucwords($row['title'])); ?>

 </div>
 <?php
 }
  ?>

  <div class="body bodytext col-xs-12" id="body">

    <!-- Body Text -->
      <?php
        $worldtitle = "SELECT * FROM `world` WHERE `title` LIKE '%{$id}%'";
        $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
          $sidebartype = $row['type'];
          if ($sidebartype == "npc") {
              echo('Establishment: '.$row['npc_est'].'<br />');
              echo('Location: '.$row['npc_location'].'<br />');
              echo('Faction: '.$row['npc_faction'].'<br />');
              echo('Deity: '.$row['npc_deity'].'<br />');
            }

          echo nl2br($row['body']);
        }
      ?>
      </div>
      <p>
      <button type="button" class="editbutton btn btn-danger" id="delete-entry" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span>Delete</button>
      <a href="edit.php?id=<?php echo $title; ?>"><button class="editbutton btn btn-info"><span class="glyphicon glyphicon-edit"></span>Edit</button></a></p>

    <div class="body bodytext col-xs-12" id="body2">

  <!--Settlement NPCs-->
  <?php
  if ($sidebartype == "settlement") {
    ?>
    <?php

    $temptitle = str_replace("'", "''", $title);
    $npcs = "SELECT * FROM world WHERE npc_location LIKE '%$temptitle%'";
    $npcdata = mysqli_query($dbcon, $npcs) or die('error getting data');
    $npcshow = 1;
    while($titlerow = mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
      if($npcshow == 1){
        echo "<h3>Key NPC's:</h3>";
        echo ('<div class="row col-md-12">');
        $npcshow++;
      }
      $selectednpc = $titlerow['title'];
      //echo "<a href=\"world.php?id=$selectednpc\">";
      echo ('<div class="col-md-4 col-sm-5">');
      echo $selectednpc;
      echo "</div>";
    }
    echo "</div>";
  }


  //Faction NPCs
  if ($sidebartype == "faction") {
    ?>
    <div class="row col-md-12 bodytext">
    <?php
    $temptitle = str_replace("'", "''", $title);
    $factionnpcs = "SELECT * FROM world WHERE npc_faction LIKE '%$temptitle%'";
    $factiondata = mysqli_query($dbcon, $factionnpcs) or die('error getting data');
    $membersshow = 1;
    while($factionrow = mysqli_fetch_array($factiondata, MYSQLI_ASSOC)) {
      if($membersshow == 1){
        echo "<h3>Known Members:</h3>";
        $membersshow++;
      }
      $selectednpc = $factionrow['title'];
      //echo "<a href=\"world.php?id=$selectednpc\">";
      echo $selectednpc;
      echo "</a><br />";
    }
    echo "</div>";
  }

  //Deity NPC's
  if ($sidebartype == "deity") {
    ?>
    <div class="row col-md-12 bodytext">
    <?php
    $temptitle = str_replace("'", "''", $title);
    $deitynpcs = "SELECT * FROM world WHERE npc_deity LIKE '%$temptitle%'";
    $deitydata = mysqli_query($dbcon, $deitynpcs) or die('error getting data');
    $followersshow = 1;
    while($deityrow = mysqli_fetch_array($deitydata, MYSQLI_ASSOC)) {
      if($followersshow == 1){
        echo "<h3>Known Followers:</h3>";
        $followersshow++;
      }
      $selectednpc = $deityrow['title'];
      //echo "<a href=\"world.php?id=$selectednpc\">";
      echo $selectednpc;
      echo "</a><br />";
    }
    echo "</div>";
  }
  ?>
  <div class="row col-md-12 bodytext">

<?php

  $temptitle = str_replace("'", "''", $title);
  $npcs = "SELECT * FROM world WHERE est_location LIKE '%$temptitle%'";
  $npcdata = mysqli_query($dbcon, $npcs) or die('error getting data');
  $npcshow = 1;
  while($titlerow = mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
    if($npcshow == 1){
      echo "<h3>Establishments:</h3>";
      echo ('<div class="row col-md-12">');
      $npcshow++;
    }
    $selectednpc = $titlerow['title'];
    //echo "<a href=\"world.php?id=$selectednpc\">";
    echo ('<div class="col-md-4 col-sm-5">');
    echo $selectednpc;
    echo "</div>";
  }
  echo ('</div>');
echo ('</div>');
?>


  <!-- campaignlog References -->
  <?php

    ?>
    <div class="row col-md-12 sidebartext">
    <?php
    $temptitle = str_replace("'", "''", $title);
    $logs = "SELECT * FROM campaignlog WHERE entry LIKE '%$temptitle%' ORDER BY date DESC";
    $logdata = mysqli_query($dbcon, $logs) or die('error getting data');
    $logshow = 1;
    while($logrow = mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
      if($logshow == 1){
        echo ('<h3>Log references:</h3>');
        echo ('<ul style="list-style-type: circle;">');
        $logshow++;

      }

      echo ('<li>');
      $selecteddate = $logrow['date'];
      $selectedlog = $logrow['entry'];
      echo ('<strong>Day ');
      echo $selecteddate;
      echo (':</strong> ');
      echo $selectedlog;
      echo "</li><p>";

    }

    echo "</ul></div>";

  ?>
<!-- Search and add hyperlinks -->
  <?php
    $sqlworld = "SELECT * FROM world WHERE title NOT LIKE '%{$id}%'";
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
    ?>
</div>

</div>




<!-- Delete Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modalstyle bodytext">

      <div class="modal-body">
        <p>Are you sure you want to delete <?php echo $title; ?>?</p>
      </div>
      <div class="modal-footer">
      <form class="delform" method="post" id="delform" action="delete.php">
        <select form="delform" name="delete" id="deleteid" style="display:none;" required="yes">
          <option value="<?php echo $deleteid; ?>" selected></option></select>
<button type="button" class="btn btn-info delform" data-dismiss="modal">Go Back</button>
          <input class="btn btn-danger" type="submit" value="Delete"></Input>

      </form>
      </div>
    </div>

  </div>
</div>
