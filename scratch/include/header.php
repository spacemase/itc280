<?php
/**
 * header.php provides the initial HTML and left panel for site files 
 *
 * A variable named $PageTitle provides a default name for page, if 
 * a page name is not declared in the including page.
 *
 * @package ITC280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/07/12
 * @link http://www.spacemase.com/  
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see template.php
 * @see footer.php
 * @todo none
 */
if ( !isset( $PageTitle ) ) 
  $PageTitle = "Nine Thermidor" ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$PageTitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<script language="JavaScript" type="text/javascript">
<!-- This JS disallows hijacking into someone else's frame...
 if (top.location != self.location){top.location=self.location}
//-->
</script>
<!-- use one of the following types of css or write it "inline" //-->
<link type="text/css" href="include/styles.css" rel="stylesheet" />
<!-- <style type="text/css" media="screen">@import url("styles.css");</style> -->
<!-- <style type="text/css">
       .somethingcouldgohere {}
     </style> -->
</head>
<body>
<table width="100%" cellpadding="5" cellspacing="0" margin="0">
  <!-- change header color here -->
  <tr bgcolor="#FFFFFF">
    <td colspan="3">
      <h1 align="center">Nine Thermidor</h1>
    </td>
  </tr>

  <div id="MainMenu">
    <div id="tab">
      <ul>
      <li><a href="/"><span>Home</span></a></li>
      <li><a href="/about"><span>About</span></a></li>
      <li><a href="/publication"><span>Pox Party</span></a></li>
      <li><a href="/dadascope"><span>Dadascope</span></a></li>
      <li><a href="/nietzsche"><span>What Would Nietzsche do?</span></a></li>
      <li><a href="/projects"><span>Projects</span></a></li>
      <li><a href="/reviews"><span>Reviews</span></a></li>
      <li><a href="/contact"><span>Contact</span></a></li>
      </ul>
    </div>
  </div>  
  
  
  
  
  
  
  <tr>
    <!-- change left panel color here -->
    <td width="175" bgcolor="#FFFFFF" valign="top">
      <p align="center"><b>left panel</b></p>
      <p align="center">Links</p>
      <p align="center"><a href="http://www.bing.com/">Bing</a></p>
      <p align="center"><a href="http://www.php.net/">PHP.NET</a></p>
    </td>
    <!-- change guts/identity area color here -->
    <td bgcolor="#FFFFFF" valign="top">
<!-- end of header include file -->
