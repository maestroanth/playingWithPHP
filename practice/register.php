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
echo "Post Dump: ";
var_dump($_POST);
echo "<br>";





if($_SERVER['REQUEST_METHOD'] == 'POST'){//important to put this crap in If statement or it will result in a bunch of undefined errors
    echo "The User Name from POST: " . $_POST['username'];
    // Escape user inputs for security
    $username = mysqli_real_escape_string($con, $_REQUEST['username']);
    $password = mysqli_real_escape_string($con, $_REQUEST['password']);
    $description = mysqli_real_escape_string($con, $_REQUEST['description']);
    echo "<br>";
    echo addUser($username, $password, $description);
    echo "<br>";
    if(mysqli_query($con, addUser($username, $password, $description))){
        echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute addUser($username, $password, $description). " . mysqli_error($con);
    }
    echo "<br>";
}
else{
    echo "Form is not Submitted yet";
}
echo "<br>";

if(isset($_POST) && !empty($_POST)){
    echo "The User Name from POST: " . $_POST['username'];
}
else{
    echo "no POST is set yet";
}
echo "<br>";
echo "Myself: <br>";
echo $_SERVER['PHP_SELF'];
CloseCon($con);
?>