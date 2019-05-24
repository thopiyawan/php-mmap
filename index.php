<?php
    $accessToken = "p++VyfIIYOmmgOxMpJvCm3rpBTqvVVo/9F+uyt/KXsQu5SWjtrYUQUp8XPNQSc5tHCuu0Cv2fSbvwv0/xZqYw+TEjmmqW2mjC5NB9BcVGgvc9j+SSzl6mKa9c6vstzKroBupFTDQlIgp9/qufg9dOAdB04t89/1O/w1cDnyilFU=";//copy Channel access token ??????????????????
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //???????????????????
    $message = $arrayJson['events'][0]['message']['text'];
#???????? Message Type "Video"
    if($message == "video"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "video";
        $arrayPostData['messages'][0]['originalContentUrl'] = "";//??? url ??? video ?????????????
        $arrayPostData['messages'][0]['previewImageUrl'] = "";//?????? preview ??? video
        replyMsg($arrayHeader,$arrayPostData);
    }
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
exit;
?>
