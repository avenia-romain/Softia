<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_ex_softia";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$requestStudent = "SELECT id, nom, prenom FROM etudiant";
$resultsStudent = $conn->query($requestStudent);

$q = $_REQUEST["q"];

if ($q == "length") {
    $length = 0;
    while ($row = $resultsStudent->fetch_assoc()) {
        $length++;
    }
    echo $length;
} else if ($resultsStudent->num_rows > 0) {
    while ($row = $resultsStudent->fetch_assoc()) {
        if ($row["id"] == $q) {
            echo $row["nom"]. " " .$row["prenom"];
        }
    }
}

$conn->close();