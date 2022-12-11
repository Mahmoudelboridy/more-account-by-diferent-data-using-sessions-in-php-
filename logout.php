<?php
session_start();
session_unset();
session_destroy();
echo "<script>window.open('indo.php','_self')</script>";


?>