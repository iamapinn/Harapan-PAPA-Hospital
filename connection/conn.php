<?php
session_start();
error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "rsharapanpapa");

// Check connection
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
