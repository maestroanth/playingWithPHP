<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once ("phpCommon/sql.php");

if (isset($_POST['AssignmentID']))
{
    updateAssignment((int)$_POST['AssignmentID'], $_POST['AssignmentType'], $_POST['AssignmentTitle'], $_POST['AssignmentInstructions'],
            $_POST['AssignmentDueDate']);
}
else //call the add method
{
    addAssignment($_SESSION["courseID"], $_POST['AssignmentType'], $_POST['AssignmentTitle'], $_POST['AssignmentInstructions'],
            $_POST['AssignmentDueDate']);
}

header("Location: instructorAssignmentList.php");
exit;

?>