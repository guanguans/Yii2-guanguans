<?php

namespace backend\controllers;

use Yii;
use backend\models\Article;
use backend\models\ArticleSearch;
use backend\models\CategoryArticle;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use backend\components\Upload;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        if ($model->load(Yii::$app->request->post())) {
            $res = $model->saveArticle(Yii::$app->request->post('Article'));
            if ($res === true) {
                hintInfo(['code'=>1,'data'=>'添加成功']);
                return $this->redirect(['index']);
            } else {
                hintInfo(['code'=>0,'data'=>'添加失败'], $model);
                return $this->redirect(['create']);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $res = $model->saveArticle(Yii::$app->request->post('Article'));
            if ($res === true) {
                hintInfo(['code'=>1,'data'=>'更新成功']);

                return $this->redirect(['view', 'id' => $id]);
            } else {
                hintInfo(['code'=>0,'data'=>'更新失败'], $model);

                return $this->redirect(['update', 'id'=>$id]);
            }
        }
        // 关联模型
        $categorys = ArrayHelper::toArray($model->categorys);
        $model->category = ArrayHelper::getColumn($categorys, 'category_id');
        $model->post_keywords = implode(',', json_decode($model->post_keywords, 1));
        $model->more = json_decode($model->more, 1);
        $model->thumbnail = $model->more['thumbnail'];

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * 相册上传
     * https://packagist.org/packages/bailangzhan/yii2-webuploader
     */
    public function actionUploadImage()
    {
        /*错误时
        exit('{"code": 1, "msg": "error"}');
        正确时， 其中 attachment 指的是保存在数据库中的路径，url 是该图片在web可访问的地址
        exit('{"code": 0, "url": "http://domain/图片地址", "attachment": "图片地址"}');*/
        try {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new Upload();
            $info = $model->upload('image');
            if ($info && is_array($info)) {
                return $info;
            } else {
                return ['code' => 1, 'msg' => 'error'];
            }
        } catch (\Exception $e) {
            return ['code' => 1, 'msg' => $e->getMessage()];
        }
    }


    /**
     * 文件上传
     * https://packagist.org/packages/2amigos/yii2-file-upload-widget
     */
    public function actionUploadFile()
    {
        $model = new Article();
        $imageFile = \yii\web\UploadedFile::getInstance($model, 'files');
        $directory = Yii::getAlias('@backend/web/uploader') .'/file/'. date('Ymd').'/';

        if (!is_dir($directory)) {
            \yii\helpers\FileHelper::createDirectory($directory);
        }

        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;

            if ($imageFile->saveAs($filePath)) {
                $path = '/uploader/file/'. date('Ymd').'/' . $fileName;

                return \yii\helpers\Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $imageFile->size,
                            'url' => $path,
                            'thumbnailUrl' => $path,
                            'deleteUrl' => 'article/delete-file?name=' . $fileName,
                            'deleteType' => 'POST',
                        ],
                    ],
                ]);
            }
        }

        return '';
    }

    /**
     * 文件上传
     * https://packagist.org/packages/2amigos/yii2-file-upload-widget
     */
    public function actionDeleteFile($name)
    {
        $directory = Yii::getAlias('@backend/web/img/temp') . DIRECTORY_SEPARATOR . Yii::$app->session->id;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $files = \yii\helpers\FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'article/delete-file?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return \yii\helpers\Json::encode($output);
    }
}
