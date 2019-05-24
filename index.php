<?php
//database
$conn_string = "host=ec2-54-163-233-201.compute-1.amazonaws.com port=5432 dbname=dchdrsngrf50pd user=njppbbukwreesq password=c6b890bd6e0dccc4a5db3308869ba5e2735fe0e5df7a3f0de6f114cc24752e04";
$dbconn = pg_pconnect($conn_string);
//
$access_token = 'GKg1wAZ/gjMr6yh3dGmPjuq8HnkDQEZsOdPEfyur3h7JmjdT2JihbEBHL6S4BrLnHCuu0Cv2fSbvwv0/xZqYw+TEjmmqW2mjC5NB9BcVGguZq3CIHX+Vt+fvPcNwtcT2ER0LLVXSwhNN4aVJT0Q08QdB04t89/1O/w1cDnyilFU=';
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

$_msg = $events['events'][0]['message']['text'];
$user = $events['events'][0]['source']['userId'];

// Validate parsed JSON data
if (!is_null($events['events'])) {
 // Loop through each event
 foreach ($events['events'] as $event) {
  // Reply only when message sent is in 'text' format
  if ($event['message']['text'] == "สวัสดี" {
      $replyToken = $event['replyToken'];
      $text = "ไง";
   
        $messages = [
       'type' => 'template',
        'altText' => 'this is a confirm template',
        'template' => [
            'type' => 'confirm',
            'text' => $text ,
            'actions' => [
                [
                    'type' => 'message',
                    'label' => '????',
                    'text' => '????'
                ],
                [
                    'type' => 'message',
                    'label' => '???????',
                    'text' => '???????'
                ],
            ]
        ]
    ];
 }elseif ($event['type'] == 'message' && $event['message']['type'] == 'text'){
    
      $replyToken = $event['replyToken'];
      $text = "?????????????????";
      $messages = [
          'type' => 'text',
          'text' => $text
        ];  
}else{
   $replyToken = $event['replyToken'];
      $text = "ๆ";
          $messages = [
                 'type' => 'template',
                  'altText' => 'this is a confirm template',
                  'template' => [
                      'type' => 'confirm',
                      'text' => $text ,
                      'actions' => [
                          [
                              'type' => 'message',
                              'label' => '????',
                              'text' => '????'
                          ],
                          [
                              'type' => 'message',
                              'label' => '???????',
                              'text' => '???????'
                          ]
                      ]
                  ]
              ];       
     
  }
  
  
 }
}
  // Make a POST Request to Messaging API to reply to sender
         $url = 'https://api.line.me/v2/bot/message/reply';
         $data = [
          'replyToken' => $replyToken,
          'messages' => [$messages],
         ];
         error_log(json_encode($data));
         $post = json_encode($data);
         $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         $result = curl_exec($ch);
         curl_close($ch);
         echo $result . "\r\n";
?>