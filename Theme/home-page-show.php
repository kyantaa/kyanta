<?php

if($value[1]=='home-page-show'){

    $pageURL = sql_escape($value[2]);
    $page = explode("trang-",URL_LOAD);
	$page = explode(".html",$page[1]);
	$page =	(int)($page[0]);
	$rel = explode("?rel=",URL_LOAD);
	$rel = explode(".html",$rel[1]);
	$rel =	sql_escape(trim($rel[0]));
	$mysql->query("UPDATE ".DATABASE_FX."pages SET page_viewed = page_viewed + 1,
													page_viewed_d = page_viewed_d + 1,
													page_viewed_w = page_viewed_w + 1,
													page_viewed_m = page_viewed_m + 1 WHERE page_url = '".$pageURL."'");
	$arr = $mysqldb->prepare("SELECT * FROM ".DATABASE_FX."pages WHERE page_url = :url");
    $arr->execute(array('url' => $pageURL));
	$row = $arr->fetch();
if($row['page_id']){
	    $pageNAME = $row['page_name'];
	    $pageIMG = $row['page_img'];
	    $pageINFO = strip_tags(text_tidy1($row['page_info']),'<a><b><i><u><img><br><p><ol><ul><li><h1><h2><h3><span><strong><em>');
	    $pageTAGS = strip_tags(text_tidy1($row['page_tags']),'<a><b><i><u><img><br><p><ol><ul><li><h1><h2><h3><span><strong><em>');
	    $pageTIME = RemainTime($row['page_time_update']);
	    $pageVIEWED = number_format($row['page_viewed']);
	  
	    $web_keywords = 'phim, xem phim, phim hd, phim online, phim hd online, phim hd mien phi, xem phim mien phi, phim hay, phim hay nhất';
	    $web_des = 'Xem phim HD online chất lượng cao, tốc độ nhanh. Đến với PhimLẻ[Tv], các bạn sẽ được thưởng thức những bộ phim lôi cuốn và hấp dẫn nhất của điện ảnh thế giới';
	    $web_title = $pageNAME;

         $breadcrumbs = '<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
		 $breadcrumbs .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="Trang chủ" href="'.$web_link.'" itemprop="url"><span itemprop="name"><i class="fa fa-home"></i> Trang chủ</span></a></li>';
	     $breadcrumbs .= '<li class="active">'.$pageNAME.'</li>';
	     $breadcrumbs .= '</ol>';

	     $webURL = $web_link.'/page/'.$pageURL.'.html';





?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xmlns="https://www.w3.org/1999/html" xml:lang="vi" lang="vi">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="title" content="<?=$web_title;?>" />
	<title><?=$web_title;?></title>
	<meta property="og:title" content="<?=$web_title;?>" />
	<meta name="description" content="Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime hay HOT luôn được cập nhật sớm nhất Việt Nam, xem anime hay nhất, hãy cùng khám phá kho tàng về hoạt hình nhật bản nhé." />
	<meta name="keywords" content="anime vietsub, xem anime, vui ghe, naruto, vua hai tac, one piece, hoi phap su, fairy tail, bleach, dragon ball, dao hai tac, boruto, animevsub, anime hay, animehay, animehayhd, anime47, hoat hinh trung quoc, anime vietsub hd, anime moi nhat, anime hay nhat" />
	<link rel="alternate" href="<?=$webURL;?>" hreflang="vi-vn" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<!-- Facebook Metadata /-->
	<meta property="og:type" content="video.movie" />
	<meta property="og:description" content="Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime hay HOT luôn được cập nhật sớm nhất Việt Nam, xem anime hay nhất, hãy cùng khám phá kho tàng về hoạt hình nhật bản nhé." />
	<meta property="og:url" content="<?=$pageURL;?>" />
	
	<meta property="og:site_name" content="Animehayhd.com" />
	<meta property="og:locale" content="vi_VN" />
    <meta property="fb:admins" content="<?=$cf_admin_id;?>" />
    <meta property="fb:app_id" content="<?=$cf_fanpageid;?>" /> 
	
	<!-- Google webmaster tools verification -->
	<meta name="google-site-verification" content="nOAdTL20yHtbl47BBnf-tMKIAd3PAcrcCv6o6LLD6t0" />
	<meta name="robots" content="index, follow" />
	<meta name="language" content="Vietnamese, English" />
	<meta name="googlebot" content="index,follow" />
	<meta name="generator" content="Animehayhd.com" />
	<meta name="copyright" content="Animehayhd.com" />
	<meta name="revisit-after" content="1 days" />
	<meta name="author" content="Animehayhd.com" />
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
                <section id="log-reg">
                    <h1 class="title"><?=$web_title;?> </h1>
                       <?=$pageINFO;?>
                </section>
                <div class="fb-comments" data-order-by="reverse_time" data-href="<?=$webURL;?>" data-num-posts="10" data-colorscheme="dark" data-width="100%" style="text-align: center"> Đang tải bình luận...</div>
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
	
</div>
</body>

</html>


<? }else header('Location: '.$web_link.'/404');  }else header('Location: '.$web_link.'/404');  ?>	