<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 1/21/2018
 * Time: 7:31 PM
 */
require '../vendor/autoload.php';//this adds the guzzler dependency as per the composer.json file


$client = new GuzzleHttp\Client();
$res = $client->get('https://api.github.com/users/maestroanth', [
    'auth' =>  ['maestroanth', 'FuckPikachu69']
]);
echo $res->getStatusCode() . '<br>';           // 200
//echo $res->getHeader('content-type'); // 'application/json; charset=utf8'
//echo $res->getBody();                 // {"type":"User"...'
//var_dump($res);
//echo $res['login'];                 // {"type":"User"...'
$usableArray = json_decode($res->getBody());
echo $usableArray->login . '<br>';//output as object
$usableArray = json_decode($res->getBody(), true);
echo $usableArray['login'] . '<br>';//output as an array
//echo $res->getBody();
//var_export($res->getBody());
//var_export($res->getBody());             // Outputs the JSON decoded data