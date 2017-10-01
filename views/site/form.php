<?php
/**
 * Created by PhpStorm.
 * User: smertch
 * Date: 27.09.17
 * Time: 20:24
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;

?>
<div class="row">
    <div class="col-lg-5">
        <?php $f = ActiveForm::begin(); ?>
        <?= $f->field($form, 'name')->textInput(['autofocus' => true]) ?>
        <?= $f->field($form, 'email') ?>
        <?= $f->field($form, 'password')->passwordInput() ?>
        <?= $f->field($form, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>
    </div>
</div>
<? ActiveForm::end(); ?>
