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
