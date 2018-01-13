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
            [['id', 'parent_id', 'post_type', 'post_format', 'user_id', 'post_status', 'comment_status', 'is_top', 'recommended', 'post_hits', 'post_like', 'comment_count', 'create_time', 'update_time', 'published_time', 'delete_time'], 'integer'],
            [['post_title', 'post_keywords', 'post_excerpt', 'post_source', 'post_content', 'post_content_filtered', 'more', 'category'], 'safe'],
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
            'parent_id' => $this->parent_id,
            'post_type' => $this->post_type,
            'post_format' => $this->post_format,
            'user_id' => $this->user_id,
            'post_status' => $this->post_status,
            'comment_status' => $this->comment_status,
            'is_top' => $this->is_top,
            'recommended' => $this->recommended,
            'post_hits' => $this->post_hits,
            'post_like' => $this->post_like,
            'comment_count' => $this->comment_count,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'published_time' => $this->published_time,
            'delete_time' => $this->delete_time,
        ]);

        $query->andFilterWhere(['like', 'post_title', $this->post_title])
            ->andFilterWhere(['like', 'post_keywords', $this->post_keywords])
            ->andFilterWhere(['like', 'post_excerpt', $this->post_excerpt])
            ->andFilterWhere(['like', 'post_source', $this->post_source])
            ->andFilterWhere(['like', 'post_content', $this->post_content])
            ->andFilterWhere(['like', 'post_content_filtered', $this->post_content_filtered])
            ->andFilterWhere(['like', 'more', $this->more]);

        return $dataProvider;
    }
}
