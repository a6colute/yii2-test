<?php

namespace app\models;
 
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
 
class UploadImage extends Model {
 
    public $image;
 
    public function rules() {
        return[
            [['image'], 'file', 'extensions' => ['jpg', 'jpeg', 'png', 'gif']],
        ];
    }
 
    public function upload(): ?string
	{
        if($this->validate() && $this->image) {
			$newImageName = md5($this->image->baseName . microtime()) . '.' . $this->image->extension;
            $this->image->saveAs(Yii::getAlias("@images/$newImageName"));
			return $newImageName;
        } 
		
        return null;
    }
 
}