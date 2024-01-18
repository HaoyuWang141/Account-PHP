<?php
// $host = "114.132.51.227";
// $dbname = "account";
// $user = "admin_account";
// $password = "111111";

$host = "127.0.0.1";
$dbname = "account";
$user = "postgres";
$password = "111111";

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}