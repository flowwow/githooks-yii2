<?php


namespace githooks\eventHandlers;

use githooks\helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Сбрасывает кеш redis
 * Class CacheFlushEventHandler
 * @package console\modules\githooks\eventHandlers
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
        $command = CommandHelper::make();

        return $command->yiiConsoleRedis($this->getArguments());
    }
}