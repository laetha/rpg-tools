<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/style.css" />
		<link rel="stylesheet" type="text/css" href="/selectize/css/selectize.default.css" />

			<!-- This code is to prevent FOUC -->
			<script type="text/javascript">
		    $('html').addClass('hidden');
		    $(window).on('load', function () {
		    $('html').removeClass('hidden');
		     });
		   </script>

		<title><?php echo $pgtitle; ?>RPG Tools</title>
	</head>
	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/jquery-1.8.3.js" tpye="text/javascript"></script>-->
		<script src="/selectize/js/standalone/selectize.min.js" tpye="text/javascript"></script>
		<script src="/selectize/js/list.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js" tpye="text/javascript"></script>-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" tpye="text/javascript"></script>
		<script src="/plugins/jquery.zeninput.js" tpye="text/javascript"></script>

		<?php
		//SQL Connect
		 $sqlpath = $_SERVER['DOCUMENT_ROOT'];
		 $sqlpath .= "/sql-connect.php";
		 include_once($sqlpath);
		 ?>
		 <nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/index.php">GameRipple D&D Tools</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
				<li class="topsearch">
					<select id="search">
					<option value=""></option>
					<?php
					$searchdrop = "SELECT title FROM world";
					$searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
					while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
						$search = $searchrow['title'];
						$searchvalue = $search.'1';
						echo "<option value=\"$searchvalue\">$search</option>";
					}
					?>
					<?php
					$searchdrop1 = "SELECT title FROM compendium";
					$searchdata1 = mysqli_query($dbcon, $searchdrop1) or die('error getting data');
					while($searchrow1 =  mysqli_fetch_array($searchdata1, MYSQLI_ASSOC)) {
						$search1 = $searchrow1['title'];
						$searchvalue1 = $search1.'2';
						echo "<option value=\"$searchvalue1\">$search1</option>";
					}
					?>
					</select>
				</li>
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">World Building<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="/tools/world/settlement.php">Settlements</a></li>
					<li><a href="/tools/world/npc.php">NPCs</a></li>
					<li><a href="/tools/world/faction.php">Factions</a></li>
					<li><a href="/tools/world/deity.php">Deities</a></li>
					<li><a href="/tools/world/quest.php">Quests</a></li>
					<li><a href="/tools/world/establishment.php">Establishments</a></li>
					<li><a href="/tools/world/publicquest.php">Public Quests</a></li>
				</ul>
				<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Compenium <span class="caret"></span></a>
          <ul class="dropdown-menu">
						<li><a href="/tools/compendium/background.php">Backgrounds</a></li>
						<li><a href="/tools/compendium/class.php">Classes</a></li>
						<li><a href="/tools/compendium/feat.php">Feats</a></li>
						<li><a href="/tools/compendium/item.php">Items</a></li>
						<li><a href="/tools/compendium/monster.php">Monsters</a></li>
						<li><a href="/tools/compendium/race.php">Races</a></li>
						<li><a href="/tools/compendium/spell.php">Spells</a></li>
					</ul>
				<li><a href="/tools/campaign-log/campaign-log.php">Campaign Log</a></li>
				<li><a href="/tools/initiative/initiative.php">Initiative</a></li>
				<li><a href="/tools/world/map.php">World Map</a></li>
				<li><a href="/tools/Generator/generator.php">Generator</a></li>
				<li><a href="/tools/questboard/questboard.php">Quest Board</a></li>

      </ul>

    </div><!-- /.navbar-collapse -->

				<!--<div class="col-md-2"><a href="/tools/world/import.php">Import</a></div>
				<div class="col-md-2"><a href="/login.php">Signup/Login</a></div>-->
					<!--<form method="post" id="searchdiv" action="/tools/world/world.php">-->

				<!--</form>-->

				<script type="text/javascript">
				$('#search').selectize({
				onChange: function(value){
					if(value.slice(-1) == 1) {
					window.location.href = '/tools/world/world.php?id=' + value.slice(0, -1);
				}
				else {
					window.location.href = '/tools/compendium/compendium.php?id=' + value.slice(0, -1);
				}
				},
				create: false,
				openOnFocus: false,
				maxOpions: 4,
				sortField: 'text',
				placeholder: 'search...'
				},);
				</script>
			</div><!-- /.container-fluid -->
		</nav>
		<div class="container-fluid">
