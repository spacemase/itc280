<?php
/**
 * muffin_view_pager.php along with muffin_list_pager.php provides a sample web application
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 2.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see muffin_list_pager.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$PageTitle = 'So Many Muffins, So Little Time!' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;

// check variable of item passed in - if invalid data, forcibly redirect back to muffin_list.php page
if ( isset( $_GET['id'] ) )
{
  $myID = intval( $_GET['id'] ) ; # convert to integer, will equate to zero if fails
  if ( $myID < 1 ) { myRedirect( 'muffin_list_pager.php' ) ; }
}
else
{
  myRedirect( 'muffin_list_pager.php' ) ;
}

//sql statement to select individual item
$selSQL = "select MuffinName, Description, Price from tblMuffins where MuffinID = " . $myID ;

require_once INCLUDE_PATH . 'header_inc.php' ;
?>

<h3 align="center">muffin_view_pager.php</h3>
<p align="center">This page, along with muffin_list_pager.php, demonstrates a List/View web application.</p>
<p align="center">This page is virtually the same as the previous muffin 'view' page, and is only different in that it links to the 'pager' list page.</p>

<?php
$myConn = conn() ;

// $result stores virtual table in memory
$result = mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;

if ( mysql_num_rows( $result ) > 0 ) # at least one record!
{ // place results into variables
  while ( $row = mysql_fetch_assoc( $result ) )
  {
    $MuffinName = dbOut( $row['MuffinName'] ) ;
    $Description = dbOut( $row['Description'] ) ;
    $Price = dbOut( $row['Price'] ) ;
  }
?>

<h1 align=center><font color="red"><?php print $MuffinName; ?></font></h1></div>
<div align=center><a href="muffin_list_pager.php">More Muffins!</a></div>
<table align=center>
  <tr>
    <td><img src="../upload/m<?php echo $myID; ?>.jpg" /></td>
    <td><h2><strong>Muffin: <font color="blue"><?php echo $MuffinName; ?></font></strong></h2><br />

<?php
  startSession() ; # wrapper for session_start()
  if ( isset( $_SESSION['AdminID'] ) )
  { print '<div align="center"><a href="upload_form.php?' . $_SERVER['QUERY_STRING'] . '">UPLOAD IMAGE</a></div>' ; }
  if ( isset( $_GET['msg'] ) )
  {
    $msgSeconds = (int)$_GET['msg'] ;
    $currSeconds = time() ;
    if ( ($msgSeconds + 2) > $currSeconds )
    { // link only visible once, due to time comparison of qstring data to current timestamp
      print '<div align="center"><script type="text/javascript">' ;
      print 'document.write("<form><input type=button value=\'IMAGE UPLOADED! CLICK TO VIEW!\' ' ;
      print 'onClick=history.go()></form>")</script></div>' ;
    }
  }
?>

    </td>
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

<?php
}
else
{ // no records
  echo '<div align="center">What! No such muffin? There must be a mistake!!</div>' ;
  echo '<div align="center"><a href="muffin_list_pager.php">Another Muffin?</a></div>' ;
}

@mysql_free_result( $result ) ; # clears resources
@mysql_close( $myConn ) ; # close db connection

require_once INCLUDE_PATH . 'footer_inc.php' ;
?>
