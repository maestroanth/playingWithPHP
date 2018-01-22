<?php
//require_once 'sql.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$theFirstName = "";
$theLastName = "";



function displayPageHeader($pageTitle) {
    //$theUserID = $_SESSION('UserID');
//    $theName = getNameHeader($_SESSION['UserID']);
//extract($theName);
//    $theFirstName = $theName[0]['FirstName'];
//$theLastName = $theName[0]['LastName'];
//$theUserType = 0;
//$theActualUserType = "User";
//if ($theName[0]['UserType'] == 1) {
//    $theActualUserType = "Professor";
//} else
//{
//    $theActualUserType = "Student";
//} 
    
    if (isset($_SESSION['UserID']))
    {
        $theActualUserType = $_SESSION['UserType'];
        $theFirstName = $_SESSION['FirstName'];
        $theLastName = $_SESSION['LastName'];
        $theUserID = $_SESSION['UserID'];
        if ($theActualUserType == 1) 
        {
           $theActualUserType = "Professor";
        } 
        else 
            {
                $theActualUserType = "Student";
            } 
    }
    $output = <<<ABC
﻿<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>$pageTitle</title>

    <link rel="stylesheet" type="text/css" href="css/styles.css"/>

</head>
<body>


    <section>
        <div class="header">
                <div class="textwidth">
            <div id="logo">
                <img src="./images/bear.png" id="image" />
            </div>
            <div id="title">
                BSU Classes
            </div>
            <div id="subtitle">
                Bear State University Portal
            </div>
               <div id="welcome">
            Welcome: $theActualUserType $theFirstName $theLastName &nbsp; &nbsp; &nbsp;University ID: $theUserID
            </div>
             </div><!-- end textwidth area -->
        </div><!-- end header div -->

    </section><!-- end header section -->
            
        <div class ="textwidth">
            <div id="currentaddressarea">  
            <ul id="navigation">
            <!-- current page you are on goes here --> 

           <li>
                <a href="login.php">Home</a>
                </li>
                <li>
                <a href="classNavigationLink.php?theUserID=$theUserID">View Classes</a>
                </li>
                <li>
                <a href="logout.php?toggleLogOut=True">Logout</a>

                        </div>
            </ul>
                    </div>
            </div>

            

    <section><!-- body elements -->
        <div id="bodyarea">
            
ABC;
    echo $output;
}

function displayPageFooter() {
    $output = <<<ABC
﻿        </div>


    </section>
    

</body>
            <div id="footer">
            <div class="textwidth">
            <div id="footerText">
            All Rights Reseverd
            </div>
            </div>
            </div>
</html>
ABC;
    echo $output;
}

?>