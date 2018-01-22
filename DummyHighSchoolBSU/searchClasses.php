<?php //
session_start();
$_SESSION['UserID'];
require_once ("phpCommon/dbConnExec.php");
require_once ("phpCommon/sql1.php");
require_once ("phpCommon/siteCommon.php");
//require_once 'login.php';
displayPageHeader("Classes");
?>
<h1>Search Classes</h1>
                        <table class="assignmentTable">
           <?php
    $count = 1;
echo $output;
           ?>
            </table>    
            <br><br>
<?php
// get the ratings from the FilmRating table
//print_r($_SESSION['CourseTitle']);
//$sGender = getActors();
?>
<section>
<form action="showClasses.php" method = "post" name="SearchByMultiCriteria" id="SearchByMultiCriteria">
   <label for="CourseTitle">Course Title:</label>
   <input type="number" name="CourseTitle" id="CourseTitle" maxlength="50" />
   <label for="CourseDescription">Course Description:</label>
   <input type="text" name="CourseDescription" id="CourseDescription" maxlength="50" />
   <option value=""></option>
          
      
   <p>
      <input name = "submit" type="submit" value="Search" />
   </p>      

</form>
</section>
<?php
if ($_POST['submit'] == "Search")
{
    if ($_POST['writtenSubmission'] == "")
        {
            echo "<br>Please don't leave the Course Title as blank</br>";
        }
}
displayPageFooter("Classes");
?>