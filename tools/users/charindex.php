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
          ?>
          <div class="char-left-col col-sm-6 col-xs-12">

            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="strBox">
              <div class="statScore" id="strScore">14</div>
              <div class="statMod" id="strMod">+2</div>
              <div class="statName" id="strName">Strength</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf">Saving Throw</div>
            <div class="statProf">Athletics</div>
          </div>
        </div>
            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="dexBox">
              <div class="statScore" id="dexScore">14</div>
              <div class="statMod" id="dexMod">+2</div>
              <div class="statName" id="dexName">Dexterity</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf">Saving Throw</div>
            <div class="statProf">Acrobatics</div>
            <div class="statProf">Sleight of Hand</div>
            <div class="statProf">Stealth</div>

          </div>
          </div>
            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="conBox">
              <div class="statScore" id="conScore">14</div>
              <div class="statMod" id="conMod">+2</div>
              <div class="statName" id="conName">Constitution</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf">Saving Throw</div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="intBox">
              <div class="statScore" id="intScore">14</div>
              <div class="statMod" id="intMod">+2</div>
              <div class="statName" id="intName">Intelligence</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf">Saving Throw</div>
            <div class="statProf">Arcana</div>
            <div class="statProf">History</div>
            <div class="statProf">Investigation</div>
            <div class="statProf">Nature</div>
            <div class="statProf">Religion</div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="wisBox">
              <div class="statScore" id="wisScore">14</div>
              <div class="statMod" id="wisMod">+2</div>
              <div class="statName" id="wisName">Wisdom</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf">Saving Throw</div>
            <div class="statProf">Animal Handling</div>
            <div class="statProf">Insight</div>
            <div class="statProf">Medicine</div>
            <div class="statProf">Perception</div>
            <div class="statProf">Survival</div>
          </div>
        </div>

            <div class="row fullStatBox">
            <div class="statBox col-xs-4" id="chaBox">
              <div class="statScore" id="chaScore">14</div>
              <div class="statMod" id="chaMod">+2</div>
              <div class="statName" id="chaName">Charisma</div>
            </div>

          <div class="statProfs col-xs-8">
            <div class="statProf">Saving Throw</div>
            <div class="statProf">Deception</div>
            <div class="statProf">Intimidation</div>
            <div class="statProf">Performance</div>
            <div class="statProf">Persuasion</div>
          </div>
        </div>
        </div>
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
