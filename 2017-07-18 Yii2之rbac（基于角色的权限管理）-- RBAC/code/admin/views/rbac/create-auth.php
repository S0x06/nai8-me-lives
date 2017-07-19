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
<?= Html::textInput('name');?>
<?= Html::textInput('description');?>
<button id="actBtn" data-url="<?= \yii\helpers\Url::to(['/admin/rbac/create-auth']);?>">提交</button>
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