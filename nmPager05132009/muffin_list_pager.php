<?php
/**
 * muffin_list_pager.php along with muffin_view_pager.php provides a sample web application
 *
 * This page is a second version of muffin_list.php which addes the 'Pager' class.
 * The Pager class is included via a file pager_inc.php, which is referenced in config_inc.php
 * View the pager_inc.php page for  implementation details.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 2.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see pager_inc.php
 * @see muffin_view_pager.php
 * @see muffin_list_pager.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$PageTitle = 'So Many Muffins, So Little Time!' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
require_once INCLUDE_PATH . 'header_inc.php' ;
?>

<h3 align="center">muffin_list_pager.php (with Paging)</h3>
<p align="center">This page, along with muffin_view_pager.php, demonstrates a List/View web application with record paging.</p>
<p align="center">This is version 2.0 of muffin_list.php, which incorporates the Pager class to span records over multiple web pages.</p>

<?php
// SQL statement
$selSQL = "select MuffinName, MuffinID, Price from tblMuffins" ;

// create connection to MySQL
$myConn = conn() ;

// Create instance of new 'pager' class
$myPager = new Pager( 2, '', '<img src="../images/arrow_prev.gif" border="0" />', '<img src="../images/arrow_next.gif" border="0" />', '' ) ;
$selSQL = $myPager->loadSQL( $selSQL ) ;  # load SQL, add offset

// $result stores data object in memory
$result = mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;

if ( mysql_num_rows( $result ) > 0 ) # at least one record!
{ //show results
  print '<div align="center">We have a total of ' . $myPager->showTotal() . ' muffins!</div>' ;
  while ( $row = mysql_fetch_assoc( $result ) )
  {
    echo '<div align="center"><a href="muffin_view_pager.php?id=' . dbOut( $row['MuffinID'] ) . '">' . dbOut( $row['MuffinName'] ) . '</a>' ;
    echo '<i>only</i> <font color="red">$' . dbOut( $row['Price'] )  . '</font></div>' ;
  }
  print $myPager->showNav() ;
}
else
{ //no records
  print '<div align=center>What! No muffins? There must be a mistake!!</div>' ;
}
@mysql_free_result( $result ) ; // clears resources
@mysql_close( $myConn ) ; // close db connection

require_once INCLUDE_PATH . 'footer_inc.php' ;
?>
