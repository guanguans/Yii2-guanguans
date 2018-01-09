<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property string $cid
 * @property string $type
 * @property string $title
 * @property string $sub_title
 * @property string $summary
 * @property string $thumb
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property int $status
 * @property string $sort
 * @property string $author_id
 * @property string $author_name
 * @property string $scan_count
 * @property string $comment_count
 * @property int $can_comment
 * @property int $visibility
 * @property string $tag
 * @property int $flag_headline
 * @property int $flag_recommend
 * @property int $flag_slide_show
 * @property int $flag_special_recommend
 * @property int $flag_roll
 * @property int $flag_bold
 * @property int $flag_picture
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ArticleContent[] $articleContents
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'type', 'status', 'sort', 'author_id', 'scan_count', 'comment_count', 'can_comment', 'visibility', 'flag_headline', 'flag_recommend', 'flag_slide_show', 'flag_special_recommend', 'flag_roll', 'flag_bold', 'flag_picture', 'created_at', 'updated_at'], 'integer'],
            [['title', 'created_at'], 'required'],
            [['title', 'sub_title', 'summary', 'thumb', 'seo_title', 'seo_keywords', 'seo_description', 'author_name', 'tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'Cid',
            'type' => 'Type',
            'title' => 'Title',
            'sub_title' => 'Sub Title',
            'summary' => 'Summary',
            'thumb' => 'Thumb',
            'seo_title' => 'Seo Title',
            'seo_keywords' => 'Seo Keywords',
            'seo_description' => 'Seo Description',
            'status' => 'Status',
            'sort' => 'Sort',
            'author_id' => 'Author ID',
            'author_name' => 'Author Name',
            'scan_count' => 'Scan Count',
            'comment_count' => 'Comment Count',
            'can_comment' => 'Can Comment',
            'visibility' => 'Visibility',
            'tag' => 'Tag',
            'flag_headline' => 'Flag Headline',
            'flag_recommend' => 'Flag Recommend',
            'flag_slide_show' => 'Flag Slide Show',
            'flag_special_recommend' => 'Flag Special Recommend',
            'flag_roll' => 'Flag Roll',
            'flag_bold' => 'Flag Bold',
            'flag_picture' => 'Flag Picture',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleContents()
    {
        return $this->hasMany(ArticleContent::className(), ['aid' => 'id']);
    }
}
