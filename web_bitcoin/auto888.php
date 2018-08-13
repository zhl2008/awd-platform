<?php
header("Content-Type: text/html; charset=UTF-8");
/* echo "success";
die(); */
$domain = "http://www.naztok.com";//填写网站域名
$queues = array(
    'admin/login/queue_3a32849e0c77173c325c72a3c2d7aa49',
    'home/Queue9ce2472db8c3b3d94511365004ce8468/chartb8c3b3d94512472db8',
    'home/Queue9ce2472db8c3b3d94511365004ce8468/tendencyb8c3b3d94512472db8',
    'home/Queue9ce2472db8c3b3d94511365004ce8468/houpriceb8c3b3d94512472db8',
    'home/Queue9ce2472db8c3b3d94511365004ce8468/qianbaob8c3b3d94512472db8',
    'home/Queue9ce2472db8c3b3d94511365004ce8468/marketandcoinb8c3b3d94512472db8',
);
for ($i = 0; $i < count($queues); $i++) {
    http_get($domain . "/" . $queues[$i]);
}
echo "success127.0.0.1";

file_put_contents(dirname(__FILE__)."\autoduilietime.html", date("Y-m-d H:i:s",time()));

echo "ok";
function http_get($url)
{
    $oCurl = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if (intval($aStatus["http_code"]) == 200) {
        return true;
    } else {
        return false;
    }
}


?>
