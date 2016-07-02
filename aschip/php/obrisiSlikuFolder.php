<?php
include 'crud.php';
include 'klase.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"]) && isset($_POST["idFoldera"])){
	if(obrisiFolderPoId($_POST["idFoldera"]))
		//echo "<script> alert('Folder je uspjesno obrisan'); </script>";
		echo "Folder je uspjesno obrisan";
	else
		echo "<script> alert('Folder nije obrisano'); </script>";
}

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"]) && isset($_POST["idSlike"])){
	if(obrisiSlikuPoId($_POST["idSlike"]))
		//echo "<script> alert('Slika je uspjesno obrisana'); </script>";
		echo "Slika je uspjesno obrisana";
	else
		echo "<script> alert('Slika nije obrisano'); </script>";
}

?>