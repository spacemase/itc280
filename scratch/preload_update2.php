<?php
//preload_update2.php
//Works with preload2.php to update  or add users data, redirects to first_table3.php to show table

ob_start(); //prevents header errors
$myDebug = 1; //myDebug=1 shows developer/user errors!
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';
#include("include/utilINC1.php");  //required for redirect/myerror
#include("include/connINC.php"); //creates connection variable: $myConn
$myConn = conn() ;
$redPage = "first_table3.php";  //main table page, for redirection

//-----------------------------------------------------------
if (isset($_POST['id'])) //isset determines if var has valid contents
{//page relies upon valid ID
   $myID = strip_tags(trim($_POST['id']));  //strip hacker bits, trim white space
   if(!is_numeric($myID)){myRedirect($redPage);} //if not a number, redirect
}else{ 
	myRedirect($redPage);
}
$myTable = strip_tags(trim($_POST['tbl']));
$idField = strip_tags(trim($_POST['idField']));
$nStr = ""; //declare ahead
$vStr = "";
 foreach($_POST as $varName=> $value)
 {
    switch($varName)
    {
     case "idField":  //do nothing for these
     case "id":
     case "tbl":
     case "nw":
     break;
     default:   //put data into variable for edit
         $strTest = substr($varName,0,1);  //check first char for *
         if($strTest != "*") //do NOT test asterisk
         {
	         $testType = "*" . $varName;
	         $testTypeValue = (trim($_POST[$testType]));
             switch ($testTypeValue)
             {
             case "string":
             case "text":
             case "blob":
             case "date":
             case "time":
             case "timestamp":
             case "datetime":
                  $value = addslashes($value);
                  if($myID==0)
                  {//add SQL
	                $nStr .= $varName . ", ";
                    $vStr .= "'" .$value . "', ";
                  }else{//update SQL
	              	$nStr .= $varName . " = '" . $value . "', ";
	              }
                  break;
             default:
             	  if($myID==0)
                  {//add SQL
	                $nStr .= $varName . ", ";
                     $vStr .= $value . ", ";
                  }else{//update SQL
	              	$nStr .= $varName . " = " . $value . ", ";
	              }
                  
             }
         }
    }
 }
if($myID==0)
{//add SQL
	$nStr = substr($nStr,0,strlen($nStr)- 2); //trim last comma, space
	$vStr = substr($vStr,0,strlen($vStr)- 2);
	$theSQL = "insert into " . $myTable . " (" . $nStr . ") values (" . $vStr . ")"; 
}else{//update SQL
	$theSQL = substr($nStr,0,strlen($nStr)- 2);
	$theSQL = "update " . $myTable . " set " . $theSQL . " where " . $idField . " = " . $myID; 
}
@mysql_query($theSQL,$myConn) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error()));
@mysql_close() or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //close connection to db
myRedirect($redPage);
ob_flush();
?>
