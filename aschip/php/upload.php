<?php
include 'crud.php';
include 'klase.php';

if( $_SERVER["REQUEST_METHOD"] == "POST" ){
	$target_dir = "../uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$video=0;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
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
	
	if(isset($_POST['video'])){
		$video=1;
	}
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"  && $imageFileType!="mp4" && $imageFileType!="avi" && $imageFileType!="wmv" && $imageFileType!="mkv" && $imageFileType!="flv") {
		if($video==1 && !($imageFileType=="mp4" || $imageFileType=="avi" || $imageFileType=="wmv" || $imageFileType=="mkv" || $imageFileType=="flv")){
			//treba vidjeti koje kodeke podrzava i kako ih predstaviti
			echo "Sorry, only MP4, AVI, WMV, MKV & FLV files are allowed.";
		}
		if($video==0 && !($imageFileType=="png" || $imageFileType=="jpeg" || $imageFileType=="gif")){		
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		}
		$uploadOk = 0;
	}

	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			//logika za kreiranje foldera ukoliko nema foldera onda je $idFoldera=0
			////////////////////////////////////////********************??????????????????????
			$slika=new Slika();
			$slika->SlikaCtor(0,$target_file,$video,0);
			$id=dodajSliku($slika);
			
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>




<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"/>
	<input type="checkbox" name="video" id="video"/>Video 
    <input type="submit" value="submit" name="submit"/>
</form>