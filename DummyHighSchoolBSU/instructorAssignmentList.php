<?php
session_start();
require_once ("phpCommon/dbConnExec.php");
require_once ("phpCommon/sql.php");
require_once ("phpCommon/siteCommon.php");
//require_once ("login.php");

displayPageHeader("List Assignments");
if(!isset($_SESSION["courseID"]))
{
    $_SESSION["courseID"] = $_GET['CourseSectionID'];

    $_SESSION['courseTitle'] = $_GET['CourseTitle'];
    $_SESSION['courseDescription'] = $_GET['CourseDescription'];
    //$_SESSION['UserType'] = "1";
    //$_SESSION['UserID'] = $theUserID //<--yea, don't do this, it just deleted the userID from the whole session. ;) - Anth
    $ThisCourseTitle = $_SESSION['courseTitle'];
}

//echo "<br><br><b>theuserIDis: ".$_SESSION['UserID']."</b><br>";

?>


<h1>List of Assignments for Course: <i><?php echo $_SESSION["courseTitle"]?></i> </h1>

<?php
// display each movie with links to edit or delete it

$count = 1;
$courseSectionIDs = getCourseSectionIDs($_SESSION['courseTitle']);


foreach ($courseSectionIDs as $courseSection) {
    extract($courseSection);
    $assignmentList = getAssignmentList($CourseSectionID);
 
    foreach ($assignmentList as $assignment) {
        extract($assignment);
        
        $output .= <<<HTML
           <div class="assignmentListBox">
            
            <h3>
            $count. $AssignmentTitle
            </h3>
                <p>
            <i>Assignment Instructions:</i> $AssignmentInstructions
                 </p>
                
HTML;
        if ($_SESSION['UserType'] == 1) {
            $output .= <<<HTML


            <a href="instructorAssignmentEdit1.php?AssignmentID=$AssignmentID">[Edit Assignment]</a>
 
            <a href="instructorAssignmentDelete1.php?AssignmentID=$AssignmentID">[Delete Assignment]</a>
     </div>
HTML;
        }
        $count++;
    }
}

    if ($_SESSION["UserType"] == 1) {
        $output .= <<<HTML
                <br><br>
            <a href="instructorAssignmentEdit1.php?TheCourseTitle=$ThisCourseTitle">[Add an Additional Assignemnt]</a>
HTML;
    }

echo $output;
?>

  
    <br><br>






<?php
displayPageFooter();
?>