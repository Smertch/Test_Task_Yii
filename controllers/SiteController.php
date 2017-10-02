<?php

namespace app\controllers;

use app\models\AddImagesForm;
use app\models\ImagesUpload;
use app\models\Images;
use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\User;


class SiteController extends Controller
{

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
     * @return string
     */
    public function actionIndex()
    {
        $images = Images::getAll();
        return $this->render('index',
            [
                'images' => $images
            ]);
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
     * Displays about page.
     *
     * @return string
     */
    public function actionUser()
    {
        return $this->render('user');
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
    public function actionAddImageForm()
    {
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

    /**
     * @return array
     */
    public function actionSample()
    {
        if (Yii::$app->request->isAjax) {
            $data = User::getAll();
            /*$data['data'] = json_encode($user);*/
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' =>$data
            ];
        }
    }

}
