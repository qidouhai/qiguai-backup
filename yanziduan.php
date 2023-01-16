<?php
echo<<<EOT
<head><meta name="viewport"
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"></head>
<center><form action="http://www.hihot.cn/qiguai/yanziduan.php" method="post">
				<input placeholder="搜索" class="soustxt" type="text" name="yanziduan" value="" required>
				<input type="submit" value="按钮" class="button">
			</form></center>
EOT;
$url=$_POST['yanziduan'];
$jsonurl = $url;

//rsstojson
include ("./rsstojson.php");
include ("./rssyan.php");

	  //rss 判断
	  $yanzhengrss = analyrss($jsonurl);
	  
	  if( $yanzhengrss !==5){
	  $arr=rsstojson($jsonurl);  //rss 转json
	  //$arr=htmlspecialchars_decode($arr);
	  //$arr=strip_tags($arr);
	  $arr= json_decode($arr,true); 
	  foreach($arr as $key=>$value){
	  $title=$value[title];
	  
	  //$description 过滤rsshub 内容
	  $description=$value[description];
		if($description){
			$hub=" - Made with love by RSSHub(https://github.com/DIYgod/RSSHub)";
			if(strstr($description,$hub)){
		$description=str_replace($hub,"",$description);
							}else{
	  $description=$description;
							}
	  }else{
	  $description=$value[description];
	  	 }
	  
	  $lastBuildDate=$value[lastBuildDate];
	
	  foreach($value[item] as $key=>$values){
	  $searchresultsf = trim($values[title]);
	  $quxiexian="\\";
	  if(strstr($searchresultsf,$quxiexian)){
	  $searchresultsf=str_replace($quxiexian,"",$searchresultsf);
	   $searchresultsf = trim($searchresultsf);
	   }
	   
	  $guiurl=trim($values[link]);
	  if(strstr($guiurl,$quxiexian)){
	  $guiurl=str_replace($quxiexian,"",$guiurl);
	  $guiurl=trim($guiurl);
	  }
	  
	  //空格 链接 非中文过滤
	  if($values[description]){
	  $itemdescription=$values[description];
	  $itemdescription=str_replace("/<a[^>]+href=\"(.*?)\"[^>]+data-poster=\"(.*?)\"[^>]*>.*?<\/a>/is"," ",$itemdescription);
	  $itemdescription=strip_tags($itemdescription);
	  $itemdescription=preg_replace("/[^\x{4E00}-\x{9FFF}]+/u"," ",$itemdescription);
	  }else{
	  $itemdescription=$values[description];
	  $itemdescription=str_replace("/<a[^>]+href=\"(.*?)\"[^>]+data-poster=\"(.*?)\"[^>]*>.*?<\/a>/is"," ",$itemdescription);
	  $itemdescription=preg_replace("/[^\x{4E00}-\x{9FFF}]+/u"," ",$itemdescription);
	  $itemdescription=strip_tags($itemdescription);

	  }
	  $itempubDate=$values[pubDate];
	  $giveup="?from=rss";
	  if($guiurl){
	  if(strstr($guiurl,$giveup)){
	  $guiurl=str_ireplace($giveup," ",$guiurl);
	  }else{
	  $guiurl=$guiurl;
 	 }
	 }else{
		  $guiurl=$url;
		 }
		 date_default_timezone_set("Asia/Shanghai");
		 $newthistime=time();
		
		 	 }
	 }
	 }

echo "<hr>";
   echo '1'.$title.'<br>';
		 echo '2'.$description.'<br>';
		 echo '3'.$url.'<br>';
		 echo '4'.$type.'<br>';
		 
		 echo '6'.$lastBuildDate.'<br>';
		 echo '7'.$searchresultsf.'<br>';
		 echo '8'.$itemdescription.'<br>';
		 echo '9'.$guiurl.'<br>';
		 echo '10'.$itempubDate.'<br>';
		 echo 'time():'.time().'<br>';
		echo $lastBuildDate = time($lastBuildDate);
		echo $itempubDate = time(itempubDate);


?>
