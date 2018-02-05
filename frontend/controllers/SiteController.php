<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'logout' => ['post'],
                ],
            ],
            [
                // 页面缓存
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 60,
                'variations' => [
                    Yii::$app->language,
                    Yii::$app->request->get('page'),
                    Yii::$app->request->get('cid'),
                ],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM feehi_article',
                ],
            ],
            [
                // HTTP 缓存
                'class' => 'yii\filters\HttpCache',
                'only' => ['article'],
                'lastModified' => function ($action, $params) {
                    $q = new \yii\db\Query();
                    return $q->from('feehi_article')->max('update_time');
                },
                'etagSeed' => function ($action, $params) {
                    $article = \backend\models\Article::findOne(Yii::$app->request->get('id'));
                    return serialize([$article->post_title, $article->post_content]);
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $cid = empty(Yii::$app->request->get('cid')) ? 0 : intval(Yii::$app->request->get('cid'));
        $where = [
            'post_status'=>1,
            'post_type'=>1,
        ];
        if ($cid) {
            $where['category_id'] = $cid;
        }

        // 关联查询
        $query = \backend\models\Article::find()
                ->select(['feehi_article.id', 'post_title', 'user_id', 'post_hits', 'post_content', 'post_excerpt', 'published_time'])
                ->joinWith([
                    'adminUser' => function($query){
                        $query->select(['id', 'username']);
                    },
                    'categorys'
                ])
                ->where($where)
                ->groupBy(['post_id'])
                ->orderBy('published_time DESC');

        // pp($countQuery->createCommand()->getRawSql());
        $countQuery = clone $query;
        $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $pages->defaultPageSize = 10;
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', [
             'models' => $models,
             'pages' => $pages,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        if (false) {
            set_time_limit(0);
            $connection = \Yii::$app->db;
            $command = $connection->createCommand("SELECT post_id FROM feehi_category_article ORDER BY id DESC limit 1");
            $lastId = $command->queryOne()['post_id'];
            $endId = $lastId + 500;
            for ($i = $lastId; $i <= $endId ; $i++) {
                $sql = "INSERT INTO `yiiblog`.`feehi_category_article` (`post_id`, `category_id`, `list_order`, `status`) VALUES ($i, '1', '10000', '1')";
                $command = $connection->createCommand($sql);
                $command->execute();
            }
            pp(true);
        }

        return $this->render('about');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionArticle($id)
    {
        $model = \backend\models\Article::findOne($id);
        $model->post_hits++;
        $model->save();

        // 缓存依赖
        $dependency = new \yii\caching\DbDependency(['sql' => 'SELECT post_title,published_time FROM feehi_article WHERE id = '.$id]);
        if (Yii::$app->cache->get('artcle_model')) {
            $article = Yii::$app->cache->get('artcle_model');
        } else {
            $article = \backend\models\Article::find()
                    ->select(['feehi_article.id', 'post_title', 'user_id', 'post_hits', 'post_content', 'post_excerpt', 'published_time'])
                    ->joinWith([
                        'adminUser' => function($query){
                            $query->select(['id', 'username']);
                        },
                        'categorys'
                    ])
                    ->where(['feehi_article.id'=>$id])
                    ->groupBy(['post_id'])
                    ->orderBy('published_time DESC')
                    ->asArray()
                    ->all();
            // 数据缓存
            Yii::$app->cache->set('artcle_model', $article, 30*60, $dependency);
        }

        // pp($article);
        return $this->render('article', ['article'=>$article]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $object = Yii::$app->request->post('SignupForm')['email'];
            $object = '798314049@qq.com';
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    // return $this->goHome();
                    $title         = '[琯琯博客] 邮箱激活通知';
                    $sender        = '琯琯博客';
                    $verifyCode    = json_decode($user->email_verify, 1)['verify_token'];
                    $verifyAddress = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'verifyCode' => $verifyCode]);
                    // 执行任务时避免外部依赖(数据必须直接给)
                    $queueId = Yii::$app->queue->delay(30)->push(new \frontend\components\SendEmailJob([
                        'object'        => $object,
                        'title'         => $title,
                        'verifyAddress' => $verifyAddress,
                        'sender'        => $sender,
                    ]));
                    if ($queueId) {
                        Yii::$app->session->setFlash('registerInfo', '注册成功，请尽快验证邮箱！');
                    }

                    return $this->redirect(['site/favorite-list']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionFavorite()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $object_id = Yii::$app->request->get('object_id');
        $model = \frontend\models\UserFavorite::findOne(['object_id'=>$object_id, 'user_id'=>Yii::$app->user->id]);
        if (empty($model)) {
            $model = new \frontend\models\UserFavorite();

            $model->user_id     = Yii::$app->user->id;
            $model->title       = \backend\models\Article::find(66)->select('post_title')->one()->post_title;
            $model->url         = json_encode(['site/article', 'id'=>$object_id]);
            $model->object_id   = $object_id;
            $model->create_time = time();
            $model->save();
            echo 1; exit;
        } else {
            echo 0; exit;
        }
    }

    /**
     * 我的收藏
     */
    public function actionFavoriteList(){
        $user_id = Yii::$app->user->id;
        if (empty($user_id)) {
            return $this->goHome();
        }
        $user = \backend\models\AdminUser::findOne($user_id);

        $query = \frontend\models\UserFavorite::find()
                ->joinWith([
                    'article' => function($query){
                        $query->select(['id', 'post_title']);
                    }
                ])
                ->where(['feehi_user_favorite.user_id'=>$user_id])
                ->orderBy('create_time DESC');
                // ->all();
        $countQuery = clone $query;
        $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $pages->defaultPageSize = 15;
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('favorite', [
            'models'=>$models,
            'pages' => $pages,
            'user' => $user,
        ]);
    }

    /**
     * 取消收藏
     */
    public function actionFavoriteDelete(){
        $user_id = Yii::$app->user->id;
        if (empty($user_id)) {
            return $this->goHome();
        }
        $res = \frontend\models\UserFavorite::findOne(Yii::$app->request->get('id'))->delete();
        return $this->redirect(['site/favorite-list']);
    }

    /**
     * 邮箱验证
     */
    public function actionVerifyEmail(){
        $verifyCode = Yii::$app->request->get('verifyCode');
        $user = \backend\models\AdminUser::findOne(Yii::$app->user->id);
        $verify_token = json_decode($user->email_verify, 1)['verify_token'];
        if ($verifyCode === $verify_token) {
            $user->email_verify = json_encode(['is_verify'=>1, 'verify_token'=>$verify_token]);
            $user->save();
            return $this->render('verifyEmail', ['is_verify'=>true]);
        }
        // $this->layout = false;
        return $this->render('verifyEmail', ['is_verify'=>false]);
    }
}



