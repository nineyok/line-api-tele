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
		
	    $request = urlencode($idcard);
	    $request1 = substr($request, 0, -9);
        //$urlWithoutProtocol = "http://vpn.idms.pw/id_pdc/select_bank.php?uid=".$request1."&aid=".$text_output[1];
		
        $urlWithoutProtocol = "http://vpn.idms.pw/id_pdc/select_prison.php?uid=" . $request1;
        $isRequestHeader = FALSE;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlWithoutProtocol);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $productivity = curl_exec($ch);
        curl_close($ch);
        //$json_a = json_decode($productivity, true);
        $arrbn_id = explode("$", $productivity);
        //print_r($arrbn_id);
//        if (is_numeric(substr($arrbn_id[0], 0, 1))) {

//        echo $objResult["customer_name"];
//        echo "#" . $objResult["Latitude"];
//        echo "#" . $objResult["Longitude"];
//        echo "#" . $objResult["province"];
//        echo "#" . $objResult["contact_tel"];



	 $t_register = $arrbn_id[0];  //ทะเบียน
        $t_nature = $arrbn_id[1]; //ลักษณะ
        $t_brand = $arrbn_id[2]; // ยี่ห้อ
        $t_model = $arrbn_id[3]; // โมเดล
        $t_color = $arrbn_id[4]; // สี
        $t_numcar = $arrbn_id[5]; // เลขรถ
        $t_nummac = $arrbn_id[6]; // เลขเครื่อง
        $t_name = $arrbn_id[7]; // ชื่อ
		$t_numid = $arrbn_id[8]; // เลขบัตร
        $t_add = $arrbn_id[9]; // ที่อยู่
		
		
 if ($Topup_Name != ""){      
        $arrPostData = array();
                $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
        $arrPostData['messages'][0]['type'] = "text";
        $arrPostData['messages'][0]['text'] = "คำค้น : ". $idcard . "\r\n"
		        . "หมายเลขทะเบียน : " . $t_register ."\r\n"
                . "ลักษณะ : " . $t_nature . "\r\n"
				. "ยี่ห้อ : " . $t_brand . "\r\n"
                . "model : " . $t_model . "\r\n"
				. "สี : " . $t_color . "\r\n"
                . "เลขตัวรถ : " . $t_numcar . "\r\n"
				. "เลขเครื่องยนต์ : " . $t_nummac . "\r\n"
				. "ผู้ครอบครอง : " . $t_name . "\r\n"
				. "เลขบัตร : " . $t_numid . "\r\n"
                . "ที่อยู่ : " . $t_add ;
	
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



