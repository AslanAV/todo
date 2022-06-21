<?php

require "../vendor/autoload.php";

$data = json_decode(file_get_contents("php://input"), true);

$message = $data['message'];
error_log(json_encode($data));

sendAnswer('sendMessage', [
    'chat_id' => $message['chat']['id'],
    'text' => 'Вот Мой Ответ! 😁'
]);

sendAnswer('sendMessage', [
    'chat_id' => $message['chat']['id'],
    'text' => 'Вот мой ответ!' . hex2bin('F09F9882')
]);

function sendAnswer($method, $data, $headers = [])
{
    $curl = curl_init();
    curl_setopt_array($curl, options: [
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://api.telegram.org/bot5308802884:AAHN1BguDHt_LB06OLsU0e8hav88dmIj1kY/' . $method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array_merge(['Content-type: application/json'], $headers)
    ]);
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result, 1) ?? $result;
}