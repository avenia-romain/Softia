<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_ex_softia";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$q = $_REQUEST["q"];
$params = explode('_', $q, 3);
$sql = "INSERT INTO attestation (Etudiant_id, Convention_id, message) VALUES ($params[0], $params[1], '$params[2]')";

if (mysqli_query($conn, $sql) == false) {
    echo "Erreur";
}

$conn->close();