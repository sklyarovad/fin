<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Калькулятор займа';
$model->start_date = date('Y-m-d');

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'start_date') ?>

            <?= $form->field($model, 'loan_amount') ?>

            <?= $form->field($model, 'loan_term') ?>

            <?= $form->field($model, 'interest_rate') ?>

            <div class="form-group">
                <?= Html::submitButton('Рассчитать', ['class' => 'btn btn-primary btn-block', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
