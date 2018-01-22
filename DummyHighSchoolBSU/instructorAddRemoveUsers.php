<?php
require_once ("phpCommon/dbConnExec.php");
require_once ("phpCommon/sql.php");
require_once ("phpCommon/siteCommon.php");
session_start();

displayPageHeader("List Assignments");
$arrayCount2 = 0;
$studentsInClass = array();


session_start();
if(!isset($_SESSION["courseID"]))
{
    $_SESSION["courseID"] = $_GET['CourseSectionID'];

    $_SESSION['courseTitle'] = $_GET['CourseTitle'];
    $_SESSION['courseDescription'] = $_GET['CourseDescription'];
    $ThisCourseTitle = $_SESSION['courseTitle'];
}

$aUserID = $_SESSION['UserID'];
$aUserID = (int)$aUserID;
$theCourseDescription = getCourseDescriptionFromUserIDAndCourseTitle($aUserID, $_SESSION['courseTitle']);
//grab course description and place it into a session so the correct course
//description will be added to database
$aCourseDescription = array_values($theCourseDescription[0]);
$aCourseDescription = $aCourseDescription[0];
$courseID = $_SESSION["courseID"];
$_SESSION['CourseDescription'] = $aCourseDescription;
//$_SESSION['UserID'] = 1;
$assignmentList = getAssignmentList($_SESSION["courseID"]);
?>

<h1>Add or Remove Users From Course <?php echo $courseID?></h1>

<div id="currentStudentsEnrolledBox">
        <table>
            <tr>
                <td>
                    <b><u>Current Students Enrolled</u></b>
                </td>
            </tr>
            <?php
            $studentList = getStudentsByCourseTitle($courseID);
            $size = count($studentList);
            $count = 1;
            
            
            foreach ($studentList as $UserID) {
                extract($UserID);
                $UserIDList = getStudentInfoByUserID($UserID);
                foreach ($UserIDList as $User) {
                    extract($User);
                    echo "<tr><td>";
                    echo $count . ". <a href=\"instructorAssignmentDelete1.php?RemoveUser=$UserID&CourseID=$courseID\">[Remove]</a> - $FirstName $LastName</td></tr>";
                    $count++;
                    //place current students into array to compare
                    //against in showing students to add
                    $studentsInClass[$arrayCount2] = $UserID;
                    $arrayCount2++;
                }
            }
            ?>


        </table>

</div><!-- end current students enrolled box -->
    <div id="rightinner">
        <b><u>Add Students To <?php echo $_SESSION["courseID"]; ?></u></b>
        <form method="post" id="addUserForm" action="instructorAddUserToClass.php">
            <select name="selectUserID[]" multiple>
                <?php
                $nextStudentList = getStudents();
                $size2 = 1;
                $arrayCount = 0;
                $oneTimeUsersArray = array();
                foreach ($nextStudentList as $value) {
                    extract($value);
                    $UserIDList2 = getStudentInfoByUserID($UserID);
                    //find specific Users that are not in a class
                    //and list them out

                    foreach ($UserIDList2 as $User2) {
                        extract($User2);

                        //if current students in the class is not listed &
                        //if student hasnt been listed all ready, list students
                        //to be added to class
                        if (!in_array($UserID, $studentsInClass)) {
                            if (!in_array($UserID, $oneTimeUsersArray)) {
                               
                                echo "<option value='$UserID'>$FirstName $LastName</option>";
                            }
                        }
                        $oneTimeUsersArray[$arrayCount] = $UserID;
                        $arrayCount++;
                    }
                }
                ?>
                </select>
                <input value="Add Student" type="submit">

            
        </form>
        <p><i>* The Students above can be added to your course because they are not currently in this course.</i></p>
    </div><!-- end right inner -->
<a id="backToAllMainForm" href="instructorForm.php">Go Back To Main Form</a>


</div>

<?php
displayPageFooter($pageTitle);
?>