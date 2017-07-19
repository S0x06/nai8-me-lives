<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/18
 * Time: 15:47
 */

namespace app\modules\admin\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\helpers\Json;
use yii\base\Exception;
use yii\data\ActiveDataProvider;

class RbacController extends Controller {

    /**
     * 列出所有的权限或角色
     */
    public function actionIndex($type = 1){
        $auth = Yii::$app->authManager;
        $dataProvider = new ActiveDataProvider([
            'query'=>(new Query())->from($auth->itemTable)->where(['type'=>$type]),
            'pagination'=>[
                'pageSize'=>20
            ]
        ]);

        return $this->render('index',[
            'type'=>$type,
            'dataProvider'=>$dataProvider
        ]);
    }

    public function actionCreateAuth(){
        if(Yii::$app->request->isPost){
            try {

                $name = Yii::$app->request->post('name');
                $desc = Yii::$app->request->post('description');

                if(empty($name)){
                    throw new Exception('name不能为空');
                }

                $auth = Yii::$app->authManager;
                $model = $auth->createPermission($name);

                $model->description = $desc;
                $auth->add($model);


                echo Json::encode(['done'=>true]);
            }catch(Exception $e){
                echo Json::encode(['done'=>false,'error'=>$e->getMessage()]);
            }
            Yii::$app->end();
        }
        return $this->render('create-auth');
    }

    public function actionCreateRole(){
        if(Yii::$app->request->isPost){
            try {

                $name = Yii::$app->request->post('name');
                $desc = Yii::$app->request->post('description');

                if(empty($name)){
                    throw new Exception('name不能为空');
                }

                $auth = Yii::$app->authManager;
                $model = $auth->createRole($name);

                $model->description = $desc;
                $auth->add($model);


                echo Json::encode(['done'=>true]);
            }catch(Exception $e){
                echo Json::encode(['done'=>false,'error'=>$e->getMessage()]);
            }
            Yii::$app->end();
        }
        return $this->render('create-role');
    }

    public function actionUpdate($name,$type){
        $auth = Yii::$app->authManager;
        if($type == 1){
            $model = $auth->getRole($name);
            $model->description = '111';

            $auth->update($name,$model);
        }else if($type==2){

        }

    }

    public function actionRoleAuths($name){
        $auth = Yii::$app->authManager;
        $prermissionList = $auth->getPermissions();

        $currentRole = $auth->getRole($name);

        if(Yii::$app->request->isPost){
            try {
                $auths = Yii::$app->request->post('auths');

                //
                $auth->removeChildren($currentRole);

                foreach($auths as $val){
                    $oneAuth = $auth->getPermission($val);
                    $auth->addChild($currentRole,$oneAuth);
                }

                echo Json::encode(['done'=>true]);
            }catch(Exception $e){
                echo Json::encode(['done'=>false,'error'=>$e->getMessage()]);
            }
            Yii::$app->end();
        }

        return $this->render('role-auths',[
            'prermissionList'=>$prermissionList,
            'currentRole'=>$currentRole
        ]);
    }

    public function actionA(){
        try {

            return Json::encode(['done' => true]);
        } catch (Exception $e) {
            return Json::encode(['done' => false, 'error' => $e->getMessage()]);
        }
    }
}