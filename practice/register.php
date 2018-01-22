<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 1/21/2018
 * Time: 4:34 PM
 */

include 'DB/dbconn.php';
include 'DB/queries.php';


$con = OpenCon();
ob_start();//can use a callback function as a parameter to sanitize string (use str_replace(regexpression))
?>

<html>
<body>

<form action="register.php" method="post">
    Username: <input type="text" name="username"><br>
    Password: <input type="text" name="password"><br>
    Description: <input type="text" name="description"><br>
    <input type="submit">
</form>

</body>
</html>

<?php

// Escape user inputs for security
$username = mysqli_real_escape_string($con, $_REQUEST['username']);
$password = mysqli_real_escape_string($con, $_REQUEST['password']);
$description = mysqli_real_escape_string($con, $_REQUEST['description']);

echo addUser($username, $password, $description);

if(mysqli_query($con, addUser($username, $password, $description))){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute addUser($username, $password, $description). " . mysqli_error($con);
}

CloseCon($con);
?>