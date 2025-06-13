<!DOCTYPE html>
</style>
</head>
<body>
<div class="header"> 
	<img class="logo" src="logo4.png" alt="">
	<div class="header-right">
		<a class="Anleitung" href="anleitung.php">Anleitung</a>
        <?php  session_start();
        if(isset( $_SESSION["username1"])  ){
           
            ?>
            <a class="home" href="index.php">Home</a>
            <?php
           }?>
	</div>
</div>	
<style>
	* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  
}

* {
  box-sizing: border-box;
}
.container {
  margin-top: 16pt;
  padding-top: 8pt;
  margin-left: 7%;
  margin-right: 7%;
  padding-left: 5%;
  padding-right: 5%;
  padding-bottom: 16pt;
  background-color: #ECECEC;
  border-radius: 10pt;
 
}
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
hr {
  border: 1px solid grey;
  margin-bottom: 25px;
}
button {
  background-color: blueviolet;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity: 1;
}
a {
  color: dodgerblue;
}

.signin {
  margin-top: 10pt;
  height: 50px;
  background-color: #f1f1f1;
  text-align: center;
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
</style>

<?php
$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  echo "hi";
 
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "score";

// verbindung herstellen
$conn = new mysqli($servername, $username, $password, $db_name);
$playername = trim($_POST['playername']);
$passworduser = trim($_POST["password"]);

// überprüfe verbindung
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, money, password FROM player WHERE name = '$playername'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($con));

$arrayresult=mysqli_fetch_all($result);
if ($arrayresult!= null){
    if(password_verify($passworduser,$arrayresult[0][2])){
        if (isset($_SESSION["username1"])){
            $_SESSION["username2"]=$playername;
          $_SESSION["Konto2"]=1000;
          header("location: index.php");
          }else {
          $_SESSION["username1"]=$playername;
          $_SESSION["Konto1"]=$arrayresult[0][1];
          header("location: index.php");
        }
    }
    else{
        $message="Passwort falsch";
    }
}
else{
    $message="Spielername existiert nicht in Datenbank";
}

$conn->close();

}

?> 
<html>
  <body>
    <div class="container">
    <h1>Anmelden</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="playername"><b>Spielername</b></label>
      <input type="text" placeholder="Spielername eintragen" name="playername" id="playername" required>
      <label for="password"><b>Passwort</b></label>
      <input type="password" placeholder="Passwort eintragen" name="password" id="password" required>
      <label for="login"> <?php echo $message;?></label>
      <hr>
      <button type="submit" name="login">Anmelden</button>
    </form>
    <div class="signin">
      Du hast noch keinen Account? <a href="registrieren.php">Registrieren</a>
    </div>
    </div>
   
  </body>
</html>