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
                ->orderBy('published_time DESC')
                // ->asArray()
                // ->all()
                ;
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
        return $this->render('about');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionArticle($id)
    {
        // $article = \backend\models\Article::findOne($id);
        $model = \backend\models\Article::findOne($id);
        $model->post_hits++;
        $model->save();

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
                ->all()
                ;
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
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
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
        $model = \frontend\models\UserFavorite::findAll(['user_id'=>$user_id]);

        return $this->render('favorite', ['model'=>$model]);
    }
}
