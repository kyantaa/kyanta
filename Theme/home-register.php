<?php 
if($value[1]=='home-register'){
	$isLogin = checkLogin();
	if(!$isLogin){     
		$web_keywords = 'xem phim Phim Lẻ full hd, phim Phim Lẻ online, phim Phim Lẻ vietsub, phim Phim Lẻ thuyet minh, phim  long tieng, phim Phim Lẻ tap cuoi';
	    $web_des = 'Phim Lẻ hay tuyển tập, Phim Lẻ mới nhất, tổng hợp phim Lẻ, Phim Lẻ full HD, Phim Lẻ vietsub, xem Phim Lẻ online';
	    $web_title = ''.$language['signup'].' | Phim Lẻ hay | Tuyển tập Phim Lẻ mới nhất 2015';
		$breadcrumbs = '';
		$breadcrumbs .= '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
	    $breadcrumbs .= '<li><a class="current" href="'.$web_link.'/account/register" title="'.$language['signup'].'">'.$language['signup'].'</a></li>';
	    $h1title = '<i class="icon-note font-purple-seance"></i> '.$language['signup'].'';
		if(isset($_POST['submit'])){
	    $username		=	htmlchars(stripslashes(trim(urldecode(injection($_POST['username'])))));
		$password		=	htmlchars(stripslashes(trim(urldecode(injection($_POST['password'])))));
		$repassword		=	htmlchars(stripslashes(trim(urldecode(injection($_POST['repassword'])))));
		$email			=	htmlchars(stripslashes(trim(urldecode(injection($_POST['email'])))));
		$check_user 			= get_data('user_id','user','user_name',$username);
        $check_email 			= get_data('user_id','user','user_email',$email);
		if($_POST['captcha'] != $_SESSION['captcha']) {
			$error = '* '.$language['wrong_verification'];
			$display = "display:block;";
		}
		elseif($check_user) {
			$error = '* '.$language['wrong_user'];
			$display = "display:block;";
		}
		elseif($check_email) {
			$error = '* '.$language['wrong_email'];
			$display = "display:block;";
		}elseif($password != $repassword){
			$error = '* '.$language['wrong_pass'];
			$display = "display:block;";
		}elseif(validateEmail($email) == 0){
			$error = '* '.$language['wrong_email1'];
			$display = "display:block;";
		}elseif(strlen($username) < 6){
		    $error = '* '.$language['wrong_user1'];
			$display = "display:block;";
		}elseif(strlen($password) < 6){
		    $error = '* '.$language['wrong_pass1'];
			$display = "display:block;";
		}else {
			$password	=	md5($password);
			$regdate	=	NOW;
            $mysql->query("INSERT INTO ".DATABASE_FX."user (user_name,user_password,user_email,user_time) VALUES ('".$username."','".$password."','".$email."','".NOW."')");
		
			header("Location: ".$web_link."/account/login");
		}
	    $error = '<div> <div role="alert" class="alert alert-warning alert-dismissible fade in"> <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> '.$error.' </div> </div> ';
	}else{
	    $error = '';
	    $display = "display:none;";
	}
?>

<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xmlns="https://www.w3.org/1999/html" xml:lang="vi" lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="Đăng ký tài khoản" />
    <title>Đăng ký tài khoản</title>
    <meta property="og:title" content="Đăng ký tài khoản" />
    <meta name="description" content="Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime hay HOT luôn được cập nhật sớm nhất Việt Nam, xem anime hay nhất, hãy cùng khám phá kho tàng về hoạt hình nhật bản nhé." />
    <meta name="keywords" content="anime vietsub, xem anime, vui ghe, naruto, vua hai tac, one piece, hoi phap su, fairy tail, bleach, dragon ball, dao hai tac, boruto, animevsub, anime hay, animehay, animehayhd, anime47, hoat hinh trung quoc, anime vietsub hd, anime moi nhat, anime hay nhat" />
    <link rel="alternate" href="" hreflang="vi-vn" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <!-- Facebook Metadata /-->
    <meta property="og:type" content="video.movie" />
    <meta property="og:description" content="Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime hay HOT luôn được cập nhật sớm nhất Việt Nam, xem anime hay nhất, hãy cùng khám phá kho tàng về hoạt hình nhật bản nhé." />
    <meta property="og:url" content="http://thuyduong.ga/tai-khoan/phim-dang-theo-doi.html" />
    

        
    
    <meta property="og:site_name" content="Animehayhd.com" />
    <meta property="og:locale" content="vi_VN" />
   <meta property="fb:admins" content="100027613295889,100007834096944" />
   <meta property="fb:pages" content="915402125310968" />
   <meta property="fb:app_id" content="262760374306229" />
    
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
    <link rel="shortcut icon" href="http://thuyduong.ga/favicon.ico" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- stylesheet -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/style.css?v=1.45" />
        <link rel="stylesheet" type="text/css" href="<?=$web_link;?>/<?=$SkinLink;?>/css/login.css" />
        
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

    <script type="text/javascript" src="<?=$web_link;?>/<?=$SkinLink;?>/js/login.js"></script>
    <script type="text/javascript">var PreUrl = "http://thuyduong.ga";</script>
        
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "http://thuyduong.ga",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "http://thuyduong.ga/tim-kiem/{search_term_string}.html",
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


            <div class="TpRwCont">
<main>
    <section id="log-reg">
        <div class="row">
            <div class="col-xs-12 col-md-12 pdr0">
                                                <div class="tab-login" id="tab-register">
                    <div class="title"> ĐĂNG KÝ!</div>
                    <div class="lg-mxh">
<div class="face col-md-6">
<a href="<?=$web_link;?>/login/facebook/rel=<?=$web_link;?>/"><span class="fa fa-facebook"></span> Đăng nhập bằng Facebook</a></div>
<div class="gg col-md-6 pdr0"><a href="<?=$web_link;?>/login/google?_fxRef=<?=$web_link;?>/">Đăng nhập bằng Google +</a></div>
</div>                                    <div class="bor-form">                        <form id="register-form" action="javascript:CheckReg();" method="post" class="form-login">
                            <p class="sug">Hoặc:</p> 
                            <div class="form-group">
                                <input type="email" id="email" value="" class="form-control lg-email" placeholder="Email ">
                            </div>
                            <div class="form-group">
                                <input type="text" id="username" value="" class="form-control lg-name" placeholder="Tên tài khoản">
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" value="" class="form-control lg-pass" placeholder="Mật khẩu ">
                            </div>
                            <div class="form-group">
                                <input type="password" id="confirm_password" value="" class="form-control lg-pass" placeholder="Nhập lại Mật khẩu">
                            </div>
                            <div class="form-group">
                                <input id="register-verifycode" style="color: black" maxlength="5" placeholder="Mã bảo vệ" class="form-control" type="text" value="">
                                <div class="capcha">
                                    <div class="code" id="captchaImageWrapper">
                                        <img style="height: 44px;" src="<?=$web_link;?>/captcha/rand/<?=rand(1000,9999);?>.png" height="50" alt="Captcha" id="verify-image"></div>

                                </div>
                                <div class="checkbox">
                                    <div class="col-md-6 pdl0">
                                        <label><input id="remember" value="1" type="checkbox" checked>  Lưu mật khẩu </label>
                                    </div>
                                    <div class="col-md-6 pdr0">
                                        <button type="submit" name="submit">Đăng ký</button>
                                    </div>
                                </div>
                        </form>
                        <div>Đã có tài khoản? <a class="btn-register" href="<?=$web_link;?>/thanh-vien/login/">Đăng nhập</a> ngay!</div>

                        </div>
                    </div>
                                                    </div>
            </div>

    </section>

</main>
                <?php
if (is_mobile()) {
global $web_link;
$data = '';
}else{
$data = '<aside class="widget-area" role="complementary">                  
                        <section class="Wdgt" id="showChonLoc">
                            <div class="Title">ANIME MỚI CẬP NHẬT</div>
                            <ul class="MovieList Newepisode"> 

                             '.ShowFilm("WHERE film_lb IN (0,1,2)","ORDER BY film_time_update",10,"showfilm_phimmoi","cache_phimmoi").'
                             <li><a href="'.$web_link.'/danh-sach/anime-moi.html">Xem thêm..</a></li>
                            </ul>
                        </section>
                        <section class="Wdgt" id="showTopPhim">
                            <div class="Title">XEM NHIỀU NHẤT
                                <div class="Top">
                          <a href="'.$web_link.'/bang-xep-hang/day.html" class="STPb Current" title="Bảng xếp hạng ngày" data-tag="day">Ngày</a>
                           <a href="'.$web_link.'/bang-xep-hang/week.html" class="STPb" title="Bảng xếp hạng tuần" data-tag="week">Tuần</a>
                            <a href="'.$web_link.'/bang-xep-hang/week.html" class="STPb" title="Bảng xếp hạng tháng" data-tag="month">Tháng</a> 
                            <a href="'.$web_link.'/bang-xep-hang/week.html" class="STPb" title="Bảng xếp hạng năm" data-tag="year">Năm</a>

                                </div>
                            </div>                           
                            <ul class="MovieList">                          
                '.ShowFilm("WHERE film_viewed_day > 0 AND film_cat NOT LIKE \"%16%\"","ORDER BY film_viewed_day",5,"bxh_day","phimbo_hotw").'
                             </ul>
                        </section>
                    </aside>  ';
                    }
              echo $data;
                ?>
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
<? }else header('Location: '.$web_link.'/account/info'); }else header('Location: '.$web_link.'/404'); ?>