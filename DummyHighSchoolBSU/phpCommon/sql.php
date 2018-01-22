<?php

/* 
 * SQL statements for running all statements in the website
 */

require_once 'phpCommon/dbConnExec.php';


function getAssignmentList($CourseSectionID)
{
    $query = <<<STR
SELECT AssignmentID, AssignmentTitle, AssignmentInstructions 
FROM Assignments
WHERE CourseSectionID=$CourseSectionID
STR;
    
    return executeQuery($query);
}

function getCourseSectionIDs($CourseTitle) {
        $query = <<<STR
SELECT CourseSectionID 
FROM CourseSection
WHERE CourseTitle like '%$CourseTitle%' 
STR;
       return executeQuery($query);
     
}

function getClasses()
{
    $query = <<<STR
Select CourseSectionID, CourseTitle, CourseDescription
from CourseSection
Order by CourseSectionID
STR;
    return executeQuery($query);
            
}

function getAssignmentDetailsByID($AssignmentID)
{
   $query = <<<STR
Select AssignmentID, AssignmentType, AssignmentTitle, AssignmentInstructions, AssignmentDueDate
From Assignments
Where AssignmentID = $AssignmentID
STR;
    
    return executeQuery($query);
}

function getSubmissionDetailsByAssignmentID($AssignmentID) {
   $query = <<<STR
Select AssignmentID, SubmissionTitle, SubmissionBody
From Submission
Where AssignmentID = $AssignmentID
STR;

}

function updateSubmission($SubmissionID, $SubmissionTitle, $SubmissionBody) {
        $query = <<<STR
Update Submission
Set SubmissionID = '$SubmissionID', AssignmentTitle = '$SubmissionTitle', SubmissionBody = '$SubmissionBody'
Where SubmissionID = $SubmissionID
STR;

    executeQuery($query);
}

function updateAssignment($AssignmentID, $AssignmentType, $AssignmentTitle, $AssignmentInstructions, $AssignmentDueDate)
{
//    $AssignmentID = str_replace('\'', '\'\'', trim($movieTitle));
//    $AssignmentType = str_replace('\'', '\'\'', trim($pitchText));
//    $AssignmentTitle = str_replace('\'', '\'\'',trim($summary));
//    $AssignmentInstructions = trim($imageName);

    $query = <<<STR
Update Assignments
Set AssignmentType = '$AssignmentType', AssignmentTitle = '$AssignmentTitle', AssignmentInstructions = '$AssignmentInstructions', AssignmentDueDate = '$AssignmentDueDate'
Where AssignmentID = $AssignmentID
STR;

    executeQuery($query);
}

function deleteAssignment($AssignmentID)
{
    $query = <<<STR
Delete
From Assignments
Where AssignmentID = $AssignmentID
STR;

    executeQuery($query);
}

function addAssignment($CourseSectionID, $AssignmentType, $AssignmentTitle, $AssignmentInstructions, $AssignmentDueDate)
{
    // escape single quotes within the string (e.g., "Schindler's List" is escaped as "Schindler''s List" 
    
//    $movieTitle = str_replace('\'', '\'\'', trim($movieTitle));
//    $pitchText = str_replace('\'', '\'\'', trim($pitchText));
//    $summary = str_replace('\'', '\'\'',trim($summary));
//    $imageName = trim($imageName);
    
    $query = <<<STR
Insert Into Assignments(CourseSectionID,AssignmentType,AssignmentTitle,AssignmentInstructions,AssignmentDueDate)
Values('$CourseSectionID','$AssignmentType','$AssignmentTitle','$AssignmentInstructions','$AssignmentDueDate')
STR;

    executeQuery($query);
}

function addSubmission($AssignmentID, $UserID, $SubmissionTitle, $SubmissionBody) {
        $query = <<<STR
Insert Into Submission(AssignmentID,UserID,SubmissionTitle,SubmissionBody)
Values('$AssignmentID','$UserID','$SubmissionTitle','$SubmissionBody')
STR;

    executeQuery($query); 
}

function getAssignmentType()
{
    $query = <<<STR
Select AssignmentType
From AssignmentType
Order by AssignmentType
STR;

    return executeQuery($query);
}

function getStudentsByCourseTitle($CourseTitle)
{
   $query = <<<STR
Select UserID
From CourseSection
Where CourseTitle = '$CourseTitle'
STR;
    
    return executeQuery($query);
 
}

function getStudentInfoByUserID($UserID)
{
   $query = <<<STR
Select FirstName, LastName 
From [User] 
Where UserID = '$UserID'
AND UserType like 2
STR;
    
    return executeQuery($query);
 
}

function getNameHeader($UserID)
{
   $query = <<<STR
Select FirstName, LastName, UserType
From [User]
Where UserID=$UserID 
STR;
    
    return executeQuery($query);
 
}


function getStudentsNotByCourseTitle($CourseTitle)
{
   $query = <<<STR
Select UserID
From CourseSection
Where CourseTitle NOT LIKE '%$CourseTitle%'
STR;
    
    return executeQuery($query);
 
}

function getStudents() {
       $query = <<<STR
Select UserID
From [User]
Where UserType = 2
STR;
     return executeQuery($query);
   
}

function removeUserFromClass($UserID, $CourseSection) {
       $query = <<<STR
Delete From CourseSection
Where CourseTitle like '%$CourseSection%'
And UserID = '$UserID'               
STR;
    
    return executeQuery($query);
}

function addUserToClass($UserID, $CourseSection, $CourseDescription) {
       $query = <<<STR
Insert Into CourseSection (UserID,CourseTitle,CourseDescription)
Values ($UserID,'$CourseSection','$CourseDescription')
STR;
    
    return executeQuery($query);
}

function getCourseSectionIDFromUserIDAndCourseTitle($UserID, $CourseTitle) {
          $query = <<<STR
Select CourseSectionID
From CourseSection
Where UserID='$UserID' AND CourseTitle='$CourseTitle'
STR;
    
    return executeQuery($query);
 
}

function getCourseDescriptionFromUserIDAndCourseTitle($UserID,$CourseTitle) {
              $query = <<<STR
Select CourseDescription
From CourseSection
Where UserID='$UserID' AND CourseTitle='$CourseTitle'
STR;
    
    return executeQuery($query);
}




?>
