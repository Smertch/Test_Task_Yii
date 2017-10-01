<?php
/**
 * Created by PhpStorm.
 * User: smertch
 * Date: 30.09.17
 * Time: 23:33
 */

namespace app\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImagesUpload extends Model

{
    public $title;
    public $imgName;

    public function rules()
    {
        return [
            ['title', 'trim'],
            ['title', 'required'],
            [['imgName'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @return bool
     */
    public function uploadFile(UploadedFile $file)
    {
        $fileName=strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);
        $file->saveAs('uploads/img/' . $fileName );
        return $fileName;

    }
}