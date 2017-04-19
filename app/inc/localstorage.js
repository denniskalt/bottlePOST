function saveLocalStorage(email, profilepic, user, vorname, nachname) {
        var Storage = new Array();

        // Array Storage mit benötigten Daten füllen
        Storage.push(email, profilepic, user, vorname, nachname);

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
            var user = Storage[2];
            var vorname = Storage[3];
            var nachname = Storage[4];
            if(profilepic!="") {
                $("#avatar").attr("src", 'app/images/'+profilepic);
            }
            if(vorname!="" && nachname!="") {
                document.getElementById("title-name").innerHTML = 'Willkommen zurück, '+vorname + ' ' + nachname+'!';
            }
            else {
                document.getElementById("title-name").innerHTML = 'Willkommen zurück, '+user+'!';
            }
        }
        else {
            /*$("#avatar").attr("src", 'app/images/user/default-0.jpg');*/
        }
    }
}


/**var localStorage = new Array();
users.push('Theo', 'Mark');
var JSONReadyUsers = JSON.stringify(users);
localStorage.setItem('users', JSONReadyUsersusers);
console.log(JSON.parse(localStorage['users']));
console.log(users[0]);*/
