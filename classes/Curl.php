<?php

class Curl
{
    private string $token = 'pk.59fcedb50dcda6abd708d3777ac28749';

    public function forward(string $query): array
    {
        $query = str_replace(" ", "%20", $query);
        $response = $this->connect($query, 1);

        $decodedResponse = json_decode($response, true);
        if ($decodedResponse === null) {
            echo 'Ошибка декодирования JSON';
        } else {
            $i = 0;
            foreach ($decodedResponse as $row) {
                $coordinates[$i]['lat'] = $row['lat'];
                $coordinates[$i]['lon'] = $row['lon'];
                $i++;
            }
        }

        return $coordinates;
    }

    public function reverse(array $query)
    {
        $response = $this->connect($query, 2);

        $decodedResponse = json_decode($response, true);
        if ($decodedResponse === null) {
            echo 'Ошибка декодирования JSON';
        } else {
            $address = $decodedResponse['display_name'];
        }

        return $address;
    }

    private function connect(string|array $query, int $action): ?string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));

        if ($action === 1) {
            curl_setopt($ch, CURLOPT_URL, 'https://us1.locationiq.com/v1/search?key=' . $this->token . '&q=' . $query . '&format=json');
        } else if ($action === 2) {
            curl_setopt($ch, CURLOPT_URL, 'https://us1.locationiq.com/v1/reverse?key=' . $this->token . '&lat=' . $query[0] . '&lon=' . $query[1] . '&format=json');
        }
        
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            echo 'Ошибка cURL: ' . curl_error($ch);
            die();
        } else {
            return $response;
        }
    }
}