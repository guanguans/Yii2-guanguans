<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property string $parent_id 父级id
 * @property int $post_type 类型,1:文章;2:页面
 * @property int $post_format 内容格式;1:html;2:md
 * @property string $user_id 发表者用户id
 * @property int $post_status 状态;1:已发布;0:未发布;
 * @property int $comment_status 评论状态;1:允许;0:不允许
 * @property int $is_top 是否置顶;1:置顶;0:不置顶
 * @property int $recommended 是否推荐;1:推荐;0:不推荐
 * @property string $post_hits 查看数
 * @property string $post_like 点赞数
 * @property string $comment_count 评论数
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 * @property string $published_time 发布时间
 * @property string $delete_time 删除时间
 * @property string $post_title post标题
 * @property string $post_keywords seo keywords
 * @property string $post_excerpt post摘要
 * @property string $post_source 转载文章的来源
 * @property string $post_content 文章内容
 * @property string $post_content_filtered 处理过的文章内容
 * @property string $more 扩展属性,如缩略图;格式为json
 */
class Article extends \yii\db\ActiveRecord
{
    public $photos;
    public $files;
    public $thumbnail;

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
            [['parent_id', 'post_type', 'post_format', 'user_id', 'post_status', 'comment_status', 'is_top', 'recommended', 'post_hits', 'post_like', 'comment_count', 'create_time', 'update_time', 'published_time', 'delete_time'], 'integer'],
            [['post_content', 'post_content_filtered', 'more'], 'string'],
            [['post_title'], 'required'],
            [['post_keywords', 'post_source'], 'string', 'max' => 150],
            [['post_excerpt'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '分类',
            'post_type' => '类型,1:文章;2:页面',
            'post_format' => '内容格式;1:html;2:md',
            'user_id' => '发表者用户id',
            'post_status' => '状态;1:已发布;0:未发布;',
            'comment_status' => '评论状态;1:允许;0:不允许',
            'is_top' => '是否置顶;1:置顶;0:不置顶',
            'recommended' => '是否推荐;1:推荐;0:不推荐',
            'post_hits' => '查看数',
            'post_like' => '点赞数',
            'comment_count' => '评论数',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'published_time' => '发布时间',
            'delete_time' => '删除时间',
            'post_title' => '标题',
            'post_keywords' => '关键词',
            'post_excerpt' => '摘要',
            'post_source' => '文章来源',
            'post_content' => '内容',
            'post_content_filtered' => '处理过的文章内容',
            'more' => '扩展属性,如缩略图;格式为json',
        ];
    }
}
