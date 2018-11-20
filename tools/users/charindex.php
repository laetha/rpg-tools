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

<script>
//DISABLE ALL INPUTS
$(document).ready(function lockSheet() {
var inputs = document.getElementsByTagName("input");
for (var i = 0; i < inputs.length; i++) {
    inputs[i].disabled = true;
  }
});

//EDIT SHEET, ENABLE ALL INPUTS
function editSheet() {
  var inputs = document.getElementsByTagName("input");
  for (var i = 0; i < inputs.length; i++) {
      inputs[i].disabled = false;
      inputs[i].style = "background-color: #717782;";

    }
    document.getElementById("editSheet").style = "display:none";
    document.getElementById("saveSheet").style = "display:inline-block";
    document.getElementById("cancelSheet").style = "display:inline-block";
};

</script>


  <!-- Page Header -->
  <div class="col-md-12">
  <!-- <div class="pagetitle" id="pgtitle" style="visibility: visible;"> -->
    <?php
  $stripid = str_replace("'", "", $id);
  $stripid = stripslashes($stripid);
  $id = addslashes($id);
  $worldtitle = "SELECT * FROM `characters` WHERE `title` LIKE '$id'";
  $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   //echo $row['title'];
   $title = $row['title'];
   $charID = $row['id'];
   $fullclass = $row['class1'];
   $dexmod = floor((($row['dex']-10)/2));
   ?>
   <button class="btn btn-info" onclick="editSheet()" id="editSheet">Edit</button>
   <button class="btn btn-success" id="saveSheet" onclick="saveSheet()" style="display:none;">Save</button>
   <button class="btn btn-danger" onclick="window.location.reload()" id="cancelSheet" style="display:none;">Cancel</button>
 </div>

<div class=" col-md-4 col-sm-6 col-xs-12">
  <input class="charName" id="charName" value="<?php echo $title; ?>">
 </div>

<div class="col-md-8 col-sm-6 col-xs-12 sidebartext">
  <table style="width: 100%;">
    <tr>
      <td><input class="charDetails" id="charClass" value="<?php echo $row['class1']; ?>"></td>
      <td><input class="charDetails" id="charLevel" value="<?php echo $row['level']; ?>"></td>
      <td><input class="charDetails" id="charAlignment" value="<?php echo $row['alignment']; ?>"></td>
    <tr>

    <tr style="border-top: 1px solid white;">
      <td><div class="charDeet">Class</div></td>
      <td><div class="charDeet">Level</div></td>
      <td><div class="charDeet">Alignment</div></td>
    </tr>
    <tr>
      <td><input class="charDetails" id="charRace" value="<?php echo $row['race']; ?>"></td>
      <td><input class="charDetails" id="charBackground" value="<?php echo $row['background']; ?>"></td>
    </tr>
    <tr  style="border-top: 1px solid white;">
      <td><div class="charDeet">Race</div></td>
      <td><div class="charDeet">Background</div></td>
    </tr>
  </table>

</div>

 <?php
 }
  ?>

  <div class="body sidebartext col-xs-12" id="body" style="margin-top: 10px;">

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
          <div class="char-left-col col-md-4 col-sm-6 col-xs-12">

            <div class="row fullStatBox">
            <div class="statBox col-xs-5" id="strBox">
              <input class="statScore" id="strScore" value="<?php echo $row['str']; ?>"></input>
              <div class="statMod" id="strMod"><?php echo $strmod; ?></div>
              <div class="statName" id="strName" onclick="abilityCheck('str<?php echo $strmod; ?>')">Strength</div>
            </div>

          <div class="statProfs col-xs-7">
            <div class="statProf"><input class="profRadio" id="strSaveProf" type="checkbox" onclick="addStrProf('strSave')"></input>
              <input type="checkbox" class="expertRadio" id="strSaveExpert" onclick="addStrProf('strSave')"></input><input class="prof" id="strSaveVal" value="<?php echo $strmod; ?>" disabled></input><span class="profName" id="strSaveName" onclick="profRoll('strSaveVal')"><b>Saving Throw</b></div>

            <div class="statProf"><input class="profRadio" id="athleticsProf" type="checkbox" onclick="addStrProf('athletics')"></input>
              <input type="checkbox" class="expertRadio" id="athleticsExpert" onclick="addStrProf('athletics')"></input><input class="prof" id="athleticsVal" value="<?php echo $strmod; ?>" disabled></input><span class="profName" id="athleticsName" onclick="profRoll('athleticsVal')">Athletics</div>
          </div>
        </div>
            <div class="row fullStatBox">
            <div class="statBox col-xs-5" id="dexBox">
              <input class="statScore" id="dexScore" value="<?php echo $row['dex']; ?>"></input>
              <div class="statMod" id="dexMod"><?php echo $dexmod; ?></div>
              <div class="statName" id="dexName" onclick="abilityCheck('dex<?php echo $dexmod; ?>')">Dexterity</div>
            </div>

          <div class="statProfs col-xs-7">
            <div class="statProf"><input class="profRadio" id="dexSaveProf" type="checkbox" onclick="addDexProf('dexSave')"></input>
              <input type="checkbox" class="expertRadio" id="dexSaveExpert" onclick="addDexProf('dexSave')"></input><input class="prof" id="dexSaveVal" value="<?php echo $dexmod; ?>" disabled></input><span class="profName" id="dexSaveName" onclick="profRoll('dexSaveVal')"><b>Saving Throw</b></div>

            <div class="statProf"><input class="profRadio" id="acrobaticsProf" type="checkbox" onclick="addDexProf('acrobatics')"></input>
              <input type="checkbox" class="expertRadio" id="acrobaticsExpert" onclick="addDexProf('acrobatics')"></input><input class="prof" id="acrobaticsVal" value="<?php echo $dexmod; ?>" disabled></input><span class="profName" id="acrobaticsName" onclick="profRoll('acrobaticsVal')">Acrobatics</div>

            <div class="statProf"><input class="profRadio" id="sleightProf" type="checkbox" onclick="addDexProf('sleight')"></input>
              <input type="checkbox" class="expertRadio" id="sleightExpert" onclick="addDexProf('sleight')"></input><input class="prof" id="sleightVal" value="<?php echo $dexmod; ?>" disabled></input><span class="profName" id="sleightName" onclick="profRoll('sleightVal')">Sleight of Hand</div>

            <div class="statProf"><input class="profRadio" id="stealthProf" type="checkbox" onclick="addDexProf('stealth')"></input>
              <input type="checkbox" class="expertRadio" id="stealthExpert" onclick="addDexProf('stealth')"></input><input class="prof" id="stealthVal" value="<?php echo $dexmod; ?>" disabled></input><span class="profName" id="stealthName" onclick="profRoll('stealthVal')">Stealth</div>

          </div>
          </div>
            <div class="row fullStatBox">
            <div class="statBox col-xs-5" id="conBox">
              <input class="statScore" id="conScore" value="<?php echo $row['con']; ?>"></input>
              <div class="statMod" id="conMod"><?php echo $conmod; ?></div>
              <div class="statName" id="conName" onclick="abilityCheck('con<?php echo $conmod; ?>')">Constitution</div>
            </div>

          <div class="statProfs col-xs-7">
            <div class="statProf"><input class="profRadio" id="conSaveProf" type="checkbox" onclick="addConProf('conSave')"></input>
              <input type="checkbox" class="expertRadio" id="conSaveExpert" onclick="addConProf('conSave')"></input><input class="prof" id="conSaveVal" value="<?php echo $conmod; ?>" disabled></input><span class="profName" id="conSaveName" onclick="profRoll('conSaveVal')"><b>Saving Throw</b></div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-5" id="intBox">
              <input class="statScore" id="intScore" value="<?php echo $row['intel']; ?>"></input>
              <div class="statMod" id="intMod"><?php echo $intelmod; ?></div>
              <div class="statName" id="intName" onclick="abilityCheck('int<?php echo $intelmod; ?>')">Intelligence</div>
            </div>

          <div class="statProfs col-xs-7">
            <div class="statProf"><input class="profRadio" id="intelSaveProf" type="checkbox" onclick="addIntelProf('intelSave')"></input>
              <input type="checkbox" class="expertRadio" id="intelSaveExpert" onclick="addIntelProf('intelSave')"></input><input class="prof" id="intelSaveVal" value="<?php echo $intelmod; ?>" disabled></input><span class="profName" id="intelSaveName" onclick="profRoll('intelSaveVal')"><b>Saving Throw</b></div>

            <div class="statProf"><input class="profRadio" id="arcanaProf" type="checkbox" onclick="addIntelProf('arcana')"></input>
              <input type="checkbox" class="expertRadio" id="arcanaExpert" onclick="addIntelProf('arcana')"></input><input class="prof" id="arcanaVal" value="<?php echo $intelmod; ?>" disabled></input><span class="profName" id="arcanaName" onclick="profRoll('arcanaVal')">Arcana</div>

            <div class="statProf"><input class="profRadio" id="historyProf" type="checkbox" onclick="addIntelProf('history')"></input>
              <input type="checkbox" class="expertRadio" id="historyExpert" onclick="addIntelProf('history')"></input><input class="prof" id="historyVal" value="<?php echo $intelmod; ?>" disabled></input><span class="profName" id="historyName" onclick="profRoll('historyVal')">History</div>

            <div class="statProf"><input class="profRadio" id="investigationProf" type="checkbox" onclick="addIntelProf('investigation')"></input>
              <input type="checkbox" class="expertRadio" id="investigationExpert" onclick="addIntelProf('investigation')"></input><input class="prof" id="investigationVal" value="<?php echo $intelmod; ?>" disabled></input><span class="profName" id="investigationName" onclick="profRoll('investigationVal')">Investigation</div>

            <div class="statProf"><input class="profRadio" id="natureProf" type="checkbox" onclick="addIntelProf('nature')"></input>
              <input type="checkbox" class="expertRadio" id="natureExpert" onclick="addIntelProf('nature')"></input><input class="prof" id="natureVal" value="<?php echo $intelmod; ?>" disabled></input><span class="profName" id="natureName" onclick="profRoll('natureVal')">Nature</div>

            <div class="statProf"><input class="profRadio" id="religionProf" type="checkbox" onclick="addIntelProf('religion')"></input>
              <input type="checkbox" class="expertRadio" id="religionExpert" onclick="addIntelProf('religion')"></input><input class="prof" id="religionVal" value="<?php echo $intelmod; ?>" disabled></input><span class="profName" id="religionName" onclick="profRoll('religionVal')">Religion</div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-5" id="wisBox">
              <input class="statScore" id="wisScore" value="<?php echo $row['wis']; ?>"></input>
              <div class="statMod" id="wisMod"><?php echo $wismod; ?></div>
              <div class="statName" id="wisName" onclick="abilityCheck('wis<?php echo $wismod; ?>')">Wisdom</div>
            </div>

          <div class="statProfs col-xs-7">
            <div class="statProf"><input class="profRadio" id="wisSaveProf" type="checkbox" onclick="addWisProf('wisSave')"></input>
              <input type="checkbox" class="expertRadio" id="wisSaveExpert" onclick="addWisProf('wisSave')"></input><input class="prof" id="wisSaveVal" value="<?php echo $wismod; ?>" disabled></input><span class="profName" id="wisSaveName" onclick="profRoll('wisSaveVal')"><b>Saving Throw</b></span></div>

            <div class="statProf"><input class="profRadio" id="animalProf" type="checkbox" onclick="addWisProf('animal')"></input>
              <input type="checkbox" class="expertRadio" id="animalExpert" onclick="addWisProf('animal')"></input><input class="prof" id="animalVal" value="<?php echo $wismod; ?>" disabled></input><span class="profName" id="animalName" onclick="profRoll('animalVal')">Animal Handling</div>

            <div class="statProf"><input class="profRadio" id="insightProf" type="checkbox" onclick="addWisProf('insight')"></input>
              <input type="checkbox" class="expertRadio" id="insightExpert" onclick="addWisProf('insight')"></input><input class="prof" id="insightVal" value="<?php echo $wismod; ?>" disabled></input><span class="profName" id="insightName" onclick="profRoll('insightVal')">Insight</div>

            <div class="statProf"><input class="profRadio" id="medicineProf" type="checkbox" onclick="addWisProf('medicine')"></input>
              <input type="checkbox" class="expertRadio" id="medicineExpert" onclick="addWisProf('medicine')"></input><input class="prof" id="medicineVal" value="<?php echo $wismod; ?>" disabled></input><span class="profName" id="medicineName" onclick="profRoll('medicineVal')">Medicine</div>

            <div class="statProf"><input class="profRadio" id="perceptionProf" type="checkbox" onclick="addWisProf('perception')"></input>
              <input type="checkbox" class="expertRadio" id="perceptionExpert" onclick="addWisProf('perception')"></input><input class="prof" id="perceptionVal" value="<?php echo $wismod; ?>" disabled></input><span class="profName" id="perceptionName" onclick="profRoll('perceptionVal')">Perception</div>

            <div class="statProf"><input class="profRadio" id="survivalProf" type="checkbox" onclick="addWisProf('survival')"></input>
              <input type="checkbox" class="expertRadio" id="survivalExpert" onclick="addWisProf('survival')"></input><input class="prof" id="survivalVal" value="<?php echo $wismod; ?>" disabled></input><span class="profName" id="survivalName" onclick="profRoll('survivalVal')">Survival</div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-5" id="chaBox">
              <input class="statScore" id="chaScore" value="<?php echo $row['cha']; ?>"></input>
              <div class="statMod" id="chaMod"><?php echo $chamod; ?></div>
              <div class="statName" id="chaName" onclick="abilityCheck('cha<?php echo $chamod; ?>')">Charisma</div>
            </div>

          <div class="statProfs col-xs-7">
            <div class="statProf"><input class="profRadio" id="chaSaveProf" type="checkbox" onclick="addChaProf('chaSave');"></input>
              <input type="checkbox" class="expertRadio" id="chaSaveExpert" onclick="addChaProf('chaSave');"></input><input class="prof" id="chaSaveVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="chaSaveName" onclick="profRoll('chaSaveVal')"><b>Saving Throw</b></div>

            <div class="statProf"><input class="profRadio" id="deceptionProf" type="checkbox" onclick="addChaProf('deception');"></input>
              <input type="checkbox" class="expertRadio" id="deceptionExpert" onclick="addChaProf('deception');"></input><input class="prof" id="deceptionVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="deceptionName" onclick="profRoll('deceptionVal')">Deception</div>

            <div class="statProf"><input class="profRadio" id="intimidationProf" type="checkbox" onclick="addChaProf('intimidation');"></input>
              <input type="checkbox" class="expertRadio" id="intimidationExpert" onclick="addChaProf('intimidation');"></input><input class="prof" id="intimidationVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="intimidationName" onclick="profRoll('intimidationVal')">Intimidation</div>

            <div class="statProf"><input class="profRadio" id="performanceProf" type="checkbox" onclick="addChaProf('performance');"></input>
              <input type="checkbox" class="expertRadio" id="performanceExpert" onclick="addChaProf('performance');"></input><input class="prof" id="performanceVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="performanceName" onclick="profRoll('performanceVal')">Performance</div>

            <div class="statProf"><input class="profRadio" id="persuasionProf" type="checkbox" onclick="addChaProf('persuasion');"></input>
              <input type="checkbox" class="expertRadio" id="persuasionExpert" onclick="addChaProf('persuasion');"></input><input class="prof" id="persuasionVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="persuasionName" onclick="profRoll('persuasionVal')">Persuasion</div>
          </div>
        </div>
        </div>


        <!-- VITALS BLOCKS -->

        <div class="col-md-4 col-sm-6 col-xs-12 sidebartext">
          <table class="vitalsTable">
            <tr>
              <td><input class="vitals" id="initiative" value="<?php echo $dexmod; ?>"></td>
              <td rowspan="3"><input class="vitals bigVital" id="maxHP" value="<?php echo $row['maxhp']; ?>"></td>
              <td><input class="vitals" id="hitDice" value="d<?php echo $row['hitdice']; ?>"></td>
            </tr>
            <tr>
              <td><div class="charDeet profName" id="initiativeName" onclick="profRoll('initiative')">Initiative</div></td>
              <td><div class="charDeet">Hit Dice</div></td>
            </tr>
            <tr>
              <td><input class="vitals" id="speed" value="<?php echo $row['speed']; ?>"></td>
              <td><input class="vitals" id="armorClass" value="<?php echo $row['armorclass']; ?>"></td>
            </tr>
            <tr>
              <td><div class="charDeet">Speed</div></td>
              <td><div class="charDeet">Hit Points</div></td>
              <td><div class="charDeet">AC</div></td>
            </tr>
          </table>
        </div>


      <!-- CLASS FEATURES -->
      <div class="col-md-4 col-sm-6 col-xs-12 sidebartext" style="border: 1px solid white;">

        <?php
        $coreclass = substr($fullclass, 0, strpos($fullclass, " "));
        $subclasstemp = substr($fullclass, strpos($fullclass, "(") +1);
        $subclass = trim($subclasstemp, ')');
        $coreclass = $coreclass.' core';

          $worldtitle = "SELECT * FROM `subclasses` WHERE `name` LIKE '$coreclass'";
          $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
          while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            ?>

              <div class="featureName"><?php echo $Parsedown->text(nl2br($row['lvlskill2name'])); ?></div>
              <div class="featureDetails"><?php echo $Parsedown->text(nl2br($row['lvlskill2text'])); ?></div>

              <div class="featureName"><?php echo $Parsedown->text(nl2br($row['lvlskill3name'])); ?></div>
              <div class="featureDetails"><?php echo $Parsedown->text(nl2br($row['lvlskill3text'])); ?></div>

              <div class="featureName"><?php echo $Parsedown->text(nl2br($row['lvlskill4name'])); ?></div>
              <div class="featureDetails"><?php echo $Parsedown->text(nl2br($row['lvlskill4text'])); ?></div>

            <?php
          }

          $worldtitle = "SELECT * FROM `subclasses` WHERE `name` LIKE '$subclass'";
          $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
          while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            ?>

              <div class="featureName"><?php echo $row['lvlskill3name']; ?></div>
              <div class="featureDetails"><?php echo $row['lvlskill3text']; ?></div>

            <?php
          }
         ?>

        </div>


          <?php

//CHECK EXISTING PROFICIENCIES
if (strpos($row['saves'], 'Strength') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#strSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['saves'], 'Dexterity') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#dexSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['saves'], 'Constitution') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#conSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['saves'], 'Intelligence') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#intelSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['saves'], 'Wisdom') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#wisSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['saves'], 'Charisma') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#chaSaveProf').prop('checked', true);

  });

  </script>
<?php
}

  if (strpos($row['proficiencies'], 'Athletics') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#athleticsProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Acrobatics') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#acrobaticsProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Sleight of Hand') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#sleightProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Stealth') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#stealthProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Arcana') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#arcanaProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'History') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#historyProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Investigation') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#investigationProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Nature') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#natureProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Religion') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#religionProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Animal Handling') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#animalProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Insight') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#insightProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Medicine') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#medicineProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Perception') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#perceptionProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Survival') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#survivalProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Deception') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#deceptionProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Intimidation') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#intimidationProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Persuasion') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#persuasionProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($row['proficiencies'], 'Performance') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#performanceProf').prop('checked', true);

    });

    </script>
  <?php
  }



//EXPERTISE CHECKBOXES
if (strpos($row['expertise'], 'Athletics') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#athleticsExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Acrobatics') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#acrobaticsExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Sleight of Hand') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#sleightExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Stealth') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#stealthExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Arcana') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#arcanaExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'History') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#historyExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Investigation') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#investigationExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Nature') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#natureExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Religion') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#religionExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Animal Handling') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#animalExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Insight') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#insightExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Medicine') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#medicineExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Perception') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#perceptionExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Survival') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#survivalExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Deception') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#deceptionExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Intimidation') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#intimidationExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Persuasion') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#persuasionExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($row['expertise'], 'Performance') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#performanceExpert').prop('checked', true);

  });

  </script>
<?php
}

// PROFICIENCIES
    ?>
    <script>
    function addStrProf(value) {
      var currentVal = <?php echo $strmod; ?>;
      var newVal = 0;
      if (document.getElementById(value + 'Prof').checked)
 {
   if (document.getElementById(value + 'Expert').checked) {
        newVal = currentVal + <?php echo $profbonus; ?> * 2;
   }
   else {
    newVal = currentVal + <?php echo $profbonus; ?>;
  }
     document.getElementById(value + 'Val').value = newVal;
 }

 else {
   document.getElementById(value + 'Val').value = currentVal;
 }
    }

    function addDexProf(value) {
      var currentVal = <?php echo $dexmod; ?>;
      var newVal = 0;
      if (document.getElementById(value + 'Prof').checked)
    {
      if (document.getElementById(value + 'Expert').checked) {
           newVal = currentVal + <?php echo $profbonus; ?> * 2;
      }
      else {
       newVal = currentVal + <?php echo $profbonus; ?>;
     }
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
   if (document.getElementById(value + 'Expert').checked) {
        newVal = currentVal + <?php echo $profbonus; ?> * 2;
   }
   else {
    newVal = currentVal + <?php echo $profbonus; ?>;
  }
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
   if (document.getElementById(value + 'Expert').checked) {
        newVal = currentVal + <?php echo $profbonus; ?> * 2;
   }
   else {
    newVal = currentVal + <?php echo $profbonus; ?>;
  }
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
   if (document.getElementById(value + 'Expert').checked) {
        newVal = currentVal + <?php echo $profbonus; ?> * 2;
   }
   else {
    newVal = currentVal + <?php echo $profbonus; ?>;
  }
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
   if (document.getElementById(value + 'Expert').checked) {
        newVal = currentVal + <?php echo $profbonus; ?> * 2;
   }
   else {
    newVal = currentVal + <?php echo $profbonus; ?>;
  }
     document.getElementById(value + 'Val').value = newVal;
 } else {
   document.getElementById(value + 'Val').value = currentVal;
 }
    }


//ROLLS
function profRoll(value) {
  var modifier = parseInt(document.getElementById(value).value, 10);
  var roll = Math.floor(Math.random() * 20) + 1;
  var result = roll + modifier;
  var typeID = value.replace('Val', '');
  var typeName = document.getElementById(typeID + 'Name').innerHTML;
  document.getElementById('rollResult').innerHTML = result;
  document.getElementById('rollFormula').innerHTML = roll + ' + (' + modifier + ')';

  if (typeName == '<b>Saving Throw</b>') {
    saveType = typeID.replace('Save', '');
    saveType = saveType.toUpperCase();
    typeName = '<b>' + saveType + ' Saving Throw</b>';
  }
  if (roll == 20) {
    document.getElementById('nat20').innerHTML = 'Natural 20!';
    document.getElementById('rollResult').classList.add('nat20');
    document.getElementById('rollFormula').classList.add('nat20');
    document.getElementById('rollType').classList.add('nat20');

  }
  else if (roll == 1) {
    document.getElementById('nat1').innerHTML = 'Natural 1!';
    document.getElementById('rollResult').classList.add('nat1');
    document.getElementById('rollFormula').classList.add('nat1');
    document.getElementById('rollType').classList.add('nat1');
  }
  else {
    document.getElementById('rollResult').classList.remove('nat1');
    document.getElementById('rollFormula').classList.remove('nat1');
    document.getElementById('rollType').classList.remove('nat1');
    document.getElementById('rollResult').classList.remove('nat20');
    document.getElementById('rollFormula').classList.remove('nat20');
    document.getElementById('rollType').classList.remove('nat20');
    document.getElementById('nat20').innerHTML = '';
    document.getElementById('nat1').innerHTML = '';
  }
  document.getElementById('rollType').innerHTML = typeName;

  function showRollModal() {
    $("#rollModal").modal();
  }
  showRollModal();
}

function abilityCheck(value) {
  var modifier = parseInt(value.substring(3), 10);
  var roll = Math.floor(Math.random() * 20) + 1;
  var result = roll + modifier;
  var typeID = value.substring(0,3);
  var typeName = document.getElementById(typeID + 'Name').innerHTML;
  document.getElementById('rollResult').innerHTML = result;
  document.getElementById('rollFormula').innerHTML = roll + ' + (' + modifier + ')';

  if (roll == 20) {
    document.getElementById('nat20').innerHTML = 'Natural 20!';
    document.getElementById('rollResult').classList.add('nat20');
    document.getElementById('rollFormula').classList.add('nat20');
    document.getElementById('rollType').classList.add('nat20');
    document.getElementById('rollResult').classList.remove('nat1');
    document.getElementById('rollFormula').classList.remove('nat1');
    document.getElementById('rollType').classList.remove('nat1');

  }
  else if (roll == 1) {
    document.getElementById('nat1').innerHTML = 'Natural 1!';
    document.getElementById('rollResult').classList.add('nat1');
    document.getElementById('rollFormula').classList.add('nat1');
    document.getElementById('rollType').classList.add('nat1');
    document.getElementById('rollResult').classList.remove('nat20');
    document.getElementById('rollFormula').classList.remove('nat20');
    document.getElementById('rollType').classList.remove('nat20');
  }
  else {
    document.getElementById('rollResult').classList.remove('nat1');
    document.getElementById('rollFormula').classList.remove('nat1');
    document.getElementById('rollType').classList.remove('nat1');
    document.getElementById('rollResult').classList.remove('nat20');
    document.getElementById('rollFormula').classList.remove('nat20');
    document.getElementById('rollType').classList.remove('nat20');
    document.getElementById('nat20').innerHTML = '';
    document.getElementById('nat1').innerHTML = '';
  }
  document.getElementById('rollType').innerHTML = typeName;

  function showRollModal() {
    $("#rollModal").modal();
  }
  showRollModal();
}

//INITIALIZE VALUES ON PAGE LOAD
$(document).ready(function lockSheet() {
  addStrProf('strSave');
  addStrProf('athletics');

  addDexProf('dexSave');
  addDexProf('acrobatics');
  addDexProf('sleight');
  addDexProf('stealth');

  addConProf('conSave');

  addIntelProf('intelSave');
  addIntelProf('arcana');
  addIntelProf('history');
  addIntelProf('investigation');
  addIntelProf('nature');
  addIntelProf('religion');

  addWisProf('wisSave');
  addWisProf('animal');
  addWisProf('insight');
  addWisProf('medicine');
  addWisProf('perception');
  addWisProf('survival');

  addChaProf('chaSave');
  addChaProf('deception');
  addChaProf('intimidation');
  addChaProf('performance');
  addChaProf('persuasion');
});
</script>

<script>

//SAVE CHARACTER
//on the click of the submit button
function saveSheet(){
      var newProf = '';
      var newSaves = '';
      var newExpert = '';
      var charID = <?php echo $charID; ?>;

  if ($('#athleticsProf').prop('checked')) {
      newProf = newProf + 'Athletics' + ' ';
  }
  if ($('#acrobaticsProf').prop('checked')) {
      newProf = newProf + 'Acrobatics' + ' ';
  }
  if ($('#sleightProf').prop('checked')) {
      newProf = newProf + 'Sleight of Hand' + ' ';
  }
  if ($('#stealthProf').prop('checked')) {
      newProf = newProf + 'Stealth' + ' ';
  }
  if ($('#arcanaProf').prop('checked')) {
      newProf = newProf + 'Arcana' + ' ';
  }
  if ($('#historyProf').prop('checked')) {
      newProf = newProf + 'History' + ' ';
  }
  if ($('#investigationProf').prop('checked')) {
      newProf = newProf + 'Investigation' + ' ';
  }
  if ($('#natureProf').prop('checked')) {
      newProf = newProf + 'Nature' + ' ';
  }
  if ($('#religionProf').prop('checked')) {
      newProf = newProf + 'Religion' + ' ';
  }
  if ($('#animalProf').prop('checked')) {
      newProf = newProf + 'Animal Handling' + ' ';
  }
  if ($('#insightProf').prop('checked')) {
      newProf = newProf + 'Insight' + ' ';
  }
  if ($('#medicineProf').prop('checked')) {
      newProf = newProf + 'Medicine' + ' ';
  }
  if ($('#perceptionProf').prop('checked')) {
      newProf = newProf + 'Perception' + ' ';
  }
  if ($('#survivalProf').prop('checked')) {
      newProf = newProf + 'Survival' + ' ';
  }
  if ($('#deceptionProf').prop('checked')) {
      newProf = newProf + 'Deception' + ' ';
  }
  if ($('#intimidationProf').prop('checked')) {
      newProf = newProf + 'Intimidation' + ' ';
  }
  if ($('#performanceProf').prop('checked')) {
      newProf = newProf + 'Performance' + ' ';
   }
  if ($('#persuasionProf').prop('checked')) {
      newProf = newProf + 'Persuasion' + ' ';
  }


//EXPERTISE
if ($('#athleticsExpert').prop('checked')) {
    newExpert = newExpert + 'Athletics' + ' ';
}
if ($('#acrobaticsExpert').prop('checked')) {
    newExpert = newExpert + 'Acrobatics' + ' ';
}
if ($('#sleightExpert').prop('checked')) {
    newExpert = newExpert + 'Sleight of Hand' + ' ';
}
if ($('#stealthExpert').prop('checked')) {
    newExpert = newExpert + 'Stealth' + ' ';
}
if ($('#arcanaExpert').prop('checked')) {
    newExpert = newExpert + 'Arcana' + ' ';
}
if ($('#historyExpert').prop('checked')) {
    newExpert = newExpert + 'History' + ' ';
}
if ($('#investigationExpert').prop('checked')) {
    newExpert = newExpert + 'Investigation' + ' ';
}
if ($('#natureExpert').prop('checked')) {
    newExpert = newExpert + 'Nature' + ' ';
}
if ($('#religionExpert').prop('checked')) {
    newExpert = newExpert + 'Religion' + ' ';
}
if ($('#animalExpert').prop('checked')) {
    newExpert = newExpert + 'Animal Handling' + ' ';
}
if ($('#insightExpert').prop('checked')) {
    newExpert = newExpert + 'Insight' + ' ';
}
if ($('#medicineExpert').prop('checked')) {
    newExpert = newExpert + 'Medicine' + ' ';
}
if ($('#perceptionExpert').prop('checked')) {
    newExpert = newExpert + 'Perception' + ' ';
}
if ($('#survivalExpert').prop('checked')) {
    newExpert = newExpert + 'Survival' + ' ';
}
if ($('#deceptionExpert').prop('checked')) {
    newExpert = newExpert + 'Deception' + ' ';
}
if ($('#intimidationExpert').prop('checked')) {
    newExpert = newExpert + 'Intimidation' + ' ';
}
if ($('#performanceExpert').prop('checked')) {
    newExpert = newExpert + 'Performance' + ' ';
 }
if ($('#persuasionExpert').prop('checked')) {
    newExpert = newExpert + 'Persuasion' + ' ';
}


//SAVE SAVING THROW PROFICIENCIES
  if ($('#strSaveProf').prop('checked')) {
      newSaves = newSaves + 'Strength' + ' ';
  }
  if ($('#dexSaveProf').prop('checked')) {
      newSaves = newSaves + 'Dexterity' + ' ';
  }
  if ($('#conSaveProf').prop('checked')) {
      newSaves = newSaves + 'Constitution' + ' ';
  }
  if ($('#intelSaveProf').prop('checked')) {
      newSaves = newSaves + 'Intelligence' + ' ';
  }
  if ($('#wisSaveProf').prop('checked')) {
      newSaves = newSaves + 'Wisdom' + ' ';
  }
  if ($('#chaSaveProf').prop('checked')) {
      newSaves = newSaves + 'Charisma' + ' ';
  }

 //get the form values
 var strScore = $('#strScore').val();
 var dexScore = $('#dexScore').val();
 var conScore = $('#conScore').val();
 var intelScore = $('#intScore').val();
 var wisScore = $('#wisScore').val();
 var chaScore = $('#chaScore').val();
 var initiative = $('#initiative').val();
 var maxhp = $('#maxHP').val();
 var hitdice = $('#hitDice').val();
 var speed = $('#speed').val();
 var armorclass = $('#armorClass').val();
 var charName = $('#charName').val();
 var charClass = $('#charClass').val();
 var charLevel = $('#charLevel').val();
 var charRace = $('#charRace').val();
 var charBackground = $('#charBackground').val();
 var charAlignment = $('#charAlignment').val();

 if (hitdice.indexOf('d') > -1) {
  hitdice = hitdice.replace('d', '');
}

 //make the postdata
 //call your input.php script in the background, when it returns it will call the success function if the request was successful or the error one if there was an issue (like a 404, 500 or any other error status)

 $.ajax({
    url : 'charprocess.php',
    type: 'POST',
    data : { "charID" : charID, "proficiencies" : newProf, "title" : charName, "saves" : newSaves, "expertise" : newExpert, "strength" : strScore, "dexterity" : dexScore, "constitution" : conScore, "intelligence" : intelScore, "wisdom" : wisScore, "charisma" : chaScore, "initiative" : initiative, "maxhp" : maxhp, "hitdice" : hitdice, "speed" : speed, "armorclass" : armorclass, "charClass" : charClass,
    "charRace" : charRace, "charLevel" : charLevel, "charBackground" : charBackground, "charAlignment" : charAlignment },
    success: function()
    {
        //if success then just output the text to the status div then clear the form inputs to prepare for new data
      //  $("#favButton").addClass('disabled');
        //$('#favButton').html('In Favourites');
        var newURL = '/tools/users/characters.php?id=' + charName;
        $(location).attr('href', newURL)
    },
    error: function (jqXHR, status, errorThrown)
    {
        //if fail show error and server status
        $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
    }
});
};

    </script>
<?php
  }
  ?>

  <!-- Item Modal -->
  <div class="modal fade bd-example-modal-lg" id="rollModal" role="dialog">
    <div class="modal-dialog" style="width: 80%; max-width:1200px;">

      <!-- Modal content-->
      <div class="modal-content modalstyle bodytext" style="height:100%;">
        <div class="modal-header" style="padding-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body" id="rollModalBody" style="height:100%; padding-top: 0px;">
          <div class="rollname col-centered" id="rollType"></div>
          <div class="rollnumber col-centered" id="rollResult"></div>
          <div class="rollformula col-centered" id="rollFormula"></div>
          <div class="nat20 col-centered" id="nat20"></div>
          <div class="nat1 col-centered" id="nat1"></div>

        </div>

      </div>

    </div>
  </div>


</div>
</div>


  <?php
  //Footer
  $footpath = $_SERVER['DOCUMENT_ROOT'];
  $footpath .= "/footer.php";
  include_once($footpath);
   ?>
