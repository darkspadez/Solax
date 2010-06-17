<?php
echo getcwd()."\n";
echo dirname(__FILENAME__);
function get_file_dir() {
    global $argv;
    return realpath($argv[0]);
}
echo get_file_dir();
?>