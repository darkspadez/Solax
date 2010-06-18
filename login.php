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
<title><?php echo $c['site_name']; ?></title>
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
                	Login
                    <hr color="#d1d1d1" width="410px" size="1px" style="float: left;" />
                </div>
                <div class="news">
                <?php
					if($_GET['action'] == "do") {
					
					}
					else {
						include(getcwd() . "/forms/_login.php");
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