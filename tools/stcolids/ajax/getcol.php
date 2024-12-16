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

$collectionId = $data['collection'];
$apiKey = "39F09599C3B3F1B559C6DA83BA68284C";

//request collection details:
$url = "https://api.steampowered.com/ISteamRemoteStorage/GetCollectionDetails/v1/";
$params = ['?key='.$apiKey, 'collectioncount' => 1, 'publishedfileids[0]' => $collectionId];
$params2 = '?key='.$apiKey.'&collectioncount=1&publishedfileids[0]='.$collectionId;
$ch = curl_init($url);
curl_setopt_array($ch, [
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_POSTFIELDS => $params,
]);
$curlData = curl_exec($ch);
if($curlData === false) {
    exit(curl_error($ch));
}
curl_close($ch);

$data = json_decode($curlData)->response->collectiondetails[0];
$data->{'modscount'} = count($data->children);

//get file details:
$url = "https://api.steampowered.com/ISteamRemoteStorage/GetPublishedFileDetails/v1/";
$params = ['?key='.$apiKey, 'itemcount' => $data->modscount];
$ctr = 0;
foreach($data->children as $mod) {
	$params['publishedfileids['.$ctr.']'] = $mod->publishedfileid;
	$ctr++;
}

$ch = curl_init($url);
curl_setopt_array($ch, [
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_POSTFIELDS => $params,
]);
$curlData = curl_exec($ch);
if($curlData === false) {
    exit(curl_error($ch));
}
curl_close($ch);

$fileDetails = json_decode($curlData)->response->publishedfiledetails;
foreach($data->children as $key => $mod) {
	$data->children[$key]->{'details'} = $fileDetails[$key];
}

echo json_encode(array(
    'type'=>'success',
    'message'=>'Found these:',
    'data'=>$data
));