<?php

$strAccessToken = "8KKXb09F/89lBzY8yOcgezFynxFDbM+/BnZ5bTyiS9Xj59zzXZkXPET6UUU0BSSWXiLMuGk5cq5ZcNSjpdHjWwQ2Q4WL0S/cHncmGWunRPaY0LR0eMANsa6DnpQx/rfsJk41tJekEghWP0X4a3tYuwdB04t89/1O/w1cDnyilFU=";

$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$strexp = isset($_REQUEST['strexp']) ? $_REQUEST['strexp'] : '';
$strexp = $arrJson['events'][0]['message']['text'];

   $id = $arrJson['events'][0]['source']['groupId'];
   
   //if ($id == "Cc7400808e50a43c67c8672750581723b") {

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
     $urlWithoutProtocol = "http://vpn.idms.pw/id_pdc/selecttel.php?uid=".$idcard;	 
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
        $Topup_Name = substr($arrbn_id[4], 2); // รหัสตู้
		$customer_name = $arrbn_id[5]; // ชื่อ
		$latitude = $arrbn_id[6]; // lat
		$longitude = $arrbn_id[7]; // lon
        $addresscustomer = $arrbn_id[8]; // ที่อยู่		
       
		
		$txt = "";
		$txt = "เบอร์โทร : ". $Mobile_Number . "\r\n"
		        . "จำนวน : " . $Real_Service_Amount . "  บาท" ."\r\n"
                . "เครือข่าย : " . $Service_Type . "\r\n"
				. "เติมล่าสุด : " . $Start_date . "\r\n"
                . "รหัส : " . $Topup_Name . "\r\n"
				. "ชื่อ : " . $customer_name . "\r\n"
                . "ที่อยู่ : " . $addresscustomer . "\r\n"
                . "พิกัด : https://www.google.co.th/maps/place/".$latitude.",".$longitude;
		
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
		  
		  $jsonFlex = [
    "type" => "flex",
    "altText" => "Hello Flex Message",
    "contents" => [
      "type" => "bubble",
      "direction" => "ltr",
      "body" => [
        "type" => "box",
        "layout" => "vertical",
        "contents" => [
           [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "sm",
            "contents" => [
              [
                  "type"=> "text",
                  "text"=> "เบอร์โทร",
                  "flex"=> 3,
                  "size"=> "sm",
                  "weight"=> "bold",
                  "color"=> "#FF0000"
              ],
              [
                  "type"=> "text",
                  "text"=> "0983628932",
                  "flex"=> 5,
                  "size"=> "sm",
                  "wrap"=> true
              ]
            ]
          ],
          [
            "type" => "box",
            "layout" => "baseline",
            "margin" => "sm",
            "contents" => [
              [
                  "type"=> "text",
                  "text"=> "จำนวน",
                  "flex"=> 3,
                  "size"=> "sm",
                  "weight"=> "bold",
                  "color"=> "#FF0000"
              ],
              [
                  "type"=> "text",
                  "text"=> "20.00 บาท",
                  "flex"=> 5,
                  "size"=> "sm",
                  "wrap"=> true
              ]
            ]
          ],
            [
              "type"=> "box",
              "layout"=> "baseline",
              "spacing"=> "sm",
              "contents"=> [
                [
                  "type"=> "text",
                  "text"=> "เครือข่าย",
                  "flex"=> 3,
                  "size"=> "sm",
                  "weight"=> "bold",
                  "color"=> "#FF0000"
                ],
                [
                  "type"=> "text",
                  "text"=> "TRUE",
                  "flex"=> 5,
                  "size"=> "sm",
                  "wrap"=> true
                ]
              ]
            ],
            [
              "type"=> "box",
              "layout"=> "baseline",
              "spacing"=> "sm",
              "contents"=> [
                [
                  "type"=> "text",
                  "text"=> "เติมล่าสุด",
                  "flex"=> 3,
                  "size"=> "sm",
                  "weight"=> "bold",
                  "color"=> "#FF0000"
                ],
                [
                  "type"=> "text",
                  "text"=> "20-06-2019 05:10:21",
                  "flex"=> 5,
                  "size"=> "sm",
                  "wrap"=> true
                ]
              ]
            ],
            [
              "type"=> "box",
              "layout"=> "baseline",
              "spacing"=> "sm",
              "contents"=> [
                [
                  "type"=> "text",
                  "text"=> "รหัส",
                  "flex"=> 3,
                  "size"=> "sm",
                  "weight"=> "bold",
                  "color"=> "#FF0000"
                ],
                [
                  "type"=> "text",
                  "text"=> "118157",
                  "flex"=> 5,
                  "size"=> "sm",
                  "wrap"=> true
                ]
              ]
            ],
            [
              "type"=> "box",
              "layout"=> "baseline",
              "spacing"=> "sm",
              "contents"=> [
                [
                  "type"=> "text",
                  "text"=> "ชื่อ",
                  "flex"=> 3,
                  "size"=> "sm",
                  "weight"=> "bold",
                  "color"=> "#FF0000",
                ],
                [
                  "type"=> "text",
                  "text"=> "กนกวรรณ งามเสมอ",
                  "flex"=> 5,
                  "size"=> "sm",
                  "wrap"=> true
                ]
             ]
        ],
        [
          "type"=> "box",
          "layout"=> "baseline",
          "spacing"=> "sm",
          "contents"=> [
            [
              "type"=> "text",
              "text"=> "ที่อยู่",
              "flex"=> 3,
              "size"=> "sm",
              "weight"=> "bold",
              "color"=> "#FF0000"
            ],
            [
              "type"=> "text",
              "text"=> "39/2 ม.7  ต.แหลมบัว อ.นครชัยศรี จ.นครปฐม",
              "flex"=> 5,
              "size"=> "sm",
              "wrap"=> true
            ]
          ]
        ],
        [
          "type"=> "box",
          "layout"=> "baseline",
          "spacing"=> "sm",
          "contents"=> [
            [
              "type"=> "text",
              "text"=> "พิกัด",
              "flex"=> 3,
              "size"=> "sm",
              "weight"=> "bold",
              "color"=> "#FF0000"
            ],
            [
              "type"=> "text",
              "text"=> "Location",
              "flex"=> 5,
              "size"=> "sm",
			  "color" => "#0084B6",
              "action"=> [
                "type"=> "uri",
                "label"=> "Location",
                "uri"=> "https://www.google.co.th/maps/place/13.86767822,100.1506225"
              ]
            ]
          ]
        ]
        ]
      ]
    ]
  ];
		   $arrPostData['messages'][$num][$jsonFlex];
/*                        $arrPostData['messages'][$num]['type'] = "text";
                       $arrPostData['messages'][$num]['text'] = $detail; */
                       $num++;
      }
    }
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData, JSON_UNESCAPED_UNICODE));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
//}
?>



