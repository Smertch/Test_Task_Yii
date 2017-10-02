<?php
/**
 * Created by PhpStorm.
 * User: smertch
 * Date: 29.09.17
 * Time: 10:01
 */


namespace app\models;

use yii\base\Model;

class AddImagesForm extends Model
{
    /**
     * @var
     */
    public $title;
    public $file;

    public function rules()
    {
        return [
            ['title', 'trim'],
            ['title', 'required'],
            [['file'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

}