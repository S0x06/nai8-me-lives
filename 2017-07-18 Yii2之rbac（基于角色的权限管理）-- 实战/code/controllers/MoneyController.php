<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class MoneyController extends Controller
{


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->renderContent('money/index');
    }


    public function actionRule(){

        return $this->renderContent("money/rule");
    }

    public function actionAbout()
    {
        return $this->renderContent('money/about');
    }
}
