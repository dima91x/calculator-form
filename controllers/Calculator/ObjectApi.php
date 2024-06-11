<?php

namespace app\controllers\Calculator;

class ObjectApi
{
    protected function requestApi(array $data): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,
            "https://vozovoz.org/api/?token=LewHIJIU2eoDUx2eTWem9PXMygm1kwMAgwMuTXL6");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode($data)
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return json_decode($server_output, true);
    }
}