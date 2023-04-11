<?php
ob_start();
session_start();
define('TRUNKSJJ',true);
include('includes/configurations.php');
include('includes/functions.php');

if(isset($_POST['id']) || ($_POST['value'])) {
    $film_id	=	intval($_POST['id']);
    $score	=	intval($_POST['value']);
    if(isset($_SESSION["user_id"])){
	$userid = $_SESSION['user_id'];
    $column = 'user_rate';
	$phimcheck = ','.$film_id.',';
	$check_f = $mysql->query("SELECT user_id,".$column." FROM ".DATABASE_FX."user WHERE ".$column." LIKE '%".$phimcheck."%' AND user_id = '".$userid."' ORDER BY user_id ASC");
	$fbox = $check_f->fetch(PDO::FETCH_ASSOC);
	$phimadd = $film_id.",";	
    if($fbox['user_id']){
      $error = array(
            'status' => "Warning", 
            'message' => "Bạn đã đánh giá phim này rồi.(Đừng Spam nhé :D)"
            );
        echo json_encode($error);
           exit();
	}else{
	    $add_get = $mysql->query("SELECT user_id,".$column." FROM ".DATABASE_FX."user WHERE user_id = '".$userid."' ORDER BY user_id ASC");
		$rs = $add_get->fetch(PDO::FETCH_ASSOC);
	    $addphim = $rs[$column].''.$phimadd;
		$mysql->query("UPDATE ".DATABASE_FX."user SET ".$column." = '".$addphim."' WHERE user_id = '".$userid."'");
        $mysql->query("UPDATE ".DATABASE_FX."film SET film_rate = film_rate + 1, film_rating_total = film_rating_total + $score WHERE film_id = $film_id");  
	    $success = array(
            'status' => "success", 
            'message' => "Đánh giá của bạn đã được ghi nhận", 
            'ratePoint' =>  $score
            );
        echo json_encode($success);
       exit();
	}	  
	      
	}else{
        $error = array(
            'status' => "Error", 
            'message' => "Bạn cần đăng nhập để sử dụng chức năng này"
            );
        echo json_encode($error);
           exit();
	}
	
	exit();
}




?>