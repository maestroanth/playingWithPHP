<?php
session_start();
require_once ("phpCommon/dbConnExec.php");
//require_once ("phpCommon/sql.php");
require_once ("phpCommon/sql1.php");
require_once ("phpCommon/siteCommon.php");

displayPageHeader("List Assignments");
$_SESSION['UserType'];
$_SESSION['theCourseTitle'] = $_GET['theCourseTitle'];
//echo "<br><br><b>courseTitle </b>= ".$_SESSION['theCourseTitle'];
?>
    <!--<h1>List of Assignments for this Course</h1> -->
    <h1>List of all the Assignments for this Course <i><?php echo $_SESSION['theCourseTitle']; ?></i></h1> 
    
<?php
//echo $_SESSION['theCourseTitle'];
$count = 1;
$courseSectionIDs = getCourseSectionIDs($_SESSION['theCourseTitle']);


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
        if ($_SESSION['UserType'] == 2) {
            $output .= <<<HTML


            <a href="studentSubmitUpdate.php?SubmitUpdate=$AssignmentID">[Submit/Update Assignment]</a>
 
     </div>
HTML;
        }
        $count++;
    }
}
echo $output;
?>
    <br><br>
<?php
displayPageFooter();
?>

            
       
       
       
       
       
       
       
       
       
                          