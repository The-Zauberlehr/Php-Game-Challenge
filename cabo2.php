<?php
session_start();
if(!isset( $_SESSION["username1"]) and !isset( $_SESSION["username2"])){
	header("location: anmelden.php");
   }

?>
<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background: linear-gradient(45deg, black, #222021, blue);
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

.header img.logo{
	float: left;
	height: 60px;
	width: auto;
  	
}
.header-right {
  float: right;
}
.header a:hover {
  background-color: #ddd;
  color: black;
}
.header-right {
    float: none;
  }
.header a.active {
  background-color: dodgerblue;
  color: white;
}
.cardcontainer{

	overflow: hidden;
}
.cards{
	float: left;
	text-decoration: double;
	text-shadow: 0.5pt 0.5pt #222021;
	text-align: center;
	font-size: 16pt;
	padding-top: 55px;
	height: 122px;
	width: 87px;
	background-image: url("cardbackround.png");
	
}
.cardshidden{
	float: left;
	height: 122px;
	width: 87px;
	background-image: url("cardbackround2.png");
	
}
.playingground{
	overflow: hidden;
	padding: 30px 10px;
	text-size-adjust: 20px;
	font-size: 20pt;
	font-family: Arial, Helvetica, sans-serif;
	}
.placeholder{
	float: left;
	padding-top: 122px;
	
}
.acount{
  display: inline-flex;
  align-items: center;
  margin-top: 0px;
  margin-left: 0px;
  margin-right: 0px;

}
.rubine{
 height: 20pt;
 width: 15pt;
 margin-left: 10px;
}
span{
    font-size: large;
    font-weight: bold;
  margin-top: 0pt;
  padding-top: 0pt;
  
}
</style>
</head>
<body>
<div class="header"> 
	<img class="logo" src="logo2.png" alt="Cabo"> 
	<div class="header-right">
		<a class="home" href="index.php">Home</a>
	</div>
</div>	
<script>
			function reset() {
				window.location = window.location.href.split("?")[0]; //löschen der Get antworten
			}
</script>
<div class="playingground">

<?php
function distributecard($playernr, $x, $i) { //gibt dem Spieler $playernr aus dem Kartenstapel mit $x Karten eine Karte an der Stelle $i
	$randint =rand(0, $x);
	$_SESSION[$playernr][$i]=$_SESSION["cards"][$randint];
	array_splice($_SESSION["cards"],$randint,1);
}
function displaycards($playernr, $cardnr){ //grafische Ausgabe von bestimmten Karten aus Array
	echo "<div class='cardcontainer'>";
	for($i=1;$i<=count($_SESSION[$playernr]); $i++): //ausgabe der Karten
		if(in_array($i, $cardnr)){ //falls $i in den mitgegebenen cardnr dann zeige Wert der Karte 
		?>
				<div class="cards">
					
					<?php
					 echo $_SESSION[$playernr][$i-1];?>
				</div>
				
			<?php
		 }else{ //Ansonsten umgedrehte Karte
			echo"<div class='cardshidden'></div>";

		 } endfor;
			?>
	
	<?php
	echo "</div>";
}
function result($playernr, $nextplayer){ //endabrechnung wer Gewinner
	if (array_sum($_SESSION[$playernr])<= array_sum($_SESSION[$nextplayer])){
		if($playernr=="player1"){
			$_SESSION["win"]=$_SESSION["username1"];
			$loser = $_SESSION["username2"];
		}else {
			$_SESSION["win"]=$_SESSION["username2"];
			$loser = $_SESSION["username2"];
		}
		?>
		<?php echo $_SESSION["win"];?> hat mit <?php echo (array_sum($_SESSION[$playernr]));?> gewonnen </br>
		<?php echo $loser;?> hat <?php  echo (array_sum($_SESSION[$nextplayer]));?>
	<?php
	
	}else{
		if($playernr=="player2"){
			$_SESSION["win"]=$_SESSION["username1"];
			$loser = $_SESSION["username2"];
		}else {
			$_SESSION["win"]=$_SESSION["username2"];
			$loser = $_SESSION["username1"];
		}
		?>
		?>
		<?php echo $_SESSION["win"];?> hat mit <?php echo (array_sum($_SESSION[$nextplayer]));?> Punkten gewonnen </br>
		<?php echo $loser;?> hat <?php  echo (array_sum($_SESSION[$playernr]));?> Punkte
		<?php
		
	}
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "score";

// verbindung herstellen
$conn = new mysqli($servername, $username, $password, $db_name);

// überprüfe verbindung

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$playername =$_SESSION["win"];

$sql = "SELECT id, money FROM player WHERE name = '$playername'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$arrayresult=mysqli_fetch_all($result);
$c=200+$arrayresult[0][1];
    $sql = "UPDATE player SET money=$c WHERE name = '$playername'";
    $_SESSION["Konto1"]=$c;
    $conn->query($sql);
$conn->close();
echo "</br>";

?>
	<div class="acount">
<span><?php echo $_SESSION["win"]?> hat gewonnen, dafür bekommt er 200</span>
<img class="rubine" src="rubine2.png" alt="">
</div>   
	<button onclick="reset()">Neustart</button>
	<?php
	$_SESSION["counter"] = 0; //neustart des Programms
	exit;
}
function displaycardshidden($playernr, $nextplayer, $cycels)
{//$playernr = Spieler $nextplayer=nächster Spieler $cycels = wie viele Kartenstapel werden ausgegeben (falls 2: mit ablagestapel)
	for($o=1; $o<=$cycels;$o+=1){
	echo "<div class='cardcontainer'>";
	for($i=1;$i<=count($_SESSION[$playernr]); $i++): 
		?>
				<div class="cardshidden">
					
				</div>
				
			<?php endfor; 
			if($o ==1){//Ausgabe Ablagestapel?>
	<div class="placeholder"> <div class="cards"> <?php echo end($_SESSION["dumped"]);?></div></div>
	
	<?php 
	$playernr = $nextplayer;
			}
	echo "</div>";
	}
}
function drawcard($x){ //Karte ziehen aus $x Karten im Kartenstapel, entfernt Karte aus Kartenstapel und returnt diese als Wert der fkt.
$randint=rand(0,$x);
$drawncard=$_SESSION["cards"][$randint];
array_splice($_SESSION["cards"],$randint,1);
return $drawncard;
}

function replacecard($replacement, $playernr, $cardid) { // tauscht die Karte $replacement mit einer Karte eines Spielers $cardid
	$replaced=$_SESSION[$playernr][$cardid];
	$_SESSION[$playernr][$cardid]=$replacement;
	array_push($_SESSION["dumped"],$replaced);
}
function nextround(){ //Spielerwechsel mit löschen von Get Antwort
	if ($_SESSION["counter"] == 1){
		$_SESSION["counter"] = 2;?>
		<script>
			window.location = window.location.href.split("?")[0];
		</script>
		<?php
	}	
	elseif ($_SESSION["counter"] == 2){
		$_SESSION["counter"] = 1;
		?>
		<script>
			window.location = window.location.href.split("?")[0];
		</script>
		
	<?php
	}
}
function selectcards($playernr, $id, $nextplayer){  // Wählt eine Karte eines Spielers aus (falls $id werden die Karten beider Spieler zur auswahl angezeigt)
	?>
	<div class="cardcontainer">
		<form action="cabo2.php" method="get">
	<?php
	do {
		
		for($i=1;$i<=count($_SESSION[$playernr]); $i++):
			
			?>
					<div class="cardshidden">
					<input type='checkbox' name='cardnr<?php echo $id?>[]' value='<?php echo $i;?>'>
					</div>
					
				<?php endfor;
		$id --; 
		$playernr = $nextplayer;
		echo "<br>";
	} while ($id >= 1);?>
	
		
		<input type="submit" name="showcard" value="aufdecken">
		</form>
		</div>
		<?php
}
if (isset($_SESSION["counter"])==false or $_SESSION["counter"]==0){ //falls Startphase des Spieles
	
	unset($_SESSION["player1"]);
	unset($_SESSION["player2"]); 
	$_SESSION["lastround"]=false;
	$_SESSION["cards"]=array(0,0,1,1,1,1,2,2,2,2,3,3,3,3,4,4,4,4,5,5,5,5,6,6,6,6,7,7,7,7,8,8,8,8,9,9,9,9,10,10,10,10,11,11,11,11,12,12,12,12,13,13); //Kartenstapel
	for($i=0;$i<4;$i+=1){ // gib jedem Spieler 4 Karten
	distributecard("player1",(count($_SESSION["cards"])-1), $i);
	distributecard("player2",(count($_SESSION["cards"])-1), $i);
	}
	$_SESSION["dumped"]=array(drawcard(count($_SESSION["cards"])-1)); // ziehen einer Karte für den Ablagestapel
	$_SESSION["counter"]=3; // Phase 2 des Spieles Spieler 1 darf sich 2 karten anschauen
}
if ($_SESSION["counter"]==3){ 
  if(isset($_GET["cardnr1"]) and count($_GET["cardnr1"])==2){ //2 Karten zum anschauen augewählt
	displaycards("player1",$_GET["cardnr1"]);
	$_SESSION["counter"]=4; //spieler 2 darf sich 2 seiner Karten im Anschluss anschauen
	echo "<button onclick='reset()'>Weiter</button>";
  }
  else{
	echo $_SESSION["username1"];
	echo ": Wähle 2 Karten zum anschauen";
	selectcards("player1", 1,"");
  }
}
elseif ($_SESSION["counter"]==4){
	if(isset($_GET["cardnr1"]) and count($_GET["cardnr1"])==2){//2 Karten zum anschauen ausgewählt
		displaycards("player2",$_GET["cardnr1"]);
		$_SESSION["counter"]=rand(1,2); //zufälliger Spieler darf anfangen zu Spielen
		echo "<button onclick='reset()'>Weiter</button>";
		exit;
	  }
	  else{
		echo $_SESSION["username2"];
		echo ": Wähle 2 Karten zum anschauen";
		selectcards("player2", 1,"");
	  }	
}
elseif ($_SESSION["counter"]==1 ) { //vergabe der Spielervariablen (für unterscheidung der jeweiligen Spielehände benötigt)
	$playernr="player1";
	$nextplayer="player2";
	$curplayer = $_SESSION["username1"];
}else {$playernr="player2";
	$nextplayer="player1";
	$curplayer = $_SESSION["username2"];
}
if (isset($_SESSION["action"]) and $_SESSION["action"] != 0){ //falls durch ablage einer 7,8,9,10,11,12 Spezielle Aktion gestartet (Aktion wird weiter unten gesetzt)
	switch ($_SESSION["action"]) {
		case 7: //falls 7 o 8 schaue eine deiner Karten an
			if(isset($_GET["cardnr1"]) and count($_GET["cardnr1"])==1){//fals eine Karte ausgewählt
				$_SESSION["action"]=0;
				displaycards($playernr,$_GET["cardnr1"]);//anzeigen der einen Karte und der verdeckten Karten
				
				echo "<button onclick='reset()'>Weiter</button>";
				if ($_SESSION["counter"] == 1){ //Spielerwechsel
					$_SESSION["counter"] = 2;
					$playernr="player2";
					$nextplayer="player1";
				}	
				elseif ($_SESSION["counter"] == 2){
					$_SESSION["counter"] = 1;
					$playernr="player1";
					$nextplayer="player2";
				}	
			}
			else{ //zeigt auswählbare Karten an
				echo $curplayer;
				echo ": Wähle eine deiner Karten die du anschauen möchtest 1";
				selectcards($playernr, 1,""); //"" String nicht wichtig da nur ein paar Karten zur Auswahl steht
			}
			break;
		case 9: //falls 8 oder 9 abgelgt wurde
			if(isset($_GET["cardnr1"]) and count($_GET["cardnr1"])==1){ //falls Karte abgelgt wurde
				$_SESSION["action"]=0;
				displaycards($nextplayer,$_GET["cardnr1"]); //anzeige einer Karte des gegners
				
				echo "<button onclick='reset()'>Weiter</button>";
				if ($_SESSION["counter"] == 1){ //Spielerwechsel
					$_SESSION["counter"] = 2;
					$playernr="player2";
					$nextplayer="player1";
					$curplayer = $_SESSION["username2"];
				}	
				elseif ($_SESSION["counter"] == 2){
					$_SESSION["counter"] = 1;
					$playernr="player1";
					$nextplayer="player2";
					$curplayer = $_SESSION["username1"];

				}	
			}
			else{ // anzeige der Karten des nächsten Spielers zur auswahl
				echo $curplayer;
				echo ": Wähle eine Karten deines Gegners, die du dir anschauen möchtest 2";
				selectcards($playernr, 1,"");
			}
			break;
	
		case 11: // falls 11 oder 12 gelgegt
			if(isset($_GET["cardnr1"]) and isset($_GET["cardnr2"]) and count($_GET["cardnr1"])==1 and count($_GET["cardnr2"])){ //falls eine Karten des aktuellen sich an der reihe befindlichen und des nächsten Spielers gewählt
				$_SESSION["action"]=0;
				$valueholder=$_SESSION[$playernr][$_GET["cardnr2"][0]-1];
				$_SESSION[$playernr][$_GET["cardnr2"][0]-1]=$_SESSION[$nextplayer][$_GET["cardnr1"][0]-1];
				$_SESSION[$nextplayer][$_GET["cardnr1"][0]-1] = $valueholder; //Kartentausch 2 ausgewählter des aktuellen und des nächsten Spielers
				echo "<button onclick='reset()'>Weiter</button>";	
				if ($_SESSION["counter"] == 1){ //Spielerwechsel
					$_SESSION["counter"] = 2;
					$playernr="player2";
					$nextplayer="player1";
				}	
				elseif ($_SESSION["counter"] == 2){ 
					$_SESSION["counter"] = 1;
					$playernr="player1";
					$nextplayer="player2";
				}
			}
			else{ //anzeige der Karten beider Spieler
				echo $curplayer;
				echo ": Wähle eine Karten deines Gegners, die du mit einer deine Tauschen möchtest";
				selectcards($playernr, 2, $nextplayer);
			}
			
		break;
	
	}
	
	print_r($_SESSION["player1"]); //debug
	print_r($_SESSION["player2"]);
	echo end($_SESSION["dumped"]); 
	
}
elseif (!isset($_GET["aktion"]) and !isset($_GET["showcard"]) and isset($nextplayer) ){ //falls im aktuellen Spielzug noch keine Get variable gesetzt aber phase 2 (anschauen der Karten) abgeschlossen
	echo $curplayer;
	echo " ist am Zug 3";
	displaycardshidden($nextplayer, $playernr,2); //ausgabe beider Kartenhände verdeckt mit ablagestapel
	print_r($_SESSION["player1"]); //debug
	print_r($_SESSION["player2"]);
	//auswahl der möglichkeiten ziehen: neue Karte vom Kartenstapel ziehen, nehmen: Karte vom Ablagestapel nehmen, cabo: Spiel beenden Gegener ist noch einmal dran?>
	<html>

	<br><br>
	<form method="GET" action="cabo2.php">
	<input type="submit" name="aktion" value="ziehen">
	<input type="submit" name="aktion" value="nehmen">
	<input type="submit" name="aktion" value="cabo">
	</form>
	</html>
	<?php
}elseif (isset($_GET["aktion"])){//falls aktion ausgewählt
	
	$aktion = $_GET["aktion"];
	switch ($aktion) { 
		case 'nehmen': //auswahl einer oder mehrerer Karten mit der die ausgewählte Karte getauscht werden soll
			displaycardshidden($nextplayer, $playernr,1);
			selectcards($playernr, 1,"");
			$_SESSION["draw"]=false;
			break;
		case 'ziehen': //auswahl einer oder mehrerer Karten mit der die gezogene Karte getauscht werden soll (ziehen erlaubt start von aktionen)
			array_push($_SESSION["dumped"],drawcard(count($_SESSION["cards"])));
			displaycardshidden($nextplayer, $playernr,1);
			$_SESSION["draw"]=true;
			selectcards($playernr, 1,"");
			break;
		case 'cabo': //spiel beenden
			if ($_SESSION["lastround"]==false){ //falls nicht schon verheriger Spieler schluss gemacht, nächste Runde
			$_SESSION["lastround"]=true;
			nextround();
			}
			else result($playernr, $nextplayer);// ansonsen gib ergebnis bekannt
			break;
	
	}
	print_r($_SESSION["player1"]);//debug
	print_r($_SESSION["player2"]);
	
}elseif (isset($_GET["showcard"]) and $_SESSION["counter"] < 3){ //falls Phase 2 des Spieles beendet und eine oder mehrere Karten ausgewählt
	if (isset($_GET["cardnr1"])){ //falls eine Karte ausgewählt
		$_SESSION["action"]=0; //da gezogene Karte nicht abgeletgt kann keine aktion gestartet werden
		$nr=array();
		foreach($_GET["cardnr1"] as $choosencard){ // für jede Kartennr wird derren wert in einem neuen Arry ermittelt
			array_push($nr, $_SESSION[$playernr][$choosencard - 1]);
		}
		$cardschoosen = count($nr);
		if (count(array_unique($nr))===1 and count($nr)>1){  //falls alle gewählten Karten den gleichen Wert haben
			array_push($_SESSION[$playernr], end($_SESSION["dumped"])); //tausche alle gewählten Karten gegen die ein vorher gewählte oder gezogene aus
			for($i=0; $i<$cardschoosen; $i++){
				array_push($_SESSION["dumped"],$_SESSION[$playernr][$_GET["cardnr1"][0]-1]); //füge dem ablagestapel die Karten hinzu	
			}
			
			$cardcount = 1;
			foreach($_GET["cardnr1"] as $deletcard){
				array_splice($_SESSION[$playernr],$deletcard-$cardcount,1);
				$cardcount ++;
			}
		}
		elseif(count($nr)>1){ //falls nicht alle Karten gleich
			array_push($_SESSION[$playernr], end($_SESSION["dumped"])); //füge die Karte den HAndkarten des Spielers hinzu
			array_pop($_SESSION["dumped"]); //lösche die letzte karte des Ablagestapels
		}else{
			replacecard(end($_SESSION["dumped"]), $playernr,$_GET["cardnr1"][0]-1 ); //tausche Karte des Ablagestapels mit ausgewählter Handkarte
			
		} 
		
	}
	elseif(end($_SESSION["dumped"]) >6 and end($_SESSION["dumped"])<13 and $_SESSION["draw"]){// falls Karte gezogen und zwischen 6 und 13
		switch (end($_SESSION["dumped"])) { //setzen der bereits oben erklärten Aktionen
			case 7:
				$_SESSION["action"]=7;
				break;
			case 8:
				$_SESSION["action"]=7;
				break;	
			case 9:
				$_SESSION["action"]=9;
				break;
			case 10:
				$_SESSION["action"]=9;
				break;
			case 11:
				$_SESSION["action"]=11;
				break;
			case 12:
				$_SESSION["action"]=11;
				break;
			
		}
	$_SESSION["draw"]=false;
	}

	else $_SESSION["action"]=0; //falls das nicht zutrifft setze aktion auf 0 (keine ausgewählt)
	if ($_SESSION["lastround"] == false and $_SESSION["action"]==0){ //falls nicht letzte runde und keine aktion gestartet
		nextround();
	}elseif($_SESSION["action"]>0){ //falls aktion gestartet lösche alle gesetzten get variablen
		?>
		<script>
			window.location = window.location.href.split("?")[0];
		</script>
		
	<?php
	}
		else { //gib das Endergebnis bekannt
		result($playernr, $nextplayer);
	}
	
	}

?>
</div>
</body>