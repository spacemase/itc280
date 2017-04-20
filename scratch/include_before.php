<!-- IncludeBefore.php (Updated 10.02.2005) -->
<!-- Below is an example of a simple page designed to be a template for a website with many consistent pages.  Compare this code to the set of pages in example "includeAfter.php" which splits 3 of the areas out into separate include files. -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>includeBefore.php</title>
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
<link type="text/css" href="template.css" rel="stylesheet" />
<style type="text/css" media="screen">@import url("template.css");</style>
<style type="text/css">
 .somethingcouldgohere {}
</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" margin="0">
	<tr bgcolor="#00FFCC">
		<td colspan="2">
	  		<h1 align="center">Header Goes Here! (includeBefore.php)</h1>
		</td>
  	</tr>
	<tr>
		<td width="200" bgcolor="#00FF99">
			<p align="center"><b>Nav Goes Here!</b></p>
			<p>Below this would probably go some links:</p>
			<p align="center"><a href="http://www.google.com/">Google</a></p>
			<p align="center"><a href="http://www.yahoo.com/">Yahoo</a></p>
	  		<p align="center"><a href="http://www.php.net/">PHP.NET</a></p>
		</td>
		<td bgcolor="#00FFFF">
			<p>
  		  <h3 align="center">Guts Goes Here!</h3>
			</p>
			<p>This is an example of a rudimentary HTML page, built as a template 
			prior to ripping it apart into 3 separate include files, which could all be 
			included in your "index.php" main page, for example.
			</p>
			<p>
			The way to implement this across other pages would be to copy this page,
			rename it, and then use the guts area (content area)  as the area to place information for the specific page you are working on.
			</p>
			<p>
			The advantage to this design is you can have consistent elements (header, footer, nav)
			 that can be changed in one place, and only need to swap out the "guts"  to
			 house the content of your current page!			
	  		</p>
	  </td>
	</tr>
	<tr bgcolor="#00CC99">
		<td colspan="2">
		    <p align="center"><b>Footer Goes Here!</b></p>
			<p align="center">Always include some sort of copyright notice, for example:</p>
	        <p align="center"><b>Copyright My Company, 2004 - <? print date("Y") ?></b></p>
		</td>
  </tr>
</table>
</body>
</html>


