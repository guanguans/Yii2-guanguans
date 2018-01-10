<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $alias
 * @property string $sort
 * @property string $remark
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'required'],
            [['name', 'alias', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '父级 ID',
            'name' => '名称',
            'alias' => '别名',
            'sort' => '排序',
            'remark' => '描述',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
