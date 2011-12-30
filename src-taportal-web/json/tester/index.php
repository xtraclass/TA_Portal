<?php

require_once 'taportal/json-tester/_Classes.php';

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

/**
 * This is a small utility which allows to validate JSON formatted data
 * or the JSON output of a web page to be validated
 * against some of the constraints of the
 * data format specification of TA portal.
 * 
 */
$html = JSONTester::validate();

if ( strlen( $html ) === 0 ) 
{
  echo "<h2>JSON data are OK.</h2>";
}
else 
{
  echo $html;
}
?>
<br><br>
<form method="GET" ACTION="">
URL:
<br><input type="TEXT" size="100" name="url"></input>
<br><input type="submit"></input>
</form>

<br><br>OR<br><br><br>

<form method="POST" ACTION="">
JSON text:
<br><textarea rows="20" cols="80" name="json"></textarea>
<br><input type="submit"></input>
</form>
