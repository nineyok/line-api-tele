<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '8KKXb09F/89lBzY8yOcgezFynxFDbM+/BnZ5bTyiS9Xj59zzXZkXPET6UUU0BSSWXiLMuGk5cq5ZcNSjpdHjWwQ2Q4WL0S/cHncmGWunRPaY0LR0eMANsa6DnpQx/rfsJk41tJekEghWP0X4a3tYuwdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'cb255ecf3182c1a87a5897fa791f5973';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

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
              "text"=> "View Details",
              "flex"=> 5,
              "size"=> "sm",
              "action"=> [
                "type"=> "uri",
                "label"=> "View Details",
                "uri"=> "https://www.google.co.th/maps/place/13.86767822,100.1506225"
              ]
            ]
          ]
        ]
        ]
      ]
    ]
  ];



if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {
        error_log(json_encode($event));
        $reply_message = '';
        $reply_token = $event['replyToken'];


        $data = [
            'replyToken' => $reply_token,
            'messages' => [$jsonFlex]
        ];

        print_r($data);

        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
        
    }
}

echo "OK";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
