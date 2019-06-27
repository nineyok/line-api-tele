<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '8KKXb09F/89lBzY8yOcgezFynxFDbM+/BnZ5bTyiS9Xj59zzXZkXPET6UUU0BSSWXiLMuGk5cq5ZcNSjpdHjWwQ2Q4WL0S/cHncmGWunRPaY0LR0eMANsa6DnpQx/rfsJk41tJekEghWP0X4a3tYuwdB04t89/1O/w1cDnyilFU='; 
//$channelSecret = 'cb255ecf3182c1a87a5897fa791f5973';


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
    $arrPostData = array();
    $arrPostData["detail"] = $jsonFlex;
array_push($arrayloop,$arrPostData);
  }
}
$event = $request_array['events'][0]['replyToken'];
$num=0;
    foreach($arrayloop as $loop){
//if ( sizeof($request_array['events']) > 0 ) {
	$data = "";
	//$reply_message = "";
	//$reply_token = "";
	//$post_body = "";
	$send_result = "";
	$detail = "";
	  foreach ($loop as $key => $value) {
        if($key=="detail"){ $detail = $value; }   
      }
    //foreach ($request_array['events'] as $event) {
        //error_log(json_encode($event));
        //$reply_message = '';
        //$reply_token = $event['replyToken'];

  if($detail != ""){
        //$data = [
            //'replyToken' => $reply_token,
			//'replyToken' => $event,
            //'messages' => [$detail]
        //];

        //print_r($data);
		
		     /*           $arrPostData['messages'][$num]['type'] = "text";
                       $arrPostData['messages'][$num]['text'] = $detail; */
		
		        $arrPostData['replyToken'][$num] = $event;
                $arrPostData['messages'][$num] = [$detail];
                

        //$arrPostData = json_encode($data, JSON_UNESCAPED_UNICODE);

        $num++;
        //echo "Result: ".$send_result."\r\n";
  }
    //}
//}
	}
//echo "OK";
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
