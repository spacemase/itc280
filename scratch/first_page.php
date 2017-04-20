<?php
//script tags can also be asp style: <% or <?php


 /*Comment code at top
   beginning and end of marker
   makes entire contents a comment
 */

?>
<html>
<title>first page</title>
<body>
<font color=red>This is via HTML!<br />
<?php
	print "<font color=blue>This is not!</font><br />" ; //note the lack of quotes, semi colon
?>
<font color=red>HTML again!</font><br />
<?php
	echo "<font color=blue>PHP again, only this time using echo!</font><br />" ; 
	//code can be interspaced with HTML
	//Cant do this with .NET!!  neither with Perl.  Can do with regular ASP 3.0
	//Note the comment code is outside the PHP script tags.  The PHP engine does not know you wanted this as a comment!
?>

<a href="second_page.php?id=123">second page</a><br />

<?php
$header = 'PHP is Easy!';
$header .= 'No its not!';
print $header;
echo "<br /><br />" ;

$header2 = 'PHP is Easy!';
$header2 = $header2 . 'No its not!';
print $header2;
echo "<br /><br />" ;
?>

</body>
</html>

