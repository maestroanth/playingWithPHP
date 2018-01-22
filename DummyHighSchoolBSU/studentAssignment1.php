<?php
session_start();
require_once ("phpCommon/dbConnExec.php");
require_once ("phpCommon/sql1.php");
require_once ("phpCommon/siteCommon.php");
print_r($_SESSION['CourseSectionID']);
displayPageHeader("Classes");
//$classList = getClassesByID((int)$_SESSION['UserID']);
?>
<link rel="stylesheet" type="text/css" href="styles.css">
	<form name = "Create Course" id = "Create Course" action = "" method="POST" enctype="multipart/form-data">
	<h2>Your Assignments</h2>
        <?php
        //echo "one";
if ((isset($_GET['SubmitAssignments'])) && (is_numeric($_GET['SubmitAssignments'])))
{
echo "one";
//foreach ($classList as $class)
//{
  //echo $class['CourseTitle'];  
//$listOfClasses = getAssignmentList1($class['AssignmentTitle']);


    echo "Assignment Name: ".$AssignmentTitle;
    echo "<br />";
    echo "<br />";
    echo "Assignment Type: ".$AssignmentType;
    echo "<br />";
    echo "<br />";
    echo "Instructions: ".$AssignmentInstructions;
    echo "<br />";
    echo "<br />";
    echo "Due by: ".$AssignmentDueDate;
    echo "<br />";
    ?>
        <h3> Written Submission</h3>
        <p> <input type ="text" name="writtenSubmission" class = "textbox" /> </p>
        <p></p>
        <input type = "submit" name ="submit" value= "Submit"  />
	<input type = "submit" name ="submit" value= "Update"  />
	<br>
        <br>
	</form>
<?php
//}
}
if ($_POST['submit'] == "Submit")
{
    if ($_POST['writtenSubmission'] == "")
        {
            echo "<br>You will not receive any points for a blank submission</br>";
        }
    if ($_POST['writtenSubmission'] != "") 
        {
            submitAssignment($_POST['writtenSubmission']);
        }
}
if ($_POST['submit'] == "Update")
{
    if ($_POST['writtenSubmission'] == "")
        {
            echo "<br>You will not receive any points for a blank submission</br>";
        }
    if ($_POST['writtenSubmission'] != "") 
        {
            updateAssignment($_POST['writtenSubmission']);
        }
    
}

function submitAssignment($TheWrittenSubmission)
{
    $DBConnection = dbConnect();
    $query = "INSERT INTO Submission(SubmissionBody) VALUES ('$TheWrittenSubmission')";
    executeInsertQuery($query);
    echo "Class Added! (Click show courses to view)";
    dbDisconnect($DBConnection); 
}

function updateAssignment($TheWrittenSubmission)
{
    $DBConnection = dbConnect();
    $query = "INSERT INTO Submission(SubmissionBody) VALUES ('$TheWrittenSubmission')";
    executeInsertQuery($query);
    echo "Class Added! (Click show courses to view)";
    dbDisconnect($DBConnection); 
}