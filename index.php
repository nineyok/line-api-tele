<?php

$strAccessToken = "8KKXb09F/89lBzY8yOcgezFynxFDbM+/BnZ5bTyiS9Xj59zzXZkXPET6UUU0BSSWXiLMuGk5cq5ZcNSjpdHjWwQ2Q4WL0S/cHncmGWunRPaY0LR0eMANsa6DnpQx/rfsJk41tJekEghWP0X4a3tYuwdB04t89/1O/w1cDnyilFU=";

$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);

$strUrl = "https://api.line.me/v2/bot/message/reply";

$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";

$show = substr($arrJson['events'][0]['message']['text'], 0, 1);
$idcard = substr($arrJson['events'][0]['message']['text'], 1);
if ($show == "$") {
    if ($idcard != "") {
        $urlWithoutProtocol = "http://shark.mazcat.in:8888/bt/selecttel.php?uid=" . $idcard;
        $isRequestHeader = FALSE;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlWithoutProtocol);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $productivity = curl_exec($ch);
        curl_close($ch);
        //$json_a = json_decode($productivity, true);
        $arrbn_id = explode("#", $productivity);
        //print_r($arrbn_id);
//        if (is_numeric(substr($arrbn_id[0], 0, 1))) {

//        echo $objResult["customer_name"];
//        echo "#" . $objResult["Latitude"];
//        echo "#" . $objResult["Longitude"];
//        echo "#" . $objResult["province"];
//        echo "#" . $objResult["contact_tel"];



        $Mobile_Number = $arrbn_id[0]; //เบอร์โทร
	    $Service_Type = $arrbn_id[1]; //เครือข่าย
        $Start_date = $arrbn_id[2]; // วันที่
		$Real_Service_Amount = $arrbn_id[3];  //จำนวนเงิน
        $Topup_Name = $arrbn_id[4]; // รหัสตู้
		$City = $arrbn_id[5]; // อำเภอ
		$province = $arrbn_id[6]; // จังหวัด		
        $customer_name = $arrbn_id[7]; // ชื่อ		
 
 if ($Topup_Name != ""){      
        $arrPostData = array();
                $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
        $arrPostData['messages'][0]['type'] = "text";
        $arrPostData['messages'][0]['text'] = "เบอร์โทร : ". $Mobile_Number . "\r\n"
		        . "จำนวน : " . $Real_Service_Amount . "  บาท" ."\r\n"
                . "เครือข่าย : " . $Service_Type . "\r\n"
				. "เติมล่าสุด : " . $Start_date . "\r\n"
                . "รหัสตู้ : " . $Topup_Name . "\r\n"
				. "ชื่อ : " . $customer_name . "\r\n"
                . "อำเภอ : " . $City . "\r\n"
                . "จังหวัด : " . $province;
	
}else{
     $arrPostData = array();
      $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
      $arrPostData['messages'][0]['type'] = "text";
      $arrPostData['messages'][0]['text'] = "ไม่พบข้อมูล : ". $idcard ; 	
	
}
       
        //print_r($productivity);
//        }
        //$json_a = json_decode($productivity, true);
        //echo $productivity ;
    }
} else {
     //$arrPostData = array();
      //$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
      //$arrPostData['messages'][0]['type'] = "text";
      //$arrPostData['messages'][0]['text'] = "ข้อความไม่ถูกต้อง กรุณากรอกเป็นแบบนี้ (ตัวอย่าง เบอร์โทร #0123456789)"; 
}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
?>



