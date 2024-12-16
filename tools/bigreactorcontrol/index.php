<?php
/**
 * BRWC
 * Copyright (C) 2020  rusty.info
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
$toolname = "BigReactor WebControl";
$toolshort = strtolower($toolname);
$toolDescShort = "";

function generateRandomString($uppercase, $lowercase, $specialchars, $numbers, $length, $batchsize)
{
    $strings = array();
    for ($i = 0; $i<$batchsize; $i++) {
        //Make random string each time
        $usedChars = "";
        if ($uppercase) {
            $usedChars .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }
        if ($lowercase) {
            $usedChars .= 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($specialchars) {
            $usedChars .='!?@(){}[]\/=~$%&#*-+.,_';
        }
        if ($numbers) {
            $usedChars .= '0123456789';
        }

        $string = "";
        for ($b = 0; $b < $length; $b++) {
            $string .= $usedChars[rand(0, strlen($usedChars) - 1)];
        }
        $strings[] = $string;
    }
    return $strings;
}
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
		<?php $seckey =  generateRandomString(true, true, false, true, 32, 1)?>
		<script>
		    var seckey="<?php echo $seckey[0];?>";
		</script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <?php include $templatedir."toolnav.phtml"; ?>
                    <div class="card text-white bg-success" style="margin-top:15px;">
                        <div class="card-header collapsed" type="button" data-toggle="collapse" data-target="#infoCollapse" aria-expanded="false" aria-controls="infoCollapse">INFO ( Click me! )</div>
                        <div class="card-body collapse" id="infoCollapse">
                            <h3>BRWC</h3>
                            <p>
                                WIP!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="card text-white bg-dark">
                        <div class="card-header">BRWC</div>
                        <div class="card-body">
						    Secret Key:
							<input id="brwc-secretKey" name="brwc-secretKey" class="form-control" type="text" disabled value=""/>
                        </div>
						<div class="card-body">
						    <button class="btn btn-lg btn-danger"><i class="fa fa-lg fa-power-off"></i></button>
							<button class="btn btn-lg btn-primary"><i class="fa fa-lg fa-thermometer-half"></i>&nbsp;Case:<span class="badge badge-info">0 °C</span>&nbsp;Fuel:<span class="badge badge-info">0 °C</span></button>
							<button class="btn btn-lg btn-danger"><i class="fa fa-lg fa-car-battery"></i>&nbsp;<span>0</span>&nbsp;RF</button>
							<button class="btn btn-lg btn-warning"><i class="fa fa-lg fa-bolt"></i>&nbsp;<span>0</span>&nbsp;RF/t</button>
							<button class="btn btn-lg btn-success"><i class="fa fa-lg fa-radiation"></i>&nbsp;<span>0</span></button>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
		<script>
			$(document).ready(function() {
				//put key in input:
				$('#brwc-secretKey').val(seckey);
				//create a new websocket
				var ws = new WebSocket('wss://srv1.htav.de:999');
				ws.onerror = function (error) {
					console.log('WSErr: ' + error);
				}
				
				ws.onmessage = function (e) {
					console.log('MSG: ' + e.data);
				}
				
				//try to register at the server:
				ws.onopen = function() {
					regobj = {type: "register", payload: {secretKey:seckey}}
					ws.send(JSON.stringify(regobj));
				}
			});
		</script>
    </body>
</html>
