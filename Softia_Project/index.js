selectElement = document.getElementById("students");
conventionElement = document.getElementById("conventionName");
messageElement = document.getElementById("message");
submitButton = document.getElementById("submit");

let numberOfStudent;
let studentId = 0;
let conventionId = 0;
let conventionName = "";
let conventionTitle = "";
let firstname = "PRENOM";
let lastname = "NOM";
let nbHeur = 0;

function update() {
    // Défini le message qui est affiché en fonction des valeurs associées à l'étudiant sélectionné
    conventionTitle = "Convention de " + lastname + " " + firstname + " à " + conventionName;
    conventionElement.value = conventionTitle;

    messageElement.value = "Bonjour " + lastname + " " + firstname +", \n\n" +
        "Vous avez suivi " + nbHeur + " heures de formation chez FormationPlus. \n" +
        "Pouvez-vous nous retourner ce mail avec la pièce jointe signée. \n\n" +
        "Cordialement, \n" +
        "FormationPlus";
}


function lengthStudents() {
    // Récupère le nombre d'étuiants dans la base de donnée
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            numberOfStudent =  this.responseText;
        }
    };
    xmlhttp.open("GET", "GetStudents.php?q=length", true);
    xmlhttp.send();
}


async function selectStudent() {
    // Récupère tous les étudiants dans la base de donnée pour les proposer dans le select
    lengthStudents();
    await new Promise(r => setTimeout(r, 100));
    for (let i = 1; i <= numberOfStudent; i++) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                option = document.createElement("option");
                option.text = this.responseText;
                option.studentId = i;
                selectElement.appendChild(option);
            }
        };
        xmlhttp.open("GET", "GetStudents.php?q=" + i, true);
        xmlhttp.send();
    }
}


async function studentSelected() {
    // Récupère l'étudiant sélectionné
    choice = selectElement.selectedIndex;
    value = selectElement.options[choice].value;
    studentId = selectElement.options[choice].studentId;
    firstname = value.split(" ")[0];
    lastname = value.split(" ")[1];

    // Défini le nom de la convention
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            temp = this.responseText;
            conventionId = temp.split(" ")[0];
            conventionName = temp.split(" ")[1];
            nbHeur = temp.split(" ")[2];
        }
    };

    xmlhttp.open("GET", "GetConventions.php?q=" + studentId, true);
    xmlhttp.send();
    await new Promise(r => setTimeout(r, 100));
    update();
}


function add() {
    // Ajoute une nouvelle convention dans la base de donnée
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            submitButton.value = this.responseText;
        }
    };

    xmlhttp.open("GET", "addAttestationToDB.php?q=" + studentId + "_" + conventionId + "_"  + messageElement.value, true);
    xmlhttp.send();
}