<?php
/**
 * Created by PhpStorm.
 * User: smertch
 * Date: 29.09.17
 * Time: 8:31
 */

namespace app\models;


use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;


class Images extends ActiveRecord
{


    /**
     * @param $fileName
     * @param $title
     * @return Images|null
     */
    public function saveImage($fileName, $title)
    {
        $image = new Images();
        $image->img_name = $fileName;
        $image->img_title = $title;
        $image->created_at = Yii::$app->formatter->asDate('now', 'php:Y-m-d H:i:s');
        return $image->save()? $image : null;

    }

    /**
     * @return array|ActiveRecord[]
     */
    public static function getAll()
    {
        // build a DB query to get all articles

        $images = Images::find()
            ->asArray()
            ->all();
        return $images;
    }
}