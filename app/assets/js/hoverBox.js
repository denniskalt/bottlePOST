InfoBox2Inhalt = new Array();
InfoBox2Inhalt[1] = '<div class="panel panel-default"><div class="panel-heading"><b><span><img src="http://www.freeiconspng.com/uploads/control-game-play-player-icon--21.png" height= "25px" width="25px"> </span>  Project: EnergyWorld</b></div><div class="panel body"><span>EnergyWorld is an android-based real-time simulation game <br>about energy management.</span></div><div class="panel-footer">Client: E.ON Deutschland</div></div>';
InfoBox2Inhalt[2] = '<div class="panel panel-default"><div class="panel-heading"><b><span><img src="images/calendar.png" height= "25px" width="25px"> </span>  Project: StudentCal</b></div><div class="panel body"><span>EnergyWorld ist ein androidbasiertes Echtzeitsimulationsspiel<br>zum Thema Energiewirtschaft.</span></div><div class="panel-footer">Client: Hochschule Ostfalia Wolfenbüttel</div></div>';
InfoBox2Inhalt[3] = '<div class="panel panel-default"><div class="panel-heading"><b><span><img src="images/website.png" height= "25px" width="25px"> </span>  Project: twosmArt</b></div><div class="panel body"><span>EnergyWorld ist ein androidbasiertes Echtzeitsimulationsspiel<br>zum Thema Energiewirtschaft.</span></div><div class="panel-footer">Client: twosmArt (Band)</div></div>';
InfoBox2Inhalt[4] = '<div class="panel panel-default"><div class="panel-heading"><b><span><img src="images/calendar.png" height= "25px" width="25px"> </span>  Project: StudentCal</b></div><div class="panel body"><span>EnergyWorld ist ein androidbasiertes Echtzeitsimulationsspiel<br>zum Thema Energiewirtschaft.</span></div><div class="panel-footer">Client : Hochschule Ostfalia Wolfenbüttel</div></div>';


if (document.layers) {navigator.family = "nn4"}
if (document.all) {navigator.family = "ie4"}
if (window.navigator.userAgent.toLowerCase().match("gecko")) {navigator.family = "gecko"}

overdiv="0";

function Box2Anzeigen(a)
{

if(!InfoBox2[a]){InfoBox2[a]="<font color=red>Dieses PopUp (#"+a+") ist nicht korrekt definiert<br>Die Beschreibung fehlt. Ein Array-Element mit dieser Index-Nummer wurde nicht definiert!</font>";
}

Inhalt = InfoBox2Inhalt[a];

if(navigator.family =="nn4") {
        document.InfoBox2.document.write(Inhalt);
        document.InfoBox2.document.close();
        document.InfoBox2.left=x;
        document.InfoBox2.top=y-5;
        }
else if(navigator.family =="ie4"){
        InfoBox2.innerHTML=Inhalt;
        InfoBox2.style.pixelLeft=x;
        InfoBox2.style.pixelTop=y-5;
        }
else if(navigator.family =="gecko"){
        document.getElementById("InfoBox2").innerHTML=Inhalt;
        document.getElementById("InfoBox2").style.left=x;
        document.getElementById("InfoBox2").style.top=y-5;
        }
}


function Box2Ausblenden(){
if (overdiv == "0") {
        if(navigator.family =="nn4") {eval(document.InfoBox2.top="-2000");}
        else if(navigator.family =="ie4"){InfoBox2.innerHTML="";InfoBox2.style.pixelTop=y-2000;}
        else if(navigator.family =="gecko") {document.getElementById("InfoBox2").style.top="-2000";}
        }
}

var isNav = (navigator.appName.indexOf("Netscape") !=-1);

function Position(e){
// oder Plazierung neben Mauszeiger
x = (isNav) ? e.pageX : event.clientX + document.body.scrollLeft;
y = (isNav) ? e.pageY : event.clientY + document.body.scrollTop;
}

if (isNav){document.captureEvents(Event.mouseMove);}
document.onmousemove = Position;



//  End -->
