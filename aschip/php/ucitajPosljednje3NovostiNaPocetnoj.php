<ul>
	<li>
	  <h2><img src="images/a3.jpg" alt="" /></h2>
	  
	  <p>Nullamlacus dui ipsum conseque loborttis non euisque morbi penas dapibulum orna. Urnaultrices quis curabitur phasellentesque congue magnis vestibulum quismodo nulla et feugiat. Adipisciniapellentum leo ut consequam ris felit elit id nibh sociis malesuada.</p>
	  <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
	</li>
  </ul>
  
  
 <?php 
include 'crud.php';
include 'klase.php';

Prikazi(dajZadnje3Novosti());
 
 
function Prikazi($list){
	echo '<ul>';
	for($i=0; $i<count($list); $i++){
		echo '<li>';
			echo '<h2><img src="'.str_replace("../","",dajSlikuPoId($list[$i]["idSlike"])["path"]).'" alt="" /></h2>
				 <p style="height: 270px;">'.$list[$i]["tekst"].'</p><p class="readmore"><a href="pages/Novosti.php?id='.$list[$i]["id"].'">Continue Reading &raquo;</a></p>';
		echo '</li>';
	}
	echo '</ul>';
} 
 ?>