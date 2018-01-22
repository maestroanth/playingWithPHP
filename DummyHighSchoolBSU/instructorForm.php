<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once 'phpCommon/dbConnExec.php';
//require_once 'logout.php';
//require_once 'courseInformation.php';
require_once 'phpCommon/siteCommon.php';
require_once 'instructorEditCourseForm.php';
require_once 'login.php';
function showInstructorForm()
{
    //header('Refresh: 0; URL=login.php');
    $tempUserID = (int) $_SESSION['UserID'];
    $_SESSION["courseID"] = NULL;
    $_SESSION['courseTitle'] = NULL;
    $_SESSION['courseDescription'] = NULL;
     $output = <<<HTML
        
HTML;
        $query = "SELECT CourseSectionID, CourseTitle, CourseDescription FROM CourseSection WHERE UserID = '$tempUserID' ORDER BY CourseTitle"; //gets all records from CourseSection
        $response = executeQuery($query); //or die(mysql_error());//showed 
        if ($response)//this is in table format atm in case we decide different how to display it
        {               
            
            $output .= <<<HTML
           
            <h2> Your BSU Class List </h2>


HTML;
            foreach ($response as $record)
             {
                
                $recordOutput = $record['CourseTitle'];
                $recordCourseSectionID = $record['CourseSectionID'];
                $recordCourseDescription = $record['CourseDescription'];
                
                $output .= <<<HTML
                                                                <div id="instructorDiv">

               
                <h3> </h3>
                <h3>$recordOutput </h3>
                        <p><i>Course Description: </i> $recordCourseDescription</p>
                <p><a href="instructorAssignmentList.php?CourseSectionID=$recordCourseSectionID&CourseTitle=$recordOutput"&CourseDescription=$recordCourseDescription>[Add/Edit/Cancel Assignment]</a>
                <a href="instructorAddRemoveUsers.php?CourseSectionID=$recordCourseSectionID&CourseTitle=$recordOutput"&CourseDescription=$recordCourseDescription>[Add/Remove User to Section]</a>
                <a href="instructorEditCourseForm.php?CourseSectionID=$recordCourseSectionID&CourseTitle=$recordOutput&CourseDescription=$recordCourseDescription">[Edit Course Description]</a></p>
                         </div>
HTML;
             }
        }
        else 
        { 
            echo "Couldn't retrieve class list!";    
        }
    $output .= <<<HTML
           
        <h3><center><a href="instructorCreateCourse.php">Create New Course</a> </center></h3>    

           
HTML;
   
    echo $output;

 }

