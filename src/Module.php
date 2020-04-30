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
        Yii::setAlias('@githooks', dirname(Yii::getAlias('@console')) . '/vendor/flowwow/githooks/src');
        parent::init();
        // custom initialization code goes here
    }
}
