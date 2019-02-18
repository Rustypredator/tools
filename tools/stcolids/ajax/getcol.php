<?php
    /**
     * stcolids
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
<?php
$data = $_POST;
$rootdir = "../".dirname(__FILE__);
if (!$data) {
    //No data!
    echo json_encode(
        array(
            'type'=>'error',
            'message'=>'There was no Data submitted! Please use the <a href="https://tools.rusty.info/stcolids/index.php">Main Form</a>'
        )
    );
    exit;
}

if (!isset($data['collection']) or $data['collection']=="") {
    //Collection id has not been set!
    echo json_encode(
        array(
            'type'=>'error',
            'message'=>'The Collection ID was not submitted. Please use the <a href="https://tools.rusty.info/stcolids/index.php">Main Form</a>'
        )
    );
    exit;
}

if (!is_numeric($data['collection'])) {
    //Collection ID seems to be not numerical
    echo json_encode(
        array(
            'type'=>'error',
            'message'=>'The Submitted ID seems to be non Compliant.<br/>Please only use the ID of the collection! You can find it in the URL-Bar of your Browser where it says "?id=12345" (only there wont be "12345" but the id of your collection.)'
        )
    );
    exit;
}

//all things present, get the collection

//regexpressions
//for mod id: $re = '/<a href="https:\/\/steamcommunity.com\/sharedfiles\/filedetails\/\?id\=(.*?)">/';
//for title: $re = '/<div class="workshopItemTitle">(.*?)<\/div>/';
//for author name: $re = '/workshopItemAuthorName">\s*<a href=".*?">(.*?)<\/a>/';
//for author profile link: $re = '/workshopItemAuthorName">\s*<a href="(.*?)\/myworkshopfiles?.*<\/span>/';

require_once("3rdparty/simple_html_dom.php");
$baseurl = "http://steamcommunity.com/sharedfiles/filedetails/?id=";
$collectionurl = $baseurl.$data['collection'];
$html = file_get_html($collectionurl);
$mods = array();
$modscount = 0;

foreach ($html->find('.collectionItem') as $modelement) {
    $temp['id'] = str_replace('sharedfile_', '', $modelement->id);
    $temp['url'] = $baseurl.$temp['id'];
    array_push($mods, $temp);
    $modscount++;
}

//echo $html->plaintext;
if (strpos($html->plaintext, 'That item does not exist.')) {
    //kollektion existiert nicht.
    echo json_encode(array(
        'type'=>'error',
        'message'=>'Could not find the Collection. Please make sure, it is public and that you have entered the right ID'
    ));
    exit;
}

echo json_encode(array(
    'type'=>'success',
    'message'=>'Found these:',
    'modsdata'=>$mods,
    'modscount'=>$modscount
));
