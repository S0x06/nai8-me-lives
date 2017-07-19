<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="form">
    <?php $form = ActiveForm::begin([
        'id' => 'Form',
        'options' => ['class'=>'form'],
        'action'=>'javascript:;',
        'enableClientValidation'=>false
    ]); ?>
    <?= $form->field($model, 'adminname')->textInput(['class'=>'input','name'=>'adminname']) ?>
    <?= $form->field($model, 'password')->passwordInput(['class'=>'input','name'=>'password']) ?>
    <div class="form-group buttons">
        <?= Html::button('登陆', ['class' => 'btn btn_submit btn_big', 'id'=>'actBtn','data-url'=>Yii::$app->urlManager->createUrl(['/admin/default/login'])]) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    $('#actBtn').click(function(){
        var url = $(this).attr('data-url');
        $.post(url,$('#Form').serializeArray(),function(d){
            if(d.done == true){
                window.location.href = '/index.php?r=admin';
            }else{
                alert(d.error);
            }
        },'json');
    });
</script>