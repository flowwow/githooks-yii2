<?php


namespace Flowwow\Githooks\EventHandlers;

use Flowwow\Githooks\Helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Выполняет миграцию
 * Class MigrateEventHandler
 * @package Flowwow\Githooks\EventHandlers
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
        $command = CommandHelper::make([$this->getParameters()]);

        return $command->yiiMigrate($this->getArguments());
    }
}