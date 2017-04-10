function saveLocalStorage(email, profilepic, vorname, nachname, firmname) {
        var Storage = new Array();

        // Array Storage mit benötigten Daten füllen
        Storage.push(profilepic, vorname, nachname, firmname);

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
            var profilepic = Storage[0];
            var vorname = Storage[1];
            var nachname = Storage[2];
            var firmname = Storage[3];
            $("#avatar").attr("src", profilepic);
            document.getElementById("title-name").innerHTML = vorname + ' ' + nachname;
            document.getElementById("desc-firmname").innerHTML = firmname;
        }
        else {
            $("#avatar").attr("src", '//ssl.gstatic.com/accounts/ui/avatar_2x.png');
        }
    }
}


/**var localStorage = new Array();
users.push('Theo', 'Mark');
var JSONReadyUsers = JSON.stringify(users);
localStorage.setItem('users', JSONReadyUsersusers);
console.log(JSON.parse(localStorage['users']));
console.log(users[0]);*/
