<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Characters - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>
<script>
$(document).ready(function (){
  showCharModal();
}
);

function showCharModal() {
  $("#charModal").modal({backdrop: 'static', keyboard: false});
  showCharModal();
}

jQuery.fn.toggleOption = function( show ) {
    jQuery( this ).toggle( show );
    if( show ) {
        if( jQuery( this ).parent( 'span.toggleOption' ).length )
            jQuery( this ).unwrap( );
    } else {
        if( jQuery( this ).parent( 'span.toggleOption' ).length == 0 )
            jQuery( this ).wrap( '<span class="toggleOption" style="display: none;" />' );
    }
};
</script>

  <!-- Item Modal -->
  <div class="modal fade bd-example-modal-lg" id="charModal" role="dialog">
    <div class="modal-dialog" style="width: 80%; max-width:1200px;">

      <!-- Modal content-->
      <div class="modal-content modalstyle bodytext" style="height:100%;">
        <div class="modal-header" style="padding-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body createModal" id="charModalBody" style="height:100%; padding-top: 0px;">

          <div id="charNameShow">
                <div class="col-centered">Character Name</div>
                <input class="bigInput col-centered" id="charNameAdd" value="" placeholder="Character Name..."></input>
                <div class="col-centered"><button class="btn btn-info" class="nextButton" onclick="addName()">Next</button></div>
              </div>

              <div id="charRaceShow" style="display:none;">
                <div class="col-centered">Race</div>
                <div class="col-xs-12"><select class="charClassSelect sheetDrop" name="charRaceAdd" id="charRaceAdd"  onchange="showRaceDetails()">
                  <option value="">Select Race...
                  <?php
                  $racetitle = "SELECT title FROM `compendium` WHERE `type` LIKE 'race'";
                  $racedata = mysqli_query($dbcon, $racetitle) or die('error getting data');
                  while($row1 =  mysqli_fetch_array($racedata, MYSQLI_ASSOC)) {
                    $raceNameNoR = str_replace('(race)', '', $row1['title']);
                    $raceNameClean = preg_replace('/[^a-z\d]+/i', '', $raceNameNoR);
                      echo ('<option value="'.$raceNameNoR.'">'.$raceNameNoR);
                  }
                   ?>
                </select>
              </div>
                <div class="col-xs-12 iframe-container"><iframe class="charCreateFrame" frameBorder="0" id="raceDetails" seamless></iframe></div>
                <div class="col-centered"><button class="btn btn-info" class="nextButton" onclick="addRace()">Next</button></div>
              </div>


              <div id="charClassShow" style="display:none;">
                <div class="col-centered">Class</div>
                <div class="col-xs-12"><select class="charClassSelect sheetDrop" name="charClasseAdd" id="charClassAdd"  onchange="showClassDetails()">
                  <option value="">Select Class...
                  <?php
                  $racetitle = "SELECT name FROM `subclasses` WHERE `name` LIKE '%core%'";
                  $racedata = mysqli_query($dbcon, $racetitle) or die('error getting data');
                  while($row1 =  mysqli_fetch_array($racedata, MYSQLI_ASSOC)) {
                    $classNameClean = ucwords(substr($row1['name'], 0, strpos($row1['name'], " core")));
                    echo ('<option value="'.$classNameClean.'">'.$classNameClean);
                  }
                   ?>
                </select>
              </div>
                <div class="col-xs-12 iframe-container"><iframe class="charCreateFrame" frameBorder="0" id="classDetails" seamless></iframe></div>
                <div class="col-centered"><button class="btn btn-info" class="nextButton" onclick="addClass()">Next</button></div>
              </div>


              <div id="charSubclassShow" style="display:none;">
                <div class="col-centered">Subclass</div>
                <div class="col-xs-12"><select class="charSubclassSelect sheetDrop" name="charSubClassAdd" id="charSubclassAdd"  onchange="showSubclassDetails()">
                  <option value="">Select Subclass...
                  <?php
                  $racetitle = "SELECT name, class FROM `subclasses` WHERE `name` NOT LIKE '%core%'";
                  $racedata = mysqli_query($dbcon, $racetitle) or die('error getting data');
                  while($row1 =  mysqli_fetch_array($racedata, MYSQLI_ASSOC)) {
                    //$classNameClean = ucwords(substr($row1['name'], 0, strpos($row1['name'], " core")));
                    echo ('<option class="'.$row1['class'].'" style="display:none;" value="'.$row1['name'].'">'.$row1['name']);
                  }
                   ?>
                </select>
              </div>
                <div class="col-xs-12 iframe-container"><iframe class="charCreateFrame" frameBorder="0" id="subclassDetails" seamless></iframe></div>
                <div class="col-centered"><button class="btn btn-info" class="nextButton" onclick="addSubclass()">Next</button></div>
            </div>

            <div id="charBackgroundShow" style="display:none;">
              <div class="col-centered">Background</div>
              <div class="col-xs-12"><select class="charBackgroundSelect sheetDrop" name="charBackgroundAdd" id="charBackgroundAdd"  onchange="showBackgroundDetails()">
                <option value="">Select Background...
                <?php
                $racetitle = "SELECT title FROM `compendium` WHERE `type` LIKE 'background'";
                $racedata = mysqli_query($dbcon, $racetitle) or die('error getting data');
                while($row1 =  mysqli_fetch_array($racedata, MYSQLI_ASSOC)) {
                  echo ('<option value="'.$row1['title'].'">'.$row1['title']);
                }
                 ?>
              </select>
            </div>
              <div class="col-xs-12 iframe-container"><iframe class="charCreateFrame" frameBorder="0" id="backgroundDetails" seamless></iframe></div>
              <div class="col-centered"><button class="btn btn-info" class="nextButton" onclick="addBackground()">Next</button></div>
            </div>

      <div id="charStatsShow"  style="display:none;">
        <div class="col-centered">Stats</div>
        <div class="col-md-12">
          <div class="col-centered"><button class="btn btn-primary" style="margin-bottom: 8px;" onclick="rollStats()">Roll An Array For Me</button></div>
          <div class="col-sm-4 sidebartext">Stat 1
          <input class="statInput" name="stat1" id="stat1" value=""></input>
          <select class="classSelect" id="stat1drop">
            <option id="stat1null" value="null">
            <option id="stat1str" value="str" selected>STR
            <option id="stat1dex" value="dex">DEX
            <option id="stat1con" value="con">CON
            <option id="stat1intel" value="intel">INT
            <option id="stat1wis" value="wis">WIS
            <option id="stat1cha" value="cha">CHA
          </select>
          </div>
          <div class="col-sm-4 sidebartext">Stat 2
          <input class="statInput" name="stat2" id="stat2" value=""></input>
          <select class="classSelect" id="stat2drop">
            <option id="stat2null" value="null">
            <option id="stat2str" value="str">STR
            <option id="stat2dex" value="dex" selected>DEX
            <option id="stat2con" value="con">CON
            <option id="stat2intel" value="intel">INT
            <option id="stat2wis" value="wis">WIS
            <option id="stat2cha" value="cha">CHA
          </select>
          </div>
          <div class="col-sm-4 sidebartext">Stat 3
          <input class="statInput" name="stat3" id="stat3" value=""></input>
          <select class="classSelect" id="stat3drop">
            <option id="stat3null" value="null">
            <option id="stat3str" value="str">STR
            <option id="stat3dex" value="dex">DEX
            <option id="stat3con" value="con" selected>CON
            <option id="stat3intel" value="intel">INT
            <option id="stat3wis" value="wis">WIS
            <option id="stat3cha" value="cha">CHA
          </select>
          </div>
          <div class="col-sm-4 sidebartext">Stat 4
          <input class="statInput" name="stat4" id="stat4" value=""></input>
          <select class="classSelect" id="stat4drop">
            <option id="stat4null" value="null">
            <option id="stat4str" value="str">STR
            <option id="stat4dex" value="dex">DEX
            <option id="stat4con" value="con">CON
            <option id="stat4intel" value="intel" selected>INT
            <option id="stat4wis" value="wis">WIS
            <option id="stat4cha" value="cha">CHA
          </select>
          </div>
          <div class="col-sm-4 sidebartext">Stat 5
          <input class="statInput" name="stat5" id="stat5" value=""></input>
          <select class="classSelect" id="stat5drop">
            <option id="stat5null" value="null">
            <option id="stat5str" value="str">STR
            <option id="stat5dex" value="dex">DEX
            <option id="stat5con" value="con">CON
            <option id="stat5intel" value="intel">INT
            <option id="stat5wis" value="wis" selected>WIS
            <option id="stat5cha" value="cha">CHA
          </select>
          </div>
          <div class="col-sm-4 sidebartext">Stat 6
          <input class="statInput" name="stat6" id="stat6" value=""></input>
          <select class="classSelect" id="stat6drop">
            <option id="stat6null" value="null">
            <option id="stat6str" value="str">STR
            <option id="stat6dex" value="dex">DEX
            <option id="stat6con" value="con">CON
            <option id="stat6intel" value="intel">INT
            <option id="stat6wis" value="wis">WIS
            <option id="stat6cha" value="cha" selected>CHA
          </select>
          </div>
          <div style="color:red; display:none;" id="statError">ERROR: You must select each stat type once.</div>
      </div>
        <div class="col-centered"><button class="btn btn-info" class="nextButton" onclick="addStats()">Next</button></div>
      </div>

        </div>
      </div>
    </div>
  </div>

<div class="sidebartext" id="charName"></div>
<div class="sidebartext" id="charRace"></div>
<div class="sidebartext" id="charClass"></div>
<div class="sidebartext" id="charSubclass"></div>
<div class="sidebartext" id="charBackground"></div>
<div class="sidebartext" id="charstr">1</div>
<div class="sidebartext" id="chardex">1</div>
<div class="sidebartext" id="charcon">1</div>
<div class="sidebartext" id="charintel">1</div>
<div class="sidebartext" id="charwis">1</div>
<div class="sidebartext" id="charcha">1</div>
<div class="sidebartext" id="test"></div>
<script>
function addName() {
  var charName = document.getElementById('charNameAdd').value;
  document.getElementById('charName').innerHTML = charName;
  $('#charNameShow').fadeOut(500);
  $('#charRaceShow').delay(400).fadeIn(300);
};

function addRace() {
  var charRace = document.getElementById('charRaceAdd').value;
  document.getElementById('charRace').innerHTML = charRace;
  $('#charRaceShow').fadeOut(500);
  $('#charClassShow').delay(400).fadeIn(300);
};

function addClass() {
  var charClass = document.getElementById('charClassAdd').value;
  document.getElementById('charClass').innerHTML = charClass;
  jQuery('.' + charClass).toggleOption(true); // show option
  $('#charClassShow').fadeOut(500);
  $('#charSubclassShow').delay(400).fadeIn(300);
};

function addSubclass() {
  var charSubclass = document.getElementById('charSubclassAdd').value;
  document.getElementById('charSubclass').innerHTML = charSubclass;
  $('#charSubclassShow').fadeOut(500);
  $('#charBackgroundShow').delay(400).fadeIn(300);
};

function addBackground() {
  var charBackground = document.getElementById('charBackgroundAdd').value;
  document.getElementById('charBackground').innerHTML = charBackground;
  $('#charBackgroundShow').fadeOut(500);
  $('#charStatsShow').delay(400).fadeIn(300);
};

function addStats() {
  var charStat1 = $('#stat1').val();
  var charStat2 = $('#stat2').val();
  var charStat3 = $('#stat3').val();
  var charStat4 = $('#stat4').val();
  var charStat5 = $('#stat5').val();
  var charStat6 = $('#stat6').val();
  var charStat1Type = $('#stat1drop').val();
  var charStat2Type = $('#stat2drop').val();
  var charStat3Type = $('#stat3drop').val();
  var charStat4Type = $('#stat4drop').val();
  var charStat5Type = $('#stat5drop').val();
  var charStat6Type = $('#stat6drop').val();
  var a = [charStat1Type,charStat2Type,charStat3Type,charStat4Type,charStat5Type,charStat6Type];
  var countstr = 0;
  var countdex = 0;
  var countcon = 0;
  var countintel = 0;
  var countwis = 0;
  var countcha = 0;

for(var i = 0; i < a.length; ++i){
    if(a[i] == 'str')
        countstr++;
}
for(var i = 0; i < a.length; ++i){
    if(a[i] == 'str')
        countdex++;
}
for(var i = 0; i < a.length; ++i){
    if(a[i] == 'str')
        countcon++;
}
for(var i = 0; i < a.length; ++i){
    if(a[i] == 'str')
        countintel++;
}
for(var i = 0; i < a.length; ++i){
    if(a[i] == 'str')
        countwis++;
}
for(var i = 0; i < a.length; ++i){
    if(a[i] == 'str')
        countcha++;
}
  if (countstr != 1 || countdex != 1 || countcon != 1 || countintel != 1 || countwis != 1 || countcha != 1) {
      document.getElementById('statError').style = "display:block";
  }
  else {
    document.getElementById('char' + charStat1Type).innerHTML = charStat1;
    document.getElementById('char' + charStat2Type).innerHTML = charStat2;
    document.getElementById('char' + charStat3Type).innerHTML = charStat3;
    document.getElementById('char' + charStat4Type).innerHTML = charStat4;
    document.getElementById('char' + charStat5Type).innerHTML = charStat5;
    document.getElementById('char' + charStat6Type).innerHTML = charStat6;
    $('#charStatsShow').fadeOut(500);
    $('#charHpShow').delay(400).fadeIn(300);
  }
};

function rollStats(){
  const roller = new DiceRoller();
  var roll1temp = roller.roll('4d6-L');
  roll1string = roll1temp.toString();
  var roll1 = roll1string.split('= ')[1];
  document.getElementById('stat1').value = roll1;

  var roll2temp = roller.roll('4d6-L');
  roll2string = roll2temp.toString();
  var roll2 = roll2string.split('= ')[1];
  document.getElementById('stat2').value = roll2;

  var roll3temp = roller.roll('4d6-L');
  roll3string = roll3temp.toString();
  var roll3 = roll3string.split('= ')[1];
  document.getElementById('stat3').value = roll3;

  var roll4temp = roller.roll('4d6-L');
  roll4string = roll4temp.toString();
  var roll4 = roll4string.split('= ')[1];
  document.getElementById('stat4').value = roll4;

  var roll5temp = roller.roll('4d6-L');
  roll5string = roll5temp.toString();
  var roll5 = roll5string.split('= ')[1];
  document.getElementById('stat5').value = roll5;

  var roll6temp = roller.roll('4d6-L');
  roll6string = roll6temp.toString();
  var roll6 = roll6string.split('= ')[1];
  document.getElementById('stat6').value = roll6;

};

function showRaceDetails(){
  var selectedRace = document.getElementById('charRaceAdd').value;
  var raceFrame = document.getElementById('raceDetails');
  raceFrame.addEventListener("load", function() {
  this.contentWindow.document.getElementById('nonav').style = "display:none";
  this.contentWindow.document.getElementById('body').style = "background:none";
  var mainBox = this.contentWindow.document.getElementsByClassName('mainbox');
  mainBox[0].style = "background:none";
});
  raceFrame.src= "/tools/compendium/compendium.php?id=" + selectedRace;
};

function showClassDetails(){
  var selectedClass = document.getElementById('charClassAdd').value;
  var classFrame = document.getElementById('classDetails');
  classFrame.addEventListener("load", function() {
  this.contentWindow.document.getElementById('nonav').style = "display:none";
  this.contentWindow.document.getElementById('body').style = "background:none";
  var mainBox = this.contentWindow.document.getElementsByClassName('mainbox');
  mainBox[0].style = "background:none";
});
  classFrame.src= "/tools/compendium/compendium.php?id=" + selectedClass;
};

function showSubclassDetails(){
  var selectedSubclass = document.getElementById('charSubclassAdd').value;
  var subclassFrame = document.getElementById('subclassDetails');
  subclassFrame.addEventListener("load", function() {
  this.contentWindow.document.getElementById('nonav').style = "display:none";
  this.contentWindow.document.getElementById('body').style = "background:none";
});
  subclassFrame.src= "/tools/compendium/popout.php?id=" + selectedSubclass;
};

function showBackgroundDetails(){
  var selectedBackground = document.getElementById('charBackgroundAdd').value;
  var backgroundFrame = document.getElementById('backgroundDetails');
  backgroundFrame.addEventListener("load", function() {
  this.contentWindow.document.getElementById('nonav').style = "display:none";
  this.contentWindow.document.getElementById('body').style = "background:none";
  var mainBox = this.contentWindow.document.getElementsByClassName('mainbox');
  mainBox[0].style = "background:none";
});
  classFrame.src= "/tools/compendium/compendium.php?id=" + selectedBackground;
};

</script>

         <?php

         //Footer
         $footpath = $_SERVER['DOCUMENT_ROOT'];
         $footpath .= "/footer.php";
         include_once($footpath);
         ?>
