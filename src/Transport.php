<?php

namespace App;

class Transport
{
    private string $botUrl = 'https://api.telegram.org/bot5308802884:AAHN1BguDHt_LB06OLsU0e8hav88dmIj1kY/';


    public function sendAnswer($method, $data, $headers = [])
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->botUrl . $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array_merge(['Content-Type: application/json'], $headers)
        ]);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, 1) ?? $result;
    }
}