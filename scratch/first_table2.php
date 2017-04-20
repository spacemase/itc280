<?php
//first_table2.php
//This version adds link to preload.php, form for update
//Also works with preloadUpdate.php to execute update SQL
ob_start(); //prevents header errors
$myDebug = 1; //myDebug=1 shows developer/user errors!
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';
#include("include/utilINC1.php");  //required for redirect/myerror
#include("include/connINC.php"); //creates connection variable: $myConn
$myConn = conn() ;
$myTable = "mjense11.tblCustomers";  //change to match your db/table
//-----------------------------------------------------------

$selSQL = "select * from " . $myTable;
$myData = @mysql_query($selSQL,$myConn) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); 

//get number of columns to identify how many TDs we'll need
$numColumns = @mysql_num_fields($myData) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error()));
print '<html><body>'; 
print '<h1 align="center">' . $myTable . '</h1>';  //start to show table
print '<table border="1" align="center"><tr>';

for($x = 0; $x < $numColumns; $x++)
{
  //grab the name of each field
  $fieldName = mysql_field_name($myData,$x);

  if($x==0){$idField = $fieldName;} //grab first field for update qstring
  //print out field names as table headers
  print '<th>' . $fieldName . '</th>';
}
print '</tr>';
while($row = mysql_fetch_row($myData))
{  //pull data from db array
   print '<tr>';
   for($x = 0; $x < $numColumns; $x++)
   { //print out data
     if($x == 0)
     {//create update link for primary key
        print '<td><a href="preload.php?id=' . $row[$x] . '&fld=' . $idField . '">' . $row[$x] . '</a></td>';
     }else{ //Just Show Data
        print "<td>" . stripslashes($row[$x]) . "</td>";
     }
   }
   print "</tr>";
}
@mysql_free_result($myData) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //clears resources
@mysql_close() or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //close connection to db
?>
</table>
</body>
</html>

