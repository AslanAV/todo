<?php
require "../vendor/autoload.php";

$data = json_decode(file_get_contents('php://input'), true);

$app = new \App\App();

$app->index($data['message'], $data['message']['chat']['Id']);
