<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/_config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/_functions.php");
?>
<!DOCTYPE HTML>
<html>
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
        <?php
			$newsquery = mysql_query("SELECT * FROM news ORDER BY ID DESC LIMIT 5");
			while($news = mysql_fetch_array($newsquery)) {
		?>
        	<div class="news_box">
            	<div class="news_top">
                	<a href="#"><?=$news['title']?></a>
                    <hr color="#d1d1d1" width="410px" size="1px" style="float: left;" />
                </div>
                <div class="news">
                	<?=$news['content']?>
                </div>
                <div class="news_bot">
                	<div class="left">
                    	Posted By: <a href="#"><?=$news['author']?></a>
                    </div>
                    <div class="right">
                    	Comments [<a href="#">0</a>]
                    </div>
                </div>
            </div>
            <?
			}
			?>
        </div>
        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/_right.php") ?>
  	</div>
    <div id="footer"></div>
</div>
</body>
</html>