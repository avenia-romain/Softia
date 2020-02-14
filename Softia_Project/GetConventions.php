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

$requestStudent = "SELECT id, Convention_id FROM etudiant";
$resultsStudent = $conn->query($requestStudent);

if ($resultsStudent->num_rows > 0) {
    while ($row = $resultsStudent->fetch_assoc()) {
        if ($row["id"] == $q) {
            $requestConvention = "SELECT id, nom, nbHeur FROM convention WHERE id=" .$row["Convention_id"];
            $resultsConvention = $conn->query($requestConvention);
            while ($row = $resultsConvention->fetch_assoc()) {
                echo $row["id"]. " " .$row["nom"]. " " .$row["nbHeur"];
            }
        }
    }
}

$conn->close();