<?php 
session_start();
if($value[1]=='home-user'){
    $isLogin = checkLogin();
    if($isLogin){
if(isset($_SESSION["user_id"])){
    $q = $mysql->query("SELECT user_name,user_fullname,user_avatar,user_email,user_gioitinh,user_time FROM ".$tb_prefix."user WHERE user_id = '".$_SESSION['user_id']."'");
    $row = $q->fetch(PDO::FETCH_ASSOC);
    $UserID = (int)$_SESSION["user_id"];
    $UserNAME = $_SESSION["user_name"];
    $UserEMAIL = $row["user_email"];
    $username = $row['user_name'];
    $userFULLNAME = $row['user_fullname'];

    $userAVATAR = ($row['user_avatar']?$row['user_avatar']:"http://dangthuyduong.ga/Theme/img/cast-image.png");
    $userGIOITINH = $row['user_gioitinh'];
    $userTIME = date('d/m/Y',$row['user_time']);
    $web_title = 'Thông tin '.$UserNAME.'';

    }if(isset($_POST['submit'])){
        $user  = '';
        $password       = trim(htmlchars(stripslashes(urldecode(injection($_POST['user_password'])))));
        $fullname       = trim(htmlchars(stripslashes(urldecode(injection($_POST['user_fullname'])))));
        $user_avatar    = trim(htmlchars(stripslashes(urldecode(injection($_POST['user_avatar'])))));
        $user_gioitinh  = trim(htmlchars(stripslashes(urldecode(injection($_POST['user_gioitinh'])))));

        $user_img = trim(htmlchars(stripslashes(urldecode(injection($_POST['user_gioitinh'])))));


        if ($fullname || $user_avatar || $user_gioitinh){
         $mysql->query("UPDATE ".DATABASE_FX."user SET user_fullname = '".$fullname."',user_avatar = '".$user_avatar."',user_gioitinh = '".$user_gioitinh."'  WHERE user_id = '".$_SESSION['user_id']."'");  
         header("Location: ./"); 

        }if($password){
         $password = md5($password);
         $mysql->query("UPDATE ".DATABASE_FX."user SET user_password = '".$password."' WHERE user_id = '".$_SESSION['user_id']."'");   

        }else header("Location: ./");

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
    <link rel="stylesheet" href="<?=$web_link;?>/<?=$SkinLink;?>/css/login.css" type="text/css" />

        
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
   
  <div class="Body Container">
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
<div class="col-md-3" style="margin-bottom:20px;">
<div class="profile-sidebar">
<div class="profile-userpic">
<img src="<?=$userAVATAR;?>" class="img-responsive" alt="">
</div>
<div class="profile-usertitle">
<div class="profile-usertitle-name"><?=$username;?> </div>
<div class="profile-usertitle-vip">
<p>Tham gia: <?=$userTIME;?></p>
</div>
</div>
</div>
</div>
<div class="col-md-9" style="margin-bottom:20px;">
<div class="col-xs-12 col-md-12 pdr0">
<div class="tab-login update-info" id="tab-login">
<div class="title"> THÔNG TIN TÀI KHOẢN</div>
<div class="bor-form">
<form name="SignInForm" id="SignInForm" method="post" class="form-login form-horizontal" enctype="multipart/form-data" action="/account/info/">
<div class="form-group">
<label class="control-label col-sm-3" for="email">Email</label>
<div class="col-sm-9">
<input name="user_email" type="email" id="user_email" value="<?=$UserEMAIL;?>" class="form-control lg-email" placeholder="Email đăng nhập" disabled>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="username">Tài khoản</label>
<div class="col-sm-9">
<input name="user_name" type="text" id="user_name" value="<?=$username;?>" class="form-control lg-name" placeholder="Tài khoản / Username" disabled>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="hoten">Họ tên</label>
<div class="col-sm-9">
<input name="user_fullname" type="text" id="user_fullname" value="<?=$userFULLNAME;?>" class="form-control lg-name" placeholder="Họ và tên">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="gender">Giới tính</label>
<div class="col-sm-9 gender">


<input id="male" name="user_gioitinh" type="radio" value="1" <? if($userGIOITINH == 1) echo "checked"; ?>>
<label for="male" class="label-radio">Nam</label>
<input id="female" name="user_gioitinh" type="radio" value="2" <? if($userGIOITINH == 2) echo "checked"; ?>>
<label for="female" class="label-radio">Nữ</label>

<input id="pede" name="user_gioitinh" type="radio" value="3" <? if($userGIOITINH == 3) echo "checked"; ?>>
<label for="pede" class="label-radio">Không xác định</label>


</div>
</div>
<div class="form-group">
 <label class="control-label col-sm-3" for="email">Mật khẩu</label>
<div class="col-sm-9">
<input name="user_password" type="password" id="user_password" value="" class="form-control lg-pass" placeholder="Để trống nếu không muốn đổi">
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-3" for="email">Avatar</label>
<div class="col-sm-9">
<input name="user_avatar" type="text" id="user_avatar" value="<?=$userAVATAR;?>" class="form-control lg-name" placeholder="Họ và tên">
</div>
</div>
<div class="form-group" style="padding-top: 6px;">
<label class="control-label col-sm-3"></label>
<div class="col-sm-9">
<input type="submit" name="submit" class="btn btn-main" value="Cập nhật">
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
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
                    </aside>    </div>
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
<div class="top-message"></div>

</body>
</html>
<?}else header('Location: '.$web_link);  }else header('Location: '.$web_link.'/404');  ?>
