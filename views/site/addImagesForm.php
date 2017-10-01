<?php
/**
 * Created by PhpStorm.
 * User: smertch
 * Date: 27.09.17
 * Time: 20:24
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
    <div class="row">
        <div class="col-lg-5">
            <?php $f = ActiveForm::begin(['options' =>['enctype'=>'multipart/form-data']]); ?>
            <?= $f->field($form, 'title')->textInput(['autofocus' => true]) ?>

            <?= $f->field($form, 'file')->fileInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
        </div>
    </div>
<? ActiveForm::end(); ?>