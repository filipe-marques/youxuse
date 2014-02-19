<?php
// DEVELOPMENT PURPOSES - DO NOT USE THIS IN PRODUCTION ENVIRONMENT
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', false);
//--------------------------------------------------------

/*$r = new HttpRequest;
$r->addCookies(
    array(
        "cookie_name" => "cookie value",
    )
);*/

?>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="L8ZZNTYYNFJUE">
<input type="hidden" name="email" id="email" value="eagle.software3@gmail.com">
<input type="image" src="https://www.sandbox.paypal.com/es_ES/ES/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
<img alt="" border="0" src="https://www.sandbox.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
</form>


