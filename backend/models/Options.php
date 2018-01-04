<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%options}}".
 *
 * @property string $id
 * @property string $type
 * @property string $name
 * @property string $value
 * @property int $input_type
 * @property int $autoload
 * @property string $tips
 * @property string $sort
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%options}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'input_type', 'autoload', 'sort'], 'integer'],
            [['name'], 'required'],
            [['value'], 'string'],
            [['name', 'tips'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'value' => 'Value',
            'input_type' => 'Input Type',
            'autoload' => 'Autoload',
            'tips' => 'Tips',
            'sort' => 'Sort',
        ];
    }
}
