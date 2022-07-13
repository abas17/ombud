<?php
include 'database/database.php';
$database = new Database();
$db = $database->getConnection();

session_start();
date_default_timezone_set('Asia/Makassar');
$ldate = date('Y-m-d H:i:s', time());
$updateSql = "UPDATE users SET logout = ? WHERE username = '" . $_SESSION['user']['username'] . "'";
$stmt = $db->prepare($updateSql);
$stmt->bindParam(1, $ldate);
$stmt->execute();
unset($_SESSION['user']);
header("Location: index.php");