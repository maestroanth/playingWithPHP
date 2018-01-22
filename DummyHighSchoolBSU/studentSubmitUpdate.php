<?php
require_once ("phpCommon/sql.php");
require_once ("phpCommon/siteCommon.php");
session_start();
displayPageHeader("Instructor Access - Edit An Assignment");

$editmode = false;

    $newNum = $_GET['SubmitUpdate'];
    $newNum = (int)$newNum;
    

if ((isset($_GET['SubmitUpdate']))) {
       
    $submissiondetails = getSubmissionDetailsByAssignmentID($_GET['SubmitUpdate']);
    $editmode = (count($assignmentdetails) == 1);

}
if ($editmode)
{
   
   extract($submissiondetails[0]);

    $AssignmentDueDate = date_format(new DateTime($AssignmentDueDate), 'm/d/Y');

    $formtitle = 'Update a Submission';
    $buttontext = 'Update';
 }
else 
{
    $AssignmentTitle = '';
    $AssignmentType = '';
    $AssignmentInstructions = '';
    $AssignmentDueDate = '';

    $formtitle = 'Submit Assignment';
    $buttontext = 'Submit';
}

?>
<h1>
    <?php echo $formtitle; ?>
</h1>


<div id="submitUpdateBigForm">
<form name ="submitUpdateForm" id="submitUpdateForm" action="studentSubmitUpdate2.php" method="post">
    <input type="hidden" name="AssignmentID" value="<?php echo $newNum; ?>" />
    <div>
    <?php
    if ($editmode)  //put the AssignmentID in a hidden field
    {
        echo '<input type="hidden" name="SubmissionID" value="' . $SubmissionID . '" />';
    }
?>
        <link href="styles.css" rel="stylesheet" type = "text/css" /> 
        <fieldset id="customfield1">
        <h3> Submission Title</h3>
	<p> <input type ="text" name="SubmissionTitle" class = "textbox" autofocus="autofocus" required="required" pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" title="Assignment title has invalid characters"/> </p> 
        
        <h3> Written Submission</h3>
        
        <p> <input id = "submitbox" type ="text" name="SubmissionBody" maxlength = "1000" class = "textbox" /> </p> 
        </fieldset>
        <input type = "submit" name ="submit" value= "Submit"/>
	<a id="backToAllLinks" href="studentAssignment.php">Go Back To All Assignments</a> 
	

</form> 
</div>

    <?php
    if ($_POST['submit'] == "Submit")
{
    if ($_POST['SubmissionTitle'] == "")
        {
            echo "<br>You will not receive any points for a blank submission</br>";
        }
}
    displayPageFooter()
    ?>
