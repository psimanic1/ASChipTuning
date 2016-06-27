<?php
include 'crud.php';
session_start();
$_SESSION['username']="";

if( $_SERVER["REQUEST_METHOD"] == "POST" ){
	if(isset($_REQUEST['username']) && isset($_REQUEST['pass'])){
		Login($_REQUEST['username'],$_REQUEST['pass']);
	}
	
	if(isset($_REQUEST['odjava'])){
		$_SESSION['username']="";
		session_destroy();
	}
}
function Login($username, $password){
	
	$passHash=$password;//md5($password);
	$korisnik=LoginServer($username,$passHash);
	if($korisnik!=null){
		$_SESSION['username']=$username;					
		echo "<script> alert('Uspjesno ste se logovali!'); </script>";
	}else{
		echo "<script> alert('Pogresan username i sifra!'); </script>";
	}
}
?>


<?php
if($_SESSION['username']=="")
{
?>

<link rel="stylesheet" href="../layout/styles/login.css">
<div id="login">
	<form id="loginForm" action="login.php" method="POST">
	<h1>Log In</h1>
		<div class="ineline">
			<p class="ineline tbprijava">Username:</p>
			<input type="text" name="username" value="">	
		</div>
		<div class="ineline">
			<p class="ineline tbprijava">Sifra:</p>
			<input type="password" name="pass" value="">
		</div>
		<br>
		
		<div class="ineline">
			<input class="btnPrijava" type="submit" name="login" value="Prijavi se">
		</div>
	</form>
</div>


<?php
}else{
?>
<div id="logout">
	<form method="post" action="login.php">
		<input class="btnPrijava" name="odjava" value="Odjavi se" type="submit"/>
	</form>
</div>
<?php
}	
?>		