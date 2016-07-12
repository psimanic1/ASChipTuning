<?php 
	include 'crud.php';

	PrikazSlikeNaDnu(dajZadnjih6Slika());
	
	function PrikazSlikeNaDnu($list){
		for($i=0; $i<count($list); $i++){
			$j=$i+1;
			if($list[$i]["jelVideo"]=="1")
				echo '<div class="flickr_badge_image" id="flickr_badge_image'.$j.'"><a href="#"><img style="width:80px; height:80px;" src="../images/video.png" alt="" /></a></div>';
			else
				echo '<div class="flickr_badge_image" id="flickr_badge_image'.$j.'"><a href="#"><img style="width:80px; height:80px;" src="'.$list[$i]["path"].'" alt="" /></a></div>';
		}
	}
?>
