<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 1/21/2018
 * Time: 12:17 PM
 */

require_once 'DB/dbconn.php';

//Fun thing to try: set each function as an interface and then rewrite each function in each interfaces namespace for different DB functionality (example below)

function getAll()
{
    $query = <<<STR
    SELECT *
    FROM users
STR;

    return $query;
}

function addUser($username, $password, $description)
{
    $query = <<<STR
    INSERT INTO users(username, password, description)
    VALUES ('$username', '$password', '$description');
STR;

    return $query;
}

/**
 *
 * function getWhatever($parameterToMatch)
{
$query = <<<STR
SELECT *
FROM users
WHERE CourseSectionID=$parameterToMatch
STR;

return executeQuery($query);
}
 *
 *
 *
 *
/*
 * Something Cool on Stack Overflow
 *
 * It seems like many contributors are missing the point of using an INTERFACE. An INTERFACE is not specifically provided for abstraction. That's what a CLASS is used for. Most examples in this article of interfaces could be achieved just as easily using just classes alone.

An INTERFACE is provided so you can describe a set of functions and then hide the final implementation of those functions in an implementing class. This allows you to change the IMPLEMENTATION of those functions without changing how you use it.

For example: I have a database. I want to write a class that accesses the data in my database. I define an interface like this:

interface Database {
public function listOrders();
public function addOrder();
public function removeOrder();
...
}

Then let's say we start out using a MySQL database. So we write a class to access the MySQL database:

class MySqlDatabase implements Database {
function listOrders() {...
}
we write these methods as needed to get to the MySQL database tables. Then you can write your controller to use the interface as such:

$database = new MySqlDatabase();
foreach ($database->listOrders() as $order) {

Then let's say we decide to migrate to an Oracle database. We could write another class to get to the Oracle database as such:

class OracleDatabase implements Database {
public function listOrders() {...
}

Then - to switch our application to use the Oracle database instead of the MySQL database we only have to change ONE LINE of code:

$database = new OracleDatabase();

all other lines of code, such as:

foreach ($database->listOrders() as $order) {

will remain unchanged. The point is - the INTERFACE describes the methods that we need to access our database. It does NOT describe in any way HOW we achieve that. That's what the IMPLEMENTing class does. We can IMPLEMENT this interface as many times as we need in as many different ways as we need. We can then switch between implementations of the interface without impact to our code because the interface defines how we will use it regardless of how it actually works.
 *
 */
 *
 */
?>