<?php
//转换到HTML
function converToHTML($a){
	$a = HTMLSpecialChars($a);
	$a = str_replace(" ","&nbsp;",$a);
	$a = nl2br($a);
	return $a;
}

//生成凭证号
function confirmNum($pre){
	return $pre . date("Ymd") . 
		(date("i")*100+date("s")*10+floor(microtime()*1000)) ;
}

//格式化钱币格式
function moneyFormat($m){
	$i = strpos($m, '.');
	if ($i === false) {
		return "{$m}.00";
	} else {
		return substr("{$m}00", 0, $i + 3);
	}
}

// 发送短信
function sendphone($message,$phone) {
	// 短信接口用户名 $uid
	$uid = 'wyp1688';
	// 短信接口密码 $passwd
	$passwd = 'zd4006262665';
	// 发送到的目标手机号码 $telphone
	if(strlen(trim($phone))>0){
		// 短信内容 $message
		//$message = iconv ( "utf-8", "gbk", $message );
		$gateway = "http://115.29.184.65:8081/sms.aspx?action=send&userid=1627&account=$uid&password=$passwd&mobile=$phone&content=$message&sendTime=&extno=";
		$result = file_get_contents ( $gateway );
		$xml = simplexml_load_string($result);
		$status =  (string) $xml->returnstatus;
		if (strtolower($status) == 'success') {
			return 1;
		} else {
			//echo "发送失败, 错误提示代码: " . $result;
			return 0;
		}
	}
}

?>