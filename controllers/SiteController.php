<?php

namespace app\controllers;

use app\models\AddImagesForm;
use app\models\ImagesUpload;
use app\models\Images;

use Yii;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;


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
                'only' => ['logout', 'signup', 'about'],
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
                    [
                        'actions' => ['about'],
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

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        /*else if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();}*/
            else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
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
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
       /* if (!\Yii::$app->user->can('about')) {
            throw new ForbiddenHttpException('Access denied');
        }*/
        return $this->render('about');
    }

    /**
     * @return string|Response
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->signup()) { // check in

                if (Yii::$app->getUser()->login($user)) { // Log in if registration is successful
                    return $this->goHome(); // We return to the main page
                }
            }
        }

        return $this->render('signup', [ // Render the view if one of the ifs returns false
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function actionImages (){
        $img = Images::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $img->count()
        ]);
        $images = $img->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('images',[
           'images' => $images,
           'pagination' => $pagination,
            'name' => Yii::$app->session->get('name')


        ]);
    }

    /**
     * @return string
     */
    public function actionAddImageForm(){
        $form = new AddImagesForm;
        $img = new ImagesUpload();
        $image = new Images();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $title = Html::encode($form->title);
            $file = UploadedFile::getInstance($form, 'file');
            $fileName = $img->uploadFile($file);
            $image->saveImage($fileName, $title);
        }
        return $this->render('addImagesForm', [
            'form' => $form
        ]);
    }

}
