<?php


namespace githooks\eventHandlers;

use githooks\helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Сбрасывает кеш yii
 * Class CacheFlushEventHandler
 * @package console\modules\githooks\eventHandlers
 */
class CacheFlushEventHandler extends BaseEventHandler
{
    /** @var string Аргументы вызова */
    protected $arguments = 'cache/flush-all';
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