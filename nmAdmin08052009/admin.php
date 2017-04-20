<?php
/**
 * admin.php session protected 'dashboard' page of links to administrator tool pages
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see admin_login.php
 * @see admin_validate.php
 * @see admin_login.php
 * @see admin_only_inc.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$access = 'admin' ;
$PageTitle = 'Administrative Page' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
include_once INCLUDE_PATH . 'admin_only_inc.php' ;
$feedback = '' ;

if ( isset($_GET['msg'] ) )
{ $myMsg = ( trim( $_GET['msg'] ) ) ; }
else
{ $myMsg = 0 ; }

switch ( $myMsg )
{
  case 1:
    $myMsg = 'Your administrative permissions don&#39;t allow access to that page.' ;
    break ;
  default:
    $myMsg = '' ;
}

if ( isset( $_GET['msg'] ) )
{
  switch ( $_GET['msg'] )
  {
    case 1:
      $feedback = 'Your administrative permissions don&#39;t allow access to that page.' ;
      break ;
    default:
      $feedback = '' ;
  }
}

if ( $feedback != '' )
{ $feedback = '<div align="center"><h4><font color="red">' . $feedback . '</font></h4></div>' ; }

include_once INCLUDE_PATH . 'header_inc.php' ;
?>

<div align="center"><h3>Site Admin Page</h3></div>

<?php echo $feedback ; ?>

<table border="1" style="border-collapse:collapse" align="center" width="98%" cellpadding="3" cellspacing="3">
  <tr>
    <th>Page</th>
    <th>Purpose</th>
  </tr>

<?php
if ( $_SESSION['Privilege'] == 'developer')
{
?>

  <tr>
    <td width="250" align="center"><a href="<?php echo TABLE_EDITOR ; ?>">Table Editor</a></td>
    <td>
      <b>Developer Only.</b> Developer access is for you, and other highly trusted administrators.
      You may wish to allow access to the table editor to more than developers, but by default we'll set
      it up as <b>developer</b> access only!
    </td>
  </tr>

<?php
}
if ( $_SESSION['Privilege'] == 'superadmin' || $_SESSION['Privilege'] == 'developer' )
{
?>

  <tr>
    <td width="250" align="center"><a href="<?php echo ADMIN_ADD ; ?>">Add Administrator</a></td>
    <td><b>SuperAdmin Only.</b> Create site administrators, of any level.</td>
  </tr>

<?php
}
?>

  <tr>
    <td width="250" align="center"><a href="<?php echo ADMIN_RESET ; ?>">Reset Administrator Password</a></td>
    <td>Reset Admin passwords here. SuperAdmins can reset the passwords of others.</td>
  </tr>
  <tr>
    <td width="250" align="center"><a href="index.php">Site Pages</a></td>
    <td>
      View site pages as an admin. Various pages can be setup for special editing. For example, 'view' pages can
      have image upload enabled. Later we can install Rich Text Editors (RTEs) to allow inline editing of pages by administrators.
      You could place a link to each editable page here as well.
    </td>
  </tr>
  <tr>
    <td align="center" colspan="2"><a href="<?php echo ADMIN_LOGOUT ; ?>">Logout</a></td>
  </tr>
</table>

<?php
include_once INCLUDE_PATH . 'footer_inc.php' ;
?>
