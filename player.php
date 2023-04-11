<?php
define('TRUNKSJJ',true);
ob_start();
session_start();
include('includes/configurations.php');
include('includes/functions.php');
include('includes/players.php');

if(isset($_POST['id']) || ($_POST['ep'])  ){	
$episode_id	=	intval($_POST['ep']);	
	$film_sub = get_data('episode_urlsub','episode','episode_id',$episode_id);		
	$episode_url = get_data('episode_url','episode','episode_id',$episode_id);
	$filmID	=	intval($_POST['id']);	
   $mysql->update("film","film_viewed = film_viewed + 1,film_viewed_day = film_viewed_day + 1,film_viewed_w = film_viewed_w + 1,film_viewed_m = film_viewed_m + 1","film_id = '".$filmID."'");
$playTech	=	playTech_check($episode_url);	  
        
	$img = get_data('film_imgbn','film','film_id',$filmID);	 
	$server = get_data('episode_servertype','episode','episode_id',$episode_id);
	$ff = $mysql->query("SELECT episode_id,episode_url,episode_urlsub FROM ".$tb_prefix."episode WHERE episode_id > '".$episode_id."' AND episode_film = '".$filmID."' AND episode_servertype = '".$server."' ORDER BY episode_id ASC LIMIT 1");
	$film	=	$ff->fetch(PDO::FETCH_ASSOC);
	
	$epi_id = $film['episode_id'];		
	if(!($epi_id)){
	setcookie('autoNextEpisodeId', false, time() + (86400 * 30 * 12));  
	setcookie('watchedEpisodeId', false, time() + (86400 * 30 * 12));  
	}else{
	setcookie('autoNextEpisodeId', true, time() + (86400 * 30 * 12));  
	setcookie('watchedEpisodeId', $epi_id, time() + (86400 * 30 * 12));  
	}
	echo phimle_players($episode_url,$filmID,$episode_id,$server,$film_sub,$img,$playTech);	
	exit();
}



?>