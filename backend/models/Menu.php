<?php

namespace backend\models;

use Yii;
use backend\helper\Tree;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property string $id
 * @property string $type
 * @property string $parent_id
 * @property string $name
 * @property string $url
 * @property string $icon
 * @property double $sort
 * @property string $target
 * @property int $is_absolute_url
 * @property int $is_display
 * @property int $method
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AdminRolePermission[] $adminRolePermissions
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'parent_id', 'is_absolute_url', 'is_display', 'method', 'created_at', 'updated_at'], 'integer'],
            [['name', 'url'], 'required'],
            [['sort'], 'number'],
            [['name', 'url', 'icon', 'target'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型',
            'parent_id' => '上级',
            'name' => '名称',
            'url' => '操作路由',
            'icon' => '图标',
            'sort' => '排序',
            'target' => 'Target',
            'is_absolute_url' => 'Is Absolute Url',
            'is_display' => '状态',
            'method' => '方法',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminRolePermissions()
    {
        return $this->hasMany(AdminRolePermission::className(), ['menu_id' => 'id']);
    }

    /**
     * 生成分类 select树形结构
     * @param int $selectId 需要选中的分类 id
     * @param int $currentCid 需要隐藏的分类 id
     * @return string
     */
    public function menuTree($selectIds = [], $currentCid = 0)
    {
        $where = [];
        if (!empty($currentCid)) {
            $where['id'] = ['neq', $currentCid];
        }
        $categories = Menu::find()
                    ->where($where)
                    ->orderBy('sort ASC')
                    ->asArray()
                    ->all();

        $tree       = new Tree();
        $tree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
        $tree->nbsp = '&nbsp;&nbsp;';

        $newCategories = [];
        foreach ($categories as $item) {
            // $item['selected'] = $selectId == $item['id'] ? "selected" : "";
            $item['selected'] = in_array($item['id'], $selectIds) ? "selected" : "";

            array_push($newCategories, $item);
        }

        $tree->init($newCategories);
        $str     = '<option value=\"{$id}\" {$selected}>{$spacer}{$name}</option>';
        $treeStr = $tree->getTree(0, $str);

        return $treeStr;
    }

    /**
     * @param int|array $currentIds
     * @param string $tpl
     * @return string
     */
    public static function  menuTableTree($type = 0, $currentIds = 0, $tpl = '')
    {
        $categories = Menu::find()
                    ->where(['type'=>$type])
                    ->orderBy('sort ASC')
                    ->asArray()
                    ->all();
        $tree       = new Tree();
        $tree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
        $tree->nbsp = '&nbsp;&nbsp;';

        if (!is_array($currentIds)) {
            $currentIds = [$currentIds];
        }

        $newCategories = [];
        foreach ($categories as $item) {
            $item['checked'] = in_array($item['id'], $currentIds) ? "checked" : "";
            $item['is_display'] = $item['is_display'] == 1 ? '<i class="fa fa-check fa-fw text-info"></i>' : '<i class="fa fa-close fa-fw text-danger"></i>';

            $item['str_action'] = '<a href="' . Url::to(['menu/create', 'parent_id' => $item['id']]) . '">添加子菜单</a> | <a href="' . Url::to(['menu/view', 'id' => $item['id']]) . '">查看</a> | <a href="' . Url::to(['menu/update', 'id' => $item['id']]) . '">编辑</a>  | <a class="text-danger" data-pjax="0"  data-confirm="您确定要删除此项吗？" data-method="post" href="' . Url::to(['menu/delete', 'id' => $item['id']]) . '">删除</a> ';
            array_push($newCategories, $item);
        }

        $tree->init($newCategories);

        if (empty($tpl)) {
            $tpl = "<tr>
                        <td><input name='list_orders[\$id]' type='text' size='3' value='\$sort' class='input-order'></td>
                        <td>\$id</td>
                        <td>\$spacer\$name</td>
                        <td>\$url</td>
                        <td>\$is_display</td>
                        <td width='230px'>\$str_action</td>
                    </tr>";
        }
        $treeStr = $tree->getTree(0, $tpl);

        return $treeStr;
    }
}
