<?php

namespace ejen\base\common\behaviors;

use Yii;
use yii\db\ActiveRecord;
use yii\validators\ImageValidator;
use yii\web\UploadedFile;

class ImageAttributeBehavior extends \yii\base\Behavior
{
    public $attribute = false;
    public $destination = '@web/images/';
    public $rules = [];

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate($event)
    {
        $image = UploadedFile::getInstance($this->owner, $this->attribute);
        if ($image)
        {
            $validator = new ImageValidator($this->rules);
            if (!$validator->validate($image, $error))
            {
                $this->owner->addError($this->attribute, $error);
            }
            else
            {
                $filename = md5(file_get_contents($image->tempName)).".".$image->extension;
                $image->saveAs(rtrim(Yii::getAlias($this->destination), '/').'/'.$filename);
                $this->owner->{$this->attribute} = $filename;                
            }
        }
    }
}
