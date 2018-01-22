<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
//require_once 'logout.php';
require_once 'phpCommon/siteCommon.php';
require_once 'phpCommon/dbConnExec.php';
displayPageHeader("Create Course");

$ThisUserID = $_SESSION['UserID'];
/*
 * 
 * Main PHP
 */

//showInstructorCreateForm();
?>

    <link rel="stylesheet" type="text/css" href="styles.css">
	<form name = "Create Course" id = "Create Course" action = "" method="POST" enctype="multipart/form-data">
	<h2> Add New Course</h2>
       <h3> University ID of Instructor To Be In Charge</h3>
       <p> <input type ="text" name="UserID" value="<?php echo $_SESSION['UserID']; ?>" class = "textbox" /> </p>
   
        <h3> Course Title</h3>
        <p> <input type ="text" name="CourseTitle" class = "textbox" /> </p>
        <h3> Course Description</h3>
        <p> <input type ="text" name="CourseDescription" class = "textbox" /> </p>
        <p></p>
        <input type = "submit" name ="submit" value= "Create"  />

	</form>

<?php

if ($_POST['submit'] == "Create")
{
    //blank field error checks
    
    if ($_POST['UserID'] == "" )//make sure it's not blank
        {
                //clearForm();
                echo "<br>Please Fill out a User ID.</br>";
        }  
     
     
    if ($_POST['CourseTitle'] == "")
        {
            echo "<br>Please Fill out a Course Title</br>";
         }
    if ($_POST['CourseDescription'] == "")
        {
            echo "<br>Please Fill out a Course Description</br>";
        }
        /*
     if (!is_numeric($_POST['UserID']))//make sure it's not blank
        {
                //clearForm();
                echo "<br>Make sure UserID is an integer.</br>";
        }
*/
    if ($_POST['CourseTitle'] != ""  && $_POST['CourseDescription'] != ""  && $_POST['UserID'] != "" ) //$_POST['UserID'] != "" &&  is_numeric($_POST['UserID'])) 
        {
            CreateCourse($_POST['UserID'], $_POST['CourseTitle'], $_POST['CourseDescription']);
        }
}
/*
 * Show Form
 */
function showInstructorCreateForm()
{
    ?>
    <link rel="stylesheet" type="text/css" href="styles.css">
	<form name = "Create Course" id = "Create Course" action = "" method="POST" enctype="multipart/form-data">
	<h2> Add New Course</h2>
       <h3> University ID of Instructor To Be In Charge</h3>
       <p> <input type ="text" name="UserID" value="<?php (int) $_SESSION['UserID']; ?>" class = "textbox" /> </p>
   
        <h3> Course Title</h3>
        <p> <input type ="text" name="CourseTitle" class = "textbox" /> </p>
        <h3> Course Description</h3>
        <p> <input type ="text" name="CourseDescription" class = "textbox" /> </p>
        <p></p>
        <input type = "submit" name ="submit" value= "Create"  />
        <a id="backToAllLinks" href="instructorForm.php">Go Back To Main Form</a>
	</form>
<?php
}
/*
 * Show Courses
 */
function ShowCourses()
{
		//$DBConnection = dbConnect();
	$query = "SELECT * FROM CourseSection ORDER BY CourseTitle"; //gets all records from CourseSection
        $response = executeQuery($query); //or die(mysql_error());//showed 
        if ($response)//this is in table format atm in case we decide different how to display it
        {               
            
            $output .= <<<HTML
            <h2> BSU Course List </h2>
            <p>Click on Course To Edit</p>
            <p></p>
            <p></p>
            <p></p>
            <table border = 1 align = center>
            <tr>
            <th>Course ID</th>
            <th>User ID</th>
            <th>Course Title</th>
            <th>Course Description</th>
            </tr>
HTML;
            foreach ($response as $record)
             {
                $recordCourseSectionID = $record['CourseSectionID'];
                $recordUserID = $record['UserID'];
                $recordOutputTitle = $record['CourseTitle'];
                $recordOutputDesc = $record['CourseDescription'];
                //output is passing the PK in the URL
                $output .= <<<HTML
                <tr>
                <h3><td><a href="instructorEditCourseForm.php?TheCourseSectionID=$recordCourseSectionID">$recordCourseSectionID</a></td></h3>
                <h3><td>$recordUserID</td></h3>
                <h3><td>$recordOutputTitle</td></h3>
                <h3><td>$recordOutputDesc</td></h3>
                </tr>
HTML;
             }
             $output .= <<<HTML
                     </table>
HTML;
             
        }
        else 
        { 
            echo "Couldn't retrieve class list!";    
        }
        echo $output;
        
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

/*
 * Create Course
 */
function CreateCourse($TheUserID, $TheCourseTitle, $TheCourseDescription)
{
    
    $DBConnection = dbConnect();
    $query = "INSERT INTO CourseSection (UserID, CourseTitle, CourseDescription) VALUES ('$TheUserID', '$TheCourseTitle', '$TheCourseDescription')";//UserID, '$TheUserID', 
    executeInsertQuery($query);
     echo "Class Inserted.";


                $query2 = "SELECT * FROM CourseSection WHERE UserID = '$TheUserID' AND CourseTitle= '$TheCourseTitle' AND CourseDescription='$TheCourseDescription'";//gets the record of newly changed record
                $response = executeQuery($query2);
                if ($response)
                {	

                     ?>
                    <link rel="stylesheet" type="text/css" href="schoolCSS.css">
                        <?php
                    echo
                     "<strong> <center>Added Class </center></strong>
                      <p></p>
                      <p></p>
                      <p></p>
                      <p></p>
                      <table>
                      <table border = 1 align = center>
                      <tr>
                      <th>Course ID</th>
                    <th>User ID</th>
                    <th>Course Title</th>
                    <th>Course Description</th>
                      </tr>";
                    foreach ($response as $record)
                    {
                            echo "<tr>";
                            
                            echo "<td>".$record['CourseSectionID']."</td>";
                            echo "<td>".$record['UserID']."</td>";
                            echo "<td>".$record['CourseTitle']."</td>";
                            echo "<td>".$record['CourseDescription']."</td>";
                            echo "</tr>";
                    }
                    echo "</table>";
                }
    dbDisconnect($DBConnection);
}

displayPageFooter();
?>