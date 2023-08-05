<?php
$dbHostName = "localhost";
$dbName = "tktw";
$dbUser = "root";
$dbPassword = "";
$connect = new PDO("mysql:host=$dbHostName;dbname=$dbName", $dbUser, $dbPassword);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
