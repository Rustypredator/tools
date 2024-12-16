<?php
/**
 * Vigénere
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
$toolname = "Enigma";
$toolshort = strtolower($toolname);
$toolDescShort = "enigma";

//Tool-Specific Vars:
/*$rotors = array(
	0 => array('A' => 'E', 'B' => 'K', 'C' => 'M', 'D' => 'F', 'E' => 'L', 'F' => 'G', 'G' => 'D', 'H' => 'Q', 'I' => 'V', 'J' => 'Z', 'K' => 'N', 'L' => 'T', 'M' => 'O', 'N' => 'W', 'O' => 'Y', 'P' => 'H', 'Q' => 'X', 'R' => 'U', 'S' => 'S', 'T' => 'P', 'U' => 'A', 'V' => 'I', 'W' => 'B', 'X' => 'R', 'Y' => 'C', 'Z' => 'J'),
	1 => array('A' => 'A', 'B' => 'J', 'C' => 'D', 'D' => 'K', 'E' => 'S', 'F' => 'I', 'G' => 'R', 'H' => 'U', 'I' => 'X', 'J' => 'B', 'K' => 'L', 'L' => 'H', 'M' => 'W', 'N' => 'T', 'O' => 'M', 'P' => 'C', 'Q' => 'Q', 'R' => 'G', 'S' => 'Z', 'T' => 'N', 'U' => 'P', 'V' => 'Y', 'W' => 'F', 'X' => 'V', 'Y' => 'O', 'Z' => 'E'),
	2 => array('A' => 'B', 'B' => 'D', 'C' => 'F', 'D' => 'H', 'E' => 'J', 'F' => 'L', 'G' => 'C', 'H' => 'P', 'I' => 'R', 'J' => 'T', 'K' => 'X', 'L' => 'V', 'M' => 'Z', 'N' => 'N', 'O' => 'Y', 'P' => 'E', 'Q' => 'I', 'R' => 'W', 'S' => 'G', 'T' => 'A', 'U' => 'K', 'V' => 'M', 'W' => 'U', 'X' => 'S', 'Y' => 'Q', 'Z' => 'O'),
	3 => array('A' => 'E', 'B' => 'S', 'C' => 'O', 'D' => 'V', 'E' => 'P', 'F' => 'Z', 'G' => 'J', 'H' => 'A', 'I' => 'Y', 'J' => 'Q', 'K' => 'U', 'L' => 'I', 'M' => 'R', 'N' => 'H', 'O' => 'X', 'P' => 'L', 'Q' => 'N', 'R' => 'F', 'S' => 'T', 'T' => 'G', 'U' => 'K', 'V' => 'D', 'W' => 'C', 'X' => 'M', 'Y' => 'W', 'Z' => 'B'),
	4 => array('A' => 'V', 'B' => 'Z', 'C' => 'B', 'D' => 'R', 'E' => 'G', 'F' => 'I', 'G' => 'T', 'H' => 'Y', 'I' => 'U', 'J' => 'P', 'K' => 'S', 'L' => 'D', 'M' => 'N', 'N' => 'H', 'O' => 'L', 'P' => 'X', 'Q' => 'A', 'R' => 'W', 'S' => 'M', 'T' => 'J', 'U' => 'Q', 'V' => 'O', 'W' => 'F', 'X' => 'E', 'Y' => 'C', 'Z' => 'K')
);
$ukws = array(
	0 => array('A' => 'E', 'B' => 'J', 'C' => 'M', 'D' => 'Z', 'E' => 'A', 'F' => 'L', 'G' => 'Y', 'H' => 'X', 'I' => 'V', 'J' => 'B', 'K' => 'W', 'L' => 'F', 'M' => 'C', 'N' => 'R', 'O' => 'Q', 'P' => 'U', 'Q' => 'O', 'R' => 'N', 'S' => 'T', 'T' => 'S', 'U' => 'P', 'V' => 'I', 'W' => 'K', 'X' => 'H', 'Y' => 'G', 'Z' => 'D'),
	1 => array('A' => 'Y', 'B' => 'R', 'C' => 'U', 'D' => 'H', 'E' => 'Q', 'F' => 'S', 'G' => 'L', 'H' => 'D', 'I' => 'P', 'J' => 'X', 'K' => 'N', 'L' => 'G', 'M' => 'O', 'N' => 'K', 'O' => 'M', 'P' => 'I', 'Q' => 'E', 'R' => 'B', 'S' => 'F', 'T' => 'Z', 'U' => 'C', 'V' => 'W', 'W' => 'V', 'X' => 'J', 'Y' => 'A', 'Z' => 'T'),
	2 => array('A' => 'F', 'B' => 'V', 'C' => 'P', 'D' => 'J', 'E' => 'I', 'F' => 'A', 'G' => 'O', 'H' => 'Y', 'I' => 'E', 'J' => 'D', 'K' => 'R', 'L' => 'Z', 'M' => 'X', 'N' => 'W', 'O' => 'G', 'P' => 'C', 'Q' => 'T', 'R' => 'K', 'S' => 'U', 'T' => 'Q', 'U' => 'S', 'V' => 'B', 'W' => 'N', 'X' => 'M', 'Y' => 'H', 'Z' => 'L') 
);*/
$rotors = array(
	array('E','K','M','F','L','G','D','Q','V','Z','N','T','O','W','Y','H','X','U','S','P','A','I','B','R','C','J'),
	array('A','J','D','K','S','I','R','U','X','B','L','H','W','T','M','C','Q','G','Z','N','P','Y','F','V','O','E'),
	array('B','D','F','H','J','L','C','P','R','T','X','V','Z','N','Y','E','I','W','G','A','K','M','U','S','Q','O'),
	array('E','S','O','V','P','Z','J','A','Y','Q','U','I','R','H','X','L','N','F','T','G','K','D','C','M','W','B'),
	array('V','Z','B','R','G','I','T','Y','U','P','S','D','N','H','L','X','A','W','M','J','Q','O','F','E','C','K')
);
$ukws = array(
	array('E','J','M','Z','A','L','Y','X','V','B','W','F','C','R','Q','U','O','N','T','S','P','I','K','H','G','D'),
	array('Y','R','U','H','Q','S','L','D','P','X','N','G','O','K','M','I','E','B','F','Z','C','W','V','J','A','T'),
	array('F','V','P','J','I','A','O','Y','E','D','R','Z','X','W','G','C','T','K','U','Q','S','B','N','M','H','L')
);
?>
<!DOCTYPE html>
<html lang="en">
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
                            <h1>Enigma Encryption:</h1>
                            <p>
                                ...
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <?php include $templatedir."other/wipwarning.phtml"; ?>
                    <div class="card text-white bg-dark">
                        <div class="card-header">Input</div>
						<table class="card-body table table-sm table-center" style="text-align:center;">
							<thead>
								<th>UKW</th>
								<th>3</th>
								<th>2</th>
								<th>1</th>
							</thead>
							<tbody>
								<tr>
									<td>
										<select name="ukw" id="ukw" style="width:150px;"><option value="0">UKW A</option><option value="1">UKW B</option><option value="2">UKW C</option></select>
									</td>
									<td>
										<select name="rotor3" id="rotor3" style="width:150px;"><option value="0">Rotor I</option><option value="1">Rotor II</option><option value="2">Rotor III</option><option value="3">Rotor IV</option><option value="4">Rotor V</option></select>
									</td>
									<td>
										<select name="rotor2" id="rotor2" style="width:150px;"><option value="0">Rotor I</option><option value="1">Rotor II</option><option value="2">Rotor III</option><option value="3">Rotor IV</option><option value="4">Rotor V</option></select>
									</td>
									<td>
										<select name="rotor1" id="rotor1" style="width:150px;"><option value="0">Rotor I</option><option value="1">Rotor II</option><option value="2">Rotor III</option><option value="3">Rotor IV</option><option value="4">Rotor V</option></select>
									</td>
								</tr>
								<tr>
									<td>
										<select name="ukwLetter" id="ukwLetter" style="width:150px;"><option value="0">01</option><option value="1">02</option><option value="2">03</option><option value="3">04</option><option value="4">05</option><option value="5">06</option><option value="6">07</option><option value="7">08</option><option value="8">09</option><option value="9">10</option><option value="10">11</option><option value="11">12</option><option value="12">13</option><option value="13">14</option><option value="14">15</option><option value="15">16</option><option value="16">17</option><option value="17">18</option><option value="18">19</option><option value="19">20</option><option value="20">21</option><option value="21">22</option><option value="22">23</option><option value="23">24</option><option value="24">25</option><option value="25">26</option></select>
									</td>
									<td>
										<select name="rotor3Letter" id="rotor3Letter" style="width:150px;"><option value="0">01</option><option value="1">02</option><option value="2">03</option><option value="3">04</option><option value="4">05</option><option value="5">06</option><option value="6">07</option><option value="7">08</option><option value="8">09</option><option value="9">10</option><option value="10">11</option><option value="11">12</option><option value="12">13</option><option value="13">14</option><option value="14">15</option><option value="15">16</option><option value="16">17</option><option value="17">18</option><option value="18">19</option><option value="19">20</option><option value="20">21</option><option value="21">22</option><option value="22">23</option><option value="23">24</option><option value="24">25</option><option value="25">26</option></select>
									</td>
									<td>
										<select name="rotor2Letter" id="rotor2Letter" style="width:150px;"><option value="0">01</option><option value="1">02</option><option value="2">03</option><option value="3">04</option><option value="4">05</option><option value="5">06</option><option value="6">07</option><option value="7">08</option><option value="8">09</option><option value="9">10</option><option value="10">11</option><option value="11">12</option><option value="12">13</option><option value="13">14</option><option value="14">15</option><option value="15">16</option><option value="16">17</option><option value="17">18</option><option value="18">19</option><option value="19">20</option><option value="20">21</option><option value="21">22</option><option value="22">23</option><option value="23">24</option><option value="24">25</option><option value="25">26</option></select>
									</td>
									<td>
										<select name="rotor1Letter" id="rotor1Letter" style="width:150px;"><option value="0">01</option><option value="1">02</option><option value="2">03</option><option value="3">04</option><option value="4">05</option><option value="5">06</option><option value="6">07</option><option value="7">08</option><option value="8">09</option><option value="9">10</option><option value="10">11</option><option value="11">12</option><option value="12">13</option><option value="13">14</option><option value="14">15</option><option value="15">16</option><option value="16">17</option><option value="17">18</option><option value="18">19</option><option value="19">20</option><option value="20">21</option><option value="21">22</option><option value="22">23</option><option value="23">24</option><option value="24">25</option><option value="25">26</option></select>
									</td>
								</tr>
								<tr>
									<td><span id="ukwCounter"></span></td>
									<td><span id="rotor3Counter"></span></td>
									<td><span id="rotor2Counter"></span></td>
									<td><span id="rotor1Counter"></span></td>
								</tr>
							</tbody>
						</table>
						<div class="card-body">
							<textarea class="form-control" id="enigmaInput"></textarea>
						</div>
					</div>
					<div class="card text-white bg-dark" style="margin-top:15px;">
                        <div class="card-header">Output</div>
                        <div class="card-body">
                            <textarea class="form-control" id="enigmaOutput"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
		<script src="js/enigma.js"></script>
        <script>
			var ukws = JSON.parse('<?php echo json_encode($ukws); ?>');
			var rotors = JSON.parse('<?php echo json_encode($rotors); ?>');
			
		    $( document ).ready(function() {
				console.log( "document loaded" );
				$('#enigmaInput').on('input propertychange paste', function() {
					var input = $('#enigmaInput').val().slice(-1);
					var encrypted = enigma(input);
					$('#enigmaOutput').append(encrypted);
				});
			});
		 
			$( window ).on( "load", function() {
				console.log( "window loaded" );
			});
        </script>
    </body>
</html>
