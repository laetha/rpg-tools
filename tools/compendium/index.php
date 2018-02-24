<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic" rel="stylesheet" type="text/css">
<link href="statblock.css" rel="stylesheet" type="text/css">
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
          elseif($type == 'race'){
            echo ('<strong>Size: </strong>'.ucwords($row['raceSize']).'<br />');
            echo ('<strong>Speed: </strong>'.ucwords($row['raceSpeed']).'<br />');
            echo ('<strong>Bonus Abilities: </strong>'.ucwords($row['raceAbility']).'<p></p>');
            echo nl2br('<div class="sidebartext">'.$row['raceTraits'].'</div>');
            $sidebartype = $row['type'];
          }
          elseif($type == 'spell'){
              echo ('<div class="spellDetail">');
              echo ('<strong>Level:</strong> '.$row['spellLevel'].'<br />');
              echo ('<strong>School:</strong> '.$row['spellSchool'].'<br />');
              echo ('<strong>Casting Time:</strong> '.$row['spellTime'].'<br />');
              echo ('<strong>Range:</strong> '.$row['spellRange'].'<br />');
              echo ('<strong>Components:</strong> '.$row['spellComponents'].'<br />');
              echo ('<strong>Duration:</strong> '.$row['spellDuration'].'<br />');
              echo ('<strong>Class:</strong> '.$row['spellClasses'].'<br />');
              if($row['spellRitual'] == 1){
                echo ('<strong>This spell can be cast as a Ritual.</strong><p></p>');
              }
              echo ('</div>');
            echo nl2br('<p></p><div class="sidebartext">'.$row['text'].'</div>');
            $sidebartype = $row['type'];
          }
          elseif($type == 'monster'){
            ?>
            <div class="stat-block wide">
	<hr class="orange-border" />
	<div class="section-left">
		<div class="creature-heading">
			<h1><?php echo $row['title']; ?></h1>
			<h2><?php echo $row['monsterSize'].' '.$row['monsterType'].', '.$row['monsterAlignment']; ?></h2>
		</div> <!-- creature heading -->
		<svg height="5" width="100%" class="tapered-rule">
	    <polyline points="0,0 400,2.5 0,5"></polyline>
	  </svg>
		<div class="top-stats">
			<div class="property-line first">
				<h4>Armor Class</h4>
				<p><?php echo $row['monsterAc']; ?></p>
			</div> <!-- property line -->
			<div class="property-line">
				<h4>Hit Points</h4>
				<p><?php echo $row['monsterHp']; ?></p>
			</div> <!-- property line -->
			<div class="property-line last">
				<h4>Speed</h4>
				<p><?php echo $row['monsterSpeed']; ?></p>
			</div> <!-- property line -->
			<svg height="5" width="100%" class="tapered-rule">
	    <polyline points="0,0 400,2.5 0,5"></polyline>
	  </svg>
			<div class="abilities">
				<div class="ability-strength">
					<h4>STR</h4>
					<p><?php echo $row['monsterStr']; ?></p>
				</div> <!-- ability strength -->
				<div class="ability-dexterity">
					<h4>DEX</h4>
					<p><?php echo $row['monsterDex']; ?></p>
				</div> <!-- ability dexterity -->
				<div class="ability-constitution">
					<h4>CON</h4>
					<p><?php echo $row['monsterCon']; ?></p>
				</div> <!-- ability constitution -->
				<div class="ability-intelligence">
					<h4>INT</h4>
					<p><?php echo $row['monsterInt']; ?></p>
				</div> <!-- ability intelligence -->
				<div class="ability-wisdom">
					<h4>WIS</h4>
					<p><?php echo $row['monsterWis']; ?></p>
				</div> <!-- ability wisdom -->
				<div class="ability-charisma">
					<h4>CHA</h4>
					<p><?php echo $row['monsterCha']; ?></p>
				</div> <!-- ability charisma -->
			</div> <!-- abilities -->
			<svg height="5" width="100%" class="tapered-rule">
	    <polyline points="0,0 400,2.5 0,5"></polyline>
	  </svg>
    <?php if($row['monsterSave'] != ''){ ?>
      <div class="property-line">
				<h4><strong>Saving Throws:</strong></h4>
				<p><?php echo $row['monsterSave']; ?></p>
			</div> <!-- property line -->
    <?php } ?>
  <?php if($row['monsterSkill'] != ''){ ?>
      <div class="property-line">
				<h4><strong>Skills:</strong></h4>
				<p><?php echo $row['monsterSkill']; ?></p>
			</div> <!-- property line -->
    <?php } ?>
    <?php if($row['monsterResist'] != ''){ ?>
      <div class="property-line">
				<h4><strong>Damage Resistences:</strong></h4>
				<p><?php echo $row['monsterResist']; ?></p>
			</div> <!-- property line -->
    <?php } ?><?php if($row['monsterVulnerable'] != ''){ ?>
      <div class="property-line">
				<h4><strong>Damage Vulnerabilities:</strong></h4>
				<p><?php echo $row['monsterVulnerable']; ?></p>
			</div> <!-- property line -->
  <?php } ?><?php if($row['monsterImmune'] != ''){ ?>
    <div class="property-line">
      <h4><strong>Damage Immunities:</strong></h4>
      <p><?php echo $row['monsterImmune']; ?></p>
    </div> <!-- property line -->
<?php } ?><?php if($row['monsterConditionImmune'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Condition Immunities:</strong></h4>
    <p><?php echo $row['monsterConditionImmune']; ?></p>
  </div> <!-- property line -->
<?php } ?><?php if($row['monsterSenses'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Senses:</strong></h4>
    <p><?php echo $row['monsterSenses']; ?></p>
  </div> <!-- property line -->
<?php } ?><?php if($row['monsterPassive'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Passive Perception:</strong></h4>
    <p><?php echo $row['monsterPassive']; ?></p>
  </div> <!-- property line -->
<?php } ?><?php if($row['monsterLanguages'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Languages:</strong></h4>
    <p><?php echo $row['monsterLanguages']; ?></p>
  </div> <!-- property line -->
<?php } ?><?php if($row['monsterCr'] != ''){ ?>
  <div class="property-line">
    <h4><strong>Challenge Rating:</strong></h4>
    <p><?php echo $row['monsterCr']; ?></p>
  </div> <!-- property line -->
<?php } ?>
		</div> <!-- top stats -->
		<svg height="5" width="100%" class="tapered-rule">
	    <polyline points="0,0 400,2.5 0,5"></polyline>
	  </svg>
  <?php if($row['monsterTrait2'] != ''){ ?>
    <div class="property-block">
      <p><?php echo $row['monsterTrait2']; ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait3'] != ''){ ?>
    <div class="property-block">
      <p><?php echo $row['monsterTrait3']; ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait4'] != ''){ ?>
    <div class="property-block">
      <p><?php echo $row['monsterTrait4']; ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait5'] != ''){ ?>
    <div class="property-block">
      <p><?php echo $row['monsterTrait5']; ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait6'] != ''){ ?>
    <div class="property-block">
      <p><?php echo $row['monsterTrait6']; ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait7'] != ''){ ?>
    <div class="property-block">
      <p><?php echo $row['monsterTrait7']; ?></p>
    </div> <!-- property Block -->
  <?php } ?>
  <?php if($row['monsterTrait8'] != ''){ ?>
    <div class="property-block">
      <p><?php echo $row['monsterTrait8']; ?></p>
    </div> <!-- property Block -->
  <?php } ?>
	</div> <!-- section left -->
	<div class="section-right">
		<div class="actions">
			<h3>Actions</h3>
      <?php if($row['monsterAction1'] != ''){ ?>
        <div class="property-block">
          <p><?php echo $row['monsterAction1']; ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction2'] != ''){ ?>
        <div class="property-block">
          <p><?php echo $row['monsterAction2']; ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction3'] != ''){ ?>
        <div class="property-block">
          <p><?php echo $row['monsterAction3']; ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction4'] != ''){ ?>
        <div class="property-block">
          <p><?php echo $row['monsterAction4']; ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction5'] != ''){ ?>
        <div class="property-block">
          <p><?php echo $row['monsterAction5']; ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction6'] != ''){ ?>
        <div class="property-block">
          <p><?php echo $row['monsterAction6']; ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction7'] != ''){ ?>
        <div class="property-block">
          <p><?php echo $row['monsterAction7']; ?></p>
        </div> <!-- property Block -->
      <?php } ?>
      <?php if($row['monsterAction8'] != ''){ ?>
        <div class="property-block">
          <p><?php echo $row['monsterAction8']; ?></p>
        </div> <!-- property Block -->
      <?php } ?>
		</div> <!-- actions -->
		<div class="actions">
        <?php if($row['monsterLegendary1'] != ''){ ?>
          <h3>Legendary Actions</h3>
          <div class="property-block">
            <p><?php echo $row['monsterLegendary1']; ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary2'] != ''){ ?>
          <div class="property-block">
            <p><?php echo $row['monsterLegendary2']; ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary3'] != ''){ ?>
          <div class="property-block">
            <p><?php echo $row['monsterLegendary3']; ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary4'] != ''){ ?>
          <div class="property-block">
            <p><?php echo $row['monsterLegendary4']; ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary5'] != ''){ ?>
          <div class="property-block">
            <p><?php echo $row['monsterLegendary5']; ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary6'] != ''){ ?>
          <div class="property-block">
            <p><?php echo $row['monsterLegendary6']; ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary7'] != ''){ ?>
          <div class="property-block">
            <p><?php echo $row['monsterLegendary7']; ?></p>
          </div> <!-- property Block -->
        <?php } ?>
        <?php if($row['monsterLegendary8'] != ''){ ?>
          <div class="property-block">
            <p><?php echo $row['monsterLegendary8']; ?></p>
          </div> <!-- property Block -->
        <?php } ?>
		</div> <!-- actions -->
	</div> <!-- section right -->
	<hr class="orange-border bottom" />
</div> <!-- stat block -->
          <?php
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
