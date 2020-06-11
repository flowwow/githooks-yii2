<?php


namespace Flowwow\Githooks\EventHandlers;

use Flowwow\Githooks\Helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Сбрасывает кеш yii
 * Class CacheFlushEventHandler
 * @package Flowwow\Githooks\EventHandlers
 */
class CacheFlushEventHandler extends BaseEventHandler
{
    /** @var string Аргументы вызова */
    protected $arguments = 'cache/flush-schema';
    /** @var string Коментарий обработчика */
    protected $comment = '* Сбросим кеш моделей yii ...';

    /**
     * @param array $changeFiles
     * @return string|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function handle(array $changeFiles): ?string
    {
        $command = CommandHelper::make();

        return $command->yiiFlushCache($this->getArguments());
    }
}