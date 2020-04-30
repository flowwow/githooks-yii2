<?php

namespace Flowwow\Githooks;

use Yii;

/**
 * suppliers module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'Flowwow\Githooks\Controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        Yii::setAlias('@Flowwow/Githooks/Controllers', dirname(Yii::getAlias('@console')) . '/vendor/flowwow/githooks/src/controllers');
        parent::init();
        // custom initialization code goes here
    }
}
