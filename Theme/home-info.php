<?php
if($value[1]=='home-info' && is_numeric($value[2])){
    $filmID = (int)$value[2];
	$mysql->update("film","film_viewed = film_viewed + 1,film_viewed_day = film_viewed_day + 1,film_viewed_w = film_viewed_w + 1,film_viewed_m = film_viewed_m + 1","film_id = '".$filmID."'");
	$arr = $mysqldb->prepare("SELECT * FROM ".DATABASE_FX."film WHERE film_id = :id");
    $arr->execute(array('id' => $filmID));
	$row = $arr->fetch();
	if($row['film_id']){
	$filmPublish = $row['film_publish'];
	$filmThongbao = $row['film_thongbao'];
	$filmNAMEVN = $row['film_name'];
	$filmNAMEEN = $row['film_name_real'];
	$filmYEAR = $row['film_year'];
	$filmIMG = changeUrlGoogle($row['film_img']);
	$filmIMGBN = changeUrlGoogle($row['film_imgbn']);
	$film18 = $row['film_phim18'];
	$filmRAP = $row['film_chieurap'];
	$filmRATE = $row['film_rate'];





        $filmLIKED = $row['film_liked'];
        $filmSLUG = $row['film_slug'];
	$filmRATETOTAL = $row['film_rating_total'];
	if($filmRATE != 0)
	$filmRATESCORE = round($filmRATETOTAL/$filmRATE,1);
        else $filmRATESCORE = 0;
	$filmSTATUS = $row['film_trangthai'];
	$filmTIME = $row['film_time'];
	$filmIMDb = ($row['film_imdb']?''.$row['film_imdb'].'':"N/A");
	$filmVIEWED = number_format($row['film_viewed']);
	$filmLB = $row['film_lb'];
	$filmPROD = TAGS_LINK2($row['film_area']);
	$filmPRODUCERS = ($filmPROD?$filmPROD:"N/A");






    $film_director = 	TAGS_LINK2($row['film_director']);
	$filmDIRECTOR = ($film_director?$film_director:"N/A");

    $film_actor = TAGS_ACTOR($row['film_actor']);
	$filmACTOR = ($film_actor?'<ul class="ListCast Rows AF A06 B03 C02 D20 E02">'.$film_actor.'</ul>':"<div class=\"alert alert-warning\">Chưa có thông tin về diễn viên của bộ phim này</div>");


	$filmLANG = film_lang($row['film_lang']);
	$filmQUALITY = ($row['film_chatluong']?$row['film_chatluong']:"N/A");
	$filmTAGS = $row['film_tag'];
	$filmURL = $web_link.'/phim/'.$filmSLUG.'-'.replace($filmID).'/';
	$filmINFO = strip_tags(text_tidy1($row['film_info']),'<b><i><u><img><br><p>');
	$filmINFOcut = (strip_tags(text_tidy1($filmINFO)));

	$filmTRANGTHAI = $row['film_trangthai'];
	

	if($row['film_lb'] == 0){
	    $Status = '<span class="mli-quality">'.$filmQUALITY.'</span>';
	}else{
	    $Status = '<span class="mli-eps">'.$filmLIST.'<i>'.$filmSTATUS.'</i></span>';
	
	}
	$CheckCat = $row['film_cat'];
	$CheckCat = str_replace(",,",",",$CheckCat);
	$CheckCat = explode(',',$CheckCat);
	$CheckCountry = $row['film_country'];
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
	$breadcrumbs .= '<li class="active"><span>Thông tin</span></li>';
	$breadcrumbs .= '</ol>';
	$film_cat_info		=	substr($film_cat,0,-1);


	$link_country="";
	for ($i=1; $i<count($CheckCountry)-1;$i++) {
	$film_country = get_data('country_name','country','country_id',$CheckCountry[$i]);
	$film_country_key = get_data('country_name_key','country','country_id',$CheckCountry[$i]);
	$link_country .= '<a href="'.$web_link.'/quoc-gia/'.replace(strtolower(get_ascii($film_country_key))).'/'.'" title="'.$film_country.'">'.$film_country.'</a>,';
	}
	$link_country_list = substr($link_country, 0,-1);
	$isEpisode = get_data_multi("episode_id","episode","episode_film = '".$filmID."' AND episode_servertype NOT IN (13,14)"); // có hoặc ko có episode play
    $isDown = get_data_multi("episode_id","episode","episode_film = '".$filmID."' AND episode_servertype IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14)"); // có hoặc ko có episode download
        
	if($filmPublish == 1){
	    $filmWATCH = ' <a class="watch_button_more" href="javascript:void()" onclick=" fx.alertMessage(\'Xin chào\', \'Phim này đã bị bản quyền. (Mong các bạn thông cảm)\', \'warning\');">Bản Quyền </a> ';
		$filmDownload = '';
	}else{
	    if($isEpisode && $isDown){
		    $filmWATCH = '<a href="'.$filmURL.'xem-phim.html"><i class="TpMvPlay AAIco-play_arrow show"></i></a>    
                          <a class="watch_button_more" title="'.$filmNAMEVN.' ('.$filmYEAR.')" href="'.$filmURL.'xem-phim.html">Xem phim </a>';
			$filmDownload = ' <li class="item"><a id="btn-film-download" class="btn btn-green btn" title="Phim '.$filmNAMEVN.' VietSub HD | '.$filmNAMEEN.' '.$filmYEAR.'" href="'.$filmURL.'download.html"><i class="fa fa-download"></i>  Download</a></li>';
		}elseif(!$isEpisode && $isDown){
		    $filmWATCH = '';
			$filmDownload = ' <li class="item"><a id="btn-film-download" class="btn btn-green btn" title="Phim '.$filmNAMEVN.' VietSub HD | '.$filmNAMEEN.' '.$filmYEAR.'" href="'.$filmURL.'download.html"><i class="fa fa-download"></i>  Download</a></li>';
		}elseif($isEpisode && !$isDown){
            $filmWATCH = '<a href="'.$filmURL.'xem-phim.html"><i class="TpMvPlay AAIco-play_arrow show"></i></a>    
                          <a class="watch_button_more" title="'.$filmNAMEVN.' ('.$filmYEAR.')" href="'.$filmURL.'xem-phim.html">Xem phim </a>';
			$filmDownload = '';
        }else{
            $filmWATCH = '<a href="javascript:void()" onclick=" fx.alertMessage(\'Xin chào\', \'Dữ liệu đang được cập nhật. (Mong bạn thông cảm)\', \'info\');"><i class="TpMvPlay AAIco-play_arrow show"></i></a>
            <a class="watch_button_more" href="javascript:void()" onclick=" fx.alertMessage(\'Xin chào\', \'Dữ liệu đang được cập nhật. (Mong bạn thông cảm)\', \'info\');">Xem phim </a>';		
  			



            $filmDownload = '';
        }
	}	
		
	if($filmThongbao != '' && $filmPublish == 0){
	$filmNote = '<div class="block info-film-note"><div class="film-note"><h4 class="hidden">Lịch chiếu/ghi chú</h4>'.un_htmlchars($filmThongbao).'</div></div>';
	}else $filmNote = '';
	
	if($filmQUALITY == 'CAM' || $filmQUALITY == 'TS' || $filmQUALITY == 'SD'){
	
       $filmSub = 0;
	}else{ $filmSub = 1;}
	
	$web_title = 'Xem Anime '.$filmNAMEVN.' ('.$filmYEAR.')';
	$web_keywords = $filmTAGS;
	if($row['film_des'] == '')
	$web_des = $web_title.', thể loại '.strip_tags($film_cat_info);
	else 
	$web_des = $row['film_des'];
	if($film18 == 1) $filmCanhbao18 = '<span class="canhbao18"></span> '; else $filmCanhbao18 = '';
	if(isset($_SESSION["user_id"])){$filmBox = get_data("user_filmbox","user","user_id",$_SESSION["user_id"]);if(strpos($filmBox, ','.$filmID.',') !== false){$filmLike_class = 'added';}else $filmLike_class = 'normal';}else{$filmLike_class = 'normal';}
if(($filmSub == 0) && ($filmLB == 0)){$subscribe = 0;}elseif($filmLB == 2){$subscribe = 2;}elseif($filmLB == 3){$subscribe = 3;}else $subscribe = 1;


	$film_episode_info			 = EpisodeList($filmID,"episode_servertype");


	$filmTRAILER =  get_idyoutube($row['film_trailer']);
	  if ($filmTRAILER){
		$trailer = '<div class="TPlayerCn BgA"><div class="EcBgA"><div class="TPlayer">
<div class="TPlayerTb Current clearfix" id="Opt1"><iframe width="560" height="315" src="https://youtube.com/embed/'.$filmTRAILER.'?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div>
<span class="AAIco-lightbulb_outline lgtbx-lnk"></span>
</div>
</div>
</div>';
		  }
	  else {
	    $trailer = '<div class="TPlayerCn BgA"><div class="EcBgA"><div class="TPlayer">
<div class="TPlayerTb Current clearfix" id="Opt1"><iframe width="560" height="315" src="https://youtube.com/embed/g_3VyAfEQWs?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div>
<span class="AAIco-lightbulb_outline lgtbx-lnk"></span>
</div>
</div>
</div>';
	}




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
	<meta property="og:type" content="video.movie" />
	<meta property="og:description" content="<?=$web_des;?>" />
	<meta property="og:url" content="<?=$filmURL;?>" />
	<link href="<?=$filmURL;?>" rel="canonical">	
	<meta property="og:image" content="<?=$filmIMG;?>">
	<meta property="og:site_name" content="HTAVN.NET" />
	<meta property="og:locale" content="vi_VN" />
    <meta property="fb:admins" content="<?=$cf_admin_id;?>" />
    <meta property="fb:app_id" content="<?=$cf_fanpageid;?>" />    

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

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/style.css?v=1.45" />

        
    <script type="text/javascript">
        var MAIN_URL    =   '<?=$web_link;?>';
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


        
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "https://HTAVN.NET",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "<?=$web_link;?>tim-kiem/{search_term_string}.html",
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
        </header>
    <script type="text/javascript">
    var MovieId = parseInt('<?=$filmID;?>');
    setTimeout(function() {
        updateMovieView(MovieId)
    }, 1000);

    function updateMovieView(e) {
        $.ajax({
            url: MAIN_URL + "/ajax/movie_update_view",
            type: "POST",
            dataType: "json",
            data: {
                id: e
            },
            success: function() {}
        })
    };
</script>    
  <div class="Body Container">
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
                        <h2 class="SubTitle"> <?=$filmNAMEEN;?> (<?=$filmYEAR;?>)</h2>
                        <div class="Image">
                    <div class="tools-box"><div class="tools-box-bookmark <?=$filmLike_class;?>" data-filmid="<?=$filmID;?>"><span class="bookmark-status"></span><span class="bookmark-action"></span></div></div>
                            <figure class="Objf"><img width="180" height="260" src="<?=$filmIMG?>" /></figure>
                             <?=$filmWATCH;?> </div>
                        <div class="Description">
                            <p> <?=textlink_site($filmINFO,$filmNAMEEN,$filmURL);?></p>
                        </div>
                    </header>
                    <footer class="ClFx">
                        <div class="VotesCn">
                            <div class="Prct">
                                <div id="TPVotes" data-percent="<?=$filmRATESCORE;?>"></div>
                            </div>
                            <div class="post-ratings" itemscope itemtype="http://schema.org/Article">
                                <input id="hint_current" type="hidden" value="">
                                <input id="score_current" type="hidden" value="<?=$filmRATESCORE;?>">
                                <div id="star" data-score="<?=$filmRATESCORE;?>" style="cursor: pointer;"></div>
                                (<strong class="num-rating"><?=$filmRATE;?></strong> lượt, đánh giá: <strong id="average_score"><?=$filmRATESCORE;?></strong> trên 10)<br /><span class="post-ratings-text" id="hint"></span>
                                <meta itemprop="headline" content="G<?=$filmNAMEVN;?>" />
                                <meta itemprop="mainEntityOfPage" content="G<?=$filmNAMEVN;?>" />          
                            </div>
                            <div style="display: none;" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            	<meta itemprop="bestRating" content="10" />
                                <meta itemprop="bestRating" content="10" />
                                <meta itemprop="worstRating" content="1" />
                                <meta itemprop="ratingValue" content="<?=$filmRATESCORE;?>" />
                                <meta itemprop="ratingCount" content="<?=$filmRATETOTAL;?>" />
                            </div>
                        </div>
                        <p class="Info"> <span class="Time AAIco-access_time"><?=$filmTIME;?></span> <span class="Date AAIco-date_range"><a href="<?=$web_link;?>/danh-sach/phim-nam-<?=$filmYEAR;?>/" title="<?=$filmYEAR;?>"><?=$filmYEAR;?></a></span> <span class="View AAIco-remove_red_eye"><?=$filmVIEWED;?> lượt xem</span></p>

                    </footer>
                         <div class="TPostBg Objf"><img class="TPostBg" src="<?=$filmIMGBN;?>" alt="<?=$filmNAMEVN;?>"></div>
                </article>

                <div class="MovieInfo TPost Single">
                    <div class="MovieTabNav">
                        <div class="Lnk on AAIco-description" data-Mvtab="MvTb-Info">Thông tin phim</div>
                        <div class="Lnk AAIco-movie_filter" data-Mvtab="MvTb-Cast">Diễn viên</div>
                        <div class="Lnk AAIco-video_call" data-Mvtab="MvTb-Trailer">Trailer</div>
                        <div class="Lnk AAIco-collections" data-Mvtab="MvTb-Image">Hình ảnh</div>
                    </div>
                    <div class="MvTbCn on anmt" id="MvTb-Info">
                        <div class="mvici-left">
                            <ul class="InfoList">
                                <li class="AAIco-adjust"><strong>Trạng thái:</strong> <?=$filmTRANGTHAI;?> Tập</li>
                                <li class="AAIco-adjust"><strong>Thể loại:</strong> <?=$film_cat_info;?></li>
                                <li class="AAIco-adjust"><strong>Đạo diễn:</strong> <?=$filmDIRECTOR;?></li>
                                <li class="AAIco-adjust"><strong>Quốc gia:</strong> <?=$link_country_list;?></li>
                                <li class="AAIco-adjust"><strong>Nhà sản xuất:</strong> <?=$filmPRODUCERS;?></li>
                            </ul>
                        </div>
                        <div class="mvici-right">
                            <ul class="InfoList">
                              <li class="AAIco-adjust"><strong>Thời lượng:</strong> <?=$filmTIME;?></li>
                                <li class="AAIco-adjust"><strong>Độ phân giải:</strong> <span class="quality"><?=$filmQUALITY;?></span></li>
                                <li class="AAIco-adjust"><strong>IMDb:</strong> <span class="imdb"><?=$filmIMDb;?></span></li>
                                <li class="AAIco-adjust"><strong>Ngôn ngữ:</strong>VietSub </li>
                                                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="MvTbCn anmt" id="MvTb-Cast">
                    	<?=$filmACTOR;?>
                                            </div>
                    <div class="MvTbCn anmt clearfix" id="MvTb-Trailer">
                        <?=$trailer;?>
                                                            </div>
                    <div class="MvTbCn anmt" id="MvTb-Image">
                        <div class="ImageMovieList owl-carousel">
                         <div class="alert alert-warning"><img src="<?=$filmIMGBN;?>"></div>
                                                    </div>
                    </div>

                    <div class="TPostBg Objf"></div>
                </div>
                <div class="social-button">
                    <div class="item_social">
                        <div class="fb-like" data-href="<?=$filmURL;?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    </div>
                    <div class="item_social"><div class="fb-save" data-uri="<?=$filmURL;?>" data-size="small"></div></div>
                    <div class="item_social google">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                </div>
                <div class="Ads ad-center-980">
                    <center>
                    </center>
                </div>
                <div class="Wdgt" id="comments">
                    <div class="Title">Bình luận</div>
                    <div class="Comment Wrt" id="respond">
                        <div class="fb-comments fb_iframe_widget" style="text-align: center;" data-order-by="reverse_time" data-href="<?=$filmURL;?>" data-num-posts="10" data-width="100%" data-colorscheme="dark">Đang tải bình luận...</div>
                    </div>
                </div>
                <div id="mv-keywords">
                    <strong class="mr10">Từ khóa:</strong>  
                    <?=TAGS_LINK2($filmTAGS);?>
                </div>
				<div class="Wdgt">
				    <div class="Title">Phim liên quan</div>
                    <div class="MovieListRelated owl-carousel">
                      <?=ShowFilm("WHERE film_id <> '".$filmID."' AND (MATCH (film_name,film_name_real,film_name_ascii,film_tag,film_tag_ascii) AGAINST ('".text_preg_replace($filmNAMEVN." ".$filmNAMEEN)."' IN BOOLEAN MODE) OR film_cat LIKE '%".$row['film_cat']."%')","ORDER BY MATCH (film_name,film_name_real,film_name_ascii,film_tag,film_tag_ascii) AGAINST ('".text_preg_replace($filmNAMEVN." ".$filmNAMEEN)."' IN BOOLEAN MODE) ",10,"relate_film","");?>
                 </div>
                </div>
                <div class="Wdgt">
				    <div class="Title">Xem gần đây</div>
                    <div class="MovieListRelated owl-carousel">
                        Chưa có dữ liệu                    </div>
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
<? require_once('footer.php'); ?>
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
<!--[if lt IE 9]><script type="text/javascript" src="https://HTAVN.NET/Theme/js/ie/css3mq.js"></script><![endif]-->
<!--[if lte IE 9]><script type="text/javascript" src="https://HTAVN.NET/Theme/js/ie/ie.js"></script><![endif]-->
<!--[Fox]><CSS Framework v5.0><[Fox]-->
<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/film.notiny.js"></script>
<span class="lgtbx"></span>
<script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/film.rating.js?ver=2.0"></script>
	
</div>
</body>

</html>



<?}else header('Location: '.$web_link.'/404');  }else header('Location: '.$web_link.'/404'); ?>