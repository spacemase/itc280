<?php
/**
 * header_inc.php provides the initial HTML and left panel for site files
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see template.php
 * @see footer_inc.php
 */
if (!isset($PageTitle)) $PageTitle = 'Default Title!';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title><?php echo $PageTitle;?></title>
  <meta name="author" content="Mason Jensen" />
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta http-equiv="content-script-type" content="text/javascript;charset=utf-8" />
  <meta http-equiv="content-style-type" content="text/css;charset=utf-8" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta http-equiv="expires" content="-1" />
  <script language="javascript" type="text/javascript">
    <!-- This JS disallows hijacking into someone else's frame...
      if (top.location != self.location){top.location=self.location}
    //-->
  </script>
  <style type="text/css" media="screen">@import url("../styles.css");</style>
</head>
<body>

<table width="100%" cellpadding="5" cellspacing="0" margin="0">
  <!-- change header area color here -->
  <tr bgcolor="#52F3FF">
    <td colspan="3"><h1 align="center">Header Info Goes Here!</h1></td>
  </tr>
  <tr>
    <!-- change left panel area color here -->
    <td width="175" bgcolor="#FDEEF4" valign="top">
      <p align="center"><strong>left panel</strong></p>
      <p align="center">Links?</p>
      <p align="center"><a href="index.php">Home</a></p>
      <p align="center"><a href="template.php" title="A model for building largely static web pages.">Template</a></p>
      <p align="center"><a href="first_data.php" title="A model page for building web applications.">First Data</a></p>
      <p align="center"><a href="error_test.php" title="Click to see how errors are currently being handled.">Error Test</a></p>
    </td>
    <!-- change guts/identity area color here -->
    <td bgcolor="#E0FFFF" valign="top">
    <!-- end of header include file -->
