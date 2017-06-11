<?php
    /**
     * TeamShuffle
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
?>
<html>
    <head>
        <title>TeamShuffle - Rusty's Tools</title>
        <meta encoding="UTF-8"/>
        <meta title="StrRev - Rusty's Tools" description=""/>
        <link rel="stylesheet" href="https://tools.rusty.info/style/css/bootstrap.min.css" />
        <script src="https://tools.rusty.info/style/js/jquery-3.2.1.min.js"></script>
        <script src="https://tools.rusty.info/style/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="https://tools.rusty.info">Rusty's Tools</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="https://tools.rusty.info/tools/TeamShuffle">TeamShuffle <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container container-fluid">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading" href="#info-collapse" data-target="#info-collapse" data-toggle="collapse">Intro (click me for info)</div>
                    <div class="panel-body collapse" id="info-collapse">
                        <h3>TeamShuffle</h3>
                        <p>
                            This Tools aims at Groups who have trouble forming Teams.<br/>
                            You can put in any number of Names and The Tool will form a Team for you.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Define your Players:</div>
                    <div class="panel-body">
                        <form action="" method="POST">
                            <label for="players">Comma Separated List of your Players:</label>
                            <textarea name="players" class="form-control" rows="15"><?php if ($_POST and isset($_POST['players'])) echo $_POST['players']; else echo "This list has to be Comma Separated like this:\njohn doe,jane doe,max,peter,mali\n(You'll have to delete this text ;) )";?></textarea>
                            <label for="teams">Amount of Teams</label>
                            <input type="number" name="teams" class="form-control" <?php if ($_POST and isset($_POST['teams'])) echo 'value="'.$_POST['teams'].'"'; else echo 'value="2"';?>/>
                            <input type="submit" name="submit" class="btn btn-success form-control"/>
                        </form>
                    </div>
                </div>
            </div>
            <?php if ($_POST) : ?>
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">Your Teams:</div>
                    <table class="table table-striped table-hover table-condensed">
                        <?php
                            $data = $_POST;
                            $teamscount = $data['teams'];
                            $players = explode(",", $data['players']);
                            $playercount = count($players);
                            if ($teamscount < 2) {
                                echo "<div class=\"alert alert-warning\">Why would you want to shuffle the players in one team?</div>";
                            }
                            echo "teams: ";
                            var_dump($teamscount);
                            echo "<br/>players: ";
                            var_dump($players);
                            echo "<br/>Playercount: ";
                            var_dump($playercount);
                            $teams = array();
                            for ($i = 1; $i <= $teamscount; $i++) {
                                $teams[$i] = array();
                            }
                            echo "<br/>Teams: ";
                            var_dump($teams);
                            while(count($players)) {
                                for ($i = 1; $i < count($teams); $i++) {
                                    $rand = rand(0,count($players));
                                    $teams[$i][] = $players[$rand];
                                    unset($players[$rand]);
                                }
                            }
                            echo "<br/>Teams: ";
                            var_dump($teams);
                        ?>
                    </table>
                    <div class="panel-footer"></div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </body>
    <footer>
    </footer>
</html>
