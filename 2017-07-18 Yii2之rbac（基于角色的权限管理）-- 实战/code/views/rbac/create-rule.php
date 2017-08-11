<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'className')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('提交');?>
    </div>

    <?php ActiveForm::end(); ?>
</div>