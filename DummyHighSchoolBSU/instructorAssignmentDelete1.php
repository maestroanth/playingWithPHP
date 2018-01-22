<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once ("phpCommon/sql.php");

if ((isset($_GET['AssignmentID'])) && (is_numeric($_GET['AssignmentID'])))
{
    deleteAssignment((int)$_GET['AssignmentID']);
    header("Location: instructorAssignmentList.php");
exit;
}

if ((isset($_GET['RemoveUser'])) && (is_numeric($_GET['RemoveUser'])))
{
    removeUserFromClass((int)$_GET['RemoveUser'],($_GET['CourseID']));
    header("Location: instructorAddRemoveUsers.php");
exit;
}


?>