<?php

/* @var $this \yii\web\View */
/* @var $content string */


use kartik\sidenav\SideNav;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php if (isset($_COOKIE['left_menu_condensed']) && (htmlentities($_COOKIE['left_menu_condensed']) == 'true')) {
    $leftMenuClass = 'condensed';
    $contentContainerClass = 'expanded';
} else {
    $leftMenuClass = $contentContainerClass = '';
}

?>
<div class="wrap">
    <a href="#" id="left-menu-toggle" class="<?= $leftMenuClass ?>"><i
                class="glyphicon glyphicon-menu-hamburger"></i></a>
    <div id="left-menu" class="<?= $leftMenuClass ?>">
        <?php
        $path = Yii::$app->request->pathInfo;
        NavBar::begin([
            'brandLabel' => 'Pomaz Sergej',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        $menuItems = [
            ['label' => 'Home', 'url' => ['site/index']],
        ];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Registered', 'url' => ['site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['site/login']];
        } else {
            $menuItems[] = ['label' => 'User', 'url' => ['site/user']];
            $menuItems[] = ['label' => 'Add images', 'url' => ['site/add-image-form']];
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Exit (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }

        echo Nav::widget([
            'options' => ['class' => 'nav-pills navbar-right'],
            'items' => $menuItems

        ]);

        NavBar::end();
        if (Yii::$app->user->isGuest) {
            echo SideNav::widget([
                'type' => SideNav::TYPE_INFO,
                'heading' => 'Test side panel',
                'items' => [
                    [
                        'url' => '/',
                        'label' => 'Home',
                        'icon' => 'home',
                        'active' => ($path == '')
                    ],
                    [
                        'url' => 'site/signup',
                        'label' => 'Registered',
                        'icon' => 'glyphicon',
                        'active' => ($path == '')
                    ],
                    [
                        'url' => 'site/login',
                        'label' => 'Login',
                        'icon' => '',
                        'active' => ($path == '')
                    ]
                ],
            ]);
        } else {
            echo SideNav::widget([
                'type' => SideNav::TYPE_INFO,
                'heading' => 'Test side panel',
                'items' => [
                    [
                        'url' => '/',
                        'label' => 'Home',
                        'icon' => 'home',
                        'active' => ($path == '')
                    ],
                    [
                        'url' => 'site/user',
                        'label' => 'User',
                        'icon' => 'glyphicon ',
                        'active' => ($path == '')
                    ],
                    [
                        'url' => 'site/add-image-form',
                        'label' => 'Add Image',
                        'icon' => 'upload',
                        'active' => ($path == '')
                    ],
                ],
            ]);
        }

        ?>
    </div>
    <div id="ex-container" class="<?= $contentContainerClass ?>">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
<footer class="footer">
    <div class="container">
        <p class="pull-right">&copy; Pomaz Sergej <?= date('Y') ?></p>
    </div>
</footer>


</html>
<?php $this->endPage() ?>
