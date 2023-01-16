<?php 

echo<<<EOT
<center><form action="http://www.hihot.cn/qiguai/baidusearch.php" method="get">
				<input placeholder="搜索" class="soustxt" type="text" name="keyword" value="" required>
				<input type="submit" value="按钮" class="button">
			</form></center>
EOT;

$url="https://www.baidu.com/s?wd=".$_GET['keyword'];
$content=file_get_contents($url);
//将百度的搜索结果以div,id="content"开始，/div结束
$start=strpos($content,"<div id=\"content\"");
$end=strrpos($content,"/div>");
$content=substr($content,$start,$end-$start);
echo $content;

?>
