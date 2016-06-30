<?php
class Vozilo{
	public $id;
	public $model; 
	public $tipVozila;
	public $motor;
	public $hp;
	public $kw;
	public $snaga;
	public $obrtaji;
	public $cijena;
	public $idProizvodjaca;
	public $idSlike;

	function VoziloCtor($id,$model, $tipVozila, $motor, $hp, $kw, $snaga, $obrtaji, $cijena, $idProizvodjaca, $idSlike){
		$this->id=$id;
		$this->model=$model;
		$this->tipVozila=$tipVozila;
		$this->motor=$motor;
		$this->hp=$hp;
		$this->kw=$kw;		
		$this->snaga=$snaga;
		$this->obrtaji=$obrtaji;
		$this->cijena=$cijena;
		$this->idProizvodjaca=$idProizvodjaca;
		$this->idSlike=$idSlike;
	}
}

class Proizvodjac{
	public $id;
	public $markaVozila;
	public $idSlike;
	
	function ProizvodjacCtor($id,$markaVozila,$idSlike){
		$this->id=$id;
		$this->markaVozila=$markaVozila;
		$this->idSlike=$idSlike;
	}
}

class Stage{
	public $id;
	public $snaga;
	public $obrtaji;
	public $cijena;
	
	function StageCtor($id,$snaga,$obrtaji,$cijena){
		$this->id=$id;
		$this->snaga=$snaga;
		$this->obrtaji=$obrtaji;
		$this->cijena=$cijena;
	}
}

class Slika{
	public $id;
	public $path;
	public $jelVideo;//1 jeste, 0 nije
	public $idFolder;
	
	function SlikaCtor($id,$path,$jelVideo,$idFolder){
		$this->id=$id;
		$this->path=$path;
		$this->jelVideo=$jelVideo;
		$this->idFolder=$idFolder;
	}
}

class Folder{
	public $id;
	public $imeFoldera;
	
	function FolderCtor($id,$imeFoldera){
		$this->id=$id;
		$this->imeFoldera=$imeFoldera;
	}
}

class Korisnik{
	public $id;
	public $username;
	public $password;
	
	function KorisnikCtor($id,$username,$password){
		$this->id=$id;
		$this->username=$username;
		$this->password=$password;
	}
}

class ChipTuning{
	public $id;
	public $idVozila;
	public $idStage1;
	public $idStage2;
	public $idStage3;
	public $idEcoTuning;
	
	function ChipTuningCtor($id,$idVozila,$idStage1,$idStage2,$idStage3,$idEcoTuning){
		$this->id=$id;
		$this->idVozila=$idVozila;
		$this->idStage1=$idStage1;
		$this->idStage2=$idStage2;
		$this->idStage3=$idStage3;
		$this->idEcoTuning=$idEcoTuning;
	}
}

class Novost{
	public $id;
	public $tekst;
	public $datumObjave;
	public $linkSlike;
	public $jelVideo;//1 jeste, 0 nije
	public $naslov;
	
	function NovostCtor($id,$naslov,$tekst,$linkSlike,$jelVideo){
		$this->id=$id;
		$this->naslov=$naslov;
		$this->tekst=$tekst;
		$this->linkSlike=$linkSlike;
		$this->jelVideo=$jelVideo;
	}
}


?>