<?php session_start();
if(!isset( $_SESSION["username1"]) and !isset( $_SESSION["username2"])){
	header("location: anmelden.php");
   }
?>
<!DOCTYPE html>
<div class="header"> 
	<img class="logo" src="TicTacTao_logo.png" alt="">
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
table{
    border-collapse: separate;
    background-color: #222021;
    border: 1px dodgerblue;
    margin-top: 20px;
    margin-left: 20px;
}
table, th, td{
    border: 1px solid dodgerblue;
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
}
span{
    font-size: large;
    font-weight: bold;
  margin-top: 0pt;
  padding-top: 0pt;
  
}
</style>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
class playing_field{
function cordinates1 ($x, $y){
    $this->field[$x][$y] = "x";
 }
 function cordinates2 ($x, $y){
    $this->field[$x][$y] = "o";
 }
 function curfield($x,$y){
    return $this->field[$x][$y];
 }
 function setfield(){
    $this->field =array(
        array(".",".","."),
        array(".",".","."),
        array(".",".",".")
    );
    return $this->field;
 }
 function returnfield(){
    return $this->field;
 }
 function getfield($ground){
    $this->field = $ground;
 }
public $field =array();
}
function testwinconv($array, $x, $y){
    switch ($array[$x][$y]){
        case "x": return 1;
        case "o": return -1;
        case ".": return 0;
    }
}
function iswin($winner){
    $_SESSION["playerturn"]=1;
    return "player $winner won";
}
if (isset($_SESSION["win"])){
    unset($_SESSION["playerturn"]);
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
$result = mysqli_query($conn, $sql) or die(mysqli_error($con));
$arrayresult=mysqli_fetch_all($result);
$c=50+$arrayresult[0][1];
    $sql = "UPDATE player SET money=$c WHERE name = '$playername'";
    $_SESSION["Konto1"]=$c;
    $conn->query($sql);
$conn->close();

?>
<script>
    function restart(){
        window.location = window.location.href.split("?")[0];
    }
</script>
<div>
<div class="acount">
<span><?php echo $_SESSION["win"]?> hat gewonnen, dafür bekommt er 50</span>
<img class="rubine" src="rubine2.png" alt="">
</div>    

    <button onclick="restart()">Nochmal spielen</button>
</div>

<?php
unset($_SESSION["win"]);
}
else{
    $field1 = new playing_field;
if (!isset($_SESSION["playerturn"])){
    
    unset($_SESSION["field"]);
    unset($_SESSION["turncounter"]);
    $_SESSION["playerturn"]=1;
}
if ($_SESSION["playerturn"]==1 or $_SESSION["turncounter"] == 9) {
    $field1 ->setfield();
    $_SESSION["field"]=$field1 ->returnfield();
    $_SESSION["playerturn"]=2;
    $_SESSION["turncounter"]=0;
    echo $_SESSION['username2'];
    echo " darf ein Feld wählen";

}
else $field1->getfield($_SESSION["field"]);


if($_SERVER["REQUEST_METHOD"]=="POST"){
    $x = test_input($_POST["x"]);
    $y = test_input($_POST["y"]);
    if (testwinconv($field1->returnfield(),$x-1, $y-1) == 0){
        if ($_SESSION["playerturn"]==2){
            $field1 ->cordinates1($x-1,$y-1);
            $_SESSION["playerturn"]=3;
            echo $_SESSION['username1'];
            echo " darf ein Feld wählen";
        }elseif ($_SESSION["playerturn"]==3){
            $field1 ->cordinates2($x-1,$y-1);
            $_SESSION["playerturn"]=2; 
            echo $_SESSION['username2'];
            echo " darf ein Feld wählen";;

        }
        $_SESSION["field"]= $field1->returnfield();
        echo $_SESSION["turncounter"];
        $convfield=array(
            array(testwinconv($field1 ->returnfield(),0,0), testwinconv($field1->returnfield(),0,1), testwinconv($field1->returnfield(),0,2)),
            array(testwinconv($field1->returnfield(),1,0), testwinconv($field1->returnfield(),1,1), testwinconv($field1->returnfield(),1,2)),
            array(testwinconv($field1->returnfield(),2,0), testwinconv($field1->returnfield(),2,1), testwinconv($field1->returnfield(),2,2))
        );
        $i =0;
        while($i <3){
            $sum1 =0;
            $sum2 = 0;
            $sum3 = 0;
            $o =0;
            while ($o<3){
                $sum1 += $convfield[$i][$o];
                $sum2 += $convfield[$o][$i];
                $sum3 += $convfield[$o][$o];
                $o += 1;
            }
            if ($sum1 == 3 or $sum2==3 or $sum3==3){
                
                $_SESSION["win"]=$_SESSION["username2"];
                header("location: tictactao.php");
                break;
            }
            if ($sum1 == -3 or $sum2 == -3 or $sum3 == -3){
                $_SESSION["win"]=$_SESSION["username1"];
                header("location: tictactao.php");
                break;
            }
            $i += 1;
        }
        $sum =$convfield[0][2]+$convfield[1][1]+$convfield[2][0];
        if ($sum == 3){
            $_SESSION["win"]=$_SESSION["username1"];
                header("location: tictactao.php");
        }
        if ($sum == -3){
            $_SESSION["win"]=$_SESSION["username2"];
                header("location: tictactao.php");
        }
        $_SESSION["turncounter"] = $_SESSION["turncounter"] +1;
    }
}


?>
<html>
    <div class="playingfield">
    <table>
    <?php for($i=0; $i<=2;$i++){
        echo "<tr>";
        for($o=0;$o<=2;$o++){
            echo "<td>";
            if($field1 ->curfield($i, $o)=="o"){
                echo "<img src='tictactao_o.png' alt=''>";
            }
            elseif($field1 ->curfield($i, $o)=="x"){
                echo "<img src='titactao_x.png' alt=''>";  
            }
            else echo "<img src='tictactao_..png' alt=''>";
            "</td>";
        }
        echo "</tr>";
    } ?>
    </table>
   
<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  >
    <input type="number" name="x" value="<?php echo $x;?>">
    <input type="number" name="y" value="<?php echo $y;?>"> 
    <input type="submit" name="setzen" value="setzen">
</form>

</p>
</div></html>
<?php
}
?>



