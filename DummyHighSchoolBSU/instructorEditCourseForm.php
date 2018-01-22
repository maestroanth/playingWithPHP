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
//require_once 'instructorForm.php';


function EditCourseForm($TheCourseSectionID, $recordUserID, $TheCourseTitle, $TheCourseDescription) //echo $TheUserID
{
    displayPageHeader("Edit Course");
    ?>
<html>
    
    <head>
        <link rel="stylesheet" type="text/css" href="schoolCSS.css"/>
        <form name = "Edit Course" id = "Edit Course" action = "" method="POST" enctype="multipart/form-data"/>
        <h1> Edit Course Form </h1>
        <h4> University ID of Instructor To Be In Charge</h4>
	<input type ="text" name="TheUserID" class = "textbox" value="<?php echo $recordUserID ?>"/> </p>

        <h4> Course Title</h4>
        <p> <input type ="text" name="TheCourseTitle" class = "textbox" value="<?php echo $TheCourseTitle ?>"  /> </p>
        <p></p>
        <h4> Course Description </h4>
        <p> <input type ="text" name="TheCourseDescription" class = "textbox" value="<?php echo $TheCourseDescription ?>" /> </p>
        <p></p>
        <p></p>
        <p></p>
        <input type = "submit" name ="Update" value= "Update"  />
       
        </form>
    
    </head>
     
</html>
<?php    
}

if (isset($_GET['CourseSectionID']))
{
    
    EditCourseForm($_GET['CourseSectionID'], $_SESSION['UserID'], $_GET['CourseTitle'], $_GET['CourseDescription']);
    //Update Button
    if (isset($_POST['Update']))
    {
        $DBConnection = dbConnect();
        $TheCourseSectionID = $_GET['CourseSectionID'];
        $TheUserID = $_POST['TheUserID'];
        $TheCourseTitle = $_POST['TheCourseTitle'];
        $TheCourseDescription = $_POST['TheCourseDescription'];
        if(!$TheUserID)
        {
            echo "<br> Please don't leave Course Title blank.</br>";
        }
        if(!$TheCourseTitle)
        {
            echo "<br> Please don't leave Course Title blank.</br>";
        }
        if(!$TheCourseDescription)
        {
            echo "<br> Please don't leave Course Description blank.</br>";
        }
        if($TheCourseTitle && $TheCourseDescription && $TheUserID)
        {
            if ($DBConnection)
            {
                $query = "UPDATE CourseSection SET UserID='$TheUserID', CourseTitle='$TheCourseTitle', CourseDescription='$TheCourseDescription' WHERE CourseSectionID = '$TheCourseSectionID'";
                executeInsertQuery($query);
                echo "Class Updated.";


                $query2 = "SELECT * FROM CourseSection WHERE CourseSectionID = '$TheCourseSectionID'";//gets the record of newly changed record
                $response = executeQuery($query2);
                if ($response)
                {	

                     ?>
                    <link rel="stylesheet" type="text/css" href="schoolCSS.css">
                        <?php
                    echo
                     "<strong> <center>Class Changed </center></strong>
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
                else 
                {
                    echo "No Results.";
                }
            }
            else
            {
                echo "No Database Connection.";
            }
        }
        ?>
        <a id="backToAllLinks" href="instructorForm.php">Go Back To Main Form</a>
       <?php
    }
     displayPageFooter();
}
/*
 * Form Clear
 */
function clearThisForm()
{
	echo "<script type='text/javascript'>\n";
	echo "document.body.innerHTML = ''";
	echo "</script>";
}
?>