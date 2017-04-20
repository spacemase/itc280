<?php
//header.php
switch( basename( $_SERVER["PHP_SELF"] ) )
{
	case "main.php":
	$myImg = "main.jpg" ;
	$myTitle = "Main Page" ;
	$myColor = "blue" ;
	break ;

	case "aboutus.php":
	$myImg = "aboutus.jpg" ;
	$myTitle = "About Us" ;
	$myColor = "green" ;
	break ;
	
	case "links.php":
	$myImg = "links.jpg" ;
	$myTitle = "Links" ;
	$myColor = "orange" ;
	break ;

	default:
	$myImg = "main.jpg" ;
	$myTitle = "Welcome to our website!" ;
	$myColor = "blue" ;
}//end switch
?>
<html>
<head>
<title><?php echo $myTitle;?></title>
</head>
<body bgcolor="<?php echo $myColor;?>">
<div id="content-guts">
	<h1 align="center"><?php echo $myTitle;?></h1>
	<!-- header ends here -->