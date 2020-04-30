<?php


namespace Flowwow\Githooks\EventHandlers;

use Flowwow\Githooks\Helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Устанавливаем зависимости node
 * Class NodeUpdateEventHandler
 * @package Flowwow\Githooks\EventHandlers;
 */
class NodeUpdateEventHandler extends BaseEventHandler
{
    /** @var string Аргументы вызова */
    protected $arguments = 'install';
    /** @var string Коментарий обработчика */
    protected $comment = '* Установим зависимости node ...';

    /**
     * @param array $changeFiles
     * @return string|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function handle(array $changeFiles): ?string
    {
        $command = CommandHelper::make();

        return $command->npm($this->getArguments());
    }
}