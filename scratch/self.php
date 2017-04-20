<?php

print basename( $_SERVER["PHP_SELF"] ) . "<br />" ;

switch( basename( $_SERVER["PHP_SELF"] ) )
{
	case "aboutus.php":
	$myImg = "aboutus.jpg" ;
	$myTitle = "It's all about us!" ;
	$myColor = "green" ;

	case "links.php":
	$myImg = "links.jpg" ;
	$myTitle = "Here are our links." ;
	$myColor = "orange" ;

	default:
	$myImg = "main.jpg" ;
	$myTitle = "Welcome to our website!" ;
	$myColor = "blue" ;
}//end switch

echo "myImg: " . $myImg . "<br />" ;
echo "myTitle: " . $myTitle . "<br />" ;
echo "myColor: " . $myColor . "<br />" ;

?>
