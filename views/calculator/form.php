<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
?>
<?php $forms = ActiveForm::begin(['options'=> ['autocomplete' => 'off']]); ?>

<?= $forms->field($model, 'from')
    ->dropDownList($locations, ["value" => isset($from) ? $from : "Москва"]) ?>

<?= $forms->field($model, 'to')
    ->dropDownList($locations, ["value" => isset($to) ? $to : "Санкт-Петербург"]) ?>

<?= $forms->field($model, 'volume')
    ->textInput(["value" => isset($volume) ? $volume : 0.1]) ?>
<?= $forms->field($model, 'weight')
    ->textInput(["value" => isset($weight) ? $weight : 0.9]) ?>

<?php if (isset($price)): ?>
    <div>
        <p><big>Цена: <?php  echo $price["price"] ?> ₽</big>      <strike style="padding-left: 30px"><?php  echo $price["basePrice"] ?> ₽</strike> </p>
        <p>
        <?php if ($price["deliveryTime"]["from"] != $price["deliveryTime"]["to"]): ?>
            Доставка от <?=  print($price["deliveryTime"]["from"]) ?> до <?=  print($price["deliveryTime"]["to"]) ?> дней
        <?php else: ?>
            Доставка <?=  print($price["deliveryTime"]["from"]) ?> дней
        <?php endif; ?>
        </p>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div>
        Ошибка:  <?php  echo $error["message"] ?>
    </div>
<?php endif; ?>


<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

