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
     * Delete this model's index
     */
    public function actionAddDataOne()
    {
        $model = new Article();
        $model->article_id   = 6;
        // $model->primaryKey   = 6;
        $model->post_title   = '文章';
        $model->post_excerpt = '描述';
        echo $this->url();
        pp($model->save(false));
    }

    /**
     * Delete this model's index
     */
    public function actionAddDataAll()
    {
        set_time_limit(0);
        $data = \backend\models\Article::find()->select(['id', 'post_title', 'post_excerpt'])->asArray()->all();
        $model = new Article();
        foreach($data as $attributes){
            $_model = clone $model;
            $_model->primaryKey   = $attributes['id'];
            $_model->article_id   = $attributes['id'];
            $_model->post_title   = $attributes['post_title'];
            $_model->post_excerpt = $attributes['post_excerpt'];
            $_model->save();
            unset($_model);
        }
        unset($data);
        unset($model);
        echo $this->url();
        pp(1);
    }

    /**
     * Delete this model's index
     */
    public function actionDeleteDataAll()
    {
        $model = new Article();
        echo $this->url();
        pp($model->deleteAll());
    }
}



