<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/style.css" />
		<link rel="stylesheet" type="text/css" href="/chosen/chosen.css" />
		<link rel="stylesheet" type="text/css" href="/selectize/css/selectize.default.css" />

			<!-- This code is to prevent FOUC -->
			<script type="text/javascript">
		    $('html').addClass('hidden');
		    $(window).on('load', function () {
		    $('html').removeClass('hidden');
		     });
		   </script>

		<title>RPG Tools</title>
	</head>
	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/jquery-1.8.3.js" tpye="text/javascript"></script>-->
		<script src="/selectize/js/standalone/selectize.min.js" tpye="text/javascript"></script>
		<script src="/selectize/js/list.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js" tpye="text/javascript"></script>-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" tpye="text/javascript"></script>
		<?php
		//SQL Connect
		 $sqlpath = $_SERVER['DOCUMENT_ROOT'];
		 $sqlpath .= "/sql-connect.php";
		 include_once($sqlpath);
		 ?>
		<div class="container-fluid">
<div class="row">
			<div class="header">
				<div class="col-md-2"></div>
				<div class="col-md-2"><a href="/index.php">Home</a></div>
				<div class="col-md-2"><a href="/tools/compendium/import.php">Import</a></div>
				<div class="col-md-2"><a href="/login.php">Signup/Login</a></div>
			</div>
				<div class="col-md-3">
					<!--<form method="post" id="searchdiv" action="/tools/compendium/compendium.php">-->
				<select id="search">
				<option value=""></option>
				<?php
				$searchdrop = "SELECT * FROM compendium";
				$searchdata = mysqli_query($dbcon, $searchdrop) or die('error getting data');
				while($searchrow =  mysqli_fetch_array($searchdata, MYSQLI_ASSOC)) {
					$search = $searchrow['title'];
					echo "<option value=\"$search\">$search</option>";
				}
				?>
				</select>
				<!--</form>-->

				<script type="text/javascript">
				$('#search').selectize({
				onChange: function(value){
					window.location.href = '/tools/compendium/compendium.php?id=' + value;
				},
				create: false,
				openOnFocus: false,
				maxOpions: 4,
				sortField: 'text',
				placeholder: 'search...'
				},);
				</script>
			</div>
		</div>
			</nav>
