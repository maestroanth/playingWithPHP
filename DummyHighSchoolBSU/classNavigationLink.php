<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

if (($_SESSION['UserType']==1))
{
       echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\" />";
}
    
else 
{
       echo "<meta http-equiv=\"refresh\" content=\"0;URL=viewClasses.php\" />";
}
?>