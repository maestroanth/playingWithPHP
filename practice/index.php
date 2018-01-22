
<?php

/*
 *
 * This was to refamiliarize myself with DB querying and output buffering
 *
 */
include 'DB/dbconn.php';
include 'DB/queries.php';


$con = OpenCon();
ob_start();//can use a callback function as a parameter to sanitize string (use str_replace(regexpression))
$result = mysqli_query($con, getAll());
var_dump($result);
echo "<br>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["description"]. "<br>";
    }
} else {
    echo "0 results";
}



?>

<html>
<body>
<p>Connected Successfully</p>
</body>
</html>

<?php

$output = ob_get_contents();
ob_end_clean(); //if this isn't discarded output will STILL be rendered to the browser even without echoing, so it's important to save it first in the $output variable
echo $output;

//$output = ob_get_clean();  // stores buffer content into variable and turns off buffering ob_get_contents() and ob_end_clean() in one

CloseCon($con);

?>

<?php //HTML caching
/*
	// define the path and name of cached file
	$cachefile = 'cached-files/'.date('M-d-Y').'.php';
	// define how long we want to keep the file in seconds. I set mine to 5 hours.
	$cachetime = 18000;
	// Check if the cached file is still fresh. If it is, serve it up and exit.
	if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
        include($cachefile);
        exit;
    }
	// if there is either no file OR the file to too old, render the page and capture the HTML.
	ob_start();
?>
<html>
output all your html here.
</html>
<?php
// We're done! Save the cached content to a file
$fp = fopen($cachefile, 'w');
fwrite($fp, ob_get_contents());
fclose($fp);
// finally send browser output
ob_end_flush();
*/


/*
 * Things to remember
 * php is passed by value
 * pass by reference can be down with the &$somvar
 * also the global and static keywords provide similar functionality
 *
 *
 *
 * Scope ex.
 * <?php
$x = 5;
$y = 10;

function myTest() {
    global $x, $y; //w/o global will cause an undefined error here
    $y = $x + $y;
}

myTest();
echo $y; // outputs 15
?>
 */

?>
