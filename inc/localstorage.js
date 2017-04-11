function saveLocalStorage(email, profilepic, vorname, nachname) {
        var Storage = new Array();

        // Array Storage mit benötigten Daten füllen
        Storage.push(email, profilepic, vorname, nachname);

        // Mithilfe der Stringify-Funktion wird das Array in ein String übersetzt
        var JSONReady = JSON.stringify(Storage);

        // Die Daten werden im Key der E-Mail-Adresse gespeichert
        localStorage.setItem(email, JSONReady);
    }

function loadLocalStorage() {
    var storedEmail = document.getElementById('email').value;

    for (var i=0; i<=localStorage.length-1; i++) {
        var key = localStorage.key(i);
        if(key === storedEmail) {
            var retrievedData = localStorage.getItem(storedEmail);

            // Parse-Funktion um den String in ein Array zu verändern
            var Storage = JSON.parse(retrievedData);
            var email = Storage[0];
            var profilepic = Storage[1];
            var vorname = Storage[2];
            var nachname = Storage[3];
            $("#avatar").attr("src", 'images/'+profilepic);
            document.getElementById("title-name").innerHTML = 'Willkommen zurück, '+vorname + ' ' + nachname+'!';
        }
        else {
            $("#avatar").attr("src", 'images/user.jpg');
        }
    }
}


/**var localStorage = new Array();
users.push('Theo', 'Mark');
var JSONReadyUsers = JSON.stringify(users);
localStorage.setItem('users', JSONReadyUsersusers);
console.log(JSON.parse(localStorage['users']));
console.log(users[0]);*/
