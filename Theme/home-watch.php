<?php
if(($value[1]=='home-watch' && is_numeric($value[2])) || ($value[1]=='home-watch' && (strpos($value[2] , 'xem-phim') !== false)) || ($value[1]=='home-watch' && (strpos($value[2] , 'tap') !== false))){
    $x_get = explode('-',$value[3]);
    $get_f = $x_get[count($x_get)-1];
	$filmID = (int)$get_f;
	$mysql->query("UPDATE ".$tb_prefix."film SET film_viewed = film_viewed + 1,
													film_viewed_day = film_viewed_day + 1,
													film_viewed_w = film_viewed_w + 1,
													film_viewed_m = film_viewed_m + 1 WHERE film_id = '".$filmID."'");
    if(is_numeric($value[2])) {
	    $episode_id = 	intval($value[2]);
	}elseif(strpos($value[2] , 'xem-phim') !== false){
	    $episode_name = explode('-',$value[2]);
		if(count($episode_name) == 3){
		    $episode_id = $episode_name[2];
		}else{
		$episodes = $mysqldb->prepare("SELECT episode_id FROM ".DATABASE_FX."episode WHERE episode_film = :filmID AND episode_servertype NOT IN (13,14) ORDER BY episode_id ASC LIMIT 0,1");
        $episodes->execute(array('filmID' => $filmID));
	    $episode = $episodes->fetch();
		$episode_id = $episode['episode_id'];
	    }
	}elseif(strpos($value[2] , 'tap') !== false){
	    $episode_name = explode('-',$value[2]);
		if(count($episode_name) == 3){
		    $episode_id = $episode_name[2];
		}else{
	        $episode_name = $episode_name[1];
			$episodes = $mysqldb->prepare("SELECT episode_id FROM ".DATABASE_FX."episode WHERE episode_name = :EpiNAME AND episode_servertype = :EpiTYPE AND episode_film = :EpiFILM AND episode_servertype NOT IN (13,14) ORDER BY episode_id ASC LIMIT 0,1");
            $episodes->execute(array('EpiNAME' => $episode_name, 'EpiTYPE' => 1, 'EpiFILM'=> $filmID));
	        $episode = $episodes->fetch();
	        $episode_id = $episode['episode_id'];
		}
	}
	$episodez = $mysqldb->prepare("SELECT episode_url,episode_name,episode_urlsub,episode_servertype FROM ".DATABASE_FX."episode WHERE episode_id = :EpiID");
        $episodez->execute(array('EpiID' => $episode_id));
	    $episodeq = $episodez->fetch();
		$EpisodeNAME = $episodeq['episode_name'];
		$EpisodeURL = $episodeq['episode_url'];
		$EpisodeSUB = $episodeq['episode_urlsub'];
		$EpisodeTYPE = $episodeq['episode_servertype'];
	$EpisodeList = EpisodeList($filmID,$episode_id,$EpisodeNAME,$EpisodeTYPE,"defaultv2");	
	$arr = $mysqldb->prepare("SELECT * FROM ".DATABASE_FX."film WHERE film_id = :id");
    $arr->execute(array('id' => $filmID));
	$row = $arr->fetch();
if($row['film_id']){
	$filmNAMEVN = $row['film_name'];
	$filmNAMEEN = $row['film_name_real'];
	$filmYEAR = $row['film_year'];
	$film18 = $row['film_phim18'];
	$filmLIKED = number_format($row['film_liked']);
	$filmRATE = $row['film_rate'];
	$filmRATETOTAL = $row['film_rating_total'];
        if($filmRATE != 0)
	$filmRATESCORE = round($filmRATETOTAL/$filmRATE,1); else $filmRATESCORE = 0;
	$filmIMG = changeUrlGoogle($row['film_img']);
	$filmIMGBN = changeUrlGoogle($row['film_imgbn']);
        $filmLIKED = $row['film_liked'];
	$filmSTATUS = $row['film_trangthai'];
	$filmVIEWED = number_format($row['film_viewed']);
        $filmIMDb = ($row['film_imdb']?''.$row['film_imdb'].'':"N/A");
	$filmLB = $row['film_lb'];
	$filmLANG = film_lang($row['film_lang']);
	$filmQUALITY = ($row['film_tapphim']);
	$filmTAGS = $row['film_tag'];
        $filmSLUG = $row['film_slug'];
	$filmURL = $web_link.'/phim/'.$filmSLUG.'-'.replace($filmID).'/';
	$filmINFO = strip_tags(text_tidy1($row['film_info']),'<a><b><i><u><img><br><p>');
	$filmINFOcut = cut_string(text_tidy1(strip_tags($filmINFO)),160);
	$web_title = 'Tập '.$EpisodeNAME.' '.$filmNAMEVN.' ('.$filmNAMEEN.') '.$filmYEAR.' '.$filmQUALITY.'-'.$filmLANG;
	$web_keywords = $filmTAGS;
	$web_des = $filmINFOcut;
	if($filmLB == 0){
	    $Status = $filmQUALITY.' '.$filmLANG;
	}else{
	    $Status = $filmSTATUS.' '.$filmLANG;
	}
	$CheckCat = str_replace(',,,',',',$row['film_cat']);
	$CheckCat = str_replace(',,',',',$CheckCat);
	$CheckCat		=	explode(',',$CheckCat);
	$CheckCountry = str_replace(',,,',',',$row['film_country']);
	$CheckCountry = str_replace(',,',',',$CheckCountry);
	$CheckCountry		=	explode(',',$CheckCountry);
	$breadcrumbs = '<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
	$breadcrumbs .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="Trang chủ" href="'.$web_link.'" itemprop="url"><span itemprop="name"><i class="fa fa-home"></i> Trang chủ</span></a></li>';

	$film_cat = '';
	for ($i=1; $i<count($CheckCat)-1;$i++) {
	    $cat_namez	  =	get_data('cat_name','cat','cat_id',$CheckCat[$i]);
        $cat_namez_title	  =	get_data('cat_name_title','cat','cat_id',$CheckCat[$i]);
	    $cat_namez_key	  =	get_data('cat_name_key','cat','cat_id',$CheckCat[$i]);
		$film_cat 	.= '<a href="'.$web_link.'/the-loai/'.replace(strtolower(get_ascii($cat_namez_key))).'/" title="'.$cat_namez.'"> '.$cat_namez.'</a>,';
	    $breadcrumbs .= '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.$cat_namez.'" href="'.$web_link.'/the-loai/'.replace(strtolower(get_ascii($cat_namez_key))).'/"><span itemprop="name">'.$cat_namez.'</span></a></li>';
	}


	$breadcrumbs .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.$filmNAMEVN.'" href="'.$filmURL.'" itemprop="url"><span itemprop="name">'.$filmNAMEVN.'</span></a></li>';
	$breadcrumbs .= '<li class="active"><span>Xem phim</span></li>';
	$breadcrumbs .= '</ol>';
	$film_cat_info		=	substr($film_cat,0,-1);

	if($filmIMGBN) $img = $filmIMGBN; else $img = $filmIMG;
	$player = phimle_players($EpisodeURL,$filmID,$episode_id,$EpisodeTYPE,$EpisodeSUB,$img);
	$check_f = $mysql->query("SELECT user_name FROM ".DATABASE_FX."user WHERE user_filmbox LIKE '%,".$filmID.",%' AND user_id = '".$_SESSION["user_id"]."' ORDER BY user_id ASC");
	$fbox = $check_f->fetch(PDO::FETCH_ASSOC);
	if($fbox['user_name']){
	    $like = $language['liked'];
	}else $like = $language['like'];
	$filmPublish = $row['film_publish'];
	$filmThongbao = $row['film_thongbao'];
	if($filmThongbao != '' && $filmPublish == 0){
	$filmNote = '<div class="block info-film-note"><div class="film-note"><h4 class="hidden">Lịch chiếu/ghi chú</h4>'.un_htmlchars($filmThongbao).'</div></div>';
	}else $filmNote = '';


  if(isset($_SESSION["user_id"])){$filmBox = get_data("user_filmbox","user","user_id",$_SESSION["user_id"]);if(strpos($filmBox, ','.$filmID.',') !== false){$filmLike_class = 'Đang theo dõi';}
  else $filmLike_class = 'Theo dõi';}
  else{$filmLike_class = 'Bỏ theo dõi';}

?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xmlns="https://www.w3.org/1999/html" xml:lang="vi" lang="vi">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="title" content="<?=$web_title;?>" />
	<title><?=$web_title;?></title>
	<meta property="og:title" content="<?=$web_title;?>" />
	<meta name="description" content="<?=$web_des;?>" />
	<meta name="keywords" content="<?=$web_keywords;?>" />
	<link rel="alternate" href="<?=$filmURL;?>" hreflang="vi-vn" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<!-- Facebook Metadata /-->
	<meta property="og:type" content="video.movie" />
	<meta property="og:description" content="<?=$web_des;?>" />
	<meta property="og:url" content="<?=$filmURL;?>" />
	

	<link href="<?=$filmURL;?>" rel="canonical">	
	<meta property="og:image" content="<?=$filmIMGBN;?>">
	<meta property="og:site_name" content="HTAVN.NET" />
	<meta property="og:locale" content="vi_VN" />
    <meta property="fb:admins" content="<?=$cf_admin_id;?>" />
    <meta property="fb:app_id" content="<?=$cf_fanpageid;?>" />  
	
	<!-- Google webmaster tools verification -->
	<meta name="google-site-verification" content="nOAdTL20yHtbl47BBnf-tMKIAd3PAcrcCv6o6LLD6t0" />
	<meta name="robots" content="index, follow" />
	<meta name="language" content="Vietnamese, English" />
	<meta name="googlebot" content="index,follow" />
	<meta name="generator" content="HTAVN.NET" />
	<meta name="copyright" content="HTAVN.NET" />
	<meta name="revisit-after" content="1 days" />
	<meta name="author" content="HTAVN.NET" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="content-language" content="vi" />
	<link rel="shortcut icon" href="<?=$web_link;?>/favicon.ico" type="image/x-icon" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!-- stylesheet -->
	<!-- Latest compiled and minified CSS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/fonts.css" />
	<link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/style.css?v=1.45" />

		
	<script type="text/javascript">
		var	MAIN_URL	=	'<?=$web_link;?>';
		var IS_LOGIN = 'false';
	</script>
	
	<script type="text/javascript">
		function JS_Load(u) {
			var d = document,
			p = d.getElementsByTagName('HEAD')[0],
			c = d.createElement('script');
			c.type = 'text/javascript';
			c.src = u;
			p.appendChild(c);
		}
	</script>
	
	<!-- chuyen trang
	<script type="text/javascript">
		JS_Load('<?=$web_link;?>/<?=$SkinLink;?>/js/default.include-footer.js?ver=1.25');
	</script> -->
	
	<script type="text/javascript">
		JS_Load('<?=$web_link;?>/<?=$SkinLink;?>/js/default.include-footerv2.js?ver=1.25');
	</script> 
	<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/jquery.raty.js?v=1.1"></script>
	<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/jquery.md5.js"></script>
	<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/fx/util.js"></script>
	<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/home-v1.js?v=1.1"></script>


		<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/ALeoDbeE.js"></script>
	<script>jwplayer.key="MBvrieqNdmVL4jV0x6LPJ0wKB/Nbz2Qq/lqm3g==";</script>
	<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/watch.js?ver=1.2"></script>
	<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/player.init.js?ver=1.1"></script>

		
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "WebSite",
			"url": "<?=$web_link;?>",
			"potentialAction": {
				"@type": "SearchAction",
				"target": "<?=$web_link;?>/tim-kiem/{search_term_string}.html",
				"query-input": "required key=search_term_string"
			}
		}
</script>

</head>
<body class="home blog wp-custom-logo NoBrdRa">                         
    <div class="Tp-Wp" id="Tp-Wp">
        <header class="Header MnBrCn BgA">
            <div class="MnBr EcBgA">
                <div class="Container">
                    <figure class="Logo" style="max-width: 165px;">
                        <a href="<?=$web_link;?>" title="<?=$web_title;?>" rel="home">
                            <img src="<?=$web_link;?>/favicon.ico" alt="<?=$web_title;?>">
                        </a>
                    </figure> <span class="Button MenuBtn AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"><i></i><i></i><i></i></span> <span class="MenuBtnClose AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"></span>
                    <div class="Rght BgA">
                        <div class="Search">
                            <form method="get" id="form-search" action="tim-kiem/"> <label class="Form-Icon"> <input type="text" name="keyword" id="keyword" placeholder="Tìm: tên phim, tên tiếng Anh ..."> <button id="searchsubmit" type="submit"><i class="fa-search"></i></button> </label>
                                <div class="search-suggest" style="display: none;width: 100%"></div>
                            </form>
                        </div>
 <? require_once("header.php");?>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
    var MovieId = parseInt('<?=$filmID;?>'),
	    EpisodeId = parseInt('<?=$episode_id;?>'),
        Name = '<?=$filmNAMEVN;?>';            
</script>
        </header><div class="Body Container">
    <div class="Content">
        <div class="announcement">
            <span class="ann_title"><i class="fa-bullhorn"></i></span>
            <span class="ann_text">
                <div align="center"><?=strip_tags(text_tidy1($announcement),'<a><b><i><u><br>');?></div>
            </span>
        </div>
		<?=$breadcrumbs;?> 
    
                <div class="TpRwCont">
                    <main>
					    
                        <article class="TPost Single">
                    <header>
                        <h1 class="Title"><?=$filmNAMEVN;?></h1>
                        <h2 class="SubTitle"><?=$filmNAMEVN;?></h2>
						
                        <div class="Image">
						<figure class="Objf"><img width="180" height="260" src="<?=$filmIMG;?>" class="attachment-img-mov-md size-img-mov-md wp-post-image" alt="<?=$filmNAMEVN;?> - <?=$filmNAMEVN;?>" /></figure>
                        </div>		
                        <div class="Description">
                            <p><?=cut_string(text_tidy1(strip_tags($filmINFO)),450);?></p>
                        </div>
                    </header>
                    <footer class="ClFx">
                        <div class="VotesCn">
                            <div class="Prct">
                                <div id="TPVotes" data-percent="<?=$filmRATESCORE;?>"></div>
                            </div>
                            <div class="post-ratings" itemscope itemtype="http://schema.org/Article">
                                <input id="hint_current" type="hidden" value="">
                                <input id="score_current" type="hidden" value="10">
                                <div id="star" data-score="10" style="cursor: pointer;"></div>
                                (<strong class="num-rating">3</strong> lượt, đánh giá: <strong id="average_score">10</strong> trên 10)<br /><span class="post-ratings-text" id="hint"></span>
                                <meta itemprop="headline" content="<?=$filmNAMEVN;?>" />
                                <meta itemprop="mainEntityOfPage" content="<?=$filmURL;?>" />
                            </div>
                            <div style="display: none;" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            	<meta itemprop="bestRating" content="10" />
                                <meta itemprop="bestRating" content="10" />
                                <meta itemprop="worstRating" content="1" />
                                <meta itemprop="ratingValue" content="10" />
                                <meta itemprop="ratingCount" content="3" />
                            </div>
                        </div>
                        <p class="Info"> <span class="Time AAIco-access_time">7/13 Tập</span> <span class="Date AAIco-date_range"><a href="<?=$web_link;?>/danh-sach/phim-nam-2018.html" title="2018‏">2018‏</a></span> <span class="View AAIco-remove_red_eye"><?=$filmVIEWED;?> lượt xem</span></p>

                    </footer>
                                        <div class="TPostBg Objf"><img class="TPostBg" src="<?=$filmIMGBN;?>" alt="<?=$filmNAMEVN;?> - <?=$filmNAMEVN;?>"></div>
                </article>
                    <div class="watch-notice">
                        <div class="box-content alerts">
                            <div class="alert alert-warning"> 
                                <ul>
                                    <li>Xem phim bị lag, load chậm vui lòng cài addon hỗ trợ load nhanh trên Chrome và Cốc Cốc => <a style="color:red; font-weight:bold" target="_blank" rel="noopener noreferrer" href="#">Link Cài Addon</a>. Sau đó F5 trình duyệt lại và xem phim tốc độ cao nà bạn!</li>
                                    <li>Tập nào lỗi hãy nhấn vào nút Báo lỗi để mình fix nhanh nhất nhé các tình yêu</li>
                    
                                </ul>
                            </div>
                        </div>
                    </div>
				    <div id="watch-block">
                      <div class="media-player uniad-player" id="media-player-box">
								
								<div id="media-player" style="width: 100%;height: 100%;background:#1D1D1D;text-align: center">
								    Đang tải, đợi tí nhé bạn ...
								</div>
								<div id="player-loading" class="player-loading"><div class="status"></div></div>
							    <span class="AAIco-input btn-re-expand" id="btn-re-expand"></span>
							</div>
                        <div class="MovieTabNav ControlPlayer">
                                <div class="Lnk AAIco-lightbulb_outline" id="btn-light" title="Tắt đèn nền">Tắt đèn</div>

								<div class="Lnk AAIco-bookmark" id="btn-add-favorite" title="Theo dõi và nhận thông báo khi có tập mới!"><?=$filmLike_class;?></div>
                                <div class="Lnk AAIco-launch" id="btn-expand"><span id="expand-status">Phóng to</span></div>
                                <div class="Lnk AAIco-skip_next" id="btn-autonext" title="Bật/ Tắt chức năng tự chuyển tập"><span>Tự chuyển tập: <span id="autonext-status">Bật</span></span></div>
								<div class="Lnk AAIco-error" id="btn-toggle-error" title="Báo lỗi cho admin!">Báo lỗi</div>
                                <div class="Lnk AAIco-vertical_align_bottom" id="btn-toggle-download" title="Tải về">Tải về</div>
                            </div>
						</div>
						<div class="Wdgt list-server" id="list-server">
									    <?=$EpisodeList;?>
                             </div>
                        <div class="watch-notice">
                            <div class="box-content alerts">
                                <div class="alert alert-info">
                                    <ul><?=$filmNote;?>
                                                                                <li><a href="<?=$web_link;?>/lich-chieu-phim.html" style="color: #31708f;"><strong>Xem lịch chiếu những bộ anime khác</strong></a></li>
                                        <li>Phim Xem ổn định nhất với chất lượng 720p</li>
                                        <li>Hãy like, share, bình luận để ủng hộ website ngày một phát triển nhé các bạn!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <div class="social-button">
    					<div class="item_social"><div class="fb-like" data-href="<?=$filmURL;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div></div>
    					<div class="item_social"><div class="fb-save" data-uri="<?=$filmURL;?>" data-size="small"></div></div>
    					<div class="item_social google"><div class="g-plusone" data-size="medium"></div></div>
					</div> 
                    <div class="Ads ad-center-980">
                        <center>
                        </center>
                    </div>
                        <div class="Wdgt" id="comments">
                            <div class="Title">Bình luận </div>
                            <div class="Comment Wrt" id="respond">
                                <div class="fb-comments fb_iframe_widget" style="text-align: center" data-href="<?=$filmURL;?>" data-order-by="reverse_time" data-num-posts="10" data-width="100%" data-colorscheme="dark">Đang tải bình luận...</div>
							</div>
                        </div>
						<div id="mv-keywords">
                        <strong class="mr10">Từ khóa:</strong>
               <?=showAds('right_below_tags');?>
						</div>
				<div class="Wdgt">
				    <div class="Title">Phim liên quan</div>
                    <div class="MovieListRelated owl-carousel">
<?=ShowFilm("WHERE film_id <> '".$filmID."' AND (MATCH (film_name,film_name_real,film_name_ascii,film_tag,film_tag_ascii) AGAINST ('".text_preg_replace($filmNAMEVN." ".$filmNAMEEN)."' IN BOOLEAN MODE) OR film_cat LIKE '%".$row['film_cat']."%')","ORDER BY MATCH (film_name,film_name_real,film_name_ascii,film_tag,film_tag_ascii) AGAINST ('".text_preg_replace($filmNAMEVN." ".$filmNAMEEN)."' IN BOOLEAN MODE) ",8,"relate_film","");?>                    	                                         

               </div>
                </div>
						
						
                    </main>
                                        <aside class="widget-area" role="complementary">                  
                        <section class="Wdgt" id="showChonLoc">
                            <div class="Title">ANIME MỚI CẬP NHẬT</div>
                            <ul class="MovieList Newepisode">
                              <?=ShowFilm('WHERE film_lb IN (0,1,2)','ORDER BY film_time_update',10,'showfilm_phimmoi','cache_phimmoi');?>
                                      <li><a href="<?=$web_link;?>/danh-sach/anime-moi.html">Xem thêm..</a></li>
                            </ul>
                        </section>

                        <section class="Wdgt" id="showTopPhim">
                            <div class="Title">XEM NHIỀU NHẤT
                                <div class="Top">
                          <a href="<?=$web_link;?>/bang-xep-hang/day.html" class="STPb Current" title="Anime bộ tuần hot" data-tag="day">Ngày</a>
                           <a href="<?=$web_link;?>/bang-xep-hang/week.html" class="STPb" title="Anime lẻ tuần hot" data-tag="week">Tuần</a>
                            <a href="<?=$web_link;?>/bang-xep-hang/week.html" class="STPb" title="Anime lẻ tuần hot" data-tag="month">Tháng</a> 
                            <a href="<?=$web_link;?>/bang-xep-hang/week.html" class="STPb" title="Anime lẻ tuần hot" data-tag="year">Năm</a>

                                </div>
                            </div>
                            
                            <ul class="MovieList">                          
                <?=ShowFilm("WHERE film_viewed_day > 0 AND film_cat NOT LIKE \"%16%\"","ORDER BY film_viewed_day",5,'bxh_day','phimbo_hotw');?>
                                    </ul>
                        </section>
                    </aside>   
                
            </div>
            </div>
        </div>
        <? require_once('footer.php') ?>

<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_four"></div>

        </div>
    </div>

</div>

<script type='text/javascript'>
    var trsol = {
        "error": "No Results",
        "placeholder": "Click here to search"
    };
</script>
<!--[if lt IE 9]><script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/ie/css3mq.js"></script><![endif]-->
<!--[if lte IE 9]><script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/ie/ie.js"></script><![endif]-->
<!--[Fox]><CSS Framework v5.0><[Fox]-->
<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/film.notiny.js"></script>
<span class="lgtbx"></span>
<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/film.rating.js?ver=2.0"></script>
	
</div>
</body>

</html><?}else header('Location: '.$web_link.'/404'); }else header('Location: '.$web_link.'/404'); ?>