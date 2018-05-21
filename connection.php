<?php
$conn = require_once('config.php');


$mysqli = new mysqli($conn['mysql_host'], $config['mysql_user'], $config['mysql_password'], $config['mysql_db']);

if ( $mysqli && $mysqli->connect_error ) { echo $mysqli->connect_error; }

?>