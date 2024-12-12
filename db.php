<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "tp_8";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
