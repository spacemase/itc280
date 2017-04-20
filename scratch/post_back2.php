<?php
if( isset( $_POST["tires"] ) )
{
	$myTires = $_POST["tires"] ;
	$myPrice = 59.99 ;
	$myTotal = $myTires * $myPrice ;
      
	echo "<h1><font color=\"blue\">You ordered " . $myTires . " tires!</font><br />" ;
	echo "<h1><font color=\"red\">Such a deal at only \$" . $myTotal . " for them all!</font><br />" ;

	unset( $_POST["tires"] ) ;
	print "<br /><a href=" . $_SERVER["PHP_SELF"] . ">Reset page</a>" ;
}
else
{
?>
<html>
<body>
<!--Note the server variable indicating the page we are on -->
<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
How many tires do you want?<input type="text" name="tires"><br />
<input type="submit" value="Show me the tires!">
</form>
</body>
</html>
<?php } ?>
