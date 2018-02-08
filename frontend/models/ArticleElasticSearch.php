<?php
namespace frontend\models;

use yii\elasticsearch\ActiveRecord;

class ArticleElasticSearch extends ActiveRecord
{
    /**
     * 要查的属性（相当于字段）
     */
    public function attributes()
    {
        return [
            "article_id",
            "post_title",
            "post_excerpt"
        ];
    }

    /**
     * 要查的索引（相当于数据库）
     */
    public static function index()
    {
        return "yii2blog";
    }

    /**
     * 要查的字段（相当于数据表）
     */
    public static function type()
    {
        return "articles";
    }
}
