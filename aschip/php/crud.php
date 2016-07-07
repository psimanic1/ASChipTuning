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

	/*	 prima naziv modlea onog sta treba vratiti i vraca array kojem pristupama npr: 
		 $tmp=dajVoziloPoModelu(audi a3); 
		 $idVracenog=$tmp["id"];
	*/
	function dajVoziloPoModelu($model){
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from vozila where model LIKE ?';
		$q = $baza->prepare($query);
		$q->execute(array($model.'%'));
		$tmpObj1 = $q->fetchAll();
		foreach($tmpObj1 as $r){
			$tmpObj=array('id'=>$r['id'],'model'=>$r['model'],'tipVozila'=>$r['tipVozila'],'motor'=>$r['motor'],'hp'=>$r['hp'],'kw'=>$r['kw'],'snaga'=>$r['snaga'],'obrtaji'=>$r['obrtaji'],'cijena'=>$r['cijena'],'idProizvodjaca'=>$r['idProizvodjaca'],'idSlike'=>$r['idSlike']);
			array_push($obj,$tmpObj);
		}
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

    function dajVozilaZaModelTipProizvodjac($model,$tipVozila,$idProizvodjaca){
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from vozila where idProizvodjaca=? and tipVozila="'.$tipVozila.'" and model=?';
		$q = $baza->prepare($query);
		$q->execute(array($idProizvodjaca,$model));
		$tmpObj1 = $q->fetchAll();
		foreach($tmpObj1 as $r){
			$tmpObj=array('id'=>$r['id'],'model'=>$r['model'],'tipVozila'=>$r['tipVozila'],'motor'=>$r['motor'],'hp'=>$r['hp'],'kw'=>$r['kw'],'snaga'=>$r['snaga'],'obrtaji'=>$r['obrtaji'],'cijena'=>$r['cijena'],'idProizvodjaca'=>$r['idProizvodjaca'],'idSlike'=>$r['idSlike']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}
	
	/*	 prima idProizvodjaca i vraca vozila 
		 $tmp=dajVozilaZaProizvodjaca(5); 
	*/
	function dajVozilaZaProizvodjaca($idProizvodjaca){
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from vozila where idProizvodjaca=?';
		$q = $baza->prepare($query);
		$q->execute(array($idProizvodjaca));
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
	
	/*	 prima id onog sta treba obrisati i vraca true ili false 
		 $tmp=obrisiVoziloPoId(5); 
	*/
	function obrisiVoziloPoId($id){
		try{
			$obj=array();
			$idSlike= dajVoziloPoId($id)["idSlike"];
			obrisiSlikuPoId($idSlike);
			$chips=dajSveChipTuningZaVozilo($id);
			obrisiChipTuningPoId($chips["0"]["id"]);
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Delete from vozila where id=?';
			$q = $baza->prepare($query);
			$q->execute(array($id));
			
			Baza::disconnect();
			return true;
		}catch(Exception $e){
			Baza::disconnect();
			return false;
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

	/*	 prima tip vozila i vraca proizvodjace 
		 $tmp=dajSveProizvodjaceZaTip(Auto); 
	*/
	function dajSveProizvodjaceZaTip($tip){
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='select proizvodjaci.id,proizvodjaci.markaVozila,proizvodjaci.idSlike  from proizvodjaci, vozila where vozila.tipVozila=? and vozila.idProizvodjaca=proizvodjaci.id;';
		$q = $baza->prepare($query);
		$q->execute(array($tip));
		$tmpObj1 = $q->fetchAll();
		foreach($tmpObj1 as $r){
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

	/*	 prima id onog sta treba obrisati i vraca true ili false 
		 $tmp=obrisiProizvodjacaPoId(5); 
	*/
	function obrisiProizvodjacaPoId($id){
		try{
			$obj=array();
			$vozila=dajVozilaZaProizvodjaca($id);
			if(empty($vozila)){
				$idSlike=dajProizvodjacaPoId($id)["idSlike"];
				obrisiSlikuPoId($idSlike);
			}else{
				foreach($vozila as $v){
					obrisiVoziloPoId($v["id"]);
				}
			}
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Delete from proizvodjaci where id=?';
			$q = $baza->prepare($query);
			$q->execute(array($id));
			
			Baza::disconnect();
			return true;
		}catch(Exception $e){
			Baza::disconnect();
			return false;
		}
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
			$tmpObj=array('id'=>$r['id'],'idVozila'=>$r['idVozila'],'idStage1'=>$r['idStage1'],'idStage2'=>$r['idStage2']);
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
			$obj=array('id'=>$tmpObj['id'],'idVozila'=>$tmpObj['idVozila'],'idStage1'=>$tmpObj['idStage1'],'idStage2'=>$tmpObj['idStage2']);
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba obrisati i vraca true ili false 
		 $tmp=obrisiChipTuningPoId(5); 
	*/
	function obrisiChipTuningPoId($id){
		try{
			$obj=array();
			$chip=dajChipTuningPoId($id);
			if($chip["idStage1"]!=0) obrisiStagePoId($chip["idStage1"]);
			if($chip["idStage2"]!=0) obrisiStagePoId($chip["idStage2"]);
			
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Delete from chiptuning where id=?';
			$q = $baza->prepare($query);
			$q->execute(array($id));
			Baza::disconnect();
			return true;
		}catch(Exception $e){
			Baza::disconnect();
			return false;
		}
	}
	
	/*	 prima idVozila i vraca listu chiptuninga za trazeno vozilo 
		 $tmp=dajSveChipTuningZaVozilo(5);
		 pristupa se na nacin:
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSveChipTuningZaVozilo($idVozila){
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from chiptuning where idVozila=?';
		$q = $baza->prepare($query);
		$q->execute(array($idVozila));
		$tmpObj1 = $q->fetchAll();
		foreach($tmpObj1 as $r){
			$tmpObj=array('id'=>$r['id'],'idVozila'=>$r['idVozila'],'idStage1'=>$r['idStage1'],'idStage2'=>$r['idStage2']);
			array_push($obj,$tmpObj);
		}
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
			$query='Insert into chiptuning (idVozila,idStage1,idStage2) values(?,?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->idVozila,$tmp->idStage1,$tmp->idStage2));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}
	
	/*	update chiptuning na nacin da dodaje stage1, prima varijablu tipa Stage()
		vraca true ili false
		$tmp=dodajStage1ChipTuning(stage);
	*/
	function dodajStage1ChipTuning($tmp){
		if($tmp->idVozila!=null){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='UPDATE chiptuning SET idStage1=? WHERE id=? ';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->idStage1,$tmp->id));
			Baza::disconnect();
			return true;
		}else{
			return false;
		}
	}
	
	/*	update chiptuning na nacin da dodaje stage2, prima varijablu tipa Stage()
		vraca true ili false
		$tmp=dodajStage2ChipTuning(stage);
	*/
	function dodajStage2ChipTuning($tmp){
		if($tmp->idVozila!=null){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='UPDATE chiptuning SET idStage2=? WHERE id=? ';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->idStage2, $tmp->id));
			Baza::disconnect();
			return true;
		}else{
			return false;
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
	
	/*	 prima id onog sta treba obrisati i vraca true ili false 
		 $tmp=obrisiStagePoId(5); 
	*/
	function obrisiStagePoId($id){
		try{
			$obj=array();
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Delete from stage where id=?';
			$q = $baza->prepare($query);
			$q->execute(array($id));
			Baza::disconnect();
			return true;
		}catch(Exception $e){
			Baza::disconnect();
			return false;
		}
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
	
	/*	 prima idFoldera u kojem se nalaze slike i vraca array kojem pristupama npr: 
		 $tmp=dajSveSlikeZaFolder(5); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajSveSlikeZaFolder($idFoldera){
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from slike where idFolder=? order by id desc';
		$q = $baza->prepare($query);
		$q->execute(array($idFoldera));
		$tmpObj1 = $q->fetchAll();
		foreach($tmpObj1 as $r){
			$tmpObj=array('id'=>$r['id'],'path'=>$r['path'],'jelVideo'=>$r['jelVideo'],'idFolder'=>$r['idFolder']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 prima idFoldera u kojem se nalaze slike i vraca array sa 4 zadnje slike ukoliko postoje i njemu pristumapo npr: 
		 $tmp=dajZadnje4SlikeZaFolder(5); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajZadnje4likeZaFolder($idFoldera){
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from slike where idFolder=? order by id desc limit 4';
		$q = $baza->prepare($query);
		$q->execute(array($idFoldera));
		$tmpObj1 = $q->fetchAll();
		foreach($tmpObj1 as $r){
			$tmpObj=array('id'=>$r['id'],'path'=>$r['path'],'jelVideo'=>$r['jelVideo'],'idFolder'=>$r['idFolder']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}
	
	/*	 vraca array sa 6 zadnje slike ukoliko postoje i njemu pristumapo npr: 
		 $tmp=dajZadnjih6Slika(5); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajZadnjih6Slika(){
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from slike order by id desc limit 6';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'path'=>$r['path'],'jelVideo'=>$r['jelVideo'],'idFolder'=>$r['idFolder']);
			if($tmpObj["idFolder"]==1 || $tmpObj["idFolder"]==2 || $tmpObj["idFolder"]==3) continue;
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		
		if(count($obj)<6){
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
			$query='Select * from novosti order by id desc limit 6,6';
			foreach($baza->query($query) as $r){
				$tmpObj=array('id'=>$r['id'],'path'=>$r['path'],'jelVideo'=>$r['jelVideo'],'idFolder'=>$r['idFolder']);
				if($tmpObj["idFolder"]==1 || $tmpObj["idFolder"]==2 || $tmpObj["idFolder"]==3) continue;
				array_push($obj,$tmpObj);
			}
			Baza::disconnect();
			
		}
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

	function dajSlikePoPathu($path){
		$obj=array();
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from slike where path=?';
		$q = $baza->prepare($query);
		$q->execute(array($path));
		$tmpObj1 = $q->fetchAll();
		foreach($tmpObj1 as $r){
			$tmpObj=array('id'=>$r['id'],'path'=>$r['path'],'jelVideo'=>$r['jelVideo'],'idFolder'=>$r['idFolder']);
			array_push($obj,$tmpObj);
		}
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
				if(count(dajSlikePoPathu($imgPath))==1)
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
			if($tmpObj["id"]==1 || $tmpObj["id"]==2 || $tmpObj["id"]==3) continue;
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

	/*	 prima id onog sta treba obrisati i vraca true ako obrise odnosno false ako ne i brise sliku u folderu ako postoji 
		 $tmp=obrisiFolderPoId(5); 
	*/
	function obrisiFolderPoId($id){
		try{
			$obj=array();
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$list=dajSveSlikeZaFolder($id);
			for($i=0; $i<count($list); $i++){
				obrisiSlikuPoId($list[$i]["id"]);
			}
			$query='Delete from folderi where id=?';
			$q = $baza->prepare($query);
			$q->execute(array($id));
			
			Baza::disconnect();
			return true;
		}catch(Exception $e){
			Baza::disconnect();
			return false;
		}
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
			$tmpObj=array('id'=>$r['id'],'tekst'=>$r['tekst'],'datumObjave'=>$r['datumObjave'],'idSlike'=>$r['idSlike'],'naslov'=>$r['naslov']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 vraca array zadnjih 10 novosti ukoliko postoje kojem pristupama npr: 
		 $tmp=dajZadnjih10Novosti(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function dajZadnjih10Novosti(){
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from novosti order by id desc limit 10';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'tekst'=>$r['tekst'],'datumObjave'=>$r['datumObjave'],'idSlike'=>$r['idSlike'],'naslov'=>$r['naslov']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}

	/*	 vraca array zadnje 3 novosti ukoliko postoje kojem pristupama npr: 
		 $tmp=dajZadnje3Novosti(); 
		 $idPrvog=$tmp[1]["id"];
	*/	
	function dajZadnje3Novosti(){
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from novosti order by id desc limit 3';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'tekst'=>$r['tekst'],'datumObjave'=>$r['datumObjave'],'idSlike'=>$r['idSlike'],'naslov'=>$r['naslov']);
			array_push($obj,$tmpObj);
		}
		Baza::disconnect();
		return $obj;
	}
	
	/*	 vraca array zadnjih 5 novosti ukoliko postoje kojem pristupama npr: 
		 $tmp=ucitajJos5Novosti(); 
		 $idPrvog=$tmp[1]["id"];
	*/
	function ucitajJos5Novosti($brUcitanih){
		$baza=Baza::connect();
		$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query='Select * from novosti order by id desc limit '.$brUcitanih.',5';
		$obj=array();
		foreach($baza->query($query) as $r){
			$tmpObj=array('id'=>$r['id'],'tekst'=>$r['tekst'],'datumObjave'=>$r['datumObjave'],'idSlike'=>$r['idSlike'],'naslov'=>$r['naslov']);
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
			$obj=array('id'=>$tmpObj['id'],'tekst'=>$tmpObj['tekst'],'datumObjave'=>$tmpObj['datumObjave'],'idSlike'=>$tmpObj['idSlike'],'naslov'=>$tmpObj['naslov']);
		Baza::disconnect();
		return $obj;
	}

	/*	 prima id onog sta treba obrisati i vraca true ako obrise odnosno false ako ne 
		 $tmp=obrisiNovostPoId(5); 
	*/
	function obrisiNovostPoId($id){
		try{
			$obj=array();
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$novost=dajNovostPoId($id);
			obrisiSlikuPoId($novost["idSlike"]);
			$query='Delete from novosti where id=?';
			$q = $baza->prepare($query);
			$q->execute(array($id));
			Baza::disconnect();
			return true;
		}catch(Exception $e){
			Baza::disconnect();
			return false;
		}
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
			$query='Insert into novosti (tekst,datumObjave,idSlike,naslov) values(?,?,?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->tekst,$today,$tmp->idSlike,$tmp->naslov));
			Baza::disconnect();
			return $baza->lastInsertId();
		}
		else{
			return 0;
		}
	}

	/*	edituje novost, prima varijablu tipa Novost()
		vraca 1 ukoliko je uspjesno 
		ukoliko nije uspjesno dodavanje vraca 0
	*/
	function editujNovost($tmp){		
		if($tmp->tekst!=null && $tmp->naslov!=null){
			$today =date("Y-m-d H:i:s");
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='UPDATE novosti set tekst=?, idSlike=?,naslov=? where id=?';
			$q = $baza->prepare($query);
			$q->execute(array($tmp->tekst,$tmp->idSlike,$tmp->naslov,$tmp->id));
			Baza::disconnect();
			return 1;
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
	
	/*
		provjerava da li postoji korisnik sa username i password ukoliko postoji vraca tog korisnika
		ukoliko ne postoji vraca prazan objekat
	*/
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