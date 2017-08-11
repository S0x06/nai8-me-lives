<?php
use yii\helpers\Html;
?>
<div>
    <a href="<?= Yii::$app->urlManager->createUrl(['/admin/rbac/create-rule']);?>" class="btn btn-default">新建规则</a>
</div>
<table class="table table-bordered">
    <tr>
        <th>规则名</th>
        <th>数据</th>
    </tr>
    <?php foreach($rules as $rule):?>
        <tr>
            <td><?= $rule->name;?></td>
            <td>

            </td>
        </tr>
    <?php endforeach;?>
</table>
