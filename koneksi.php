<?php
// koneksi.php

$host = "localhost";
$user = "root"; // Sesuaikan dengan username database Anda
$pass = "";     // Sesuaikan dengan password database Anda
$db = "rt";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>