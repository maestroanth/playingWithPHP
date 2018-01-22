<?php

include 'abstractClass.php';
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 1/21/2018
 * Time: 5:15 PM
 */

$class1 = new ConcreteClass1;
$class1->printOut();
echo $class1->prefixValue('FOO_') ."\n";

$class2 = new ConcreteClass2;
$class2->printOut();
echo $class2->prefixValue('FOO_') ."\n";
?>