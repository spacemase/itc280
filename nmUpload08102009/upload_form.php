<?php
/**
 * upload_form.php takes id number from view page, and creates form for uploading a new image.
 *
 * This page requires a loaded querystring, with an id number of an item passed to it. Form
 * will submit image to be uploaded, and ID to upload_image.php, which processes the upload.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see upload_execute.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$PageTitle = 'Upload Image!' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
require_once INCLUDE_PATH . 'admin_only_inc.php' ;
require_once INCLUDE_PATH . 'header_inc.php' ;

// You can declare the allowable file size here; 100000 is 100K, for example.
$size_bytes = 100000 ; # bytes max file size

// If true, will create thumbnail in same upload directory
$createThumb = 'TRUE' ; # Pass as a string, so can be placed in hidden form field

// Declared width of thumbnail; Height calculated from there
$thumbWidth = 50 ;

// Declared prefix of thumbnail.
// if use 'thumb_', and image is 'm', file name would be: thumb_m1.jpg
$thumbPrefix = 'thumb_' ;

// Folder for upload.
$upload_dir = 'upload/' ; # Upload path from the virtual root of your server space

// unique prefix to add to your image name.  For example 'm' for muffins, 'm17.jpg'
$image_prefix = 'm' ;

// image extension
$extension = '.jpg' ;
?>

<h3 align="center">Upload Image</h3>

<?php
//check variable of item passed in on querystring
$myID = 0 ; # init
if ( isset( $_GET['id'] ) ) { $myID = (int)$_GET['id'] ; }
$size = $size_bytes / 1000 ; # divide by 1000, use KB
?>

<script language="javascript">
function checkForm( thisForm )
{
  if( thisForm.FileToUpload.value == "" )
  {
    alert( "Please select a file to upload" ) ;
    thisForm.FileToUpload.focus() ;
    return false ;
  }
  else
  {
		document.getElementById('mySubmit').disabled = true ;
		document.getElementById('mySubmit').value = 'Uploading, please wait...' ;
		return true ;
	}
}
</script>

<?php
if ( $myID > 0 )
{ // show table
?>

<table border="1" align="center" width="50%" style="border-collapse:collapse">
  <tr>
    <td align="center">OLD IMAGE:</td>
    <td align="center"><img src="<?php echo '../' . $upload_dir . $image_prefix . $myID . $extension; ?>" /></td>
  </tr>
  <tr>
    <td align="center" colspan="2">
      <form name="myForm" action="upload_execute.php" method="post" enctype="multipart/form-data" onsubmit="return checkForm(this);">
        Browse an Image to Upload: <i>(file must be <?php echo $size; ?>KB or less.)</i><br />
        <input type="file" name="FileToUpload" id="FileToUpload" /><br />
        <input type="hidden" name="myID" value="<?php echo $myID; ?>" />
        <input type="hidden" name="imagePrefix" value="<?php echo $image_prefix; ?>" />
        <input type="hidden" name="uploadFolder" value="<?php echo $upload_dir; ?>" />
        <input type="hidden" name="extensions" value="<?php echo $extension; ?>" />
        <input type="hidden" name="createThumb" value="<?php echo $createThumb; ?>" />
        <input type="hidden" name="thumbWidth" value="<?php echo $thumbWidth; ?>" />
        <input type="hidden" name="thumbPrefix" value="<?php echo $thumbPrefix; ?>" />
        <input type="hidden" name="sizeBytes" value="<?php echo $size_bytes; ?>" />
        <input type="hidden" name="returnPage" value="<?php echo $_SERVER["HTTP_REFERER"]; ?>" />
        <br />
        <input type="Submit" value="Upload File" id="mySubmit" />
      </form>
      <div align="center"><a href="javascript:history.go(-1)">EXIT WITHOUT UPLOAD</a></div>
    </td>
  </tr>
</table>

<?php
}
else
{
  echo '<div align="center"><h4>No Such Image</h4></div>
        <div align="center"><a href="javascript:history.go(-1)">EXIT</a></div>' ;
}

require_once INCLUDE_PATH . 'footer_inc.php' ;
?>
