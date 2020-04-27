<?php


namespace githooks\eventHandlers;

use githooks\helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Выполняет миграцию
 * Class MigrateEventHandler
 * @package console\modules\githooks\eventHandlers
 */
class MigrateEventHandler extends BaseEventHandler
{
    /** @var string Аргументы вызова */
    protected $arguments = 'migrate --interactive=0';
    /** @var string Коментарий обработчика */
    protected $comment = '* Применим миграции ...';

    /**
     * @param array $changeFiles
     * @return string|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function handle(array $changeFiles): ?string
    {
        $command = CommandHelper::make();

        return $command->yiiMigrate($this->getArguments());
    }
}