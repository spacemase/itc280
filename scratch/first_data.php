<?php
//first_data.php

$myHostName = "localhost" ;
$myUserName = "mjense11" ;
$myPassword = "foo" ;
$myDatabase = "mjense11" ;

$selSQL = "select * from tblCustomers" ;
$myConn = mysql_connect( $myHostName, $myUserName, $myPassword ) ;
mysql_select_db( $myDatabase, $myConn ) ;
$result = mysql_query( $selSQL, $myConn ) ;

while( $row = mysql_fetch_assoc( $result ) )
{
	echo "First Name:  " . $row["FirstName"] . "<br />" ;
}

mysql_close( $myConn ) ;

//var_dump( $result ) ;
//die() ;
?>
