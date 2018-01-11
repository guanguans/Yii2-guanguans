<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `backend\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'type', 'status', 'sort', 'author_id', 'scan_count', 'comment_count', 'can_comment', 'visibility', 'flag_headline', 'flag_recommend', 'flag_slide_show', 'flag_special_recommend', 'flag_roll', 'flag_bold', 'flag_picture', 'created_at', 'updated_at'], 'integer'],
            [['title', 'sub_title', 'summary', 'thumb', 'seo_title', 'seo_keywords', 'seo_description', 'author_name', 'tag'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cid' => $this->cid,
            'type' => $this->type,
            'status' => $this->status,
            'sort' => $this->sort,
            'author_id' => $this->author_id,
            'scan_count' => $this->scan_count,
            'comment_count' => $this->comment_count,
            'can_comment' => $this->can_comment,
            'visibility' => $this->visibility,
            'flag_headline' => $this->flag_headline,
            'flag_recommend' => $this->flag_recommend,
            'flag_slide_show' => $this->flag_slide_show,
            'flag_special_recommend' => $this->flag_special_recommend,
            'flag_roll' => $this->flag_roll,
            'flag_bold' => $this->flag_bold,
            'flag_picture' => $this->flag_picture,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'thumb', $this->thumb])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'author_name', $this->author_name])
            ->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }
}
