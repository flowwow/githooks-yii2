<?php

namespace Flowwow\Githooks\Traits;

use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Значительно упрощает работу с DI.
 * Во-первых не нужно указывать какой класс надо инициировать, во-вторых не нужно описывать PHPDoc описывающий возвращаемое значение
 *
 * Как было
 * ```
 * /** var SomeComponent *\/
 * $component = make(SomeComponent::class, [], []);
 * ```
 *
 * Как стало
 * ```
 * $component = SomeComponent::make([], []);
 * ```
 */
trait MakeTrait
{
    /**
     * @param array $params
     * @param array $options
     * @return static
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public static function make(array $params = [], array $options = []): object
    {
        return Yii::$container->get(static::class, $params, $options);
    }
}
