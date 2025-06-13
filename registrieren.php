<!DOCTYPE html>
</style>
</head>
<body>
<div class="header"> 
	<img class="logo" src="logo4.png" alt="">
	<div class="header-right">
		<a class="Anleitung" href="test.php">Anleitung</a>
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
  session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "score";

// verbindung herstellen
$conn = new mysqli($servername, $username, $password, $db_name);
$playername = trim($_POST['playername']);
$passworduser = password_hash(trim($_POST["password"]),PASSWORD_DEFAULT);

// überprüfe verbindung
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO player (name, money, password) VALUES ('$playername',1000, '$passworduser')";


try {
  if ($conn->query($sql)===true){
    if (isset($_SESSION["username1"])){
      $_SESSION["username2"]=$playername;
    $_SESSION["Konto2"]=1000;
    header("location: index.php");
    }else
    $_SESSION["username1"]=$playername;
    $_SESSION["Konto1"]=1000;
    header("location: index.php");
  }

} catch (Exception $e) {
  $message="Spielername bereits vergeben";
}

$conn->close();

}

?> 
<html>
  <body>
    <div class="container">
    <h1>Registrieren</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="playername"><b>Spielername</b></label>
      <input type="text" placeholder="Spielername eintragen" name="playername" id="playername" required>
      <label for="password"><b>Passwort</b></label>
      <input type="password" placeholder="Passwort eintragen" name="password" id="password" required>
      <label for="creat_account"> <?php echo $message;?></label>
      <hr>
      <button type="submit" name="creat_account">Registrieren</button>
    </form>
    <div class="signin">
      Du hast schon einen Account? <a href="anmelden.php">Anmelden</a>
    </div>
    </div>
   
  </body>
</html>