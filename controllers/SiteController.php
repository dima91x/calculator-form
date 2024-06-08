<?php

namespace app\controllers;

use Yii;
use app\models\ContactForm;
use app\models\CalculatorForm;
use app\models\LoginForm;
use yii\web\Controller;


class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new CalculatorForm();

        $locations = $this->getLocation();
        $locations = $locations["response"]["data"];
        $arr_locations = array_column($locations, "name");
        $locations = array_combine($arr_locations, $arr_locations);

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = Yii::$app->request->post("CalculatorForm");

            $price_info = $this->getPrice($data);

            if(isset($price_info["error"])) {
                return $this->render('form', [ 'model'=> $model,
                    'locations' => $locations , 'error' => $price_info["error"],
                    "from" => $data["from"], "to" => $data["to"],
                    "volume" => $data["volume"], "weight" => $data["weight"]
                ]);
            }

             $price_info = $price_info["response"];

            return $this->render('form', [ 'model'=> $model,
                'locations' => $locations , 'price' => $price_info,
                "from" => $data["from"], "to" => $data["to"],
                "volume" => $data["volume"], "weight" => $data["weight"]
            ]);
        }

        return $this->render('form', [ 'model'=> $model, 'locations' => $locations ]);
    }

    private function getLocation(): array
    {
        $data = [
            "object" => "location",
            "action" => "get"
        ];

        return $this->requestApi($data);
    }

    private function getPrice( $info, string $terminal = "default") : array
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

    private function getTerminal(string $location): array
    {
        $data = [
            "object" => "terminal",
            "action" => "get",
            "params" => [
                "location" => $location
            ]
        ];

        return $this->requestApi($data);
    }

    private function requestApi(array $data): array
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
