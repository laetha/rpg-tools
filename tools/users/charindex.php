<?php
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/plugins/Parsedown.php";
include_once($sqlpath);
 ?>

 <?php  $Parsedown = new Parsedown();
 ?>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

  <!-- Page Header -->
  <div class="col-md-12">
  <div class="pagetitle" id="pgtitle" style="visibility: visible;">
    <?php
  $stripid = str_replace("'", "", $id);
  $stripid = stripslashes($stripid);
  $id = addslashes($id);
  $worldtitle = "SELECT * FROM `characters` WHERE `title` LIKE '$id'";
  $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   echo $row['title'];
   $title = $row['title'];
   $deleteid = $row['id'];
   ?>
 </div>
 </div>

 <?php
 }
  ?>

  <div class="body sidebartext col-xs-12" id="body">

    <!-- Body Text -->
      <?php
        $worldtitle = "SELECT * FROM `characters` WHERE `title` LIKE '$id'";
        $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {

          $strmod = floor((($row['str']-10)/2));
          $dexmod = floor((($row['dex']-10)/2));
          $conmod = floor((($row['con']-10)/2));
          $intelmod = floor((($row['intel']-10)/2));
          $wismod = floor((($row['wis']-10)/2));
          $chamod = floor((($row['cha']-10)/2));

          if ($row['level'] >= 1 && $row['level'] <= 4) {
            $profbonus = 2;
          }
          if ($row['level'] >= 5 && $row['level'] <= 8) {
            $profbonus = 3;
          }
          if ($row['level'] >= 9 && $row['level'] <= 12) {
            $profbonus = 4;
          }
          if ($row['level'] >= 13 && $row['level'] <= 16) {
            $profbonus = 5;
          }
          if ($row['level'] >= 17 && $row['level'] <= 20) {
            $profbonus = 6;
          }

          ?>
          <div class="char-left-col col-sm-6 col-xs-12">

            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="strBox">
              <div class="statScore" id="strScore"><?php echo $row['str']; ?></div>
              <div class="statMod" id="strMod"><?php echo $strmod; ?></div>
              <div class="statName" id="strName">Strength</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf"><input class="profRadio" id="strSaveProf" type="checkbox" onclick="addStrProf('strSave')"></input><input type="checkbox" class="expertRadio" id="strSaveExpert"></input><input class="prof" id="strSaveVal" value="<?php echo $strmod; ?>" disabled></input><b>Saving Throw</b></div>
            <div class="statProf"><input class="profRadio" id="athleticsProf" type="checkbox" onclick="addStrProf('athletics')"></input><input type="checkbox" class="expertRadio" id="athleticsExpert"></input><input class="prof" id="athleticsVal" value="<?php echo $strmod; ?>" disabled></input>Athletics</div>
          </div>
        </div>
            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="dexBox">
              <div class="statScore" id="dexScore"><?php echo $row['dex']; ?></div>
              <div class="statMod" id="dexMod"><?php echo $dexmod; ?></div>
              <div class="statName" id="dexName">Dexterity</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf"><input class="profRadio" id="dexSaveProf" type="checkbox" onclick="addDexProf('dexSave')"></input><input type="checkbox" class="expertRadio" id="dexSaveExpert"></input><input class="prof" id="dexSaveVal" value="<?php echo $dexmod; ?>" disabled></input><b>Saving Throw</b></div>
            <div class="statProf"><input class="profRadio" id="acrobaticsProf" type="checkbox" onclick="addDexProf('acrobatics')"></input><input type="checkbox" class="expertRadio" id="acrobaticsExpert"></input><input class="prof" id="acrobaticsVal" value="<?php echo $dexmod; ?>" disabled></input>Acrobatics</div>
            <div class="statProf"><input class="profRadio" id="sleightProf" type="checkbox" onclick="addDexProf('sleight')"></input><input type="checkbox" class="expertRadio" id="sleightExpert"></input><input class="prof" id="sleightVal" value="<?php echo $dexmod; ?>" disabled></input>Sleight of Hand</div>
            <div class="statProf"><input class="profRadio" id="stealthProf" type="checkbox" onclick="addDexProf('stealth')"></input><input type="checkbox" class="expertRadio" id="stealthExpert"></input><input class="prof" id="stealthVal" value="<?php echo $dexmod; ?>" disabled></input>Stealth</div>

          </div>
          </div>
            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="conBox">
              <div class="statScore" id="conScore"><?php echo $row['con']; ?></div>
              <div class="statMod" id="conMod"><?php echo $conmod; ?></div>
              <div class="statName" id="conName">Constitution</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf"><input class="profRadio" id="conSaveProf" type="checkbox" onclick="addConProf('conSave')"></input><input type="checkbox" class="expertRadio" id="conSaveExpert"></input><input class="prof" id="conSaveVal" value="<?php echo $conmod; ?>" disabled></input><b>Saving Throw</b></div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="intBox">
              <div class="statScore" id="intScore"><?php echo $row['intel']; ?></div>
              <div class="statMod" id="intMod"><?php echo $intelmod; ?></div>
              <div class="statName" id="intName">Intelligence</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf"><input class="profRadio" id="intelSaveProf" type="checkbox" onclick="addIntelProf('intelSave')"></input><input type="checkbox" class="expertRadio" id="intelSaveExpert"></input><input class="prof" id="intelSaveVal" value="<?php echo $intelmod; ?>" disabled></input><b>Saving Throw</b></div>
            <div class="statProf"><input class="profRadio" id="arcanaProf" type="checkbox" onclick="addIntelProf('arcana')"></input><input type="checkbox" class="expertRadio" id="arcanaExpert"></input><input class="prof" id="arcanaVal" value="<?php echo $intelmod; ?>" disabled></input>Arcana</div>
            <div class="statProf"><input class="profRadio" id="historyProf" type="checkbox" onclick="addIntelProf('history')"></input><input type="checkbox" class="expertRadio" id="historyExpert"></input><input class="prof" id="historyVal" value="<?php echo $intelmod; ?>" disabled></input>History</div>
            <div class="statProf"><input class="profRadio" id="investigationProf" type="checkbox" onclick="addIntelProf('investigation')"></input><input type="checkbox" class="expertRadio" id="investigationExpert"></input><input class="prof" id="investigationVal" value="<?php echo $intelmod; ?>" disabled></input>Investigation</div>
            <div class="statProf"><input class="profRadio" id="natureProf" type="checkbox" onclick="addIntelProf('nature')"></input><input type="checkbox" class="expertRadio" id="natureExpert"></input><input class="prof" id="natureVal" value="<?php echo $intelmod; ?>" disabled></input>Nature</div>
            <div class="statProf"><input class="profRadio" id="religionProf" type="checkbox" onclick="addIntelProf('religion')"></input><input type="checkbox" class="expertRadio" id="religionExpert"></input><input class="prof" id="religionVal" value="<?php echo $intelmod; ?>" disabled></input>Religion</div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="wisBox">
              <div class="statScore" id="wisScore"><?php echo $row['wis']; ?></div>
              <div class="statMod" id="wisMod"><?php echo $wismod; ?></div>
              <div class="statName" id="wisName">Wisdom</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf"><input class="profRadio" id="wisSaveProf" type="checkbox" onclick="addWisProf('wisSave')"></input><input type="checkbox" class="expertRadio" id="wisSaveExpert"></input><input class="prof" id="wisSaveVal" value="<?php echo $wismod; ?>" disabled></input><b>Saving Throw</b></div>
            <div class="statProf"><input class="profRadio" id="animalProf" type="checkbox" onclick="addWisProf('animal')"></input><input type="checkbox" class="expertRadio" id="animalExpert"></input><input class="prof" id="animalVal" value="<?php echo $wismod; ?>" disabled></input>Animal Handling</div>
            <div class="statProf"><input class="profRadio" id="insightProf" type="checkbox" onclick="addWisProf('insight')"></input><input type="checkbox" class="expertRadio" id="insightExpert"></input><input class="prof" id="insightVal" value="<?php echo $wismod; ?>" disabled></input>Insight</div>
            <div class="statProf"><input class="profRadio" id="medicineProf" type="checkbox" onclick="addWisProf('medicine')"></input><input type="checkbox" class="expertRadio" id="medicineExpert"></input><input class="prof" id="medicineVal" value="<?php echo $wismod; ?>" disabled></input>Medicine</div>
            <div class="statProf"><input class="profRadio" id="perceptionProf" type="checkbox" onclick="addWisProf('perception')"></input><input type="checkbox" class="expertRadio" id="perceptionExpert"></input><input class="prof" id="perceptionVal" value="<?php echo $wismod; ?>" disabled></input>Perception</div>
            <div class="statProf"><input class="profRadio" id="survivalProf" type="checkbox" onclick="addWisProf('survival')"></input><input type="checkbox" class="expertRadio" id="survivalExpert"></input><input class="prof" id="survivalVal" value="<?php echo $wismod; ?>" disabled></input>Survival</div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="chaBox">
              <div class="statScore" id="chaScore"><?php echo $row['cha']; ?></div>
              <div class="statMod" id="chaMod"><?php echo $chamod; ?></div>
              <div class="statName" id="chaName">Charisma</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf"><input class="profRadio" id="chaSaveProf" type="checkbox" onclick="addChaProf('chaSave');"></input><input type="checkbox" class="expertRadio" id="chaSaveExpert"></input><input class="prof" id="chaSaveVal" value="<?php echo $chamod; ?>" disabled></input><b>Saving Throw</b></div>
            <div class="statProf"><input class="profRadio" id="deceptionProf" type="checkbox" onclick="addChaProf('deception');"></input><input type="checkbox" class="expertRadio" id="deceptionExpert"></input><input class="prof" id="deceptionVal" value="<?php echo $chamod; ?>" disabled></input>deception</div>
            <div class="statProf"><input class="profRadio" id="intimidationProf" type="checkbox" onclick="addChaProf('intimidation');"></input><input type="checkbox" class="expertRadio" id="intimidationExpert"></input><input class="prof" id="intimidationVal" value="<?php echo $chamod; ?>" disabled></input>intimidation</div>
            <div class="statProf"><input class="profRadio" id="performanceProf" type="checkbox" onclick="addChaProf('performance');"></input><input type="checkbox" class="expertRadio" id="performanceExpert"></input><input class="prof" id="performanceVal" value="<?php echo $chamod; ?>" disabled></input>performance</div>
            <div class="statProf"><input class="profRadio" id="persuasionProf" type="checkbox" onclick="addChaProf('persuasion');"></input><input type="checkbox" class="expertRadio" id="persuasionExpert"></input><input class="prof" id="persuasionVal" value="<?php echo $chamod; ?>" disabled></input>persuasion</div>
          </div>
        </div>
        </div>
          <?php

// PROFICIENCIES
    ?>
    <script>
    function addStrProf(value) {
      var currentVal = <?php echo $strmod; ?>;
      var newVal = 0;
      if (document.getElementById(value + 'Prof').checked)
 {
    newVal = currentVal + <?php echo $profbonus; ?>;
     document.getElementById(value + 'Val').value = newVal;
 } else {
   document.getElementById(value + 'Val').value = currentVal;
 }
    }

    function addDexProf(value) {
      var currentVal = <?php echo $dexmod; ?>;
      var newVal = 0;
      if (document.getElementById(value + 'Prof').checked)
    {
    newVal = currentVal + <?php echo $profbonus; ?>;
     document.getElementById(value + 'Val').value = newVal;
    } else {
    document.getElementById(value + 'Val').value = currentVal;
    }
    }

    function addConProf(value) {
      var currentVal = <?php echo $conmod; ?>;
      var newVal = 0;
      if (document.getElementById(value + 'Prof').checked)
 {
    newVal = currentVal + <?php echo $profbonus; ?>;
     document.getElementById(value + 'Val').value = newVal;
 } else {
   document.getElementById(value + 'Val').value = currentVal;
 }
    }

    function addIntelProf(value) {
      var currentVal = <?php echo $intelmod; ?>;
      var newVal = 0;
      if (document.getElementById(value + 'Prof').checked)
 {
    newVal = currentVal + <?php echo $profbonus; ?>;
     document.getElementById(value + 'Val').value = newVal;
 } else {
   document.getElementById(value + 'Val').value = currentVal;
 }
    }

    function addWisProf(value) {
      var currentVal = <?php echo $wismod; ?>;
      var newVal = 0;
      if (document.getElementById(value + 'Prof').checked)
 {
    newVal = currentVal + <?php echo $profbonus; ?>;
     document.getElementById(value + 'Val').value = newVal;
 } else {
   document.getElementById(value + 'Val').value = currentVal;
 }
    }

    function addChaProf(value) {
      var currentVal = <?php echo $chamod; ?>;
      var newVal = 0;
      if (document.getElementById(value + 'Prof').checked)
 {
    newVal = currentVal + <?php echo $profbonus; ?>;
     document.getElementById(value + 'Val').value = newVal;
 } else {
   document.getElementById(value + 'Val').value = currentVal;
 }
    }

    </script>
<?php
  }
  ?>
</div>
</div>



  <?php
  //Footer
  $footpath = $_SERVER['DOCUMENT_ROOT'];
  $footpath .= "/footer.php";
  include_once($footpath);
   ?>
