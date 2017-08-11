<?php
use yii\helpers\Html;
?>

<table class="table table-bordered table-hover">
    <tr>
        <th>ID</th>
        <th>管理员名称</th>
        <th>权限列表</th>
        <th>操作</th>
    </tr>

    <?php foreach ($data as $adm):?>
        <tr>
            <td><?= $adm->id;?></td>
            <td><?= $adm->adminname;?></td>
            <td>
                <?php foreach($adminRoles[$adm->id] as $adminRole):?>
                    <?= $adminRole->name;?>
                <?php endforeach;?>
            </td>
            <td>
                <a href="<?= \yii\helpers\Url::to(['/admin/rbac/admin-role','id'=>$adm->id]);?>">分配角色</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
