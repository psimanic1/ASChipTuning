<style>


</style>
<?php
include 'crud.php';
include 'klase.php';

//dodavanje vozila
if( $_SERVER["REQUEST_METHOD"] == "POST" ){
		$model=htmlspecialchars($_POST['model']);
		if(isset($_POST['tipVozila']))
			$tipV = $_POST['tipVozila']?:'';
		else{
			$tipV="";
		}
		if($tipV==1) $tipVozila="Auto";
		else if($tipV==2) $tipVozila="Kamion";
		else if($tipV==3) $tipVozila="Motor";
		else $tipVozila=null;
		$motor=htmlspecialchars($_POST['motor']);
		$hp=htmlspecialchars($_POST['hp']);
		$kw=htmlspecialchars($_POST['kw']);
		$snaga=htmlspecialchars($_POST['snaga']);
		$obrtaji=htmlspecialchars($_POST['obrtaji']);
		$cijena=htmlspecialchars($_POST['cijena']);
		$auto=new Vozilo();
		$auto->VoziloCtor(0,$model,$tipVozila,$motor,$hp,$kw,$snaga,$obrtaji,$cijena);
		$id=dodajVozilo($auto);
		if($id!=0) echo "<script> alert('Uspjesno ste dodali vozilo!'); </script>";
		else echo "<script> alert('Niste dodali vozilo!'); </script>";
	}
?>

<form id="dodajAuto" method="POST">
	<label>Model:</label></br>
	<input type="text" name="model" id="model" /></br>
	<label>Tip vozila:</label></br>
	<select id="tipVozila" name="tipVozila">
		<option value="0">Auto</option>
		<option value="1">Kamion</option>
		<option value="2">Motor</option>
	</select></br>
	<label>Motor:</label></br>
	<input type="text" name="motor" id="motor" /></br>
	<label>HP:</label></br>
	<input type="number" min="0" name="hp" id="hp" /></br>
	<label>kW:</label></br>
	<input type="number" min="0" name="kw" id="kw" /></br>
	<label>Snaga:</label></br>
	<input type="number" min="0" name="snaga" id="snaga" /></br>
	<label>Obrtaji:</label></br>
	<input type="number" min="0" name="obrtaji" id="obrtaji" /></br>
	<label>Cijena:</label></br>
	<input type="text" name="cijena" id="cijena" /></br>
	<input type="submit" value="submit" name="submit"/>
</form>