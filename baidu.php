<?php
function doCurl($url, $data=array(), $header, $timeout=30){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

    $response = curl_exec($ch);
    if($error=curl_error($ch)){
        die($error);
    }

    curl_close($ch);

    return $response;
}

// 域名转换 因为默认是有些图片不显示 是因为域名不对
function cdomain($str){
    $baidu_domain = '{
        "http://graph.baidu.com": "https://sp0.baidu.com/-aYHfD0a2gU2pMbgoY3K",
        "http://p.qiao.baidu.com":"https://sp0.baidu.com/5PoXdTebKgQFm2e88IuM_a",
        "http://vse.baidu.com":"https://sp3.baidu.com/6qUDsjip0QIZ8tyhnq",
        "http://hdpreload.baidu.com":"https://sp3.baidu.com/7LAWfjuc_wUI8t7jm9iCKT-xh_",
        "http://lcr.open.baidu.com":"https://sp2.baidu.com/8LUYsjW91Qh3otqbppnN2DJv",
        "http://kankan.baidu.com":"https://sp3.baidu.com/7bM1dzeaKgQFm2e88IuM_a",
        "http://xapp.baidu.com":"https://sp2.baidu.com/yLMWfHSm2Q5IlBGlnYG",
        "http://dr.dh.baidu.com":"https://sp0.baidu.com/-KZ1aD0a2gU2pMbgoY3K",
        "http://xiaodu.baidu.com":"https://sp0.baidu.com/yLsHczq6KgQFm2e88IuM_a",
        "http://sensearch.baidu.com":"https://sp1.baidu.com/5b11fzupBgM18t7jm9iCKT-xh_",
        "http://s1.bdstatic.com":"https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K",
        "http://olime.baidu.com":"https://sp0.baidu.com/8bg4cTva2gU2pMbgoY3K",
        "http://app.baidu.com":"https://sp2.baidu.com/9_QWsjip0QIZ8tyhnq",
        "http://i.baidu.com":"https://sp0.baidu.com/74oIbT3kAMgDnd_",
        "http://c.baidu.com":"https://sp0.baidu.com/9foIbT3kAMgDnd_",
        "http://sclick.baidu.com":"https://sp0.baidu.com/5bU_dTmfKgQFm2e88IuM_a",
        "http://nsclick.baidu.com":"https://sp1.baidu.com/8qUJcD3n0sgCo2Kml5_Y_D3",
        "http://sestat.baidu.com":"https://sp1.baidu.com/5b1ZeDe5KgQFm2e88IuM_a",
        "http://eclick.baidu.com":"https://sp3.baidu.com/-0U_dTmfKgQFm2e88IuM_a",
        "http://api.map.baidu.com":"https://sp2.baidu.com/9_Q4sjOpB1gCo2Kml5_Y_D3",
        "http://ecma.bdimg.com":"https://ss1.bdstatic.com/-0U0bXSm1A5BphGlnYG",
        "http://ecmb.bdimg.com":"https://ss0.bdstatic.com/-0U0bnSm1A5BphGlnYG",
        "http://t1.baidu.com":"https://ss0.baidu.com/6ON1bjeh1BF3odCf",
        "http://t2.baidu.com":"https://ss1.baidu.com/6OZ1bjeh1BF3odCf",
        "http://t3.baidu.com":"https://ss2.baidu.com/6OV1bjeh1BF3odCf",
        "http://t10.baidu.com":"https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq",
        "http://t11.baidu.com":"https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq",
        "http://t12.baidu.com":"https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq",
        "http://i7.baidu.com":"https://ss0.baidu.com/73F1bjeh1BF3odCf",
        "http://i8.baidu.com":"https://ss0.baidu.com/73x1bjeh1BF3odCf",
        "http://i9.baidu.com":"https://ss0.baidu.com/73t1bjeh1BF3odCf",
        "http://b1.bdstatic.com":"https://ss0.bdstatic.com/9uN1bjq8AAUYm2zgoY3K",
        "http://ss.bdimg.com":"https://ss1.bdstatic.com/5aV1bjqh_Q23odCf",
        "http://opendata.baidu.com":"https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv",
        "http://api.open.baidu.com":"https://sp0.baidu.com/9_Q4sjW91Qh3otqbppnN2DJv",
        "http://tag.baidu.com":"https://sp1.baidu.com/6LMFsjip0QIZ8tyhnq",
        "http://f3.baidu.com":"https://sp2.baidu.com/-uV1bjeh1BF3odCf",
        "http://s.share.baidu.com":"https://sp0.baidu.com/5foZdDe71MgCo2Kml5_Y_D3",    
        "http://bdimg.share.baidu.com":"https://ss1.baidu.com/9rA4cT8aBw9FktbgoI7O1ygwehsv",
        "http://1.su.bdimg.com":"https://ss0.bdstatic.com/k4oZeXSm1A5BphGlnYG",
        "http://2.su.bdimg.com":"https://ss1.bdstatic.com/kvoZeXSm1A5BphGlnYG",
        "http://3.su.bdimg.com":"https://ss2.bdstatic.com/kfoZeXSm1A5BphGlnYG",
        "http://4.su.bdimg.com":"https://ss3.bdstatic.com/lPoZeXSm1A5BphGlnYG",
        "http://5.su.bdimg.com":"https://ss0.bdstatic.com/l4oZeXSm1A5BphGlnYG",
        "http://6.su.bdimg.com":"https://ss1.bdstatic.com/lvoZeXSm1A5BphGlnYG",
        "http://7.su.bdimg.com":"https://ss2.bdstatic.com/lfoZeXSm1A5BphGlnYG",
        "http://8.su.bdimg.com":"https://ss3.bdstatic.com/iPoZeXSm1A5BphGlnYG"
    }';

    $domain = json_decode($baidu_domain, true);
    foreach($domain as $k=>$v){
        $str = str_replace($k, $v, $str);
    }

    return $str;
}


$wd = '魔域';
$url = 'https://www.baidu.com/s?wd='.$wd;
$data = array();
$header = array();
$headers = {    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36 Edg/83.0.478.50',    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'};
$response = doCurl($url, $data, $headers, 5);
//echo cdomain($response); // 调用域名转换
echo $response;
?>

