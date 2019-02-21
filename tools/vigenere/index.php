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
require "vigenere.php";
$toolname = "Vigenere";
$toolshort = strtolower($toolname);
$toolDescShort = "";
?>
<html>
<?php include $templatedir."head/head.phtml"; ?>
    <body>
        <?php
            $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
            $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolname."'><?php echo $toolname; ?> <span class='sr-only'>(current)</span></a></li>"
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
                            {INFO CONTENT}
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="card text-white bg-dark">
                        <div class="card-header">Input</div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cipherAlphabet">Your Cipher Alphabet:</label>
                                    <input type="text" id="cipherAlphabet" name="cipherAlphabet" class="form-control" disabled placeholder="ABCDEFGHIJKLMNOPQRSTUVWXYZ" value="<?php if(isset($_POST["cipherAlphabet"])) echo $_POST["cipherAlphabet"];?>">
                                </div>
                                <div class="form-group">
                                    <label for="cipherKey">Your Cipher Key:</label>
                                    <input type="text" id="cipherKey" name="cipherKey" class="form-control" placeholder="Your Cipher Key"  value="<?php if(isset($_POST["cipherKey"])) echo $_POST["cipherKey"];?>">
                                </div>
                                <div class="form-group">
                                    <label for="cipherContent">Content (Text To En/De-crypt)</label>
                                    <textarea id="cipherContent" name="cipherContent" class="form-control" rows="15"><?php if(isset($_POST["cipherContent"])) echo $_POST["cipherContent"]; else echo "Place your Text here...";?></textarea>
                                </div>
                                <input type="radio" value="enc" name="ende">Encrypt<br/>
                                <input type="radio" value="dec" name="ende">Decrypt
                                <input type="submit" class="btn btn-success btn-block" value="Make it So!">
                            </form>
                        </div>
                        <?php if(count($_POST) > 0) : ?>
                        <div class="panel-body">
                            <?php
                                $key = strtolower($_POST["cipherKey"]);
                                $content = strtolower($_POST["cipherContent"]);
                                //$alphabetString = $_POST["cipherAlphabet"];
                                $encDec = $_POST["ende"];
                                $alphabetString = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                $alphabetTable = buildAlphabetTable($alphabetString);
                                if ($encDec === "enc") {
                                    $encrypted = encrypt($content, $key, $alphabetTable, $alphabetString);
                                    echo "Your Encrypted Content:<br/>";
                                    echo "<pre>";
                                    echo $encrypted;
                                    echo "</pre>";
                                } elseif ($encDec === "dec") {
                                    $decrypted = decrypt($content, $key, $alphabetTable, $alphabetString);
                                    echo "Your Decrypted Content:<br/>";
                                    echo "<pre style='color:white;'>";
                                    echo $decrypted;
                                    echo "</pre>";
                                } else {
                                    print_r("Please select an option!");
                                }
                            ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
    </body>
</html>