<?php
require_once ("phpCommon/sql.php");
require_once ("phpCommon/siteCommon.php");
session_start();
displayPageHeader("Instructor Access - Edit An Assignment");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$editmode = false;
$thisCourseSectionID = getCourseSectionIDFromUserIDAndCourseTitle((int) $_SESSION['UserID'],$_GET['TheCourseTitle']);

if ((isset($_GET['AssignmentID'])) && (is_numeric($_GET['AssignmentID'])))
{
    // get the details for the movie to be edited
    
    $assignmentdetails = getAssignmentDetailsByID((int)$_GET['AssignmentID']);
    
    // if movie details are returned for the filmid, set $editmode to true
    
    $editmode = (count($assignmentdetails) == 1);
}

// if mode is $editmode is true

if ($editmode)
{
   extract($assignmentdetails[0]);

    $AssignmentDueDate = date_format(new DateTime($AssignmentDueDate), 'm/d/Y');

    $formtitle = 'Update an Assignment';
    $buttontext = 'Update';
 }
else  //otherwise, set the column variables to ""
{
    $AssignmentTitle = '';
    $AssignmentType = '';
    $AssignmentInstructions = '';
    $AssignmentDueDate = '';

    $formtitle = 'Add an Assignment';
    $buttontext = 'Insert';
}

?>
<h1>
    <?php echo $formtitle; ?>
</h1>


<div id="addEditAssignmentBox">
<form name ="addEditForm" id="addEditForm" action="instructorAssignmentEdit1a.php" method="post">
    <div>
    <?php
    if ($editmode)  //put the AssignmentID in a hidden field
    {
        echo '<input type="hidden" name="AssignmentID" value="' . $AssignmentID . '" />';
    }
?>
    
    <label class="title" for="AssignmentTitle">Assignment Title:</label>   
    <input class="title" type="text" name="AssignmentTitle"  maxlength="100" value="<?php echo $AssignmentTitle; ?>" autofocus="autofocus" required="required" pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Assignment title has invalid characters" />
   <br></br>
   <label class="type" for="AssignmentType">Assignment Type: </label>         
       <?php 
       
       $assignmentTypeList = getAssignmentType();
       $count = count($assignmentTypeList);
       
       echo '<select class="type" name="AssignmentType" id="AssignmentType">';
       foreach ($assignmentTypeList as $theAssgnmentType) {
           extract($theAssgnmentType);
                          $output .= <<<HTML
                        <option value="$AssignmentType">$AssignmentType</option>
HTML;
       }
       
       echo $output;
       ?>
       
   </select>
   <br></br>
   <label class="instructions" for="AssignmentInstructions">Assignment Instructions:</label>
   <input class="instructions" type="text" name="AssignmentInstructions" maxlength="100" value="<?php echo $AssignmentInstructions; ?>" required="required" pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Tag line has invalid characters" />
   <br></br>
   <label class="duedate" for="AssignmentDueDate">Assignment Due Date: (mm/dd/yyyy)</label>
   <input class="duedate" type="text" name="AssignmentDueDate" maxlength="10" value="<?php echo $AssignmentDueDate; ?>" required="required" pattern="%\A(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d\z%" title="Invalid Characters" /> 
   <?php 
//   $dt=$_POST['$AssignmentDueDate'];
////$dt="02/28/2007";
//$arr=split("/",$dt); // splitting the array
//$mm=$arr[0]; // first element of the array is month
//$dd=$arr[1]; // second element is date
//$yy=$arr[2]; // third element is year
//If(!checkdate($mm,$dd,$yy)){
//echo "invalid date";
//}
?>
      </div>
     <center><input id="submitButton" type="submit" value="<?php echo $buttontext ?>" /></center>
     <div id="link1"><a id="backToAllLinks" href="instructorAssignmentList.php">Go Back To All Assignments</a></div>
     <div id="link2"><a id="backToAllMainForm" href="instructorForm.php">Go Back To Main Form</a></div>
</div><!-- end of enclosing div -->

</form>

    <?php
    displayPageFooter()
    ?>