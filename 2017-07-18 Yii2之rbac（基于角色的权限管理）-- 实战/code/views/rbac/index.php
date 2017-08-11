<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
    <div>
        <?php if($type == 1):?>
            <a href="<?= Yii::$app->urlManager->createUrl(['/admin/rbac/create-role']);?>" class="btn btn-default">新建角色</a>
        <?php else:?>
            <a href="<?= Yii::$app->urlManager->createUrl(['/admin/rbac/create-auth']);?>" class="btn btn-default">新建权限</a>
        <?php endif;?>
    </div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'label'=>'类别',
            'format'=>'raw',
            'value'=>function($data){
                return $data['type'] == 1 ? '角色' : '权限';
            }
        ],
        [
            'headerOptions' => ['width' => '120'],
            'format'=>'raw',
            'label'=>'角色/权限名',
            'value'=>function($data){
                return $data['name'];
            }
        ],
        [
            'headerOptions' => ['width' => '130'],
            'label'=>'建立时间',
            'value'=>function($data){
                return date('Y-m-d H:i:s',$data['created_at']);
            }
        ],
        [
            'headerOptions' => ['width' => '130'],
            'label'=>'更新时间',
            'value'=>function($data){
                return date('Y-m-d H:i:s',$data['updated_at']);
            }
        ],
        [
            'label'=>'备注',
            'value'=>function($data){
                return $data['description'];
            }
        ],
        [
            'class'=>'yii\grid\ActionColumn',
            'header'=>'操作',
            'headerOptions'=>['width'=>'150'],
            'template'=>'{update}<br/>{auths}<br/>{delete}',
            'buttons'=>[
                'update' => function($url, $model, $key){
                    $url = Yii::$app->urlManager->createUrl(['/admin/rbac/update','name'=>$model['name'],'type'=>$model['type']]);
                    return "<a href='{$url}'>update</a>";
                },
                'auths'=>function($url, $model, $key){
                    if($model['type'] == 1){
                        return "<a href='".Yii::$app->urlManager->createUrl(['/admin/rbac/role-auths','name'=>$model['name']])."'>分权限</a>";
                    }
                    return false;
                },
                'delete' => function($url, $model, $key){
                    return "<a onclick='return confirm(\"您确定要删除么？\");' href='".Yii::$app->urlManager->createUrl(['/admin/rbac/delete','name'=>$model['name'],'type'=>$model['type']])."'>删除</a>";
                },
            ]
        ],

    ],
]);
?>