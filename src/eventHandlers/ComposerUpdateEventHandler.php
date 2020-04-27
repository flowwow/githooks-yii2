<?php


namespace githooks\eventHandlers;

use githooks\helpers\CommandHelper;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

/**
 * Устанавливаем зависимости composer
 * Class ComposerUpdateEventHandler
 * @package console\modules\githooks\eventHandlers
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
        $command = CommandHelper::make();

        return $command->composer($this->getArguments());
    }
}