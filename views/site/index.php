<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Carousel;
?>
<!--main content start-->

<div class="container text-center">
<? if ($images):?>
    <h1> Click Me </h1>
    <!-- Large modal -->
    <button class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php $i =1; foreach($images as $image):?>
                        <div class="item <?if ($i ==1){echo 'active';}?>">
                            <img class="img-responsive" src="/uploads/img/<?= $image['img_name'];?>" alt="...">
                            <div class="carousel-caption">
                                <?= $image['img_title'];?>
                            </div>
                        </div>
                       <?php $i++; endforeach; ?>

                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <? endif;?>
    <?php  if (!$images): ?>
        <h1>Add images</h1>
    <? endif;?>
</div>