<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic" rel="stylesheet" type="text/css">
<link href="/tools/compendium/statblock.css" rel="stylesheet" type="text/css">
<?php
  //SQL Connect
   $pgtitle = 'Initiative - ';
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>


<div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">
  <h1 class="pagetitle">Initiative Tracker</h1>
<div class ="body bodytext">
<div class="col-md-4">
  <select form="import" name="add-monster" id="add-monster" onChange="addMonster(this)">
    <option value="" selected>Add Monster...</option>
    <?php
    $faithdrop = "SELECT title FROM compendium WHERE type LIKE 'monster'";
    $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
    while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
      $deity = $deityrow['title'];
      echo "<option value=\"$deity\">$deity</option>";
    }
    ?>
  </select>
  <script type="text/javascript">
  $('#add-monster').selectize({
create: false,
sortField: 'text'
});
  </script>

  <script type="text/javascript">
  var output = new Array();
   function addMonster(selectObj) {

     var selectIndex=selectObj.selectedIndex;
     var selectValue=selectObj.options[selectIndex].text;
     output.push(selectValue);
     var selectValueNs = selectValue.replace(/\s/g, '');
     var fullSelect = "show" + selectValueNs;
     document.getElementById(fullSelect).style.display = "block";

   }
  </script>

  <div id="test">
    TEST
  </div>

  <table>
    <?php
      $worldtitle1 = "SELECT * FROM compendium WHERE type LIKE 'monster'";
      $titledata1 = mysqli_query($dbcon, $worldtitle1) or die('error getting data');
      while($row1 =  mysqli_fetch_array($titledata1, MYSQLI_ASSOC)) {
        $rowns1 = preg_replace('/\s+/', '', $row1['title']);
        ?>

        <tr><td> <button class="btn btn-info" id="show<?php echo $rowns1; ?>" style="display:none;">Show <?php echo $row1['title']; ?></button></td></tr>
<?php } ?>
</table></div>

<?php
$worldtitle = "SELECT * FROM compendium WHERE type LIKE 'monster'";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
  $rowns = preg_replace('/\s+/', '', $row['title']);

  ?>
  <div class="stat-block col-md-6" id="<?php echo $rowns; ?>" style="display:none; float:right;">
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
<?php } ?><?php
$cr = $row['monsterCr'];
if($row['monsterCr'] != ''){ ?>
<div class="property-line">
<h4><strong>Challenge Rating:</strong></h4>
<p><?php

if($row['monsterCr'] ==0.125){
echo ('1/8');

}
elseif($row['monsterCr'] ==0.25){
echo ('1/4');

}
elseif($row['monsterCr'] ==0.5){
echo ('1/2');
}
else{
echo number_format((float)$cr, 0, '.', '');
}
if($cr == 0){
echo (' (10xp)');
}
if($cr == 0.125){
echo (' (25xp)');
}
if($cr == 0.25){
echo (' (50xp)');
}
if($cr == 0.5){
echo (' (100xp)');
}
if($cr == 1){
echo (' (200xp)');
}
if($cr == 2){
echo (' (450xp)');
}
if($cr == 3){
echo (' (700xp)');
}
if($cr == 4){
echo (' (1,100xp)');
}
if($cr == 5){
echo (' (1,800xp)');
}
if($cr == 6){
echo (' (4,100xp)');
}
if($cr == 7){
echo (' (2,900xp)');
}
if($cr == 8){
echo (' (3,900xp)');
}
if($cr == 9){
echo (' (5,000xp)');
}
if($cr == 10){
echo (' (5,900xp)');
}
if($cr == 11){
echo (' (7,200xp)');
}
if($cr == 12){
echo (' (8,400xp)');
}
if($cr == 13){
echo (' (10,000xp)');
}
if($cr == 14){
echo (' (11,500xp)');
}
if($cr == 15){
echo (' (13,000xp)');
}
if($cr == 16){
echo (' (15,000xp)');
}
if($cr == 17){
echo (' (18,000xp)');
}
if($cr == 18){
echo (' (20,000xp)');
}
if($cr == 19){
echo (' (22,000xp)');
}
if($cr == 20){
echo (' (25,000xp)');
}
if($cr == 21){
echo (' (33,000xp)');
}
if($cr == 22){
echo (' (41,000xp)');
}
if($cr == 23){
echo (' (50,000xp)');
}
if($cr == 24){
echo (' (62,000xp)');
}
if($cr == 25){
echo (' (75,000xp)');
}
if($cr == 26){
echo (' (90,000xp)');
}
if($cr == 27){
echo (' (105,000xp)');
}
if($cr == 28){
echo (' (120,000xp)');
}
if($cr == 29){
echo (' (135,000xp)');
}
if($cr == 30){
echo (' (155,000xp)');
}
?>
</p>
</div> <!-- property line -->
<?php } ?>
</div> <!-- top stats -->
<svg height="5" width="100%" class="tapered-rule">
<polyline points="0,0 400,2.5 0,5"></polyline>
</svg>
<?php if($row['monsterTrait1'] != ''){ ?>
<div class="property-block">
<p><?php echo nl2br($row['monsterTrait1']); ?></p>
</div> <!-- property Block -->
<?php } ?>
<?php if($row['monsterTrait2'] != ''){ ?>
<div class="property-block">
<p><?php echo nl2br($row['monsterTrait2']); ?></p>
</div> <!-- property Block -->
<?php } ?>
<?php if($row['monsterTrait3'] != ''){ ?>
<div class="property-block">
<p><?php echo nl2br($row['monsterTrait3']); ?></p>
</div> <!-- property Block -->
<?php } ?>
<?php if($row['monsterTrait4'] != ''){ ?>
<div class="property-block">
<p><?php echo nl2br($row['monsterTrait4']); ?></p>
</div> <!-- property Block -->
<?php } ?>
<?php if($row['monsterTrait5'] != ''){ ?>
<div class="property-block">
<p><?php echo nl2br($row['monsterTrait5']); ?></p>
</div> <!-- property Block -->
<?php } ?>
<?php if($row['monsterTrait6'] != ''){ ?>
<div class="property-block">
<p><?php echo nl2br($row['monsterTrait6']); ?></p>
</div> <!-- property Block -->
<?php } ?>
<?php if($row['monsterTrait7'] != ''){ ?>
<div class="property-block">
<p><?php echo nl2br($row['monsterTrait7']); ?></p>
</div> <!-- property Block -->
<?php } ?>
<?php if($row['monsterTrait8'] != ''){ ?>
<div class="property-block">
<p><?php echo nl2br($row['monsterTrait8']); ?></p>
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
<div class="actions">
<?php if($row['monsterReaction'] != ''){ ?>
 <h3>Reactions</h3>
<div class="property-block">
<p><?php echo $row['monsterReaction']; ?></p>
</div> <!-- property Block -->
<?php } ?>

</div>

</div> <!-- section right -->
<hr class="orange-border bottom" />
</div> <!-- stat block -->
<script>
$(document).ready(function addLog(){
    $("#show<?php echo $rowns; ?>").click(function addLog(){
        $("#<?php echo $rowns; ?>").slideToggle("slow");
    });
});
</script>
<?php } ?>


</div> <!--Body -->
</div> <!-- Mainbox -->





<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
