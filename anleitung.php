<!DOCTYPE html>
</style>
</head>
<body>
<div class="header"> 
	<img class="logo" src="logo4.png" alt="">
	<div class="header-right">
    <?php 
session_start();
if(isset( $_SESSION["username1"])){?>
    <a class="home" href="index.php">Home</a>
    <?php } ?>
<a href="anmelden.php">Anmelden</a>
		
	</div>
</div>	
<style>
	* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial;
  
}

* {
  box-sizing: border-box;
}


.header {
  overflow: hidden;
  background: linear-gradient(45deg, black, #222021, #3CA9E4);
  padding: 10px 5px;
  
}
.header a {
  float: right;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}
.header a:hover {
background-color: #ddd;
color: black;
box-shadow: #222021 2px;
}
.header-right {
float: none;
}
.header a.active {
background-color: dodgerblue;
color: white;
}
.headline{
    
  
   
    font-family: sans-serif;
    font-weight: bolder;
    font-size: 30pt;
    color: blue;
    background: linear-gradient(to left, #fe019a, blueviolet, blue);
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
.acount{
    
margin-bottom: 30pt;
  display: inline-flex;
  align-items: center;
  margin-top: 10pt;
  margin-left: 0px;
  margin-right: 0px;
  

}
.rubine{
 height: 32pt;
 width: auto;
 margin-left: 10px;
 margin-right: 10px;
}



.header img.logo{
	float: left;
	height: 60px;
	width: auto;
  	
}
.header-right {
  float: right;
}
.subtitel{
    font-size: 16pt;
    font-weight: bold;
    margin-top: 50pt;
    margin-bottom: 8pt;
    text-align: center;
}
.textcontainer{
    font-family: Arial;
    margin-top: 16pt;
  padding-top: 20pt;
  margin-left: 7%;
  margin-right: 7%;
  padding-left: 5%;
  padding-right: 5%;
  padding-bottom: 80pt;
  background-color: #ECECEC;
  border-radius: 10pt;
  text-align: center;
  margin-bottom: 30pt;
 
}
.list{
    padding-top: 20pt;
    margin-bottom: 20pt;
    text-align: left;
    display:inline-flex;
}
.bold{
    font-weight: bold;
}
.element{
    margin-left: 30pt;
}
.roulette{
    margin-left: 60px;
    height: auto;
    width: 50%;
    margin-bottom: 20px;
    float: right;
}
.wuerfel{
    float: left;
    width: 18%;
    height: auto;
}
.cabo{
    float: right;
    width: 30%;
    height: auto;
    margin-left: 20pt;
    border-radius: 2pt;
    border: solid grey 0.5pt;
}
.cabo2{
    float: left;
    width: 10%;
    margin-right: 20pt;
    margin-bottom: 20pt;
}
.tictactao{
    float: right;
    width: 25%;
    height: auto;
    margin-left: 20pt;
    border-radius: 2pt;
    border: solid grey 0.5pt;

}
</style>

<div class="textcontainer">

   
    <div class="acount">  <img class="rubine" src="rubine2.png" alt=""> <span class="headline"> Willkommen auf "ADVITO" </span>
<img class="rubine" src="rubine2.png" alt=""></div>
   
    <p>Hier hast du die Möglichkeit deiner Spielfreude freien lauf zu lassen und möglichst viele Rubine zu gewinnen.</p>
   <p>Du startest am Anfang mit 1000 Rubinen und kannst diese entweder in den Solospielen "Das Würfelspiel" und "Roulette" setzen und damit weiter Rubine gewinnen, oder du kannst in den Duospielen "Cabo" und "TicTacTao" gegen einen Freund zusätzliche Rubine erspielen.
Dein Rubinkonto wird in unserer Datenbank sicher gespeichert.</p>
<p>Du benötigst lediglich deinen Benutzernamen und dein Passwort um darauf zuzugreifen.</p>    
<p>Bitte erstelle dir zuerst einen Account, damit du die Spielvielfahlt von "ADVITO" entdecken kannst.</p>
<p class="subtitel">Roulette</p>
<p>Roulette ist ein Glücksspiel bei dem man mit einem Geldbetrag startet und versucht, durch geschicktes setzten möglichst viel zu gewinnen.
Zu Beginn wählen Sie den Geldbetrag, den Sie setzen wollen.
Anschließen setzen Sie auf eine Zahl oder einen Bereich.
</p>
<p>Dabei gibt es verschiedene Gewinnhöhen:</p>
<div class="list">
    <div>
    <p class="bold">35 facher Gewinn: </p>
    <p class="element"> setzen auf eine einzelne Zahl zwischen 0 - 36</p>
    <p class="bold">Verdopplung des Gewinns:</p>
    <p class="element">- setzen auf eine Hälfte</p>
    <p class="element">- setzen auf eine Farbe</p>
    <p class="bold">Verdreifachung des Gewinns:</p>
    <p class="element">- setzen auf eine Kolonne (Spalte)</p>
    <p class="element">- setzen auf ein Dutzend </p>
    </div>
    <img class="roulette" src="roulettebackground.png" alt="Roulette">
</div>
<br>
<p>

Anschließend starten Sie das Spiel.

Es wird eine zufällige Zahl geworfen und der mögliche Gewinn wird Ihnen sofort gutgeschrieben.

Nun können Sie von neuem beginnen.


Achtung, verspielen Sie kein Geld, was Sie nicht haben, dies gilt als Betrugsversuch.
</p>

<p class="subtitel">Das Würfelspiel</p>
<img class="wuerfel" src="wuerfel2.png" alt="würfel">
<p>Der Spieler hat bei diesem Spiel die möglichkeit auf den wurf eines Würfels zu wetten. Dabei kann er entweder auf:</p>
<div>
<p class="element">- eine bestimmte Zahl, für das 4 Fache vom Einsatz,</p>
<p class="element">- eine Zahl von 1 bis 3 oder 4 bis 5, für das doppelte des Einsatzes,</p>
<p class="element">- oder auf eine gerade oder ungerade Zahl, ebenfalls für das doppelte des Einsatzes, wetten</p>
</div>

<p class="subtitel">CABO</p> 
<img class="cabo" src="cabogame.png" alt="cabo">
<p>Beide Spieler erhalten zu Beginn vier Karten verdeckte hingelegt, wovon sie sich jeweils zwei ansehen dürfen und einprägen müssen, welche Zahlen sie von 0 bis 13 eben gesehen haben.</p>
<p>Die angesehenen Karten kommen verdeckt zurück an ihre alten Plätze und das Spiel beginnt. Wer an der Reihe ist hat fünf Optionen: </p>       
<p> entweder man zieht eine neue Karte vom Nachziehstapel, schaut sie sich an und ersetzt mit dieser verdeckt eine der vor einem ausliegenden Karten. Ziel ist es nämlich, eine möglichst kleine Summe mit seinen Karten bilden zu können.</p> 
<p>Oder aber man zieht die oberste offene Karte des Ablagestapels und platziert diese anstelle einer seiner Karten.</p>
<p>Außerdem können die Karten 7 bis 12, die neu vom Nachziehstapel gezogen wurden, abgelegt und mit der auf ihnen angegeben Sonderaktion genutzt werden. </p>     
<p>Die 7 und 8 erlauben es, unter eine seiner eigenen Karten zu schauen, wohingegen die 9 und 10 das anschauen einer Gegnerischen Karte ermöglicht. Mit der 11 und 12 kann eine eigene Karte mit der Karte des Mitspielers getauscht werden (natürlich ohne sich diese vorher noch einmal anzusehen).</p>
<img class="cabo2" src="cardbackround2.png" alt="">
<p>Als vierte Option kann man eine vom Nachziehstapel gezogene Karte auch ohne sie genutzt zu haben direkt wieder abwerfen. </p>
<p>Zu guter Letzt hat der Spieler die Möglichkeit, das Spielende einzuläuten: Meint er, die in Summe kleinste Kartenhand vor sich liegen zu haben, ruft er Cabo. Danach kommt der andere Spieler noch genau einmal zum Zuge. Im Anschluss wird der Sieger ermittelt. Dieser erhält für seinen glorreichen Sieg von uns 200 Rubine.</p>     
<p>Zusätzlich bietet die Regel noch einen kleinen Trick. Wer mehrere gleiche Karten vor sich liegen hat, kann diese mit einer einzigen Karte ersetzen. Somit kann es vorkommen, dass es einer der beiden Spieler oder auch beide weniger als vier Karten haben, im besten Fall sogar nur eine Karte.</p>  
 

<p class="subtitel">TicTacTao</p>
<img class="tictactao" src="tictactao_background2.png" alt=""> 

<p>Wie im beliebten Schulhofklassiker wird bei diesem Spiel versucht 3. Gleiche in eine Zeile, Spalte oder Diagonale zu bekommen</p>
<p>Die eingabe für das zu wählende Feld erfolgt hierbei in den beiden Eingabeboxen. Die erste symbolisiert hierbei die zu wählende Zeile und die zweite die zu wählende Spalte.</p>
<p>Dem Sieger werden bei diesem Spiel 50 Rubine gutgeschrieben.</p>
</div>