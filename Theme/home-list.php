<?php 
if($value[1]=='home-list'){
if (in_array($value[2], array('the-loai','quoc-gia','danh-sach','tag','tim-kiem','trailer','dien-vien'))) {
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
    if ($value[2]=='tim-kiem') {
	
		$kw = strip_tags(urldecode(trim($value[3])));
		$kw = htmlchars(stripslashes(str_replace('+',' ',$kw)));
	    $keyword = htmlchars(stripslashes(urldecode(injection($kw))));
		$keyacsii = strtolower(get_ascii($keyword));
		$kws = str_replace(' ','-',$keyacsii);
		
		if(search_stop_query($keyacsii) == true || dvd_is_stop_query($keyword)){
		$where_sql = "WHERE (film_name_ascii LIKE \"%".$keyacsii."%\" OR film_name LIKE \"%".$keyword."%\" OR film_name_real LIKE \"%".$keyword."%\" OR film_tag LIKE \"%".$keyword."%\" OR film_tag_ascii LIKE \"%".$keyacsii."%\") AND film_publish = 0";
		}else{
		$where_sql = "WHERE (MATCH (film_name,film_name_real,film_name_ascii,film_tag,film_tag_ascii) AGAINST ('".text_preg_replace_search($keyacsii.' '.$keyword)."' IN BOOLEAN MODE)) AND film_publish = 0";
		$order_sql = "ORDER BY film_name LIKE \"%".$keyword."%\" OR film_name_real LIKE \"%".$keyword."%\" DESC";
		}
		
		$web_keywords = 'xem phim '.$keyword.' full hd, phim '.$keyword.' online, phim '.$keyword.' vietsub, phim '.$keyword.' thuyet minh, phim  long tieng, phim '.$keyword.' tap cuoi';
	    $web_des = 'Phim '.$keyword.' hay tuyển tập, phim '.$keyword.' mới nhất, tổng hợp phim '.$keyword.', '.$keyword.' full HD, '.$keyword.' vietsub, xem '.$keyword.' online';
	    $web_title = $keyword.' | Phim '.$keyword.' hay | Tuyển tập '.$keyword.' mới nhất 2015';
		$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		$breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="#" title="'.$language['search'].'"><span itemprop="title">'.$language['search'].' <i class="fa fa-angle-right"></i></span></a></li>';
	    $breadcrumbs .= '<li><a class="current" href="#" title="Tìm kiếm phim '.$keyword.'">'.ucfirst($keyword).'</a></li>';
	    $h1title = '<i class="icon-magnifier font-purple-seance"></i>'.$language['search_result'].': '.$keyword;
		$pageURL = $web_link.'/tim-kiem/'.replacesearch($value[3]).'';
		$name = $keyword;
	}elseif($value[2]=='tag'){
	    $kw = strip_tags(urldecode(trim($value[3])));
		$kw = htmlchars(stripslashes(str_replace('-',' ',$kw)));
	    $keyword = htmlchars(stripslashes(urldecode(injection($kw))));
		$keyacsii = strtolower(get_ascii($keyword));
		$kws = str_replace(' ','-',$keyacsii);
		
		$where_sql = "WHERE (film_name_ascii LIKE \"%".$keyacsii."%\" OR film_name LIKE \"%".$keyword."%\" OR film_name_real LIKE \"%".$keyword."%\" OR film_tag LIKE \"%".$keyword."%\" OR film_tag_ascii LIKE \"%".$keyacsii."%\") AND film_publish = 0";
		
		$web_keywords = 'xem phim '.$keyword.' full hd, phim '.$keyword.' online, phim '.$keyword.' vietsub, phim '.$keyword.' thuyet minh, phim  long tieng, phim '.$keyword.' tap cuoi';
	    $web_des = 'Phim '.$keyword.' hay tuyển tập, phim '.$keyword.' mới nhất, tổng hợp phim '.$keyword.', '.$keyword.' full HD, '.$keyword.' vietsub, xem '.$keyword.' online';
	    $web_title = $keyword.' | Phim '.$keyword.' hay | Tuyển tập '.$keyword.' mới nhất 2015';
		$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		$breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="#" title="'.$language['tags'].'"><span itemprop="title">'.$language['tags'].' <i class="fa fa-angle-right"></i></span></a></li>';
	    $breadcrumbs .= '<li><a class="current" href="#" title="Từ khóa phim '.$keyword.'">'.ucfirst($keyword).'</a></li>';
	    $h1title = '<i class="icon-tag font-purple-seance"></i>'.$language['tags_result'].': '.$keyword;
		$pageURL = $web_link.'/tag/'.replacetag($value[3]).'';
		$name = $keyword;
	}elseif($value[2]=='dien-vien'){
	    $kw = strip_tags(urldecode(trim($value[3])));
		$kw = htmlchars(stripslashes(str_replace('-',' ',$kw)));
	    $keyword = htmlchars(stripslashes(urldecode(injection($kw))));
		$keyacsii = strtolower(get_ascii($keyword));
		$kws = str_replace(' ','-',$keyacsii);
		
		$where_sql = "WHERE (film_actor LIKE \"%".$keyword."%\" OR film_actor_ascii LIKE \"%".$keyacsii."%\") AND film_publish = 0";
		
		$web_keywords = 'trailer phim, xem phim của '.$keyword.' full hd, phim của '.$keyword.' online, phim của '.$keyword.' vietsub, phim của '.$keyword.' thuyet minh, phim  long tieng, phim của '.$keyword.' tap cuoi';
	    $web_des = 'Phim '.$keyword.' hay nhất 2015';
	    $web_title = 'Phim '.$keyword.' hay nhất 2015';
		$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		
	   $breadcrumbs .= '<li><a itemprop="url" href="#" title="Diễn viên"><span itemprop="title">Diễn viên <i class="fa fa-angle-right"></i></span></a></li>';
	    $breadcrumbs .= '<li><a class="current" href="#" title="'.upperFirstChar($keyword).'">'.upperFirstChar($keyword).'</a></li>';
	    $h1title = '<i class="icon-tag font-purple-seance"></i>Phim '.$keyword.': '.$keyword;
		$pageURL = $web_link.'/dien-vien/'.$value[3].'/';
		$name = $keyword;
	}elseif($value[2]=='trailer'){
	    
		$where_sql = "WHERE film_trailer <> '' AND film_publish = 0 AND film_lb = 3";
		
		$web_keywords = 'trailer phim, xem phim '.$keyword.' full hd, phim '.$keyword.' online, phim '.$keyword.' vietsub, phim '.$keyword.' thuyet minh, phim  long tieng, phim '.$keyword.' tap cuoi';
	    $web_des = 'Trailer phim mới - Trailer phim hay 2015, Trailer phim mới | Trailer phim hay sắp chiếu | Trailer phim bom tấn 2015';
	    $web_title = 'Trailer phim mới | Trailer phim hay sắp chiếu | Trailer phim bom tấn 2015';
		$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		
	    $breadcrumbs .= '<li><a class="current" href="#" title="Trailers phim sắp chiếu">Trailers phim mới</a></li>';
	    $h1title = '<i class="icon-tag font-purple-seance"></i>'.$language['tags_result'].': '.$keyword;
		$pageURL = $web_link.'/trailer';
		$name = $keyword;
	}elseif($value[2]=='danh-sach'){
	    $ipid = explode('/',URL_LOAD);
		if(count($ipid) == 3){
		    $Key1 = sql_escape($ipid[1]);
			$Year = explode('phim-',$Key1);
			$Year = (int)$Year[1];
            if($Key1 == 'phim-le'){
			    $where_sql = "WHERE film_lb = 0";
				$h1title = $language['moviesingle'];
				
			}elseif($Key1 == 'phim-bo'){
			    $where_sql = "WHERE film_lb IN (1,2)";
				$h1title = $language['movieserial'];
			}elseif($Key1 == 'phim-chieu-rap'){
			    $where_sql = "WHERE film_chieurap = 1";
				$h1title = $language['movietheaters'];
			}elseif($Key1 == 'phim-hot'){
			    $where_sql = "WHERE film_hot = 1";
				$h1title = $language['movieshot'];
			}elseif($Key1 == 'phim-moi'){
			    $where_sql = "WHERE film_publish = 0";
				$h1title = $language['movienew'];
			}elseif($Key1 == 'phim-18'){
			    $where_sql = "WHERE film_phim18 = 1";
				$h1title = $language['movie18'];
			}elseif(is_numeric($Year)){
			    $where_sql = "WHERE film_year = ".$Year;
				$h1title = 'Phim năm '.$Year;
				$YearKey = $Year;
			}else header('Location: '.$web_link.'/404');
			$TypeKey = $Key1;
			$keyword = $h1title;
			$web_keywords = 'xem phim '.$keyword.' full hd, phim '.$keyword.' online, phim '.$keyword.' vietsub, phim '.$keyword.' thuyet minh, phim  long tieng, phim '.$keyword.' tap cuoi';
	        $web_des = 'Phim '.$keyword.' hay tuyển tập, phim '.$keyword.' mới nhất, tổng hợp phim '.$keyword.', '.$keyword.' full HD, '.$keyword.' vietsub, xem '.$keyword.' online';
	        $web_title = $keyword.' | '.$keyword.' hay | Tuyển tập '.$keyword.' mới nhất 2015';
            $breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
            $breadcrumbs .= '<li><a class="current" href="'.$web_link.'/'.$Key1.'/" title="'.$h1title.'">'.$h1title.'</a></li>';			
		    $pageURL = $web_link.'/'.$Key1;
			$name = $Key1;
		}elseif(count($ipid) == 4){
		    $Key1 = sql_escape($ipid[1]);
		    $Key2 = sql_escape($ipid[2]);
		    
			$Year = explode('phim-',$Key1);
			$Year = (int)$Year[1];
			// Check $Key1
            if($Key1 == 'phim-le'){
			    $where_sql1 = "WHERE film_lb = 0";
				$h1title1 = $language['moviesingle'];
			}elseif($Key1 == 'phim-bo'){
			    $where_sql1 = "WHERE film_lb IN (1,2)";
				$h1title1 = $language['movieserial'];
			}elseif($Key1 == 'phim-chieu-rap'){
			    $where_sql1 = "WHERE film_chieurap = 1";
				$h1title1 = $language['movietheaters'];
			}elseif($Key1 == 'phim-hot'){
			    $where_sql1 = "WHERE film_hot = 1";
				$h1title1 = $language['movieshot'];
			}elseif($Key1 == 'phim-18'){
			    $where_sql1 = "WHERE film_phim18 = 1";
				$h1title1 = $language['movie18'];
			}elseif($Key1 == 'phim-moi'){
			    $where_sql1 = "WHERE film_publish = 0";
				$h1title1 = $language['movienew'];
			}elseif(is_numeric($Year)){
			    $where_sql1 = "WHERE film_year = ".$Year;
				$h1title1 = 'Phim năm '.$Year;
				$YearKey = $Year;
			}else header('Location: '.$web_link.'/404');
			$TypeKey = $Key1;
			// Check $Key2
			$CatID = get_data('cat_id','cat','cat_name_key',$Key2);
			$CountryID = get_data('country_id','country','country_name_key',$Key2);
			if($CatID){
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$Key2);
			    $where_sql2 = " AND film_cat LIKE '%,".$CatID.",%'";
				$h1title2 = $CatNAME;
				$CatKey = $Key2;
				
			}elseif($CountryID){
			    $CountryNAME = get_data('country_name','country','country_name_key',$Key2);
			    $where_sql2 = " AND film_country LIKE '%,".$CountryID.",%'";
				$h1title2 = $CountryNAME;
				$CountryKey = $Key2;
			}elseif(is_numeric($Key2)){
			    $where_sql2 = " AND film_year = ".$Key2;
				$h1title2 = 'Năm '.$Key2;
				$YearKey = $Key2;
			}else header('Location: '.$web_link.'/404');
			$h1title = $h1title1.' '.$h1title2;
			$where_sql = $where_sql1.$where_sql2;
			$keyword = $h1title;
			$web_keywords = 'xem phim '.$keyword.' full hd, phim '.$keyword.' online, phim '.$keyword.' vietsub, phim '.$keyword.' thuyet minh, phim  long tieng, phim '.$keyword.' tap cuoi';
	        $web_des = 'Phim '.$keyword.' hay tuyển tập, phim '.$keyword.' mới nhất, tổng hợp phim '.$keyword.', '.$keyword.' full HD, '.$keyword.' vietsub, xem '.$keyword.' online';
	        $web_title = $keyword.' | '.$keyword.' hay | Tuyển tập '.$keyword.' mới nhất 2015';
            $breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
            $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$web_link.'/'.$Key1.'/" title="'.$h1title1.'"><span itemprop="title">'.$h1title1.' <i class="fa fa-angle-right"></i></span></a></li>';
			$breadcrumbs .= '<li><a class="current" href="'.$web_link.'/'.$Key2.'/" title="Phim '.$h1title2.'">'.$h1title2.'</a></li>';			
		    $pageURL = $web_link.'/'.$Key1.'/'.$Key2;
			$name = $Key1.'|'.$Key2;
		}elseif(count($ipid) == 5){
		    $Key1 = sql_escape($ipid[1]);
		    $Key2 = sql_escape($ipid[2]);
		    $Key3 = sql_escape($ipid[3]);

			$Year = explode('phim-',$Key1);
			$Year = (int)$Year[1];
			// Check $Key1
            if($Key1 == 'phim-le'){
			    $where_sql1 = "WHERE film_lb = 0";
				$h1title1 = $language['moviesingle'];
			}elseif($Key1 == 'phim-bo'){
			    $where_sql1 = "WHERE film_lb IN (1,2)";
				$h1title1 = $language['movieserial'];
			}elseif($Key1 == 'phim-chieu-rap'){
			    $where_sql1 = "WHERE film_chieurap = 1";
				$h1title1 = $language['movietheaters'];
			}elseif($Key1 == 'phim-hot'){
			    $where_sql1 = "WHERE film_hot = 1";
				$h1title1 = $language['movieshot'];
			}elseif($Key1 == 'phim-18'){
			    $where_sql1 = "WHERE film_phim18 = 1";
				$h1title1 = $language['movie18'];
			}elseif($Key1 == 'phim-moi'){
			    $where_sql1 = "WHERE film_publish = 0";
				$h1title1 = $language['movienew'];
			}elseif(is_numeric($Year)){
			    $where_sql1 = "WHERE film_year = ".$Year;
				$h1title1 = 'Phim năm '.$Year;
				$YearKey = $Year;
			}else header('Location: '.$web_link.'/404');
			$TypeKey = $Key1;
			// Check $Key2
			$CatID = get_data('cat_id','cat','cat_name_key',$Key2);
			$CountryID = get_data('country_id','country','country_name_key',$Key2);
			if($CatID){
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$Key2);
			    $where_sql2 = " AND film_cat LIKE '%,".$CatID.",%'";
				$h1title2 = $CatNAME;
				$Key2URL = $web_link.'/the-loai/'.$Key2.'/';
				$CatKey = $Key2;
			}elseif($CountryID){
			    $CountryNAME = get_data('country_name','country','country_name_key',$Key2);
			    $where_sql2 = " AND film_country LIKE '%,".$CountryID.",%'";
				$h1title2 = $CountryNAME;
				$Key2URL = $web_link.'/quoc-gia/'.$Key2.'/';
				$CountryKey = $Key2;
			}elseif(is_numeric($Key2)){
			    $where_sql2 = " AND film_year = ".$Key2;
				$h1title2 = 'Năm '.$Key2;
				$Key2URL = $web_link.'/phim-'.$Key2.'/';
				$YearKey = $Key2;
			}else header('Location: '.$web_link.'/404');
			// Check $Key3
			$CatID = get_data('cat_id','cat','cat_name_key',$Key3);
			$CountryID = get_data('country_id','country','country_name_key',$Key3);
			if($CatID){
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$Key3);
			    $where_sql3 = " AND film_cat LIKE '%,".$CatID.",%'";
				$h1title3 = $CatNAME;
				$Key3URL = $web_link.'/the-loai/'.$Key3.'/';
				$CatKey = $Key3;
			}elseif($CountryID){
			    $CountryNAME = get_data('country_name','country','country_name_key',$Key3);
			    $where_sql3 = " AND film_country LIKE '%,".$CountryID.",%'";
				$h1title3 = $CountryNAME;
				$Key3URL = $web_link.'/quoc-gia/'.$Key3.'/';
				$CountryKey = $Key3;
			}elseif(is_numeric($Key3)){
			    $where_sql3 = " AND film_year = ".$Key3;
				$h1title3 = 'Năm '.$Key3;
				$Key3URL = $web_link.'/phim-'.$Key3.'/';
				$YearKey = $Key3;
			}else header('Location: '.$web_link.'/404');
			$h1title = $h1title1.' '.$h1title2.' '.$h1title3;
			$where_sql = $where_sql1.$where_sql2.$where_sql3;
			$keyword = $h1title;
			$web_keywords = 'xem phim '.$keyword.' full hd, phim '.$keyword.' online, phim '.$keyword.' vietsub, phim '.$keyword.' thuyet minh, phim  long tieng, phim '.$keyword.' tap cuoi';
	        $web_des = 'Phim '.$keyword.' hay tuyển tập, phim '.$keyword.' mới nhất, tổng hợp phim '.$keyword.', '.$keyword.' full HD, '.$keyword.' vietsub, xem '.$keyword.' online';
	        $web_title = $keyword.' | '.$keyword.' hay | Tuyển tập '.$keyword.' mới nhất 2015';
            $breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
            $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$web_link.'/'.$Key1.'/" title="'.$h1title1.'"><span itemprop="title">'.$h1title1.' <i class="fa fa-angle-right"></i></span></a></li>';
            $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$Key2URL.'" title="'.$h1title2.'"><span itemprop="title">'.$h1title2.' <i class="fa fa-angle-right"></i></span></a></li>';
			$breadcrumbs .= '<li><a class="current" href="'.$Key3URL.'" title="Phim '.$h1title3.'">'.$h1title3.'</a></li>';			
		    $pageURL = $web_link.'/'.$Key1.'/'.$Key2.'/'.$Key3;
			$name = $Key1.'|'.$Key2.'|'.$Key3;
		}elseif(count($ipid) == 6){
		    $Key1 = sql_escape($ipid[1]);
		    $Key2 = sql_escape($ipid[2]);
		    $Key3 = sql_escape($ipid[3]);
		    $Key4 = sql_escape($ipid[4]);

			$Year = explode('phim-',$Key1);
			$Year = (int)$Year[1];
			// Check $Key1
            if($Key1 == 'phim-le'){
			    $where_sql1 = "WHERE film_lb = 0";
				$h1title1 = $language['moviesingle'];
			}elseif($Key1 == 'phim-bo'){
			    $where_sql1 = "WHERE film_lb IN (1,2)";
				$h1title1 = $language['movieserial'];
			}elseif($Key1 == 'phim-chieu-rap'){
			    $where_sql1 = "WHERE film_chieurap = 1";
				$h1title1 = $language['movietheaters'];
			}elseif($Key1 == 'phim-hot'){
			    $where_sql1 = "WHERE film_hot = 1";
				$h1title1 = $language['movieshot'];
			}elseif($Key1 == 'phim-18'){
			    $where_sql1 = "WHERE film_phim18 = 1";
				$h1title1 = $language['movie18'];
			}elseif($Key1 == 'phim-moi'){
			    $where_sql1 = "WHERE film_publish = 0";
				$h1title1 = $language['movienew'];
			}elseif(is_numeric($Year)){
			    $where_sql1 = "WHERE film_year = ".$Year;
				$h1title1 = 'Phim năm '.$Year;
				$YearKey = $Year;
			}else header('Location: '.$web_link.'/404');
			$TypeKey = $Key1;
			// Check $Key2
			$CatID = get_data('cat_id','cat','cat_name_key',$Key2);
			$CountryID = get_data('country_id','country','country_name_key',$Key2);
			if($CatID){
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$Key2);
			    $where_sql2 = " AND film_cat LIKE '%,".$CatID.",%'";
				$h1title2 = $CatNAME;
				$Key2URL = $web_link.'/the-loai/'.$Key2.'/';
				$CatKey = $Key2;
			}elseif($CountryID){
			    $CountryNAME = get_data('country_name','country','country_name_key',$Key2);
			    $where_sql2 = " AND film_country LIKE '%,".$CountryID.",%'";
				$h1title2 = $CountryNAME;
				$Key2URL = $web_link.'/quoc-gia/'.$Key2.'/';
				$CountryKey = $Key2;
			}elseif(is_numeric($Key2)){
			    $where_sql2 = " AND film_year = ".$Key2;
				$h1title2 = 'Năm '.$Key2;
				$Key2URL = $web_link.'/phim-'.$Key2.'/';
				$YearKey = $Key2;
			}else header('Location: '.$web_link.'/404');
			// Check $Key3
			$CatID = get_data('cat_id','cat','cat_name_key',$Key3);
			$CountryID = get_data('country_id','country','country_name_key',$Key3);
			if($CatID){
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$Key3);
			    $where_sql3 = " AND film_cat LIKE '%,".$CatID.",%'";
				$h1title3 = $CatNAME;
				$Key3URL = $web_link.'/the-loai/'.$Key3.'/';
				$CatKey = $Key3;
			}elseif($CountryID){
			    $CountryNAME = get_data('country_name','country','country_name_key',$Key3);
			    $where_sql3 = " AND film_country LIKE '%,".$CountryID.",%'";
				$h1title3 = $CountryNAME;
				$Key3URL = $web_link.'/quoc-gia/'.$Key3.'/';
				$CountryKey = $Key3;
			}elseif(is_numeric($Key3)){
			    $where_sql3 = " AND film_year = ".$Key3;
				$h1title3 = 'Năm '.$Key3;
				$Key3URL = $web_link.'/phim-'.$Key3.'/';
				$YearKey = $Key3;
			}else header('Location: '.$web_link.'/404');
			// Check $Key4
			$CatID = get_data('cat_id','cat','cat_name_key',$Key4);
			$CountryID = get_data('country_id','country','country_name_key',$Key4);
			if($CatID){
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$Key4);
			    $where_sql4 = " AND film_cat LIKE '%,".$CatID.",%'";
				$h1title4 = $CatNAME;
				$Key4URL = $web_link.'/the-loai/'.$Key4.'/';
				$CatKey = $Key4;
			}elseif($CountryID){
			    $CountryNAME = get_data('country_name','country','country_name_key',$Key4);
			    $where_sql4 = " AND film_country LIKE '%,".$CountryID.",%'";
				$h1title4 = $CountryNAME;
				$Key4URL = $web_link.'/quoc-gia/'.$Key4.'/';
				$CountryKey = $Key4;
			}elseif(is_numeric($Key4)){
			    $where_sql4 = " AND film_year = ".$Key4;
				$h1title4 = 'Năm '.$Key4;
				$Key4URL = $web_link.'/phim-'.$Key4.'/';
				$YearKey = $Key4;
			}else header('Location: '.$web_link.'/404');
			$h1title = $h1title1.' '.$h1title2.' '.$h1title3.' '.$h1title4;
			$where_sql = $where_sql1.$where_sql2.$where_sql3.$where_sql4;
			$keyword = $h1title;
			$web_keywords = 'xem phim '.$keyword.' full hd, phim '.$keyword.' online, phim '.$keyword.' vietsub, phim '.$keyword.' thuyet minh, phim  long tieng, phim '.$keyword.' tap cuoi';
	        $web_des = 'Phim '.$keyword.' hay tuyển tập, phim '.$keyword.' mới nhất, tổng hợp phim '.$keyword.', '.$keyword.' full HD, '.$keyword.' vietsub, xem '.$keyword.' online';
	        $web_title = $keyword.' | '.$keyword.' hay | Tuyển tập '.$keyword.' mới nhất 2015';
            $breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
            $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$web_link.'/'.$Key1.'/" title="'.$h1title1.'"><span itemprop="title">'.$h1title1.' <i class="fa fa-angle-right"></i></span></a></li>';
            $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$Key2URL.'" title="'.$h1title2.'"><span itemprop="title">'.$h1title2.' <i class="fa fa-angle-right"></i></span></a></li>';
            $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$Key3URL.'" title="'.$h1title3.'"><span itemprop="title">'.$h1title3.' <i class="fa fa-angle-right"></i></span></a></li>';
			$breadcrumbs .= '<li><a class="current" href="'.$Key4URL.'" title="Phim '.$h1title4.'">'.$h1title4.'</a></li>';			
		    $pageURL = $web_link.'/'.$Key1.'/'.$Key2.'/'.$Key3.'/'.$Key4;
			$name = $Key1.'|'.$Key2.'|'.$Key3.'|'.$Key4;
		}
	    $relTYPE = $Key1;

	}elseif($value[2]=='quoc-gia'){
	    $ipid = explode('/',URL_LOAD);
		if(count($ipid) == 4){
		    $CountryKey = sql_escape($ipid[2]);
			$CountryID = get_data('country_id','country','country_name_key',$CountryKey);
			
			if($CountryID){
			    $CountryNAME = get_data('country_name','country','country_name_key',$CountryKey);
			    $where_sql = "WHERE film_country LIKE '%,".$CountryID.",%'";
				$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		        $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="#" title="'.$language['country'].'"><span itemprop="title">'.$language['country'].' <i class="fa fa-angle-right"></i></span></a></li>';
	            $breadcrumbs .= '<li><a class="current" href="'.$web_link.'/quoc-gia/'.$CountryKey.'/" title="Phim '.$CountryNAME.'">'.$CountryNAME.'</a></li>';
				$h1title = 'Phim '.$CountryNAME;
				$pageURL = $web_link.'/quoc-gia/'.$CountryKey;
				$web_keywords = 'xem phim '.$CountryNAME.' full hd, phim '.$CountryNAME.' online, phim '.$CountryNAME.' vietsub, phim '.$CountryNAME.' thuyet minh, phim  long tieng, phim '.$CountryNAME.' tap cuoi';
	            $web_des = 'Phim '.$CountryNAME.' hay tuyển tập, phim '.$CountryNAME.' mới nhất, tổng hợp phim '.$CountryNAME.', '.$CountryNAME.' full HD, '.$CountryNAME.' vietsub, xem '.$CountryNAME.' online';
	            $web_title = 'Phim '.$CountryNAME.' hay | Phim '.$CountryNAME.' mới | Tuyển tập phim '.$CountryNAME.' mới nhất 2015';
			    $name = 'quoc-gia|'.$CountryID;
			}else header('Location: '.$web_link.'/404');
			
		}elseif(count($ipid) == 5){
		    $CountryKey = sql_escape($ipid[2]);
			$Key3 = sql_escape($ipid[3]);
			$CountryID = get_data('country_id','country','country_name_key',$CountryKey);
			if($CountryID){
			    $CountryNAME = get_data('country_name','country','country_name_key',$CountryKey);
			if(is_numeric($Key3)){
			    $where_sql1 = " AND film_year = ".$Key3;
				$h1title1 = 'Phim năm '.$Key3;
				$h1title2 = 'Năm '.$Key3;
				$Key3URL = $web_link.'/phim-'.$Key3.'/';
				$YearKey = $Key3;
			}else{
			    $CatID = get_data('cat_id','cat','cat_name_key',$Key3);
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$Key3);
				$where_sql1 = " AND film_cat LIKE '%,".$CatID.",%'";
				$h1title1 = 'Phim '.$CatNAME;
				$h1title2 = $CatNAME;
				$Key3URL = $web_link.'/the-loai/'.$Key3.'/';
				$CatKey = $Key3;
			}
			    $where_sql = "WHERE film_country LIKE '%,".$CountryID.",%'".$where_sql1;
				$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		        $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="#" title="'.$language['country'].'"><span itemprop="title">'.$language['country'].' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$web_link.'/quoc-gia/'.$CountryKey.'/" title="'.$CountryNAME.'"><span itemprop="title">'.$CountryNAME.' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li><a class="current" href="'.$Key3URL.'" title="Phim '.$h1title2.'">'.$h1title2.'</a></li>';
				$h1title = 'Phim '.$CountryNAME.' '.$h1title2;
				$pageURL = $web_link.'/quoc-gia/'.$CountryKey.'/'.$Key3;
				$web_keywords = 'xem phim '.$CatNAME.' '.$h1title2.' full hd, phim '.$CountryNAME.' '.$h1title2.' online, phim '.$CountryNAME.' '.$h1title2.' vietsub, phim '.$CountryNAME.' '.$h1title2.' thuyet minh, phim  long tieng, phim '.$CountryNAME.' '.$h1title2.' tap cuoi';
	            $web_des = 'Phim '.$CountryNAME.' hay tuyển tập, phim '.$CountryNAME.' '.$h1title2.' mới nhất, tổng hợp phim '.$CountryNAME.' '.$h1title2.', '.$CountryNAME.' '.$h1title2.' full HD, '.$CountryNAME.' '.$h1title2.' vietsub, xem '.$CountryNAME.' '.$h1title2.' online';
	            $web_title = 'Phim '.$CountryNAME.' '.$h1title2.' hay | Phim '.$CountryNAME.' '.$h1title2.' mới | Tuyển tập phim '.$CountryNAME.' '.$h1title2.' mới nhất 2015';
			    $name = 'quoc-gia|'.$CountryID.'|'.$Key3;
			}else header('Location: '.$web_link.'/404');
			    
		}elseif(count($ipid) == 6){
		    $CountryKey = sql_escape($ipid[2]);
			$Key3 = sql_escape($ipid[3]);
			$Key4 = sql_escape($ipid[4]);
			$CountryID = get_data('country_id','country','country_name_key',$CountryKey);
			if($CountryID){
			    $CountryNAME = get_data('country_name','country','country_name_key',$CountryKey);
			if(is_numeric($Key3)){
			    $where_sql1 = " AND film_year = ".$Key3;
				$h1title1 = 'Phim năm '.$Key3;
				$h1title2 = 'Năm '.$Key3;
				$Key3URL = $web_link.'/phim-'.$Key3.'/';
				$YearKey = $Key3;
			}else{
			    $CatID = get_data('cat_id','cat','cat_name_key',$Key3);
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$Key3);
				$where_sql1 = " AND film_cat LIKE '%,".$CatID.",%'";
				$h1title1 = 'Phim '.$CatNAME;
				$h1title2 = $CatNAME;
				$Key3URL = $web_link.'/the-loai/'.$Key3.'/';
				$CatKey = $Key3;
			}
			
			if(is_numeric($Key4)){
			    $where_sql2 = " AND film_year = ".$Key4;
				$h1title3 = 'Phim năm '.$Key4;
				$h1title4 = 'Năm '.$Key4;
				$Key4URL = $web_link.'/phim-'.$Key4.'/';
				$YearKey = $Key4;
			}else{
			    $CatID = get_data('cat_id','cat','cat_name_key',$Key4);
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$Key4);
				$where_sql2 = " AND film_cat LIKE '%,".$CatID.",%'";
				$h1title3 = 'Phim '.$CatNAME;
				$h1title4 = $CatNAME;
				$Key4URL = $web_link.'/the-loai/'.$Key4.'/';
				$CatKey = $Key4;
			}
			    $where_sql = "WHERE film_country LIKE '%,".$CountryID.",%'".$where_sql1.$where_sql2;
				$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		        $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="#" title="'.$language['country'].'"><span itemprop="title">'.$language['country'].' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$web_link.'/quoc-gia/'.$CountryKey.'/" title="'.$CountryNAME.'"><span itemprop="title">'.$CountryNAME.' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$Key3URL.'" title="Phim '.$h1title2.'"><span itemprop="title">'.$h1title2.' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li><a class="current" href="'.$Key4URL.'" title="Phim '.$h1title4.'">'.$h1title4.'</a></li>';
				$h1title = 'Phim '.$CountryNAME.' '.$h1title2.' '.$h1title4;
				$pageURL = $web_link.'/quoc-gia/'.$CountryKey.'/'.$Key3.'/'.$Key4;
				$web_keywords = 'xem phim '.$CountryNAME.' '.$h1title2.' '.$h1title4.' full hd, phim '.$CountryNAME.' '.$h1title2.' '.$h1title4.' online, phim '.$CountryNAME.' '.$h1title2.' '.$h1title4.' vietsub, phim '.$CountryNAME.' '.$h1title2.' '.$h1title4.'  thuyet minh, phim  long tieng, phim '.$CountryNAME.' '.$h1title2.' '.$h1title4.' tap cuoi';
	            $web_des = 'Phim '.$CountryNAME.' hay tuyển tập, phim '.$CountryNAME.' '.$h1title2.' '.$h1title4.' mới nhất, tổng hợp phim '.$CountryNAME.' '.$h1title2.', '.$CountryNAME.' '.$h1title2.' '.$h1title4.' full HD, '.$CountryNAME.' '.$h1title2.' '.$h1title4.' vietsub, xem '.$CountryNAME.' '.$h1title2.' '.$h1title4.' online';
	            $web_title = 'Phim '.$CountryNAME.' '.$h1title2.' hay | Phim '.$CountryNAME.' '.$h1title2.' '.$h1title4.' mới | Tuyển tập phim '.$CountryNAME.' '.$h1title2.' '.$h1title4.' mới nhất 2015';
			    $name = 'quoc-gia|'.$CountryID.'|'.$Key3.'|'.$Key4;
				
			}else header('Location: '.$web_link.'/404');
		}
		
	}elseif($value[2]=='the-loai'){
	    $ipid = explode('/',URL_LOAD);
		if(count($ipid) == 4){
		    $CatKey = sql_escape($ipid[2]);
			$CatID = get_data('cat_id','cat','cat_name_key',$CatKey);
			
			if($CatID){
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$CatKey);
			    $where_sql = "WHERE film_cat LIKE '%,".$CatID.",%'";
				$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		        $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="#" title="'.$language['genres'].'"><span itemprop="title">'.$language['genres'].' <i class="fa fa-angle-right"></i></span></a></li>';
	            $breadcrumbs .= '<li><a class="current" href="'.$web_link.'/the-loai/'.$CatKey.'/" title="Phim '.$CatNAME.'">'.$CatNAME.'</a></li>';
				$h1title = 'Phim '.$CatNAME;
				$pageURL = $web_link.'/the-loai/'.$CatKey;
				$web_keywords = 'xem phim '.$CatNAME.' full hd, phim '.$CatNAME.' online, phim '.$CatNAME.' vietsub, phim '.$CatNAME.' thuyet minh, phim  long tieng, phim '.$CatNAME.' tap cuoi';
	            $web_des = 'Phim '.$CatNAME.' hay tuyển tập, phim '.$CatNAME.' mới nhất, tổng hợp phim '.$CatNAME.', '.$CatNAME.' full HD, '.$CatNAME.' vietsub, xem '.$CatNAME.' online';
	            $web_title = 'Phim '.$CatNAME.' hay | Phim '.$CatNAME.' mới | Tuyển tập phim '.$CatNAME.' mới nhất 2015';
			    $name = 'the-loai|'.$CatID;
			}else header('Location: '.$web_link.'/404');
			
		}elseif(count($ipid) == 5){
		    $CatKey = sql_escape($ipid[2]);
			$Key3 = sql_escape($ipid[3]);
			$CatID = get_data('cat_id','cat','cat_name_key',$CatKey);
			if($CatID){
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$CatKey);
			if(is_numeric($Key3)){
			    $where_sql1 = " AND film_year = ".$Key3;
				$h1title1 = 'Phim năm '.$Key3;
				$h1title2 = 'Năm '.$Key3;
				$Key3URL = $web_link.'/phim-'.$Key3.'/';
				$YearKey = $Key3;
			}else{
			    $CountryID = get_data('country_id','country','country_name_key',$Key3);
			    $CountryNAME = get_data('country_name','country','country_name_key',$Key3);
				$where_sql1 = " AND film_country LIKE '%,".$CountryID.",%'";
				$h1title1 = 'Phim '.$CountryNAME;
				$h1title2 = $CountryNAME;
				$Key3URL = $web_link.'/quoc-gia/'.$Key3.'/';
				$CountryKey = $Key3;
			}
			    $where_sql = "WHERE film_cat LIKE '%,".$CatID.",%'".$where_sql1;
				$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		        $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="#" title="'.$language['genres'].'"><span itemprop="title">'.$language['genres'].' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$web_link.'/the-loai/'.$CatKey.'/" title="'.$CatNAME.'"><span itemprop="title">'.$CatNAME.' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li><a class="current" href="'.$Key3URL.'" title="Phim '.$h1title2.'">'.$h1title2.'</a></li>';
				$h1title = 'Phim '.$CatNAME.' '.$h1title2;
				$pageURL = $web_link.'/the-loai/'.$CatKey.'/'.$Key3;
				$web_keywords = 'xem phim '.$CatNAME.' '.$h1title2.' full hd, phim '.$CatNAME.' '.$h1title2.' online, phim '.$CatNAME.' '.$h1title2.' vietsub, phim '.$CatNAME.' '.$h1title2.' thuyet minh, phim  long tieng, phim '.$CatNAME.' '.$h1title2.' tap cuoi';
	            $web_des = 'Phim '.$CatNAME.' hay tuyển tập, phim '.$CatNAME.' '.$h1title2.' mới nhất, tổng hợp phim '.$CatNAME.' '.$h1title2.', '.$CatNAME.' '.$h1title2.' full HD, '.$CatNAME.' '.$h1title2.' vietsub, xem '.$CatNAME.' '.$h1title2.' online';
	            $web_title = 'Phim '.$CatNAME.' '.$h1title2.' hay | Phim '.$CatNAME.' '.$h1title2.' mới | Tuyển tập phim '.$CatNAME.' '.$h1title2.' mới nhất 2015';
			    $name = 'the-loai|'.$CatID.'|'.$Key3;
			}else header('Location: '.$web_link.'/404');
		}elseif(count($ipid) == 6){
		    $CatKey = sql_escape($ipid[2]);
			$Key3 = sql_escape($ipid[3]);
			$Key4 = sql_escape($ipid[4]);
			$CatID = get_data('cat_id','cat','cat_name_key',$CatKey);
			if($CatID){
			    $CatNAME = get_data('cat_name','cat','cat_name_key',$CatKey);
			if(is_numeric($Key3)){
			    $Key3 = (int)$Key3;
			    $where_sql1 = " AND film_year = ".$Key3;
				$h1title1 = 'Phim năm '.$Key3;
				$h1title2 = 'Năm '.$Key3;
				$Key3URL = $web_link.'/phim-'.$Key3.'/';
			}else{
			    $CountryID = get_data('country_id','country','country_name_key',$Key3);
			    $CountryNAME = get_data('country_name','country','country_name_key',$Key3);
				$where_sql1 = " AND film_country LIKE '%,".$CountryID.",%'";
				$h1title1 = 'Phim '.$CountryNAME;
				$h1title2 = $CountryNAME;
				$Key3URL = $web_link.'/quoc-gia/'.$Key3.'/';
				$CountryKey = $Key3;
			}
			
			if(is_numeric($Key4)){
			    $Key4 = (int)$Key4;
			    $where_sql2 = " AND film_year = ".$Key4;
				$h1title3 = 'Phim năm '.$Key4;
				$h1title4 = 'Năm '.$Key4;
				$Key4URL = $web_link.'/phim-'.$Key4.'/';
				$YearKey = $Key4;
			}else{
			    $CountryID = get_data('country_id','country','country_name_key',$Key4);
			    $CountryNAME = get_data('country_name','country','country_name_key',$Key4);
				$where_sql2 = " AND film_country LIKE '%,".$CountryID.",%'";
				$h1title3 = 'Phim '.$CountryNAME;
				$h1title4 = $CountryNAME;
				$Key4URL = $web_link.'/quoc-gia/'.$Key4.'/';
				$CountryKey = $Key4;
			}
			    $where_sql = "WHERE film_cat LIKE '%,".$CatID.",%'".$where_sql1.$where_sql2;
				$breadcrumbs = '<li><a itemprop="url" href="/" title="'.$language['home'].'"><span itemprop="title"><i class="fa fa-home"></i> '.$language['home'].' <i class="fa fa-angle-right"></i></span></a></li>';
		        $breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="#" title="'.$language['genres'].'"><span itemprop="title">'.$language['genres'].' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$web_link.'/the-loai/'.$CatKey.'/" title="'.$CatNAME.'"><span itemprop="title">'.$CatNAME.' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.$Key3URL.'" title="Phim '.$h1title2.'"><span itemprop="title">'.$h1title2.' <i class="fa fa-angle-right"></i></span></a></li>';
				$breadcrumbs .= '<li><a class="current" href="'.$Key4URL.'" title="Phim '.$h1title4.'">'.$h1title4.'</a></li>';
				$h1title = 'Phim '.$CatNAME.' '.$h1title2.' '.$h1title4;
				$pageURL = $web_link.'/the-loai/'.$CatKey.'/'.$Key3.'/'.$Key4;
				$web_keywords = 'xem phim '.$CatNAME.' '.$h1title2.' '.$h1title4.' full hd, phim '.$CatNAME.' '.$h1title2.' '.$h1title4.' online, phim '.$CatNAME.' '.$h1title2.' '.$h1title4.' vietsub, phim '.$CatNAME.' '.$h1title2.' '.$h1title4.'  thuyet minh, phim  long tieng, phim '.$CatNAME.' '.$h1title2.' '.$h1title4.' tap cuoi';
	            $web_des = 'Phim '.$CatNAME.' hay tuyển tập, phim '.$CatNAME.' '.$h1title2.' '.$h1title4.' mới nhất, tổng hợp phim '.$CatNAME.' '.$h1title2.', '.$CatNAME.' '.$h1title2.' '.$h1title4.' full HD, '.$CatNAME.' '.$h1title2.' '.$h1title4.' vietsub, xem '.$CatNAME.' '.$h1title2.' '.$h1title4.' online';
	            $web_title = 'Phim '.$CatNAME.' '.$h1title2.' hay | Phim '.$CatNAME.' '.$h1title2.' '.$h1title4.' mới | Tuyển tập phim '.$CatNAME.' '.$h1title2.' '.$h1title4.' mới nhất 2015';
			    $name = 'the-loai|'.$CatID.'|'.$Key3.'|'.$Key4;
			}else header('Location: '.$web_link.'/404');
		}
		
	}
	$relCAT = $CatKey;
	$relCOUNTRY = $CountryKey;
	$relYEAR = $YearKey;
	$relTYPE = $TypeKey;
	$page_size = PAGE_SIZE;
	if (!$page) $page = 1;
	$limit = ($page-1)*$page_size;
    $q = $mysql->query("SELECT * FROM ".DATABASE_FX."film $where_sql $order_sql LIMIT ".$limit.",".$page_size);
	$total = get_total("film","film_id","$where_sql $order_sql");
	$ViewPage = view_pages('film',$total,$page_size,$page,$pageURL,$rel,"defaultv2");
?>


<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" xmlns="https://www.w3.org/1999/html" xml:lang="vi" lang="vi">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="title" content="Action -  Anime ActionHay Nhất 2019" />
   <title><?=$web_title;?></title>
   <meta property="og:title"content="Action -  Anime ActionHay Nhất 2019" />
   <meta name="description" content="Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime hay HOT luôn được cập nhật sớm nhất Việt Nam, xem anime hay nhất, hãy cùng khám phá kho tàng về hoạt hình nhật bản nhé." />
   <meta name="keywords" content="anime vietsub, xem anime, vui ghe, naruto, vua hai tac, one piece, hoi phap su, fairy tail, bleach, dragon ball, dao hai tac, boruto, animevsub, anime hay, animehay, animehayhd, anime47, hoat hinh trung quoc, anime vietsub hd, anime moi nhat, anime hay nhat" />
   <link rel="alternate" href="http://thuyduong.ga" hreflang="vi-vn" />
   <meta http-equiv="cache-control" content="max-age=0" />
   <meta http-equiv="cache-control" content="no-cache" />
   <!-- Facebook Metadata /-->
   <meta property="og:type" content="video.movie" />
   <meta property="og:description" content="Xem anime Vietsub online miễn phí chất lượng cao với đường truyền nhanh, các anime hay HOT luôn được cập nhật sớm nhất Việt Nam, xem anime hay nhất, hãy cùng khám phá kho tàng về hoạt hình nhật bản nhé." />
   <meta property="og:url" content="http://thuyduong.ga/" />
   <link href="http://thuyduong.ga" rel="canonical">
   <meta property="og:image" content="http://thuyduong.ga/Theme/images/logo.png">
   <meta property="og:site_name" content="HTAVN.NET" />
   <meta property="og:locale" content="vi_VN" />
   <meta property="fb:admins" content="100027613295889,100007834096944" />
   <meta property="fb:pages" content="915402125310968" />
   <meta property="fb:app_id" content="262760374306229" />
   <meta name="google-site-verification" content="nOAdTL20yHtbl47BBnf-tMKIAd3PAcrcCv6o6LLD6t0" />
   <meta name="robots" content="index, follow" />
   <meta name="language" content="Vietnamese, English" />
   <meta name="googlebot" content="index,follow" />
   <meta name="generator" content="HTAVN.NET" />
   <meta name="copyright" content="HTAVN.NET" />
   <meta name="revisit-after" content="1 days" />
   <meta name="author" content="HTAVN.NET" />
   <meta name="viewport"content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <meta http-equiv="content-language" content="vi" />
   <link rel="shortcut icon" href="http://thuyduong.ga/favicon.ico" type="image/x-icon" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <!-- stylesheet -->
   <!-- Latest compiled and minified CSS -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="http://thuyduong.ga/Theme/css/bootstrap.min.css" />
   <link rel="stylesheet" type="text/css" href="http://thuyduong.ga/Theme/css/fonts.css" />
   <link rel="stylesheet" type="text/css" href="http://thuyduong.ga/Theme/css/style.css?v=1.45" />


   <script type="text/javascript">
      var MAIN_URL = 'http://thuyduong.ga';
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
   <script type="text/javascript">
      JS_Load('http://thuyduong.ga/Theme/js/default.include-footerv2.js?ver=1.25');
   </script>
   <script type="text/javascript" src="http://thuyduong.ga/Theme/js/jquery-2.1.0.min.js"></script>
   <script type="text/javascript" src="http://thuyduong.ga/Theme/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="http://thuyduong.ga/Theme/js/jquery.raty.js?v=1.1"></script>
   <script type="text/javascript" src="http://thuyduong.ga/Theme/js/jquery.md5.js"></script>
   <script type="text/javascript" src="http://thuyduong.ga/Theme/js/fx/util.js"></script>
   <script type="text/javascript" src="http://thuyduong.ga/Theme/js/home-v1.js?v=1.1"></script>



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
                  <a href="http://thuyduong.ga" title="Animet47.Net Xem Phim Nhanh, Xem Phim Online chất lượng cao miễn phí" rel="home">
                     <img src="http://thuyduong.ga/favicon.ico" alt="Animet47.Net Xem Phim Nhanh, Xem Phim Online chất lượng cao miễn phí">
                  </a>
               </figure> <span class="Button MenuBtn AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"><i></i><i></i><i></i></span>
               <span class="MenuBtnClose AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"></span>
               <div class="Rght BgA">
                  <div class="Search">
                     <form method="get" id="form-search" action="tim-kiem/"> <label class="Form-Icon"> <input
                              type="text" name="keyword" id="keyword" placeholder="Tìm: tên phim, tên tiếng Anh ...">
                           <button id="searchsubmit" type="submit"><i class="fa-search"></i></button> </label>
                        <div class="search-suggest" style="display: none;width: 100%"></div>
                     </form>
                  </div>
                  <div class="Login">
        <a href="http://thuyduong.ga/thanh-vien/dang-nhap.html/?rel=http://thuyduong.ga/"class="Button StylA">Đăng nhập</a> </div>
                  <nav class="Menu">
		<ul>
			 <li
				  class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-490">
				  <a href="/">Trang chủ</a></li>
			 <li id="menu-item-494"
				  class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-494"><a
						href="#">THỂ LOẠI</a>
				  <ul class="sub-menu">
						<li><a href="http://thuyduong.ga/the-loai/action.html">Action</a></li>
						<li><a href="http://thuyduong.ga/the-loai/adventure.html">Adventure</a></li>
						<li><a href="http://thuyduong.ga/the-loai/cartoon.html">Cartoon</a></li>
						<li><a href="http://thuyduong.ga/the-loai/comedy.html">Comedy</a></li>
						<li><a href="http://thuyduong.ga/the-loai/dementia.html">Dementia</a></li>
						<li><a href="http://thuyduong.ga/the-loai/demons.html">Demons</a></li>
						<li><a href="http://thuyduong.ga/the-loai/drama.html">Drama</a></li>
						<li><a href="http://thuyduong.ga/the-loai/ecchi.html">Ecchi</a></li>
						<li><a href="http://thuyduong.ga/the-loai/fantasy.html">Fantasy</a></li>
						<li><a href="http://thuyduong.ga/the-loai/game.html">Game</a></li>
						<li><a href="http://thuyduong.ga/the-loai/harem.html">Harem</a></li>
						<li><a href="http://thuyduong.ga/the-loai/historical.html">Historical</a></li>
						<li><a href="http://thuyduong.ga/the-loai/horror.html">Horror</a></li>
						<li><a href="http://thuyduong.ga/the-loai/josei.html">Josei</a></li>
						<li><a href="http://thuyduong.ga/the-loai/kids.html">Kids</a></li>
						<li><a href="http://thuyduong.ga/the-loai/live-action.html">Live Action</a></li>
						<li><a href="http://thuyduong.ga/the-loai/magic.html">Magic</a></li>
						<li><a href="http://thuyduong.ga/the-loai/martial-arts.html">Martial Arts</a></li>
						<li><a href="http://thuyduong.ga/the-loai/mecha.html">Mecha</a></li>
						<li><a href="http://thuyduong.ga/the-loai/military.html">Military</a></li>
						<li><a href="http://thuyduong.ga/the-loai/music.html">Music</a></li>
						<li><a href="http://thuyduong.ga/the-loai/mystery.html">Mystery</a></li>
						<li><a href="http://thuyduong.ga/the-loai/parody.html">Parody</a></li>
						<li><a href="http://thuyduong.ga/the-loai/police.html">Police</a></li>
						<li><a href="http://thuyduong.ga/the-loai/psychological.html">Psychological</a></li>
						<li><a href="http://thuyduong.ga/the-loai/romance.html">Romance</a></li>
						<li><a href="http://thuyduong.ga/the-loai/samurai.html">Samurai</a></li>
						<li><a href="http://thuyduong.ga/the-loai/school.html">School</a></li>
						<li><a href="http://thuyduong.ga/the-loai/sci-fi.html">Sci-Fi</a></li>
						<li><a href="http://thuyduong.ga/the-loai/seinen.html">Seinen</a></li>
						<li><a href="http://thuyduong.ga/the-loai/shoujo.html">Shoujo</a></li>
						<li><a href="http://thuyduong.ga/the-loai/shoujo-ai.html">Shoujo Ai</a></li>
						<li><a href="http://thuyduong.ga/the-loai/shounen.html">Shounen</a></li>
						<li><a href="http://thuyduong.ga/the-loai/shounen-ai.html">Shounen Ai</a></li>
						<li><a href="http://thuyduong.ga/the-loai/slice-of-life.html">Slice of Life</a></li>
						<li><a href="http://thuyduong.ga/the-loai/space.html">Space</a></li>
						<li><a href="http://thuyduong.ga/the-loai/sports.html">Sports</a></li>
						<li><a href="http://thuyduong.ga/the-loai/super-power.html">Super Power</a></li>
						<li><a href="http://thuyduong.ga/the-loai/supernatural.html">Supernatural</a></li>
						<li><a href="http://thuyduong.ga/the-loai/thriller.html">Thriller</a></li>
						<li><a href="http://thuyduong.ga/the-loai/tokusatsu.html">Tokusatsu</a></li>
						<li><a href="http://thuyduong.ga/the-loai/vampire.html">Vampire</a></li>
						<li><a href="http://thuyduong.ga/the-loai/yaoi.html">Yaoi</a></li>
						<li><a href="http://thuyduong.ga/the-loai/yuri.html">Yuri</a></li>
				  </ul>
			 </li>
			 <li id="menu-item-497"
				  class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-497"><a
						href="#">Season</a>
				  <ul class="sub-menu">
						<li><a href="http://thuyduong.ga/season/spring.html">Mùa Xuân</a></li>
						<li><a href="http://thuyduong.ga/season/summer.html">Mùa Hạ</a></li>
						<li><a href="http://thuyduong.ga/season/autumn.html">Mùa Thu</a></li>
						<li><a href="http://thuyduong.ga/season/winter.html">Mùa Đông</a></li>
				  </ul>
			 </li>
			 <li id="menu-item-495"
				  class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-495"><a
						href="#">Năm Phát Hành</a>
				  <ul class="sub-menu">
						<li><a href="http://thuyduong.ga/danh-sach/phim-2019.html">Năm 2019</a></li>
						<li><a href="http://thuyduong.ga/danh-sach/phim-2018.html">Năm 2018</a></li>
						<li><a href="http://thuyduong.ga/danh-sach/phim-2017.html">Năm 2017</a></li>
						<li><a href="http://thuyduong.ga/danh-sach/phim-2016.html">Năm 2016</a></li>
						<li><a href="http://thuyduong.ga/danh-sach/phim-2015.html">Năm 2015</a></li>
						<li><a href="http://thuyduong.ga/danh-sach/phim-2014.html">Năm 2014</a></li>
						<li><a href="http://thuyduong.ga/danh-sach/phim-2013.html">Năm 2013</a></li>
						<li><a href="http://thuyduong.ga/danh-sach/phim-2012.html">Năm 2012</a></li>
						<li><a href="http://thuyduong.ga/danh-sach/phim-2011.html">Năm 2011</a></li>
				  </ul>
			 </li>
			 <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-493"><a
						href="http://thuyduong.ga/bang-xep-hang.html">Top Anime</a>
				  <ul class="sub-menu">
						<li><a href="http://thuyduong.ga/bang-xep-hang/day.html">Theo Ngày</a></li>
						<li><a href="http://thuyduong.ga/bang-xep-hang/month.html">Theo Tháng</a></li>
						<li><a href="http://thuyduong.ga/bang-xep-hang/season.html">Theo Mùa</a></li>
						<li><a href="http://thuyduong.ga/bang-xep-hang/year.html">Theo Năm</a></li>
				  </ul>
			 </li>
			 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493">
			 	<a href="http://thuyduong.ga/lich-chieu-phim.html">Lịch Chiếu</a></li>
		     <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493">
			 	<a href="http://thuyduong.ga/thu-vien.html">Thư Viện</a></li>

		</ul>
  </nav>
               </div>
            </div>
         </div>
      </header>
      <div class="Body Container">
         <div class="Content">
            <div class="announcement">
        <span class="ann_title"><i class="fa-bullhorn"></i></span>
        <span class="ann_text">
           <div align="center"><p>
	Hiện tại site mới ph&aacute;t triển<br />
	<span style= font-family:verdana,geneva,sans-serif; ><span style= color:#ff3333; >N&ecirc;n c&oacute; v&agrave;i bộ phim chưa cập nhật đầy đủ. Nhưng AD sẽ cập nhật trong thời gian ngắn nhất</span></span><br />
	<strong><span style= color: ><img alt= heart  src= https://animet.net/Content/Admin/Template/ckeditor/plugins/smiley/images/heart.png  style= height:  title= heart  width:=   />&nbsp;</span><span style= color:#800080; >Ch&uacute;c c&aacute;c bạn xem vui vẻ tại HTAVN.NET</span><span style= color: >&nbsp;<img alt= yes  src= https://animet.net/Content/Admin/Template/ckeditor/plugins/smiley/images/thumbs_up.png  style= height:  title= yes  width:=   /></span></strong></p>
</div>
        </span>
     </div>


                  <div class="Ads ad-center-980"></div>
<div class="list-movie-filter SearchMovies" style="margin-bottom: 50px;">
<div class="ml-title ml-title-page">
<span>Danh sách Anime Action</span>
<div class="filter-toggle"><i class="fa fa-sort mr5"></i>Lọc Anime</div>
<div class="clearfix"></div>
</div>
<div class="schedule-title-main"> <strong>MẸO SỬ DỤNG:</strong> Sử dụng chức năng <strong>Lọc Anime</strong> trên thanh công cụ để lọc những phim bạn đang cần xem chính xác nhất.</div>
<div id="filter">
<div class="filter-btn">
<button onclick="filterMovies()" class="btn btn-lg btn-successful">Lọc Anime</button>
</div>
<div class="filter-content row">
<div class="col-sm-2 fc-main">
<span class="fc-title">Sắp xếp theo</span>
<ul class="fc-main-list">
<li>
<a class="" href="http://animevsub.tv/the-loai/hanh-dong"><i class="fa fa-clock-o mr5"></i>Mới nhất</a></li>
<li>
<a class="" href="http://animevsub.tv/the-loai/hanh-dong"><i class="fa fa-eye mr5"></i>Xem nhiều nhất</a></li>
<li>
<a class="" href="http://animevsub.tv/the-loai/hanh-dong"><i class="fa fa-star mr5"></i>Nhiều lượt bình chọn</a></li>
</ul>
</div>
<div class="col-sm-10">
<div class="cs10-top">
<div class="fc-filmtype">
<span class="fc-title">Loại</span>
<ul class="fc-filmtype-list">
<li><label><input name="type" checked value="all" type="radio">
Tất cả</label>
</li>
<li><label><input name="type" value="anime-le" type="radio">
Anime lẻ</label></li>
<li><label><input name="type" value="anime-bo" type="radio">
Anime bộ</label></li>
<li><label><input name="type" value="anime-hoan-thanh" type="radio">
Anime hoàn thành</label></li>
</ul>
</div>
<div class="fc-quality">
<span class="fc-title">Mùa</span>
<ul class="fc-quality-list">
<li><label><input name="season" checked value="all" type="radio"> Tất cả</label></li>
<li><label><input name="season" value="winter" type="radio"> Đông</label></li>
<li><label><input name="season" value="spring" type="radio"> Xuân</label>
</li>
<li><label><input name="season" value="summer" type="radio"> Hạ</label>
</li>
<li><label><input name="season" value="autumn" type="radio"> Thu</label></li>
</ul>
</div>
</div>
<div class="clearfix"></div>
<div class="fc-genre">
<span class="fc-title">Thể loại</span>
<ul class="fc-genre-list">
										<?php 
            $arr = $mysql->query("SELECT cat_id,cat_name_key,cat_name FROM ".DATABASE_FX."cat WHERE cat_child = '0' AND cat_type = '0' ORDER BY cat_id ASC");
	        while($row = $arr->fetch(PDO::FETCH_ASSOC)){
	            $catKEY = $row['cat_name_key'];
	            $catID = $row['cat_id'];
	            $catNAME = $row['cat_name'];
				if($catKEY == $relCAT) $select = "checked"; else $select = "";
        ?>
<li><label><input class="genre-ids" value="1" name="genres[]" type="checkbox" <?=$select;?> > <?=$catNAME;?></label></li>



                                    <?	}  ?>	 


</ul>
</div>
<div class="clearfix"></div>
<div class="fc-release">
<span class="fc-title">Năm phát hành</span>
<ul class="fc-release-list">
<li><label><input checked name="year" value="all" type="radio">
Tất cả</label></li>
<li><label><input value="2019" name="year" type="radio"> 2019</label></li>
<li><label><input value="2018" name="year" type="radio"> 2018</label></li>
<li><label><input value="2017" name="year" type="radio"> 2017</label></li>
<li><label><input value="2016" name="year" type="radio"> 2016</label></li>
<li><label><input value="2015" name="year" type="radio"> 2015</label></li>
<li><label><input value="2014" name="year" type="radio"> 2014</label></li>
<li><label><input value="2013" name="year" type="radio"> 2013</label></li>
<li>
<label>
<input name="year" value="older-2013" type="radio"> Cũ hơn
</label>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="TpRwCont">
<main>
<section>
      <div class='wp-pagenavi'></div>
<div class="Top">
</div>
<ul class="MovieList Rows AX A06 B04 C03 E20">
<?php 
if($total){
while($row = $q->fetch(PDO::FETCH_ASSOC)){
$filmID = $row['film_id'];
$filmNAME = $row['film_name'];
$filmNAMEEN = $row['film_name_real'];
$filmYEAR = $row['film_year'];
$filmIMG = thumbimg($row['film_img'],200);
$filmSLUG = $row['film_slug'];
$filmURL = $web_link.'/phim/'.$filmSLUG.'-'.replace($filmID).'/';
$filmQUALITY = $row['film_chatluong'];
$film_list = $row['film_list'];
    $filmSTATUS = $row['film_tapphim'];
	$filmVIEWED = number_format($row['film_viewed']);
	$filmLANG = film_lang($row['film_lang']);
		$filmINFO = cut_string(text_tidy1(strip_tags($row['film_info'])),230);
   if($row['film_lb'] == 0){
      $Status = '<span class="mli-quality">'.$filmQUALITY.'';
    }else{
      $Status = '<span class="mli-eps">'.$film_list.'<i>'.$filmSTATUS.'</i></span>';
  
  }
	
?>	    
      <li class="TPostMv">
         <article class="TPost C post-<?=$filmID;?> post type-post status-publish format-standard has-post-thumbnail hentry">
            <a href="<?=$filmURL;?>">
               <div class="Image">
                  <figure class="Objf TpMvPlay AAIco-play_arrow">
                     <img width="215" height="320" src="<?=$filmIMG;?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" /></figure>
                <?=$Status;?>
               </div>
               <h2 class="Title"><?=$filmNAME;?></h2>
                <span class="Year">Lượt xem: <?=$filmVIEWED;?></span>
            </a>
            <div class="TPMvCn anmt">
               <div class="Title"><?=$filmNAME;?></div>
               <p class="Info"> <span class="Vote AAIco-star">7.1</span> 
                  <span class="Time AAIco-access_time">22 phút </span>
                  <span class="Date AAIco-date_range">2013</span> 
                  <span class="Qlty">HD</span></p>
               <div class="Description">
                  <p> <?=$filmINFO;?></p>
                  <p class="Director AAIco-videocam"><span>Studio:<span> Artland, AIC, Artmic <i
                              class="Button STPa AAIco-more_horiz"></i></p>
                  <p class="Genre AAIco-movie_creation"><span>Thể loại:</span> <a href="http://animevsub.tv/the-loai/sci-fi/"
                        title="Sci-Fi">Sci-Fi</a>, <a href="http://animevsub.tv/the-loai/tinh-cam/"
                        title="Romance">Romance</a>, <a href="http://animevsub.tv/the-loai/mystery/"
                        title="Mystery">Mystery</a>, <a href="http://animevsub.tv/the-loai/am-nhac/" title="Music">Music</a>,
                     <a href="http://animevsub.tv/the-loai/mecha/" title="Mecha">Mecha</a>, <a
                        href="http://animevsub.tv/the-loai/hanh-dong/" title="Action">Action</a>, </p>
                  <p class="Actors AAIco-person"><span>Diễn viên:</span> Yahagi Shougo, <i
                        class="Button STPa AAIco-more_horiz"></i></p>
               </div>
            </div>
         </article>
      </li>
  <? } }else{ ?>
<p class="bg-warning" style="padding: 20px">Chưa có dữ liệu</p>
<? } ?>            
</ul>
</section>
<div class='wp-pagenavi'></div>
</main>
<aside class="widget-area" role="complementary">
   <section class="Wdgt" id="showChonLoc">
      <div class="Title">ANIME MỚI CẬP NHẬT</div>
      <ul class="MovieList Newepisode">
              <ul class="MovieList Newepisode">
 <li><a href="/phim/byousoku-5-centimeter-16.html" title="Byousoku 5 Centimeter (2007)"><span>Byousoku 5 Centimeter </span><span>01/01 Tập</span></a></li> <li><a href="/phim/absolute-boy-8.html" title="Absolute Boy (2013)"><span>Absolute Boy </span><span>26/26  Tập</span></a></li> <li><a href="/phim/hibike-euphonium-15.html" title="Hibike! Euphonium (2015)"><span>Hibike! Euphonium </span><span>13/13  Tập</span></a></li> <li><a href="/phim/tamako-love-story-14.html" title="Tamako Love Story (2014)"><span>Tamako Love Story </span><span>00/?? Tập</span></a></li> <li><a href="/phim/dennou-coil-13.html" title="Dennou Coil (2007)"><span>Dennou Coil </span><span>26/26  Tập</span></a></li> <li><a href="/phim/tenki-no-ko-12.html" title="Tenki No Ko (2019)"><span>Tenki No Ko </span><span>01/?? Tập</span></a></li> <li><a href="/phim/chihayafuru-season-2-11.html" title="Chihayafuru - Season 2 (2013)"><span>Chihayafuru - Season 2 </span><span>25/25 Tập</span></a></li> <li><a href="/phim/rwby-red-white-black-yellow-4-10.html" title="Rwby Red White Black Yellow 4 (2016)"><span>Rwby Red White Black Yellow 4 </span><span>07/?? Tập</span></a></li> <li><a href="/phim/clione-no-akari-9.html" title="Clione No Akari (2017)"><span>Clione No Akari </span><span>12/12  Tập</span></a></li> <li><a href="/phim/steins-gate-movie-7.html" title="Steins Gate Movie (2013)"><span>Steins Gate Movie </span><span>01/01 Tập</span></a></li></ul>
      </ul>
   </section>
   <section class="Wdgt" id="showTopPhim">
      <div class="Title">HOT TUẦN
         <div class="Top">
            <a href="http://thuyduong.ga/bang-xep-hang/day.html" class="STPb Current" title="Anime bộ tuần hot" data-tag="phim-bo-hot">Ngày</a>
            <a href="http://thuyduong.ga/bang-xep-hang/week.html" class="STPb" title="Anime lẻ tuần hot" data-tag="phim-le-hot">Tuần</a>
            <a href="http://thuyduong.ga/bang-xep-hang/month.html" class="STPb"title="Anime lẻ tuần hot" data-tag="phim-le-hot">Tháng</a>
            <a href="http://thuyduong.ga/bang-xep-hang/year.html" class="STPb" title="Anime lẻ tuần hot" data-tag="phim-le-hot">Năm</a>
         </div>
      </div>
      <ul class="MovieList">
         <ul class="MovieList">
                            <li>
                           <div class="TPost A">
                              <a rel="bookmark" href="/phim/bay-vien-ngoc-rong-sieu-cap-1.html"> <span class="Top">#1<i></i></span>
                                 <div class="Image">
                                    <figure class="Objf TpMvPlay AAIco-play_arrow">
                                       <img width="55" height="85" src="https://upload.wikimedia.org/wikipedia/vi/thumb/4/4f/Dragon_Ball_Super_artwork.jpg/200px-Dragon_Ball_Super_artwork.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Bảy Viên Ngọc Rồng Siêu Cấp (2015)"></figure>
                                 </div>
                                 <div class="Title">Bảy Viên Ngọc Rồng Siêu Cấp</div>
                              </a>
                              <p class="Info">
                               <span class="Vote AAIco-star">8.3</span>
                               <span class="Time AAIco-access_time">22 phút </span> 
                               <span class="Date AAIco-date_range">2015</span> 
                               <span class="Qlty">HD</span></p>
                           </div>
                        </li>
                            <li>
                           <div class="TPost A">
                              <a rel="bookmark" href="/phim/absolute-boy-8.html"> <span class="Top">#2<i></i></span>
                                 <div class="Image">
                                    <figure class="Objf TpMvPlay AAIco-play_arrow">
                                       <img width="55" height="85" src="http://cdn.anivn.com/images/film/absolute-boy.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Absolute Boy (2013)"></figure>
                                 </div>
                                 <div class="Title">Absolute Boy</div>
                              </a>
                              <p class="Info">
                               <span class="Vote AAIco-star">7.1</span>
                               <span class="Time AAIco-access_time">22 phút </span> 
                               <span class="Date AAIco-date_range">2013</span> 
                               <span class="Qlty">HD</span></p>
                           </div>
                        </li>
                            <li>
                           <div class="TPost A">
                              <a rel="bookmark" href="/phim/byousoku-5-centimeter-16.html"> <span class="Top">#3<i></i></span>
                                 <div class="Image">
                                    <figure class="Objf TpMvPlay AAIco-play_arrow">
                                       <img width="55" height="85" src="http://cdn.anivn.com/images/film/byousoku-5-centimeter.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Byousoku 5 Centimeter (2007)"></figure>
                                 </div>
                                 <div class="Title">Byousoku 5 Centimeter</div>
                              </a>
                              <p class="Info">
                               <span class="Vote AAIco-star">9.3</span>
                               <span class="Time AAIco-access_time">90 phút</span> 
                               <span class="Date AAIco-date_range">2007</span> 
                               <span class="Qlty">HD</span></p>
                           </div>
                        </li>
                            <li>
                           <div class="TPost A">
                              <a rel="bookmark" href="/phim/rwby-red-white-black-yellow-4-10.html"> <span class="Top">#4<i></i></span>
                                 <div class="Image">
                                    <figure class="Objf TpMvPlay AAIco-play_arrow">
                                       <img width="55" height="85" src="http://cdn.anivn.com/images/film/red-white-black-yellow-4.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Rwby Red White Black Yellow 4 (2016)"></figure>
                                 </div>
                                 <div class="Title">Rwby Red White Black Yellow 4</div>
                              </a>
                              <p class="Info">
                               <span class="Vote AAIco-star">9</span>
                               <span class="Time AAIco-access_time">20 phút </span> 
                               <span class="Date AAIco-date_range">2016</span> 
                               <span class="Qlty"></span></p>
                           </div>
                        </li>
                            <li>
                           <div class="TPost A">
                              <a rel="bookmark" href="/phim/fate-kaleid-liner-prisma-illya-2wei-ss2-6.html"> <span class="Top">#5<i></i></span>
                                 <div class="Image">
                                    <figure class="Objf TpMvPlay AAIco-play_arrow">
                                       <img width="55" height="85" src="http://cdn.anivn.com/images/film/fatekaleid-liner-prisma-illya-2wei-herz.jpg" class="attachment-img-mov-sm size-img-mov-sm wp-post-image" alt="Fate Kaleid Liner Prisma Illya 2wei Ss2 (2015)"></figure>
                                 </div>
                                 <div class="Title">Fate Kaleid Liner Prisma Illya 2wei Ss2</div>
                              </a>
                              <p class="Info">
                               <span class="Vote AAIco-star">8</span>
                               <span class="Time AAIco-access_time">22 phút </span> 
                               <span class="Date AAIco-date_range">2015</span> 
                               <span class="Qlty">HD</span></p>
                           </div>
                        </li>
      					
 </ul>
      </ul>
   </section>
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
					   <a href="http://thuyduong.ga"title="Animet47.Net Xem Phim Nhanh, Xem Phim Online chất lượng cao miễn phí" rel="home">
						  <img title="Animet47.Net Xem Phim Nhanh, Xem Phim Online chất lượng cao miễn phí"src="http://thuyduong.ga/favicon.ico" alt="Animet47.Net Xem Phim Nhanh, Xem Phim Online chất lượng cao miễn phí">
					   </a>
					</figure>
					<div class="Rght">
					   <nav class="Menu">
						  <ul>
							 <li
								class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-490">
								<a href="http://thuyduong.ga">TRANG CHỦ</a></li>
							 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493"><a
								   href="http://thuyduong.ga/bai-viet/lien-he.html">LIÊN HỆ</a></li>
							 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493"><a
								   href="http://thuyduong.ga/bai-viet/yeu-cau-anime.html">YÊU CẦU ANIME</a></li>
							 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493"><a
								   href="http://thuyduong.ga/bai-viet/dmca.html">DMCA</a></li>
							 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493"><a
								   href="http://thuyduong.ga/bai-viet/dieu-khoan-su-dung.html">ĐIỀU KHOẢN SỬ
								   DỤNG</a></li>
						  </ul>
					   </nav>
					   <ul class="ListSocial">
						  <li>
							 <a target="_blank" href="https://facebook.com/" class="fa-facebook"></a>
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
<a href="http://thuyduong.ga/tag/one-piece.html" rel="nofollow" title="One piece"> #One piece</a>
<a href="http://thuyduong.ga/tag/gintama.html" rel="nofollow" title="Gintama"> #Gintama</a>
<a href="http://thuyduong.ga/tag/naruto.html" rel="nofollow" title="Naruto"> #Naruto</a>
<a href="http://thuyduong.ga/tag/boruto.html" rel="nofollow" title="Boruto"> #Boruto</a>
<a href="http://thuyduong.ga/tag/khach-san-huyen-bi.html" rel="nofollow" title="Khách sạn huyền bí"> #Khách sạn huyền bí</a>
<a href="http://thuyduong.ga/tag/sao.html" rel="nofollow" title="SAO"> #SAO</a>
<a href="http://thuyduong.ga/tag/dao-hai-tac.html" rel="nofollow" title="Đảo hải tặc"> #Đảo hải tặc</a>
		   </div>
		   <p class="Copy">
			  <a target="_blank" href="http://thuyduong.ga">Copyright ® 2019 HTAVN. All Rights Reserved. </a>
			  Mọi dữ liệu trên HTAVN đều được tổng hợp từ internet.
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
<div class="top-message"></div>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-68882454-10"></script>




<script>
    $(".filter-toggle").click(function(){$("#filter").toggleClass("active"),$(".filter-toggle").toggleClass("active")});
    function filterMovies() {
        var genres = [];
        $('.genre-ids:checked').each(function () {
            genres.push($(this).val());
        });
        if (genres.length > 0) {
            genres = genres.join('-');
        } else {
            genres = 'all';
        }
        
        var year = $('input[name=year]:checked').val();
        var season = $('input[name=season]:checked').val();
        var type = $('input[name=type]:checked').val();
        var url = '/danh-sach/' + type + '/' + 'latest' + '/' + genres + '/' + season + '/' + year;
        window.location.href = url;
    }
</script>
</body>
</html>



<? }else header('Location: '.$web_link.'/404'); }else header('Location: '.$web_link.'/404'); ?>