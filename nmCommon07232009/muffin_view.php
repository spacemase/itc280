<?php
/**
 * muffin_view.php along with muffin_list.php provides a sample web application
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

// check variable of item passed in - if invalid data, forcibly redirect back to muffin_list.php page
if ( isset( $_GET['id'] ) )
{
  $myID = intval( $_GET['id'] ) ; # convert to integer, will equate to zero if fails
  if ( $myID < 1 ) { myRedirect( 'muffin_list.php' ) ; }
}
else
{
  myRedirect( 'muffin_list.php') ;
}

// sql statement to select individual item
$selSQL = "select MuffinName, Description, Price from tblMuffins where MuffinID = " . $myID ;
require_once INCLUDE_PATH . 'header_inc.php' ;
?>

<h3 align="center">muffin_view.php</h3>
<p align="center">This page, along with muffin_list.php, demonstrates a List/View web application.</p>

<?php
// create connection to MySQL
$myConn = conn() ;

// $result stores virtual table in memory
$result = mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;

if ( mysql_num_rows( $result ) > 0 ) # at least one record!
{ //place results into variables
  while ( $row = mysql_fetch_assoc( $result ) )
  {
    $MuffinName = dbOut( $row['MuffinName'] ) ;
    $Description = dbOut( $row['Description'] ) ;
    $Price = dbOut( $row['Price'] ) ;
  }
?>

<h1 align=center><font color="red"><?php print $MuffinName; ?></font></h1></div>
<div align=center><a href="muffin_list.php">More Muffins!</a></div>
<table align=center>
  <tr>
    <td><img src="../images/m<?php echo $myID; ?>.jpg" /></td>
    <td><h2><b>Muffin: <font color="blue"><?php echo $MuffinName; ?></font><b></h2></td>
  </tr>
  <tr>
    <td colspan="2">
      <blockquote><?php echo $Description; ?></blockquote>
    </td>
  </tr>
  <tr>
    <td align="center" colspan="2">
      <h3><i>ONLY!!:</i> <font color="red">$<?php echo $Price; ?></font></h3>
    </td>
  </tr>
</table>

<?
}
else
{ //no records
  echo '<div align="center">What! No such muffin? There must be a mistake!!</div>' ;
  echo '<div align="center"><a href="muffin_list.php">Another Muffin?</a></div>' ;
}

@mysql_free_result( $result ) ; # clears resources
@mysql_close( $myConn ) ; # close db connection

require_once INCLUDE_PATH . 'footer_inc.php' ;
?>
