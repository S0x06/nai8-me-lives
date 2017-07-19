<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "administrator".
 *
 * @property integer $id
 * @property string $adminname
 * @property string $password
 */
class Administrator extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administrator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminname', 'password'], 'required'],
            [['adminname', 'password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'adminname' => '管理员名',
            'password' => '密码',
        ];
    }

    public static function findIdentity($id){
        $administrator = Administrator::findOne(['id'=>$id]);
        return $administrator ? new static($administrator) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null){

    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){

    }

    public function validateAuthKey($authKey){

    }
}
