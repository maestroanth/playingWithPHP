<?php
session_start();
require_once ("phpCommon/dbConnExec.php");
require_once ("phpCommon/sql1.php");
require_once ("phpCommon/siteCommon.php");
//require_once ("login.php");

displayPageHeader("Classes");
//print_r($_SESSION);
//print_r($_SESSION['CourseTitle']);
//echo $_SESSION['UserID'];
//print_r($_SESSION['UserID']);

$editmode = false;
?>

<?php
if ((isset($_SESSION['UserID']))) 
    
{
    
    
    $classList = getClassesByID((int)$_SESSION['UserID']);
    $editmode = true;
}

if ($editmode)
{
   foreach ($classList as $class)
{
    extract($class);
    $output .= <<<HTML
            <div class="studentCourses">
    
            <h2>$CourseTitle</h2>
            <p><i>Course Description:</i> $CourseDescription</p>
        
            <a href="studentAssignment.php?theCourseTitle=$CourseTitle">[View Assignments For $CourseTitle]</a>
       
            
       
     </div>
HTML;
$count++;
}
 }
else  
{
    ?>
<h1>Empty Class List</h1>
<?php
}
?>
                <h1>My Class Schedule</h1>
                        <table class="assignmentTable">
           <?php
    $count = 1;
echo $output;
           ?>
            </table>    
            <br><br>
<?php
displayPageFooter();
?>