<?php
include 'crud.php';
include 'klase.php';

if(isset($_POST["model"])){
	$vozilo=dajVoziloPoId($_POST["model"]);
	PrikaziVozilo($vozilo);
	PrikaziChipTuning($vozilo);
	
}


function PrikaziVozilo($vozilo){
	echo '<div> 
			<h2 style="margin: 20px 0;">'.dajProizvodjacaPoId($vozilo["idProizvodjaca"])["markaVozila"].'</h2>
			<div style="width:300px;">
			<div style="width:200px; float:right;">
				<div>Model: '.$vozilo["model"].'</div>
				<div>Motor: '.$vozilo["motor"].'</div>
				<div>HP: '.$vozilo["hp"].'</div>
				<div>kW: '.$vozilo["kw"].'</div>
			</div>';
	if(isset($_POST["pocetna"])){
		$tmp=$_POST["pocetna"];
		if($tmp=="true"){
			echo '<div><img style="width: 100px; float:left;" src="'.str_replace("../","",dajSlikuPoid($vozilo["idSlike"])["path"]).'" alt=""></div></div>';
		}else{
			echo '<div><img style="width: 100px; float:left;" src="'.dajSlikuPoid($vozilo["idSlike"])["path"].'" alt=""></div></div>';
		}
	}else{
		echo '<div><img style="width: 100px; float:left;" src="'.dajSlikuPoid($vozilo["idSlike"])["path"].'" alt=""></div></div>';
	}
			
	 
	 echo '</div>';	
}

function PrikaziChipTuning($vozilo){
		echo '<table>';
		echo '<thead><tr>
        	<th scope="col"></th>
            <th scope="col" style="color:#000;font-weight:bold;text-align:center;">Fabricki</th>
            <th scope="col" style="color:#d50000;font-weight:bold;text-align:center;">Stage 1</th>
            <th scope="col" style="color:#d50000;font-weight:bold;text-align:center;">Stage 2</th>
        </tr></thead>';
		echo '<tbody>';
		
		
		$chip=dajSveChipTuningZaVozilo($vozilo["id"]);
		$stage1=array();
		$stage2=array();
		$stage3=array();
		if(!empty($chip)){
			$stage1=dajStagePoId($chip["0"]["idStage1"]);
			$stage2=dajStagePoId($chip["0"]["idStage2"]);
		}
		
		echo '<tr>
				<td>Snaga (KS/rpm)</td>
				<td>'.$vozilo["snaga"].'</td>';
		if(!empty($stage1))
			echo	'<td>'.$stage1["snaga"].'</td>';
		else
			echo	'<td> </td>';
		if(!empty($stage2))
			echo	'<td>'.$stage2["snaga"].'</td>';
		else
			echo	'<td> </td>';
		echo '</tr>';
		
		
		
		
		echo '<tr>
				<td>Obrtaji (Nm/rpm)</td>
				<td>'.$vozilo["obrtaji"].'</td>';
		if(!empty($stage1))
			echo	'<td>'.$stage1["obrtaji"].'</td>';
		else
			echo	'<td> </td>';
		if(!empty($stage2))
			echo	'<td>'.$stage2["obrtaji"].'</td>';
		else
			echo	'<td> </td>';
		echo '</tr>';
		
		
		
		
		echo '<tr>
				<td>Cijena</td>
				<td>'.$vozilo["cijena"].'</td>';
		if(!empty($stage1))
			echo	'<td>'.$stage1["cijena"].'</td>';
		else
			echo	'<td> </td>';
		if(!empty($stage2))
			echo	'<td>'.$stage2["cijena"].'</td>';
		else
			echo	'<td> </td>';
		echo '</tr>';

		
		echo '</tbody>';
		echo '</table>';
}

?>