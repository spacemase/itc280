<?php
/**
 * error_test.php tests visibility of errors
 *
 * Demonstrates what a user or developer sees based on the value of the HIDE_ALL_ERRORS
 * constant in config_inc.php and the HIDE_PAGE_ERRORS constant in all site pages.
 *
 * There is a MySQL error on an included page, 'error_inc.php', which is a test page that
 * exists only to show an error on an include file exposes the filename & line number:
 *
 * <code>
 *  or die(trigger_error(mysql_error(), E_USER_ERROR));
 * </code>
 *
 * HIDE_ALL_ERRORS over-rides all HIDE_PAGE_ERRORS settings so a developer can shut down errors
 * temporarily and re-enable them again, to be able to troubleshoot.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see header_inc.php
 * @see footer_inc.php
 * @see error_inc.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$PageTitle = 'Error Test Page' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
include_once INCLUDE_PATH . 'header_inc.php' ;
?>

<h3 align="center">error_test.php</h3>
<p>This page demonstrates the error reporting features of nmCommon files.</p>

<?php
if ( HIDE_ALL_ERRORS )
{
  echo '<p><b>HIDE_ALL_ERRORS</b> is set to TRUE in <b>config_inc.php</b>, so you will not be able to see any developer errors currently</p>' ;
  echo '<p>Please change the value of the constant <b>HIDE_ALL_ERRORS</b> to be able to test errors on this page</p>' ;
}
else
{
  echo '<p><b>HIDE_ALL_ERRORS</b> is set to FALSE in config_inc.php, so you can toggle back and forth between viewing user and developer errors.</p>' ;
  if ( HIDE_PAGE_ERRORS )
	{
    echo '<p><b>HIDE_PAGE_ERRORS</b> is set to TRUE in this file, so you will see only <b>user</b> (public) error messages.</p>' ;
    echo '<p>Change the value of the constant <b>HIDE_PAGE_ERRORS</b> to FALSE to be able to view developer errors on this page.</p>' ;
	}
  else
  {
    echo '<p><b>HIDE_PAGE_ERRORS</b> is set to FALSE in this file, so you will be able to see <b>developer</b> (private) error messages.</p>' ;
    echo '<p>Change the value of the constant <b>HIDE_PAGE_ERRORS</b> to TRUE to be able to view user (public) errors on this page.</p>' ;
	}
}

// Create deliberate errors.
echo $myvar ;
include_once 'fake_inc.php' ;
$result = 200/0 ;

include_once INCLUDE_PATH . 'footer_inc.php' ;
?>
