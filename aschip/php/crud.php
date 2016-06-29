<?php
include 'baza.php';
	
	
////////////////////////////////////////////////////////////////////////////////////////////
//Vozila
	/*	 vraca array kojem pristupama npr: 
		 $tmp=dajSvaVozila(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSvaVozila(){
		
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from vozila';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'model'=>$r['model'],'tipVozila'=>$r['tipVozila'],'motor'=>$r['motor'],'hp'=>$r['hp'],'kw'=>$r['kw'],'snaga'=>$r['snaga'],'obrtaji'=>$r['obrtaji'],'cijena'=>$r['cijena'],'idProizvodjaca'=>$r['idProizvodjaca'],'idSlike'=>$r['idSlike']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}
	
	/*	 prima id onog sta treba vratiti i vraca array kojem pristupama npr: 
		 $tmp=dajVoziloPoId(5); 
		 $idVracenog=$tmp["id"];
	*/
	function dajVoziloPoId($id){
		
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from vozila where id=?';
		$q = $baza->prepare($query);
		$q->execute(array($id));
		$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
		if($tmpObj!=null)
			$obj=array('id'=>$tmpObj['id'],'model'=>$tmpObj['model'],'tipVozila'=>$tmpObj['tipVozila'],'motor'=>$tmpObj['motor'],'hp'=>$tmpObj['hp'],'kw'=>$tmpObj['kw'],'snaga'=>$tmpObj['snaga'],'obrtaji'=>$tmpObj['obrtaji'],'cijena'=>$tmpObj['cijena'],'idProizvodjaca'=>$tmpObj['idProizvodjaca'],'idSlike'=>$tmpObj['idSlike']);
		
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id i tipVozila i vraca vozila 
		 $tmp=dajVozilaZaProizvodjacaITipVozila(5,"Auto"); 
	*/
	function dajVozilaZaProizvodjacaITipVozila($id,$tipVozila){
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from vozila where idProizvodjaca=? and tipVozila=?';
		$q = $baza->prepare($query);
		$q->execute(array($id,$tipVozila));
		$tmpObj1 = $q->fetchAll();
		foreach($tmpObj1 as $r){
			$tmpObj=array('id'=>$r['id'],'model'=>$r['model'],'tipVozila'=>$r['tipVozila'],'motor'=>$r['motor'],'hp'=>$r['hp'],'kw'=>$r['kw'],'snaga'=>$r['snaga'],'obrtaji'=>$r['obrtaji'],'cijena'=>$r['cijena'],'idProizvodjaca'=>$r['idProizvodjaca'],'idSlike'=>$r['idSlike']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}
	
	/*	dodaje vozilo, prima varijablu tipa Vozilo()
		vraca id dodanog Vozila
		ukoliko nije uspjesno dodavanje vraca 0
	*/
	function dodajVozilo($auto){
		
		if($auto->model!=null && $auto->tipVozila!=null && $auto->motor!=null){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into vozila (model,tipVozila,motor,hp,kw,snaga,obrtaji,cijena, idProizvodjaca,idSlike) values(?,?,?,?,?,?,?,?,?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($auto->model,$auto->tipVozila,$auto->motor,$auto->hp,$auto->kw,$auto->snaga,$auto->obrtaji,$auto->cijena,$auto->idProizvodjaca,$auto->idSlike));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////
//proizvodjac
	/*	 vraca array kojem pristupama npr: 
		 $tmp=dajSveProizvodjace(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSveProizvodjace(){
		
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from proizvodjaci';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'markaVozila'=>$r['markaVozila'],'idSlike'=>$r['idSlike']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba vratiti i vraca array kojem pristupama npr: 
		 $tmp=dajProizvodjacaPoId(5); 
		 $idVracenog=$tmp["id"];
	*/
	function dajProizvodjacaPoId($id){
		
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from proizvodjaci where id=?';
		$q = $baza->prepare($query);
		$q->execute(array($id));
		$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
		if($tmpObj!=null)
			$obj=array('id'=>$tmpObj['id'],'markaVozila'=>$tmpObj['markaVozila'],'idSlike'=>$tmpObj['idSlike']);
		Baza::disconnect();
		return $obj;
	}

	/*	dodaje proizvodjaca, prima varijablu tipa Proizvodjac()
		vraca id dodanog proizvodjaca
		ukoliko nije uspjesno dodavanje vraca 0
	*/
	function dodajProizvodjaca($tmp){
		
		if($tmp->markaVozila!=null){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into proizvodjaci (markaVozila,idSlike) values(?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->markaVozila,$tmp->idSlike));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////
//chiptuning
	/*	 vraca array kojem pristupama npr: 
		 $tmp=dajSvaChipTuning(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSvaChipTuning(){
		
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from chiptuning';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'idVozila'=>$r['idVozila'],'idStage1'=>$r['idStage1'],'idStage2'=>$r['idStage2'],'idStage3'=>$r['idStage3'],'idEcoTuning'=>$r['idEcoTuning']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba vratiti i vraca array kojem pristupama npr: 
		 $tmp=dajChipTuningPoId(5); 
		 $idVracenog=$tmp["id"];
	*/
	function dajChipTuningPoId($id){
		
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from chiptuning where id=?';
		$q = $baza->prepare($query);
		$q->execute(array($id));
		$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
		if($tmpObj!=null)
			$obj=array('id'=>$tmpObj['id'],'idVozila'=>$tmpObj['idVozila'],'idStage1'=>$tmpObj['idStage1'],'idStage2'=>$tmpObj['idStage2'],'idStage3'=>$tmpObj['idStage3'],'idEcoTuning'=>$tmpObj['idEcoTuning']);
		Baza::disconnect();
		return $obj;
	}

	/*	dodaje chiptuning, prima varijablu tipa ChipTuning()
		vraca id dodanog ChipTuning-a
		ukoliko nije uspjesno dodavanje vraca 0
	*/
	function dodajChipTuning($tmp){
		
		if($tmp->idVozila!=null){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into chiptuning (idVozila,idStage1,idStage2,idStage3,idEcoTuning) values(?,?,?,?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->idVozila,$tmp->idStage1,$tmp->idStage2,$tmp->idStage3,$tmp->idEcoTuning));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////
//stage
	/*	 vraca array kojem pristupama npr: 
		 $tmp=dajSveStage(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSveStage(){
		
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from stage';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'snaga'=>$r['snaga'],'obrtaji'=>$r['obrtaji'],'cijena'=>$r['cijena']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba vratiti i vraca array kojem pristupama npr: 
		 $tmp=dajStagePoId(5); 
		 $idVracenog=$tmp["id"];
	*/
	function dajStagePoId($id){
		
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from stage where id=?';
		$q = $baza->prepare($query);
		$q->execute(array($id));
		$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
		if($tmpObj!=null)
			$obj=array('id'=>$tmpObj['id'],'snaga'=>$tmpObj['snaga'],'obrtaji'=>$tmpObj['obrtaji'],'cijena'=>$tmpObj['cijena']);
		Baza::disconnect();
		return $obj;
	}

	/*	dodaje stage, prima varijablu tipa Stage()
		vraca id dodanog Stage-a
		ukoliko nije uspjesno dodavanje vraca 0
	*/
	function dodajStage($tmp){
		
		if($tmp->obrtaji!=null && $tmp->snaga!=null){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into stage (snaga,obrtaji,cijena) values(?,?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->snaga,$tmp->obrtaji,$tmp->cijena));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////
//Slike
	/*	 vraca array kojem pristupama npr: 
		 $tmp=dajSveSlike(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSveSlike(){
		
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from slike';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'path'=>$r['path'],'jelVideo'=>$r['jelVideo'],'idFolder'=>$r['idFolder']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba vratiti i vraca array kojem pristupama npr: 
		 $tmp=dajSlikuPoId(5); 
		 $idVracenog=$tmp["id"];
	*/
	function dajSlikuPoId($id){
		
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from slike where id=?';
		$q = $baza->prepare($query);
		$q->execute(array($id));
		$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
		if($tmpObj!=null)
			$obj=array('id'=>$tmpObj['id'],'path'=>$tmpObj['path'],'jelVideo'=>$tmpObj['jelVideo'],'idFolder'=>$tmpObj['idFolder']);
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba obrisati i vraca true ako obrise odnosno false ako ne i brise sliku u folderu ako postoji 
		 $tmp=obrisiSlikuPoId(5); 
	*/
	function obrisiSlikuPoId($id){
		try{
			$obj=array();
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			try{
				$imgPath=dajSlikuPoId($id)["path"];
				unlink($imgPath);
			}catch(Exception $ex){
				$ex->getMessage();
			}
			$query='Delete from slike where id=?';
			$q = $baza->prepare($query);
			$q->execute(array($id));
			
			Baza::disconnect();
			return true;
		}catch(Exception $e){
			Baza::disconnect();
			return false;
		}
	}
	
	/*	dodaje sliku, prima varijablu tipa Slika()
		vraca id dodane slike
		ukoliko nije uspjesno dodavanje vraca 0
	*/
	function dodajSliku($tmp){
		
		if($tmp->path!==null && $tmp->idFolder!==null && $tmp->jelVideo!==null){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into slike (path,jelVideo,idFolder) values(?,?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->path,$tmp->jelVideo,$tmp->idFolder));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////
//Folderi
	/*	 vraca array kojem pristupama npr: 
		 $tmp=dajSveFoldere(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSveFoldere(){
		
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from folderi';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'imeFoldera'=>$r['imeFoldera']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba vratiti i vraca array kojem pristupama npr: 
		 $tmp=dajFolderPoId(5); 
		 $idVracenog=$tmp["id"];
	*/
	function dajFolderPoId($id){
		
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from folderi where id=?';
		$q = $baza->prepare($query);
		$q->execute(array($id));
		$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
		if($tmpObj!=null)
			$obj=array('id'=>$tmpObj['id'],'imeFoldera'=>$tmpObj['imeFoldera']);
		Baza::disconnect();
		return $obj;
	}

	/*	dodaje folder, prima varijablu tipa Folder()
		vraca id dodanog foldera
		ukoliko nije uspjesno dodavanje vraca 0
	*/
	function dodajFolder($tmp){
		
		if($tmp->imeFoldera!=null){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into folderi (imeFoldera) values(?)';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->imeFoldera));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////
//Novosti
	/*	 vraca array kojem pristupama npr: 
		 $tmp=dajSveNovosti(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSveNovosti(){
		
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from novosti';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'tekst'=>$r['tekst'],'datumObjave'=>$r['datumObjave'],'link'=>$r['link'],'jelVideo'=>$r['jelVideo'],'naslov'=>$r['naslov']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba vratiti i vraca array kojem pristupama npr: 
		 $tmp=dajNovostPoId(5); 
		 $idVracenog=$tmp["id"];
	*/
	function dajNovostPoId($id){
		
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from novosti where id=?';
		$q = $baza->prepare($query);
		$q->execute(array($id));
		$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
		if($tmpObj!=null)
			$obj=array('id'=>$tmpObj['id'],'tekst'=>$tmpObj['tekst'],'datumObjave'=>$tmpObj['datumObjave'],'link'=>$tmpObj['link'],'jelVideo'=>$tmpObj['jelVideo'],'naslov'=>$tmpObj['naslov']);
		Baza::disconnect();
		return $obj;
	}

	/*	dodaje novost, prima varijablu tipa Novost()
		vraca id dodane novosti
		ukoliko nije uspjesno dodavanje vraca 0
	*/
	function dodajNovost($tmp){
		
		if($tmp->tekst!=null){
			$today =date("Y-m-d H:i:s");
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into novosti (tekst,datumObjave,link,jelVideo,naslov) values(?,?,?,?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->tekst,$today,$tmp->link,$tmp->jelVideo,$tmp->naslov));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////
//Korisnici
	/*	 vraca array kojem pristupama npr: 
		 $tmp=dajSveKorisnike(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSveKorisnike(){
		
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from korisnici';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'username'=>$r['username'],'password'=>$r['password']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba vratiti i vraca array kojem pristupama npr: 
		 $tmp=dajKorisnikaPoId(5); 
		 $idVracenog=$tmp["id"];
	*/
	function dajKorisnikaPoId($id){
		
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from korisnici where id=?';
		$q = $baza->prepare($query);
		$q->execute(array($id));
		$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
		if($tmpObj!=null)
			$obj=array('id'=>$tmpObj['id'],'username'=>$tmpObj['username'],'password'=>$tmpObj['password']);
		Baza::disconnect();
		return $obj;
	}

	/*	dodaje korisnika, prima varijablu tipa Korisnik()
		vraca id dodanog korisnika
		ukoliko nije uspjesno dodavanje vraca 0
	*/
	function dodajKorisnika($tmp){
		
		if($tmp->username!=null && $tmp->password!=null){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into korisnici (username,password) values(?,?)';
			$q = $baza->prepare($query);
			//TREBA URADITI HESIRANJE
			$q->execute(array($tmp->username,$tmp->password));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}
	
	function LoginServer($username, $password){
		if($username!=null && $password!=null){
			
			$obj=array();
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Select * from korisnici where username=? and password=?';
			$q = $baza->prepare($query);
			$q->execute(array($username,$password));
			$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
			if($tmpObj!=null)
				$obj=array('id'=>$tmpObj['id'],'username'=>$tmpObj['username'],'password'=>$tmpObj['password']);
			Baza::disconnect();
			return $obj;
		}
	}
////////////////////////////////////////////////////////////////////////////////////////////


?>