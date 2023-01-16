<?php
echo<<<EOT
<center><form action="http://www.hihot.cn/qiguai/urlyan.php" method="post">
				<input placeholder="搜索" class="soustxt" type="text" name="urlyan" value="" required>
				<input type="submit" value="按钮" class="button">
			</form></center>
EOT;
$url=$_POST['urlyan'];
//url验证
//$url = $_POST["upjson"];
//1 地址接近正确
//2 url 地址不正确
function or_url($url){
if (filter_var($url, FILTER_VALIDATE_URL) !== false) {

return 1;
}else{

return 2;
}

}

echo $urlzhuangtai_1=or_url($url);<br>
echo "1 为 正确 ， 2为错误";
?>
