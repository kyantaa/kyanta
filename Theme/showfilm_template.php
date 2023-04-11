<?php 

$html .= ' <li class="TPostMv">
               <article id="post-'.$filmID.'" class="TPost C post-'.$filmID.' post type-post status-publish format-standard has-post-thumbnail hentry">
                       <a href="'.$filmURL.'">
                            <div class="Image">
                                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="215" height="320" src="'.$filmIMG.'" class="attachment-thumbnail size-thumbnail wp-post-image" alt="'.$filmNAME.'" title="'.$filmNAME.'" /></figure>
                                                '.$Status .' </div>
                                            <h2 class="Title">'.$filmNAME.'</h2> <span class="Year">'.$filmNAMEEN.'</span> </a>
                                        <div class="TPMvCn anmt">
                                            <div class="Title">'.$filmNAME.'</div>
                                            <p class="Info"> <span class="Vote AAIco-star">'.$filmRATE.'</span> <span class="Time AAIco-access_time">'.$filmTIME.'</span> <span class="Date AAIco-date_range">'.$filmYEAR.'</span></p>
                                            <div class="Description">
                                                <p>'.$filmINFO.'</p>
                                                <p class="Director AAIco-videocam"><span>Đạo diễn:</span> '.$filmDIRECTOR .' <i class="Button STPa AAIco-more_horiz"></i></p>
                                                <p class="Genre AAIco-movie_creation"><span>Thể loại:</span> '.$film_cat_info.' <i class="Button STPa AAIco-more_horiz"></i></p>
                                                <p class="Actors AAIco-person"><span>Diễn viên:</span> '.$filmACTORF.' <i class="Button STPa AAIco-more_horiz"></i></p>
                                            </div>
                                        </div>
                                    </article>
                                </li>';

?>