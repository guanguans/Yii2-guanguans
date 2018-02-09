<?php
namespace frontend\models;

use yii\elasticsearch\ActiveRecord;

class Article extends ActiveRecord
{
    /**
     * 要查的属性（相当于字段）
     */
    public function attributes()
    {
        return [
            "article_id",
            "post_title",
            "post_excerpt",
            "categorys",
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

    public static function primaryKey()
    {
        return ['_id'];
    }

    public function getCategorys()
    {
        return $this->hasMany(CategoryArticle::className(), ['post_id' => 'id']);
    }

    /**
     * @return array This model's mapping
     */
    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'article_id'   => [
                        'type'     => 'long'
                    ],
                    'post_title'   => [
                        'type'     => 'string',
                        "index"    => "analyzed",
                        "analyzer" => "ik"
                    ],
                    'post_excerpt' => [
                        'type'     => 'string',
                        "index"    => "analyzed",
                        "analyzer" => "ik"
                    ],
                    'categorys'    => [
                        'type'      => 'nested',
                        'properties' => [
                            'category_names' => ['type' => 'string', 'index' => 'not_analyzed'],
                        ]
                    ]
                ]
            ],
        ];
    }

    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            'settings' => [
                "refresh_interval" => "3s", //5秒后刷新
                "number_of_shards" => 1,    //分片，目前1台机器，所以为1
                "number_of_replicas" => 0   //副本为0
            ],
            'mappings' => static::mapping(),
            //'warmers' => [ /* ... */ ],
            //'aliases' => [ /* ... */ ],
            //'creation_date' => '...'
        ]);
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }

    public static function updateRecord($article_id, $columns = []){
       try{
            $record = self::get($article_id);
            foreach($columns as $key => $value){
                 $record->$key = $value;
            }

            return $record->update();
        } catch (\Exception $e){
            //handle error here
            return false;
        }
    }

    public static function deleteRecord($article_id)
    {
        try{
            $record = self::get($article_id);
            $record->delete();
            return 1;
        } catch (\Exception $e){
            //handle error here
            return false;
        }
    }

    public static function addRecord(Article $article){
        $isExist = false;

        try{
            $record = self::get($article->id);
            if(!$record){
                $record = new self();
                $record->setPrimaryKey($article->id);
            }
            else{
                $isExist = true;
            }
        } catch (\Exception $e){
            $record = new self();
            $record->setPrimaryKey($article->id);
        }

        $suppliers = [
             ['id' => '1', 'name' => 'ABC'],
             ['id' => '2', 'name' => 'XYZ'],
        ];

        $record->id   = $article->id;
        $record->name = $article->name;
        $record->author_name = $image->author_name;
        $record->status = 1;
        $record->suppliers = $suppliers;

        try{
            if(!$isExist){
                $result = $record->insert();
            }
            else{
                $result = $record->update();
            }
        } catch (\Exception $e){
            $result = false;
            //handle error here
        }

        return $result;
    }

}
