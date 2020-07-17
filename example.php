<? php 
   $ accessToken = "AjDDLZgHbhDMmN4ZXuqLo9OhWk9It3eiM1KFJXyYmxJvFcgVmhQ4PODs8bp1rQIzt1Y14Vxjk1MDdDwLuDn0R8N42ATtZq4kEyx0TL3dsB+GLSBuDzULKCnmdeOOksqTaHbZXKx2tUYPP9+YQMWyJgdB04t89/1O/w1cDnyilFU="; // copy Channel access token message when setting
$content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);
$arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
// Receive messages from user 
   $ message = $ arrayJson ['events'] [0] ['message'] ['text'];
//receive id where did you come from?
   if(isset($arrayJson['events'][0]['source']['userId']){
      $id = $arrayJson['events'][0]['source']['userId'];
   }
   else if(isset($arrayJson['events'][0]['source']['groupId'])){
      $id = $arrayJson['events'][0]['source']['groupId'];
   }
   else if(isset($arrayJson['events'][0]['source']['room'])){
      $id = $arrayJson['events'][0]['source']['room'];
   }
#example Message Type "Text + Sticker"
   if($message == "Hello"){
      $arrayPostData['to'] = $id;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "hello";
      $arrayPostData['messages'][1]['type'] = "sticker";
      $arrayPostData['messages'][1]['packageId'] = "2";
      $arrayPostData['messages'][1]['stickerId'] = "34";
      pushMsg($arrayHeader,$arrayPostData);
   }
function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
$ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
exit;
?>
