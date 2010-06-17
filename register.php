<?php
session_start();
require_once(getcwd() . "/includes/_config.php");
require_once(getcwd() . "/includes/_functions.php");
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
	<?php require_once(getcwd() . "/includes/_topbar.php") ?>
    <div id="header"></div>
	<?php require_once(getcwd() . "/includes/_nav.php") ?>
    <div id="content">
      	<?php require_once(getcwd() . "/includes/_left.php") ?>
        <div id="main">
        	<div class="news_box">
            	<div class="news_top">
                	Register
                    <hr color="#d1d1d1" width="410px" size="1px" style="float: left;" />
                </div>
                <div class="news">
                <?php
					if($_GET['action'] == "do") {
						if(empty($_POST['username']) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['alias']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
                    		echo "You did not fill in all the fields please try again.<br />";
							include(getcwd() . "/forms/_register.php");
						}
						else {
							$username = clean($_POST['username']);
							$first_name = clean($_POST['first_name']);
							$last_name = clean($_POST['last_name']);
							$alias = clean($_POST['alias']);
							$email = clean($_POST['email']);
							$password = clean(md5($_POST['password']));
							$confirm_password = clean(md5($_POST['confirm_password']));
							if($password != $confirm_password) {
                				echo "Your passwords did not match please try again.<br />";
                				include(getcwd() . "/forms/_register.php");
							}
							else {
								$check_username = mysql_query("SELECT * FROM members WHERE username='".$username."'");
								$check_email = mysql_query("SELECT * FROM members WHERE email='".$email."'");
								if((mysql_num_rows($check_username) == 1) || (mysql_num_rows($check_email) == 1)) {
									echo "Your username or email has already been used, please use a new username or password.";
									include(getcwd() . "/forms/_register.php");
								}
								else {
									$confirm_key = rand_str();
									$active = "no";
									$q = "INSERT INTO members (id,username,email,password,first_name,last_name,alias,confirm_key,active) VALUES ('','".$username."','".$email."','".$password."','".$first_name."','".$last_name."','".$alias."','".$confirm_key."','".$active."')";
						  			if(($result = @mysql_query($q)) === false) {
										echo "There was an error with the database and registering you. Please try again, If problem continues please contact the site admin regarding this problem.<br />" . mysql_error() . "<br />" . mysql_errno();
									}
									else {
										$site_name = $c['site_name'];
										$site_email = $c['site_email'];
										$site_addr = $c['site_addr'] . "/register.php?action=confirm&username=" . $username . "&key=" . $confirm_key;
										$to = $email;
										$from = "From: $site_name <$site_email>";
										$subject = "$site_name - Confirm Registration";
										$message = "Dear $username,
										
Thank you for registering, we are very thankfully that you are willing to be a part of our community and we hope you enjoy your stay but first you will need to confirm your account.

You can either enter the following key: $confirm_key or by following this link: <a href=\"$site_addr\">Click Here</a>.

You will not be able to login untill your confirm your account.

Sincerely,
$site_name";
										mail($to, $subject, $message, $from);
										echo "Thank you for registering, Please check your email's inbox for a confirmation email to activate your account. You will not be able to login untill you have done so.<br />";
										include(getcwd() . "/forms/_key.php");
									}
								}
							}
						}
					}
					elseif(($_GET['action'] == "confirm") && (isset($_GET['username'])) && (isset($_GET['key']))) {
						$username = $_GET['username'];
						$confirm_key = $_GET['key'];
						$q = mysql_query("SELECT * FROM members WHERE username='".$username."' AND confirm_key='".$confirm_key."'");
						if(mysql_num_rows($q) == 1) {
							$active = "yes";
							$c = mysql_query("UPDATE members SET active='".$active."' WHERE username='".$username."' AND confirm_key='".$confirm_key."'");
							echo "Your account has successfully confirmed your account. You may now login.";
							include(getcwd() . "/forms/_login.php");
						}
						else {
							echo "They key you have tried did not match with your username. Please try again.";	
							include(getcwd() . "/forms/_key.php");
						}
					}
					elseif($_GET['action'] == "confirm") {
						include(getcwd() . "/forms/_key.php");
					}
					else {
						include(getcwd() . "/forms/_register.php");
					}
                    ?>
                </div>
                <div class="news_bot">
                </div>
            </div>
        </div>
        <?php require_once(getcwd() . "/includes/_right.php") ?>
  	</div>
    <div id="footer"></div>
</div>
</body>
</html>