<?php

namespace app\modules\admin;

/**
 * admin module definition class
 */
use Yii;
use yii\base\Exception;

class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    public function beforeAction($action) {
        if(parent::beforeAction($action)){

            $controller = $action->controller->id;
            $route = $controller."/".$action->id;

            $publicPages = array(
                'default/login',
                'default/error',
                'default/logout',
            );

            $noPermissionActions = [
                'default/login',
                'default/error',
                'default/logout',
                'default/index',
            ];

            if(\Yii::$app->admin->isGuest AND !in_array($route, $publicPages)) {
                \Yii::$app->admin->loginRequired();
                return false;
            }

            //  管理员已经登录了
            if(Yii::$app->admin->identity->id != 1 && !in_array($route, $noPermissionActions)
                && Yii::$app->authManager->checkAccess(Yii::$app->admin->id,$route) == false){
                throw new Exception('no auth');
            }

            return true;
        }

        return false;
    }
}
