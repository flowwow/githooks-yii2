<?php


namespace Flowwow\Githooks\EventHandlers;

use Flowwow\Githooks\Helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Сбрасывает кеш redis
 * Class CacheFlushEventHandler
 * @package Flowwow\Githooks\EventHandlers
 */
class RedisDropEventHandler extends BaseEventHandler
{
    /** @var string Аргументы вызова */
    protected $arguments = 'redis/drop';
    /** @var string Коментарий обработчика */
    protected $comment = '* Сбросим кеш redis ...';

    /**
     * @param array $changeFiles
     * @return string|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function handle(array $changeFiles): ?string
    {
        $command = CommandHelper::make([$this->getParameters()]);

        return $command->yiiConsoleRedis($this->getArguments());
    }
}