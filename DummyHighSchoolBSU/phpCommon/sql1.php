<?php

/* 
 * SQL statements for running all statements in the website
 */

require_once 'phpCommon/dbConnExec.php';

function getClasses()
{
    $query = <<<STR
Select CourseSectionID, CourseTitle, CourseDescription
from CourseSection
Order by CourseSectionID
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

function getClassesByID($UserID)

{
    
   $query = <<<STR
Select CourseSectionID, CourseTitle, CourseDescription 
from CourseSection
where UserID = $UserID
STR;
    
    return executeQuery($query);
    
}

function getClassName($CourseTitle, $UserID)

{
    $query = <<<STR
    Select CourseTitle
    from CourseSection
    where CourseTitle like '%$CourseTitle%' and UserID = $UserID
STR;
    
    return executeQuery($query);
    
}
function getClassName1($CourseTitle, $CourseDescription)

{
    $query = <<<STR
    Select CourseTitle, CourseDescription
    from CourseSection
    where CourseTitle like '%$CourseTitle%' AND CourseDescription like '%$CourseDescription%' 
STR;
    
    return executeQuery($query);
    
}
//function getAssignmentList($UserID, $CourseSectionID)
//{
//    $query = <<<STR
//    Select AssignmentTitle, AssignmentInstructions, AssignmentDueDate
//    from CourseSection, Assignments
//    where CourseSectionID like '%$CourseSectionID' and UserID = $UserID
//STR;
//    return executeQuery($query); 
//}
function getNewList($UserID)

{
    $query = <<<STR
    Select AssignmentTitle 
    from CourseSection, Assignments
    where UserID = $UserID
STR;
    
    return executeQuery($query);
    
}
function getAssignmentList($CourseSectionID)
{
    $query = <<<STR
SELECT AssignmentID, AssignmentTitle, AssignmentInstructions, AssignmentDueDate, AssignmentType 
FROM Assignments
WHERE CourseSectionID = $CourseSectionID
ORDER by AssignmentTitle
STR;
    
    return executeQuery($query);
}
function getAssignmentList1($AssignmentTitle)
{
    $query = <<<STR
SELECT AssignmentID, AssignmentTitle, AssignmentInstructions, AssignmentDueDate, AssignmentType 
FROM Assignments
WHERE AssignmentTitle like '$AssignmentTitle'

STR;
    
    return executeQuery($query);
}
?>
