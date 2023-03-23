<?php
require_once('config/Database.php');

$database = new Database();
$conn = $database->connect();

if ($conn) {
    echo "Connection successful!";
} else {
    echo "Connection failed!";
}
?>