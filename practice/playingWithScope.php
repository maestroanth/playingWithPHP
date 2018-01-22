<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 1/21/2018
 * Time: 8:16 PM
 */

function foo(&$var)
{
    $var++;
}

function foo2($var)
{
    $var++;
}

function foo3()
{

    global $c;
    $c++;
}

function foo4()
{
    $GLOBALS['d']++;
}

$a=5;
$b=5;
$c=5;
$d=5;

foo($a);
echo $a . ": was passed by value <br>";

foo2($b);
echo $b . ": was passed by reference so not incremented (globally that is) <br>";

foo3($c);
echo $c . ": nothing passed but uses global keyword <br>";

foo4($d);
echo $d . ": nothing passed but using super-global array <br>";


// $a is 6 here
?>