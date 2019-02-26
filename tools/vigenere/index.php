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
$toolname = "Vigenere";
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
                            <h1>Vigenére Cipher:</h1>
                            <p>
                                This tool enables you to encode/decode Vigenére Ciphers.<br/>
                                You need to know the Key and the Alphabet that was used to encode the string to decode it.
                            </p>
                            <a href="https://en.wikipedia.org/wiki/Vigenère_cipher">more info (wikipedia)</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <?php include $templatedir."other/wipwarning.phtml"; ?>
                    <div class="card text-white bg-dark">
                        <div class="card-header">Input</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="cipherAlphabet">Your Cipher Alphabet:</label>
                                <input type="text" id="cipherAlphabet" name="cipherAlphabet" class="form-control" disabled value="<?php if(isset($_POST["cipherAlphabet"])) echo $_POST["cipherAlphabet"]; else echo "ABCDEFGHIJKLMNOPQRSTUVWXYZ";?>">
                            </div>
                            <div class="form-group">
                                <label for="cipherKey">Your Cipher Key:</label>
                                <input type="text" id="cipherKey" name="cipherKey" class="form-control" placeholder="Your Cipher Key"  value="<?php if(isset($_POST["cipherKey"])) echo $_POST["cipherKey"];?>">
                            </div>
                            <div class="form-group">
                                <label for="cipherContent">Content (Text To En/De-crypt)</label>
                                <textarea id="cipherContent" name="cipherContent" class="form-control" rows="4"><?php if(isset($_POST["cipherContent"])) echo $_POST["cipherContent"]; else echo "Place your Text here...";?></textarea>
                            </div>
                            <div class="btn-group btn-block">
                                <button onclick="process('en')" class="btn btn-success">Encrypt</button>
                                <button onclick="process('de')" class="btn btn-primary">Decrypt</button>
                            </div>
                            <div class="form-group">
                                <label for="cipherOutput">Output:</label>
                                <textarea id="cipherOutput" name="cipherOutput" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
        <script>
            function process(type) {
                if (type !== 'en' && type !== 'de') {
                    toastr["error"]("Please use the Buttons to en/decrypt!");
                    return;
                }

                let alphabet = $('#cipherAlphabet').val();
                let cipherKey = $('#cipherKey').val();
                let cipherString = $('#cipherContent').html();

                let dataString = "cipherAlphabet=" + alphabet + "&cipherKey=" + cipherKey + "&cipherContent=" + cipherString + "&ende=" + type;

                $.ajax
                (
                    {
                        type: 'POST',
                        url: toolurl + 'ajax/vigenere.php',
                        data: dataString,
                        cache: false,
                        beforeSend: function() {},
                        success: function(data) {
                            let successobj = JSON.parse(data);
                            let success = successobj.success;
                            if(success) {
                                toastr["success"](successobj.message);
                                let output = successobj.data;
                                $('#cipherOutput').html(output);
                            } else {
                                toastr["error"](successobj.message);
                            }
                        }
                    }
                )
            }
        </script>
    </body>
</html>