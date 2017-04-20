<?php
//update_first.php
//Will load first name into 'value' of textbox
//works with showFirst.php & updateFirst.php'
ob_start(); //helps
$myDebug = 1; //myDebug=1 shows developer/user errors!
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
#include("include/utilINC1.php");  //required for redirect/myerror
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';

//-----------------------------------------------------------
if(isset($_POST['CustomerID'])){
        $myID = trim($_POST['CustomerID']); //Grab the Customer's unique ID, sent via a hidden form field
        $FirstName =  trim($_POST['FirstName']); //Grab the First Name typed in by the user, sent via the POST method
         if(!is_numeric($myID)){myRedirect("showFirst.php");}  //No such ID!
}else{
         myRedirect("showFirst.php");  //Requires ID to preload!
}
#include("include/connINC.php"); //connect AFTER passes qstring test
$myConn = conn();
//Create the SQL string
$updateSQL = "UPDATE mjense11.tblCustomers SET FirstName = '" . $FirstName . "' WHERE CustomerID = " . $myID;
//Update the database, myResult variable stores TRUE, if data successfully updated
$myData = @mysql_query($updateSQL,$myConn) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error()));

//myData is not a data object, no need to release resources
@mysql_close() or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //close connection to db
myRedirect("show_first.php"); //redirect to showFirst page
ob_flush();
?>
