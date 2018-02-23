<div class="tocbox col-md-12">
  <h1 class="pagetitle">Compendium</h1>
<div class ="body bodytext">
      <div class="toc bodytext">

      <!-- Settlements -->
      <div class="tocitem col-md-3">
        <h2>ALL</h2>
      <?php
        $sqlcompendium = "SELECT * FROM races, backgrounds";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"compendium.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>


      </div>
  </div>
</div>
