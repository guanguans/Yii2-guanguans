<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property string $id
 * @property string $type
 * @property string $parent_id
 * @property string $name
 * @property string $url
 * @property string $icon
 * @property double $sort
 * @property string $target
 * @property int $is_absolute_url
 * @property int $is_display
 * @property int $method
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AdminRolePermission[] $adminRolePermissions
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'parent_id', 'is_absolute_url', 'is_display', 'method', 'created_at', 'updated_at'], 'integer'],
            [['name', 'url', 'created_at'], 'required'],
            [['sort'], 'number'],
            [['name', 'url', 'icon', 'target'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'icon' => Yii::t('app', 'Icon'),
            'sort' => Yii::t('app', 'Sort'),
            'target' => Yii::t('app', 'Target'),
            'is_absolute_url' => Yii::t('app', 'Is Absolute Url'),
            'is_display' => Yii::t('app', 'Is Display'),
            'method' => Yii::t('app', 'Method'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminRolePermissions()
    {
        return $this->hasMany(AdminRolePermission::className(), ['menu_id' => 'id']);
    }
}
