<?php
include 'crud.php';
include 'klase.php';

//echo '<script> alert("Test"); </script>';
if( $_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["imeFoldera"])){
		if(!empty($_FILES["fileToUpload"]["name"])){
		$target_dir = "../uploads/galerija/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$video=0;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		/*if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				//echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "Fajl nije slika ili video.";
				$uploadOk = 0;
			}
		}*/
		// Check if file already exists
		/*if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}*/
		// Check file size
		//povecati velicinu fajla ovo je 500kb=500000
		if ($_FILES["fileToUpload"]["size"] > 50000000) {
			echo "Fajl je prevelik, mora biti manji od 50MB!";
			$uploadOk = 0;
		}
		
		if(isset($_POST['video'])){
			$video=1;
		}
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"  && $imageFileType!="mp4") {
			if($video==1 && !($imageFileType=="mp4")){
				//treba vidjeti koje kodeke podrzava i kako ih predstaviti
				echo "Samo MP4 fajlovi su dozvoljeni.";
			}
			if($video==0 && !($imageFileType=="png" || $imageFileType=="jpeg" || $imageFileType=="gif")){		
				echo "Samo JPG, JPEG, PNG & GIF fajlovi su dozvoljeni.";
			}
			$uploadOk = 0;
		}

		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Greska prilikom dodavanja slike.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//logika za kreiranje foldera ukoliko nema foldera onda je $idFoldera=0
				$slika=new Slika();
				$slika->SlikaCtor(0,$target_file,$video,0);
				$id=dodajSliku($slika);
				
				echo "Uspjesno ste dodali sliku;";
			} else {
				echo "Greska prilikom dodavanja slike.";
			}
		}
	}else{
	 	echo "Niste odabrali sliku!";
	}

}
?>