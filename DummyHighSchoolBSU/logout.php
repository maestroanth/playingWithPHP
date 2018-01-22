<?php
/*
    Purpose: Securing Applications
    Author: LV
    Date: October 2013
 */
if (($_GET["toggleLogOut"] == "True"))
{
    destroySession();
}
// the cookie that holds the session id is destroyed

function destroySession()
{
    if (!isset($_SESSION))//prevents stupid not initialized warning when logging out
    {
      session_start();
    }
    if (isset($_COOKIE[session_name()]))//finds session name ID assigned to cookie
    {
        setcookie(session_name(),"",time()-3600); //destroy the session cookie on the client
    }

    $_SESSION = array(); // unset or remove all data from the $_SESSION array
    session_destroy(); //erase session data from the disk
    session_write_close(); // make sure the changes are committed
    echo '<h4>You have logged out.  You are now redirected to our home page.</h4>';
    
    header('Refresh: 2; URL=login.php');

    die();
}
?>