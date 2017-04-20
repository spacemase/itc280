<?php
/**
 * admin_reset.php allows an administrator to reset (reselect) a password
 *
 * Because passwords are encrypted via the MySQL encrpyption SHA() method,
 * we can't recover them, so we instead create new ones.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see admin_add.php
 * @see admin_login.php
 * @see admin_validate.php
 * @see admin_logout.php
 * @see admin_only_inc.php
 */
$PageTitle = 'Reset Administrator Password' ;

// defines access level required for this page
$access = 'admin' ;

define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
include_once INCLUDE_PATH . 'admin_only_inc.php' ;
include_once INCLUDE_PATH . 'header_inc.php';

// read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if ( isset( $_REQUEST['act'] ) ) { $myAction = ( trim( $_REQUEST['act'] ) ) ; }
else { $myAction = '' ; }

switch ( $myAction )
{ //check for type of process
  case "edit": # 2) show password change form
    editDisplay() ;
    break ;
  case "update": # 3) change password, feedback to user
    updateExecute() ;
    break ;
  default: # 1) select Administrator
    selectAdmin() ;
}
foreach ( $_GET as $varName ) { unset( $varName ) ; }
foreach ( $_POST as $varName ) { unset( $varName ) ; }

include_once INCLUDE_PATH . 'footer_inc.php' ;

function selectAdmin()
{ // Select administrator
  if ( isset( $_GET['msg'] ) )
  { // feedback is provided - perhaps data was entered improperly
    switch ( $_GET['msg'] )
    {
      case 1:
        $feedback = 'A required form element was not provided' ;
        break ;
      case 1:
        $feedback = 'Data submitted in the wrong format' ;
        break ;
      default:
        $feedback = '' ;
    }
  }
  else
  { // no feedback
    $feedback = '' ;
  }
  if ( $feedback != '' )
  { // fill out feedback HTML
    $feedback = '<div align="center"><h3><font color="red">' . $feedback . '</font></h3></div>' ;
  }
  echo
  '
    <script type="text/javascript" src="include/util.js"></script>
    <script type="text/javascript">
      function checkForm( thisForm )
      { //check form data for valid info
        if ( !checkRadio( thisForm.AdminID, "Please Select an Administrator." ) )
        { return false ; }
        else
        { return true ; } # if all is passed, submit!
      }
    </script>
    <h3 align="center">Reset Administrator Password</h3>
  ' ;
  if ( $_SESSION['Privilege'] != 'admin' )
  { // must be greater than admin level to have choice of selection
    echo '<p align="center">Select an Administrator, to reset their password:</p>' ;
  }
  echo $feedback ; # feedback, if any, provided here
  echo '<form action="' . ADMIN_RESET . '" method="post" onsubmit="return checkForm(this);">' ;
  $myConn = conn() ;
  $selSQL = "select AdminID,FirstName,LastName,Email,Privilege,LastLogin,NumLogins from " . PREFIX . "Admin" ;
  if ( $_SESSION['Privilege'] == 'admin' )
  { // limit access to the individual, if admin level
    $selSQL .= " where AdminID=" . $_SESSION['AdminID'] ;
  }
  $result = @mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
  if (mysql_num_rows($result) > 0)//at least one record!
  { // show results
    echo '<form action="' . ADMIN_RESET . '" method="post" onsubmit="return checkForm(this);">' ;
    echo '<table align="center" border="1" style="border-collapse:collapse" cellpadding="3" cellspacing="3">' ;
    echo '<tr><th>AdminID</th><th>Admin</th><th>Email</th><th>Privilege</th></tr>' ;
    while ( $row = mysql_fetch_array( $result ) )
    { // dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
      echo '<tr><td>' ;
      echo '<input type="radio" name="AdminID" value="' . dbOut( $row['AdminID'] ) . '">' ;
      echo dbOut( $row['AdminID'] ) . '</td>' ;
      echo '<td>' . dbOut( $row['FirstName'] ) . ' ' . dbOut( $row['LastName'] ) . '</td>' ;
      echo '<td>' . dbOut( $row['Email'] ) . '</td>' ;
      echo '<td>' . dbOut( $row['Privilege'] ) . '</td></tr>' ;
    }
    echo '<input type="hidden" name="act" value="edit" />' ;
    echo '<tr><td align="center" colspan="4"><input type="submit" value="Choose Admin!"></em></td></tr>' ;
    echo '</table></form>' ;
  }
  else
  { // no records, put links on page to reset form, exit
    echo '<div align="center"><h3>Currently No Administrators in Database.</h3></div>' ;
  }
   echo '<div align="center"><a href="' . ADMIN_DASHBOARD . '">Exit To Admin</a></div>' ;
  @mysql_free_result( $result ) ; # free resources
  @mysql_close() ; # close connection to db
}

function editDisplay()
{
  if ( !is_numeric( $_POST['AdminID'] ) )
  { myRedirect(ADMIN_RESET . '?msg=2' ) ; } # CHECK EMAIL/PASSWORD FOR VALID DATA:
  $myID = (int)$_POST['AdminID'] ; # forcibly convert to integer
  $myConn = conn() ;
  $selSQL = sprintf( "select AdminID,FirstName,LastName,Email,Privilege from " . PREFIX . "Admin WHERE AdminID=%d", $myID ) ;
  $result = @mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
  if ( mysql_num_rows( $result ) > 0 )
  { // at least one record, show results
    while ( $row = mysql_fetch_array( $result ) )
    { // dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
      $Name = dbOut( $row['FirstName'] ) . ' ' . dbOut( $row['LastName'] ) ;
      $Email = dbOut( $row['Email'] ) ;
      $Privilege = dbOut( $row['Privilege'] ) ;
    }
  }
  else
  { // no records, put links on page to reset form, exit
    echo '<div align="center"><h3>No such administrator.</h3></div>' ;
    echo '<div align="center"><a href="' . ADMIN_DASHBOARD . '">Exit To Admin</a></div>' ;
  }
?>

<script type="text/javascript" src="include/util.js"></script>
<script type="text/javascript">
  function checkForm( thisForm )
  { // check form data for valid info
    if ( !isAlphanumeric( thisForm.PWord1, "Only alphanumeric characters are allowed for passwords." ) )
    {
      thisForm.PWord2.value = "" ;
      return false ;
    }
    if ( !correctLength( thisForm.PWord1, 6, 20, "Password does not meet the following requirements:" ) )
    {
      thisForm.PWord2.value = "" ;
      return false ;
    }
    if ( thisForm.PWord1.value != thisForm.PWord2.value )
    { // match password fields
      alert( "Password fields do not match." ) ;
      thisForm.PWord1.value = "" ;
      thisForm.PWord2.value = "" ;
      thisForm.PWord1.focus() ;
      return false ;
    }
    return true ; // if all is passed, submit!
  }
</script>
<h3 align="center">Reset Administrator Password</h3>
<p align="center">
  Admin: <font color="red"><strong><?php echo $Name;?></strong></font>
  Email: <font color="red"><strong><?php echo $Email;?></strong></font>
  Privilege: <font color="red"><strong><?php echo $Privilege;?></strong></font>
</p>
<p align="center">Be sure to write down password!!</p>
<form action="<?php echo ADMIN_RESET;?>" method="post" onsubmit="return checkForm(this);">
<table align="center">
  <tr>
    <td align="right">Password</td>
    <td><input type="password" name="PWord1"><font color="red"><strong>*</strong></font> <em>(6-20 alphanumeric chars)</em></td>
  </tr>
  <tr>
    <td align="right">Re-enter Password</td>
    <td><input type="password" name="PWord2"><font color="red"><strong>*</strong></font></td>
  </tr>
  <input type="hidden" name="AdminID" value="<?php echo $myID;?>" />
  <input type="hidden" name="act" value="update" />
  <tr>
    <td align="center" colspan="2"><input type="submit" value="Reset Password!"><em>(<font color="red"><strong>*</strong> required field</font>)</em></td>
  </tr>
</table>
</form>

<?php
  print '<div align="center"><a href="' . ADMIN_DASHBOARD . '">Exit To Admin</a></div>' ;
  @mysql_free_result( $result ) ; # free resources
  @mysql_close( $myConn ) ; # close connection to db
}

function updateExecute()
{
  if ( !is_numeric( $_POST['AdminID'] ) )
  { myRedirect( ADMIN_RESET . '?msg=2' ) ; } # CHECK EMAIL/PASSWORD FOR VALID DATA:
  if ( !onlyAlphaNum( $_POST['PWord1'] ) )
  { myRedirect( ADMIN_RESET . '?msg=2') ; }

  $myConn = conn() ;
  $redirect = ADMIN_RESET . '?msg=1' ; # global var used for following formReq redirection on failure
  $AdminID = formReq( $_POST['AdminID'] ) ; # calls dbIn internally, to check form data
  $AdminPW = formReq( $_POST['PWord1'] ) ;

  // SHA() is the MySQL function that encrypts the password
  $updateSQL = sprintf("UPDATE " . PREFIX . "Admin set AdminPW=SHA('%s') WHERE AdminID=%d", $AdminPW, $AdminID ) ;

  @mysql_query( $updateSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;

  // feedback success or failure of insert
  if ( mysql_affected_rows( $myConn ) > 0 )
  { $msg = 'Password Reset!' ; }
  else
  { $msg='PASSWORD NOT RESET!' ; }

  // put links on page to reset form, exit
  echo '<div align="center"><h3>' . $msg . '</h3></div>' ;
  echo '<div align="center"><a href="' . ADMIN_RESET . '">Reset Another Password</a></div>' ;
  echo '<div align="center"><a href="' . ADMIN_DASHBOARD . '">Exit To Admin</a></div>' ;
}
?>
