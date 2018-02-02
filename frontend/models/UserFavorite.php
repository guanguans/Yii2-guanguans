<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%user_favorite}}".
 *
 * @property string $id
 * @property string $user_id 用户 id
 * @property string $title 收藏内容的标题
 * @property string $url 收藏内容的原文地址，不带域名
 * @property string $description 收藏内容的描述
 * @property string $table_name 收藏实体以前所在表,不带前缀
 * @property string $object_id 收藏内容原来的主键id
 * @property string $create_time 收藏时间
 */
class UserFavorite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_favorite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'object_id', 'create_time'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['table_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', '用户 id'),
            'title' => Yii::t('app', '收藏内容的标题'),
            'url' => Yii::t('app', '收藏内容的原文地址，不带域名'),
            'description' => Yii::t('app', '收藏内容的描述'),
            'table_name' => Yii::t('app', '收藏实体以前所在表,不带前缀'),
            'object_id' => Yii::t('app', '收藏内容原来的主键id'),
            'create_time' => Yii::t('app', '收藏时间'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getArticle()
    {
        return $this->hasOne(\backend\models\Article::className(), ['id' => 'object_id']);
    }
}
