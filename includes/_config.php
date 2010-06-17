<?php
$host = "localhost"; // Your database host usually localhost
$db = "solax_test"; // Your database name
$dbuser = "solax_test"; // Your database user
$dbpass = "test"; // Your database password
$mysql_open = mysql_connect($host,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());
$site_config = mysql_query("SELECT * FROM config");
$c = mysql_fetch_array($site_config);
$site_doc = $c['site_doc'];
?>