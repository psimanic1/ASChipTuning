<style>


</style>
<?php
include 'crud.php';
include 'klase.php';

session_start();
//dodavanje vozila
if( $_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['username'])){
		$model=htmlspecialchars($_POST["model"]);
		$motor=htmlspecialchars($_POST["motor"]);
		$hp=htmlspecialchars($_POST["hp"]);
		$kw=htmlspecialchars($_POST['kw']);
		$snaga=htmlspecialchars($_POST['snaga']);
		$obrtaji=htmlspecialchars($_POST['obrtaji']);
		$cijena=htmlspecialchars($_POST['cijena']);
		
		if(!empty($model) && !empty($motor) && !empty($hp) && !empty($kw) && !empty($snaga) && !empty($obrtaji) && !empty($cijena)){
			if(isset($_POST['tipVozila']))
				$tipV = $_POST['tipVozila']?:'';
			else{
				$tipV="";
			}
			if($tipV==0) $tipVozila="Auto";
			else if($tipV==1) $tipVozila="Kamion";
			else if($tipV==2) $tipVozila="Motor";
			else $tipVozila=null;
			//dodavanje slike
			$idUploadovaneSlike=0;
			$target_dir = "../uploads/vozila/".$tipVozila."/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$video=0;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					//echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Check file size
			//povecati velicinu fajla ovo je 500kb
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				echo "Sorry, only JPG, JPEG & PNG files are allowed.";
				$uploadOk = 0;
			}

			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$slika=new Slika();
					//idFoldera je 2 jer su tu slike za vozila
					$slika->SlikaCtor(0,$target_file,$video,2);
					$idUploadovaneSlike=dodajSliku($slika);
					if(isset($_POST['markaVozila']))
						$markaVozila = $_POST['markaVozila']?:'';
					else{
						$markaVozila=0;
					}
					if($idUploadovaneSlike!=0 && $markaVozila!=0){						
						$auto=new Vozilo();
						$auto->VoziloCtor(0,$model,$tipVozila,$motor,$hp,$kw,$snaga,$obrtaji,$cijena,$markaVozila,$idUploadovaneSlike);
						$id=dodajVozilo($auto);
						
						if($id!=0){ 
							PrikaziDodanoVozilo(dajVoziloPoId($id));
							echo "<script> alert('Uspjesno ste dodali vozilo!'); </script>";
						}
						else{
							obrisiSlikuPoId($idUploadovaneSlike);
							unlink($target_file);
							echo "<script> alert('Niste dodali proivodjaca!'); </script>";
						}
					}			
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			echo "Nisu sve vrijednosti postavljene";
		}	
	}
	
	function PrikaziDodanoVozilo($vozilo){
		echo '<div style="display:inline-block; float:right" id="dodanoAuto">
				<h2 style="margin: 20px 0;">'.dajProizvodjacaPoId($vozilo["idProizvodjaca"])["markaVozila"].'</h2>
				<div>Model: '.$vozilo["model"].'</div>
				<div>Motor: '.$vozilo["motor"].'</div>
				<div>HP: '.$vozilo["hp"].'</div>
				<div>kW: '.$vozilo["kw"].'</div>
				<div>Snaga: '.$vozilo["snaga"].'</div>
				<div>Obrtaji: '.$vozilo["obrtaji"].'</div>
				<div>Cijena: '.$vozilo["cijena"].'</div>
				<div><img style="max-width:150px; max-height:150px;" src="'.dajSlikuPoid($vozilo["idSlike"])["path"].'" alt=""></div>			
				<input type="button" onclick="dodajStage('.$vozilo["id"].')" value="Dodaj Stage"/>
			</div>';	
	}
	
	function PrikaziMarkeVozila($lista){
		for($i=0; $i<count($lista); $i++){
			echo '<option value="'.$lista[$i]["id"].'">'.$lista[$i]["markaVozila"].'</option>"';	
		}
	}

?>

<?php 
 if(!empty($_SESSION["username"])){
?>

<form style="display:inline-block; float:left" id="dodajAuto" method="POST" enctype="multipart/form-data">
	<label>Marka vozila:</label>
	<select id="markaVozila" name="markaVozila">
		<?php
			PrikaziMarkeVozila(dajSveProizvodjace());							
		?>
	</select></br>
	<br>
	<label>Tip vozila:</label>
	<select id="tipVozila" name="tipVozila">
		<option value="0">Auto</option>
		<option value="1">Kamion</option>
		<option value="2">Motor</option>
	</select></br>
	<br>
	<label>Model:</label></br>
	<input type="text" name="model" id="model" /></br>
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
	<label>Izaberite sliku:<label></br>
	<br>
	<input type="file" name="fileToUpload" id="fileToUpload"/>
	<input type="submit" value="Submit" name="submit"/>
</form>

<?php
}else{
	echo 'Nemate privilegije admina!';
}
?>

<script>
$('#dodajAuto').submit( function( e ) {
		$.ajax( {
		  url: '../php/dodajVozilo.php',
		  type: 'POST',
		  data: new FormData(this),
		  processData: false,
		  contentType: false,
		  success:function(response){
			  $("#centerAdminPanel").html(response);
		  }
		});
    e.preventDefault();
	});
	
function dodajStage(id){
	urlTmp='../php/dodajStage.php';
	var datarow={
		'idVozila':id
	};
	$.ajax({
	   url: urlTmp,
	   type:    'GET',
	   data: datarow,
	 success: function(response){
		$("#centerAdminPanel").html(response);
	 }});
	return false;
}
</script>
