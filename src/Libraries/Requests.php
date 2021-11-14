<?php

namespace Libraries;

class Requests
{
    public function makeRequest($method = 'GET', $requestUrl = 'record', $data = [])
    {

        $time = time();
        $path = '/v1/user/self/zone/php-assignment-9.ws/' . $requestUrl;
        $api = 'https://rest.websupport.sk';
        $query = ''; // query part is optional and may be empty
        $apiKey = $_ENV['API_KEY'];
        $secret = $_ENV['PRIVATE_KEY'];
        $canonicalRequest = sprintf('%s %s %s', $method, $path, $time);
        $signature = hash_hmac('sha1', $canonicalRequest, $secret);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf('%s%s%s', $api, $path, $query));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ':' . $signature);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Date: ' . gmdate('Ymd\THis\Z', $time),
        ]);

        if (false === empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $response = curl_exec($ch);
        curl_close($ch);


        return $response;
    }
}
