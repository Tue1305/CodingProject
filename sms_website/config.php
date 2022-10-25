<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '1234');
define('DB_NAME', 'sms');
 
/* Attempt to connect to MySQL database */
$pdo = new \PDO("mysql:host=localhost;dbname=sms;charset=utf8mb4", 'root', '1234', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES => false
]);
 
// Check connection
if($pdo=== false){
    die("ERROR: Could not connect. " );
}
?>