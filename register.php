<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/_config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/_functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Core Five Gaming</title>
</head>
<body>
<div id="wrapper">
	<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/_topbar.php") ?>
    <div id="header"></div>
	<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/_nav.php") ?>
    <div id="content">
      	<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/_left.php") ?>
        <div id="main">
        	<div class="news_box">
            	<div class="news_top">
                	Register
                    <hr color="#d1d1d1" width="410px" size="1px" style="float: left;" />
                </div>
                <div class="news">
                <?php
					if(isset($_GET['do'])) {
						$username = mysqli_real_escape_string($_POST['username']);
						$first_name = mysqli_real_escape_string($_POST['first_name']);
						$last_name = mysqli_real_escape_string($_POST['last_name']);
						$alias = mysqli_real_escape_string($_POST['alias']);
						$email = mysqli_real_escape_string($_POST['email']);
						$password = mysqli_real_escape_string(md5($_POST['password']));
						$confirm_password = mysqli_real_escape_string(md5($_POST['confirm_password']));
						if(!$password == $confirm_password) {
				?>
                	Your passwords did not match please try again.
                	<form action="register.php?action=do" method="post">
                    <table>
                    	<td>
                        	<tr>Username:</tr>
                            <tr><input type="text" name="username" /></tr>
                        </td>
                        <td>
                        	<tr>First Name:</tr>
                            <tr><input type="text" name="first_name" /></tr>
                        </td>
                        <td>
                        	<tr>Last Name:</tr>
                            <tr><input type="text" name="last_name" /></tr>
                        </td>
                        <td>
                        	<tr>Alias:</tr>
                            <tr><input type="text" name="alias" /></tr>
                        </td>
                        <td>
                        	<tr>Email:</tr>
                            <tr><input type="text" name="email" /></tr>
                        </td>
                        <td>
                        	<tr>Password:</tr>
                            <tr><input type="password" name="password" /></tr>
                        </td>
                        <td>
                        	<tr>Confirm Password:</tr>
                            <tr><input type="password" name="confirm_password" /></tr>
                        </td>
                        <td>
                        	<tr><input type="submit" value="Register" /></tr>
                            <tr></tr>
                        </td>
                    </table>
                	</form>
                <?php
						}
						else {
							$q = mysqli_query($mysqli_open,"INSERT INTO members (id,username,email,password,first_name,last_name,alias) VALUES ('','"$username"','"$email"','"$password"','"$first_name"','"$last_name"','"$alias"'");
							$
						}
					}
				?>
                	<form action="register.php?action=do" method="post">
                    <table>
                    	<td>
                        	<tr>Username:</tr>
                            <tr><input type="text" name="username" /></tr>
                        </td>
                        <td>
                        	<tr>First Name:</tr>
                            <tr><input type="text" name="first_name" /></tr>
                        </td>
                        <td>
                        	<tr>Last Name:</tr>
                            <tr><input type="text" name="last_name" /></tr>
                        </td>
                        <td>
                        	<tr>Alias:</tr>
                            <tr><input type="text" name="alias" /></tr>
                        </td>
                        <td>
                        	<tr>Email:</tr>
                            <tr><input type="text" name="email" /></tr>
                        </td>
                        <td>
                        	<tr>Password:</tr>
                            <tr><input type="password" name="password" /></tr>
                        </td>
                        <td>
                        	<tr>Confirm Password:</tr>
                            <tr><input type="password" name="confirm_password" /></tr>
                        </td>
                        <td>
                        	<tr><input type="submit" value="Register" /></tr>
                            <tr></tr>
                        </td>
                    </table>
                	</form>
                </div>
                <div class="news_bot">
                </div>
            </div>
        </div>
        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/_right.php") ?>
  	</div>
    <div id="footer"></div>
</div>
</body>
</html>