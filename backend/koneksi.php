<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "swiftshop";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch (\Throwable $th) {
    echo "Tidak dapat tersambung ke db karena " . $th;
}
