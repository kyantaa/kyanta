<?php 

    $arr = $cf_tags;

	$text	=	str_replace(",  ",",",$arr);

	$text	=	str_replace(", ",",",$arr);

	$tags = explode(',',$text);

    for($i=0;$i<=count($tags)-1;$i++){

	$tagcloud = $tags[$i];

	$tagsz = str_replace(' ','-',$tagcloud);

	$TagsURL = $web_link.'/tag/'.$tagsz.'/';

?>
<a href="<?=$TagsURL;?>" rel="nofollow" title="<?=$tagcloud;?>"> #<?=$tagcloud;?></a>


<?	}  ?>