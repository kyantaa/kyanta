<?php 
if($value[1]=='home-box'){
if(isset($_SESSION["user_id"])){
    $q = $mysql->query("SELECT user_name,user_fullname,user_avatar,user_email FROM ".$tb_prefix."user WHERE user_id = '".$_SESSION['user_id']."'");
    $row = $q->fetch(PDO::FETCH_ASSOC);
    $UserID = (int)$_SESSION["user_id"];
    $UserNAME = $_SESSION["user_name"];

    $UserMAIL = $row["user_email"];
$username = $row['user_name'];

    $page = explode("trang-",URL_LOAD);
	$page = explode(".html",$page[1]);
	$page =	(int)($page[0]);
	$rel = explode("?rel=",URL_LOAD);
	$rel = explode(".html",$rel[1]);
	$rel =	sql_escape(trim($rel[0]));
	if(strpos(URL_LOAD , 'rel=new') !== false || strpos(URL_LOAD , 'rel=popular') !== false || strpos(URL_LOAD , 'rel=year') !== false  || strpos(URL_LOAD , 'rel=name') !== false){
		    if(strpos(URL_LOAD , 'rel=popular') !== false){
			    $order_sql = "ORDER BY film_viewed DESC";
			}elseif(strpos(URL_LOAD , 'rel=new') !== false){
			    $order_sql = "ORDER BY film_id DESC";
			}elseif(strpos(URL_LOAD , 'rel=year') !== false){
			    $order_sql = "ORDER BY film_year DESC";
			}elseif(strpos(URL_LOAD , 'rel=name') !== false){
			    $order_sql = "ORDER BY film_name ASC";
			}
			
		}else{
		    $order_sql = "ORDER BY film_time_update DESC";   
		}

	   
	    $web_keywords = 'xem phim của '.$UserNAME.' full hd, phim của '.$UserNAME.' online, phim của '.$UserNAME.' vietsub, phim của '.$UserNAME.' thuyet minh, phim  long tieng, phim của '.$UserNAME.' tap cuoi';
	    $web_des = 'Phim của '.$UserNAME.' hay tuyển tập, phim của '.$UserNAME.' mới nhất, tổng hợp phim của '.$UserNAME.', phim của '.$UserNAME.' full HD, phim của '.$UserNAME.' vietsub, xem phim của'.$UserNAME.' online';
	    $web_title = $UserNAME.' | BST phim '.$UserNAME.'';
		$breadcrumbs .= '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		$breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$web_link.'/account/info" title="'.$language['account2'].'"><span itemprop="title">'.$language['account2'].' <i class="fa fa-angle-right"></i></span></a></li>';
	    $breadcrumbs .= '<li><a class="current" href="#" title="'.$UserNAME.'">'.$UserNAME.'</a></li>';
	    $h1title = $language['filmbox_of'].' '.$UserNAME;
		$pageURL = $web_link.'/account/film';
		$name = $UserID;
	   
        
?>
                                <!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xmlns="https://www.w3.org/1999/html" xml:lang="vi" lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="Thông tin thành Viên" />
    <title>Thông tin thành Viên</title>
    <meta property="og:title" content="Thông tin thành Viên" />
    <meta name="description" content="Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime hay HOT luôn được cập nhật sớm nhất Việt Nam, xem anime hay nhất, hãy cùng khám phá kho tàng về hoạt hình nhật bản nhé." />
    <meta name="keywords" content="anime vietsub, xem anime, vui ghe, naruto, vua hai tac, one piece, hoi phap su, fairy tail, bleach, dragon ball, dao hai tac, boruto, animevsub, anime hay, animehay, animehayhd, anime47, hoat hinh trung quoc, anime vietsub hd, anime moi nhat, anime hay nhat" />
    <link rel="alternate" href="https://animehayhd.com/tai-khoan/phim-yeu-thich.html" hreflang="vi-vn" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <!-- Facebook Metadata /-->
    <meta property="og:type" content="video.movie" />
    <meta property="og:description" content="Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime hay HOT luôn được cập nhật sớm nhất Việt Nam, xem anime hay nhất, hãy cùng khám phá kho tàng về hoạt hình nhật bản nhé." />
    <meta property="og:url" content="https://animehayhd.com/tai-khoan/phim-yeu-thich.html" />
    

        
    
    <meta property="og:site_name" content="Animehayhd.com" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="fb:admins" content="100001721559078,100028093845937" />
    <meta property="fb:app_id" content="1067922096708851" />  
    <meta property="fb:pages" content="1795219933846505" />   
    
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
    <link rel="shortcut icon" href="https://animehayhd.com/favicon.ico" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- stylesheet -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://animehayhd.com/Theme/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://animehayhd.com/Theme/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="https://animehayhd.com/Theme/css/style.css?v=1.45" />
    <link rel="stylesheet" type="text/css" href="https://animehayhd.com/Theme/libs/adi/jquery.adi.css" />
        <link rel="stylesheet" type="text/css" href="https://animehayhd.com/Theme/css/login.css" />
        
    <script type="text/javascript">
        var MAIN_URL    =   '<?=$web_link;?>';
        var IS_LOGIN = 'true';
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
        JS_Load('https://animehayhd.com/Theme/js/default.include-footer.js?ver=1.25');
    </script> -->
    
    <script type="text/javascript">
        JS_Load('https://animehayhd.com/Theme/js/default.include-footerv2.js?ver=1.25');
    </script> 
    <script type="text/javascript" src="https://animehayhd.com/Theme/js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="https://animehayhd.com/Theme/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://animehayhd.com/Theme/js/jquery.raty.js?v=1.1"></script>
    <script type="text/javascript" src="https://animehayhd.com/Theme/js/jquery.md5.js"></script>
    <script type="text/javascript" src="https://animehayhd.com/Theme/js/fx/util.js"></script>
    <script type="text/javascript" src="https://animehayhd.com/Theme/js/home-v1.js?v=1.1"></script>
    <script type="text/javascript" src="https://animehayhd.com/Theme/libs/adi/advertisement.js"></script>
    <script type="text/javascript" src="https://animehayhd.com/Theme/libs/adi/jquery.adi.js"></script>

        
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "https://animehayhd.com",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://animehayhd.com/tim-kiem/{search_term_string}.html",
                "query-input": "required key=search_term_string"
            }
        }
</script>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NBKP3JZ');</script>
<!-- End Google Tag Manager -->

</head>
<body class="home blog wp-custom-logo NoBrdRa">
    
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBKP3JZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    
    <div class="Tp-Wp" id="Tp-Wp">
        <header class="Header MnBrCn BgA">
            <div class="MnBr EcBgA">
                <div class="Container">
                    <figure class="Logo" style="max-width: 165px;">
                        <a href="https://animehayhd.com" title="Anime Hay HD | Anime Vietsub | Xem Anime Vietsub HD Online | Hoạt Hình Vietsub | Xem Anime | Xem Anime Vietsub Miễn Phí Siêu Nhanh" rel="home">
                            <img src="https://animehayhd.com/Theme/images/logo.png" alt="Anime Hay HD | Anime Vietsub | Xem Anime Vietsub HD Online | Hoạt Hình Vietsub | Xem Anime | Xem Anime Vietsub Miễn Phí Siêu Nhanh">
                        </a>
                    </figure> <span class="Button MenuBtn AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"><i></i><i></i><i></i></span> <span class="MenuBtnClose AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"></span>
                    <div class="Rght BgA">
                        <div class="Search">
                            <form method="get" id="form-search" action="tim-kiem/"> <label class="Form-Icon"> <input type="text" name="keyword" id="keyword" placeholder="Tìm: tên phim, tên tiếng Anh ..."> <button id="searchsubmit" type="submit"><i class="fa-search"></i></button> </label>
                                <div class="search-suggest" style="display: none;width: 100%"></div>
                            </form>
                        </div>
                        <div class="Login">
                            
                <input type="checkbox" hidden="hidden" id="LnkUser">
                <label for="LnkUser" class="LnkUser fa-chevron-down"><img src="https://animehayhd.com/Theme/images/cast-image.png" alt=""></label>
                <ul>
                    <li><a href="https://animehayhd.com/tai-khoan/ca-nhan.html" class="fa-user">Thông tin tài khoản</a></li>
                    <li><a href="https://animehayhd.com/tai-khoan/phim-yeu-thich.html" class="fa-film">Hộp phim</a></li>
                    <li><a href="https://animehayhd.com/tai-khoan/phim-dang-theo-doi.html" class="fa-film">Phim đang theo dõi</a></li>
                    <li><a href="https://animehayhd.com/tai-khoan/cap-nhat-thong-tin.html" class="fa-lock">Thay đổi thông tin</a></li>
                    <li><a href="javascript" id="logout" class="fa-power-off">Đăng xuất</a></li>
                </ul>                       </div>      
                                                    <div class="Notice navbar-notice">
                                <a href="javascript:void(0);" class="navbar-notice-toggle"><i class="fa fa-bell"></i></a>
                                <div class="manage-notifi"></div>
                            </div>  
                                                
                        <nav class="Menu">
                            <ul>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-490"><a href="https://animehayhd.com" title="Anime Hay HD | Anime Vietsub | Xem Anime Vietsub HD Online | Hoạt Hình Vietsub | Xem Anime | Xem Anime Vietsub Miễn Phí Siêu Nhanh">TRANG CHỦ</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="#">ANIME</a>
                                    <ul class="sub-menu">
                                        <li><a href="https://animehayhd.com/danh-sach/anime-moi.html">Anime mới</a></li>
                                        <li><a href="https://animehayhd.com/danh-sach/anime-le.html">Anime lẻ</a></li>
                                        <li><a href="https://animehayhd.com/danh-sach/anime-bo.html">Anime bộ</a></li>
                                        <li style="width: 150%"><a href="https://animehayhd.com/danh-sach/anime-bo-da-hoan-thanh.html">Anime đã hoàn thành</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="#">THỂ LOẠI</a>
                                    <ul class="sub-menu"><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/ac-quy.html">Ác Quỷ</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/am-nhac.html">Âm Nhạc</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/anime.html">Anime</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/chien-tranh.html">Chiến Tranh</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/dam-my.html">Đam Mỹ</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/doi-thuong.html">Đời Thường</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/gia-tuong.html">Giả Tưởng</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/drama.html">Drama</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/ecchi.html">Ecchi</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/fantasy.html">Fantasy</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/game.html">Game</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/gia-dinh.html">Gia Đình</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/hai-huoc.html">Hài Hước</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/hanh-dong.html">Hành Động</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/harem.html">Harem</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/hoat-hinh.html">Hoạt Hình</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/hoc-duong.html">Học Đường</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/hoi-hop.html">Hồi Hộp</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/kinh-di.html">Kinh Dị</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/lich-su.html">Lịch Sử</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/live-action.html">Live Action</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/ma-ca-rong.html">Ma Cà Rồng</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/mecha.html">Mecha</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/mystery.html">Mystery</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/parody.html">Parody</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/phep-thuat.html">Phép Thuật</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/phieu-luu.html">Phiêu Lưu</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/police.html">Police</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/psychological.html">Psychological</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/quan-doi.html">Quân Đội</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/samurai.html">Samurai</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/seinen.html">Seinen</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/shoujo.html">Shoujo</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/shounen.html">Shounen</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/sieu-nang-luc.html">Siêu Năng Lực</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/sieu-nhien.html">Siêu Nhiên</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/the-thao.html">Thể Thao</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/tinh-cam.html">Tình Cảm</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/tokusatsu.html">Tokusatsu</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/tragedy.html">Tragedy</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/vien-tuong.html">Viễn Tưởng</a></li><li class="sub-menu-item"><a href="https://animehayhd.com/the-loai/vo-thuat.html">Võ Thuật</a></li></ul>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="#">NĂM PHÁT HÀNH</a>
                                    <ul class="sub-menu"><li> <span class="icon"></span> <a href="https://animehayhd.com/danh-sach/phim-nam-2019.html">Năm 2019</a> </li><li> <span class="icon"></span> <a href="https://animehayhd.com/danh-sach/phim-nam-2018.html">Năm 2018</a> </li><li> <span class="icon"></span> <a href="https://animehayhd.com/danh-sach/phim-nam-2017.html">Năm 2017</a> </li><li> <span class="icon"></span> <a href="https://animehayhd.com/danh-sach/phim-nam-2016.html">Năm 2016</a> </li><li> <span class="icon"></span> <a href="https://animehayhd.com/danh-sach/phim-nam-2015.html">Năm 2015</a> </li><li> <span class="icon"></span> <a href="https://animehayhd.com/danh-sach/phim-nam-2014.html">Năm 2014</a> </li><li> <span class="icon"></span> <a href="https://animehayhd.com/danh-sach/phim-nam-2013.html">Năm 2013</a> </li><li> <span class="icon"></span> <a href="https://animehayhd.com/danh-sach/phim-nam-2012.html">Năm 2012</a> </li><li> <span class="icon"></span> <a href="https://animehayhd.com/danh-sach/phim-nam-2011.html">Năm 2011</a> </li></ul>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="https://animehayhd.com/bang-xep-hang.html">BẢNG XẾP HẠNG</a>
                                    <ul class="sub-menu">
                                        <li><a href="https://animehayhd.com/bang-xep-hang/ngay.html">Theo Ngày</a></li>
                                        <li><a href="https://animehayhd.com/bang-xep-hang/tuan.html>">Theo Tuần</a></li>
                                        <li><a href="https://animehayhd.com/bang-xep-hang/thang.html">Theo Tháng</a></li>
                                        <li><a href="https://animehayhd.com/bang-xep-hang/nam.html">Theo Năm</a></li>
                                    </ul>
                                </li>   
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="#">KHÁC</a>
                                    <ul class="sub-menu">
                                        <li><a href="https://animehayhd.com/thu-vien/a.html">Thư viện</a></li>
                                        <li><a href="https://animehayhd.com/lich-chieu-phim.html">Lịch chiếu</a></li>
                                    </ul>   
                                </li>             
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>    <div class="Body Container">
        <div class="Content">

            <div class="TpRwCont">
                <main>
                                    <style>
                        span.movie-close-button {
                        position: absolute;
                        top: 8px;
                        left: 8px;
                        border-radius: 3px;
                        color: #fff;
                        font-size: 13px;
                        padding: 1px 6px;
                        position: absolute;
                        background: #b15f5f;
                        z-index: 999;
                    }
                    </style>
                    <section>
                            <div class="Top">
                                <h1>Tủ phim của aaa</h1> 
                            </div>
   <ul class="MovieList Rows AX A06 B04 C03 E20">


				<?php 
				 $boxphim = get_data('user_filmbox','user','user_id',$UserID );
				 
if($boxphim != ','){
$list =  substr($boxphim,1); // Cắt chuối con từ vị trí 1 đến hết chuỗi
        $list = substr($list,0,-1); //Cắt từ vị trí số 6 đếm từ cuối chuỗi đến hết chuỗi
	$page_size = PAGE_SIZE;
	if (!$page) $page = 1;
	$limit = ($page-1)*$page_size;
    $q = $mysql->query("SELECT * FROM ".DATABASE_FX."film WHERE film_id IN ($list) $order_sql LIMIT ".$limit.",".$page_size);
	$total = get_total("film","film_id","WHERE film_id IN ($list) $order_sql");
	$ViewPage = view_pages('film',$total,$page_size,$page,$pageURL,$rel);
while($row = $q->fetch(PDO::FETCH_ASSOC)){
$filmID = $row['film_id'];
$filmNAMEVN = $row['film_name'];
$filmNAMEEN = $row['film_name_real'];
$filmIMG = thumbimg($row['film_img'],200);
$filmSLUG = $row['film_slug'];
$filmURL = $web_link.'/phim/'.$filmSLUG.'-'.replace($filmID).'/';
$filmQUALITY = $row['film_tapphim'];
$filmSTATUS = str_replace('Hoàn tất','Full',$row['film_trangthai']);
	$filmVIEWED = number_format($row['film_viewed']);
	$filmLANG = film_lang($row['film_lang']);
if($row['film_lb'] == 0){
	    $Status = $filmQUALITY.'-'.$filmLANG;
	}else{
	    $Status = $filmSTATUS.'-'.$filmLANG;
	}
	
?>
  <li class="TPostMv" id="TPostMvBox-<?=$filmID;?>">
                                <article class="TPost C post-<?=$filmID;?> post type-post status-publish format-standard has-post-thumbnail hentry">
                                    <div class="Image">
                                        <a href="<?=$filmURL;?>">
                                            <figure class="Objf TpMvPlay AAIco-play_arrow">
                                                <img width="215" height="320" src="<?=$filmIMG;?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt="<?=$filmNAMEVN;?>" />
                                            </figure>
                                        </a>
                                        <span class="mli-eps">Tập<i>861</i></span> 
                                        <span class="fa-times movie-close-button" id="movie-close-button" data-id="<?=$filmID;?>"></span>
                                    </div>
                                    <h2 class="Title">
                                        <?=$filmNAMEVN;?> 
                                    </h2> <span class="Year"><?=$filmNAMEEN;?></span>
                                    <div class="TPMvCn anmt">
                                        <div class="Title">
                                            <?=$filmNAMEVN;?> 
                                        </div>
                                        <p class="Info"> <span class="Vote AAIco-star">N/A</span> <span class="Time AAIco-access_time">861/?? Tập</span> <span class="Date AAIco-date_range">1999</span> <span class="Qlty">HD</span></p>
                                        <div class="Description">
                                            <p>
                                                Một cậu b&eacute; t&ecirc;n Monkey D. Luffy, được khuyến kh&iacute;ch bởi người anh h&ugrave;ng thuở nhỏ Shanks T&oacute;c đỏ, giong buồm ra khơi tr&ecirc;n chuyến h&agrave;nh tr&igrave;nh t&igrave;m kho b&aacute;u huyền thoại One Piece v&agrave; trở th&agrave;nh ...                                            </p>
                                            <p class="Director AAIco-videocam"><span>Đạo diễn:</span>
                                                Konosuke Uda,Munehisa Sakai <i class="Button STPa AAIco-more_horiz"></i></p>
                                            <p class="Genre AAIco-movie_creation"><span>Thể loại:</span>
                                                <a href="https://animehayhd.com/the-loai/hanh-dong.html" title="Hành Động">Hành Động</a>, <a href="https://animehayhd.com/the-loai/vo-thuat.html" title="Võ Thuật">Võ Thuật</a>, <a href="https://animehayhd.com/the-loai/tinh-cam.html" title="Tình Cảm">Tình Cảm</a>, <a href="https://animehayhd.com/the-loai/hai-huoc.html" title="Hài Hước">Hài Hước</a>, <a href="https://animehayhd.com/the-loai/phieu-luu.html" title="Phiêu Lưu">Phiêu Lưu</a>, <a href="https://animehayhd.com/the-loai/drama.html" title="Drama">Drama</a>, <a href="https://animehayhd.com/the-loai/anime.html" title="Anime">Anime</a>, <a href="https://animehayhd.com/the-loai/sieu-nang-luc.html" title="Siêu Năng Lực">Siêu Năng Lực</a>, <a href="https://animehayhd.com/the-loai/shounen.html" title="Shounen">Shounen</a>, <a href="https://animehayhd.com/the-loai/ac-quy.html" title="Ác Quỷ">Ác Quỷ</a>, <a href="https://animehayhd.com/the-loai/fantasy.html" title="Fantasy">Fantasy</a> </p>
                                            <p class="Actors AAIco-person"><span>Diễn viên:</span>
                                                Monkey D Luffy,Roronoa Zoro,Nami,Usopp,Sanji,Tony Tony Chopper,Nico Robin,Franky,Brook <i class="Button STPa AAIco-more_horiz"></i></p>
                                        </div>
                                    </div>
                                </article>
                            </li>
  <? } ?>

    <span class="page_nav">
							<?=$ViewPage;?>
							</span>
  <? }else{ ?>

<? } ?>     
</ul>                         
                    </section>
                                        <script>
                        jQuery(document).ready(function($) {
                            jQuery('span#movie-close-button').click(function() {
                                var id = $(this).data("id");
                                id = parseInt(id);
                                $.ajax({
                                    method: 'POST',
                                    url: MAIN_URL + "/ajax/remove",
                                    data: {
                                        filmid: id,
                                        type: "fav"
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data == 1) {
                                            $("#TPostMvBox-" + id).remove();
                                        } else {
                                            fx.alertMessage("Xin chào!", 'Có lỗi xảy ra, vui lòng thử lại!', 'error');
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                                    </main>
                <aside class="widget-area" role="complementary">
                    <!--
                    <div class="Dvr-300">
                        <script type="text/javascript">
                          if(!window.BB_a) { BB_a = [];} if(!window.BB_ind) { BB_ind = 0; } if(!window.BB_vrsa) { BB_vrsa = 'v3'; }if(!window.BB_r) { BB_r = Math.floor(Math.random()*1000000000)} BB_ind++; BB_a.push({ "pl" : 43764, "index": BB_ind});
                        </script>
                        <script type="text/javascript">
                          document.write('<scr'+'ipt async data-cfasync="false" id="BB_SLOT_'+BB_r+'_'+BB_ind+'" src="//st.bebi.com/bebi_'+BB_vrsa+'.js"></scr'+'ipt>');
                        </script>
                    </div> -->
                    <!-- Box: Facebook -->
                    <div class="facebook-group" style="margin-bottom:1.25rem;">
                        <div class="fb-page" data-href="https://www.facebook.com/animehayhd" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                            <blockquote cite="https://www.facebook.com/animehayhd" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/animehayhd">Facebook</a></blockquote>
                        </div>
                    </div>
                    <!-- /Box: Facebook -->
                    <!-- Box: Phim chọc lọc -->
                    <section class="Wdgt" id="showChonLoc">
                        <div class="Title">HOT THÁNG</div>
                        <ul class="MovieList">
                            
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/one-piece-dao-hai-tac-<?=$filmID;?>.html"> <span class="Top">#1<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://2.bp.blogspot.com/-GmHU-MeTg8Y/W83HiElDqUI/AAAAAAAABAo/P8E1sJeMZUADwacnLH9Rf3f5adr9k8x5gCLcBGAs/s0/One-Piece.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="<?=$filmNAMEVN;?>"></figure>
            </div>
            <div class="Title">One Piece - Đảo Hải Tặc</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">8</span><span class="Time AAIco-access_time">861/?? Tập</span> <span class="Date AAIco-date_range">1999</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
        
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/kiss-x-sis-34.html"> <span class="Top">#2<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://1.bp.blogspot.com/-KXN3Tw3lmSA/W8rJYXKHd6I/AAAAAAAAAT8/S2qXXcdB2xQbElb-lL57H112l4s1Ve6lgCLcBGAs/s0/kiss-x-sis.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Kiss X Sis - Kiss X Sis"></figure>
            </div>
            <div class="Title">Kiss X Sis</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">8</span><span class="Time AAIco-access_time">12/12 Tập</span> <span class="Date AAIco-date_range">2013</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
        
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/fairy-tail-hoi-phap-su-122.html"> <span class="Top">#3<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://3.bp.blogspot.com/-g8j2dIMbT9k/W825_hzuuBI/AAAAAAAAA-U/nmK1EtbDDA8Dm8zARFdewDqIK8shDsgmACLcBGAs/s0/fairy-tail-2014.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Fairy Tail - Hội Pháp Sư - Fairy Tail"></figure>
            </div>
            <div class="Title">Fairy Tail - Hội Pháp Sư</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">8</span><span class="Time AAIco-access_time">277/277 Tập</span> <span class="Date AAIco-date_range">2014</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
        
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/shinmai-maou-no-testament-193.html"> <span class="Top">#4<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://3.bp.blogspot.com/-bZUUzI4TXi8/W9Z5-bUXz1I/AAAAAAAABiU/oBzFVvgbmAkJgNfs1949XQYC35kp4CKUgCLcBGAs/s0/shinmai-maou-no-keiyakusha.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Shinmai Maou no Testament - Shinmai Maou no Testament"></figure>
            </div>
            <div class="Title">Shinmai Maou no Testament</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">8</span><span class="Time AAIco-access_time">12/12 Tập</span> <span class="Date AAIco-date_range">2015</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
        
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/hunter-x-hunter-124.html"> <span class="Top">#5<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://3.bp.blogspot.com/-yDVVwJHUuWQ/W83CjbgTb5I/AAAAAAAAA_I/HpKSbfbau_sLNFgQRupXjJmx2fBGSn7bACLcBGAs/s0/hunter-x-hunter.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Hunter X Hunter - Hunter X Hunter"></figure>
            </div>
            <div class="Title">Hunter X Hunter</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">7</span><span class="Time AAIco-access_time">148/148 Tập</span> <span class="Date AAIco-date_range">2011</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
                                </ul>
                    </section>
                    <!-- /Box: Phim chọc lọc -->
                    <!-- Box: Phim Lẻ/Bộ week -->
                    <section class="Wdgt" id="showTopPhim">
                        <div class="Title">HOT TUẦN
                            <div class="Top">
                                <a href="https://animehayhd.com/danh-sach/phim-le.html" class="STPb Current" title="Phim lẻ tuần hot" data-tag="phim-le-hot">Phim lẻ</a>
                                <a href="https://animehayhd.com/danh-sach/phim-bo.html" class="STPb" title="Phim bộ tuần hot" data-tag="phim-bo-hot">Phim bộ</a>
                            </div>
                        </div>

                        <ul class="MovieList">
                            
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/shinmai-maou-no-testament-burst-ova-195.html"> <span class="Top">#1<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://1.bp.blogspot.com/-vmfvAslZufQ/W9av2sg1OEI/AAAAAAAABjI/OXK5ySqUOvE9vWbtzSSYxiagm1uGlARigCLcBGAs/s0/Shinmai-Maou-no-Testament-ova-2.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Shinmai Maou no Testament Burst OVA - Shinmai Maou no Testament Burst OVA"></figure>
            </div>
            <div class="Title">Shinmai Maou no Testament Burst OVA</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">8</span><span class="Time AAIco-access_time">24 Phút</span> <span class="Date AAIco-date_range">2016</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
        
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/shinmai-maou-no-testament-ova-196.html"> <span class="Top">#2<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://4.bp.blogspot.com/-pFaJR2WuMBg/W9aw39m_iQI/AAAAAAAABjg/0xnetbLi7tc6Zup-z_2U4ZClsklgeaRfQCLcBGAs/s0/shinmai-maou-no-testament-burst-ova-1.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Shinmai Maou no Testament OVA - Shinmai Maou no Testament OVA"></figure>
            </div>
            <div class="Title">Shinmai Maou no Testament OVA</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">9</span><span class="Time AAIco-access_time">25 Phút</span> <span class="Date AAIco-date_range">2015</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
        
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/high-school-dxd-born-ova-32.html"> <span class="Top">#3<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://4.bp.blogspot.com/-6Qe9x29h7uY/W8m-J6L2TdI/AAAAAAAAASs/SB_vSkQw55QDE7t2rCba2fuTmUaQsFw8QCLcBGAs/s0/high-school-dxd-born-ova-3.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="High School DxD BorN OVA - High School DxD BorN OVA"></figure>
            </div>
            <div class="Title">High School DxD BorN OVA</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">10</span><span class="Time AAIco-access_time">23 Phút</span> <span class="Date AAIco-date_range">2015</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
        
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/high-school-dxd-ova-28.html"> <span class="Top">#4<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://1.bp.blogspot.com/-g-IT7arHdl0/W8m0tBSMX6I/AAAAAAAAARA/jwofl8CUsSojk3endGDbFhuiUhyjPilzgCLcBGAs/s0/high-school-dxd-new-ova.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="High School DxD OVA - High School DxD  OVA"></figure>
            </div>
            <div class="Title">High School DxD OVA</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">10</span><span class="Time AAIco-access_time">2 Ova</span> <span class="Date AAIco-date_range">2015</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
        
        <li>
    <div class="TPost A">
        <a rel="bookmark" href="https://animehayhd.com/phim/high-school-dxd-new-ova-29.html"> <span class="Top">#5<i></i></span>
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="55" height="85" src="https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&refresh=604800&url=https://3.bp.blogspot.com/-eQS0nBbYywM/W8m4tTRHNMI/AAAAAAAAARc/oIInN62XFOcjhs_S6zeWClCcDMjB5QeqwCLcBGAs/s0/high-school-dxd-new-ova-2.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="High School DxD New OVA - High School DxD New OVA"></figure>
            </div>
            <div class="Title">High School DxD New OVA</div>
        </a>
        <p class="Info"> <span class="Vote AAIco-star">7</span><span class="Time AAIco-access_time">OVA</span> <span class="Date AAIco-date_range">2015</span> <span class="Qlty">HD</span></p>
    </div>
        </li>
                                </ul>
                    </section>
                    <!-- /Box: Phim Lẻ/Bộ week -->
                    
                    <!--
                    <div class="Dvr-300">
                        <script type="text/javascript">
                          if(!window.BB_a) { BB_a = [];} if(!window.BB_ind) { BB_ind = 0; } if(!window.BB_vrsa) { BB_vrsa = 'v3'; }if(!window.BB_r) { BB_r = Math.floor(Math.random()*1000000000)} BB_ind++; BB_a.push({ "pl" : 43870, "index": BB_ind});
                        </script>
                        <script type="text/javascript">
                          document.write('<scr'+'ipt async data-cfasync="false" id="BB_SLOT_'+BB_r+'_'+BB_ind+'" src="//st.bebi.com/bebi_'+BB_vrsa+'.js"></scr'+'ipt>');
                        </script>
                    </div> -->
                </aside>
            </div>
        </div>
    </div>
<footer class="Footer">
    <div class="Container">
        <div class="MnBrCn BgA">
            <div class="MnBr EcBgA">
                <div class="Container">
                    <figure class="Logo">
                        <a href="https://animehayhd.com" title="Anime Hay HD | Anime Vietsub | Xem Anime Vietsub HD Online | Hoạt Hình Vietsub | Xem Anime | Xem Anime Vietsub Miễn Phí Siêu Nhanh" rel="home">
                            <img title="Anime Hay HD | Anime Vietsub | Xem Anime Vietsub HD Online | Hoạt Hình Vietsub | Xem Anime | Xem Anime Vietsub Miễn Phí Siêu Nhanh" src="https://animehayhd.com/Theme/images/logo.png" alt="Anime Hay HD | Anime Vietsub | Xem Anime Vietsub HD Online | Hoạt Hình Vietsub | Xem Anime | Xem Anime Vietsub Miễn Phí Siêu Nhanh">
                        </a>
                    </figure>
                    <div class="Rght">
                        <nav class="Menu">
                            <ul>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-490"><a href="https://animehayhd.com">XEM PHIM</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493"><a href="https://animehayhd.com/bai-viet/lien-he.html">LIÊN HỆ</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493"><a href="https://animehayhd.com/bai-viet/yeu-cau-anime.html">YÊU CẦU ANIME</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493"><a href="https://animehayhd.com/bai-viet/dmca.html">DMCA</a></li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493"><a href="https://animehayhd.com/bai-viet/dieu-khoan-su-dung.html">ĐIỀU KHOẢN SỬ DỤNG</a></li>
                            </ul>
                        </nav>
                        <ul class="ListSocial">
                            <li>
                                <a target="_blank" href="https://www.facebook.com/animehayhd" class="fa-facebook"></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com/" class="fa-twitter"></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://google.com/" class="fa-google-plus"></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://youtube.com/" class="fa-youtube-play"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="Up AAIco-arrow_upward" title="Cuộn lên trên"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="WebDescription">
            <a href="https://animehayhd.com/tag/anime.html" rel="nofollow" title="Anime"> Anime</a><a href="https://animehayhd.com/tag/one-piece.html" rel="nofollow" title="One piece"> One piece</a><a href="https://animehayhd.com/tag/gintama.html" rel="nofollow" title="Gintama"> Gintama</a><a href="https://animehayhd.com/tag/naruto.html" rel="nofollow" title="Naruto"> Naruto</a><a href="https://animehayhd.com/tag/boruto.html" rel="nofollow" title="Boruto"> Boruto</a><a href="https://animehayhd.com/tag/hoat-hinh.html" rel="nofollow" title="Hoạt hình"> Hoạt hình</a><a href="https://animehayhd.com/tag/khach-san-huyen-bi.html" rel="nofollow" title="Khách sạn huyền bí"> Khách sạn huyền bí</a><a href="https://animehayhd.com/tag/sao.html" rel="nofollow" title="SAO"> SAO</a><a href="https://animehayhd.com/tag/dao-hai-tac.html" rel="nofollow" title="Đảo hải tặc"> Đảo hải tặc</a><a href="https://animehayhd.com/tag/bomtantv.html" rel="nofollow" title="Bomtantv"> Bomtantv</a><a href="https://animehayhd.com/tag/animehay.html" rel="nofollow" title="Animehay"> Animehay</a><a href="https://animehayhd.com/tag/anime47.html" rel="nofollow" title="Anime47"> Anime47</a><a href="https://animehayhd.com/tag/vuighenet.html" rel="nofollow" title="Vuighe.net"> Vuighe.net</a><a href="https://animehayhd.com/tag/phimmoi.html" rel="nofollow" title="Phimmoi"> Phimmoi</a><a href="https://animehayhd.com/tag/bilutv.html" rel="nofollow" title="Bilutv"> Bilutv</a><a href="https://animehayhd.com/tag/phimbathu.html" rel="nofollow" title="Phimbathu"> Phimbathu</a><a href="https://animehayhd.com/tag/animevsubtv.html" rel="nofollow" title="Animevsub.tv"> Animevsub.tv</a>            <br>
            Anime Hay | Phim Anime | Xem Anime | Anime Vietsub | Anime HD Online | Xem Phim Hoạt Hình Hay Miễn Phí Siêu Nhanh | Xem Anime Hay HD Online | Xem Anime Vietsub HD
        </div>
        <p class="Copy">
            <a target="_blank" href="https://animehayhd.com">Copyright ® 2018 AnimeHayHD. All Rights Reserved. </a> Mọi dữ liệu trên AnimeHayHD đều được tổng hợp từ internet.
        </p>
    </div>
</footer>
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
<!-- Facebook Messenger Chat -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="1795219933846505"
  theme_color="#44bec7"
  logged_in_greeting="Chào! Tụi mình có thể giúp bạn điều gì không ?"
  logged_out_greeting="Chào! Tụi mình có thể giúp bạn điều gì không ?">
</div>

<!-- Global site tag (gtag.js) - Google Analytics 
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-59803062-5"></script> 
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-59803062-5');
</script> -->

<script type='text/javascript'>
    var trsol = {
        "error": "No Results",
        "placeholder": "Click here to search"
    };
</script>
<!--[if lt IE 9]><script type="text/javascript" src="https://animehayhd.com/Theme/js/ie/css3mq.js"></script><![endif]-->
<!--[if lte IE 9]><script type="text/javascript" src="https://animehayhd.com/Theme/js/ie/ie.js"></script><![endif]-->
<!--[Fox]><CSS Framework v5.0><[Fox]-->
<script type="text/javascript" src="https://animehayhd.com/Theme/js/film.notiny.js"></script>
    
</div>
</body>

</html>
<?}else header('Location: '.$web_link);  }else header('Location: '.$web_link.'/404');  ?>