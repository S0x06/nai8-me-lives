<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Administrator;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

/**
 * Default controller for the `admin` module
 */
class AdministratorController extends Controller
{

    public function actionIndex() {
        $data = Administrator::find()->all();

        $auth = Yii::$app->authManager;
        $adminRoles = [];
        foreach($data as $admin){
            $adminRoles[$admin->id] = $auth->getRolesByUser($admin->id);
        }

        return $this->render('index',[
            'data'=>$data,
            'adminRoles'=>$adminRoles
        ]);
    }
}
