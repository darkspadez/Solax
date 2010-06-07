<?php
function clean($v) {
	mysqli_real_escape_string(stripslashes(strip_tags($v)));
}
?>