<html>
<body>
<?
//H = Hour in 24 hour format, i= minutes with leading zero, j=day of month with no zero, S=th, etc., F=full name of month
print date('H:i,jSF'); //No spaces, all runs together
$myDate = date('H:i, jS F'); //enter date info to a variable
print "<h1><font color=blue>At the tone the time will be ". $myDate ."</h1>"; //period is concatenator
?>
</body>
</html>
