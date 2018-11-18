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
            <div class="statProf"><input class="profRadio" id="strSaveProf" type="checkbox" onclick="addStrProf('strSave')"></input>
              <input type="checkbox" class="expertRadio" id="strSaveExpert" onclick="addStrProf('strSave')"></input><input class="prof" id="strSaveVal" value="<?php echo $strmod; ?>" disabled></input><span class="profName" id="strSaveName" onclick="profRoll('strSaveVal')"><b>Saving Throw</b></div>

            <div class="statProf"><input class="profRadio" id="athleticsProf" type="checkbox" onclick="addStrProf('athletics')"></input>
              <input type="checkbox" class="expertRadio" id="athleticsExpert" onclick="addStrProf('athletics')"></input><input class="prof" id="athleticsVal" value="<?php echo $strmod; ?>" disabled></input><span class="profName" id="athleticsName" onclick="profRoll('athleticsVal')">Athletics</div>
          </div>
        </div>
            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="dexBox">
              <div class="statScore" id="dexScore"><?php echo $row['dex']; ?></div>
              <div class="statMod" id="dexMod"><?php echo $dexmod; ?></div>
              <div class="statName" id="dexName">Dexterity</div>
            </div>

          <div class="statProfs col-xs-8">
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
            <div class="statBox col-xs-4" id="conBox">
              <div class="statScore" id="conScore"><?php echo $row['con']; ?></div>
              <div class="statMod" id="conMod"><?php echo $conmod; ?></div>
              <div class="statName" id="conName">Constitution</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf"><input class="profRadio" id="conSaveProf" type="checkbox" onclick="addConProf('conSave')"></input>
              <input type="checkbox" class="expertRadio" id="conSaveExpert" onclick="addConProf('conSave')"></input><input class="prof" id="conSaveVal" value="<?php echo $conmod; ?>" disabled></input><span class="profName" id="conSaveName" onclick="profRoll('conSaveVal')"><b>Saving Throw</b></div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="intBox">
              <div class="statScore" id="intScore"><?php echo $row['intel']; ?></div>
              <div class="statMod" id="intMod"><?php echo $intelmod; ?></div>
              <div class="statName" id="intName">Intelligence</div>
            </div>

          <div class="statProfs col-xs-8">
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
            <div class="statBox col-xs-4" id="wisBox">
              <div class="statScore" id="wisScore"><?php echo $row['wis']; ?></div>
              <div class="statMod" id="wisMod"><?php echo $wismod; ?></div>
              <div class="statName" id="wisName">Wisdom</div>
            </div>

          <div class="statProfs col-xs-8">
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
            <div class="statBox col-xs-4" id="chaBox">
              <div class="statScore" id="chaScore"><?php echo $row['cha']; ?></div>
              <div class="statMod" id="chaMod"><?php echo $chamod; ?></div>
              <div class="statName" id="chaName">Charisma</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf"><input class="profRadio" id="chaSaveProf" type="checkbox" onclick="addChaProf('chaSave');"></input>
              <input type="checkbox" class="expertRadio" id="chaSaveExpert" onclick="addChaProf('chaSave');"></input><input class="prof" id="chaSaveVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="chaSaveName" onclick="profRoll('chaSaveVal')"><b>Saving Throw</b></div>

            <div class="statProf"><input class="profRadio" id="deceptionProf" type="checkbox" onclick="addChaProf('deception');"></input>
              <input type="checkbox" class="expertRadio" id="deceptionExpert" onclick="addChaProf('deception');"></input><input class="prof" id="deceptionVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="deceptionName" onclick="profRoll('deceptionVal')">deception</div>

            <div class="statProf"><input class="profRadio" id="intimidationProf" type="checkbox" onclick="addChaProf('intimidation');"></input>
              <input type="checkbox" class="expertRadio" id="intimidationExpert" onclick="addChaProf('intimidation');"></input><input class="prof" id="intimidationVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="intimidationName" onclick="profRoll('intimidationVal')">intimidation</div>

            <div class="statProf"><input class="profRadio" id="performanceProf" type="checkbox" onclick="addChaProf('performance');"></input>
              <input type="checkbox" class="expertRadio" id="performanceExpert" onclick="addChaProf('performance');"></input><input class="prof" id="performanceVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="performanceName" onclick="profRoll('performanceVal')">performance</div>

            <div class="statProf"><input class="profRadio" id="persuasionProf" type="checkbox" onclick="addChaProf('persuasion');"></input>
              <input type="checkbox" class="expertRadio" id="persuasionExpert" onclick="addChaProf('persuasion');"></input><input class="prof" id="persuasionVal" value="<?php echo $chamod; ?>" disabled></input><span class="profName" id="persuasionName" onclick="profRoll('persuasionVal')">persuasion</div>
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
