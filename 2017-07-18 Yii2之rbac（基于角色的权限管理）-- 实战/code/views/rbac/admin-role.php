<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
    $form = ActiveForm::begin([
        'id'=>'Form',
        'action'=>'javascript:;',
    ]);
?>
<table class="table-bordered table">
    <tr>
        <th>选择</th>
        <th>角色名字</th>
        <th>简介</th>
    </tr>
    <?php foreach($roleList as $role):?>
        <tr>
            <td>
                <input type="checkbox" name="role[]" value="<?= $role->name;?>" <?php if(array_key_exists($role->name,$iRoles)):?>checked="checked"<?php endif;?>>
            </td>
            <td><?= $role->name; ?></td>
            <td><?= $role->description; ?></td>
        </tr>
    <?php endforeach;?>
</table>
<div>
    <div class="mt10">
        <button type="button" id="actBtn" class="btn btn_submit" data-url="<?= Yii::$app->urlManager->createUrl(['/admin/rbac/admin-role','id'=>$model->id]);?>">点击保存角色分配</>
    </div>
</div>
<?php ActiveForm::end();?>

<script type="text/javascript">
    $('#actBtn').click(function(){
        $.post($(this).attr('data-url'),$('#Form').serializeArray(),function(d){
            if(d.done === true){
                alert('角色分配成功');
            }else{
                alert(d.error);
            }
        },'json');
    });
</script>
