<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once ("phpCommon/sql.php");
//$_SESSION["courseID"] = '570';
//$_SESSION["courseDescription"] = "570 course";
$courseID = $_SESSION["courseID"];
//$courseDescription = $_SESSION["courseDescription"];


if (isset($_POST["selectUserID"]))
{
    foreach($_POST["selectUserID"] as $names) {
    addUserToClass($names,$courseID,$_SESSION['CourseDescription']);
    }
}


header("Location: instructorAddRemoveUsers.php");
exit;

?>