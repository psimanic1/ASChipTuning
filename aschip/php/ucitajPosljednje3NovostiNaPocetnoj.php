
 <?php 
include 'crud.php';
include 'klase.php';

Prikazi(dajZadnje3Novosti());
 
 
function Prikazi($list){
	echo '<ul>';
	for($i=0; $i<count($list); $i++){
		echo '<li>';
			echo '<h2><img src="'.str_replace("../","",dajSlikuPoId($list[$i]["idSlike"])["path"]).'" alt="" /></h2>
				 <p style="height: 270px;">'.dajTekstSmanjen($list[$i]["tekst"]).'</p><p class="readmore"><a href="pages/Novosti.php?id='.$list[$i]["id"].'">Continue Reading &raquo;</a></p>';
		echo '</li>';
	}
	echo '</ul>';
} 
function dajTekstSmanjen($text){
	if(strlen($text)>205){
		$text = substr($text, 0, 205);
		$text = substr($text, 0, strrpos($text, ' ')) . " ...";
	}
	return $text;
}
 ?>