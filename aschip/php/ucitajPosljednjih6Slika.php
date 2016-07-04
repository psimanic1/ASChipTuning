<?php 
	include 'crud.php';

	PrikazSlikeNaDnu(dajZadnjih6Slika());
	
	function PrikazSlikeNaDnu($list){
		for($i=0; $i<count($list); $i++){
		echo '<div class="flickr_badge_image" id="flickr_badge_image'.$i.'"><a href="#"><img style="width:80px; height:80px;" src="'.str_replace("../","",$list[$i]["path"]).'" alt="" /></a></div>';

		}
	}
?>