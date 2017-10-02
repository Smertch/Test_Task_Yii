<?php

use yii\widgets\LinkPager;
?>
<h1>Images</h1>
<p>Здравствуйте <?=$name;?></p>
<?php foreach ($images as $image){?>
    <div img="<?$image->path ?>" name="<?$image->id ?>" title="<?$image->title ?>"></div>
    <?}?>
<!--<a href="<?/*=Yii::$app->urlManager->createUrl(['site/add', ['name'=> $image->url]])*/?>"></a>-->
<? LinkPager::widget(['pagination', $pagination]);?>