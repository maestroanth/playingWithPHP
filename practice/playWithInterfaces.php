<?php

// Declare the interface 'iTemplate'

//abstract classes are for when you want to use polymorphism
//interfaces are when you want to add functionality
/*
 * Abstract

Abstract Classes focus on a kind of things similarity.

People are considered of type mammal and as such would not be considered of type vehicle.

Interface

Interfaces focus on collation of similar function.

For example: You are a human being and are of type mammal. If you want to fly then you will need to implement a flying Interface.
If you want to shoot while flying, then you also need to implement the gun Interface.

There is also a good DB example of interfaces too
 */

interface iTemplate
{
    public function setVariable($name, $var);
    public function getHtml($template);
}

// Implement the interface
// This will work All methods declared in an interface must be public.
class Template implements iTemplate
{
    private $vars = array();

    public function setVariable($name, $var)
    {
        $this->vars[$name] = $var;
    }

    public function getHtml($template)
    {
        foreach($this->vars as $name => $value) {
            $template = str_replace('{' . $name . '}', $value, $template);
            //preg_replace() for reg expressions
        }

        return $template;
    }
}


$myTemplate = new Template;

$myTemplate->setVariable("Spot One", 1);
$myTemplate->setVariable("Spot Two", 2);
$myTemplate->setVariable("Spot Three", 3);

ob_start();?>
<html>
<body>
<h2>{Spot Two}</h2>
<h1>{Spot One}</h1>
<h3>{Spot Three}</h3>
</body>
</html>

<?php

$output = ob_get_contents();
ob_end_clean();
echo "Uninterpolated Template: \n";
echo $output;
echo "My Data Bound Template: \n";
$sanitizedOutput =  $myTemplate->getHtml($output);
echo $sanitizedOutput;

?>