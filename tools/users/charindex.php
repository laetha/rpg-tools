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
var textareas = document.getElementsByTagName("textarea");
textareas[0].disabled = true;
for (var i = 0; i < inputs.length; i++) {
    if(inputs[i].id.indexOf("search") > -1 == false){
      if(inputs[i].id.indexOf("itemSearch") > -1 == false){
    inputs[i].disabled = true;
  }
  }
  }
  var selects = document.querySelectorAll('.selector .subclassSelect, .charClassSelect');
  for (var i = 0; i < selects.length; i++) {
      selects[i].disabled = true;
    }
});

//EDIT SHEET, ENABLE ALL INPUTS
function editSheet() {
  var inputs = document.getElementsByTagName("input");
  var textareas = document.getElementsByTagName("textarea");
  textareas[0].style = "background-color: #717782; opacity: 0.6; color:white;";
  textareas[0].disabled = false;
  for (var i = 0; i < inputs.length; i++) {
      inputs[i].disabled = false;
      inputs[i].style = "background-color: #717782; opacity: 0.6;";

      var selects = document.querySelectorAll('.subclassSelect, .charClassSelect');
      for (var s = 0; s < selects.length; s++) {
          //selects[s].style = "background-color: #717782;";
          selects[s].disabled = false;
        }

    }
    document.getElementById("editSheet").style = "display:none";
    document.getElementsByName("currentSubclass").style = "display:none";
    document.getElementById("saveSheet").style = "display:inline-block";
    document.getElementById("cancelSheet").style = "display:inline-block";
    document.getElementById("spells").style = "display:block";
    document.getElementById("itemSearchBox").style = "display:block";
    var dels = document.getElementsByName("delitem");
    var d = 0;

    for (d = 0; d < dels.length; d++) {
      dels[d].style = "display:inline-block"
    }
//    document.getElementById('test').innerHTML = dels[0];
    /*document.getElementById("mystics").style = "display:block";
    document.getElementById("mySpells").style = "display:none;";
    document.getElementById("mymystics").style = "display:none;";*/
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
    if ($row['user'] !== $loguser){
      header("Location: /tools/users/login.php");
      die();
    }
   //echo $row['title'];
   $title = $row['title'];
   $charID = $row['id'];
   $fullclass = $row['class1'];
   $dexmod = floor((($row['dex']-10)/2));
   $coreclass = substr($fullclass, 0, strpos($fullclass, "(") -1);
   $subclasstemp = substr($fullclass, strpos($fullclass, "(") +1);
   $subclass = trim($subclasstemp, ')');
   $coreclassbare = ucwords($coreclass);
   $background = $row['background'];
   $race = $row['race'];
   $bgbare = ucwords($row['background']);
   $coreclass = $coreclass.' core';
   $checkprofs = $row['proficiencies'];
   $checksaves = $row['saves'];
   $checkexperts = $row['expertise'];
   $allattacks = $row['attacks'];
   $allspells = $row['spells'];
   $spellsarray = explode(',', $allspells);
   $customattacks = $row['customattacks'];
   $charNotes = $row['notes'];
   $charItems = $row['items'];
   ?>

   <script>
    $(document).ready(function() {
      var allSpells = '<?php echo $allspells; ?>';
       var spellArray = allSpells.split(',');
       var index = 0;
       var entryNS = '';
       for (index = 0; index < allSpells.length; ++index) {
         entryNS = spellArray[index].replace(' ', '');
         $('#' + entryNS + 'Box').prop('checked', true);
       }
       var itemsDirty = '<?php echo $charItems; ?>';
       var currentItems = itemsDirty.split('_');
       var itemTable = $('#itemTable').html();
       var item = 0;
       for (item = 0; item < currentItems.length; ++item) {
         itemTable = itemTable + '<tr id="delrow' + item + '" style="display:block;"><td><form onSubmit="return false" name="delitem" style="display:none;"><button type="submit" class="logbtn btn btn-danger btn-sq-xs delitem" style="margin-right:15px;"  onclick="delItem(\'' + item + '\')"><span class="glyphicon glyphicon-remove"></span></button></form></td><td id ="deltd' + item + '"><a class="featureName" id="delitem' + item + '" data-toggle="collapse" href="#' + item + 'show">' + currentItems[item] + '</a></td></tr><tr><td colspan="2"><div class="featureDetails collapse" id="' + item + 'show">';
         itemTable = itemTable + '<iframe class="charCreateFrame" src="/tools/world/popout.php?id=' + currentItems[item] + '" style="width: 100%; height: 300px;" seamless></iframe></td></tr>';
       }
       document.getElementById('itemTable').innerHTML = itemTable;
    });

    function delItem(value){
        var itemsRaw = $('#currentItemsRaw').html();
        var toDelete = $('#delitem' + value).html();
        if (itemsRaw.includes("_" + toDelete) == true){
          itemsRaw = itemsRaw.replace('_' + toDelete, '');
        }
        itemsRaw = itemsRaw.replace(toDelete, '');
        document.getElementById('currentItemsRaw').innerHTML = itemsRaw;
        document.getElementById('delrow' + value).style = "display:none;";
    };
 </script>
   <button class="btn btn-info" onclick="editSheet()" id="editSheet">Edit</button>
   <button class="btn btn-success" id="saveSheet" onclick="saveSheet()" style="display:none;">Save</button>
   <button class="btn btn-danger" onclick="window.location.reload()" id="cancelSheet" style="display:none;">Cancel</button>
   <div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-primary active">
    <input type="radio" name="options" id="option1" autocomplete="off" onchange="showBlock('all')" checked> Show All
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option2" autocomplete="off" onchange="showBlock('statsBlock')"> Stats
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option3" autocomplete="off" onchange="showBlock('vitalsBlock')"> Vitals
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option4" autocomplete="off" onchange="showBlock('abilitiesBlock')"> Abilities
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option5" autocomplete="off" onchange="showBlock('attacksBlock')"> Attacks
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option6" autocomplete="off" onchange="showBlock('spellsBlock')"> Spells
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option7" autocomplete="off" onchange="showBlock('itemsBlock')"> Items
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="options" id="option8" autocomplete="off" onchange="showBlock('notesBlock')"> Notes
  </label>
</div>
 </div>

<div class=" col-md-4 col-sm-6 col-xs-12">
  <input class="charName" id="charName" value="<?php echo $title; ?>">
 </div>

<div class="col-md-8 col-sm-6 col-xs-12 sidebartext">
  <table style="width: 100%;">
    <tr>
      <td>
        <select class="charClassSelect sheetDrop" name="charClass" id="charClass" onchange="classSelect()">
        <?php
        echo ('<option value="'.$coreclassbare.'" selected>'.$coreclassbare);
        $classtitle = "SELECT name FROM `subclasses` WHERE `name` LIKE '%core%'";
        $classdata = mysqli_query($dbcon, $classtitle) or die('error getting data');
        while($row1 =  mysqli_fetch_array($classdata, MYSQLI_ASSOC)) {
          $classNameClean = ucwords(substr($row1['name'], 0, strpos($row1['name'], " core")));
            echo ('<option value="'.$classNameClean.'">'.$classNameClean);
          }
          ?>
  </select>
    <?php
        $storeArray = Array();
        $classtitle = "SELECT class FROM `subclasses`";
        $classdata = mysqli_query($dbcon, $classtitle) or die('error getting data');
        while($row1 =  mysqli_fetch_array($classdata, MYSQLI_ASSOC)) {
          if (!in_array($row1['class'], $storeArray, true)){
            array_push($storeArray, $row1['class']);
          }
        }
      foreach ($storeArray as $item) {
        $itemNS = str_replace(' ', '', $item);
        echo ('<select class="subclassSelect sheetDrop selector" name="'.strtolower($itemNS).'SubList" id="'.strtolower($itemNS).'SubList" onchange="classSelect()">');
        //echo ('<option name="currentSubclass" value="'.$subclass.'">'.$subclass);
        $classtitle = "SELECT name, class FROM `subclasses`";
        $classdata = mysqli_query($dbcon, $classtitle) or die('error getting data');
        while($row1 =  mysqli_fetch_array($classdata, MYSQLI_ASSOC)) {
          if ($row1['class'] == $item) {
          $subclassNameClean = ucwords($row1['name']);
          $subclassNameCleanns = str_replace(' ', '', $subclassNameClean);
          if (strPos($subclassNameClean, " Core") === false){
            echo ('<option value="'.$subclassNameClean);
            if ($subclassNameClean === $subclass){
              echo ('" selected>'.$subclassNameClean);
            }
            else {
                echo ('">'.$subclassNameClean);
            }
          }
          }
      }
      echo ('</select>');
}
      ?>
</td>
      <td><select class="charClassSelect sheetDrop" name="charLevel" id="charLevel">
          <option value="<?php echo $row['level']; ?>" selected><?php echo $row['level']; ?>
          <option value="1">1
          <option value="2">2
          <option value="3">3
          <option value="4">4
          <option value="5">5
          <option value="6">6
          <option value="7">7
          <option value="8">8
          <option value="9">9
          <option value="10">10
          <option value="11">11
          <option value="12">12
          <option value="13">13
          <option value="14">14
          <option value="15">15
          <option value="16">16
          <option value="17">17
          <option value="18">18
          <option value="19">19
          <option value="20">20
      </select>
</td>
      <td><select class="charClassSelect sheetDrop" name="charAlignment" id="charAlignment">
          <option value="<?php echo $row['alignment']; ?>" selected><?php echo $row['alignment']; ?>
          <option value="Lawful Good">Lawful Good
          <option value="Neutral Good">Neutral Good
          <option value="Chaotic Good">Chaotic Good
          <option value="Lawful Neutral">Lawful Neutral
          <option value="True Neutral">True Neutral
          <option value="Chaotic Neutral">Chaotic Neutral
          <option value="Lawful Evil">Lawful Evil
          <option value="Neutral Evil">Neutral Evil
          <option value="Chaotic Evil">Chaotic Evil
          </select>
          </td>
    <tr>

    <tr style="border-top: 1px solid white;">
      <td><div class="charDeet">Class</div></td>
      <td><div class="charDeet">Level</div></td>
      <td><div class="charDeet">Alignment</div></td>
    </tr>
    <tr>
      <td><select class="charClassSelect sheetDrop selector" name="charRace" id="charRace">
          <?php
          $raceNameNoR = str_replace('(race)', '', $race);
          echo ('<option value="'.$raceNameNoR.'" selected>'.$raceNameNoR);
          $racetitle = "SELECT * FROM `compendium` WHERE `type` LIKE 'race'";
          $racedata = mysqli_query($dbcon, $racetitle) or die('error getting data');
          while($row1 =  mysqli_fetch_array($racedata, MYSQLI_ASSOC)) {
            $raceNameNoR = str_replace('(race)', '', $row1['title']);
            $raceNameClean = preg_replace('/[^a-z\d]+/i', '', $raceNameNoR);
              echo ('<option value="'.$raceNameNoR.'">'.$raceNameNoR);
            }
            ?>
    </select>
      </td>
      <td><select class="charClassSelect sheetDrop selector" name="charBackgroundSelect" id="charBackground">
        <?php
        echo ('<option value="'.$bgbare.'" selected>'.$bgbare);
        $bgtitle = "SELECT title FROM `compendium` WHERE `type` LIKE 'background'";
        $bgdata = mysqli_query($dbcon, $bgtitle) or die('error getting data');
        while($row1 =  mysqli_fetch_array($bgdata, MYSQLI_ASSOC)) {
          $bgNameNoBG = str_replace('(background)', '', $row1['title']);
          $bgNameClean = preg_replace('/[^a-z\d]+/i', '', $bgNameNoBG);
            echo ('<option value="'.$bgNameNoBG.'">'.$bgNameNoBG);
          }
          ?>
  </select>
      </td>
    </tr>
    <tr  style="border-top: 1px solid white;">
      <td><div class="charDeet">Race</div></td>
      <td><div class="charDeet">Background</div></td>
    </tr>
  </table>
</div>

<script>

$(document).ready(function (){
  var selectedClass = $('#charClass').val();
  classPrep = selectedClass.toLowerCase();
  classPrep = classPrep.replace(/ +/g, "");
  var subID = classPrep + 'SubList';
  var hideAll = document.getElementsByClassName('subclassSelect');
 for (var i = 0; i < hideAll.length; i++ ) {
    hideAll[i].style.display = "none";
}
  document.getElementById(subID).style = "display:inline-block";
  document.getElementById(subID).disabled = "true";

});

function classSelect(){
  var selectedClass = $('#charClass').val();
  classPrep = selectedClass.toLowerCase();
  classPrep = classPrep.replace(/ +/g, "");

  var subID = classPrep + 'SubList';
  var hideAll = document.getElementsByClassName('subclassSelect');
 for (var i = 0; i < hideAll.length; i++ ) {
    hideAll[i].style.display = "none";
}
  document.getElementById(subID).style = "display:inline-block";
  document.getElementById('currentSpells').innerHTML = "";
  document.getElementById('spellsShow').style = "display:none";
  document.getElementById('spellWarning').style = "display:block";

};

</script>

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
          $level = $row['level'];

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
          <div class="col-md-4 col-sm-6 col-xs-12" name="mainBlock" id="statsBlock">

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

        <div class="roundBorder col-md-4 col-sm-6 col-xs-12 sidebartext sheetBlock" name="mainBlock" id="vitalsBlock">
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
      <div class="roundBorder col-md-4 col-sm-6 col-xs-12 sidebartext sheetBlock" name="mainBlock" id="abilitiesBlock" style="float:right;">
        <div style="margin-bottom: 5px; border-bottom:1px solid white;">Abilities</div>


        <?php
        $coreclass = substr($fullclass, 0, strpos($fullclass, "(") -1);
        $subclasstemp = substr($fullclass, strpos($fullclass, "(") +1);
        $subclass = trim($subclasstemp, ')');
        $coreclass = $coreclass.' core';
          $worldtitle = "SELECT * FROM `subclasses` WHERE `name` LIKE '$coreclass'";
          $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
          while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            ?>

            <!-- LEVEL 1 -->
            <?php
            if ($level >= 1) {
            foreach($row as $column=>$field) {
              if (strpos($field, ' 1st level') !== false) {
                $featuretitle = str_replace('text', 'name', $column);
                $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
                $featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


                echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
                echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
              }
            }
          }
      ?>

      <!-- LEVEL 2 -->
      <?php
      if ($level >= 2) {
      foreach($row as $column=>$field) {
        if (strpos($field, ' 2nd level') !== false && strpos($field, ' 1st level') == false) {
          $featuretitle = str_replace('text', 'name', $column);
          $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


          echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
          echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
      }
    }
  }
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 3) {
foreach($row as $column=>$field) {
  if (strpos($field, ' 3rd level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 4) {
foreach($row as $column=>$field) {
if (strpos($field, ' 4th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 5) {
foreach($row as $column=>$field) {
if (strpos($field, ' 5th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 6) {
foreach($row as $column=>$field) {
if (strpos($field, ' 6th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');

}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 7) {
foreach($row as $column=>$field) {
if (strpos($field, ' 7th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 8) {
foreach($row as $column=>$field) {
if (strpos($field, ' 8th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 9) {
foreach($row as $column=>$field) {
  if (strpos($field, ' 9th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 10) {
foreach($row as $column=>$field) {
if (strpos($field, ' 10th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 11) {
foreach($row as $column=>$field) {
  if (strpos($field, ' 11th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 12) {
foreach($row as $column=>$field) {
if (strpos($field, ' 12th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 13) {
foreach($row as $column=>$field) {
if (strpos($field, ' 13th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 14) {
foreach($row as $column=>$field) {
  if (strpos($field, ' 14th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 15) {
foreach($row as $column=>$field) {
if (strpos($field, ' 15th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 16) {
foreach($row as $column=>$field) {
  if (strpos($field, ' 16th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 17) {
foreach($row as $column=>$field) {
if (strpos($field, ' 17th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false && strpos($field, ' 16th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 18) {
foreach($row as $column=>$field) {
  if (strpos($field, ' 18th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false && strpos($field, ' 16th level') == false && strpos($field, ' 17th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 19) {
foreach($row as $column=>$field) {
if (strpos($field, ' 19th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false && strpos($field, ' 16th level') == false && strpos($field, ' 17th level') == false && strpos($field, ' 18th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}
?>

<!-- LEVEL 3 -->
<?php
if ($level >= 20) {
foreach($row as $column=>$field) {
if (strpos($field, ' 20th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false && strpos($field, ' 16th level') == false && strpos($field, ' 17th level') == false && strpos($field, ' 18th level') == false && strpos($field, ' 19th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
}
}
}


?>

            <?php
          }
          $worldtitle = "SELECT * FROM `subclasses` WHERE `name` LIKE '$subclass'";
          $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
          while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            ?>

            <!-- LEVEL 1 -->
            <?php
            if ($level >= 1) {
            foreach($row as $column=>$field) {
              if (strpos($field, ' 1st level') !== false) {
                $featuretitle = str_replace('text', 'name', $column);
                $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


                echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
                echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
              }
            }
          }
      ?>

      <!-- LEVEL 2 -->
      <?php
      if ($level >= 2) {
      foreach($row as $column=>$field) {
        if (strpos($field, ' 2nd level') !== false && strpos($field, ' 1st level') == false) {
          $featuretitle = str_replace('text', 'name', $column);
          $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


          echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
          echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
      }
    }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 3) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 3rd level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 4) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 4th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 5) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 5th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 6) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 6th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');

  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 7) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 7th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    $featuretitlens = str_replace('(', '', $featuretitlens);
    $featuretitlens = str_replace(')', '', $featuretitlens);
    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 8) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 8th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 9) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 9th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 10) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 10th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 11) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 11th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 12) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 12th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 13) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 13th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 14) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 14th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 15) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 15th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 16) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 16th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 17) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 17th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false && strpos($field, ' 16th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 18) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 18th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false && strpos($field, ' 16th level') == false && strpos($field, ' 17th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 19) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 19th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false && strpos($field, ' 16th level') == false && strpos($field, ' 17th level') == false && strpos($field, ' 18th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);


    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }
  ?>

  <!-- LEVEL 3 -->
  <?php
  if ($level >= 20) {
  foreach($row as $column=>$field) {
  if (strpos($field, ' 20th level') !== false && strpos($field, ' 1st level') == false && strpos($field, ' 2nd level') == false && strpos($field, ' 3rd level') == false && strpos($field, ' 4th level') == false && strpos($field, ' 5th level') == false && strpos($field, ' 6th level') == false && strpos($field, ' 7th level') == false && strpos($field, ' 8th level') == false && strpos($field, ' 9th level') == false && strpos($field, ' 10th level') == false && strpos($field, ' 11th level') == false && strpos($field, ' 12th level') == false && strpos($field, ' 13th level') == false && strpos($field, ' 14th level') == false && strpos($field, ' 15th level') == false && strpos($field, ' 16th level') == false && strpos($field, ' 17th level') == false && strpos($field, ' 18th level') == false && strpos($field, ' 19th level') == false) {
    $featuretitle = str_replace('text', 'name', $column);
    $featuretitlens = str_replace(' ', '', $row[$featuretitle]);
$featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);
    echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$row[$featuretitle].'</a><br />');
    echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
  }
  }
  }


  ?>
            <?php
          }
          //BACKGROUND TRAITS
          $bgtitle = "SELECT title, backgroundTraits FROM `compendium` WHERE `title` LIKE '$background' OR `title` LIKE '$background(background)'";
          $bgdata = mysqli_query($dbcon, $bgtitle) or die('error getting data');
          while($bgrow =  mysqli_fetch_array($bgdata, MYSQLI_ASSOC)) {
            if (strpos($bgrow['title'], '(background)') !== false) {
            $bgName = substr($bgrow['title'], 0, strpos($bgrow['title'], "("));
          }
            else {
              $bgName = $bgrow['title'];
            }
          echo ('<a class="featureName" data-toggle="collapse" href="#backgroundshow">'.$bgName.' (Background)</a><br />');
          $bgTemp = substr($bgrow['backgroundTraits'], strpos($bgrow['backgroundTraits'], "*") -1);
          $bgTemp = substr($bgTemp, 0, strpos($bgTemp, "**Personality"));
          echo ('<div class="featureDetails collapse" id="backgroundshow" name="backgroundshow">'.$Parsedown->text(nl2br($bgTemp)).'</div>');
          }


         //RACIAL TRAITS
         $racetitle = "SELECT title, raceTraits FROM `compendium` WHERE `title` LIKE '$race' OR `title` LIKE '$race(race)'";
         $racedata = mysqli_query($dbcon, $racetitle) or die('error getting data');
         while($racerow =  mysqli_fetch_array($racedata, MYSQLI_ASSOC)) {
           if (strpos($racerow['title'], '(race)') !== false) {
           $raceName = substr($racerow['title'], 0, strpos($racerow['title'], "("));
         }
           else {
             $raceName = $racerow['title'];
           }
         echo ('<a class="featureName" data-toggle="collapse" href="#raceshow">'.$raceName.' (Race)</a><br />');
         $raceTemp = $racerow['raceTraits'];
         echo ('<div class="featureDetails collapse" id="raceshow" name="raceshow">'.$Parsedown->text(nl2br($raceTemp)).'</div>');
         }
        ?>

        </div>

        <div class="roundBorder col-md-4 col-sm-6 col-xs-12 sidebartext sheetBlock" style="padding:0px; border:0px;">

          <div class="roundBorder col-xs-12 sidebartext sheetBlock" name="mainBlock" id="itemsBlock" style="margin-top:10px;" style="float:right;">
            <div style="margin-bottom: 5px; border-bottom:1px solid white;">Items</div>
            <div id="itemSearchBox" style="display:none;">
            <select id="itemSearch">
            <option value=""></option>
            <?php

            $searchdrop = "SELECT title FROM compendium WHERE type LIKE 'item'";
            $searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
            while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
              $search = $searchrow['title'];
              echo "<option value=\"$search\">$search</option>";
            }
          ?>
          </select>
          </div>
          <div id="currentItemsClean"></div>
          <div id="currentItemsRaw" style="display:none;"><?php echo $charItems; ?></div>
          <table id="itemTable">
          </table>

          </div>

          <div class="col-xs-12 sidebartext sheetBlock" name="mainBlock" id="attacksBlock" style="margin-top:10px;">
            <div style="margin-bottom: 10px; border-bottom:1px solid white;">Attacks</div>
            <table class="attackTable">

          <tr>
            <td class="wideCell"><select class="charClassSelect attackDrop sheetDrop selector" name="attack1Select" id="attack1Select" onchange="attack(1)">
              <?php
              list($attack1, $attack2) = explode(',', $allattacks);

              $at1title = "SELECT * FROM `compendium` WHERE `itemType` LIKE '%weapon%' AND title LIKE '$attack1'";
              $at1data = mysqli_query($dbcon, $at1title) or die('error getting data');
              while($at1 =  mysqli_fetch_array($at1data, MYSQLI_ASSOC)) {
                echo ('<option value="'.$at1['title'].'['.$at1['itemRange'].']'.$at1['itemDmg1'].'{'.$at1['itemProperty'].'">'.$at1['title']);
              }


              echo ('<option value="null">');
              $at1title = "SELECT * FROM `compendium` WHERE `itemType` LIKE '%weapon%' AND itemMagic NOT LIKE '1'";
              $at1data = mysqli_query($dbcon, $at1title) or die('error getting data');
              while($at1 =  mysqli_fetch_array($at1data, MYSQLI_ASSOC)) {
                //$bgNameNoBG = str_replace('(background)', '', $row1['title']);
                //$bgNameClean = preg_replace('/[^a-z\d]+/i', '', $bgNameNoBG);
                  echo ('<option value="'.$at1['title'].'['.$at1['itemRange'].']'.$at1['itemDmg1'].'{'.$at1['itemProperty'].'">'.$at1['title']);
                }
                ?>
        </select></td>
          <td class="narrowCell"><input class="statScore lightBox" id="at1Range" value="<?php echo $row['str']; ?>"></input></td>
        </tr>
        <tr>
        <td><div class="attackLabel" onclick="attackRoll('1')">Attack</div></td>
        <td><div class="attackLabel">Range</div></td>
        </tr>
        <tr>
        <td><input class="statScore lightBox" id="at1Damage" value="<?php echo $row['str']; ?>"></input>
        </td>
        <td><input class="statScore lightBox" id="at1ToHit" value="<?php echo $row['str']; ?>"></input></td>
        </tr>
        <tr>
        <td><div class="attackLabel">Damage</div></td>
        <td><div class="attackLabel">To Hit</div></td>
        </tr>

        </table>
        <table class="attackTable">

        <tr>
        <td class="wideCell"><select class="charClassSelect attackDrop sheetDrop selector" name="attack2Select" id="attack2Select" onchange="attack(2)">
        <?php
        $at2title = "SELECT * FROM `compendium` WHERE `itemType` LIKE '%weapon%' AND title LIKE '$attack2'";
        $at2data = mysqli_query($dbcon, $at2title) or die('error getting data');
        while($at2 =  mysqli_fetch_array($at2data, MYSQLI_ASSOC)) {
          echo ('<option value="'.$at2['title'].'['.$at2['itemRange'].']'.$at2['itemDmg1'].'{'.$at2['itemProperty'].'">'.$at2['title']);
        }


        echo ('<option value="null">');
        $at2title = "SELECT * FROM `compendium` WHERE `itemType` LIKE '%weapon%' AND itemMagic NOT LIKE '1'";
        $at2data = mysqli_query($dbcon, $at2title) or die('error getting data');
        while($at2 =  mysqli_fetch_array($at2data, MYSQLI_ASSOC)) {
          //$bgNameNoBG = str_replace('(background)', '', $row2['title']);
          //$bgNameClean = preg_replace('/[^a-z\d]+/i', '', $bgNameNoBG);
          echo ('<option value="'.$at2['title'].'['.$at2['itemRange'].']'.$at2['itemDmg1'].'{'.$at2['itemProperty'].'">'.$at2['title']);
          }
          ?>
        </select></td>
        <td class="narrowCell"><input class="statScore lightBox" id="at2Range" value="<?php echo $row['str']; ?>"></input></td>
        </tr>
        <tr>
        <td><div class="attackLabel" onclick="attackRoll('2')">Attack</div></td>
        <td><div class="attackLabel">Range</div></td>
        </tr>
        <tr>
        <td><input class="statScore lightBox" id="at2Damage" value="<?php echo $row['str']; ?>"></input>
        </td>
        <td><input class="statScore lightBox" id="at2ToHit" value="<?php echo $row['str']; ?>"></input></td>
        </tr>
        <tr>
        <td><div class="attackLabel">Damage</div></td>
        <td><div class="attackLabel">To Hit</div></td>
        </tr>
        </table>

        <table class="attackTable">
        <tr>
        <td class="wideCell"><input class="statScore lightBox" name="attack3Select" id="attack3Select"></td>
        <td class="narrowCell"><input class="statScore lightBox" id="at3Range" value=""></input></td>
        </tr>
        <tr>
        <td><div class="attackLabel" onclick="attackRoll('3')">Attack</div></td>
        <td><div class="attackLabel">Range</div></td>
        </tr>
        <tr>
        <td><input class="statScore lightBox" id="at3Damage" value=""></input>
        </td>
        <td><input class="statScore lightBox" id="at3ToHit" value=""></input></td>
        </tr>
        <tr>
        <td><div class="attackLabel">Damage</div></td>
        <td><div class="attackLabel">To Hit</div></td>
        </tr>
        </table>

        <table class="attackTable">
        <tr>
        <td class="wideCell"><input class="statScore lightBox" name="attack4Select" id="attack4Select"></td>
        <td class="narrowCell"><input class="statScore lightBox" id="at4Range" value=""></input></td>
        </tr>
        <tr>
        <td><div class="attackLabel" onclick="attackRoll('4')">Attack</div></td>
        <td><div class="attackLabel">Range</div></td>
        </tr>
        <tr>
        <td><input class="statScore lightBox" id="at4Damage" value=""></input>
        </td>
        <td><input class="statScore lightBox" id="at4ToHit" value=""></input></td>
        </tr>
        <tr>
        <td><div class="attackLabel">Damage</div></td>
        <td><div class="attackLabel">To Hit</div></td>
        </tr>
        </table>


        <div class="hide" id="attack1">null</div>
        <div class="hide" id="attack2">null</div>
        <div class="hide" id="attack3">null</div>
          </div>

        </div>



        <div class="roundBorder col-md-4 col-sm-6 col-xs-12 sidebartext sheetBlock" name="mainBlock" id="spellsBlock" style="margin-top:10px;" style="float:left;">
          <div style="margin-bottom: 5px; border-bottom:1px solid white;">Spells</div>
          <div style="display:none; float:left;" id="spellWarning">Please save changes to your class/subclass before adding spells.</div>


          <?php
          $coreclass = substr($fullclass, 0, strpos($fullclass, "(") -1);
          $coreTemp = $coreclass.' core';
          $ucClass = ucwords($coreclass);
          $subclass = trim($subclasstemp, ')');

          echo ('<div class="hide" id="currentSpells">'.$allspells.'</div>');

            ?>
        <div id="spellsShow">

            <table id="spells" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">
                          <?php
                          if ($ucClass == 'Mystic') {
                            echo ('Ability');
                          }
                          else {
                            echo ('Spell');
                          }
                          ?>
                        </th>
                        <th scope="col">
                          <?php
                          if ($ucClass == 'Mystic') {
                            echo ('Type');
                          }
                          else {
                            echo ('Level');
                          }
                          ?>

                        </th>

                    </tr>
                </thead>
                <tbody>
            <?php
        // SPELLS Section

            $spelltitle = "SELECT * FROM `compendium` WHERE `spellClasses` LIKE '%$ucClass%' OR `spellClasses` LIKE '%$subclass%' ORDER BY spellLevel, title";
            $spelldata = mysqli_query($dbcon, $spelltitle) or die('error getting data');
            while($spellrow =  mysqli_fetch_array($spelldata, MYSQLI_ASSOC)) {
              ?>

              <?php
                  //$featuretitle = str_replace('text', 'name', $column);
                $spelltitlens = str_replace(' ', '', $spellrow['title']);
                $spelltitlens = preg_replace('/[^a-z\d]+/i', '_', $spelltitlens);
                  echo ('<tr><td><input type="checkbox" id="'.$spelltitlens.'Box" onclick="spellList(\''.$spellrow['title'].'\')"></input></td>');
                  echo ('<td><a class="featureName" data-toggle="collapse" href="#'.$spelltitlens.'show">'.$spellrow['title'].'</a></td>');

                  if ($ucClass == 'Mystic') {
                    echo ('<td>'.ucwords($spellrow['spellSchool']).'</td></tr>');

                  }
                  else {
                  echo ('<td>'.$spellrow['spellLevel'].'</td></tr>');
                }
                  echo ('<tr></tr>');
                  echo ('<tr><td colspan="3"><div class="featureDetails collapse" id="'.$spelltitlens.'show" name="'.$spelltitlens.'show">');
                  echo ('Casting Time: '.$spellrow['spellTime']);
                  echo ('<br />Duration: '.$spellrow['spellDuration']);
                  echo ('<br />Range: '.$spellrow['spellRange']);
                  echo ('<br />Components: '.$spellrow['spellComponents']);
                  echo ('<br />'.nl2br($spellrow['text']).'</div></tr>');

              }

        ?>
        </tbody>
        </table>

        <table id="mySpells" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
        <thead class="thead-dark">
            <tr>
              <th scope="col">
                <?php
                if ($ucClass == 'Mystic') {
                  echo ('Ability');
                }
                else {
                  echo ('Spell');
                }
                ?>
              </th>
              <th scope="col">
                <?php
                if ($ucClass == 'Mystic') {
                  echo ('Type');
                }
                else {
                  echo ('Level');
                }
                ?>

              </th>

            </tr>
        </thead>
        <tbody>
        <?php
        // SPELLS Section

        $spelltitle = "SELECT * FROM `compendium` WHERE `spellClasses` LIKE '%$ucClass%' OR `spellClasses` LIKE '%$subclass%' ORDER BY spellLevel, title";
        $spelldata = mysqli_query($dbcon, $spelltitle) or die('error getting data');
        while($spellrow =  mysqli_fetch_array($spelldata, MYSQLI_ASSOC)) {
        ?>

        <?php
          //$featuretitle = str_replace('text', 'name', $column);
        $spelltitlens = str_replace(' ', '', $spellrow['title']);
        $spelltitlens = preg_replace('/[^a-z\d]+/i', '_', $spelltitlens);
        if (strpos($allspells, ','.$spellrow['title'].',') !== false) {
          echo ('<tr>');
          echo ('<td><a class="featureName" data-toggle="collapse" href="#'.$spelltitlens.'myshow">'.$spellrow['title'].'</a></td>');
          if ($ucClass == 'Mystic') {
            echo ('<td>'.ucwords($spellrow['spellSchool']).'</td></tr>');

          }
          else {
          echo ('<td>'.$spellrow['spellLevel'].'</td></tr>');
        }          echo ('<tr></tr>');
          echo ('<tr><td colspan="2"><div class="featureDetails collapse" id="'.$spelltitlens.'myshow" name="'.$spelltitlens.'show">');
          echo ('Casting Time: '.$spellrow['spellTime']);
          echo ('<br />Duration: '.$spellrow['spellDuration']);
          echo ('<br />Range: '.$spellrow['spellRange']);
          echo ('<br />Components: '.$spellrow['spellComponents']);
          echo ('<br />'.nl2br($spellrow['text']).'</div></tr>');
        }
        }

        ?>
        </tbody>
        </table>

        </div>
        </div>




<div class="roundBorder col-md-4 col-sm-6 col-xs-12 sidebartext sheetBlock" name="mainBlock" id="notesBlock" style="margin-top:10px;" style="float:left;">
  <div style="margin-bottom: 5px; border-bottom:1px solid white;">Notes</div>
    <textarea type="text" class="notestext" id="charNotes" value="<?php echo $charNotes; ?>"><?php echo $charNotes; ?></textarea>

</div>

        <script type="text/javascript">
				$('#itemSearch').selectize({
				onChange: function(value){
          if (value !== ""){
          var currentItems = $('#currentItemsRaw').html();
          var currentItemsClean = $('#currentItemsClean').html();
          var newItemsArray = '';
          if (currentItems !== '' && currentItems.includes('_') == false){
          newItemsArray = currentItems + '_' + value;
          cleaItemsArray = currentItems + ', ' + value;
        }
          else if (currentItems == ''){
            newItemsArray = value;
            cleanItemsArray = value;
          }
          else {
            newItemsArray = currentItems + '_' + value;
            cleanItemsArray = currentItems + '_' + value;
          }
          document.getElementById('currentItemsRaw').innerHTML = newItemsArray;
          document.getElementById('currentItemsClean').innerHTML = cleanItemsArray;
          }
				},
				create: false,
				openOnFocus: false,
				maxOpions: 4,
				sortField: 'text',
				placeholder: 'search...'
				},);


        $(document).ready(function() {
            // DataTable
            var table = $('#spells').DataTable(
              {
                "paging": false,
                "order": [[ 2, "asc" ]],
                "searching": false
              }
            );

        } );
        $(document).ready(function() {

            // DataTable
            var table = $('#mySpells').DataTable(
              {
                "paging": false,
                "order": [[ 1, "asc" ]],
                "searching": false
              }
            );

        } );

        function spellList(value) {
          var spellList = document.getElementById('currentSpells').innerHTML;
          var valueNS = value.replace(' ', '');
          var spellBoxID = valueNS + 'Box';
          if (document.getElementById(spellBoxID).checked) {
            spellList = spellList + value + ',';
        }
        else {
          if (spellList.includes(value + ',') == true){
        /*   if (spellList.startsWith(value)){
             if (spellList.includes(value + ',')) {*/
             spellList = spellList.replace(value + ',', '');
             }
             /*else {
              spellList = spellList.replace(value , '');
            }*/
          }
            //else {
              //spellList = spellList.replace(',' + value, '');
            //}

          //}

       if (spellList.startsWith(',') == false){
          spellList = ',' + spellList;
        }
        if (spellList.endsWith(',') == false){
          spellList = spellList + ',';
        }

        document.getElementById('currentSpells').innerHTML = spellList;
      };
        </script>


<!-- FILL ATTACK FIELDS -->
<script>
  function attack(value) {
      var selectName = "attack" + value + "Select";
      var damageName = "at" + value + "Damage";
      var rangeName = "at" + value + "Range";
      var toHitName = "at" + value + "ToHit";
      var damageValTemp = "at" + value + "DamageVal";
      var mainString = document.getElementById(selectName).value;
      if (mainString == "null") {
        document.getElementById(damageName).value = "";
        document.getElementById(rangeName).value = "";
        document.getElementById(toHitName).value = "";
        document.getElementById(attack + "value").innerHTML = "null";
      }
      else {
      var attackName = mainString.substr(0, mainString.indexOf('['));
      document.getElementById('attack' + value).innerHTML = attackName;
      var attackRange = mainString.match(/\[(.*)\]/).pop();
      var attackDamage = mainString.match(/\](.*)\{/).pop();
      var attackType = mainString.split('{')[1];
      var profBonus = <?php echo $profbonus; ?>;
      var toHitDex = <?php echo $dexmod; ?>;
      var toHitStr = <?php echo $strmod; ?>;
      var toHit = profBonus;
      if (attackType.includes("F") == true) {
          if (toHitStr >= toHitDex) {
            toHit = profBonus + toHitStr;
          }
          else {
            toHit = profBonus + toHitStr;
          }
        }
        else if (attackType.includes("T") == true) {
          toHit = profBonus + toHitStr;
        }
        else if (attackType.includes("T") == false && attackRange !== '') {
            toHit = profBonus + toHitDex;
        }
        else {
          toHit = profBonus + toHitStr;
        }

      finalDamage = toHit - profBonus;
      attackDamage = attackDamage + " + " + finalDamage;
      var toHitVal = "+" + toHit;
      document.getElementById(damageName).value = attackDamage;
      document.getElementById(rangeName).value = attackRange;
      document.getElementById(toHitName).value = toHitVal;
    }
  }

  $(document).ready(function() {
        var allCustomAttacks = '<?php echo $customattacks; ?>';
        var attackArray = allCustomAttacks.split('_');
       document.getElementById('attack3Select').value = attackArray[0];
        document.getElementById('at3Range').value = attackArray[1];
        document.getElementById('at3Damage').value = attackArray[2];
        document.getElementById('at3ToHit').value = attackArray[3];
        document.getElementById('attack4Select').value = attackArray[4];
        document.getElementById('at4Range').value = attackArray[5];
        document.getElementById('at4Damage').value = attackArray[6];
        document.getElementById('at4ToHit').value = attackArray[7];
  });

  $(document).ready(function() {
    attack("1");
    attack("2");
    customAttack();
  });

</script>
<?php
//CHECK EXISTING PROFICIENCIES
if (strpos($checksaves, 'Strength') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#strSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checksaves, 'Dexterity') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#dexSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checksaves, 'Constitution') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#conSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checksaves, 'Intelligence') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#intelSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checksaves, 'Wisdom') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#wisSaveProf').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checksaves, 'Charisma') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#chaSaveProf').prop('checked', true);

  });

  </script>
<?php
}

  if (strpos($checkprofs, 'Athletics') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#athleticsProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Acrobatics') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#acrobaticsProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Sleight of Hand') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#sleightProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Stealth') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#stealthProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Arcana') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#arcanaProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'History') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#historyProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Investigation') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#investigationProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Nature') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#natureProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Religion') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#religionProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Animal Handling') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#animalProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Insight') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#insightProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Medicine') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#medicineProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Perception') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#perceptionProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Survival') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#survivalProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Deception') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#deceptionProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Intimidation') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#intimidationProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Persuasion') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#persuasionProf').prop('checked', true);

    });

    </script>
  <?php
  }
  if (strpos($checkprofs, 'Performance') !== false) {
    ?><script>
    $(document).ready(function() {
      $('#performanceProf').prop('checked', true);

    });

    </script>
  <?php
  }



//EXPERTISE CHECKBOXES
if (strpos($checkexperts, 'Athletics') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#athleticsExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Acrobatics') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#acrobaticsExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Sleight of Hand') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#sleightExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Stealth') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#stealthExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Arcana') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#arcanaExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'History') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#historyExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Investigation') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#investigationExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Nature') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#natureExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Religion') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#religionExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Animal Handling') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#animalExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Insight') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#insightExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Medicine') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#medicineExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Perception') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#perceptionExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Survival') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#survivalExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Deception') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#deceptionExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Intimidation') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#intimidationExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Persuasion') !== false) {
  ?><script>
  $(document).ready(function() {
    $('#persuasionExpert').prop('checked', true);

  });

  </script>
<?php
}
if (strpos($checkexperts, 'Performance') !== false) {
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

function attackRoll(value) {
  var cleanModifier = document.getElementById('at' + value + 'ToHit').value;
  var modifier = parseInt(cleanModifier.replace('+', ''), 10);
  var roll = Math.floor(Math.random() * 20) + 1;
  var result = roll + modifier;
  //var typeID = value.replace('Val', '');
  var typeName = document.getElementById('attack' + value + 'Select').value;
  typeName = typeName.substr(0, typeName.indexOf('['));
  document.getElementById('rollResult').innerHTML = result;
  document.getElementById('rollFormula').innerHTML = roll + ' + (' + modifier + ')';

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

function showBlock(value) {
  var selectedBlock = value;
  var allBlocks = document.getElementsByName('mainBlock');
  if (value == 'all'){
    for (var i = 0; i < allBlocks.length; i++) {
      allBlocks[i].style = "display:block";
    }
  }
  else {
    for (var i = 0; i < allBlocks.length; i++) {
      allBlocks[i].style = "display:none";
    }
    document.getElementById(value).style = "display:block";
  }
};



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
 var charLevel = $('#charLevel').val();
 var charRace = $('#charRace').val();
 var charBackground = $('#charBackground').val();
 var charAlignment = $('#charAlignment').val();
 var attack1 = $('#attack1').html();
 var attack2 = $('#attack2').html();
 var charAttacks = "";
  if (attack1 !== "null") {
    charAttacks = charAttacks + attack1;
    if (attack2 !== "null") {
      charAttacks = charAttacks + "," + attack2;
    }
  }

 var at3Select = $('#attack3Select').val();
 var at3Range = $('#at3Range').val();
 var at3Damage = $('#at3Damage').val();
 var at3ToHit = $('#at3ToHit').val();
 var at4Select = $('#attack4Select').val();
 var at4Range = $('#at4Range').val();
 var at4Damage = $('#at4Damage').val();
 var at4ToHit = $('#at4ToHit').val();
 var at3Array = [at3Select, at3Range, at3Damage, at3ToHit];
 var at4Array = [at4Select, at4Range, at4Damage, at4ToHit];
 at3Array = at3Array.join('_');
 at4Array = at4Array.join('_');
 var customAttacks = at3Array + '_' + at4Array;

 var charClassTemp = $('#charClass').val();
 var charClassLower = charClassTemp.toLowerCase();
 var charClassNs = charClassLower.replace(/ +/g, "");
 var charSubTemp = "#" + charClassNs + "SubList";
 var charSubClass = $(charSubTemp).val();
 var charClass = charClassLower + " (" + charSubClass + ")";
 var charSpells = $('#currentSpells').html();
 var charNotes = $('#charNotes').val();
 var charItems = $('#currentItemsRaw').html();


 if (hitdice.indexOf('d') > -1) {
  hitdice = hitdice.replace('d', '');
}

 //make the postdata
 //call your input.php script in the background, when it returns it will call the success function if the request was successful or the error one if there was an issue (like a 404, 500 or any other error status)

 $.ajax({
    url : 'charprocess.php',
    type: 'GET',
    data : { "charID" : charID, "proficiencies" : newProf, "title" : charName, "saves" : newSaves, "expertise" : newExpert, "strength" : strScore, "dexterity" : dexScore, "constitution" : conScore, "intelligence" : intelScore, "wisdom" : wisScore, "charisma" : chaScore, "initiative" : initiative, "maxhp" : maxhp, "hitdice" : hitdice, "speed" : speed, "armorclass" : armorclass, "charClass" : charClass,
    "charRace" : charRace, "charLevel" : charLevel, "charBackground" : charBackground, "charAlignment" : charAlignment, "attacks" : charAttacks, "spells" : charSpells, "customAttacks" : customAttacks, "charNotes" : charNotes, "charItems" : charItems },
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
