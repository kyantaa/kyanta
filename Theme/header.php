 <?php 
$datas = '';
		$datas .= Logged();
		;

echo $datas;
?>                      
 <nav class="Menu">
    <ul>
     <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-490"><a href="<?=$web_link;?>" title="<?=$web_title;?>">TRANG CHỦ</a></li>

   <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children"><a href="#">THỂ LOẠI</a>
     <ul class="sub-menu">                               
<?php
 $arr = $mysql->query("SELECT cat_name_key,cat_name FROM ".DATABASE_FX."cat WHERE cat_child = '0' AND cat_type = '0' ORDER BY cat_id ASC");
    while($row = $arr->fetch(PDO::FETCH_ASSOC)){
    $catKEY = $row['cat_name_key'];
    $catURL = $web_link.'/the-loai/'.$catKEY.'/';
    $catNAME = $row['cat_name'];    
                $data .='<li class="sub-menu-item"><a href="'.$catURL.'">'.$catNAME.'</a></li>';
    }   

    echo $data;
?>
    
</ul>
 </li>             
 <li id="menu-item-497" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-497"><a href="#">Season</a>
<ul class="sub-menu">
<li><a href="/season/winter/">Mùa Đông</a></li>
<li><a href="/season/spring/">Mùa Xuân</a></li>
<li><a href="/season/summer/">Mùa Hạ</a></li>
<li><a href="/season/autumn/">Mùa Thu</a></li>
</ul>
</li> 

<li id="menu-item-495" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-495"><a href="#">Năm Phát Hành</a>
<ul class="sub-menu">
<?php 
$curYear = date("Y");
for($i=$curYear;$i>=2008;$i--){
    $yearURL = $web_link.'/phim-'.$i.'/';   
    $year .= '<li><a href="'.$yearURL.'">Năm '.$i.'</a></li>';
}
    echo $year;
?>
</ul>
</li>



                            </ul>
                        </nav>