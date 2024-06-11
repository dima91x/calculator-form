<?php

namespace app\controllers;

use app\controllers\Calculator\Location;
use app\controllers\Calculator\PriceAdapter;
use Yii;
use app\models\CalculatorForm;
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

        $locations = new Location();
        $listLocation = $locations->getObjectsFromApi()->listLocation()->toArray();

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = Yii::$app->request->post("CalculatorForm");

            $price = new PriceAdapter($data);
            $price_info = $price->getObjectsFromApi()->toArray();

            if(isset($price_info["error"])) {
                return $this->render('form', [ 'model'=> $model,
                    'locations' => $listLocation , 'error' => $price_info["error"],
                    "from" => $data["from"], "to" => $data["to"],
                    "volume" => $data["volume"], "weight" => $data["weight"]
                ]);
            }

            return $this->render('form', [ 'model'=> $model,
                'locations' => $listLocation , 'price' => $price_info["response"],
                "from" => $data["from"], "to" => $data["to"],
                "volume" => $data["volume"], "weight" => $data["weight"]
            ]);
        }

        return $this->render('form', [ 'model'=> $model, 'locations' => $listLocation ]);
    }
}
