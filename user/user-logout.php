<?php
session_start();
session_destroy();
echo "Logged out.";
header("Refresh:2, url=../index.php")
?>