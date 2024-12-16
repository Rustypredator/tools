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
$toolname = "What is my IP";
$toolshort = strtolower($toolname);
$toolDescShort = "";
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
                            <h3>What is my IP?</h3>
                            <p>
                                This Tool
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="card text-white bg-dark">
                        <div class="card-header">What is my IP?</div>
                        <div class="card-body">
                                <?php if(isset($_SERVER['CF-Connecting-IP']) && !empty($_SERVER['CF-Connecting-IP'])): ?>
                                <?php echo $_SERVER['CF-Connecting-IP']; ?>
 				<?php elseif(isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])): ?>
				<?php echo $_SERVER['HTTP_X_REAL_IP']; ?>
				<?php elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])): ?>
				<?php echo $_SERVER['HTTP_X_FORWARDED_FOR'];?>
				<?php else: ?>
				<?php echo $_SERVER['REMOTE_ADDR']; ?>
				<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
    </body>
</html>
