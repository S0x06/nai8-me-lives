<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Administrator;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin(){
        $model = new Administrator();
        if(Yii::$app->request->isPost){
            try {

                $adminname = Yii::$app->request->post('adminname');
                $password = Yii::$app->request->post('password');

                $check = Administrator::find()->where(['adminname'=>$adminname,'password'=>md5($password)])->one();
                if($check == false){
                    throw new Exception('用户名和密码不正确');
                }

                Yii::$app->admin->login($check);

                echo Json::encode(['done'=>true]);
            }catch(Exception $e){
                echo Json::encode(['done'=>false,'error'=>$e->getMessage()]);
            }
            Yii::$app->end();
        }

        return $this->render('login',[
            'model'=>$model
        ]);
    }

}
