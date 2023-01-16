<?php

 //接收内容
$urrl=$_SERVER['QUERY_STRING'];
$ua = parse_url($urrl);
$searchkeyword = $ua[path];
$searchkeyword = urldecode($searchkeyword);
$de="words=";
$searchkeyword=str_replace($de,"",$searchkeyword);


if($searchkeyword==" "){
$searchkeyword = $_GET["souname"];
}

//rsstojson
include ("./rsstojson.php");
include ("./rssyan.php");

//随机颜色
function randColor(){

$colors = array();

for($i = 0;$i<6;$i++){

$colors[] = dechex(rand(0,15));

}

return implode('',$colors);

}

//转码

function decodeUnicode($str)

{

return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',

create_function(

'$matches',

'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'

),

$str);

}


//sql查库
function sou($searchkeyword) { 
include ("sqlcon.php");
$sql  = "select id,name,jsonurl,url,type,times,sign from urltablefirst"; 
$result = mysqli_query($conn,$sql);
$m=mysqli_num_rows($result);
$data=[];
   //获取所有行作为数组
    for($i=0;$i<=$m;$i++){
   $sqlu="select * from urltittle where id = $i";
   $results=mysqli_query($conn,$sqlu);
     $row = mysqli_fetch_assoc($results);       
  
	  $name=$row["sitename"];
      $sitedescription=$row["sitedescription"];
      $siteurl=$row["siteurl"];
      $sitetype=$row["sitetype"];
      $updatatime=$row["updatatime"];
	  $lastBuildDate=$row["lastBuildDate"];
	  if($row["tittle"]){
	  $tittle=$row["tittle"];
	  }else{
	  $tittle=$sitedescription;
	  }
	  if($row["description"]){
	  $description=$row["description"];
	  }else{
	  $description=$tittle;
	  }
	  $link=$row["link"];
	  $pubDate=$row["pubDate"];
	  $helpful=$row["helpful"];
	  $statue=$row["statue"];
	  
	  //search顺序  文章内容 文章标题  站点描述 站点名字
	  if($description){
	   if(strstr($description,$searchkeyword)){
	  $giveup="?from=rss";
	  if(strstr($link,$giveup)){
	  $url=str_ireplace($giveup," ",$link);
	  }else{
	  
	  $url=$url;
	  	 }
	$redkeywords="<b><font size=5 color=#ff0000>".$searchkeyword."</font></b>";
    $searchresultsf = preg_replace("/$searchkeyword/",$redkeywords,$description);
	$data[$sign][$geshi]="<font size=5 color=#".randColor().">来自rss结果</font>";;
	 $data[$sign][$i]="<br><br><a href=".$url.">".$url."</a><br><a href=".$url.">".$name."</a><br><br>".$searchresultsf."<br><br>";
	  }
	  
	  }elseif($tittle){

	  //search 文章标题
	  if(strstr($tittle,$searchkeyword)){
	  $giveup="?from=rss";
	  if(strstr($link,$giveup)){
	  $url=str_ireplace($giveup," ",$url);
	  }else{
	  
	  $url=$url;
	  	 }
	$redkeywords="<b><font size=5 color=#ff0000>".$searchkeyword."</font></b>";
    $searchresultsf = preg_replace("/$searchkeyword/",$redkeywords,$tittle);
	$data[$sign][$geshi]="<font size=5 color=#".randColor().">来自rss结果</font>";;
	 $data[$sign][$i]="<br><br><a href=".$url.">".$url."</a><br><a href=".$url.">".$name."</a><br><br>".$searchresultsf."<br><br>";
	  }
	 
	 }elseif($sitedescription){ 
	 
	  if($sitedescription!==$name){
	  //search 站点描述
	  if(strstr($sitedescription,$searchkeyword)){
	  $giveup="?from=rss";
	  if(strstr($siteurl,$giveup)){
	  $url=str_ireplace($giveup," ",$url);
	  }else{
	  
	  $url=$url;
	  	 }
	$redkeywords="<b><font size=5 color=#ff0000>".$searchkeyword."</font></b>";
    $searchresultsf = preg_replace("/$searchkeyword/",$redkeywords,$sitedescription);
	$data[$sign][$geshi]="<font size=5 color=#".randColor().">来自rss结果</font>";;
	 $data[$sign][$i]="<br><br><a href=".$url.">".$url."</a><br><a href=".$url.">".$name."</a><br><br>".$searchresultsf."<br><br>";
	  }
	  
	  //search 站点名字
	  if(strstr($name,$searchkeyword)){
	  $giveup="?from=rss";
	  if(strstr($siteurl,$giveup)){
	  $url=str_ireplace($giveup," ",$url);
	  }else{
	  
	  $url=$url;
	  	 }
	$redkeywords="<b><font size=5 color=#ff0000>".$searchkeyword."</font></b>";
    $searchresultsf = preg_replace("/$searchkeyword/",$redkeywords,$name);
	$data[$sign][$geshi]="<font size=5 color=#".randColor().">来自rss结果</font>";;
	 $data[$sign][$i]="<br><br><a href=".$url.">".$url."</a><br><a href=".$url.">".$name."</a><br><br>".$searchresultsf."<br><br>";
	  }
	  }esle{
	  //search 站点名字
	  if(strstr($name,$searchkeyword)){
	  $giveup="?from=rss";
	  if(strstr($siteurl,$giveup)){
	  $url=str_ireplace($giveup," ",$url);
	  }else{
	  
	  $url=$url;
	  	 }
	$redkeywords="<b><font size=5 color=#ff0000>".$searchkeyword."</font></b>";
    $searchresultsf = preg_replace("/$searchkeyword/",$redkeywords,$name);
	$data[$sign][$geshi]="<font size=5 color=#".randColor().">来自rss结果</font>";;
	 $data[$sign][$i]="<br><br><a href=".$url.">".$url."</a><br><a href=".$url.">".$name."</a><br><br>".$searchresultsf."<br><br>";
	  }
	   }
	   }else{
	   $data[$sign][$i]=“<center>没有搜到结果</center>”;
	   }
	
	}
return $data; 
}
echo<<<EOT
<center><form action="http://www.hihot.cn/qiguai/searchwords.php?" method="get">
				<input placeholder="搜索" class="soustxt" type="text" name="words" value="" required>
				<input type="submit" value="按钮" class="button">
			</form></center>
EOT;
if(sou($searchkeyword) != null){
echo <<<EOF
<!DOCTYPE html>
<html lang="en">
<head><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body>
EOF;
echo "<center>您搜索的关键字<b><font size=9 color=#ff0000> $searchkeyword </font></b>查找到以下页面<br></center>";
foreach (sou($searchkeyword)as $keys=>$values ){
foreach ($values as $key=>$value ){

if($value){
$n=1;
$n=$n+1;
echo "<center>".$value."<hr></center>";
}
}
}
}else{
echo "<center>没有搜到结果</center>";
}

   //结束语句
    mysqli_free_result($result);
   mysqli_free_result($results);

   //关闭连接
   mysqli_close($conn);



?>
