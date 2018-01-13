<?php

namespace backend\models;

use Yii;


/**
 * This is the model class for table "{{%category_article}}".
 *
 * @property string $id
 * @property string $post_id 文章id
 * @property string $category_id 分类id
 * @property double $list_order 排序
 * @property int $status 状态,1:发布;0:不发布
 */
class CategoryArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category_article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'category_id', 'status'], 'integer'],
            [['list_order'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => '文章id',
            'category_id' => '分类id',
            'list_order' => '排序',
            'status' => '状态,1:发布;0:不发布',
        ];
    }

}
