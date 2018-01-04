<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-23 12:54
 */

namespace backend\models;

use yii;
use backend\models\Options;

class SettingWebsiteForm extends Options
{
    public $website_title;
    public $website_email;
    public $website_icp;
    public $website_status;
    public $website_statics_script;

    public $seo_title;
    public $seo_keywords;
    public $seo_description;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'website_title',
                    'website_email',
                    'website_icp',
                    'website_statics_script',
                    'website_url',

                    'seo_title',
                    'seo_keywords',
                    'seo_description'
                ],
                'string'
            ],
            [['website_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'website_title'=>'网站名称',
            'website_email'=>'站长邮箱',
            'website_icp'=>'备案信息',
            'website_status'=>'站点状态',
            'website_statics_script'=>'统计代码',

            'seo_title'=>'SEO标题',
            'seo_keywords'=>'SEO关键字',
            'seo_description'=>'SEO描述',
        ];
    }

    /**
     * 填充网站配置
     *
     */
    public function getWebsiteSetting()
    {
        $names = $this->getNames();
        foreach ($names as $name) {
            $model = self::findOne(['name' => $name]);
            if ($model != null) {
                $this->$name = $model->value;
            } else {
                $this->name = '';
            }
        }
    }
}