<?php
include 'crud.php';
session_start();
//$_SESSION['username']="";

if( $_SERVER["REQUEST_METHOD"] == "POST" ){
	$_SESSION['username']="";
	if(isset($_REQUEST['username']) && isset($_REQUEST['pass']) && empty($_SESSION['username'])){
		Login($_REQUEST['username'],$_REQUEST['pass']);
	}
	
	if(isset($_REQUEST['odjava'])){
		echo "logout";
		$_SESSION['username']="";
		session_destroy();
	}
}
function Login($username, $password){
	
	$passHash=$password;//md5($password);
	$korisnik=LoginServer($username,$passHash);
	if($korisnik!=null){
		$_SESSION['username']=$username;					
		echo "<script> var greska='Uspjesno ste se logovali!'; </script>";
	}else{
		echo "<script> alert('Pogresan username i sifra!'); </script>";
	}
}
?>


<?php
if(empty($_SESSION['username']))
{
?>

<link rel="stylesheet" href="../layout/styles/login.css">
<div id="login">
<!--onsubmit="return SubmitLogin()" method="POST"-->
	<form id="loginForm" >
	<h1>Log In</h1>
		<div class="ineline">
			<p class="ineline tbprijava">Username:</p>
			<input type="text" id="username" name="username" value="" oninput="Validiraj(this)">	
		</div>
		<div class="ineline">
			<p class="ineline tbprijava">Sifra:</p>
			<input type="password" id="pass" name="pass" value="" oninput="Validiraj(this)">
		</div>
		<br>
		
		<div class="ineline">
			<input class="btnPrijava" onclick="return SubmitLogin()" type="submit" name="login" value="Prijavi se" id="submit" disabled="disabled">
		</div>
		<div class="ineline">
			<input class="btnIzadji" type="button" value="Izadji" onclick="Zatvori()">
		</div>

	</form>
</div>


<?php
}
?>
