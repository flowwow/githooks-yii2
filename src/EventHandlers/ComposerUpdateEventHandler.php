<?php


namespace Flowwow\Githooks\EventHandlers;

use Flowwow\Githooks\Helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Устанавливаем зависимости composer
 * Class ComposerUpdateEventHandler
 * @package Flowwow\Githooks\EventHandlers
 */
class ComposerUpdateEventHandler extends BaseEventHandler
{
    /** @var string Аргументы вызова */
    protected $arguments = 'install';
    /** @var string Коментарий обработчика */
    protected $comment = '* Установим зависимости composer ...';

    /**
     * @param array $changeFiles
     * @return string|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function handle(array $changeFiles): ?string
    {
        $command = CommandHelper::make([$this->getParameters()]);

        return $command->composer($this->getArguments());
    }
}