<?php
/**
 * Created by PhpStorm.
 * User: smertch
 * Date: 29.09.17
 * Time: 8:31
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;


class Images extends ActiveRecord
{
    public $imgName;
    public $title;

    /**
     *
     */
    public function afterFind()
    {
        $this->imgName = "/web/uploads/img" . $this->imgName;
    }

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
}