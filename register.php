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
					if($_GET['action'] == "do") {
						if(empty($_POST['username']) OR empty($_POST['first_name']) OR empty($_POST['last_name']) OR empty($_POST['alias']) OR empty($_POST['email']) OR empty($_POST['fpassword']) OR empty($_POST['confirm_password'])) {
				?>
                    You did not fill in all fields please try again.
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
							$username = mysqli_real_escape_string($_POST['username']);
							$first_name = mysqli_real_escape_string($_POST['first_name']);
							$last_name = mysqli_real_escape_string($_POST['last_name']);
							$alias = mysqli_real_escape_string($_POST['alias']);
							$email = mysqli_real_escape_string($_POST['email']);
							$password = mysqli_real_escape_string(md5($_POST['password']));
							$confirm_password = mysqli_real_escape_string(md5($_POST['confirm_password']));
							if($password != $confirm_password) {
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
								$key = rand_str();
								$active = "no";
								$q = mysqli_query($mysqli_open,"INSERT INTO members (id,username,email,password,first_name,last_name,alias,key,active) VALUES ('','".$username."','".$email."','".$password."','".$first_name."','".$last_name."','".$alias."','".$key."','".$active."'");
						  		if(($result = @mysqli_query($q)) === false) {
									echo "There was an error with the database and registering you. Please try again, If problem continues please contact the site admin regarding this problem.\n" . mysqli_error() . "\n" . mysqli_errno();
								}
								else {
									$s = mysqli_query($mysqli_open,"SELECT * FROM config");
									$c = mysqli_fetch_assoc($s);
									$site_name = $c['site_name'];
									$site_email = $c['site_email'];
									$site_addr = $c['site_addr'] . "/register.php?action=confirm&username=" . $username . "&key=" . $key;
									$to = $email;
									$from = "From: $site_name <$site_email>";
									$subject = "$site_name - Confirm Registration";
									$message = "Dear $username,\n
Thank you for registering, we are very thankfully that you are willing to be a part of our community and we hope you enjoy your stay but first you will need to confirm your account.\n 
You can either enter the following key: $key or by following this link: <a href=\"$site_addr\">Click Here</a>.\n
You will not be able to login untill your confirm your account.\n
Sincerely,\n
$site_name";
									mail($to, $subject, $message, $from);
									echo "Thank you for registering, Please check your email's inbox for a confirmation email to activate your account. You will not be able to login untill you have done so.";
								}
							}
						}
					}
					elseif(($_GET['action'] == "confirm") && (isset($_GET['username'])) && (isset($_GET['key']))) {
						$username = $_GET['username'];
						$key = $_GET['key'];
						$q = mysqli_query($mysqli_open,"SELECT * FROM members WHERE username='".$username."' AND key='".$key."'");
						if(mysqli_num_rows($q) == 1) {
							$active = "yes";
							$c = mysqli_query($mysqli_open,"UPDATE members SET active='".$active."' WHERE username='".$username."' AND key='".$key."'");
						}
						/* PSEUDO CODE START
						else
							echo key/username didnt match
							echo form to try again
						PSEUDO CODE END */
					}
					elseif($_GET['action'] == "confirm") {
						
					}
					else {
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
                    <?php
					}
                    ?>
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