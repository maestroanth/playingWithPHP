<?php
session_start();
$_SESSION['UserID'];
require_once ("phpCommon/dbConnExec.php");
require_once ("phpCommon/sql1.php");
require_once ("phpCommon/siteCommon.php");
displayPageHeader("Classes");

//print_r($_SESSION['UserID']);
$CourseTitle = $_POST['CourseTitle'];
$CourseDescription = $_POST['CourseDescription'];

$heading = <<<ABC
You searched for<br />
Class Name: '$showClass' <br />
ABC;

$newclassList = getClassName1($CourseTitle, $CourseDescription);
$matchingRecords = count($newclassList);
echo "<section>";
if ($matchingRecords == 0)
{
   echo "<h3>No matches found for the search term(s)</h3>";
}
else
{   

$output = <<<ABC
<table>
   <caption>$matchingRecords Classe(s) found</caption>
   <tbody>
ABC;

    foreach ($newclassList as $list)
    {
        extract($list);
        $classNum ++;
        $output .= <<<HTML
            <div class="studentCourses">
    
            <h2>$classNum: $CourseTitle</h2>
            <p><i>Course Description:</i> $CourseDescription</p>
            </div>
HTML;
    }
    
    $output .= "<tbody></table>";
}
$output .= <<<ABC
<p style="text-align: center">
    <a href="searchClasses.php">[Back to Search Page]</a>
</p></section>
ABC;
echo $output;
?>