<?php
if( isset( $_POST["tires"] ) )
{//post data coming in
	echo "You entered: " . $_POST["tires"] . "<br />" ;
	echo "<a href=\"post_back1.php\">RESET</a>" ;
}
else
{

?>
<html>
<head></head>
<body>

<form action="post_back1.php" method="post">
Please enter how many tires you want? <input type="text" name="tires" /><br />
<input type="submit" Value="Show Me the Tires!"/>

</form>
</body>
</html>
<?php } ?>