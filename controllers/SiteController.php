<?php

namespace app\controllers;

use app\models\Promocode;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'only' => ['logout'],
                'rules' => [
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
                    'logout' => ['post'],
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
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionShow() {
        $query = Promocode::find()->orderBy('id DESC');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('list', ['codes' => $dataProvider]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    /**
     * Создаём код
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Promocode();

        if ($model->load(Yii::$app->request->post())) {

            $begin_date_arr = explode('/', Yii::$app->request->post()['Promocode']['begin_data']);
            $end_date_arr = explode('/', Yii::$app->request->post()['Promocode']['end_data']);

            $model->begin_data =
                mktime(0, 0,0, $begin_date_arr[0], $begin_date_arr[1], $begin_date_arr[2]);
            $model->end_data =
                mktime(0, 0,0, $end_date_arr[0], $end_date_arr[1], $end_date_arr[2]);
            //var_dump($model); exit;
            try {
                $model->save(false);
            } catch (\ErrorException $e) {
                echo $e->getMessage();
            }
            return $this->redirect(Url::toRoute('/show'));
        }

        else{
            return $this->render('_form', [
                'model' => $model,
                'status' => $model->status

            ]);
        }

    }

    /**
     * Редактирование
     * @param $id
     * @return string|Response
     */
    public function actionUpdate($id){
        $model = $this->loadModel($id);
        if ($model->load(Yii::$app->request->post())) {

            $begin_date_arr = explode('/', Yii::$app->request->post()['Promocode']['begin_data']);
            $end_date_arr = explode('/', Yii::$app->request->post()['Promocode']['end_data']);

            $model->begin_data =
                mktime(0, 0,0, $begin_date_arr[0], $begin_date_arr[1], $begin_date_arr[2]);
            $model->end_data =
                mktime(0, 0,0, $end_date_arr[0], $end_date_arr[1], $end_date_arr[2]);
            //var_dump($model); exit;
            try {
                $model->save(false);
            } catch (\ErrorException $e) {
                echo $e->getMessage();
            }
            return $this->redirect(Url::toRoute('/show'));
        }

        else{
            $model->begin_data = date('m/d/Y', $model->begin_data);
            $model->end_data = date('m/d/Y', $model->end_data);
            return $this->render('_form', [
                'model' => $model,
                'status' => $model->status
            ]);
        }
    }

    /**
     * Модель
     * @param $id
     * @return null|static
     * @throws \yii\web\HttpException
     */
    public function loadModel($id)
    {

        $model = Promocode::findOne($id);

        if ($model === null)
            throw new \yii\web\HttpException(404, 'The requested page does not exist.');
        return $model;
    }


}
