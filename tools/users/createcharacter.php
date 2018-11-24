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
          <div class="col-xs-12"><select class="charSubclassSelect sheetDrop" name="charSubClassAdd" id="charClassAdd"  onchange="showSubclassDetails()">
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
        <?php
        $subclasstitle = "SELECT * FROM `subclasses` WHERE `name` NOT LIKE '%core%'";
        $subclassdata = mysqli_query($dbcon, $subclasstitle) or die('error getting data');
        while($subrow =  mysqli_fetch_array($subclassdata, MYSQLI_ASSOC)) {
          $namens = str_replace(' ', '', $subrow['name']);
          ?>
          <div class="col-xs-12"><div class="hide" id="<?php echo $namens; ?>">
            <?php
            foreach($subrow as $column=>$field) {
              if (strpos($field, ' 1st level') !== false) {
                $featuretitle = str_replace('text', 'name', $column);
                $featuretitlens = str_replace(' ', '', $subrow[$featuretitle]);
                $featuretitlens = preg_replace('/[^a-z\d]+/i', '_', $featuretitlens);

                echo ('<a class="featureName" data-toggle="collapse" href="#'.$featuretitlens.'show">'.$subrow[$featuretitle].'</a><br />');
                echo ('<div class="featureDetails collapse" id="'.$featuretitlens.'show" name="'.$featuretitlens.'show">'.nl2br($field).'</div>');
              }
            }
            ?>

          </div></div>
        <?php } ?>
          <div class="col-centered"><button class="btn btn-info" class="nextButton" onclick="addSubclass()">Next</button></div>
      </div>


        </div>
      </div>
    </div>
  </div>


<div class="sidebartext" id="charName"></div>
<div class="sidebartext" id="charRace"></div>
<div class="sidebartext" id="charClass"></div>
<div class="sidebartext" id="charSubclass"></div>


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


function showRaceDetails(){
  var selectedRace = document.getElementById('charRaceAdd').value;
  var raceFrame = document.getElementById('raceDetails');
  raceFrame.addEventListener("load", function() {
  this.contentWindow.document.getElementById('nonav').style = "display:none";
  this.contentWindow.document.getElementById('body').style = "background:none";
});
  raceFrame.src= "/tools/compendium/compendium.php?id=" + selectedRace;
};

function showClassDetails(){
  var selectedClass = document.getElementById('charClassAdd').value;
  var classFrame = document.getElementById('classDetails');
  classFrame.addEventListener("load", function() {
  this.contentWindow.document.getElementById('nonav').style = "display:none";
  this.contentWindow.document.getElementById('body').style = "background:none";
});
  classFrame.src= "/tools/compendium/compendium.php?id=" + selectedClass;
};

function showSubclassDetails(){
  var selectedSubclass = document.getElementById('charSubclassAdd').value;
  var subclassNS = selectedSubclass.replace(' ', '');
  document.getElementById(subclassNS).style = "display:block";
  //var subclassFrame = document.getElementById('subclassDetails');
  //subclassFrame.addEventListener("load", function() {
  //this.contentWindow.document.getElementById('nonav').style = "display:none";
  //this.contentWindow.document.getElementById('body').style = "background:none";
};
  //subclassFrame.src= "/tools/compendium/compendium.php?id=" + selectedClass;
</script>

         <?php

         //Footer
         $footpath = $_SERVER['DOCUMENT_ROOT'];
         $footpath .= "/footer.php";
         include_once($footpath);
         ?>
