<!DOCTYPE html>
<?php 
session_start();
if(!isset( $_SESSION["username1"])){
	header("location: anmelden.php");
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
$playername =$_SESSION["username1"];

$sql = "SELECT id, money FROM player WHERE name = '$playername'";
$resultmysql = mysqli_query($conn, $sql) or die(mysqli_error($con));
$arrayresult=mysqli_fetch_all($resultmysql);
$c = $arrayresult[0][1];


?>
</style>
</head>
<body>
<div class="header"> 
	<img class="logo" src="wuerfelspiel_logo.png" alt="">
	<div class="header-right">
		<a class="home" href="index.php">Home</a>
 

	</div>
</div>	
<style>
	* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
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
  box-shadow: #222021 2px;
}
.header-right {
    float: none;
  }
.header a.active {
  background-color: dodgerblue;
  color: white;
}
hr{
    border: 1px solid grey;
  margin-bottom: 25px;
}
.betarea{
    margin-top: 16pt;
  padding-top: 8pt;
  margin-left: 7%;
  margin-right: 7%;
  padding-left: 5%;
  padding-right: 5%;
  padding-bottom: 16pt;
  background-color: #ECECEC;
  border-radius: 10pt;
  font-size: large;
  font-weight: bold;

    
   
    
}
input[type=number]{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: lightgray;
  
}
input[type=radio]{
    display: inline-block;
    border: none;
    background-color: blueviolet ;
    
}
button {
    background: linear-gradient(45deg, magenta, blueviolet, #3CA9E4);
    border-radius: 5pt;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
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
<?php
$result=$message=$resultText=$status="";

$c=$arrayresult[0][1];

function roll_dice() {
return rand(1, 6);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['bet']) && isset($_POST['guess'])) {

$bet = intval($_POST['bet']);
if ($bet <= $arrayresult[0][1] and $bet>0){
    $guess = $_POST['guess'];

    $number = isset($_POST['number']) ? intval($_POST['number']) : null;
    
    $result = roll_dice();
    
    if ($guess === 'number' && $number !== null && $result === $number) {
    $winning = $bet * 4;
    $resultText = "Richtig geraten: $number";
    $status = "Gewinn: $winning";
    }
    elseif
    (($guess === 'range1' && $result >= 1 && $result
    <= 3) || ($guess === 'range2' && $result >= 4 &&
    $result <= 6)) {
    $winning = $bet * 2;
    $resultText = "Richtig geraten: Bereich " . (($guess === 'range1') ? '1-3' : '4-6');
    $status = "Gewinn: $winning";
    }
    elseif (($guess === 'even' && $result % 2 === 0) || ($guess === 'odd' && $result % 2 !== 0)) {
    $winning = $bet * 2;
    $resultText = "Richtig geraten: " . (($guess === 'even') ? 'gerade' : 'ungerade');
    $status = "Gewinn: $winning";
    }
    else {$winning = -$bet; $resultText = "Falsch geraten";$status = "Verlust: $bet";
    }
    $c=$winning+$arrayresult[0][1];
    $sql = "UPDATE player SET money=$c WHERE name = '$playername'";
    $_SESSION["Konto1"]=$c;
    $conn->query($sql);
 
}
else $message= "So viel Geld besitzt du nicht";

}
}
$conn->close();
?>

<form method="post">
    <div class="betarea">
    <label for="bet"> Wie viel möchtest du setzen?</label>
<input type="number" id="bet" name="bet" required>
<label>Wähle deine Wette:</label> 
<input type="radio" id="number" name="guess" value="number" required>
<label for="number">Auf eine bestimmte Zahl (x4)</label>
<input type="number" id="number_bet" name="number" min="1" max="6"><br><br>
<input type="radio" id="range1" name="guess" value="range1" required>
<label for="range1">Auf die Zahlen 1 bis 3 (x2)</label>
<input type="radio" id="range2" name="guess" value="range2" required>
<label for="range2">Auf die Zahlen 4 bis 6 (x2)</label><br><br>
<input type="radio" id="even" name="guess" value="even" required>
<label for="even">Auf gerade Zahlen (x2)</label>
<input type="radio" id="odd" name="guess" value="odd" required>
<label for="odd">Auf ungerade Zahlen (x2)</label>
<hr>
<label for="roll"><?php echo $message; ?></label>
<button type="submit" class="roll">Würfeln</button>
</form>
<div class="report">
    <?php if (isset($_POST['bet']) && isset($_POST['guess'])) {
?>
<p><?php echo $resultText;?> es wurde eine <?php echo $result;?> gewürfelt</p>
<div class="acount">
<span class="acount"><?php echo $status;?></span>
<img class="rubine" src="rubine2.png" alt="Rubine">
</div>

<p> </p>
<?php } ?>
<div class="acount"><span>Konto: <?php echo $c;?></span>
<img class="rubine" src="rubine2.png" alt="Rubine">

</div>


</div>
    </div>
