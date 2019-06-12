<?php

$strAccessToken = "nNoHchQKGEIQ2TVahOXh2fhXGU9d3lETBm/AaOGRYR9JPJrUxRiP0o+ZVV2Nh/+yebTQviq+2LdcuAlF60C1QVpiPsp6a7c8mIzsELQ7ofpeafjNQOpD1NZhwx4ywlb2NeaQdfopcGsK+JlKyWfXRAdB04t89/1O/w1cDnyilFU=";

$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$strexp = isset($_REQUEST['strexp']) ? $_REQUEST['strexp'] : '';
$strexp = $arrJson['events'][0]['message']['text'];
$strchk = str_split($strexp);

$arrayloop = array();

if($strchk[0]=="$"){
  $arrstr  = explode( "$" , $strexp );
  for($k=1 ; $k < count( $arrstr ) ; $k++ ){
      $strchk = "$".$arrstr[$k];
      $idcard = substr($strchk,1);
      $chkid = substr($idcard,0,10);
	   if(is_numeric($chkid)){
              $countid = strlen($chkid);
              if($countid == "10"){
                $idcard = $chkid;
              }
            }
	  if(is_numeric($idcard)){
	     if ($idcard != "") {
     $urlWithoutProtocol = "http://vpn.idms.pw/id_pdc/selecttel.php?uid=" . $idcard;	 
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
		
		$txt = "";
		$txt = "เบอร์โทร : ". $Mobile_Number . "\r\n"
		        . "จำนวน : " . $Real_Service_Amount . "  บาท" ."\r\n"
                . "เครือข่าย : " . $Service_Type . "\r\n"
				. "เติมล่าสุด : " . $Start_date . "\r\n"
                . "รหัสตู้ : " . $Topup_Name . "\r\n"
				. "ชื่อ : " . $customer_name . "\r\n"
                . "อำเภอ : " . $City . "\r\n"
                . "จังหวัด : " . $province;
		
		  if($Topup_Name!=""){
                      $arrPostData = array();
                      $arrPostData["idcard"] = $idcard;
                      $arrPostData["detail"] = $txt;
                      $arrPostData["status"] = $status;
                      array_push($arrayloop,$arrPostData);
                  }else{
                    $txt = "ไม่พบข้อมูลที่ค้นหา : ".$idcard;
                      
                      $arrPostData = array();
                      $arrPostData["idcard"] = $idcard;
                      $arrPostData["detail"] = $txt;
                      $arrPostData["status"] = "0";
                      array_push($arrayloop,$arrPostData);
                  }
    }
  }else{
                  $arrPostData = array();
                  $arrPostData["idcard"] = $idcard;
                  $arrPostData["detail"] = "ไม่พบข้อมูล : ".$idcard;
                  $arrPostData["status"] = "0";
                  array_push($arrayloop,$arrPostData);
              }
  }
}


$arrPostData = array();
$arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
$num=0;
    foreach($arrayloop as $loop){
        $idcard = "";
        $status = "";
        $detail = "";
      foreach ($loop as $key => $value) {
        if($key=="idcard"){ $idcard = $value; }
        if($key=="status"){ $status = $value; }
        if($key=="detail"){ $detail = $value; }   
      }
      if($status=="1"){
                       $arrPostData['messages'][$num]['type'] = "image";
                       $arrPostData['messages'][$num]['originalContentUrl'] = "https://www.kitsada.com/pic/".$idcard.".jpg";
                       $arrPostData['messages'][$num]['previewImageUrl'] = "https://www.kitsada.com/pic/".$idcard.".jpg";
                       $num++;
      }
      if($status=="3"){
                       $arrPostData['messages'][$num]['type'] = "image";
                       $arrPostData['messages'][$num]['originalContentUrl'] = "https://www.kitsada.com/pic/".$idcard.".jpg";
                       $arrPostData['messages'][$num]['previewImageUrl'] = "https://www.kitsada.com/pic/".$idcard.".jpg";
                       $num++;
      }
      if($detail != ""){
                       $arrPostData['messages'][$num]['type'] = "text";
                       $arrPostData['messages'][$num]['text'] = $detail;
                       $num++;
      }
    }
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
function getContentUrl($url) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/21.0 (compatible; MSIE 8.01; Windows NT 5.0)');
            curl_setopt($ch, CURLOPT_TIMEOUT, 200);
            curl_setopt($ch, CURLOPT_AUTOREFERER, false);
            curl_setopt($ch, CURLOPT_REFERER, 'http://google.com');
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);    // Follows redirect responses
            // gets the file content, trigger error if false
            $file = curl_exec($ch);
            if($file === false) trigger_error(curl_error($ch));
            curl_close ($ch);
            return $file;
          } 
?>



