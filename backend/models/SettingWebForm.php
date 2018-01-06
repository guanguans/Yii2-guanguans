<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-23 12:54
 */

namespace backend\models;

use yii;
use yii\base\Model;
use backend\models\Options;

class SettingWebForm extends Model
{
    const SCENARIO_WEBSITE = 'website';
    const SCENARIO_WEBSEO = 'webseo';

    public $website_title;
    public $website_email;
    public $website_status;
    public $website_icp;
    public $website_statics_script;

    public $seo_title;
    public $seo_keywords;
    public $seo_description;

    public $Options;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['website_title'], 'required', 'on' => self::SCENARIO_WEBSITE],
            [['seo_title'], 'required', 'on' => self::SCENARIO_WEBSEO],
            [['website_email'], 'email'],
            [['website_title', 'website_icp', 'website_statics_script', 'seo_title', 'seo_keywords', 'seo_description'], 'string'],
            [['website_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->Options = new Options();
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
    public function getWebSetting()
    {
        $names = $this->getNames();
        foreach ($names as $name) {
            $model = $this->Options->findOne(['name' => $name]);
            if (!empty($model)) {
                $this->$name = $model->value;
            }
        }
    }

    /**
     * 写入网站配置到数据库
     *
     * @return bool
     */
    public function setWebConfig($data)
    {
        foreach ($data['SettingWebForm'] as $k => $vo) {
            $model = $this->Options->findOne(['name' => $k]);
            if (!empty($model)) {
                $model->value = $vo;
                $result = $model->save();
                if (!$result) {
                    return false;
                }
            } else {
                $this->Options->name = $k;
                $this->Options->value = $vo;
                $res = $this->Options->save();
                if (!$res) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function getNames()
    {
        return array_keys($this->attributeLabels());
    }
}
