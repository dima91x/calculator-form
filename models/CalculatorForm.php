<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CalculatorForm extends Model
{
    public $from;
    public $to;
    public $volume;
    public $weight;

    public function attributeLabels()
    {
        return [
            "from" => "Откуда",
            "to" => "Куда",
            "volume" => "Обьем (м³)",
            "weight" => "Вес (кг)"
        ];
    }

    public function rules()
    {
        return [
            [["volume","weight"], "required", "message" => "Введите значение"],
            ["volume", "double",  "min" => 0.1, "tooSmall" => "Слишком маленький обьем"],
            ["weight", "double",  "min" => 0.1, "tooSmall" => "Слишком маленький вес"]
        ];

    }

}

?>