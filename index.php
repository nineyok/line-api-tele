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

$id = $arrJson['events'][0]['source']['groupId'];

//if ($id == "C1687dfcb9fb7158edbaeffb34c7422e2"){
	
	if ($show == "$") {
    if ($idcard != "") {
		
	    $request = urlencode($idcard);
	    //$request1 = substr($request, 0, -9);
        //$urlWithoutProtocol = "http://vpn.idms.pw/id_pdc/select_bank.php?uid=".$request1."&aid=".$text_output[1];
		
        $urlWithoutProtocol = "http://vpn.idms.pw/id_pdc/select_emp.php?uid=" . $request;
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



	    $t_id = $arrbn_id[0];  //id
        $t_name = $arrbn_id[1]; //ชื่อ
        $t_nickname = $arrbn_id[2]; // ชื่อเล่น
        $t_tel = $arrbn_id[3]; // เบอร์โทร
        $t_add = $arrbn_id[4]; // ที่อยู่
        $t_emp = $arrbn_id[5]; // ประวัติการจับกุม
 
		
		
 if ($t_name != ""){      
        $arrPostData = array();
        $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
		$arrPostData['messages'][0]['type'] = "image";
        //$arrPostData['messages'][0]['originalContentUrl'] = "https://vpn.idms.pw/finger/img_body/".$request."-".$t_id."/".$request."-front.jpg";
		//"https://vpn.idms.pw/finger/img_body/".$request."-".$t_id."/".$request."-front.jpg"
        //$arrPostData['messages'][0]['previewImageUrl'] = "https://vpn.idms.pw/finger/img_body/".$request."-".$t_id."/".$request."-front.jpg";
		
		       $arrPostData['messages'][0]['originalContentUrl'] = "https://www.kitsada.com/pic/1329900209422.jpg";
               $arrPostData['messages'][0]['previewImageUrl'] = "https://www.kitsada.com/pic/1329900209422.jpg";
		
        //$arrPostData['messages'][0]['type'] = "text";
        //$arrPostData['messages'][0]['text'] = "เลขบัตร : ". $idcard . "\r\n"
		        //. "ชื่อ-สกุล : " . $t_name ."\r\n"
                //. "ชื่อเล่น : " . $t_nickname . "\r\n"
				//. "เบอร์โทร : " . $t_tel . "\r\n"
                //. "ที่อยู่ : " . $t_add . "\r\n"
				//. "". $t_emp;
	
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
//}
?>



