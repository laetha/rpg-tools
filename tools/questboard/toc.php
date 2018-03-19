<div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">
  <h1 class="pagetitle">Quest Board</h1>
<div class ="body bodytext">
      <div class="toc bodytext">

      <!-- Settlements -->
      <div class="tocitem col-md-3">
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%pub_quest%' AND active LIKE '1'";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>



      </div>
  </div>
</div>
