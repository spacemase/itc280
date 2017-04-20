<?php
/**
 * muffin_list.php along with muffin_view.php provides a sample web application
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see muffin_view.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$PageTitle = 'So Many Muffins, So Little Time!' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
require_once INCLUDE_PATH . 'header_inc.php' ;
$selSQL = "select MuffinName, MuffinID, Price from tblMuffins" ;
?>

<h3 align="center">muffin_list.php</h3>
<p align="center">This page, along with muffin_view.php, demonstrates a List/View web application.</p>

<?php
// create connection to MySQL
$myConn = conn() ;

// $myData stores data object in memory
$result = mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;

if ( mysql_num_rows( $result ) > 0 ) # at least one record!
{ //show results
  while ( $row = mysql_fetch_assoc( $result ) )
  {
    echo '<div align="center"><a href="muffin_view.php?id=' . dbOut($row['MuffinID']) . '">' . dbOut($row['MuffinName']) . '</a>' ;
    echo ' <i>only</i> <font color="red">$' . dbOut( $row['Price'] ) . '</font></div>' ;
  }
}
else
{ //no records
  print '<div align="center">What!  No muffins?  There must be a mistake!!</div>' ;
}

@mysql_free_result( $result ) ; # clears resources
@mysql_close( $myConn ) ; # close db connection

require_once INCLUDE_PATH . 'footer_inc.php' ;
?>
