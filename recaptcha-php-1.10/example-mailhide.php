<html>
<body>
<?php
require_once ("recaptchalib.php");
// get a key at http://mailhide.recaptcha.net/apikey
$mailhide_pubkey = '6Lcp5gcAAAAAAIEO2AqiHoRBP_xRJCKMimU27ORe';
$mailhide_privkey = '6Lcp5gcAAAAAAK1YQ4D8M83t2Th4mbLs6wnQ-fRW';
?>
The Mailhide version of example@example.com is <?php
echo recaptcha_mailhide_html ($mailhide_pubkey, $mailhide_privkey, "example@example.com");?>.
<br>
The url for the email is:<? echo recaptcha_mailhide_url ($mailhide_pubkey, $mailhide_privkey, "example@example.com"); ?><br>
</body>
</html>
