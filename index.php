<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '8KKXb09F/89lBzY8yOcgezFynxFDbM+/BnZ5bTyiS9Xj59zzXZkXPET6UUU0BSSWXiLMuGk5cq5ZcNSjpdHjWwQ2Q4WL0S/cHncmGWunRPaY0LR0eMANsa6DnpQx/rfsJk41tJekEghWP0X4a3tYuwdB04t89/1O/w1cDnyilFU='; 
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
$strexp = isset($_REQUEST['strexp']) ? $_REQUEST['strexp'] : '';
$strexp = $request_array['events'][0]['message']['text'];
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
	  
	  
$txt = [
    "type" => "flex",
    "altText" => "Result",
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
                  "text"=> $Mobile_Number,
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
                  "text"=> $Real_Service_Amount." บาท",
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
                  "text"=> $Service_Type,
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
                  "text"=> $Start_date,
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
                  "text"=> $Topup_Name,
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
                  "text"=> $customer_name,
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
              "text"=> $addresscustomer,
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
                "uri"=> "https://www.google.co.th/maps/place/".$latitude.",".$longitude.""
              ]
            ]
          ]
        ]
        ]
      ]
    ]
  ];
  
  if($Topup_Name!=""){
                      $arrPostData = array();
                      //$arrPostData["idcard"] = $idcard;
                      $arrPostData["detail"] = $txt;
                      //$arrPostData["status"] = $status;
                      array_push($arrayloop,$arrPostData);
                  }else{			
					$txt = [
    "type" => "flex",
    "altText" => "Result",
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
                  "text"=> "ไม่พบข้อมูลที่ค้นหา",
                  "flex"=> 3,
                  "size"=> "sm",
                  "weight"=> "bold",
                  "color"=> "#FF0000"
              ],
                [
                  "type"=> "text",
                  "text"=> $idcard,
                  "flex"=> 3,
                  "size"=> "sm",
                  "wrap"=> true
                ]
				  ]
				  ]
				  ]
				  ]
				  ]
				  ];
                      
                      $arrPostData = array();
                      //$arrPostData["idcard"] = $idcard;
                      $arrPostData["detail"] = $txt;
                      //$arrPostData["status"] = "0";
                      array_push($arrayloop,$arrPostData);
                  }
    }
  }else{
	  
	  $txt = [
    "type" => "flex",
    "altText" => "Result",
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
                  "text"=> "ไม่พบข้อมูลที่ค้นหา : ".$idcard,
                  "flex"=> 3,
                  "size"=> "sm",
                  "weight"=> "bold",
                  "color"=> "#FF0000"
              ]
				  ]
				  ]
				  ]
				  ]
				  ]
				  ];
	  
                  $arrPostData = array();
                  //$arrPostData["idcard"] = $idcard;
                  $arrPostData["detail"] = $txt;
                  //$arrPostData["status"] = "0";
                  array_push($arrayloop,$arrPostData);
              }
  }
}
$arrPostData = array();
$arrPostData['replyToken'] = $request_array['events'][0]['replyToken'];
$num=0;
    foreach($arrayloop as $loop){
	$detail = "";
	  foreach ($loop as $key => $value) {
        if($key=="detail"){ $detail = $value; }   
      }
  if($detail != ""){
                $arrPostData['messages'][$num] = $detail;                     
                $num++;
  }
	}
$send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $arrPostData);
function send_reply_message($url, $post_header, $arrPostData)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
?>
