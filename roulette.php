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
$result = mysqli_query($conn, $sql) or die(mysqli_error($con));
$arrayresult=mysqli_fetch_all($result);


?>
<html>
<div class="header">
<img class="logo" src="Roulette_logo.png" alt="">
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
.playingfield{
  margin: 20px 20px 20px 20px;
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
 margin-right: 10px;
}
span{
    font-size: large;
    font-weight: bold;
  margin-top: 0pt;
  padding-top: 0pt;
  
}
</style>
<body>
  <div class="playingfield">
<div class="acount">
<span>
Sie haben am Anfang einen Kontostand von <?php echo $arrayresult[0][1]; ?>
</span>
<img class="rubine" src="rubine2.png" alt="Rubine">



</div>
<br>
<br>
<span>Wie viel Geld können Sie gewinnen?</span>



<form method="GET" action="roulette.php">
<p> Betrag setzen: <input type="number" name="a"/>

-Bitte wählen Sie Ihr Feld-

</p>
<p>
<table border="1">
<tr>
<td></td>
<td bgcolor="#81F781">0<input type="radio" name="s" value="0"/></td>
<td></td>
</tr>
<tr>
<td bgcolor="#FA5858">1<input type="radio" name="s" value="1"/></td>
<td bgcolor="#6E6E6E">2<input type="radio" name="s" value="2"/></td>
<td bgcolor="#FA5858">3<input type="radio" name="s" value="3"/></td>
<td bgcolor="#819FF7">1*12<input type="radio" name="s" value="112"/></td>
</tr>
<tr>
<td bgcolor="#6E6E6E">4<input type="radio" name="s" value="4"/></td>
<td bgcolor="#FA5858">5<input type="radio" name="s" value="5"/></td>
<td bgcolor="#6E6E6E">6<input type="radio" name="s" value="6"/></td>
</tr>
<tr>
<td bgcolor="#FA5858">7<input type="radio" name="s" value="7"/></td>
<td bgcolor="#6E6E6E">8<input type="radio" name="s" value="8"/></td>
<td bgcolor="#FA5858">9<input type="radio" name="s" value="9"/></td>
<td></td>
<td bgcolor="#F3F781">1-18<input type="radio" name="s" value="118"/></td>
</tr>
<tr>
<td bgcolor="#6E6E6E">10<input type="radio" name="s" value="10"/></td>
<td bgcolor="#6E6E6E">11<input type="radio" name="s" value="11"/></td>
<td bgcolor="#FA5858">12<input type="radio" name="s" value="12"/></td>
<td></td>
<td bgcolor="#FAAC58">Gerade(42)<input type="radio" name="s" value="42"/></td>
</tr>
<tr>
<td bgcolor="#6E6E6E">13<input type="radio" name="s" value="13"/></td>
<td bgcolor="#FA5858">14<input type="radio" name="s" value="14"/></td>
<td bgcolor="#6E6E6E">15<input type="radio" name="s" value="15"/></td>
<td bgcolor="#819FF7">2*12<input type="radio" name="s" value="212"/></td>
</tr>
<tr>
<td bgcolor="#FA5858">16<input type="radio" name="s" value="16"/></td>
<td bgcolor="#6E6E6E">17<input type="radio" name="s" value="17"/></td>
<td bgcolor="#FA5858">18<input type="radio" name="s" value="18"/></td>
<td></td>
<td bgcolor="#FA5858">Rot(43)<input type="radio" name="s" value="43"/></td>
</tr>
<tr>
<td bgcolor="#FA5858">19<input type="radio" name="s" value="19"/></td>
<td bgcolor="#6E6E6E">20<input type="radio" name="s" value="20"/></td>
<td bgcolor="#FA5858">21<input type="radio" name="s" value="21"/></td>
<td></td>
<td bgcolor="#6E6E6E">Schwarz(44)<input type="radio" name="s" value="44"/></td>
</tr>
<tr>
<td bgcolor="#6E6E6E">22<input type="radio" name="s" value="22"/></td>
<td bgcolor="#FA5858">23<input type="radio" name="s" value="23"/></td>
<td bgcolor="#6E6E6E">24<input type="radio" name="s" value="24"/></td>
</tr>
<tr>
<td bgcolor="#FA5858">25<input type="radio" name="s" value="25"/></td>
<td bgcolor="#6E6E6E">26<input type="radio" name="s" value="26"/></td>
<td bgcolor="#FA5858">27<input type="radio" name="s" value="27"/></td>
<td bgcolor="#819FF7">3*12<input type="radio" name="s" value="312"/></td>
</tr>
<tr>
<td bgcolor="#6E6E6E">28<input type="radio" name="s" value="28"/></td>
<td bgcolor="#6E6E6E">29<input type="radio" name="s" value="29"/></td>
<td bgcolor="#FA5858">30<input type="radio" name="s" value="30"/></td>
<td></td>
<td bgcolor="#FAAC58">Ungerade(45)<input type="radio" name="s" value="45"/></td>
</tr>
<tr>
<td bgcolor="#6E6E6E">31<input type="radio" name="s" value="31"/></td>
<td bgcolor="#FA5858">32<input type="radio" name="s" value="32"/></td>
<td bgcolor="#6E6E6E">33<input type="radio" name="s" value="33"/></td>
<td></td>
<td bgcolor="#F3F781">19-36<input type="radio" name="s" value="1936"/></td>
</tr>
<tr>
<td bgcolor="#FA5858">34<input type="radio" name="s" value="34"/></td>
<td bgcolor="#6E6E6E">35<input type="radio" name="s" value="35"/></td>
<td bgcolor="#FA5858">36<input type="radio" name="s" value="36"/></td>
</tr>
<tr>
<td bgcolor="#AC58FA">Kolonne 1(46)<input type="radio" name="s" value="46"/></td>
<td bgcolor="#AC58FA">Kolonne 2(47)<input type="radio" name="s" value="47"/></td>
<td bgcolor="#AC58FA">Kolonne 3(48)<input type="radio" name="s" value="48"/></td>
</tr>
</table>
</p>
<p>
<input type="submit" name="spielen" value="spielen"/>
<hr>
</form>
</p>
<p>
</p>
<p>
<?php
  


if(isset($_GET["spielen"])and isset($_GET["s"]) and !empty($_GET["a"])){
$s=$_GET["s"];
$a=$_GET["a"];
$z=rand(0,36);
$g=0;
$k=0;
$k1=array(1,4,7,10,13,16,19,22,25,28,31,34);
$k2=array(2,5,8,11,14,17,20,23,26,29,32,35);
$k3=array(3,6,9,12,15,18,21,24,27,30,33,36);
$d1=array(1,2,3,4,5,6,7,8,9,10,11,12);
$d2=array(13,14,15,16,17,18,19,20,21,22,23,24);
$d3=array(25,26,27,28,29,30,31,32,33,34,35,36);
$h1=array(1,2,3,4,5,6,7,8,9,10,12,13,14,15,16,17,18);
$h2=array(19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36);
$ro=array(1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36);
$sc=array(2,4,6,8,10,11,13,15,17,20,22,24,26,28,29,30,33,35);
$ge=array(2,4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36);
$ug=array(1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35);
$c=$arrayresult[0][1];


echo "Die Kugel ist auf der Zahl $z gelandet.
";
if($s<=36 and $s>=0){
echo "Sie haben auf $s gesetzt.
";
if($s==$z){
$g=1;
$k=35;
}
}elseif($s==46){
echo "Sie haben auf Kolonne 1 gesetzt.";
for($i1=0; $i1<=11; $i1++){

if($k1[$i1]==$z){
$g=1;
$k=3;
}
}
}elseif($s==47){
echo "Sie haben auf Kolonne 2 gesetzt.
";
for($i2=0; $i2<=11; $i2++){
if($k2[$i2]==$z){
$g=1;
$k=3;
}
}
}elseif($s==48){
echo "Sie haben auf Kolonne 3 gesetzt.
";
for($i3=0; $i3<=11; $i3++){
if($k3[$i3]==$z){
$g=1;
$k=3;
}
}
}elseif($s==112){
echo "Sie haben auf das 1. Duzent gesetzt.
";
for($i4=0; $i4<=11; $i4++){
if($d1[$i4]==$z){
$g=1;
$k=3;
}
}
}elseif($s==212){
echo "Sie haben auf das 2. Duzent gesetzt.
";
for($i5=0; $i5<=11; $i5++){
if($d2[$i5]==$z){
$g=1;
$k=3;
}
}
}elseif($s==312){
echo "Sie haben auf das 3. Duzent gesetzt.";
for($i6=0; $i6<=11; $i6++){
if($d3[$i6]==$z){
$g=1;
$k=3;
}
}
}elseif($s==118){
echo "Sie haben auf die 1. Hälfte gesetzt.";
for($i7=0; $i7<=16; $i7++){
if($h1[$i7]==$z){
$g=1;
$k=2;
}
}
}elseif($s==1936){
echo "Sie haben auf die 2. Hälfte gesetzt.
";
for($i8=0; $i8<=17; $i8++){
if($h2[$i8]==$z){
$g=1;
$k=2;
}
}
}elseif($s==42){
echo "Sie haben auf gerade Zahlen gesetzt.
";
for($i9=0; $i9<=17; $i9++){
if($ge[$i9]==$z){
$g=1;
$k=2;
}
}
}elseif($s==45){
echo "Sie haben auf ungerade Zahlen gesetzt.
";
for($i10=0; $i10<=17; $i10++){
if($ug[$i10]==$z){
$g=1;
$k=2;
}
}
}elseif($s==43){
echo "Sie haben auf Rot gesetzt.
";
for($i11=0; $i11<=17; $i11++){
if($ro[$i11]==$z){
$g=1;
$k=2;
}
}
}elseif($s==44){
echo "Sie haben auf Schwarz gesetzt.
";
for($i12=0; $i12<=17; $i12++){
if($sc[$i12]==$z){
$g=1;
$k=2;
}
}
}else echo "ungültige Eingabe";
if ($a>$c){
$k=0;
$g=2;
$a=0;
echo "Betrugsversuch, Gewinn ungültig.
";
}
$b=$k*$a;

if($g==0){
echo "Sie haben leider verloren.
";
}elseif($g==1){
echo "Herzlichen Glückwunsch, Sie haben gewonnen.
";
}
$c= $c - $a + $b;
?>
<div class="acount">
<span><?php echo "Sie haben $a";?></span>
<img class="rubine" src="rubine2.png" alt="Rubine">
<span><?php echo "bezahlt und $b";?></span>
<img class="rubine" src="rubine2.png" alt="Rubine">
<span>gewonnen</span>
</div>
<p></p>
<div class="acount">

<span>Konto: <?php echo $c;?></span>
<img class="rubine" src="rubine2.png" alt="Rubine">
</div>
<?php


$sql = "UPDATE player SET money=$c WHERE name = '$playername'";
$_SESSION["Konto1"]=$c;
$conn->query($sql);

} else echo "Bitte geben Sie einen Wert ein.";



$conn->close();
?>



</p>
</div>
</body>
</html>