 <!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xmlns="https://www.w3.org/1999/html" xml:lang="vi" lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="<?=$web_title;?>" />
    <title><?=$web_title;?></title>
    <meta property="og:title" content="<?=$web_title;?>" />
    <meta name="description" content="<?=$web_title;?>" />
    <meta name="keywords" content="<?=$web_keywords;?>" />
    <link rel="alternate" href="<?=$web_link;?>" hreflang="vi-vn" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta property="og:type" content="video.movie" />
    <meta property="og:description" content="<?=$web_title;?>" />
    <meta property="og:url" content="<?=$web_link;?>" />
    <link href="<?=$web_link;?>" rel="canonical">    
    <meta property="og:image" content="<?=$web_link;?>/favicon.ico">
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
        </header><div class="Body Container">
    <div class="Content">
        <div class="announcement">
            <span class="ann_title"><i class="fa-bullhorn"></i></span>
            <span class="ann_text">
                <div align="center"><?=strip_tags(text_tidy1($announcement),'<a><b><i><u><br>');?></div>
            </span>
        </div>
        <div class="MovieListTopCn">
            <div class="MovieListTop owl-carousel">
               <?=ShowFilm('WHERE film_hot = 1','ORDER BY film_time_update',20,'showfilm_phimhot_home','cache_phimhot');?>
                  </div>
             </div>
        <div class="TpRwCont">
            <main>
       <div class="MovieListSldCn">
                    <div class="MovieListSld owl-carousel">
                           <?=ShowFilm('WHERE film_lb IN (1,2)','ORDER BY film_time_update',12,'showfilm_phimbo_home','cache_phimbonew_home');?>         
                     </div>
                </div>
                                <section id="new-home"> 
                   <div class="Top">
                        <h1>Anime mới cập nhật<i class="fa fa-angle-right"></i></h1>
                        <a href="<?=$web_link;?>/danh-sach/phim-moi.html" class="STPb Current" data-tag="phim-moi" title="Tất cả Anime mới">Tất cả</a>
                        <a href="<?=$web_link;?>/the-loai/hanh-dong.html" class="STPb" data-tag="hanh-dong" title="Phim Anime lẻ">Hành Động</a>
                        <a href="<?=$web_link;?>/the-loai/hoc-duong.html" class="STPb" data-tag="hoc-duong"title="Phim Anime bộ">Học Đường</a>
                        <a href="<?=$web_link;?>/the-loai/ecchi.html" class="STPb" data-tag="ecchi" title="Phim Anime Ecchi">Ecchi</a>
                        <a href="<?=$web_link;?>/the-loai/drama.html" class="STPb" data-tag="drama" title="Phim Anime Ecchi">Drama</a>
                     </div>
                     <ul class="MovieList Rows AX A06 B04 C03 E20">
                                        <?=ShowFilm('WHERE film_lb IN (0,1,2)','ORDER BY film_time_update',15,'showfilm_template','cache_phimall');?>
                                          </ul>

                    <a href="<?=$web_link;?>/danh-sach/phim-moi.html" class="viewall">Xem thêm.. <i class="ion-ios-arrow-right"></i></a>
                </section>
                <section id="hot-home">
                    <div class="Top">
                        <h1>Moive & Ova <i class="fa fa-angle-right"></i></h1> 
                        <a href="#hot-featured" class="STPb Current" data-tag="phim-le">Tất cả</a> 
                        <a href="#hot-viewed-today" class="STPb" data-tag="live-action" title="Anime xem nhiều hôm nay">Live Action</a>
                    </div>
                    <ul class="MovieList Rows AX A06 B04 C03 E20">
                      <?=ShowFilm('WHERE film_lb = 0','ORDER BY film_time_update',12,'showfilm_template','cache_phimle');?>       </ul>
                       <a href="<?=$web_link;?>/danh-sach/phim-le.html" class="viewall">Xem thêm.. <i class="ion-ios-arrow-right"></i></a>
                </section>

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
 <? require_once("footer.php");?>
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