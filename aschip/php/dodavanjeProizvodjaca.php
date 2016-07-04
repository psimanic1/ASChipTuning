<style>


</style>
<?php
include 'crud.php';
include 'klase.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"])){
	if($_POST["markaVozila"]){

		$idUploadovaneSlike=0;
		$target_dir = "../uploads/proizvodjaci/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$video=0;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				echo "Fajl nije slika ili video.";
				$uploadOk = 0;
			}
		}

		//povecati velicinu fajla ovo je 500kb
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Fajl je prevelik";
			$uploadOk = 0;
		}
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			echo "Samo JPG, JPEG, PNG & GIF fajlovi su dozvoljeni.";
			$uploadOk = 0;
		}

		
		if ($uploadOk == 0) {
			echo "Greska prilikom dodavanja slike.";
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$slika=new Slika();
				//idFoldera je 1 jer su tu slike za proizvodjace
				$slika->SlikaCtor(0,$target_file,$video,1);
				$idUploadovaneSlike=dodajSliku($slika);
				if($idUploadovaneSlike!=0){
					$markaVozila=htmlspecialchars($_POST['markaVozila']);
					$proiz=new Proizvodjac();
					$proiz->ProizvodjacCtor(0,$markaVozila,$idUploadovaneSlike);
					$id=dodajProizvodjaca($proiz);
					if($id!=0){ 
						echo "<script> alert('Uspjesno ste dodali proizvodjaca!'); </script>";
					}
					else{
						obrisiSlikuPoId($idUploadovaneSlike);
						unlink($target_file);
						echo "<script> alert('Niste dodali proivodjaca!'); </script>";
					}
				}			
			} else {
				echo "Greska prilikom dodavanja slike.";
			}
		}
	}else{
		echo "<script> alert('Niste unijeli proivodjaca ili sliku!'); </script>";
	}
	
}
?>

<?php 
 if(!empty($_SESSION["username"])){
?>

<form id="dodajProizvodjaca" method="POST" enctype="multipart/form-data">
	<label>Izaberite sliku:<label></br>
	<br>
	<input type="file" name="fileToUpload" id="fileToUpload"/></br>
	<br>
	<label>Proizvodjac:</label></br>
	<input type="text" name="markaVozila" id="markaVozila" oninput="ValidirajProizvodjaca(this)" /></br>
	<br>
	<input type="submit" value="Submit" name="submit" id="submit" disabled="disabled"/>
</form>
<?php
}else{
	echo 'Nemate privilegije admina!';
}
?>
<script>
$('#dodajProizvodjaca').submit( function( e ) {
		$.ajax( {
		  url: '../php/dodavanjeProizvodjaca.php',
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
	
//validacija
$("#markaVozila").addClass("redBorder");
$("#fileToUpload").addClass("redBorder");

 $("input:file").change(function (){
	var fileName = $(this).val();
	if(fileName!=null)
		removeRedBorder(this);		
	else 
		addRedBorder(this);
	
});

function ValidirajProizvodjaca(tb){
	var reg=/\w{2}/i;
	if(!reg.test(tb.value)){
		addRedBorder(tb);
		$("#submit").attr("disabled","disabled");
	}else{
		removeRedBorder(tb);
	}
}

function addRedBorder(tb){
	$(tb).addClass("redBorder");
}

function removeRedBorder(tb){
	$(tb).removeClass("redBorder");
	Check();
}

function Check(){
	var prviEl=$("#markaVozila").hasClass("redBorder");
	var treciEl=$("#fileToUpload").hasClass("redBorder");
	if(!prviEl && !treciEl)
		$("#submit").removeAttr("disabled");
}
</script>