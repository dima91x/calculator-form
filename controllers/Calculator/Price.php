<?php

namespace app\controllers\Calculator;

class Price extends ObjectApi
{
    public function getPrice( $info, string $terminal = "default") : array
    {
        $data = [
            "object" => "price",
            "action" => "get",
            "params" => [
                "cargo" => [
                    "dimension" => [  // габариты
                        "quantity" => 1, // количество мест
                        "volume" => $info["volume"] ?: 0.1, // общий объем
                        "weight" => $info["weight"] ?: 0.1 // общий вес
                    ]
                ],
                "gateway" => [
                    "dispatch" => [   // откуда
                        "point" => [
                            "location" => $info["from"],
                            "terminal" => $terminal
                        ]
                    ],
                    "destination" => [  // куда
                        "point" => [
                            "location" => $info["to"],
                            "terminal" => "default"
                        ]
                    ]
                ]
            ]
        ];

        return $this->requestApi($data);

    }
}