<?php

namespace Flowwow\Githooks\Controllers;

use Flowwow\Githooks\models\HandleComponent;
use Flowwow\Githooks\models\RegisteredComponent;
use yii\base\InvalidConfigException;
use yii\console\Controller;
use yii\di\NotInstantiableException;


/**
 * Class HooksController
 * @package Flowwow\Githooks\Controllers
 */
class HooksController extends Controller
{

    /**
     * Регистрирует настройку событий
     * @throws InvalidConfigException
     */
    public function actionRegister()
    {
        echo "Регистрируем настройку хуков\n";
        $component = RegisteredComponent::make();
        $component->updateHookFiles();
        echo "Завершение\n";
    }

    /**
     * Произведем захват события
     * @param string $hookEventName
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function actionHandle(string $hookEventName)
    {
        echo "Выполним событие {$hookEventName}\n";
        $component = HandleComponent::make();
        $component->process($hookEventName);
        echo "Завершение\n";
    }
}