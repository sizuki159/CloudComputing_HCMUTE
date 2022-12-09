<?php
require './config.php';

unset($_SESSION["logged"]);
unset($_SESSION["username"]);
header("Location: login.php");

?>