<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['role']);
echo '<script>window.location.href="./index.php"</script>';
die;
