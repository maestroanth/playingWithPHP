<?php
session_start();
require_once 'phpCommon/dbConnExec.php';
//require_once 'logout.php';
//require_once 'courseInformation.php';
require_once 'phpCommon/siteCommon.php';
require_once 'instructorForm.php';
require_once 'studentForm.php';
 displayPageHeader("Login Page");
/*
  Main
  PHP
 */
if ($_POST['submit'] == "Login") 
{
    if ($_POST['UserName'] == "") 
    {//make sure it's not blank
        //clearForm();
        echo "Please Fill out a username\n";

        if ($_POST['Password'] == "") {
            echo "Please Fill out a password\n";
        }

        displayWelcomeForm();
    } 
    else 
    {
        $checkUserName = $_POST['UserName']; //sets Variable for username
        $checkPassword = $_POST['Password']; //sets Variable for password
        $username = checkingUserNameLogin($checkUserName);
        $password = checkingPasswordLogin($checkPassword, $checkUserName); //I needed two parameters otherwise you could mix and match any username/password pair
        if ($username && $password) {
            $_SESSION['LoginDate'] = date('l jS \of F Y h:i:s A e'); //saves longest timestamp eva!

            fetchUserInfo($username, $password); //successfully logged in, fetches name and sets session variables
            //displays either student form or instructor form depending on $_SESSION['UserType'] 
            displayWelcomeBackForm();
            header('Refresh: 0; URL=login.php');
            if ($_SESSION['UserType'] == 1) {
                
                showInstructorForm();

            } else {
                showStudentForm();
            }
        } 
        else 
        {
            //clearForm();
            echo "Username or password is incorrect.";
               
            displayWelcomeForm();
        }
    }
}

/*
 * redirecting from login.php to appropiate page if already logged in
 */ 
else if ($_SESSION['UserID']) 
{
    displayWelcomeBackForm();

    if ($_SESSION['UserType'] == 1) 
    {
        showInstructorForm();
    } 
    else if ($_SESSION['UserType'] == 2) 
    {
    showStudentForm();
    }
} 
else 
{
    //displayPageHeader("Main Login Page");
    displayWelcomeForm();
    
}
/*
 * show students button
 */
if ($_POST['submit'] == "Show Usernames/Passwords") {
    //clearForm();
    showStudents();
}


/*
  Shows Function Login Form Button Button
 */


/*
  This form displays first time users who haven't logged in
 * the studentID variable in the form is actually referring to the username 
 * in the database 2/22/2015
 */ 
function displayWelcomeForm()
{

    ?>
<h2> Sign In!</h2>
<div id="mainLoginForm">
    <form name = "User Data" id = "theMainLoginForm" action = "" method="POST" enctype="multipart/form-data">
        
        <h3> Username</h3>
        <p> <input type ="text" name="UserName" class = "textbox" /> <br></p>
        <h4> Password</h4>
        <p> <input type ="text" name="Password" class = "textbox" /> <br></p>
        <p></p>
        <input type = "submit" name ="submit" value= "Login"  />
        <input type = "submit" name ="submit" value= "Show Usernames/Passwords"  />
                <input type = "hidden" name ="PHPSESSID" value= '<?php echo session_id() ?>'  />

    </form>
</div>
    <?php
    
}
/*
  This Form is displayed with return visitors who have already logged in
 */ 
function displayWelcomeBackForm()
{
?>

    <?php

    echo "<h1> Welcome " .
    ($_SESSION['UserType'] == 1 ? "Instructor" : "Student");
    echo ": " . $_SESSION['FirstName'] . " " . $_SESSION['LastName'] . "</h1>" . "\n";
    echo "<center><i> You were last on:   " . $_SESSION['LoginDate'] . "</i></center>" . "\n";
    ?>
    </form>
    <?php
}

/*
  checks database for valid ID input: the typed username output: valid username or NULL if invalid
 */

function checkingUserNameLogin($checkUserName) {
    $DBConnection = dbConnect();

    $query = "SELECT UserName FROM [User] WHERE UserName = '$checkUserName'"; //gets the correct username if not in database returns false
    $response = executeQuery($query);
    if ($response) {
        //extracts don't work correctly here for some reason!!!
        $username = $response['0']['UserName'];
        //foreach ($response as $record) //ugh translating this hopefully from an array back into a string
        //{
        //  if ($checkUserName == $record['username'])
        //    $username = $checkUserName;
        //}
        //$username = $response;//The problem is here, I need to set the $username to the actual DB content vs. right now it has an array stored
    } else {
        $username = NULL;
        echo "username doesn't match.";
    }
    return $username;
}

/*
  checks database for valid ID input: the typed username output: valid username or NULL if invalid
 */

function checkingPasswordLogin($checkPassword, $checkUserName) {
    $DBConnection = dbConnect();

    $query = "SELECT Password FROM [User] WHERE (Password = '$checkPassword') AND (UserName = '$checkUserName');"; //gets the correct Password if not in database returns false
    $response = executeQuery($query);
    if ($response) {
        //extracts don't work correctly here for some reason!!!
        $password = $response['0']['Password'];
    } else {
        $password = NULL;
    }
    return $password;
}

/*
  fetches the fname, lname and displays greeting page
 */

function fetchUserInfo($username, $password) {
    $DBConnection = dbConnect();
    $query = "SELECT UserID, FirstName, LastName, UserType, UserName FROM [User] WHERE UserName = '$username' AND Password = '$password'"; //fetches full name from database
    $response = executeQuery($query); //showed 
    if ($response) 
        {
        foreach ($response as $record) {//setting session variables, I still don't know why this has to be in a foreach.....
            extract($record);
            $_SESSION['UserName'] = $record['UserName'];
            $_SESSION['Password'] = $record['Password'];
            $_SESSION['UserType'] = (int) $record['UserType'];
            $_SESSION['FirstName'] = $record['FirstName'];
            $_SESSION['LastName'] = $record['LastName'];
            $_SESSION['UserID'] = (int) $record['UserID'];
        }
    } else 
    {
        echo "Couldn't retrieve User!!\n";
    }
}

/*
  borrowed function from project2 to help with logging in shows student info database
 */

function ShowStudents() {
    //$DBConnection = dbConnect();
    $query = "SELECT * FROM [User] ORDER BY UserID"; //gets all records from User
    $response = executeQuery($query); //or die(mysql_error());//showed 
    if ($response) {
        ?> <link rel="stylesheet" type="text/css" href="styles.css">
        <?php
        echo
        "<h2> List Of Students </h2>
				<p></p>
				<p></p>
				<p></p>
				<p></p>
				<table border = 1 align = center>
				<tr>
				<th>UserName</th>
				<th>Password</th>
				<th>UserType</th>
				<th>FirstName</th>
				<th>LastName</th>
                                <th>UserID</th>
				</tr>";
        foreach ($response as $record) {
            echo "<tr>";
            echo "<td>" . $record['UserName'] . "</td>";
            echo "<td>" . $record['Password'] . "</td>";
            echo "<td>" . $record['UserType'] . "</td>";
            echo "<td>" . $record['FirstName'] . "</td>";
            echo "<td>" . $record['LastName'] . "</td>";
            echo "<td>" . $record['UserID'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        //showLoginForm();
    } else {
        echo $response;
        echo "response is empty";
    }
    dbDisconnect($DBConnection);
}

/* Dubugging strategies
  echo "Resp: ".print_r($response,true)."\n";
  echo "Record is:\n".print_r($record,true)."\n";
  echo "Resp2: ".print_r($response2,true)."\n";
  echo "Resp3: ".print_r($response3,true)."\n";
  echo "Record is:\n".print_r($record,true)."\n";
  echo "Record2 is:\n".print_r($record2,true)."\n";
  echo "Record3 is:\n".print_r($record3,true)."\n";
 */

function clearForm() {
    echo "<script type='text/javascript'>\n";
    echo "document.body.innerHTML = ''";
    echo "</script>";
}

displayPageFooter();
?>
