<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['User']))
{
	$weluser = $_SESSION['User'];
    $user_id = $_SESSION['ID'];
	$sql = mysql_query ("SELECT pm_count FROM members WHERE user='$weluser'");
	$row = mysql_fetch_array ($sql);
	$pm_count = $row['pm_count'];
	$percent = $pm_count/50;
	$percent = $percent * 100;
	echo "<div id=\"top_bar_log\">Welcome back $weluser - <a href=\"view_profile.php?ID=" . $user_id . "\">View Your Profile</a> | <a href=\"edit_profile.php\">Edit Your Profile</a> | <a href=\"inbox.php\">Inbox $pm_count of 50 Total $percent % full</a> | <a href=\"compose.php\">Compose</a> | <a href=\"sent.php\">Sentbox</a> | <a href=\"logout.php\">Logout</a></div>";
}
else {
    	echo "<div id=\"top_bar\"><form action=\"log.php\" method=\"post\"> Username: <input type=\"text\" name=\"user\" /> Password: <input type=\"password\" name=\"pass\" /> <input type=\"submit\" value=\"Login\" name=\"submit\" /> <a href=\"#\">Forgot Password</a> | <a href=\"register.php\">Register</a></form></div>";
}
?>
