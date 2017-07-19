<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1>
    <?= $currentRole->name;?>
</h1>
<?php
$form = ActiveForm::begin([
    'action'=>'javascript:;',
    'id'=>'Form'
]);
?>
<ul>
<?php foreach($prermissionList as $val):?>
    <li>
        <input type="checkbox" name="auths[]" value="<?= $val->name;?>"/>
        <?= $val->name;?>
        <br>
        <?= $val->description;?>
    </li>
<?php endforeach;?>
</ul>
<div>
    <button id="actBtn" data-url="<?= \yii\helpers\Url::to(['/admin/rbac/role-auths','name'=>$currentRole->name]);?>">赋予角色权限</button>
</div>
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
