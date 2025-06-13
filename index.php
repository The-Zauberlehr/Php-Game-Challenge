<!DOCTYPE html>
</style>
</head>
<body>
<div class="header"> 
	<img class="logo" src="logo4.png" alt="">
	<div class="header-right">
		<a class="Anleitung" href="anleitung.php">Anleitung</a>
    <a class="Registrieren" href="anmelden.php">Anmelden</a>

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
.button a:hover{
  background-color: dodgerblue;
  color: white;
}
button:hover{
  background-color: dodgerblue;
  color: white;
  box-shadow: 0pt 0pt 4pt black;
  transition: 0.2s;
}
h1{
  margin-left: 16pt;
}
.button{
 
    background-image: url("cabogame.png");
   
    
    
}
.button2{

    background-image: url("roulettebackground.png");
   
    
}
.button3{

background-image: url("tictactao_background.png");


}
.button4{

background-image: url("wuerfel.png");


}
button{
  float: left;
    color: black;
    border-radius: 10pt;

    background-color: lightblue;
    margin-left: 20px;
    margin-top: 20px;
    display: inline-flex;
    align-items: flex-end; 
    width: 220px;
    height: 250px;
    background-size: 100% 75%;
    background-repeat: no-repeat;
    padding-bottom: 10pt;
    text-align:center;
    
    
}
.gamecontainer{
    float: left;
    display: flex;
    flex-wrap: nowrap;
    
}
img{
    height: 25%;
    width: 25%;
}

input{
  background-color: red;
  border-radius: 6pt;
  margin-top: 16pt;
  color: white;
  float: right;
  display: inline-flex;
  width: 60pt;
  height: 30pt;
  align-items: flex-end;
  margin-right: 16pt;
  
}
.balance{
  float: left;
  width: 220px;
  height: 110px;
  border-radius: 10pt;
  color: black;
  font-size: 16pt;
  font-weight: bold;
  background-color: #ddd;
  border: black 1pt;
  margin-top: 20px;
  margin-left: 20px;
  text-align: center;
}
.secacountmes{
  float: left;
  width: 220px;
  height: 250px;
  border-radius: 10pt;
  color: black;
  font-size: 16pt;
  font-weight: bold;
  background-color: #ddd;
  border: black 1pt;
  margin-top: 20px;
  margin-left: 20px;
  text-align: center;
}
p{
  width: 100%;
  height: 14%;
}

hr {
  border: 1px solid grey; 
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
  margin-top: 0pt;
  padding-top: 0pt;
  
}


</style>
<script>
    function choosegame(location){
        window.location=location;
    }
</script>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="submit" name="logout" value="Abmelden">
    </form>
<h1>Willkomen zurück <?php session_start();
if ($_SERVER["REQUEST_METHOD"]=="POST"){
  session_unset();
}
     if(isset( $_SESSION["username1"]) and isset( $_SESSION["username2"])){
      echo $_SESSION["username1"];
      echo ", ";
      echo $_SESSION["username2"];
     }  elseif(isset( $_SESSION["username1"])){
      echo $_SESSION["username1"];
     } else{
      header("location: anmelden.php");
     } ?>
     </h1>

    
<div class="gamecontainer">

    <button class="button4" onclick="choosegame('würfelspiel.php')">Würfelspiel</button>
    <button class="button2" onclick="choosegame('roulette.php')">ROULETTE</button>
<?php if (isset($_SESSION["username2"])){?>
  <button class="button" onclick="choosegame('cabo2.php')">CABO</button>
  <button class="button3" onclick="choosegame('tictactao.php')"> TicTacTao</button>
   
<?php } 
else{ ?>
<div class="secacountmes">
  <p>Loggen sie sich unter Anmelden mit einem zweiten Acount ein, um Mehrspielerspiele Freizuschalten </p>
</div>
<?php }?>

  


    <div class="balance">
      <p>Dein Kontostand:</p>
    <hr>
      <div class="acount">
      <span><?php echo $_SESSION["Konto1"];?></span>
      <img class="rubine" src="rubine2.png" alt="RUBINE">
     
      </div>
      
      
      
     
      
      

      
    </div>
    

</div>
</html>
