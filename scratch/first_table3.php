<?php
//first_table3.php, adds delete function
//This version adds link to preload2.php, form for add/update
//Also works with preload_update2.php to execute add/update SQL
$myDebug = 1; //myDebug=1 shows developer/user errors!
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';
$myTable = "mjense11.tblCustomers";  //change to match your db/table
#include("include/utilINC1.php");  //required for redirect/myerror
#include("include/connINC.php"); //creates connection variable: $myConn
$myConn = conn() ;

//-----------------------------------------------------------

if(isset($_POST['delex']))
{
   $myID = (trim($_POST['Delete']));
   $idField = (trim($_POST['idField']));
   $delSQL = "delete from " . $myTable . " where " . $idField . " = " . $myID;
   @mysql_query($delSQL,$myConn) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); 
}
unset($_POST['delex']);
unset($_POST['Delete']);
unset($_POST['idField']);
$selSQL = "select * from " . $myTable;

//$myResult stores data in an array in memory
$myData = @mysql_query($selSQL,$myConn) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); 
$numColumns = @mysql_num_fields($myData) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); 
?>
<html>
<head>
<script language="JavaScript">
 function confirmDelete()
 {
    var agree=confirm("Are you sure you wish to delete this record?");
    if(agree)
    {
       return true;
    }else{
       return false;
    }
 }
</script>
</head>
<body>
<form name="deleteForm" action="<?=$_SERVER['PHP_SELF']?>" method="post" onSubmit="return confirmDelete()">
<div align=center><h1><?=$myTable?></h1></div>
<table border="1" align="center"><tr>
<?
for($x = 0; $x < $numColumns; $x++)
{
  //grab the name of each field
  $fieldName = mysql_field_name($myData,$x);
  
  if($x==0){$idField = $fieldName;} //grab first field for update qstring / delete
  
  //print out field names
  print "<th>" . $fieldName . "</th>";
}
print "</tr>";
while($row = mysql_fetch_row($myData))
{  //pull data from db array
   print "<tr>";
   for($x = 0; $x < $numColumns; $x++)
   { //print out data
	 if($x == 0)
	 {//create update link for primary key
		print '<td><a href="preload2.php?id=' . $row[$x] . '&tbl=' . $myTable . '&fld=' . $idField . '"><b>' . $row[$x] . '</b> (Edit)</a>';
		print '<input type="radio" name="Delete" value="' . $row[$x] . '"><font color="red"><b>Delete</b></font></td>';
	 }else{ //Just Show Data
		if(strLen($row[$x]) > 30)
		 {//show shortened version of long data string
		     $tmp = substr(stripslashes($row[$x]),0,28) . "...";
		     print "<td>" . $tmp . "</td>";
		 }else{
			 print "<td>" . stripslashes($row[$x]) . "</td>";
		 }
	 }
   }
   print "</tr>";
}

print '<input type="hidden" name="delex" value="delex" />';
print '<input type="hidden" name="idField" value="' . $idField . '" />';
print '<tr><td align=center><input type="submit" value="Delete Checked"></td>';
print '<td align="center" colspan="' . $numColumns . '"><a href="preload2.php?nw=y&fld=' . $idField . '&tbl=' . $myTable . '">Add New Record</a></td>';
@mysql_free_result($myData) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //clears resources
@mysql_close() or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //close connection to db
?>
</tr></table></form>
</body>
</html>

