<?php
$pgtitle = '';
 include('header.php');
 ?>

<div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">
				<h1 class="pagetitle">Brian's RPG Tools</h1>
				<div class="menu">
          <h3 style="color:LightSteelBlue;">Players</h3>

					<a class="menulink" href="/tools/compendium/compendium.php"><div class="menuitem">
						<img class ="menu-icon" src="/assets/images/log.png" />
						<h3>Compendium</h3>
					</div></a>

          <a class="menulink" href="/tools/resources/toc.php"><div class="menuitem">
            <img class ="menu-icon" src="/assets/images/resources.png" />
            <h3>Resources</h3>
          </div></a>
          <a class="menulink" href="/tools/questboard/questboard.php"><div class="menuitem">
            <img class ="menu-icon" src="/assets/images/quests.png" />
            <h3>Quest Board</h3>
          </div></a>
        </div>
					<div class="menu">
            <h3 style="color:LightSteelBlue;">DM</h3>
						<a class="menulink" href="/tools/initiative/initiative.php"><div class="menuitem">
							<img class ="menu-icon" src="/assets/images/initiative.png" />
							<h3>Initiative Tracker</h3>
						</div></a>
            <a class="menulink" href="/tools/campaign-log/campaign-log.php"><div class="menuitem">
              <img class ="menu-icon" src="/assets/images/parchment.png" />
              <h3>Campaign Log</h3>
            </div></a>
            <a class="menulink" href="/tools/world/world.php"><div class="menuitem">
              <img class ="menu-icon" src="/assets/images/world.png" />
              <h3>World Building</h3>
            </div></a>
				</div>
			</div>
<?php include('footer.php'); ?>
