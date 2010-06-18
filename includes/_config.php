<?php
$host = "localhost"; // Your database host usually localhost
$db = "solax_test"; // Your database name
$dbuser = "solax_test"; // Your database user
$dbpass = "test"; // Your database password
$mysql_open = mysql_connect($host,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());

// The following gets info for the pages
$config_query = mysql_query("SELECT * FROM config");
$c = mysql_fetch_assoc($config_query);
?>