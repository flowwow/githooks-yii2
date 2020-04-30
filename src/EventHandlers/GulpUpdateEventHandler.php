<?php


namespace Flowwow\Githooks\EventHandlers;

use Flowwow\Githooks\Helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Пересобирает gulp
 * Class GulpUpdateEventHandler
 * @package Flowwow\Githooks\EventHandlers
 */
class GulpUpdateEventHandler extends BaseEventHandler
{
    /** @var string Аргументы вызова */
    protected $arguments = 'build';
    /** @var string Коментарий обработчика */
    protected $comment = '* Пересоберем gulp ...';

    /**
     * @param array $changeFiles
     * @return string|null
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    public function handle(array $changeFiles): ?string
    {
        $command = CommandHelper::make();

        return $command->gulp($this->getArguments());
    }
}