<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/28
 * Time: 18:48
 */

namespace app\modules\admin\models;


use yii\base\Model;
use yii\rbac\Rule;
use Yii;

class RbacRule extends Model
{

    public $name;

    public $createAt;

    public $updateAt;

    public $className;

    private $_item;

    public function __construct($item, $config = [])
    {
        $this->_item = $item;
        
        if ($item !== null) {
            $this->name = $item->name;
            $this->className = get_class($item);
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'className'], 'required'],
            [['className'], 'string'],
            [['className'], 'classExists']
        ];
    }

    public function classExists()
    {
        if (!class_exists($this->className)) {
            $this->addError('className', '类不存在');
            return;
        }
        if (!is_subclass_of($this->className, Rule::className())) {
            $this->addError('className', '类必须是Rule或其子类');
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => '规则名',
            'className' => '类名',
        ];

    }

    public function getItem()
    {
        return $this->_item;
    }

    public static function find($id)
    {
        $item = Yii::$app->authManager->getRule($id);
        if ($item !== null) {
            return new static($item);
        }
        return null;
    }

    public function save()
    {
        if ($this->validate()) {
            $manager = Yii::$app->authManager;
            $class = $this->className;
            if ($this->_item === null) {
                $this->_item = new $class();
                $isNew = true;
            } else {
                $isNew = false;
                $oldName = $this->_item->name;
            }
            $this->_item->name = $this->name;
            if ($isNew) {
                $manager->add($this->_item);
            } else {
                $manager->update($oldName, $this->_item);
            }
            return true;
        } else {
            return false;
        }
    }
}