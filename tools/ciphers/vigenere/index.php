<?php
/**
 * Vigenère Cipher
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
 * @category RustyTools
 * @package  RustyTools_Vigenere
 * @author   Florian Steltenkamp <contact@rusty.info>
 * @license  GNU GPL 3.0
 * @link     https://tools.rusty.info
 */
require_once "../../functions.php";
require_once "vigenere.php";
?>
<html>
    <head>
        <title>Vigenère Cipher - Rusty's Tools</title>
        <meta encoding="UTF-8"/>
        <meta title="{NAME} - Rusty's Tools" description="Vigenère Cipher Tool"/>
        <link rel="stylesheet" href="../../../style/css/bootstrap.min.css" />
        <script src="../../../style/js/jquery-3.2.1.min.js"></script>
        <script src="../../../style/js/bootstrap.min.js"></script>
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
                        <li class="active"><a href="https://tools.rusty.info/tools/vigenere">Vigenère Cipher <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container container-fluid">
            <div class="col-sm-12 col-md-12">
                <?php printBootstrapPanel("vigenereInfoPanel", "success", "Vigenère Cipher", "Info", true, false); ?>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">Input</h2>
                    </div>
                    <div class="panel-body">
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
                                    print_r("Encrypting...<br/>");
                                    $encrypted = encrypt($content, $key, $alphabetTable, $alphabetString);
                                    echo "Your Encrypted Content:<br/>";
                                    echo "<pre>";
                                    echo $encrypted;
                                    echo "</pre>";
                                } elseif ($encDec === "dec") {
                                    print_r("Decrypting...<br/>");
                                    $decrypted = decrypt($content, $key, $alphabetTable, $alphabetString);
                                    echo "Your Decrypted Content:<br/>";
                                    echo "<pre>";
                                    echo $decrypted;
                                    echo "</pre>";
                                } else {
                                    print_r("WHAT");
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>