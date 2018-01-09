<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%friend_link}}".
 *
 * @property string $id
 * @property string $name
 * @property string $image
 * @property string $url
 * @property string $target
 * @property string $sort
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class FriendLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%friend_link}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at'], 'required'],
            [['sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'image', 'url', 'target'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'image' => '图片',
            'url' => 'Url',
            'target' => 'Target',
            'sort' => '排序',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '跟新时间',
        ];
    }
}
