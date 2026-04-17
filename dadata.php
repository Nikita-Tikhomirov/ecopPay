<?php

$token = "b807bc59c7faa1ab5c67376b51df520341736485";
$secret = "f1cbc2cd59a8793c30e064d69e37ef3557137a86";

$data = json_decode(file_get_contents("php://input"), true);

$ch = curl_init("https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Accept: application/json",
    "Authorization: Token $token",
    "X-Secret: $secret"
]);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    "query" => $data["inn"]
]));

$result = curl_exec($ch);
curl_close($ch);

echo $result;