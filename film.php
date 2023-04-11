<?php
define('TRUNKSJJ',true);
header('X-Powered-By: HTAVN.NET');
include('includes/configurations.php');
include('includes/functions.php');
$limit = $_POST['num'];
?>
 
<?php

$type=$_POST['type'];
  if ($type == 'phim-moi') {
	$where_sql = ""; 
	$order_sql = "ORDER BY film_time_update";
	$num = 1;
	
	}elseif ($type == 'hanh-dong') {
  $cat_id = 1;
  $where_sql = "WHERE find_in_set($cat_id,film_cat)";
	$order_sql = "ORDER BY film_time_update";
	$num = 2;
	
  }elseif ($type == 'hoc-duong') {
	$cat_id = 28;
	$where_sql = "WHERE find_in_set($cat_id,film_cat)"; 
	$order_sql = "ORDER BY film_time_update";
  $num = 3;

  }elseif ($type == 'ecchi') {
	$cat_id = 8;
	$where_sql = "WHERE find_in_set($cat_id,film_cat)"; 
	$order_sql = "ORDER BY film_time_update";
	$num = 4;
    
  }elseif ($type == 'drama') {
	$cat_id = 7;
	$where_sql = "WHERE find_in_set($cat_id,film_cat)"; 
	$order_sql = "ORDER BY film_time_update";
  $num = 5;

  
  }elseif ($type == 'live-action') {
  $cat_id = 16;
  $where_sql = "WHERE find_in_set($cat_id,film_cat)"; 
  $order_sql = "ORDER BY film_time_update";
  $num = 6;


  }elseif ($type == 'phim-le') {
  $where_sql = "WHERE film_lb = 0"; 
  $order_sql = "ORDER BY film_time_update";
  $num = 7;

    }elseif ($type == 'day') {
		$where_sql = "WHERE film_viewed_day > 0 AND film_cat NOT LIKE \"%16%\""; 
		$order_sql = "ORDER BY film_viewed_day";
    $num = 8;

    }elseif ($type == 'week') {
		$where_sql = "WHERE film_viewed_w > 0 AND film_cat NOT LIKE \"%16%\""; 
		$order_sql = "ORDER BY film_viewed_w";
    $num = 9;

    }elseif ($type == 'month') {
		$where_sql = "WHERE film_viewed_m > 0 AND film_cat NOT LIKE \"%16%\""; 
		$order_sql = "ORDER BY film_viewed_m";
    $num = 9;
	   
    }elseif ($type == 'year') {
		$where_sql = "WHERE film_viewed > 0 AND film_cat NOT LIKE \"%16%\""; 
		$order_sql = "ORDER BY film_viewed";	
    $num = 10;

	  }else {
		$where_sql = ""; 
    $order_sql = "ORDER BY film_time_update";
    $num = 0;
	  }

if ($type == 'phim-moi' || $type == 'hanh-dong' || $type == 'hoc-duong' || $type == 'ecchi' || $type == 'drama' || $type == 'live-action' || $type == 'phim-le' ){
$limit = 10;
}elseif ($type == 'day' || $type == 'week' || $type == 'month' || $type == 'year'){
$limit = 5;
} 

	$query = $mysql->query("SELECT * FROM ".$tb_prefix."film $where_sql $order_sql DESC LIMIT ".$limit);
	$total = get_total("film","film_id","$where_sql $order_sql");
	$i = 1;
	while($row = $query->fetch(PDO::FETCH_ASSOC)){
		++$z;
    $filmID = $row['film_id'];
    $filmSLUG = $row['film_slug'];
		$filmNAME = $row['film_name'];
    $filmNAMEEN = $row['film_name_real'];
	  $filmIMG = thumbimg($row['film_img'],200);
    $filmSTATUS = $row['film_tapphim'];
    $filmQUALITY = $row['film_chatluong'];
    $filmYEAR = $row['film_year'];
    $filmTIME = $row['film_time'];
    $filmINFO  =    cut_string(text_tidy1(strip_tags($row['film_info'])),235);
    $filmRATE = round($row['film_rating_total']/$row['film_rate'], 1);
    $filmDIRECTOR = ($row['film_director']?$row['film_director']:"N/A");
    $filmACTOR = ($row['film_actor']?$row['film_actor']:"<div class=\"alert alert-warning\">Nhân vật đang được cập nhật</div>");
   $filmURL = WEB_URL.'/phim/'.$filmSLUG.'-'.replace($filmID).'/';
   $CheckCat = $row['film_cat'];
   $CheckCat = explode(',',$CheckCat);
    $film_cat = '';
   for ($i=1; $i<count($CheckCat)-1;$i++) {
      $cat_namez    = get_data('cat_name','cat','cat_id',$CheckCat[$i]);
            $cat_namez_title    = get_data('cat_name_title','cat','cat_id',$CheckCat[$i]);
      $cat_namez_key    = get_data('cat_name_key','cat','cat_id',$CheckCat[$i]);
      $film_cat   .= '<a href="'.$web_link.'/the-loai/'.replace(strtolower(get_ascii($cat_namez_key))).'/" title="'.$cat_namez.'"> '.$cat_namez.'</a>,';
      $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$web_link.'/the-loai/'.replace(strtolower(get_ascii($cat_namez_key))).'/" title="'.$cat_namez.'"><span itemprop="title">'.$cat_namez.' <i class="fa fa-angle-right"></i></span></a></li>';
       }
      $filmCAT    = substr($film_cat,0,-1);


$film_list = $row['film_list'];


   if($row['film_lb'] == 0){
      $Status = '<span class="mli-quality">'.$filmQUALITY.'';
    }else{
      $Status = '<span class="mli-eps">'.$film_list.'<i>'.$filmSTATUS.'</i></span>';
  
  }
?> 

<?php
if ($type == 'phim-moi' || $type == 'hanh-dong' || $type == 'hoc-duong' || $type == 'ecchi' || $type == 'drama' || $type == 'live-action' || $type == 'phim-le'){
$html = '<li class="TPostMv">
        <article id="post-'.$filmID.'"class="TPost C post-'.$filmID.' post type-post status-publish format-standard has-post-thumbnail hentry">
           <a href ="'.$filmURL.'">
              <div class="Image">
                 <figure class="Objf TpMvPlay AAIco-play_arrow">
                     <img width="215" height="320"src="'.$filmIMG.'" class="attachment-thumbnail size-thumbnail wp-post-image"alt="'.$filmTIME.' ('.$filmYEAR.')"title="'.$filmNAME.' ('.$filmYEAR.')" /></figure>
                 '.$Status.'
              </div>
              <h2 class="Title">'.$filmNAME.'</h2> 
              <span class="Year">'.$filmNAMEEN.'</span>
           </a>
           <div class="TPMvCn anmt">
              <div class="Title">'.$filmNAME.'</div>
              <p class="Info"> <span class="Vote AAIco-star">'.$filmRATE.'</span> <span
                    class="Time AAIco-access_time">'.$filmTIME.'</span> <span
                    class="Date AAIco-date_range">'.$filmYEAR.'</span></p>
              <div class="Description">
                 <p>'.$filmINFO.'</p>
                 <p class="Director AAIco-videocam"><span>Đạo diễn:</span> '.$filmDIRECTOR.'<i class="Button STPa AAIco-more_horiz"></i></p>
                 <p class="Genre AAIco-movie_creation"><span>Thể loại:</span> '.$filmCAT.'<i class="Button STPa AAIco-more_horiz"></i>
                 </p>
                 <p class="Actors AAIco-person"><span>Diễn viên:</span> '.$filmACTOR.'<i class="Button STPa AAIco-more_horiz"></i></p>
              </div>
           </div>
        </article>
     </li>';
 }elseif ($type == 'day' || $type == 'week' || $type == 'month' || $type == 'year'){

 	$html = '<li>
                    <div class="TPost A">
                              <a rel="bookmark" href="'.$filmURL.'"> <span class="Top">#'.$z.'<i></i></span>
                                 <div class="Image">
                                    <figure class="Objf TpMvPlay AAIco-play_arrow">
                                       <img width="55" height="85" src="'.$filmIMG.'" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="'.$filmNAME.' ('.$filmYEAR.')"></figure>
                                 </div>
                                 <div class="Title">'.$filmNAME.'</div>
                              </a>
                              <p class="Info">
                               <span class="Vote AAIco-star">'.$filmRATE.'</span>
                               <span class="Time AAIco-access_time">'.$filmTIME.'</span> 
                               <span class="Date AAIco-date_range">'.$filmYEAR.'</span> 
                               <span class="Qlty">'.$filmQUALITY.'</span></p>
                           </div>
                        </li>';

 }

     
     ?>


<?php 
echo $html;
 } 

?> 












