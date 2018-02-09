<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\models\Article;

/**
 * Site controller
 */
class ElasticSearchController extends Controller
{
    public function url()
    {
        return $str = <<<menu
        <a href="/site/elastic-search">elastic</a>
menu;
    }

    /**
     * Query
     */
    public function actionQuery()
    {
        $query = Yii::$app->request->get('keyword');
        $searchModel = \frontend\models\Article::find()->query([
            "multi_match" => [
                "query" => trim($query),
                "fields" => ["post_title", "post_excerpt"]
            ],
        ]);
        $highlight = [
            "pre_tags" => ["<b style='color: red;' >"],
            "post_tags" => ["</b>"],
            "fields" => [
                "post_title" => new \stdClass(),
                "post_excerpt" => new \stdClass()
            ]
        ];
        $searchModel = $searchModel->highlight($highlight)->asArray()->all();

        echo $this->url();
        pp($searchModel);
    }


    /**
     * Set (update) mappings for this model
     */
    public function actionUpdateMapping()
    {
        echo $this->url();
        pp(Article::updateMapping());
    }

    /**
     * Create this model's index
     */
    public function actionCreateIndex()
    {
        echo $this->url();
        pp(Article::createIndex());
    }

    /**
     * Delete this model's index
     */
    public function actionDeleteIndex()
    {
        echo $this->url();
        pp(Article::deleteIndex());
    }


    /**
     * actionAddDataAll
     */
    public function actionAddDataAll()
    {
        set_time_limit(0);
        $data = \backend\models\Article::find()
            ->select(['feehi_article.id', 'post_title', 'post_excerpt'])
            ->joinWith([
                'categorys' => function($query){
                    $query->select(['post_id', 'category_id']);
                }
            ])
            ->asArray()
            ->all();
        // pp($data);     
        $model = new Article();
        foreach($data as $attributes){
            $_model                      = clone $model;
            $_model->primaryKey          = $attributes['id'];
            $_model->article_id          = $attributes['id'];
            $_model->post_title          = $attributes['post_title'];
            $_model->post_excerpt        = $attributes['post_excerpt'];
            $category_ids                = yii\helpers\ArrayHelper::getColumn(
                                                $attributes['categorys'],
                                                'category_id'
                                            );
            $categorys = [];
            $categorys['category_names'] = implode(
                                                yii\helpers\ArrayHelper::getColumn(
                                                \backend\models\Category::find()
                                                ->select(['name'])
                                                ->where(['id'=>$category_ids])
                                                ->asArray()
                                                ->all(), 'name'),
                                                ','
                                            );
            $_model->categorys    = $categorys;
            $_model->save();
            unset($_model);
        }
        unset($data);
        unset($model);
        echo $this->url();
        pp('添加成功');
    }

    /**
     * actionAddDataOne
     */
    public function actionAddDataOne()
    {
        try {
            $model = new Article();
            $model->article_id   = Yii::$app->request->get('article_id');
            $model->primaryKey   = Yii::$app->request->get('article_id');
            $model->post_title   = Yii::$app->request->get('post_title');
            $model->post_excerpt = Yii::$app->request->get('post_excerpt');
            echo $this->url();
            pp($model->save(false));
        } catch (\Exception $e) {
            pp($e->getMessage());
        }
    }
    
    /**
     * actionUpdateDataAll
     */
    public function actionUpdateDataAll()
    {
        set_time_limit(0);
        $data = \backend\models\Article::find()
            ->select(['feehi_article.id', 'post_title', 'post_excerpt'])
            ->joinWith([
                'categorys' => function($query){
                    $query->select(['post_id', 'category_id']);
                }
            ])
            ->asArray()
            ->all();
        foreach($data as $attributes){
            $model = Article::get($attributes['id']);
            
            $model->article_id   = $attributes['id'];
            $model->post_title   = $attributes['post_title'];
            $model->post_excerpt = $attributes['post_excerpt'];
            $category_ids        = yii\helpers\ArrayHelper::getColumn(
                                        $attributes['categorys'],
                                        'category_id'
                                    );
            $categorys           = [];
            $categorys['category_names'] = implode(
                                                yii\helpers\ArrayHelper::getColumn(
                                                \backend\models\Category::find()
                                                ->select(['name'])
                                                ->where(['id'=>$category_ids])
                                                ->asArray()
                                                ->all(), 'name'),
                                                ','
                                            );
            $model->categorys    = $categorys;
            $model->update();
            unset($model);
        }
        unset($data);
        unset($model);
        echo $this->url();
        pp('跟新成功');
    }

    /**
     * actionDeleteDataAll
     */
    public function actionDeleteDataAll()
    {
        echo $this->url();
        pp(Article::deleteAll());
    }

    /**
     * actionDeleteDataOne
     */
    public function actionDeleteDataOne()
    {
        $article_id = Yii::$app->request->get('article_id');
        try{
            $record = Article::get($article_id);
            echo $this->url();
            pp($record->delete());
        } catch (\Exception $e){
            pp($e->getMessage());
        }
    }
}



