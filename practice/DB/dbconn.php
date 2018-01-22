<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 1/21/2018
 * Time: 11:56 AM
 */

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "maestroanth";
    $dbpass = "Dragon@2";
    $db = "practice";


    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);


    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}


?>