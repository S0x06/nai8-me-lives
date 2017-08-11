<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php
$form = ActiveForm::begin([
    'action'=>'javascript:;',
    'id'=>'Form'
]);
?>
<div>
    角色名
    <?= Html::textInput('name');?>
</div>
<div>
    规则名
    <?= Html::textInput('rule');?>
</div>
<div>
    描述
    <?= Html::textInput('description');?>
</div>

<button id="actBtn" data-url="<?= \yii\helpers\Url::to(['/admin/rbac/create-role']);?>">提交</button>
<?php
ActiveForm::end();
?>


<script type="text/javascript">
    $('#actBtn').click(function(){
        var url = $(this).attr('data-url');
        $.post(url,$('#Form').serializeArray(),function(d){
            if(d.done == true){
                alert('成功');
            }else{
                alert(d.error);
            }
        },'json');
    });
</script>