<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attestation</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body onload="selectStudent()">

<form method="POST">
    <div class="base">
        <h1 class="title">Attestation</h1>
        <div>
            <label for="students">Choisissez un étudiant :</label>
            <select name="students" id="students" onclick="studentSelected()" required="required">
                <option disabled selected value> -- Sélectionner -- </option>
            </select>
        </div>
        <div>
            <label for="conventionName">Nom de la convention :</label>
            <input type="text" id="conventionName" name="conventionName" size="40" disabled="disabled">
        </div>
        <div>
            <label for="message">Message :</label>
            <br>
            <textarea id="message" name="message" cols="70" rows="7"></textarea>
        </div>
        <input class="button" id="submit" type="submit" value="Envoyer" onclick="add()">
    </div>
</form>

<script type="text/javascript" src="index.js"></script>
</body>
</html>