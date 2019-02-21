<?php
/**
 * TeamMix
 * Copyright (C) 2017  rusty.info
 *
 * Git: https://gitlab.com/rustyinfo/tools-homepage
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Florian Steltenkamp <contact@rusty.info>
 */
require "../../init.php";
$toolname = "TeamMix";
$toolshort = strtolower($toolname);
$toolDescShort = "";
?>
<html>
<?php include $templatedir."head/head.phtml"; ?>
    <body>
        <?php
            $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
            $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolshort."'>$toolname <span class='sr-only'>(current)</span></a></li>"
        ?>
        <?php $additionalNavItemsRight = ""; ?>
        <?php include $templatedir."navbar.phtml"; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <?php include $templatedir."toolnav.phtml"; ?>
                    <div class="card text-white bg-success" style="margin-top:15px;">
                        <div class="card-header collapsed" type="button" data-toggle="collapse" data-target="#infoCollapse" aria-expanded="false" aria-controls="infoCollapse">INFO ( Click me! )</div>
                        <div class="card-body collapse" id="infoCollapse">
                            <h3>TeamMixer</h3>
                            <p>
                                This Tools aims at Groups who have trouble forming Teams.<br/>
                                You can put in any number of Names and The Tool will form a Team for you.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="card text-white bg-dark">
                        <div class="card-header">TeamMix</div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <label for="players">Comma Separated List of your Players:</label>
                                <textarea name="players" class="form-control" rows="5"><?php if ($_POST and isset($_POST['players'])) echo $_POST['players']; else echo "This list has to be Comma Separated like this:\njohn doe,jane doe,max,peter,mali\n(You'll have to delete this text ;) )";?></textarea>
                                <label for="teams">Amount of Teams</label>
                                <input type="number" name="teams" class="form-control" <?php if ($_POST and isset($_POST['teams'])) echo 'value="'.$_POST['teams'].'"'; else echo 'value="2"';?>/>
                                <input type="submit" name="submit" class="btn btn-success form-control"/>
                            </form>
                        </div>
                    </div>
                    <?php if($_POST): ?>
                    <div class="card text-light bg-secondary" style="margin-top:15px;">
                        <div class="card-header">Your Teams:</div>
                        <div class="card-body">
                            <ul>
                                <?php
                                    $data = $_POST;
                                    $teamcount = $data['teams'];
                                    $players = explode(",", $data['players']);
                                    $playercount = count($players);
                                    if ($teamcount < 2) {
                                        echo "<div class=\"alert alert-warning\">Why would you want to Mix the players in one team?</div>";
                                    }
                                    $teams = array();
                                    for ($i = 1; $i <= $teamcount; $i++) {
                                        $teams[$i] = array();
                                    }
                                    $count = 0;
                                    while(count($players)) {    //as long as there are items in $players array do this
                                        for ($i = 1; $i <= count($teams); $i++) {   //as long as $i is lower or equal to number of teams do this
                                            $rand = rand(0, count($players)-1); //select a random number between 0 and count of players left
                                            $teams[$i][] = $players[$rand];     //put player with id $rand in the team $i
                                            unset($players[$rand]);             //remove assigned player
                                            $players = array_values($players);    //reindex players array
                                        }
                                        $count ++;
                                        if ($count > 30) break;
                                    }
                                    foreach ($teams as $nr => $team) {
                                        echo "<ul><b>Team $nr:</b>";
                                        foreach ($team as $player) {
                                            echo "<li>$player</li>";
                                        }
                                        echo "</ul><br/>";
                                    }
                                ?>
                            <ul>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
    </body>
</html>
