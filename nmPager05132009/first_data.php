<?php
/**
 * first_data.php is a simple database page to use as a model for
 * database oriented web applications most of your site pages
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see header_inc.php
 * @see footer_inc.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$PageTitle = 'PHP First Data Page!' ;
require_once "/home/a5001834/public_html/inc_itc280/config_inc.php" ;
include_once INCLUDE_PATH . 'header_inc.php' ;
?>

<h3 align="center">First Data Page</h3>
<p>A test page to determine our connection info is correct in our application.</p>

<?php
// MySQL query
$selSQL = "select FirstName, LastName, Email from tblCustomers" ;

// create connection to MySQL
$myConn = conn() ;

// $myData stores data object in memory
$result = mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;

print '<div align="center"><h4>SQL STATEMENT: <font color="red">' . $selSQL . '</font></h4></div>' ;

while ( $row = mysql_fetch_array( $result ) )
{ // pull data from db array
  print '<p>' ;
  print 'FirstName: <b>' . $row['FirstName'] . '</b><br />' ;
  print 'LastName: <b>' . $row['LastName'] . '</b><br />' ;
  print 'Email: <b>' . $row['Email'] . '</b><br />' ;
  print '</p>' ;
}
mysql_close() ; # close connection to db

include_once INCLUDE_PATH . 'footer_inc.php' ;
?>
