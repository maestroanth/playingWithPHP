<?php

require_once ("phpCommon/dbConnExec.php");
require_once ("phpCommon/sql.php");
require_once ("phpCommon/siteCommon.php");
session_start();

displayPageHeader("List Assignments");

?>

            <div id="leftcontent">
                <div id="navBox">
                    Course Information <br>
                    Assignments
                </div>
            </div>
            <div id="rightcontent">
            <!-- ALL BODY CONTENT GOES HERE -->
                
            Assignment Page<br><br>
                    Professor Add Assignment Form<br><br>
            <form action="assignments1.php" name="loginform" id="loginform" method="post">

            <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />

    <label for="assignmentTitle">Assignment Title: </label>
    <input type="text" name="assignmentTitle" id ="assignmentTitle" maxlength="50" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="Assignment title is invalid."/><br><br>
   <label for="assignmentInstructions">Assignment Instructions: </label> 
   <input type="text" name="assignmentInstructions" id="assignmentInstructions" maxlength="50" required="required" pattern="^[\w@\.-]+$" title="Assignment instruction is invalid." /><br><br>
   <label for="assignmentDate">Assignment Due Date: </label> 
   <input type="datetime" name="assignmentDate" id="assignmentDate" maxlength="50" required="required" pattern="^[\w@\.-]+$" title="Assignment instruction is invalid." />
   
   <p>
         <input type="submit" value="Login" name="login" /> <br />
      </p>

</form>        
                </div>
        </div>


    </section>
    

</body>
</html>