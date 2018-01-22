<?php
session_start();
require_once ("phpCommon/sql.php");
require_once ("phpCommon/dbConnExec.php");
require_once ("phpCommon/siteCommon.php");

if (isset($_POST['SubmissionID']))
{
    updateSubmission((int)$_POST['SubmissionID'], $_POST['SubmissiontTitle'], $_POST['SubmissionBody']);
}
else //call the add method
{
    addSubmission($_POST["AssignmentID"], (int) $_SESSION['UserID'], $_POST['SubmissionTitle'], $_POST['SubmissionBody']);
}
echo "Submission Complete: Redirecting back to Home Page";

header("Refresh: 2; URL=login.php");
exit;
displayPageFooter();
?>