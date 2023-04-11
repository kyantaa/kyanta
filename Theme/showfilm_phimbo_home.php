<?php

$html .= '<div class="TPostMv">
<div class="TPost D">
<a href="'.$filmURL.'">
<div class="Image">
<figure class="Objf"><img class="TPostBg" src="'.$filmIMGBN.'" alt="Background"></figure>
</div>
</a>
 <div class="TPMvCn">
<a href="'.$filmURL.'">
<div class="Title">'.$filmNAMEVN.'</div>
</a>
<p class="Info"> <span class="Vote AAIco-star">'.$filmRATE.'</span> <span class="Time AAIco-access_time">'.$filmTIME.'</span> <span class="Date AAIco-date_range">'.$filmYEAR.'</span> <span class="Qlty">HD</span></p>
<div class="Description">
<p>'.$filmINFO.'</p>
<p class="Studio AAIco-videocam"><span>Studio:</span> '.$filmAR.'</p>
<p class="Genre AAIco-movie_creation"><span>Thể Loại:</span> '.$film_cat_info.' <i class="Button STPa AAIco-more_horiz"></i></p>
</div>
<div class="Cast"> '.$filmACTOR.' <button type="button" class="Button STPa AAIco-more_horiz"></button></div> <a href="'.$filmURL.'" class="Button TPlay AAIco-play_arrow">Xem <strong>Phim</strong></a></div>
</div>
</div>
';

?>

