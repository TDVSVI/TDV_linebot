<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'XmBhQb6jkujM8xtFKzaBZJq6+ZpyY296LITq5PaLd2j5w/eZCFulZae8Cdf/z11CGTFPZeK1ODhUCJ9NC76WpOAgtnslzplXTlI1XePyNwA99Q38tGSsp8HKxBmFnkDF5Zw8VpmKy9Im1JJE6bYKewdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'a1692aa366e2e5fd93d1450329e66440';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

  $replyToken = $jsonData["events"][0]["replyToken"];
  $userID = $jsonData["events"][0]["source"]["userId"];
  $text = $jsonData["events"][0]["message"]["text"];
  $timestamp = $jsonData["events"][0]["timestamp"];


if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];

        $text = $event['message']['text'];
        
        $data = [
            'replyToken' => $reply_token,
            // 'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  Debug Detail message
            'messages' => [['type' => 'text', 'text' => $text ]]
        ];
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

$serverName = "12.1.2.83";
  $userName = "fct";
  $userPassword = "svi2017*";
  $dbName = "TEST";
  $tableName = "linebot";
  
  $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true);
		
			$conn = sqlsrv_connect( $serverName, $connectionInfo);
		
			if( $conn === false ) {
				die( print_r( sqlsrv_errors(), true));
			}

$sql = "INSERT INTO $tableName (UserID, Text, Timestamp) VALUES (?, ?, ?)";
			$params = array($UserID, $text, $text);
			$stmt = sqlsrv_query( $conn, $sql, $params);

?>
