<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'phpCommon/dbConnExec.php';
//require_once 'logout.php';

//require_once 'courseInformation.php';
require_once 'phpCommon/siteCommon.php';

function showStudentForm()
{
    ?>
    <link rel="stylesheet" type="text/css" href="styles.css">
	<form name = "User Data" id = "User Data" action = "" method="POST" enctype="multipart/form-data">
        <h1> Student Page </h1>
        <div id="studentPageBox">
        <h3><a href="viewClasses.php">View Your Classes</a> </h3>
        <i>- or -</i>
        <h3><a href="searchClasses.php">Search For Class</a> </h3>
        <!-- <h3><a href="n/a.php">Update Submission</a> </h3> -->
	<input type = "hidden" name ="PHPSESSID" value= '<?php echo session_id() ?>'  />
        <p>You may view and submit all of your assignments by viewing your classes.</p>
        </div>
    <?php
}
?>
